<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoPostRequest;
use App\Models\VideoPost;
use Illuminate\Http\Request;

class VideoPostController extends Controller
{
    public function index()
    {
        return VideoPost::paginate(10);
    }

    public function store(StoreVideoPostRequest $request)
    {
        $data = $request->validated();

        return VideoPost::create($data);
    }

    public function show(VideoPost $videoPost)
    {
        return $videoPost;
    }
}
