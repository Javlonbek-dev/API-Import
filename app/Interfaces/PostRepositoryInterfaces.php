<?php

namespace App\Interfaces;


interface PostRepositoryInterfaces
{
    public function getAll();

    public function getById($id);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}
