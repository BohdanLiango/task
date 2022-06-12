<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    protected $table = 'categories';
    protected $guarded = [];

    use SoftDeletes;

    /**
     * @return HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'category_id');
    }
}
