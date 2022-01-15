<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGrade extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'user_grades';

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
}
