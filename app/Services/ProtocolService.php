<?php

namespace App\Services;

use App\Models\Invitation;
use App\Models\Protocol;
use App\Models\Participants;
use App\Models\Voting;


class ProtocolService
{
    public function getProtocolByInvitationID(int $invitation_id)
    {
        $protocol = Protocol::where('invitation_id', $invitation_id)->first();
        return $protocol;
    }

    public function getVotingByInvitationID(int $invitation_id) 
    {
        $invitation = Invitation::where('id', $invitation_id)->first();

        $voting = array();
        foreach ($invitation->agendas as $agenda){
            $participants = Participants::where('invitation_id', $invitation->id)->get();
            foreach ($participants as $participant) {
                $participantVoting = Voting::where('agenda_id', $agenda->id)
                ->where('participant_id', $participant->id)
                ->first();

                $votingInner = array();
                $votingInner['agenda_name'] = $agenda->name;
                $votingInner['participant_apartment'] = $participant->apartment;
                # $votingInner['participant_person'] = $participant->person;
                $votingInner['voting'] = $participantVoting->voting;
                
                array_push($voting, $votingInner);
            }
        }

        return $voting;
    }
}