<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Services\CategoryService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoriesController extends Controller
{
   private $categoryService;

   public function __construct(CategoryService $categoryService)
   {
     $this->categoryService = $categoryService;
   }

    /**
     * @param $categories
     * @return Application|Factory|View
     */
   private function index($categories)
   {
       return view('pages.categories.index', compact('categories'));
   }

    /**
     * @return Application|Factory|View|never
     */
   public function showAll()
   {
//       try {
           return $this->index($this->categoryService->getAll());
//       }catch (Exception $e){
//           return abort(403);
//       }
   }

    /**
     * @return Application|Factory|View|never
     */
    public function showDeleted()
    {
        try {
            return $this->index($this->categoryService->getDeleted());
        }catch (Exception $e){
            return abort(403);
        }
    }

    /**
     * @param CategoryStoreRequest $categoryStoreRequest
     * @return RedirectResponse|never
     */
    public function save(CategoryStoreRequest $categoryStoreRequest)
    {
        $categoryStoreRequest->validated();

        try {
            $this->categoryService->store($categoryStoreRequest->title);
            return back();
        }catch (Exception $e){
            return abort(403);
        }
    }

    /**
     * @param $id
     * @param CategoryUpdateRequest $categoryUpdateRequest
     * @return RedirectResponse|never
     */
    public function update($id, CategoryUpdateRequest $categoryUpdateRequest)
    {
        $categoryUpdateRequest->validated();

        try {
            $this->categoryService->update($id, $categoryUpdateRequest->title);
            return back();
        }catch (Exception $e){
            return abort(403);
        }
    }

    /**
     * @param $id
     * @return mixed|never
     */
    public function delete($id)
    {
        try {
            $this->categoryService->softDelete($id);
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
            $this->categoryService->restore($id);
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
            $this->categoryService->forceDelete($id);
            return back();
        }catch (Exception $e){
            return abort(403);
        }
    }

}
