<?php

namespace App\Http\Controllers;

use App\Factories\TaskDTOFactories;
use App\Http\Requests\CreateOrUpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Tag (
 *     name="Task",
 *     description="Методы управления задачами"
 * )
 */
class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
    }
     /**
     * @OA\Post (
     *     path="/api/v1/tasks",
     *     operationId="create_task",
     *     summary="Создание задачи",
     *     tags={"Task"},
     *     @OA\RequestBody(
     *          @OA\JsonContent(ref="#/components/schemas/CreateOrUpdateRequest")
     *      ),
     *     @OA\Response (
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent (ref="#/components/schemas/TaskResource")
     *     ),
     *     @OA\Response (
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     * @param CreateOrUpdateTaskRequest $request
     * @return JsonResource
     */
    public function createTask(CreateOrUpdateTaskRequest $request): JsonResource
    {
        $task = $this->taskService->createTask(
            TaskDTOFactories::createFromRequest($request)
        );
        return new TaskResource($task);
    }

    /**
     * @OA\Get (
     *     path="/api/v1/tasks",
     *     operationId="get_tasks",
     *     summary="Получить все задачи",
     *     tags={"Task"},
     *     @OA\Response (
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent (
     *               @OA\Property (property="data", type="array", @OA\Items(ref="#/components/schemas/TaskResource")),
     *               @OA\Property (property="total", type="integer", example="0")
     *         )
     *     ),
     *     @OA\Response (
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     * @return JsonResponse
     */
    public function getList(): JsonResponse
    {
        $data = $this->taskService->getListAsDTOs();
        return response()->json([
            'data' => TaskResource::collection($data),
            'total' => $data->count(),
        ]);
    }

    /**
     * @OA\Get (
     *     path="/api/v1/tasks/{id}",
     *     operationId="get_task",
     *     summary="Получить задачу",
     *     tags={"Task"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID задачи",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *       ),
     *     @OA\Response (
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent (ref="#/components/schemas/TaskResource")
     *     ),
     *     @OA\Response (
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     * @param Task $task
     * @return JsonResource
     */
    public function getTask(Task $task): JsonResource
    {
        return new TaskResource(TaskDTOFactories::createFromModel($task));
    }

    /**
     * @OA\Put (
     *     path="/api/v1/tasks/{id}",
     *     operationId="update_task",
     *     summary="Изменить задачу",
     *     tags={"Task"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID задачи",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *       ),
     *     @OA\RequestBody(
     *          @OA\JsonContent(ref="#/components/schemas/CreateOrUpdateRequest")
     *      ),
     *     @OA\Response (
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent (ref="#/components/schemas/TaskResource")
     *     ),
     *     @OA\Response (
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     * @param Task $task
     * @param CreateOrUpdateTaskRequest $request
     * @return JsonResource
     */
    public function updateTask(Task $task, CreateOrUpdateTaskRequest $request): JsonResource
    {
        return new TaskResource(
            $this->taskService->updateTask($task, TaskDTOFactories::createFromRequest($request))
        );
    }

    /**
     * @OA\Delete (
     *     path="/api/v1/tasks/{id}",
     *     operationId="delete_task",
     *     summary="удалить задачу",
     *     tags={"Task"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID задачи",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *       ),
     *     @OA\Response (
     *         response=200,
     *         description="OK",
     *     ),
     *     @OA\Response (
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     * @param Task $task
     * @return string
     */
    public function deleteTask(Task $task): string {
        $task->delete();
        return 'OK';
    }
}
