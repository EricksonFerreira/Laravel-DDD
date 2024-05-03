<?php
namespace App\Domain\Book\Repositories;

use App\Application\Exceptions\ValidationException;
use App\Domain\Book\Entities\Book;
use App\Domain\Book\Repositories\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    private $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findByIsbn(int $isbn): Book
    {
        $book = $this->model->where('isbn', $isbn)->first();

        if (!$book) {
            throw new ValidationException(['book' => ['Book does not exist']]);
        }

        return $book;
    }

    public function create(Book $book): void
    {
        $book->save();
    }

    public function update(Book $book): void
    {
        $book->update();
    }

    public function delete(Book $book): void
    {
        $book->delete();
    }
}
