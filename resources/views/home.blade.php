@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            {{ __('Book List') }}
                        </div>
                        @if(Auth::user()->user_type == 'admin')
                            <div class="col text-right">
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Admin Action
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('book.addpage') }}">Add Book</a>
                                    <a class="dropdown-item" href="{{ route('borrow.table') }}">Borrow Table</a>
                                    <a class="dropdown-item" href="{{ route('registeradmin.index')}}">Add Admin</a>
                                  </div>
                                </div>
                            </div>
                        @else
                            <div class="col text-right">
                                <a href="{{ route('borrow.table') }}" class="btn btn-secondary">Borrow Table</a>
                            </div>
                        @endif
                        
                    </div>
                </div>

                <div class="card-body">
                    @include('inc.message')
                    <div class="container">
                        <div class="row" style="height: 390px;">
                            @foreach ($books as $book)
                                <div class="col-md-3 border mt-2 mb-2 pt-3 pb-3">
                                    <div class="well text-center">
                                        <img src="{{asset("/img/".$book->photo)}}" style="max-width:100%;
                                        height:240px;">
                                    <h5>{{$book->book}}</h5>
                                    <a class="btn btn-primary" href="{{ route('book.index',$book->id)}}">Book Details</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
