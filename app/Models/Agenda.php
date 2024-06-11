<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agendas';
    protected $fillable = [
        'name',
        'approves',
        'refuses',
        'abstain',
        'invitation_id',
    ];
}
