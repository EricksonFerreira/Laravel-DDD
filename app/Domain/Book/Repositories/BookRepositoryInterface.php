<?php
namespace App\Domain\Book\Repositories;

use App\Domain\Book\Entities\Book;

interface BookRepositoryInterface
{
    public function getAll();

    public function findByIsbn(int $isbn): Book;

    public function create(Book $book): void;

    public function update(Book $book): void;

    public function delete(Book $book): void;

}
