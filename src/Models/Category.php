<?php

namespace Tukmachev\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tukmachev\Shop\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'shop_categories';

    protected $fillable = ['name', 'slug', 'description', 'parent_id'];

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
