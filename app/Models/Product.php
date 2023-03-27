<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ProductStatus;
use App\Enums\ProductType;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'status',
        'type',
        'user_id'
    ];

    protected $casts = [
        'status' => ProductStatus::class,
        'type' => ProductType::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
