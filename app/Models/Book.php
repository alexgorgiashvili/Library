<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    
    public static function new(){
        return new self;
    }
    
    public static function filterBooks($request) {
        $booksFiltered = self::where('author_id', $request->filter_by)->paginate(12);
        return $booksFiltered->appends(['author_id' => $request->filter_by]); 
    }
    public static function searchBooks($request) {
        $booksFiltered = self::where('title', 'like', '%' . $request->search_by . '%')->paginate(12);
        return $booksFiltered; 
    }

   

    public function bookSave($bookData){

        $this->title = $bookData->book_title;
        $this->year = $bookData->book_year;
        $this->status = $bookData->book_status;
        $this->author_id = $bookData->author_id;
        $this->save();        
    }
    
    public function getAuthor(){
        return $this->belongsTo(Author::class,'author_id','id');
    }
}
