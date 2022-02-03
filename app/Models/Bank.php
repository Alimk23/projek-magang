<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'banks';

    public function payment()
    {
        return $this->hasMany(Payment::class,'bank_id');
    }
    public function withdraw()
    {
        return $this->hasOne(Withdraw::class, 'campaign_id');
    }
}
