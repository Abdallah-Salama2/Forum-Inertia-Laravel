<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscusssionResource;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

class ForumIndexController extends Controller
{
    //
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        return Inertia::render('Forum/Index', [
            'discussions' => DiscusssionResource::collection(
                Discussion::with(['topic','post','latestPost.user','participants'])
                    ->withCount('replies')
                    ->OrderByPinned()
                    ->OrderByLastPost()//implmented
//                    ->latest() //remove when implments ordering by last post
                    ->paginate(10)
            ),

        ]);
    }
}
