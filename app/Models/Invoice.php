<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function quotation(){
        return $this->belongsTo(Quotation::class);
    }

    public function delivery(){
        return $this->hasOne(Delivery::class);
    }

    public function log(){
        return $this->hasMany(InvoiceLog::class);
    }
}
