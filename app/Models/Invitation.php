<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Agenda;

class Invitation extends Model
{
    protected $table = 'invitations';
    protected $fillable = [
        'manager',
        'reason',
        'address',
        'meet_date',
        'meet_time',
        'location',
        'stick_place',
        'inv_key',
    ];

    /**
     * Get the agendas associated with the invitation.
     */
    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }

    public function agendasByInvitation(string $inv_key) 
    {
        return $this->agendas()->where('inv_key', $inv_key);
    }
}
