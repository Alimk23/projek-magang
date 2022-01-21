<?php

namespace App\Models;

use App\Models\Donation;
use App\Models\Fundraising;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationByFundraiser extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'donation_by_fundraisers';

    public function fundraising()
    {
        return $this->belongsTo(Fundraising::class,'id');
    }
    public function donation()
    {
        return $this->belongsTo(Donation::class,'id');
    }
}
