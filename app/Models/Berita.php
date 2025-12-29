<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    //
    protected $guarded = [];
    public function komentars(){
        return $this->hasMany(Komentar::class, 'berita_id');
    }
}
