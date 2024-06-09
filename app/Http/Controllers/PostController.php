<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterfaces;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    protected PostRepositoryInterfaces $postRepository;

    public function __construct(PostRepositoryInterfaces $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        return $this->postRepository->getAll();
    }

    public function show($id)
    {
        return $this->postRepository->getById($id);
    }

    public function create(Request $request)
    {
        return $this->postRepository->create($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->postRepository->update($request->all(), $id);
    }

    public function delete($id)
    {
        return $this->postRepository->delete($id);
    }
}
