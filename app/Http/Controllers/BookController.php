<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{

	public function __construct()
    {
	    $this->middleware('auth')->except(['index','show']);;
	}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
		return view('book.index',['books'=>$books]);
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
    public function store(Request $request)
    {
		$request->validate([
			'title' => 'string|required',
			'pubyear' => 'int|required|max:2023',
			'cover' => 'required|mimes:jpg,bmp,png|max:2048'
		]);
		$coverfile = $request->file('cover');
		$coverfilename = $coverfile->getClientOriginalName();
		$extension = $coverfile->extension();
		$title = $request->title;
		$year = $request->pubyear;
		
		$newcoverfilename = sha1(time().'_'.rand(1000000000,1999999999).'_'.rand(1000000000,1999999999).'_'.$coverfilename);
		$newcoverfilename = $newcoverfilename.'.'.$extension;

		Storage::disk('local')->putFileAs(
			'public/files',
			$coverfile,
			$newcoverfilename
		);
		
		Book::Create(['title'=>$title, 'publication_year'=>$year, 'cover'=>'files/'.$newcoverfilename]);
		return redirect()->back(); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
		$authors = $book->authors;
		return view('book.show',['book'=>$book,'authors'=>$authors]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
		$all_authors = Author::all();
		$authors = $book->authors;
		return view('book.edit',['book'=>$book,'all_authors'=>$all_authors,'authors'=>$authors]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
		
		//return $request;
       $request->validate([
			'title' => 'string|required',
			'pub_year' => 'int|required|max:2023',
		]);
	
		$title = $request->title;
		$year = $request->pub_year;
		$book->update(['title'=>$title, 'publication_year'=>$year]);
		$book->authors()->sync($request->author);
		$authors = $book->authors;
		return view('book.show',['book'=>$book,'authors'=>$authors]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
		return redirect()->back(); 
    }
	
	
    public function detachAuthor(Book $book, $author)
    {
        $book->authors()->detach($author);
		$authors = $book->authors;
		return view('book.edit',['book'=>$book,'authors'=>$authors]);

    }

    public function attachAuthor(Book $book, $author)
    {
		if($book->authors->where('id',$author)->count()==0)
			$book->authors()->attach($author);
		$new_authors = Book::find($book->id)->authors;
		return view('book.edit',['book'=>$book,'authors'=>$new_authors]);
    }
}
