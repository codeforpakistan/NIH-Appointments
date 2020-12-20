<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    /**
     * Get the comments for the blog post.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the comments for the blog post.
     */
    public function hospital()
    {
        return $this->belongsTo('App\Hospital');
    }
}
