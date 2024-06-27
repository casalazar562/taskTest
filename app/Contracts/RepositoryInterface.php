<?php

namespace App\Contracts;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    public function list():Collection;

    public function create(array $data);

    public function update(string $id, array $task):?Task;

    public function delete(string $id): void;

    public function find(int $id);
}
