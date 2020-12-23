<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use SoftDeletes;
    /**
     * Get the comments for the blog post.
     */
    public function appointments()
    {
        return $this->hasMany('App\Appointment');
    }

    /**
     * Get the comments for the blog post.
     */
    public function departments()
    {
        return $this->belongsToMany('App\Department');
    }
}
