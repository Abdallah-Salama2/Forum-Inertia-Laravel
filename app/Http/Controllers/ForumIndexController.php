<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscusssionResource;
use App\Models\Discussion;
use Illuminate\Http\Request;

class ForumIndexController extends Controller
{
    //
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        return inertia()->render('Forum/Index', [
            'discussions' => DiscusssionResource::collection(
                Discussion::with(['topic'])
                    ->OrderByPinned()
                    ->latest() //remove when implments ordering by last post
                    ->paginate(10)
            )
        ]);
    }
}
