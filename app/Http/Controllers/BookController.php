<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;



class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authors = Author::all();
        $books = Book::orderBy('title')->paginate(12);
        // $sorting = explode('_', $request->sort) ?? '';
        if ($request->filter_by) {
            $booksFiltered = Book::filterBooks($request);
        }
        if ($request->search_by) {
            $booksFiltered = Book::searchBooks($request);

        }
       

        return view('book.index', [
            'authors' => $authors,
            'booksFiltered' => $booksFiltered ?? $books,
            'books' => $books,
            'filterBy' => $request->filter_by ?? '0',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::orderBy('name')->get();
        return view('book.create', [
            'authors' => $authors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make(
            
            $request->all(),
            [
                'book_title' => 'required',
                'book_year' => 'required',
                'book_status' => 'required',
                'author_id' => 'required',
            ]   
        );
        
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        
        Book::new()->bookSave($request);
        return redirect()->route('book.index')->with('success_message', "New book $request->book_title was added to the list");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::orderBy('name')->get();
        return view('book.edit', compact('book', 'authors'));
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
       

        $validator = Validator::make(
            
            $request->all(),
            [
                'book_title' => 'required',
                'book_year' => 'required',
                'book_status' => 'required',
                'author_id' => 'required',
            ]   
        );
        
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        

        $book->bookSave($request);
        return redirect()->route('book.index')->with('success_message', "Book $request->book_title was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->back()->with('success_message', "Book $book->title was successfully deleted");
    }
}
