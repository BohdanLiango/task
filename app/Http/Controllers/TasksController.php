<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Services\CategoryService;
use App\Http\Services\TaskService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TasksController extends Controller
{
    private TaskService $services;
    private CategoryService $categoryService;

    public function __construct(TaskService $taskService, CategoryService $categoryService)
    {
        $this->services = $taskService;
        $this->categoryService = $categoryService;
    }

    /**
     * @param $tasks
     * @return Application|Factory|View
     */
    private function index($tasks)
    {
        $categories = $this->categoryService->getAllToForm();

        return view('pages.tasks.index', compact('tasks', 'categories'));
    }

    /**
     * @return Application|Factory|View
     */
    public function showAll()
    {
        return $this->index($this->services->getAll());
    }

    /**
     * @return Application|Factory|View
     */
    public function showActive()
    {
        return $this->index($this->services->getActive());
    }

    /**
     * @return Application|Factory|View
     */
    public function showHide()
    {
        return $this->index($this->services->getHide());
    }

    /**
     * @return Application|Factory|View
     */
    public function showDeleted()
    {
        return $this->index($this->services->getDeleted());
    }

    /**
     * @param TaskStoreRequest $request
     * @return RedirectResponse|never
     */
    public function save(TaskStoreRequest $request)
    {
       $request->validated();

        try {
            $this->services->store($request->title, $request->category_id);
            return back();
        }catch (Exception $e){
            return abort(403);
        }

    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function changeStatusToFinish($id)
    {
        try {
            $this->services->changeStatus($id, config('tasks.is_completed'));
            return back();
        }catch (Exception $e){
            return abort(403);
        }
    }

    /**
     * @param $id
     * @return RedirectResponse|never
     */
    public function changeStatusToStartAgain($id)
    {
        try {
            $this->services->changeStatus($id, config('tasks.is_not_completed'));
            return back();
        }catch (Exception $e){
            return abort(403);
        }
    }

    /**
     * @param $id
     * @return RedirectResponse|never
     */
    public function restore($id)
    {
        try {
            $this->services->resfore($id);
            return back();
        }catch (Exception $e){
            return abort(403);
        }
    }

    /**
     * @param $id
     * @return RedirectResponse|never
     */
    public function destroy($id)
    {
        try {
            $this->services->softDelete($id);
            return back();
        }catch (Exception $e){
            return abort(403);
        }
    }

    /**
     * @param $id
     * @return RedirectResponse|never
     */
    public function forceDelete($id)
    {
        try {
            $this->services->forceDelete($id);
            return back();
        }catch (Exception $e){
            return abort(403);
        }
    }
}
