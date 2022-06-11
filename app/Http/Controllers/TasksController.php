<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Tasks;

class TasksController extends Controller
{
    public function show($tasks)
    {
        return view('welcome', compact('tasks'));
    }

    public function showAll()
    {
        return $this->show(Tasks::orderBy('is_complete')->latest()->paginate(10));
    }

    public function showHide()
    {
        return $this->show(Tasks::where('is_complete',  0)->latest()->paginate(10));
    }

    public function save(TaskStoreRequest $request)
    {
       $request->validated();
       $store = new Tasks();
       $data = [
           'task' => $request->task,
           'is_complete' => false
       ];
       $store->fill($data)->save();

       return back();
    }

    private function findOneById($id)
    {
        return Tasks::findOrFail($id);
    }

    public function changeStatusToFinish($id)
    {
        $this->changeStatus($id, 1);
        return back();
    }

    public function changeStatusToStartAgain($id)
    {
        $this->changeStatus($id, 0);
        return back();
    }

    private function changeStatus($id, $status_id)
    {
        $update = $this->findOneById($id);
        $update->is_complete = $status_id;
        $update->save();
    }

    public function destroy($id)
    {
        $destroy = $this->findOneById($id);
        $destroy->delete();
        return back();
    }
}
