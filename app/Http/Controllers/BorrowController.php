<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $book = Book::find($id);

        if(is_null($book)) return abort(404);

        return view('borrow.index')->with('book',$book);
    }
    
    public function table()
    {
        $borrows = Borrow::all();
        return view('borrow.table')->with('borrows',$borrows);
    }

    public function store($id)
    {
        $book = Book::find($id);
        if(is_null($book)) return abort(404);

        $borrow = new Borrow;

        $borrow->user_id = Auth::user()->id;
        $borrow->book_id = $book->id;
        $borrow->deadline = \Carbon\Carbon::now()->addDays($book->day_avail);
        $borrow->status = 1;

        $borrow->save();

        $book->status = 2;
        $book->save();

        return Redirect::route('home')->with('success','Book Borrow');
    }

    public function toggle($id)
    {
        $borrow = Borrow::find($id);
        if(is_null($borrow)) return abort(404);

        $book = Book::find($borrow->book_id);
        if($borrow->status == 1)
        {
            $borrow->status = 2;
            $book->status = 1;

            $borrow->save();
            $book->save();
        }else {
            $borrow->status = 1;
            $book->status = 2;

            $borrow->save();
            $book->save();
        }

        $borrows = Borrow::all();
        return view('borrow.table')->with('borrows',$borrows);

    }
}
