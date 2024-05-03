<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Utilities\ApiResponse;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   try {
            return ApiResponse::success('Get Books Successfully', Book::all(), 200);
        } catch (\Throwable $th) {
            return ApiResponse::error("Get all books operation failed", $th->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validateBook = Validator::make($request->all(),[
                'title' => 'required|max:30',
                'author' => 'required|max:20',
                'publication_year' => 'required|',
                'ISBN' => 'required|regex:/^[0-9]{13}$/|unique:App\Models\Book,ISBN',
            ]);

            if($validateBook->fails()){
                return ApiResponse::error('Validation error', $validateBook->errors(), 400);
            }

            $book = Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'publication_year' => $request->publication_year,
                'ISBN' => $request->ISBN
            ]);

            return ApiResponse::success('Book Created Successfully', $book, 201);
        } catch (\Throwable $th) {
            return ApiResponse::error("Create operation failed", $th->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $book = Book::find($id);
            if (!$book) {
                return ApiResponse::error("Get specified book operation failed", 'The specified book does not exist', 404);
            }
            return ApiResponse::success('Get Book details successfully', $book, 200);
        } catch (\Throwable $th) {
            return ApiResponse::error("Get specified book operation failed", $th->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        try {
            $validateBook = Validator::make($request->all(),[
                'title' => 'required|max:30',
                'author' => 'required|max:20',
                'publication_year' => 'required|',
                'ISBN' => 'required|regex:/^[0-9]{13}$/|unique:App\Models\Book,ISBN,'. $book->id,
            ]);
            if($validateBook->fails()){
                return ApiResponse::error('Validation error', $validateBook->errors(), 400);
            }
            $book->update($request->all());
            return ApiResponse::success('Book updated Successfully', $book, 200);
        } catch (\Throwable $th) {
            return ApiResponse::error("Update operation failed", $th->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       try {
            $book = Book::find($id);
            if (!$book) {
                return ApiResponse::error("Delete operation failed", 'The specified book does not exist', 404);
            }
            $book->delete();
            return ApiResponse::success('Book deleted Successfully', null, 200);
        } catch (\Throwable $th) {
            return ApiResponse::error("Delete operation failed", $th->getMessage(), 500);
        }
    }
}
