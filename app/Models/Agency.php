<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit_id',
        'business_type',
        'asset',
        'status',
        'start_date',
        'end_date',
        'currency',
        'description',
        'phone',
        'plan_id',
    ];

    public function plan()
    {
        return $this->belongsTo(\App\Models\Plan::class, 'plan_id');
    }

    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'agency_id');
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'agency_id');
    }

    public function customers()
    {
        return $this->hasMany(\App\Models\Customer::class, 'agency_id');
    }

    public function categories()
    {
        return $this->hasMany(\App\Models\Category::class, 'agency_id');
    }

    public function brands()
    {
        return $this->hasMany(\App\Models\Brand::class, 'agency_id');
    }

    public function suppliers()
    {
        return $this->hasMany(\App\Models\Supplier::class, 'agency_id');
    }
}
