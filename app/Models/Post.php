<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'news_blog';

    protected $fillable = 
    [
        'Title',
        'Description',
        'Img',
        'created_at'
    ];
}
