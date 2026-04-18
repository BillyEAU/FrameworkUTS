<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    
    use HasFactory;
    protected $table = 'news_blog';
    protected $fillable = ['Title', 'slug', 'content', 'Img', 'category_id', 'user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Categories::class);
    }
}
