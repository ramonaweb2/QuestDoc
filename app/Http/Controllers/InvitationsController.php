<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invitation;
use App\Models\Agenda;

use App\Services\InvitationService;
use App\Services\ProtocolService;

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
use Barryvdh\DomPDF\Facade\Pdf;


use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Carbon\Carbon;

class InvitationsController extends Controller
{
    private InvitationService $invitationService;
    private ProtocolService $protocolService;

    public function __construct(InvitationService $invitationService, ProtocolService $protocolService)
    {
        $this->invitationService = $invitationService;
        $this->protocolService = $protocolService;
    }


    /**
     * Show the form for creating a new invitation.
     */
    public function create()
    {
        return view('pages.index');
    }

    /**
     * Store a newly created invitation.
     */
    public function store(Request $request)
    {
        $rules = [
            'manager' => 'required|string|min:1|max:255',
            'address' => 'required',
            'location' => 'required|string|min:1|max:255',
            'meet_date' => 'required|date|after:now',
            'meet_time' => 'required',
            'stick_place' => 'required|string|min:1|max:255',
            'agenda_id' => 'required|array',
            'agenda_id.*' => 'required|string',
        ];

        // Custom error messages
        $customMessages = [
            'manager.required' => 'Управител на ЕС е задължително поле',
            'address.required' => 'Адрес е задължително поле',
            'location.required' => 'Локация на събрание е задължително поле.',
            'meet_date.required' => 'Дата на събрание e задължително поле.',
            'meet_date.date' => 'Дата на събрание трябва да бъде дата.',
            'meet_date.after' => 'Дата на събрание трябва да е след текущата дата.',
            'meet_time.required' => 'Час на събрание e задължително поле.',
            'stick_place' => 'Къде се разлепя поканата е задължително поле.',
        ];

        // Validate the request
        $validator = validator()->make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // If the request passes validation, create the record
        $invitation = new Invitation();
        $invitation->manager = $request->input('manager');
        $invitation->reason = $request->input('reason');
        $invitation->address = $request->input('address');
        $invitation->meet_date = $request->input('meet_date');
        $invitation->meet_time = $request->input('meet_time');
        $invitation->location = $request->input('location');
        $invitation->stick_place = $request->input('stick_place');
        $inv_key = md5(uniqid(rand(), true));
        $invitation->inv_key = $inv_key;
        $invitation->save();

        $agendas = $request->input('agenda_id');
        foreach($agendas as $agenda) {
            $agendaItem = new Agenda();
            $agendaItem->name = $agenda;
            $agendaItem->invitation_id = $invitation->id;
            $agendaItem->save();
        }

        return response()->json([
            'success' => true,
            'message' => "Поканата е създадена успешно!\nКлюч: {$inv_key}",
        ]);
    }

    private function createInvitationDocument($invitation)
    {
        Settings::setZipClass(Settings::PCLZIP);

        // Load the document template
        $templatePath = resource_path('invitation.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('manager', $invitation->manager);

        $reasonText = 'чл. 12 ал. 1 и чл. 13 от ЗУЕС';
        if ($invitation->reason == 'option2') {
            $reasonText = 'Опция 2';
        } else if ($invitation->reason == 'option3') {
            $reasonText = 'Опция 3';
        } 

        $templateProcessor->setValue('reason', $reasonText);
        $templateProcessor->setValue('address', $invitation->address);
        
        $meet_date = Carbon::parse($invitation->meet_date)->format('d.m.Y');
        $templateProcessor->setValue('meet_date', $meet_date);

        $meet_time = Carbon::parse($invitation->meet_time)->format('H:i');
        $templateProcessor->setValue('meet_time', $meet_time);

        $templateProcessor->setValue('location', $invitation->location);
        $templateProcessor->setValue('stick_place', $invitation->stick_place);

        $agendas = $invitation->agendas;
        $agendasArray = array();
        $agendaInnerArray = array();
        foreach($agendas as $key => $agenda) {
            $index = $key + 1;
            $agendaInnerArray['index'] = $index;
            $agendaInnerArray['item'] = $agenda['name'];
            array_push($agendasArray, $agendaInnerArray);
        }
        $templateProcessor->cloneBlock('agendas', 0, true, false, $agendasArray);

        // Save the modified document
        $templateProcessor->saveAs('invitation.docx');
    }

    /**
     * Show form to enter invitation key
     */
    public function show()
    {
        return view('invitations.show');
    }

    public function display(Request $request)
    {
        $inv_key = $request->inv_key;
        $invitation = $this->invitationService->getInvitationByKey($inv_key);

        return view('invitations.display',['invitation' => $invitation]);
    }

    public function download(string $inv_key) : BinaryFileResponse
    {
        $invitation = $this->invitationService->getInvitationByKey($inv_key);
        $this->createInvitationDocument($invitation);
        return response()->download(public_path('invitation.docx'));
    }

    public function downloadPdf(string $inv_key) {
        
        $invitation = $this->invitationService->getInvitationByKey($inv_key);
        $invitationData = $this->processInvitationData($invitation);
        $protocol = $this->protocolService->getProtocolByInvitationID($invitation->id);
        $agendas = $this->invitationService->getAgendas($invitation);

        $data = array(
            'protocol' => $protocol,
            'invitation' => $invitationData,
            'agendas' => $agendas,
        );
        $pdf = Pdf::loadView('invitations.invitation', $data);

        return $pdf->download('invitation.pdf');   
    }

    private function processInvitationData($invitation)
    {
        Settings::setZipClass(Settings::PCLZIP);

        $invitationData = array();

        // Load the document template
        $templatePath = resource_path('invitation.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('manager', $invitation->manager);

        $reasonText = 'чл. 12 ал. 1 и чл. 13 от ЗУЕС';
        if ($invitation->reason == 'option2') {
            $reasonText = 'Опция 2';
        } else if ($invitation->reason == 'option3') {
            $reasonText = 'Опция 3';
        } 

        $templateProcessor->setValue('reason', $reasonText);
        $templateProcessor->setValue('address', $invitation->address);
        
        $meet_date = Carbon::parse($invitation->meet_date)->format('d.m.Y');
        $templateProcessor->setValue('meet_date', $meet_date);

        $meet_time = Carbon::parse($invitation->meet_time)->format('H:i');
        $templateProcessor->setValue('meet_time', $meet_time);

        $templateProcessor->setValue('location', $invitation->location);
        $templateProcessor->setValue('stick_place', $invitation->stick_place);

        $invitationData = array(
            'manager' => $invitation->manager,
            'reason' => $reasonText,
            'address' => $invitation->address,
            'meet_date' => $meet_date,
            'meet_time' => $meet_time,
            'location' => $invitation->location,
            'stick_place' => $invitation->stick_place,
        );
        return $invitationData;
    }
}
