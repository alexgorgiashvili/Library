@extends('layouts.app')
@section('content')
    <div class="column is-7-desktop pricing-table mx-auto">
        <div class="box pricing-plan">
            <div class="plan-header has-text-left">Book edit:</span></div>
            <form id='createForm' action="{{ route('book.store') }}" method='post' >
                @csrf
                <div class="column">
                    <div class="field">
                        <label class='label'>Book title</label>
                        <div class="control has-icons-right">
                            <input class="input" type="text" name="book_title" placeholder="Book title"
                                value={{ old('book_title') }}>
                            @error('book_title')
                                <span class="icon is-small is-right">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                            @enderror
                        </div>
                        @error('book_title')<p class="help is-danger">{{ $errors->first('book_title') }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class='label'>Published</label>
                        <div class="control has-icons-right">
                            <input class="input" type="number" name="book_year" placeholder="Year"
                                value={{ old('book_year') }}>
                            @error('book_year')
                                <span class="icon is-small is-right">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                            @enderror
                        </div>
                        @error('book_year')<p class="help is-danger">{{ $errors->first('book_year') }}</p>
                        @enderror
                    </div>
                    <div class="field">

                        <div class="form-check form-switch">
                            <b>Check if avialable</b>
                            <input name="book_status" value="1" class="form-check-input cursor-pointer " type="hidden"  >
                            <input name="book_status" value="0" class="form-check-input cursor-pointer " type="checkbox" checked >
                            
                          </div>

                        @error('book_status')<p class="help is-danger">{{ $errors->first('book_status') }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">Author</label>
                        <div class="control">
                            <div class="select @error('author_id')is-danger @enderror">
                                @if ($authors->count() != 0)
                                    <select name='author_id'>
                                        <option value='0' selected disabled>Select author</option>
                                        @foreach ($authors as $author)
                                            <option @if (old('author_id') == $author->id) selected @endif value="{{ $author->id }}">
                                                {{ $author->name }} {{ $author->surname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('author_id')<p class="help is-danger">{{ $errors->first('author_id') }}
                                        </p>
                                    @enderror
                                @else
                                    <select disabled>
                                        <option>{{ 'No authors in the list' }}</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="buttons control mt-5 mb-3 is-flex is-justify-content-flex-end">
                        <button type='submit' class="button mob-btn is-primary mr-2">Add book</button>
                        <a href="{{ route('book.index') }}" class="button is-danger mr-2 is-outlined mob-btn">Back</a>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
@endsection
