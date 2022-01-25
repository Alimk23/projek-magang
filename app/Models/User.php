<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Profile;
use App\Models\Donation;
use App\Models\Withdraw;
use App\Models\UserGrade;
use App\Models\Fundraising;
use App\Models\UserProfile;
use App\Models\CategoryByUser;
use Laravel\Sanctum\HasApiTokens;
use App\Models\RegistrationStatus;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function donation()
    {
        return $this->hasMany(Donation::class,'user_id');
    }
    public function campaign()
    {
        return $this->hasOne(Campaign::class);
    }
    public function company()
    {
        return $this->hasOne(Company::class, 'user_id');
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function UserGrade()
    {
        return $this->hasMany(UserGrade::class, 'user_id');
    }
    public function withdraw()
    {
        return $this->hasOne(Withdraw::class, 'user_id');
    }
    public function UserProfile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }
    public function RegistrationStatus()
    {
        return $this->hasMany(RegistrationStatus::class,'user_id');
    }
    public function fundraising()
    {
        return $this->belongsTo(Fundraising::class,'user_id');
    }
}
