<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'publication_year', 'publisher', 'is_borrowed', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
