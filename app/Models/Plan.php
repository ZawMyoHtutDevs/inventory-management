<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product',
        'user',
        'supplier',
        'category',
        'brand',
        'customer',
        'pricing',
        'currency_type',
        'time',
    ];

    public function agencies()
    {
        return $this->hasMany(\App\Models\Agency::class, 'plan_id');
    }

}
