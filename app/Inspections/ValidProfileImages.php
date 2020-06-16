<?php

namespace App\Inspections;

use Exception;

class ValidProfileImages
{
    /**
     * All registered invalid keywords.
     *
     * @var array
     */
    protected $keywords = [
        'profile-background-1.jpg',
        'profile-background-2.jpg',
        'profile-background-3.jpg',
        'profile-background-4.jpg',
        'profile-background-5.jpg',
        'profile-background-6.jpg',
        'profile-background-7.jpg',
        'profile-background-8.jpg',
        'profile-background-9.jpg',
        'profile-background-10.jpg',
    ];

    /**
     * Detect spam.
     *
     * @param  string $body
     * @throws \Exception
     */
    public function detect($body)
    {
        if (!in_array($body, $this->keywords)) {
            throw new Exception('invalidProfileImage');
        }
    }
}