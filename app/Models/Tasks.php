<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tasks extends Model
{
    protected $table = 'tasks';
    protected $guarded = [];

    use SoftDeletes;

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
