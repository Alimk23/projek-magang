<?php

namespace App\Models;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'companies';

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
