<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Post 
{
    private static $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Andhika",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima corporis eveniet aliquam, maxime eum quibusdam nemo labore esse modi expedita culpa, totam temporibus voluptatem ratione iusto nihil recusandae sed excepturi."
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Furfio",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum, dolorem corporis. Modi enim, cum accusamus repellendus repellat numquam dolorum illum. Vitae, eius sequi! Fuga reiciendis, optio voluptate nemo reprehenderit illo architecto aperiam et est error, officiis recusandae ullam perspiciatis dicta? Quod dignissimos exercitationem placeat error atque incidunt ducimus maiores excepturi quasi! Culpa soluta, mollitia ab nemo aliquid adipisci dolore rerum voluptatibus temporibus, facilis optio. Est molestiae perferendis, cupiditate doloribus, earum incidunt quibusdam odit nisi neque consequuntur consectetur corporis!"
        ],
    ];

    public static function all()
    {
        // liat dokumentasi Eloquent : collection
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();

        // $post = [];
        // foreach($posts as $p){
        //     if($p['slug'] === $slug){
        //         $post = $p;
        //     }
        // }
        // return $post;

        return $posts->firstWhere('slug', $slug);
    }

}