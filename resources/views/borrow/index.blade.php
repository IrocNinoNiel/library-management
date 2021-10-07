@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            {{ __('Book Borrow Slip') }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mt-1">
                        <div class="col"><h3>Book Name:</h3></div>
                        <div class="col-8 text-left"><h5>{{$book->book}}</h5></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col"><h3>Borrower Name:</h3></div>
                        <div class="col-8 text-left"><h5>{{Auth::user()->name}}</h5></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col"><h3>Date Borrowed:</h3></div>
                        <div class="col-8 text-left"><h5>{{\Carbon\Carbon::now()->format('M d Y')}}</h5></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col"><h3>Date Expiration:</h3></div>
                        <div class="col-8 text-left"><h5>{{\Carbon\Carbon::now()->addDays($book->day_avail)->format('M d Y')}}</h5></div>
                    </div>
                    <div class="row mt-1">
                        <form action="{{ route('borrow.store', $book->id) }}" method="post">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
