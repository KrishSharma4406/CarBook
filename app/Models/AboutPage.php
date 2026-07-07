<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory;

    protected $table = 'about_pages';

    protected $fillable = [
        'hero_title',
        'hero_background',
        'about_subtitle',
        'about_title',
        'about_description',
        'about_image',
        'cta_title',
        'cta_button_text',
        'cta_button_url',
        'cta_background',
        'testimonial_subtitle',
        'testimonial_title',
        'counter_1_number',
        'counter_1_label',
        'counter_2_number',
        'counter_2_label',
        'counter_3_number',
        'counter_3_label',
        'counter_4_number',
        'counter_4_label',
    ];
}
