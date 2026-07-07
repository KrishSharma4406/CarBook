<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesPage extends Model
{
    use HasFactory;

    protected $table = 'services_pages';

    protected $fillable = [
        'hero_title',
        'hero_background',
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
        'cta_title',
        'cta_button_text',
        'cta_button_url',
        'cta_background',
    ];
}
