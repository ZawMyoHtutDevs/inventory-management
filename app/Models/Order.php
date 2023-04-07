<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'status',
        'asset',
        'payment_type',
        'total_price',
        'agency_id',
        'plan_id',
        'user_id'
    ];
    public function plan()
    {
        return $this->belongsTo(\App\Models\Plan::class, 'plan_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function agency()
    {
        return $this->belongsTo(\App\Models\Agency::class, 'agency_id');
    }
}
