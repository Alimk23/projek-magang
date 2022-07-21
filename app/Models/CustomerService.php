<?php

namespace App\Models;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerService extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'customer_services';

    public function campaign()
    {
        return $this->belongsTo(Campaign::class,'cs_id','id');
    }
}
