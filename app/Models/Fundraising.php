<?php

namespace App\Models;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Support\Facades\DB;
use App\Models\CampaignByFundraiser;
use App\Models\DonationByFundraiser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fundraising extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'fundraisings';

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
    public function campaign()
    {
        return $this->belongsTo(Campaign::class,'id');
    }
    public function DonationByFundraiser()
    {
        return $this->hasMany(DonationByFundraiser::class,'fundraising_id');
    }
    public function CampaignByFundraiser($user_id, $campaign_id){
        return DB::table('fundraisings')
        ->where('user_id', '=', $user_id)
        ->where('campaign_id', '=',$campaign_id )
        ->get();
    }
}
