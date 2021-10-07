@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('book.store')}}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <label for="photo">Enter Book Photo</label>
                            <input type="file" name="photo" class="form-control @error('photo') border-danger @enderror">
                        </div>

                        <div class="form-group">
                            <label for="book">Enter Book Name</label>
                            <input type="text" class="form-control @error('book') border-danger @enderror" id="book" placeholder="Book Name" name="book">
                        </div>

                        <div class="form-group">
                            <label for="author">Enter Author Name</label>
                            <input type="text" class="form-control @error('author') border-danger @enderror" id="author" placeholder="Author Name" name="author">
                        </div>

                        <div class="form-group">
                            <label for="date">Date Published</label>
                            <input type="date" class="form-control @error('date') border-danger @enderror" name="date">
                        </div>

                        <div class="form-group">
                            <label for="publisher">Enter Publisher Name</label>
                            <input type="text" class="form-control @error('publisher') border-danger @enderror" id="publisher" placeholder="Publisher Name" name="publisher">
                        </div>

                        <div class="form-group">
                            <label for="day_avail">Enter Total Borrowed Days</label>
                            <input type="number" class="form-control @error('day_avail') border-danger @enderror" id="day_avail" placeholder="# of Days" name="day_avail">
                        </div>

                        <div class="form-group">
                            <label for="summary">Enter Short Summary</label>
                            <textarea class="form-control @error('summary') border-danger @enderror" id="summary" rows="5" placeholder="Short Summary" name="summary"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Add Book</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
