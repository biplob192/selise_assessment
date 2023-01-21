<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;

class BookController extends BaseController
{
    public function index()
    {
        $book = Book::get();
        return $this->sendResponse($book, 'All book data.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'author' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        DB::beginTransaction();
        try {
            $book = new Book();

            $book->name = $request->name;
            $book->author = $request->author;
            $book->price = $request->price;
            $book->save();

            DB::commit();
            return $this->sendResponse($book, 'Book created successfully.', 201);
        } catch (Exception $e) {
            DB::rollBack();

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }

    public function show($id)
    {
        return Book::find($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // return 'ok';
        DB::beginTransaction();
        try {
            $book = Book::find($id);
            $book->update($request->all());

            return $book;
            DB::commit();
            return $this->sendResponse($book, 'Book updated successfully.', 204);
        } catch (Exception $e) {
            DB::rollBack();

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Book::find($id)->delete();

            DB::commit();
            return $this->sendResponse("", 'Book deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }
}
