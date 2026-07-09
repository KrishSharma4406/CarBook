<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $fillable = [
        // Hero section
        'hero_title',
        'hero_subtitle',
        'hero_background',
        'video_url',
        'video_text',

        // About section
        'about_subtitle',
        'about_title',
        'about_description',
        'about_image',

        // Services section
        'services_subtitle',
        'services_title',
        'service_1_icon',
        'service_1_title',
        'service_1_desc',
        'service_2_icon',
        'service_2_title',
        'service_2_desc',
        'service_3_icon',
        'service_3_title',
        'service_3_desc',
        'service_4_icon',
        'service_4_title',
        'service_4_desc',

        // CTA section
        'cta_title',
        'cta_button_text',
        'cta_button_url',
        'cta_background',

        // Testimonials section headings
        'testimonial_subtitle',
        'testimonial_title',

        // Blog section headings
        'blog_subtitle',
        'blog_title',

        // Counters section
        'counter_1_number',
        'counter_1_label',
        'counter_2_number',
        'counter_2_label',
        'counter_3_number',
        'counter_3_label',
        'counter_4_number',
        'counter_4_label',

        // Rent steps section
        'rent_title',
        'rent_step_1_icon',
        'rent_step_1_title',
        'rent_step_2_icon',
        'rent_step_2_title',
        'rent_step_3_icon',
        'rent_step_3_title',
        'rent_button_text',
        'rent_button_url',
    ];
}
