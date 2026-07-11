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

    /**
     * Get the dynamic value for counter 1 based on real-time data.
     */
    public function getCounter1NumberAttribute($value)
    {
        return $this->getDynamicCounterValue($this->counter_1_label, $value);
    }

    /**
     * Get the dynamic value for counter 2 based on real-time data.
     */
    public function getCounter2NumberAttribute($value)
    {
        return $this->getDynamicCounterValue($this->counter_2_label, $value);
    }

    /**
     * Get the dynamic value for counter 3 based on real-time data.
     */
    public function getCounter3NumberAttribute($value)
    {
        return $this->getDynamicCounterValue($this->counter_3_label, $value);
    }

    /**
     * Get the dynamic value for counter 4 based on real-time data.
     */
    public function getCounter4NumberAttribute($value)
    {
        return $this->getDynamicCounterValue($this->counter_4_label, $value);
    }

    /**
     * Calculate dynamic counter value based on the label.
     */
    protected function getDynamicCounterValue($label, $fallbackValue)
    {
        if (empty($label)) {
            return $fallbackValue;
        }

        $labelLower = strtolower($label);

        // Year Experienced / Experience
        if (str_contains($labelLower, 'experience') || str_contains($labelLower, 'year')) {
            $firstUserDate = \App\Models\User::min('created_at');
            if ($firstUserDate) {
                $years = \Carbon\Carbon::parse($firstUserDate)->diffInYears(now());
                if ($years > 0) {
                    return $years;
                }
            }
            // Default baseline if registration date is recent or not found
            return max(1, \Carbon\Carbon::parse('2016-01-01')->diffInYears(now()));
        }

        // Total Cars / Cars
        if (str_contains($labelLower, 'car')) {
            return \App\Models\Car::count();
        }

        // Happy Customers / Customers / Users / Clients
        if (str_contains($labelLower, 'customer') || str_contains($labelLower, 'client') || str_contains($labelLower, 'happy') || str_contains($labelLower, 'user')) {
            return \App\Models\User::count();
        }

        // Total Branches / Branches / Locations / Offices
        if (str_contains($labelLower, 'branch') || str_contains($labelLower, 'location') || str_contains($labelLower, 'office')) {
            $locations = \App\Models\Ride::pluck('pickup_location')
                ->merge(\App\Models\Ride::pluck('destination'))
                ->unique()
                ->filter()
                ->count();
            return max(1, $locations);
        }

        return $fallbackValue;
    }
}

