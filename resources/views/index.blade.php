@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="custom-success-alert">
            @if (Session('success'))
                <h4 class="alert alert-success text-center">{{ Session('success') }}</h4>
            @endif
        </div>


        <div class="d-flex justify-content-center">
            <a class="text-center btn btn-primary" href="{{ route('image.create') }}">Upload New</a>
        </div>

        <h2 class="text-center mt-4 mb-4" >Gallery</h2>

        <div class="gallery-grid">
            @foreach ($gallery as $item)
            <div class="single-gallery-item">
                <div class="gallery-img">
                    <img src="{{ asset('media/' .$item->image_path) }}" alt="img">
                </div>
                <a href="#">{{$item->title}}</a>
                <p>{{$item->description}}</p>

                <form class="delete-gallery" action="{{ route('image.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Do you want to delete this gallery item?')">
                    @csrf
                    @method('DELETE')
                    <button class="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6L17.6 19a2 2 0 0 1-2 1.8H8.4a2 2 0 0 1-2-1.8L5 6m5 0v12m4-12v12"></path>
                        </svg>
                    </button>
                </form>
            </div>
            @endforeach
        </div>

    </div>
@endsection
