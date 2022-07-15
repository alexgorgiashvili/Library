
<div class="control">
    <div class="select">
        @if ($authors->count() != 0)
            <select name='filter_by'>
                <option value='0' disabled @if ($filterBy == '0') selected @endif>Filter by author</option>
                <optgroup label="Author">
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" @if ($filterBy == $author->id) selected @endif>
                            {{ $author->name }} {{ $author->surname }}
                        </option>
                    @endforeach
            </select>
        @else
            <select disabled name='sort'>
                <option>No masters</option>
            </select>
        @endif
    </div>
</div>

<div class="control">
    <button type="submit" class="button is-primary">Filter</button>
</div>
<div class="control">
    <a href="{{ route('book.index') }}" class="button is-outlined is-danger">Clear filter</a>
</div>


<div class="input-group ms-5 ">
    <div class="form">
      <input type="search" name="search_by" id="form1" class="form-control py-2 srch-btn" placeholder="Search by Book Name" />
    </div>
    <button type="submit" class="btn btn-danger ">
      <i class="fas fa-search"></i>
    </button>
  </div>

