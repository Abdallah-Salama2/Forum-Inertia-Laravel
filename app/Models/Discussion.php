<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    public function scopeOrderByPinned($query)
    {
        $query->orderBy('pinned_at', 'desc');
    }

    public function scopeOrderByLastPost($query)
    {
        //grab the last post created_at
        $query->orderBY(
            Post::select('created_at')
            ->whereColumn('posts.discussion_id', 'discussions.id')
            ->latest()
            ->take(1)
            , 'desc'
        );

        //order discussion by that timeline
    }


    public function isPinned()
    {
        return !is_null($this->pinned_at);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //First Post of Discussion
    public function post()
    {
        return $this->hasOne(Post::class)->whereNull('parent_id');
    }

    public function latestPost()
    {
        return $this->hasOne(Post::class)->latestOfMany();
    }

    public function participants()
    {
        return $this->hasManyThrough(User::class, Post::class, 'discussion_id', 'id', 'id', 'user_id')
            ->distinct();
    }
    public function replies()
    {
        return $this->hasMany(Post::class)->whereNotNull('parent_id');
    }
}
