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

