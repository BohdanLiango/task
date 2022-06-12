<?php

namespace App\Http\Services;

use App\Models\Tasks;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class TaskService
{
    private $tasks;

    public function __construct(Tasks $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->tasks->orderBy(config('tasks.orderBy'))
            ->with('category')
            ->latest()
            ->paginate(config('tasks.paginate'));
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->tasks->where(config('tasks.table_status'),  config('tasks.is_not_completed'))
            ->with('category')
            ->orderBy(config('tasks.orderBy'))
            ->latest()
            ->paginate(config('tasks.paginate'));
    }

    /**
     * @return mixed
     */
    public function getHide()
    {
        return $this->tasks->where(config('tasks.table_status'),  config('tasks.is_completed'))
            ->with('category')
            ->latest()
            ->paginate(config('tasks.paginate'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getDeleted()
    {
        return $this->tasks->onlyTrashed()->with('category')->latest()->paginate(config('tasks.paginate'));
    }

    /**
     * @param $title
     * @param $category_id
     * @return bool
     */
    public function store($title, $category_id)
    {
        if(!is_numeric($category_id))
        {
            $category_id = NULL;
        }

        Tasks::create([
            'title' => $title,
            'category_id' => $category_id,
            'is_complete' => config('tasks.is_not_completed')
        ]);

        return true;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function getOneById($id)
    {
        return $this->tasks->findOrFail($id);
    }

    /**
     * @param $id
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    private function getOneByIdOnlyTrashed($id)
    {
        return $this->tasks->onlyTrashed()->where('id', $id);
    }

    /**
     * @param $id
     * @param $status_id
     * @return bool
     */
    public function changeStatus($id, $status_id)
    {
        $update = $this->getOneById($id);
        $update->is_complete = $status_id;
        $update->save();
        return true;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function resfore($id)
    {
        $this->getOneByIdOnlyTrashed($id)->restore();
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function softDelete($id)
    {
        $this->getOneById($id)->delete();
        return true;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function forceDelete($id)
    {
        $this->getOneByIdOnlyTrashed($id)->forceDelete();
        return true;
    }

}
