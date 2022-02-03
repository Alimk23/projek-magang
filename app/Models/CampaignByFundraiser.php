<?php

namespace App\Models;

use App\Models\Campaign;
use App\Models\Fundraising;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CampaignByFundraiser extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'campaign_by_fundraiser';

    public function campaign()
    {
        return $this->belongsTo(Campaign::class,'id');
    }
    public function fundraising()
    {
        return $this->belongsTo(Fundraising::class,'id');
    }
}
