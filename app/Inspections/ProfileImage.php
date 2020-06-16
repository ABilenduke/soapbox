<?php

namespace App\Inspections;

class ProfileImage
{
    /**
     * All registered inspections.
     *
     * @var array
     */
    protected $inspections = [
        ValidProfileImages::class
    ];

    /**
     * Detect spam.
     *
     * @param  string $body
     * @return bool
     */
    public function detect($body)
    {
        foreach ($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }

        return false;
    }
}