@foreach ( $booksFiltered as $book)
    <div class="col-3 text-center">
        <div class="box pricing-plan">
            <div class="plan-item"><span class='has-text-weight-bold'>Book Name</span>
                <p>{{ $book->title ?? ''}}</p>
            </div>
            <div class="plan-items">
                <div class="plan-item"><span class='has-text-weight-bold'>Book author</span>
                    <p>{{ $book->getAuthor->name ?? '' }} {{ $book->getAuthor->surname ?? '' }}</p>
                </div>
            </div>

            <div class="plan-items">
                <div class="plan-item"><span class='has-text-weight-bold'>Published</span>
                    <p>{{ $book->year ?? '' }}</p>
                </div>
            </div>
            <div class="plan-items">
                <label class="form-check-label" for="flexSwitchCheckChecked">
                    @if($book->status == 0)
                    <span class="text-success fs-4">Avialable <span/> 
                     @else 
                     <span class="text-danger fs-4">Unavialable <span/>   
                     @endif
                    </label>
            </div>

            
            
            <div class='plan-footer'>
                <a href={{ route('book.edit', $book) }} id="editoutfit"
                    class="button is-fullwidth is-primary my-3">Edit book</a>
                <form class='delete-outfit' data-outfit-name="{{ $book->name }}" data-outfit-id="{{ $book->id }}"
                    action="{{ route('book.delete', $book) }}" method='post'>
                    @csrf
                    <button class="button is-danger is-fullwidth my-3 is-outlined">Delete book</button>
                    
                </form>
            </div>
        </div>
    </div>
@endforeach
