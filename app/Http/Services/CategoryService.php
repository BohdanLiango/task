<?php

namespace App\Http\Services;

use App\Data\CategoryData;
use App\Models\Categories;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class CategoryService
{
    private $categories;
    private $data;

    public function __construct(Categories $categories, CategoryData $categoryData)
    {
        $this->categories = $categories;
        $this->data = $categoryData;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
       return $this->categories->with('tasks')->latest()->paginate(config('categories.paginate'));
    }

    /**
     * @return mixed
     */
    public function getAllToForm()
    {
        return $this->categories->select('id', 'title')->get();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getDeleted()
    {
        return $this->categories->onlyTrashed()->with('tasks')->latest()->paginate(config('categories.paginate'));
    }

    /**
     * @param $title
     * @return bool
     */
    public function store($title)
    {
        $color = $this->data->colorsCategory()->random();

        Categories::create([
            'title' => $title,
            'color' => $color
        ]);

        return true;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function findOneById($id)
    {
        return $this->categories->findOrFail($id);
    }

    /**
     * @param $id
     * @param $title
     * @return bool
     */
    public function update($id, $title)
    {
        $update = $this->getOneById($id);
        $update->title = $title;
        $update->save();
        return true;
    }

    /**
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    private function findOneByIdOnlyTrashed($id)
    {
        return $this->categories->onlyTrashed()->where('id', $id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function restore($id)
    {
        return $this->findOneByIdOnlyTrashed($id)->restore();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function softDelete($id)
    {
        return $this->findOneById($id)->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function forceDelete($id)
    {
        return $this->findOneByIdOnlyTrashed($id)->forceDelete();
    }

}
