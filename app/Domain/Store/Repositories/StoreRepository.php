<?php
namespace App\Domain\Store\Repositories;

use App\Application\Exceptions\ValidationException;
use App\Domain\Store\Entities\Store;
use App\Domain\Store\Repositories\StoreRepositoryInterface;

class StoreRepository implements StoreRepositoryInterface
{
    private $model;

    public function __construct(Store $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->with('books')->get();
    }

    public function findById($id): Store
    {
        $store = $this->model->where('id', $id)->first();

        if (!$store) {
            throw new ValidationException(['store' => ['Store does not exist']]);
        }

        return $store;
    }

    public function create(Store $store): Store
    {
        $store->save();
        return $store;
    }

    public function update(Store $store): Store
    {
        $store->update();
        return $store;
    }

    public function delete(Store $store): void
    {
        $store->delete();
    }

      public function addBookToStore(int $storeId, int $bookId): void
    {
        $store = $this->findById($storeId);
        $store->books()->attach($bookId);
    }

    public function removeBookFromStore(int $storeId, int $bookId): void
    {
        $store = $this->findById($storeId);
        $store->books()->detach($bookId);
    }
    public function getBooksByStoreId(int $storeId)
    {
        $store = $this->findById($storeId);
        return $store->books;
    }

    public function hasBook(int $storeId, $isbn) {
        $store = $this->findById($storeId);
        return $store->books->contains('isbn', $isbn);

    }
}
