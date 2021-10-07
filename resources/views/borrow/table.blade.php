@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            {{ __('Book Borrow Table') }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if(Auth::user()->user_type == 'user')
                        @if(count(Auth::user()->borrow) == 0)
                            <div class="card-body border">
                                <h1>No Borrow Book</h1>
                            </div>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Date Borrowed</th>
                                        <th scope="col">Date Expiration</th>
                                        <th scope="col">Expired?</th>
                                        <th scope="col">Return?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Auth::user()->borrow as $borrow)
                                        <tr>
                                            <td>{{$borrow->book->book}}</td>
                                            <td>{{\Carbon\Carbon::parse($borrow->created_at)->format('M d, Y')}}</td>
                                            <td>{{\Carbon\Carbon::parse($borrow->deadline)->format('M d, Y')}}</td>
                                            <td>
                                                @if($borrow->status == 2)
                                                    Already Return
                                                @else
                                                    @if(\Carbon\Carbon::parse($borrow->deadline)->lt(\Carbon\Carbon::now()))
                                                        YES
                                                    @else
                                                        NO
                                                    @endif
                                                @endif

                                                
                                            </td>
                                            <td>
                                                @if($borrow->status == 2)
                                                    YES
                                                @else
                                                    NO
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    @else
                        @if(count($borrows) == 0)
                            <div class="card-body border">
                                <h1>No Borrow Book</h1>
                            </div>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Borrower Name</th>
                                        <th scope="col">Date Borrowed</th>
                                        <th scope="col">Date Expiration</th>
                                        <th scope="col">Expired?</th>
                                        <th scope="col">Return?</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($borrows as $borrow)
                                        <tr>
                                            <td>{{$borrow->book->book}}</td>
                                            <td>{{$borrow->user->name}}</td>
                                            <td>{{\Carbon\Carbon::parse($borrow->created_at)->format('M d, Y')}}</td>
                                            <td>{{\Carbon\Carbon::parse($borrow->deadline)->format('M d, Y')}}</td>
                                            <td>
                                                @if(\Carbon\Carbon::parse($borrow->deadline)->lt(\Carbon\Carbon::now()))
                                                    YES
                                                @else
                                                    NO
                                                @endif
                                            </td>
                                            <td>
                                                @if($borrow->status == 2)
                                                    YES
                                                @else
                                                    NO
                                                @endif
                                            </td>
                                            <td>
                                                @if($borrow->status == 2)
                                                    <form action="{{ route('borrow.toggle',$borrow->id) }}" method="post">
                                                        @csrf
                                                        <input type="submit" class="btn btn-warning disabled" value="Return">
                                                    </form>
                                                                       
                                                @else
                                                    <form action="{{ route('borrow.toggle',$borrow->id) }}" method="post">
                                                        @csrf
                                                        <input type="submit" class="btn btn-warning" value="Return">
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
