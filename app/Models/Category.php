<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['categories'] ?? false, fn ($query, $categories) => $query->where('name', 'like', '%' . $categories . '%'));
    }

    // Jaga table id saja
    protected $guarded = ['id'];
    use HasFactory, Sluggable;

    //* liat di dokumentasi Customizing The Key pada laravel 
    //* Mengubah Route key name menjadi slug, yang tadinya harus mengirim menggunakan id bisa menjadi slug
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    //* menggunakan method ini untuk mengaktifkan library sluggable
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
