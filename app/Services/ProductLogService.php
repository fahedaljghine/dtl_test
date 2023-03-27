<?php

namespace App\Services;

use App\Models\ProductLog;
use App\Enums\ActionType;
use function Nette\Utils\match;

class ProductLogService
{

    public static function handle(int $productId, string $action, array $payload = [], array $old = []): ?ProductLog
    {
        return match($action){
            ActionType::CREATE->value => self::createAction($productId, $payload),
            ActionType::UPDATE->value => self::updateAction($productId, $payload, $old),
            ActionType::DELETE->value => self::deleteAction($productId),
            ActionType::RESTORE->value => self::restoreAction($productId),
            ActionType::FORCE_DELETE->value => self::forceDeleteAction($productId),
        };
    }

    private static function createAction(int $productId, array $payload = [])
    {
        return ProductLog::create([
            'action' => ActionType::CREATE->value,
            'properties' => array('attributes' => $payload),
            'product_id' => $productId,
            'user_id' => auth()->user()->id,
        ]);
    }

    private static function updateAction(int $productId, array $payload = [], array $old = [])
    {
        return ProductLog::create([
            'action' => ActionType::UPDATE->value,
            'properties' => array('old' => $old, 'attributes' => $payload),
            'product_id' => $productId,
            'user_id' => auth()->user()->id,
        ]);
    }

    private static function deleteAction(int $productId)
    {
        return ProductLog::create([
            'action' => ActionType::DELETE->value,
            'properties' =>array(),
            'product_id' => $productId,
            'user_id' => auth()->user()->id,
        ]);
    }

    private static function restoreAction(int $productId)
    {
        return ProductLog::create([
            'action' => ActionType::RESTORE->value,
            'properties' =>array(),
            'product_id' => $productId,
            'user_id' => auth()->user()->id,
        ]);
    }

    private static function forceDeleteAction(int $productId)
    {
        return ProductLog::create([
            'action' => ActionType::FORCE_DELETE->value,
            'properties' =>array(),
            'product_id' => $productId,
            'user_id' => auth()->user()->id,
        ]);
    }
}
