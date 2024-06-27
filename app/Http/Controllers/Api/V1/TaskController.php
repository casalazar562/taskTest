<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Task\TaskRepositoryInterface;
use Exception;
use App\Http\Controllers\API\V1\AppBaseController;
use App\Http\Requests\CuentaRequest;
use App\Http\Requests\TaskFindRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\{
    DB,
    Log
};
use Symfony\Component\HttpFoundation\Response;

class TaskController extends AppBaseController
{
    protected $repository;

    protected array $columns = [
        'id',
        'title',
        'description',
        'status',
        'due_date',
    ];
    public function __construct(TaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    private function getParams(): array
    {
        return request()->only( 'id','title','description','status','due_date',);
    }

    /**
     * Retrieve all Cuenta (count) counts and return a JsonResponse.
     *
     * @return JsonResponse
     */
    public function all()
    {
        $tasks = $this->repository->list($this->columns);
        if ($tasks->isEmpty()) {
            return new JsonResponse([
                'data' => $tasks,
                'message' => 'No hay tareas'
            ], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse([
            'data' => $tasks
        ], Response::HTTP_OK);
    }

    /**
     * Create a new Cuenta (count) using the provided data.
     *
     * @param CuentaRequest $request
     * @return JsonResponse
     */
    public function create(TaskRequest $request):JsonResponse
    {
        $data = $this->getParams();

        return rescue(function () use ($data) {

            DB::beginTransaction();

            $task = $this->repository->create($data);

            DB::commit();

            $message = 'Ok';

            return $this->sendSuccess(compact('message', 'task'));

        }, function ($e) {

            DB::rollBack(); // @codeCoverageIgnore

            return $this->sendError($e->getMessage(), $e->getCode()); // @codeCoverageIgnore
        });
    }

    /**
     * Update a Cuenta (Order) count on the provided request and order ID.
     *
     * @param CuentaRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TaskUpdateRequest $request):JsonResponse
    {
        
        $data = $this->getParams();
        $id = $request->input('id');
        return rescue(function () use ($id, $data) {

            DB::beginTransaction();

            $task = $this->repository->update($id, $data);

            DB::commit();

            $message = 'Ok';

            return $this->sendSuccess(compact('message', 'task'));

        }, function ($e) {

            DB::rollBack(); // @codeCoverageIgnore
            return $this->sendError($e->getMessage(), $e->getCode()); // @codeCoverageIgnore
        });
    }

    /**
     * Find a Cuenta (count) by its ID and return a JsonResponse.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function find($id)
    {
        $task = $this->repository->find($id);
        return new JsonResponse([
            'data' => $task
        ], Response::HTTP_OK);
    }

    /**
     * Delete a Cuenta (count) by its ID and return a JsonResponse.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(TaskFindRequest $request)
    {
        $id = $request->input('id');

        return rescue(function () use ($id) {

            $this->repository->delete($id);

            $message = 'Ok';

            return $this->sendSuccess(compact('message'));

        }, function ($e) {

            return $this->sendError($e->getMessage(), $e->getCode()); // @codeCoverageIgnore
        });
    }
}
