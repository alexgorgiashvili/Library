<?php

namespace App\Models;

use App\Http\Controllers\BookController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Author extends Model
{
    
    public static function new()
    {
        return new self;
    }

    

    public function saveAuthor(Request $authorData)
    {

        $this->name = $authorData->author_name;
        $this->surname = $authorData->author_surname;
        $this->save();
    }
    
    public function getBooks()
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }


    public function deleteAuthor($author)
    {
        if ($this->getBooks->count() > 0) {
            return redirect()->back()->withErrors("Author $author->name $author->surname cannot be deleted because it has books assigned");
        }
        
        $this->delete();
    }
}
