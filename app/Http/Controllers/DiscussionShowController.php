<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscusssionResource;
use App\Http\Resources\PostResource;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Http\Request;

class DiscussionShowController extends Controller
{
    //

    public function __invoke(Discussion $discussion)
    {
        $discussion->load(['topic']);
         // TODO: Implement __invoke() method.
        return inertia()->render('Forum/Show',[
            'discussion'=>DiscusssionResource::make($discussion),
            'posts'=> PostResource::collection(
                Post::whereBelongsTo($discussion)
                    ->with(['user','discussion'])
                    ->oldest()
                    ->paginate(10)
            )
        ]);
    }
}
