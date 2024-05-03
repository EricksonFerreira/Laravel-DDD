<?php

namespace App\Domain\Store\Services;

use App\Application\Exceptions\ValidationException;
use App\Domain\Book\Repositories\BookRepositoryInterface;
use App\Domain\Store\Entities\Store;
use App\Domain\Store\Repositories\StoreRepositoryInterface;

class StoreService
{
    private $storeRepository;
    private $bookRepository;

    public function __construct(StoreRepositoryInterface $storeRepository, BookRepositoryInterface $bookRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->bookRepository = $bookRepository;
    }

    public function getAllStores()
    {
        return $this->storeRepository->getAll();
    }

    public function findById($id)
    {
        return $this->storeRepository->findById($id);
    }

    public function createStore(string $name, string $address, bool $active): Store
    {
        $store = new Store();
        $store->setName($name);
        $store->setAddress($address);
        $store->setActive($active);

        return $this->storeRepository->create($store);
    }

    public function updateStore($id, string $name, string $address, bool $active): Store
    {
        $store = $this->storeRepository->findById($id);
        $store->setName($name);
        $store->setAddress($address);
        $store->setActive($active);

        return $this->storeRepository->update($store);
    }

    public function deleteStore($id): void
    {
        $store = $this->storeRepository->findById($id);
        $this->storeRepository->delete($store);
    }

    public function addBookToStore($storeId, $isbn)
    {
        $this->validacaoBookToStore($storeId, $isbn);

        if ($this->storeRepository->hasBook($storeId, $isbn)) {
            throw new ValidationException(['isbn' => ['This store already has this book']]);
        }

        $this->storeRepository->addBookToStore($storeId, $isbn);
    }

    public function removeBookFromStore($storeId, $isbn)
    {
        $this->validacaoBookToStore($storeId, $isbn);
        $this->storeRepository->removeBookFromStore($storeId, $isbn);
    }

    public function getBooksByStoreId($storeId)
    {
        $this->storeRepository->getBooksByStoreId($storeId);
        $store = $this->storeRepository->findById($storeId);
        return $store->books;
    }

    private function validacaoBookToStore($storeId, $isbn){
        $this->storeRepository->findById($storeId);

        if (!is_numeric($isbn)) {
            throw new ValidationException(['isbn' => ['ISBN must be numeric']]);
        }

        $this->bookRepository->findByIsbn($isbn);

    }
}
