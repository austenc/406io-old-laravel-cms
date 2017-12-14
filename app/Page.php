<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Page extends Model
{
    protected $fillable = [
    	'title',
    	'slug',
    	'content',
        'excerpt',
        'published_at',
    ];

    public function getContentAttribute($value)
    {
    	return (new Parsedown)->text($value);
    }

    public function getRawContentAttribute()
    {
        return $this->getOriginal('content');
    }

    public function getUrlAttribute()
    {
    	return url($this->slug);
    }

    public function getExcerptAttribute($value)
    {
        return empty($value) ? str_limit($this->content, 200) : $value;
    }
}
