<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return News::paginate(10);
    }

    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();

        return News::create($data);
    }

    public function show(News $news)
    {
        return $news;
    }
}
