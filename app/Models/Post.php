<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
    'image',
    'title',
    'author',
    'content',
    ];

    public function comments()
        {
            return $this->hasMany(Comment::class)->whereNull('parent_id');
        }
}
