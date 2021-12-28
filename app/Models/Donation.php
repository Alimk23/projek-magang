<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'donations';

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
