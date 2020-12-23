<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    /**
     * Get the comments for the blog post.
     */
    public function hospitals()
    {
        return $this->belongsToMany('App\Hospital');
    }
    /**
     * Get the comments for the blog post.
     */
    public function doctors()
    {
        return $this->hasMany('App\Doctor');
    }
}
