@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row py-3">
            <div class="d-flex justify-content-between">
                <form class='' action="{{ route('book.index') }}" method="get">
                    <div class="is-flex has-addons field">
                        @component('layouts.filter', compact('authors', 'books', 'filterBy', ))
                        @endcomponent
                    </div>
                </form>
                <a href="{{ route('book.create') }}" class='button is-primary is-normal'>Add a new book?</a>
            </div>
            
        </div>
    </div>
    
    @if (session()->has('success_message'))
        @component('layouts.notification', ['message' => true])
        @endcomponent
    @elseif ($errors->any())
        @component('layouts.notification', ['message' => false])
        @endcomponent
    @endif
    <input type="hidden">
    @if ($books->count() === 0)
        <div class='is-5 column has-text-centered box'>
            <p class='my-6 title is-5'>No books in the list</p>
            <a href="{{ route('book.create') }}" class='button is-primary is-normal'>Add a new book?</a>
        </div>
    @else
        <div class="row gy-4">
            @component('layouts.cards', compact('authors', 'booksFiltered',))

            @endcomponent
        </div>
        <div class="column is-12">
            {{ $booksFiltered->links() }}
        </div>
    @endif
@endsection
