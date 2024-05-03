<?php
namespace App\Application\Http\Controllers;

use App\Application\Http\Requests\StoreCreateRequest;
use App\Application\Http\Requests\StoreUpdateRequest;
use App\Domain\Store\Services\StoreService;
use App\Application\Http\Controllers\Controller;

class StoreController extends Controller
{
    private $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }
    public function index()
    {
        return $this->storeService->getAllStores();
    }

    public function store(StoreCreateRequest $request)
    {
        $store = $this->storeService->createStore($request->name, $request->address, $request->active);
        return response()->json($store, 201);

    }

    public function update(StoreUpdateRequest $request, $id)
    {
        $this->storeService->updateStore($id,$request->name, $request->address, $request->active);
        $store = $this->storeService->findById($id);
        return response()->json($store, 201);
    }

    public function destroy($id)
    {
        $this->storeService->deleteStore($id);
        return response()->json("Item with Store: $id deleted successfully!", 201);
    }


    public function addBook($storeId, $isbn)
    {
        $this->storeService->addBookToStore($storeId, $isbn);
        $store = $this->storeService->findById($storeId);
        return response()->json("Book with ISBN: $isbn added successfully to store: '$store->name'!", 201);
    }

    public function removeBook($storeId, $isbn)
    {
        $this->storeService->removeBookFromStore($storeId, $isbn);
        $store = $this->storeService->findById($storeId);
        return response()->json("Book with ISBN: $isbn removed successfully of store: '$store->name'!", 201);
    }
}
