<?php

namespace App\Services;

use App\Models\Invitation;

class InvitationService
{
    public function getInvitationByKey(string $inv_key)
    {
        $invitation = Invitation::where('inv_key', $inv_key)->first();
        return $invitation;
    }

    public function getAgendas($invitation)
    {
        $agendas = array();

        $innerArray = array();
        foreach ($invitation->agendas as $agenda){
            $innerArray['name'] = $agenda['name'];
            $innerArray['approves'] = $agenda['approves'];
            $innerArray['refuses'] = $agenda['refuses'];
            $innerArray['abstain'] = $agenda['abstain'];
            array_push($agendas, $innerArray);
        }
        return $agendas;
    }
}
