<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function index(Request $request)
    {
        $books = Book::query()->orderBy('id', 'DESC')->get();
        //$books = Book::all();
//        echo '<pre>';
//        var_dump($books);
        return view('books/books', ['books' => $books]);
    }

    function edit(Book $book)
    {
        //$book = Book::query()->find($id);
        //dd($id,$book);
        return view('books.edit', ['book' => $book]);
    }

    function create()
    {

        return view('books.create');
    }

    function add(BookRequest $request)
    {
        //dd($request);
        $book = new Book();
        $book->name = $request->get('name');
        $book->price = $request->price;
        $book->save();

        //return redirect('/books');
        return redirect()->route('books');
    }

    function save(BookRequest $request)
    {
        $book = Book::query()->find($request->id);

        $book->name = $request->name;
        $book->price = $request->price;
        $book->save();
        return redirect()->route('books');
    }

    function delete(Request $request)
    {
        Book::destroy($request->id);
        return redirect()->route('books');
    }
}
