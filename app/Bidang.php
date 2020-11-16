<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bidang extends Model
{
    use SoftDeletes;
    protected $table = "Bidang";
    protected $fillable = ['nama_bidang'];

    public function arsips()
    {
        return $this->hasMany(Arsip::Class, 'bidang_id');
    }
}
