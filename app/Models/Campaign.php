<?php

namespace App\Models;

use App\Models\News;
use App\Models\User;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];
    protected $table= 'campaign';
    
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
        return $this->hasMany(Donation::class);
    }
    public function news()
    {
        return $this->hasMany(News::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
