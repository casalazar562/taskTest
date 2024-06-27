<?php

namespace App\Repositories;

use App\Contracts\Cuenta\CuentaRepositoryInterface;
use App\Contracts\Task\TaskRepositoryInterface;
use App\Http\Resources\CuentaResource;
use App\Http\Resources\TaskResource;
use App\Models\Cuenta;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentTaskRepository implements TaskRepositoryInterface
{
    public function __construct(protected Task $model)
    {
        
    }


    public function list(array $columns = ['*']):Collection
    {
        return $this->model->latest()->get($columns);
    }

    public function create(array $data):?Task
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $task):?Task
    {
        $taskUpdate = $this->model->find($id);

        $taskUpdate->update($task);

        return $taskUpdate;
       
    }

    public function delete(string $id):void
    {
        $this->model->byId($id)->delete();
       
    }

    public function find(int $id)
    {
        $task = $this->model->find($id);
        return new TaskResource($task);
    }
}
