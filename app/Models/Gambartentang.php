<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gambartentang extends Model
{
    //
    protected $guarded = [];
    public function tentang(){
        return $this->belongsTo(Tentang::class, 'tentang_id');
    }
}
