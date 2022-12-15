<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // PAKAI FAKER
        User::factory(3)->create();

       
        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' =>'Personal',
            'slug' => 'personal'
        ]);

        Category::create([
            'name' =>'Design',
            'slug' => 'design'
        ]);

        Post::factory(20)->create();

         // CARA MANUAL
        User::create([
            'name' => 'Andhika Prasetya',
            'username' => 'andhikaprasetya',
            'email' => 'andhika@gmail.com',
            'password' => bcrypt('password')
        ]);

        // User::create([
        //     'name' => 'Furfio',
        //     'email' => 'furfio@gmail.com',
        //     'password' => bcrypt('54321')
        // ]);

        // Post::create([
        //     'title' =>'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos error, repudiandae dignissimos aspernatur voluptatum iusto velit rem ipsam dolorum omnis quibusdam odit quas fugit. Cumque molestiae est, expedita impedit aut vitae ex nulla natus excepturi minima odit ipsum sit optio aliquam dolorum. Delectus quod id laudantium numquam voluptate omnis sunt nam vel, consequuntur facere magni totam autem aut magnam.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos error, repudiandae dignissimos aspernatur voluptatum iusto velit rem ipsam dolorum omnis quibusdam odit quas fugit. Cumque molestiae est, expedita impedit aut vitae ex nulla natus excepturi minima odit ipsum sit optio aliquam dolorum. Delectus quod id laudantium numquam voluptate omnis sunt nam vel, consequuntur facere magni totam autem aut magnam.inima dolorum suscipit ex, nobis nisi iure. Corporis optio ullam cumque autem, quas necessitatibus quam architecto quaerat! Explicabo, quo facilis. Assumenda quaerat rem, nobis cum totam soluta, sit reiciendis ab accusantium unde natus. Molestiae quis, laudantium laboriosam reprehenderit eos fugit, ipsa ut magnam hic saepe eius. Delectus aliquam consequatur officia nemo accusantium.Iste exercitationem eveniet quis nihil at cupiditate tempore corporis sint excepturi nisi pariatur esse illum minima officiis adipisci ex illo optio, ducimus soluta voluptate. Exercitationem veritatis deleniti perspiciatis in reprehenderit, voluptates accusamus dolores ipsam assumenda fugit qui aliquam laudantium.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);
        
        // Post::create([
        //     'title' =>'Judul Kedua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos error, repudiandae dignissimos aspernatur voluptatum iusto velit rem ipsam dolorum omnis quibusdam odit quas fugit. Cumque molestiae est, expedita impedit aut vitae ex nulla natus excepturi minima odit ipsum sit optio aliquam dolorum. Delectus quod id laudantium numquam voluptate omnis sunt nam vel, consequuntur facere magni totam autem aut magnam.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos error, repudiandae dignissimos aspernatur voluptatum iusto velit rem ipsam dolorum omnis quibusdam odit quas fugit. Cumque molestiae est, expedita impedit aut vitae ex nulla natus excepturi minima odit ipsum sit optio aliquam dolorum. Delectus quod id laudantium numquam voluptate omnis sunt nam vel, consequuntur facere magni totam autem aut magnam.inima dolorum suscipit ex, nobis nisi iure. Corporis optio ullam cumque autem, quas necessitatibus quam architecto quaerat! Explicabo, quo facilis. Assumenda quaerat rem, nobis cum totam soluta, sit reiciendis ab accusantium unde natus. Molestiae quis, laudantium laboriosam reprehenderit eos fugit, ipsa ut magnam hic saepe eius. Delectus aliquam consequatur officia nemo accusantium.Iste exercitationem eveniet quis nihil at cupiditate tempore corporis sint excepturi nisi pariatur esse illum minima officiis adipisci ex illo optio, ducimus soluta voluptate. Exercitationem veritatis deleniti perspiciatis in reprehenderit, voluptates accusamus dolores ipsam assumenda fugit qui aliquam laudantium.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' =>'Judul ketiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos error, repudiandae dignissimos aspernatur voluptatum iusto velit rem ipsam dolorum omnis quibusdam odit quas fugit. Cumque molestiae est, expedita impedit aut vitae ex nulla natus excepturi minima odit ipsum sit optio aliquam dolorum. Delectus quod id laudantium numquam voluptate omnis sunt nam vel, consequuntur facere magni totam autem aut magnam.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos error, repudiandae dignissimos aspernatur voluptatum iusto velit rem ipsam dolorum omnis quibusdam odit quas fugit. Cumque molestiae est, expedita impedit aut vitae ex nulla natus excepturi minima odit ipsum sit optio aliquam dolorum. Delectus quod id laudantium numquam voluptate omnis sunt nam vel, consequuntur facere magni totam autem aut magnam.inima dolorum suscipit ex, nobis nisi iure. Corporis optio ullam cumque autem, quas necessitatibus quam architecto quaerat! Explicabo, quo facilis. Assumenda quaerat rem, nobis cum totam soluta, sit reiciendis ab accusantium unde natus. Molestiae quis, laudantium laboriosam reprehenderit eos fugit, ipsa ut magnam hic saepe eius. Delectus aliquam consequatur officia nemo accusantium.Iste exercitationem eveniet quis nihil at cupiditate tempore corporis sint excepturi nisi pariatur esse illum minima officiis adipisci ex illo optio, ducimus soluta voluptate. Exercitationem veritatis deleniti perspiciatis in reprehenderit, voluptates accusamus dolores ipsam assumenda fugit qui aliquam laudantium.',
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);
        // Post::create([
        //     'title' =>'Judul keempat',
        //     'slug' => 'judul-keempat',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos error, repudiandae dignissimos aspernatur voluptatum iusto velit rem ipsam dolorum omnis quibusdam odit quas fugit. Cumque molestiae est, expedita impedit aut vitae ex nulla natus excepturi minima odit ipsum sit optio aliquam dolorum. Delectus quod id laudantium numquam voluptate omnis sunt nam vel, consequuntur facere magni totam autem aut magnam.',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quos error, repudiandae dignissimos aspernatur voluptatum iusto velit rem ipsam dolorum omnis quibusdam odit quas fugit. Cumque molestiae est, expedita impedit aut vitae ex nulla natus excepturi minima odit ipsum sit optio aliquam dolorum. Delectus quod id laudantium numquam voluptate omnis sunt nam vel, consequuntur facere magni totam autem aut magnam.inima dolorum suscipit ex, nobis nisi iure. Corporis optio ullam cumque autem, quas necessitatibus quam architecto quaerat! Explicabo, quo facilis. Assumenda quaerat rem, nobis cum totam soluta, sit reiciendis ab accusantium unde natus. Molestiae quis, laudantium laboriosam reprehenderit eos fugit, ipsa ut magnam hic saepe eius. Delectus aliquam consequatur officia nemo accusantium.Iste exercitationem eveniet quis nihil at cupiditate tempore corporis sint excepturi nisi pariatur esse illum minima officiis adipisci ex illo optio, ducimus soluta voluptate. Exercitationem veritatis deleniti perspiciatis in reprehenderit, voluptates accusamus dolores ipsam assumenda fugit qui aliquam laudantium.',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);
    }
}
