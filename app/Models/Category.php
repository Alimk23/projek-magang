<?php

namespace App\Models;

use App\Models\Campaign;
use App\Models\CategoryByUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'categories';

    public function campaign()
    {
        return $this->hasMany(Campaign::class);
    }
}
