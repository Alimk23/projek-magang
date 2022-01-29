<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationStatus extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'registration_statuses';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}