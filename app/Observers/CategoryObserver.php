<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function creating(Category $category): void
    {
        //
        if (!isset($category->slug)) {
            $category->slug = Str::slug($category->name) . '-'. uniqid();
        }


    }

    /**
     * Handle the Category "updated" event.
     */
    public function updating(Category $category): void
    {
        //
         if ($category->isDirty('name')) {
            $category->slug = Str::slug($category->name);
        }
    }

   
}
