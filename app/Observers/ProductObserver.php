<?php

namespace App\Observers;

use App\Models\Product;
use App\Notifications\ProductCreated;
use App\Services\ProductLogService;
use App\Enums\ActionType;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $product->user
            ->notify(new ProductCreated($product));

        ProductLogService::handle($product->id, ActionType::CREATE->value , $product->getAttributes());

    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        ProductLogService::handle($product->id, ActionType::CREATE->value , $product->getAttributes() , $product->getOriginal());
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        ProductLogService::handle($product->id, ActionType::DELETE->value);
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        ProductLogService::handle($product->id, ActionType::RESTORE->value);
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        ProductLogService::handle($product->id, ActionType::FORCE_DELETE->value);
    }
}
