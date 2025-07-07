<?php

if (!function_exists('job_locations')) {
    function job_locations(): array
    {
        return [
            '1' => 'Dhaka',
            '2' => 'Rajshahi',
            '3' => 'Chittagong',
            '4' => 'Rangpur'
        ];
    }
}

if (!function_exists('job_types')) {
    function job_types(): array
    {
        return [
            '1' => 'Full-time',
            '2' => 'Part-time',
            '3' => 'Contract',
            '4' => 'Freelance'
        ];
    }
}

if (!function_exists('experience_levels')) {
    function experience_levels(): array
    {
        return [
            '1' => 'Entry',
            '2' => 'Mid',
            '3' => 'Senior'
        ];
    }
}