<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Tag;
use App\Post;
use App\User;

use Illuminate\Support\Facades\Hash;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat1=Category::create([
        'name'=>'News',
        ]);
        $cat2=Category::create([
'name'=>'Design',
        ]);
        $cat3 = Category::create([
            'name' => 'Partenship',
        ]);
        $cat4 = Category::create([
            'name' => 'Hiring',
        ]);
        $cat5 = Category::create([
            'name' => 'Social',
        ]);

$author1=User::create([
'name'=>'vijay kumar',
'email'=>'vk77093@gmail.com',
'role'=>'admin',
'password'=>Hash::make('vijay123'),
]);
        $author2 = User::create([
            'name' => 'krishna kumar',
            'email' => 'krishn7855@gmail.com',

            'password' => Hash::make('vijay123'),
        ]);
        $author3 = User::create([
            'name' => 'ajit sharma',
            'email' => 'ajit7855@gmail.com',

            'password' => Hash::make('vijay123'),
        ]);


        $post1=Post::create([
            'title'=> 'We relocated our office to a new designed garage',
            'description'=> 'Where does it come from',
            'content'=> 'Contrary to popular belief,
            Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur,
            from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics,
            very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes
            from a line in section 1.10.32.',
            'category_id'=>$cat1->id,
            'published_at'=>'2020-03-31 08:00:00',
            'image'=>'posts/1.jpg',
            'user_id'=>$author1->id,

        ]);
        $post2=Post::create([
            'title'=> 'op 5 brilliant content marketing strategies',
            'description'=> 'Where can I get some',
            'content'=> 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
            'category_id'=>$cat2->id,
            'published_at' => '2020-03-31 08:00:00',
            'image'=>'posts/2.jpg',
            'user_id'=>$author2->id,
        ]);
        $post3=Post::create([
            'title'=> 'Best practices for minimalist design with example',
            'description'=> 'Where does it come from',
            'content'=> 'Contrary to popular belief,
            Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur,
            from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics,
            very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes
            from a line in section 1.10.32.',
            'category_id'=>$cat3->id,
            'published_at' => '2020-03-31 08:00:00',
            'image'=>'posts/3.jpg',
            'user_id'=>$author3->id,
        ]);
        $post4=Post::create([
            'title'=> 'Congratulate and thank to Maryam for joining our team',
            'description'=> 'Where can I get some',
            'content'=> 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
            'category_id'=>$cat4->id,
            'published_at' => '2020-03-31 08:00:00',
            'image'=>'posts/4.jpg',
            'user_id' => $author2->id,
        ]);
        $post5 = Post::create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'Where can I get some',
            'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
            'category_id' => $cat5->id,
            'published_at' => '2020-03-31 08:00:00',
            'image' => 'posts/5.jpg',
            'user_id' => $author3->id,
        ]);

        $tag1=Tag::create(['tag_name'=>'Record']);
        $tag2 = Tag::create(['tag_name' => 'Progress']);
        $tag3 = Tag::create(['tag_name' => 'customers']);
        $tag4 = Tag::create(['tag_name' => 'Offer']);
        $tag5 = Tag::create(['tag_name' => 'design']);

        $post1->tags()->attach([$tag1->id,$tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag3->id, $tag4->id]);
        $post4->tags()->attach([$tag4->id, $tag5->id]);
        $post5->tags()->attach([$tag5->id, $tag1->id]);

    }
}
