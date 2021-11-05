<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Author::with('book')->get()->take(3);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = new Author();
        $author->name = $request->name;
        $author->age = $request->age;
        $author->province = $request->province;

        $author->save();
        return response()->json(['message' => 'Author created'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Author::with('post')->findOrFail($id);
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
            'name'=>'required|min:3|max:10',
            'age'=>'required|min:1|max:10', 
            'province' => 'nullable'
        ]);

        $author = Author();
        $author->name = $request->name;
        $author->age = $request->age;
        $author->province = $request->province;

        $author->save();
        return response()->json(['message' => 'Author created'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Author::destroy($id);
    }
}
