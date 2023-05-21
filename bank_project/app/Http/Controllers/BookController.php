<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{

    public function index(Request $request)
    {
 
        $book = Book::all();
        return response()->json($book);


    }




    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'pages' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $book = new Book;
        $book->name = $request->title;
        $book->pages = $request->content;
        $book->date = $request->content;
        $book->save();

        return response()->json($book, 201);
    }





    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'book not found'], 404);
        }

        return response()->json($book);
    }


    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'pages' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'book not found'], 404);
        }

        $book->name = $request->name;
        $book->pages = $request->pages;
        $book->date = $request->date;
        $book->save();

        return response()->json($book);
    }





    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'book deleted']);
    }
}
