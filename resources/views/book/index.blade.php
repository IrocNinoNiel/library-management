@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row p-3">
                    <div class="col-md-4">
                        <img src="{{asset("/img/".$book->photo)}}" class="thumbnail" style="max-width:100%;
                        max-height:100%;">
                    </div>
                    <div class="col-md-8">
                        <h2>{{$book->book}}</h2>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Author:</strong> {{$book->author}}</li>
                            <li class="list-group-item"><strong>Date Published:</strong> {{$book->date}}</li>
                            <li class="list-group-item"><strong>Publisher:</strong> {{$book->publisher}}</li>
                            <li class="list-group-item"><strong>Status:</strong> 
                                @if($book->status == 1) 
                                    <button class="btn btn-primary">Available</btn>
                                @else 
                                    <button class="btn btn-danger">Unavailable</btn>
                                @endif
                            </li>
                            <li class="list-group-item"><strong>Total Borrow Days:</strong> {{$book->day_avail}}</li>
                            <li class="list-group-item"><strong>Short Summary</strong>  {{$book->summary}}</li>
                        </ul>
                    </div>
                </div>
                <hr>

                @if(Auth::user()->user_type == 'admin')
                    <div class="row p-3">
                        <div class="col">
                            <a href="{{ route('book.editpage', $book->id) }}" class="btn btn-primary">Edit Book</a>
                        </div>
                        <div class="col text-right">
                            {{-- <button class="btn btn-danger">Delete Book</button> --}}

                            @if($book->status == 1)
                                <form action="{{ route('book.destroy', $book->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger @if($book->status == 2) disabled @endif" value="Delete" onclick="return confirm('Are you sure you want to delete this Book?');">
                                </form>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="row p-3">
                        <div class="col">
                            <a href="{{ route('borrow.index', $book->id) }}" class="btn btn-primary @if($book->status == 2) disabled @endif">Borrow Book</a>
                        </div>
                    </div>
                @endif
               
            </div>
        </div>
    </div>
</div>
@endsection
