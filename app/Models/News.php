<?php

namespace App\Models;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'news';

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'id' , 'campaign_id');
    }
}
