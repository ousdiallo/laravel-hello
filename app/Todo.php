<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Todo extends Model
{
    use Notifiable;

    protected $fillable = [
        'name', 'description', 'done'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }

    /**
     * Get the user affected to this todo
     */
    public function todoAffectedTo()
    {
        return $this->belongsTo('App\User', 'affectedTo_id');
    }

    /**
     * Get the user who has affected this 
     */
    public function todoAffectedBy()
    {
        return $this->belongsTo('App\User', 'affectedBy_id');
    }
}
