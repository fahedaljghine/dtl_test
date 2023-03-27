<?php

namespace App\Repositories;

use App\Models\Product;
use App\Enums\ProductStatus;

class ProductRepository implements ProductInterface
{

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Product::paginate(config('dtl_test.pagination'));
    }

    public function find(int $id): ?Product
    {
        return Product::findOrFail($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filter(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Product::query();

        if (request()->has('product_name')) {
            $query->where('name', 'like', '%' . request('product_name') . '%');
        }

        if (request()->has('person_name')) {
            $query->whereHas('user', function ($query) {
                return $query->where('name', 'like', '%' . request('person_name') . '%');
            });
        }

        return $query->paginate(config('dtl_test.pagination'));
    }

    /**
     * @param array $payload
     * @return Product|null
     */
    public function create(array $payload = []): ?Product
    {
        $payload['user_id'] = auth()->user()->id ;
        $payload['status'] = ProductStatus::PENDING->value ;
        return Product::create($payload);
    }

    /**
     * @param int $id
     * @param array $payload
     * @return bool
     */
    public function update(int $id, array $payload = []): bool
    {
        return $this->find($id)
            ->update($payload);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->find($id)
            ->delete();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function restore(int $id): bool
    {
        return $this->find($id)
            ->restore();
    }
}
