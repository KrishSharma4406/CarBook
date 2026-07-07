<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPage extends Model
{
    use HasFactory;

    protected $table = 'blog_pages';

    protected $fillable = [
        'hero_title',
        'hero_background',
        'blog_subtitle',
        'blog_title',
    ];
}
