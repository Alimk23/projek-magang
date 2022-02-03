<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\User;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Withdraw extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'withdraws';

    public function campaign()
    {
        return $this->belongsTo(Campaign::class,'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class,'id');
    }
}
