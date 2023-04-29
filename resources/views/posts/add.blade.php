@extends('layouts.master')
@section('title', 'Add Post')
@section('content')
    <br><br>
    <div class=" w-50 mx-auto">
        <h1>Add Post</h1>
    </div>
    <br><br>
    <div class="row">
        <div class="mx-auto col-10 col-md-8 col-lg-6">
            <form method="POST" action="{{ url('posts/store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="formGroupExampleInput2">Post Contet</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" name="content">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput3">Post Photo</label>
                    <input type="file" class="form-control" id="formGroupExampleInput3" name="photo">
                </div>
                <button type="submit" class="btn btn-primary">Post</button>
            </form>
        </div>
    </div>
@endsection

