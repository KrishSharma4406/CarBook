<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    use HasFactory;

    protected $table = 'contact_pages';

    protected $fillable = [
        'hero_title',
        'hero_background',
        'contact_subtitle',
        'contact_title',
        'contact_address',
        'contact_phone',
        'contact_email',
    ];
}
