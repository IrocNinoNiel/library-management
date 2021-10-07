<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'book',
        'author',
        'date',
        'publisher',
        'summary',
        'user_id',
        'status',
        'day_avail'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
