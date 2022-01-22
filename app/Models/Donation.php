<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\Campaign;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'donations';

    public function campaign()
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
    public function payment()
    {
        return $this->hasMany(Payment::class,'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function DonationByFundraiser()
    {
        return $this->hasMany(DonationByFundraiser::class,'donation_id');
    }
    public function getPayment($donation_id){
        return DB::table('payments')
        ->where('donation_id', '=',$donation_id )
        ->get();
    }
}
