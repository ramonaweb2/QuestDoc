<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Invitation;
use App\Services\ProtocolService;
use Illuminate\Http\Request;
use App\Services\InvitationService;
use App\Models\Protocol;
use App\Models\Participants;
use App\Models\Voting;

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ProtocolsController extends Controller
{
    private InvitationService $invitationService;
    private ProtocolService $protocolService;

    public function __construct(InvitationService $invitationService, ProtocolService $protocolService)
    {
        $this->invitationService = $invitationService;
        $this->protocolService = $protocolService;
    }

    /**
     * Display page for create or download protocol (docs + pdf)
     */
    public function display(string $inv_key)
    {
        $invitation = $this->invitationService->getInvitationByKey($inv_key);
        $protocol = $this->protocolService->getProtocolByInvitationID($invitation->id);
        if (!$protocol) {
            $agendas = $invitation->agendas;
            return view('protocols.create', [
                'invitation' => $invitation,
                'agendas' => $agendas,
            ]);
        }
        $data = [
            'protocol' => $protocol,
            'invitation' => $invitation,
        ];
        return view('protocols.display', $data);

    }

    /**
     * Display page for edit protocol
     */
    public function edit(string $inv_key) 
    {
        $invitation = $this->invitationService->getInvitationByKey($inv_key);
        $protocol = Protocol::where('invitation_id', $invitation->id)->first();
        $participants = Participants::where('invitation_id', $invitation->id)->get();
        $partData = array();

        foreach ($participants as $participant) {
            $line = sprintf("%s - %s - %s", $participant->apartment, $participant->person, $participant->parts);
            array_push($partData, $line);
        }

        $agendas = $invitation->agendas;
        $data = [
            'protocol' => $protocol,
            'invitation' => $invitation,
            'participants' => $partData,
            'agendas' => $agendas,
        ];
        return view('protocols.edit', $data);
    }

    /**
     * Show the form for creating a new protocol.
     */
    public function create(Request $request)
    {
        $inv_key = $request->route('inv_key');

        $invitation = Invitation::where('inv_key', $inv_key)->firstOrFail();
        // Retrieve all agendas associated with this invitation
        
        if ($invitation) {
            $agendas = $invitation->agendas;
            return view('protocols.create', [
                'invitation' => $invitation,
                'agendas' => $agendas,
            ]);
        }

        return abort(404);
    }

    public function store(Request $request)
    {
        $inv_key = $request->input('inv_key');
        $invitation = $this->invitationService->getInvitationByKey($inv_key);
        
        $rules = $this->rules();
        $customMessages = $this->messages();
        
        // Validate the request
        $validator = validator()->make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->route('protocols.create', ['inv_key' => $inv_key])->withErrors($validator)
            ->withInput();
        }

        # Create protocol
        $protocol = new Protocol();
        $protocol->start_time = $invitation['meet_time'];
        $protocol->end_time = $request->input('end_time');
        $protocol->meetQuorum1 = $request->input('meetQuorum1');
        $protocol->meetQuorum2 = $request->input('meetQuorum2');
        $protocol->minuteman = $request->input('minuteman');
        $protocol->invitation_id = $invitation['id'];
        $protocol->save();

        $inputs = $request->input();
        foreach($inputs as $key => $val) {
            # Update agendas points
            if (str_contains($key, '-')) {
                $agendaArray = explode('-', $key);
                $agendaID = (int) $agendaArray[0];
                $agendaItem = Agenda::findOrFail($agendaID);
                if ($agendaArray[1] == 'approves') {
                    $agendaItem->approves = (int) $val;
                } else if ($agendaArray[1] == 'refuses') {
                    $agendaItem->refuses = (int) $val;
                } else if ($agendaArray[1] == 'abstain') {
                    $agendaItem->abstain = (int) $val;
                }
                
                $agendaItem->save();
            }
        }

        return redirect()->route('protocols.create', $invitation->inv_key)->with('success', 'Протоколът е създаден успешно!');
    }

    public function update(Request $request)
    {
        $inv_key = $request->input('inv_key');
        $invitation = $this->invitationService->getInvitationByKey($inv_key);
        $protocol = $this->protocolService->getProtocolByInvitationID($invitation->id);
        
        $rules = $this->rules();
        $customMessages = $this->messages();
        
        // Validate the request
        $validator = validator()->make($request->all(), $rules, $customMessages);

        # Remove old participants if any
        Participants::where('invitation_id', $invitation->id)->delete();

        # Update with new participants if any
        $participantsInput = $request->input('participants');
        if ($participantsInput) {
            $participants = str_replace(' - ', ' ', $participantsInput);

            $partArray = explode(PHP_EOL, $participants);
            foreach($partArray as $part) {
                $participantsArray = preg_split('/\t+/', $part);
                for ($i=0; $i < count($participantsArray); $i+=3) {
                    $arr = explode(" ", $participantsArray[0]);
                    $batch = array_slice($arr, $i, 3);
                    $apartment = $batch[0];
                    $person = $batch[1];
                    $parts = (float) $batch[2];

                    $participant = new Participants();
                    $participant->apartment = $apartment;
                    $participant->person = $person;
                    $participant->parts = $parts;
                    $participant->invitation_id = $invitation->id;
                    $participant->save();
                }
            }
        }

        if ($validator->fails()) {
            return redirect()->route('protocols.create', ['inv_key' => $inv_key])->withErrors($validator)
            ->withInput();
        }

        $protocol->start_time = $invitation['meet_time'];
        $protocol->end_time = $request->input('end_time');
        $protocol->meetQuorum1 = $request->input('meetQuorum1');
        $protocol->meetQuorum2 = $request->input('meetQuorum2');
        $protocol->minuteman = $request->input('minuteman');
        $protocol->save();
    
        $inputs = $request->input();
        foreach($inputs as $key => $val) {
            # Update agendas points
            if (str_contains($key, '-')) {
                $agendaArray = explode('-', $key);
                $agendaID = (int) $agendaArray[0];
                $agendaItem = Agenda::findOrFail($agendaID);
                if ($agendaArray[1] == 'approves') {
                    $agendaItem->approves = (int) $val;
                } else if ($agendaArray[1] == 'refuses') {
                    $agendaItem->refuses = (int) $val;
                } else if ($agendaArray[1] == 'abstain') {
                    $agendaItem->abstain = (int) $val;
                }
                
                $agendaItem->save();
            }
        }

        return redirect()->route('protocols.update', $invitation->inv_key)->with(
            'success', 'Протоколът е обновен успешно!'
        );
    }

    private function createProtocolDocument($protocol)
    {
        $invitation = $protocol->invitation;
        Settings::setZipClass(Settings::PCLZIP);

        // Load the document template
        $templateFile = resource_path('protocol.docx');
        $templateProcessor = new TemplateProcessor($templateFile);

        $templateProcessor->setValue('manager', $invitation->manager);
        $templateProcessor->setValue('address', $invitation->address);
        $templateProcessor->setValue('location', $protocol->location);
        $templateProcessor->setValue('meetQuorum1', $protocol->meetQuorum1);
        $templateProcessor->setValue('meetQuorum2', $protocol->meetQuorum2);
        $templateProcessor->setValue('stick_place', $invitation->stick_place);
        $templateProcessor->setValue('minuteman', $protocol->minuteman);

        $meet_date = Carbon::parse($protocol->meet_date)->format('d.m.Y');
        $templateProcessor->setValue('meet_date', $meet_date);
        
        $meet_time = Carbon::parse($invitation->meet_time)->format('H:i');
        $templateProcessor->setValue('meet_time', $meet_time);

        $start_time = Carbon::parse($invitation->start_time)->format('H:i');
        $templateProcessor->setValue('start_time', $start_time);

        $start_time_plus_1 = Carbon::parse($protocol->start_time)->addHour()->toTimeString();
        $templateProcessor->setValue('start_time_plus_1', $start_time_plus_1);

        $end_time = Carbon::parse($invitation->end_time)->format('H:i');
        $templateProcessor->setValue('end_time', $end_time);

        $templateProcessor->setValue('notes', $protocol->notes);

        # blocks
        $replacements = array();
        $votingOuter = array();
        $participantsArray = array();

        $participants = Participants::where('invitation_id', $invitation->id)->get();
        $partInner = array();
        foreach($participants as $participant) {
            $partInner['apartment'] = $participant->apartment;
            $partInner['parts'] = $participant->parts;
            $partInner['person'] = $participant->person;
            array_push($participantsArray, $partInner);
        }


        $innerArray = array();
        foreach ($invitation->agendas as $agenda){
            $innerArray['name'] = $agenda['name'];
            $innerArray['approves'] = $agenda['approves'];
            $innerArray['refuses'] = $agenda['refuses'];
            $innerArray['abstain'] = $agenda['abstain'];
            array_push($replacements, $innerArray);

            # Participants:
            # списък присъстващи: ['apartment', 'person', 'parts', 'invitation_id', ]
            # Agendas:
            # Дневен ред (точки): ['name', 'approves', 'refuses', 'abstain', 'invitation_id',]
            # Voting:
            # Гласуване: ['agenda_id', 'participant_id','voting',]
            $participants = Participants::where('invitation_id', $invitation->id)->get();
            foreach ($participants as $participant) {
                $participantVoting = Voting::where('agenda_id', $agenda->id)
                ->where('participant_id', $participant->id)
                ->first();

                $votingInner = array();
                $votingInner['agenda_name'] = $agenda->name;
                $votingInner['apartment'] = $participant->apartment;

                if ($participantVoting) {
                $voting = 'За';
                if ($participantVoting->voting == 'refuses') {
                    $voting = 'Против';
                } elseif ($participantVoting->voting == 'abstain') {
                    $voting = 'Въздържал се';
                }
                $votingInner['voting'] = $voting;
                
                array_push($votingOuter, $votingInner);
                }
            }
        }

        $templateProcessor->cloneBlock('agendas', 0, true, false, $replacements);
        $templateProcessor->cloneBlock('votes', 0, true, false, $votingOuter);
        $templateProcessor->cloneBlock('participants', 0, true, false, $participantsArray);

        // Save the modified document
        $templateProcessor->saveAs('protocol.docx');
    }


    public function download(string $inv_key) : BinaryFileResponse
    {
        $invitation = $this->invitationService->getInvitationByKey($inv_key);
        $protocol = $this->protocolService->getProtocolByInvitationID($invitation->id);
        if ($protocol) {
            $this->createProtocolDocument($protocol);
            return response()->download(public_path('protocol.docx'));
        }
        return abort(404);
    }

    public function downloadPdf(string $inv_key)
    {
        
        $invitation = $this->invitationService->getInvitationByKey($inv_key);
        $protocol = $this->protocolService->getProtocolByInvitationID($invitation->id);
        $agendas = $this->invitationService->getAgendas($invitation);
        $voting = $this->protocolService->getVotingByInvitationID($invitation->id);

        # parse meet_time, start_time, start_time_plus_1 with format
        $protocol->start_time = Carbon::parse($protocol->start_time)->format('H:i');
        $protocol->start_time_plus_1 = Carbon::parse($protocol->start_time)->addHour()->format('H:i');
        $protocol->end_time = Carbon::parse($protocol->end_time)->format('H:i');

        $protocol->meet_date = Carbon::parse($protocol->meet_date)->format('d.m.Y');
        $invitation->meet_time = Carbon::parse($invitation->meet_time)->format('H:i');
        $invitation->meet_date = Carbon::parse($invitation->meet_date)->format('d.m.Y');

        $participantsArray = array();

        $participants = Participants::where('invitation_id', $invitation->id)->get();
        $partInner = array();
        foreach($participants as $participant) {
            $partInner['apartment'] = $participant->apartment;
            $partInner['parts'] = $participant->parts;
            $partInner['person'] = $participant->person;
            array_push($participantsArray, $partInner);
        }

        $data = array(
            'protocol' => $protocol,
            'invitation' => $invitation,
            'agendas' => $agendas,
            'voting' => $voting,
            'participants' => $participants,
        );
        $pdf = Pdf::loadView('protocols.protocol', $data);

        return $pdf->download('protocol.pdf');   
    }

    public function rules(): array
    {
        return [
            'end_time' => 'required',
            'meetQuorum1' => 'required|numeric',
            'meetQuorum2' => 'required|numeric',
            'minuteman' =>  'string',
        ];
    }

    public function messages(): array
    {
        return [
            'end_time.required' => 'Краен час е задължително поле',
            'meetQuorum1.required' => 'Кворум час 1 (%) е задължително поле',
            'meetQuorum2.required' => 'Кворум час 2 (%) е задължително поле.',
            'minuteman.required' => 'Протоколчик e задължително поле.',
        ];
    }

    public function showVoting(string $inv_key)
    {
        $invitation = $this->invitationService->getInvitationByKey($inv_key);
        $protocol = Protocol::where('invitation_id', $invitation->id)->first();
        $agendas = $invitation->agendas;
        $participants = Participants::where('invitation_id', $invitation->id)->get();
        $data = [
            'protocol' => $protocol,
            'invitation' => $invitation,
            'agendas' => $agendas,
            'participants' => $participants,
            'meetQuorum2' => $protocol->meetQuorum2,
        ];

        return view('protocols.voting', $data);
    }

    public function storeVoting(Request $request)
    {
        $inputs = $request->input();
        $protocol_id = (int) $request->input('protocol_id');
        $protocol = Protocol::where('id', $protocol_id)->first();
        $invitation = $protocol->invitation;

        // $example= [
        //     _token: "NYcdaKzpxm6YJN7bVhUQO1ruGVrUo860t1rfc8a5"
        //     1-agenda-18: "abstain"
        //     1-agenda-19: "refuses"
        //     2-agenda-18: "refuses"
        //     2-agenda-19: "approves"
        // ]
        foreach($inputs as $key => $val) {
            $voting = new Voting();

            if (str_contains($key, '-')) {
                $partAgendasArray = explode('-', $key);
                if (count($partAgendasArray) == 2 ){
                    $agenda_id = (int) $partAgendasArray[0];
                } else {
                    $participant_id = (int) $partAgendasArray[0];
                    $agenda_id = (int) $partAgendasArray[2];
                    $voting->participant_id = $participant_id;
                }


                
                $voting->agenda_id = $agenda_id;
                $voting->voting = $val;
                $voting->save();
            }
        }

        return redirect()->route('protocols.update', $invitation->inv_key)->with(
            'success', 'Гласуването е записано успешно!'
        );
    }
}
