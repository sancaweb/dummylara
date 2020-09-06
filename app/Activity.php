<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Activity extends Model
{
    protected $table = "activity_log";

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'causer_id');
    }
}
