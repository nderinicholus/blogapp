<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_slug'];

    public function posts() {
        return $this->hasMany(Post::class);
    }


    protected static function boot() {
        parent::boot();

        static::creating(function ($cat) {
            $cat->category_slug = Str::slug($cat->title);
        });
    }

}