<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    // protected $fillable = ['title','excerpt','body','category_id', 'slug', 'user_id'];
    protected $guarded = ['id'];

    // mengatasi N+1 problem
    protected $with = ['category','author'];

    // queryscope untuk search filter
    public function scopeFilter($query, array $filters)
    {
        // cara if biasa
        // if(isset($filters['search']) ? $filters['search'] : false  ) {
        // return $query->where('title', 'like', '%'. $filters['search']. '%')
        //     ->orWhere('body','like','%'. $filters['search']. '%');
        // }

        // filter untuk search
        // gunakan when untuk mengganti if dengan lebih simpel
        // gunakan null coalescing (php 7) pengganti tenary operator
        $query->when($filters['search'] ?? false, function($query, $search) {
            // variabel $search menampung isi search
            return $query->where('title', 'like', '%'. $search. '%')
            ->orWhere('body','like','%'. $search. '%');
        });

        // filter ketika user mencari judul atau body dengan kategori yang dipilih
        // ex : category web programming dengan judul quidem enim
        // variabel $category berisi informasi category yang dipilih user
        $query->when($filters['category'] ?? false, function($query, $category) {
            // whereHas untuk relasi method, lalu jalankan fungsi apa
            return $query->whereHas('category', function($query) use ($category) {
                // dimana slug nya sesuai dengan variabel $category yang dipilih
                $query->where('slug', $category);
            });
        });

        // filter ketika user mencari judul atau body posts dengan author yang dipilih
        // ex : author ilham dengan judul quidem enim 
        // variabel $category berisi informasi category yang dipilih user
        $query->when($filters['author'] ?? false, function($query, $author) {
            // whereHas untuk relasi method, lalu jalankan fungsi apa
            return $query->whereHas('author', function($query) use ($author) {
                // dimana username nya sesuai dengan variabel $author yang dipilih
                $query->where('username', $author);
            });
        });
    }

    // membuat relasi ke model category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // membuat relasi ke model user
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // membuat data mengirimkan slug sebagai parameter utama selain id (untuk view, edit dan hapus)
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // membuat slug otomatis ketika title di input
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    } 
}
