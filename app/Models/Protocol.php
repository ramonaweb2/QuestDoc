<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    protected $table = 'protocols';
    protected $fillable = [
        'start_time',
        'meetQuorum1',
        'meetQuorum2',
        'minuteman',
        'end_time',
        'notes',
        'invitation_id'
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }

    public function participants()
    {
        return $this->hasMany(Participants::class);
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }
}
