<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $table = 'agendas_participants';
    protected $fillable = [
        'agenda_id',
        'participant_id',
        'voting',
    ];
}
