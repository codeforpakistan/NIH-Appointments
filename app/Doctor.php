<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;
    /**
     * Get the comments for the blog post.
     */
    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    /**
     * Get the comments for the blog post.
     */
    public function hospital()
    {
        return $this->belongsTo('App\Hospital');
    }
}
