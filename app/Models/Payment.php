<?php

namespace App\Models;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'payments';
    
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
