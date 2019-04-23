<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    //
    protected $fillable = ['name', 'description', 'link', 'logo', 'rate', 'is_discount_enable'];

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('category_id');
    }

    public function scopeHasCategories($query, array $ids)
    {
        return $query->whereHas('categories', function ($q) use ($ids) {
            $q->whereIn('category_id', $ids);
        });
    }

}

