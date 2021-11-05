<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::with('author')->get()->sortByDesc('id');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book();
        $book->author_id = $request->author_id;
        $book->title = $request->title;
        $book->body = $request->body;
        

        $book->save();
        return response()->json(['message' => 'Book created'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::with('user')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|min:3|max:10',
            'body'=>'required|min:3|max:50',   
        ]);

        $book = Book::findOrFail($id);
        $book->author_id = $request->author_id;
        $book->title = $request->title;
        $book->body = $request->body;
        

        $book->save();
        return response()->json(['message' => 'Book created'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Book::destroy($id);
    }
}
