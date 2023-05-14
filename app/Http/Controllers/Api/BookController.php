<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Book;
use App\Models\Author;
use App\Http\Controllers\Controller;

class BookController extends Controller
{

	public function __construct()
    {
	    
	}
	
	public function GetAllBook()
	{
		return Book::all();
	}
    
	public function GetBookInfo(Request $request)
	{
		$bookId = $request->bookId;
		return Book::find($bookId);
	}
    
}
