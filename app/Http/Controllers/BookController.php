<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($id)
    {

        $book = Book::find($id);
        return view('book.index')->with('book',$book);
    }

    public function addpage()
    {
        return view('book.add');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'book' => 'required',
            'author' => 'required',
            'date' => 'required',
            'publisher' => 'required',
            'summary'=>'required',
            'day_avail'=>'required'
        ]);

        $imageName = time().'.'.$request->photo->extension();  
        $request->photo->move(public_path('img'), $imageName);

        $book = new Book;

        $book->photo = $imageName;
        $book->book = $request->book;
        $book->author = $request->author;
        $book->date = $request->date;
        $book->publisher = $request->publisher;
        $book->summary = $request->summary;
        $book->day_avail = $request->day_avail;
        $book->status = 1;

        $book->save();

        return Redirect::route('home')->with('success','Book Added');

    }

    public function destroy($id){
        $book = Book::find($id);
        if(is_null($book)) abort(404);

        $book->delete();

        return Redirect::route('home')->with('success','Book is Deleted');
    }

    public function editpage($id){
        $book = Book::find($id);
        if(is_null($book)) abort(404);

        $book->date = \Carbon\Carbon::parse($book->date)->format('Y-m-d');
        // dd($book->date);
        return view('book.edit')->with('book',$book);
    }

    public function edit(Request $request,$id){

        $this->validate($request,[
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'book' => 'required',
            'author' => 'required',
            'date' => 'required',
            'publisher' => 'required',
            'summary'=>'required',
            'day_avail'=>'required'
        ]);

        $imageName = time().'.'.$request->photo->extension();  
        $request->photo->move(public_path('img'), $imageName);


        $book = Book::find($id);

        $book->photo = $imageName;
        $book->book = $request->book;
        $book->author = $request->author;
        $book->date = $request->date;
        $book->publisher = $request->publisher;
        $book->summary = $request->summary;
        $book->day_avail = $request->day_avail;
        $book->status = 1;

        $book->save();

        return Redirect::route('home')->with('success','Book Edited Succesfully');

    }
}
