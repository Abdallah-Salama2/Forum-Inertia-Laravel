<?php

namespace App\Http\Controllers;

use App\Http\QueryFilters\NoRepliesQueryFilter;
use App\Http\Resources\DiscusssionResource;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ForumIndexController extends Controller
{
    //
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        return Inertia::render('Forum/Index', [
            'discussions' => DiscusssionResource::collection(
                QueryBuilder::for(Discussion::class)
                    ->allowedFilters($this->allowedFilters())
                    ->with(['topic', 'post', 'latestPost.user', 'participants'])
                    ->withCount('replies')
                    ->OrderByPinned()
                    ->OrderByLastPost()//implmented
//                    ->latest() //remove when implments ordering by last post
                    ->paginate(10)
            ),

        ]);
    }

    protected function allowedFilters()
    {
        return [
            AllowedFilter::custom('noreplies', new NoRepliesQueryFilter())
        ];
    }
}
