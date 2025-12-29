<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    //
    protected $guarded = [];
    public function gambartentangs()
    {
        return $this->hasMany(Gambartentang::class, 'tentang_id');
    }
}
