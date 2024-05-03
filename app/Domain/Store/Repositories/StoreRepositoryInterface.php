<?php

namespace App\Domain\Store\Repositories;

use App\Domain\Store\Entities\Store;

interface StoreRepositoryInterface
{
    public function getAll();

    public function findById(int $id): Store;

    public function create(Store $store): Store;
    public function update(Store $store): Store;

    public function delete(Store $store): void;

    public function addBookToStore(int $storeId, int $bookId): void;

    public function removeBookFromStore(int $storeId, int $bookId): void;

    public function getBooksByStoreId(int $storeId);
    public function hasBook(int $storeId, $isbn);

}
