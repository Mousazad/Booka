<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Author;

class AuthorController extends Controller
{

	public function search(Request $request)
    {
		$request->validate([
			'key' => 'string|required',
		]);
		
		$key = $request->key;
        $authors = Author::where('name','like','%'.$key.'%')->get();
		return $authors;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
		return view('author.index',['authors'=>$authors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
