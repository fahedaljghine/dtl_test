<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ActionType;

class ProductLog extends Model
{
    protected $fillable = [
        'action',
        'properties',
        'product_id',
        'user_id'
    ];

    protected $casts = [
        'action' => ActionType::class,
        'properties' => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)
            ->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
