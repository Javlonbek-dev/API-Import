<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterfaces;
use App\Models\Post;

class PostRepository implements PostRepositoryInterfaces
{
    public function getAll()
    {
        return Post::all();
    }

    public function getById($id)
    {
        return Post::find($id);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update(array $data, int $id)
    {
        $post = Post::findOrFail($id);
        $post->update($data);
        return $post;
    }

    public function delete(int $id)
    {
        $post = Post::findOrFail($id);
        return $post->delete();
    }
}
