@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-6 offset-3">
            {{-- Single File Upload Approach --}}

            <div class="form-card">
                @if ( Session ('success'))
                   <h4 class="alert alert-success text-center">{{ Session ('success') }}</h4>
                @endif
                <h2 class="mb-4">Upload Image</h2>
                <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="text" name="title" placeholder="Title">
                    @error('title')
                        <p class="text text-danger">{{$message}}</p>
                    @enderror
                    <br>
                    <textarea class="form-control" rows="4" name="description" placeholder="Description"></textarea>
                    @error('description')
                        <p class="text text-danger">{{$message}}</p>
                    @enderror
                    <br>
                    <input class="form-control" type="file" name="image">
                    @error('image')
                        <p class="text text-danger">{{$message}}</p>
                    @enderror
                    <br>
                    <button class="btn btn-primary" type="submit">Upload</button>
                </form>
            </div>


            {{-- Multi File Upload Approach --}}

            {{-- <div class="form-card">
                @if (Session('success'))
                   <h4 class="alert alert-success text-center">{{ Session('success') }}</h4>
                @endif
                <h2 class="mb-4">Upload Image</h2>
                <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" multiple type="file" name="image[]">
                    @error('image.*')
                        <p class="text text-danger">{{$message}}</p>
                    @enderror
                    <br>
                    <button class="btn btn-primary" type="submit">Upload</button>
                </form>
            </div> --}}
        </div>
    </div>
@endsection
