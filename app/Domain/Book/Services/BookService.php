<?php
namespace App\Domain\Book\Services;

use App\Application\Exceptions\ValidationException;
use App\Domain\Book\Entities\Book;
use App\Domain\Book\Repositories\BookRepositoryInterface;

class BookService
{
    private $repository;

    public function __construct(BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllBooks()
    {
        return $this->repository->getAll();
    }

    public function findByIsbn(int $isbn){
        return $this->repository->findByIsbn($isbn);
    }

    public function createBook(string $name, int $isbn, float $value): void
    {
        $book = new Book();
        $book->setName($name);
        $book->setIsbn($isbn);
        $book->setValue($value);

        $this->repository->create($book);
    }

    public function updateBook(string $name, string $isbn, float $value): void
    {
        if (!is_numeric($isbn)) {
            throw new ValidationException(['isbn' => ['ISBN must be numeric']]);
        }

        $book = $this->repository->findByIsbn($isbn);
        $book->setName($name);
        $book->setValue($value);

        $this->repository->update($book);
    }

    public function deleteBook(int $isbn): void
    {
        $book = $this->repository->findByIsbn($isbn);
        $this->repository->delete($book);
    }
}
