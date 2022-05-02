<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoggedtimeUser extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'last_active', 'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}