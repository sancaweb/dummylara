<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormat;
use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function index(Request $request)
    {



        $page = $request->has('page') && !empty($request->page) ? $request->page : 1;

        $offset = $request->has('offset') && !empty($request->offset) ? $request->offset : 0;

        $limit = $request->has('limit') && !empty($request->limit) ? $request->limit : 10;
        $orderBy = $request->has('orderby') && !empty($request->orderby) ? $request->orderby : 'id_post';
        $dir = $request->has('dir') && !empty($request->dir) ? $request->dir : 'DESC';


        $query = Post::select(
            'title',
            'slug',
            'content',
            'category_id',
            'status',
            'featured_image',
            'thumb',
            'published_date',
            'created_by'
        );

        $status = $request->has('status') && !empty($request->status) ? $request->status : 'published';
        $query->where('status', strtolower($status));

        $perPage = 2;
        $posts = $query->paginate($perPage, ['current_page', 'data'], 'page', $page);

        return ResponseFormat::success([
            'posts' => $posts,
            'count' => count($posts)

        ], "Post Retrieved Successfully");
    }

    public function get($slug = null, $id = null)
    {
    }
}
