<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arsip extends Model
{
    use SoftDeletes;
    protected $table = 'arsip';
    protected $fillable = [
        'code', 'nama', 'bidang_id', 'tgl_registrasi', 'tgl_expire', 'status', 'filename', 'path'
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::Class, 'bidang_id');
    }
}
