<?php

namespace App\Data;

class CategoryData
{
    /**
     * @return string[]
     */
    public function colorsCategory()
    {
        return collect([
            'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'
        ]);
    }
}
