<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    /**
     * Get the comments for the blog post.
     */
    public function appointments()
    {
        return $this->hasMany('App\Appointment');
    }
}
