<?php

namespace App\Application\Http\Controllers;

use App\Application\Http\Requests\BookCreateRequest;
use App\Application\Http\Requests\BookUpdateRequest;
use App\Domain\Book\Services\BookService;
use App\Application\Http\Controllers\Controller;

class BookController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService->getAllBooks();
        return response()->json($books, 201);
    }

    public function store(BookCreateRequest $request)
    {
        $this->bookService->createBook($request->name, $request->isbn, $request->value);
        $book = $this->bookService->findByIsbn($request->isbn);
        return response()->json($book, 201);
    }

    public function update(BookUpdateRequest $request,string $isbn)
    {
        $this->bookService->updateBook($request->name, $isbn, $request->value);
        $book = $this->bookService->findByIsbn($isbn);
        return response()->json($book, 201);
    }

    public function destroy(string $isbn)
    {
        $this->bookService->deleteBook($isbn);
        return response()->json("Item with ISBN: $isbn deleted successfully!", 201);
    }
}
