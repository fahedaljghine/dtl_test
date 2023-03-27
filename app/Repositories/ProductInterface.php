<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductInterface
{

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filter(): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    /**
     * @param int $id
     * @return Product|null
     */
    public function find(int $id): ?Product;

    public function create(array $payload = []): ?Product;

    /**
     * @param int $id
     * @param array $payload
     * @return bool
     */
    public function update(int $id, array $payload = []): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function restore(int $id): bool;
}
