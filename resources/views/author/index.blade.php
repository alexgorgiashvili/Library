@extends('layouts.app')
@section('content')
    <div class="column is-three-quarters-desktop pricing-table mx-auto">
        <div class="box pricing-plan" data-author-list>
            <div class="plan-header has-icons">
                <i class="fas fa-user"></i>
                Author list
            </div>
            <form action="{{ route('author.store') }}" method="post">
                <div class="field is-flex-tablet is-flex-direction-row">
                    <div class="control m-1">
                        <input class="input is-small" type="text" name="author_name" placeholder="Author name"
                            value="{{ old('author_name') }}">
                    </div>
                    <div class="control m-1">
                        <input class="input is-small" type="text" name="author_surname" placeholder="Author surname"
                            value="{{ old('author_surname') }}">
                    </div>
                    <div class="control m-1">
                        <button class="is-small mx-1-tablet button is-primary is-fullwidth">
                            Add author
                        </button>
                    </div>
                </div>
                @csrf
            </form>
           
            @if (session()->has('success_message'))
                @component('layouts.notification', ['message' => true])
                @endcomponent
            @elseif ($errors->any())
                @component('layouts.notification', ['message' => false])
                @endcomponent
            @endif
            @if ($authors->count() === 0)
                <div class='box'>No authors in the list available</div>
            @else
                <table class="table is-hoverable is-fullwidth has-text-centered is-narrow">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Author name</th>
                            <th>Author surname</th>
                            <th>Total books</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr class='author-row'>
                                <td>{{ $author->id }}</td>
                                <td class='has-text-info' data-show="quickview" data-target="quickviewDefault">
                                    {{ $author->name }}</td>
                                <td>{{ $author->surname }}</td>
                                <td>
                                    <div class="tag is-medium 
                                        @if ($author->getBooks->count() > 0) is-success
                                    @else is-danger @endif">
                                        Books {{ $author->getBooks->count() }}
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('author.delete', $author) }}" method='post'>
                                        
                                        <button
                                            class="button is-small is-danger my-1 is-touch is-outlined btn-tbl">Delete</button>
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $authors->links() }}
            @endif
        </div>
    @endsection
