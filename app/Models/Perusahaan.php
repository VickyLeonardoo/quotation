<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function quotation(){
        return $this->hasMany(Quotation::class);
    }
}
