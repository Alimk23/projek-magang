<?php

namespace App\Models;

use App\Models\News;
use App\Models\User;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Fundraising;
use App\Models\CustomerService;
use App\Models\CampaignByFundraiser;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];
    protected $table= 'campaign';

    protected $with = 'user';
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function donation()
    {
        return $this->hasMany(Donation::class,'campaign_id','id');
    }
    public function news()
    {
        return $this->hasMany(News::class,'campaign_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function cs()
    {
        return $this->hasOne(CustomerService::class, 'id', 'cs_id');
    }
    public function withdraw()
    {
        return $this->hasOne(Withdraw::class, 'campaign_id');
    }
    public function fundraising()
    {
        return $this->hasMany(Fundraising::class,'campaign_id','id');
    }
}
