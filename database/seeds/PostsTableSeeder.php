<?php

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $category1 = Category::create([
        'name' => 'News'
      ]);

      $category2 = Category::create([
        'name' => 'Marketing'
      ]);

      $category3 = Category::create([
        'name' => 'Partnership'
      ]);

      $author1 = App\User::create([
        'name' => 'Jeremiah Okoro',
        'email' => 'jerryhanks@gmail.com',
        'password' => Hash::make('password')
      ]);

      $author2 = App\User::create([
        'name' => 'Jane Okoro',
        'email' => 'jannyhanks@gmail.com',
        'password' => Hash::make('password')
      ]);

      $author3 = App\User::create([
        'name' => 'Bisi Okoro',
        'email' => 'bisihanks@gmail.com',
        'password' => Hash::make('password')
      ]);

      $post1 = $author1->posts()->create([
        'title' => 'We relocated our office to a new designed garage',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'content' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'category_id' => $category1->id,
        'image' => 'posts/1.jpg'
      ]);

      $post2 = $author2->posts()->create([
          'title' => 'Top 5 brilliant content marketing strategies',
          'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
          'content' => 'Ex sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
          'category_id' => $category2->id,
          'image' => 'posts/2.jpg'
        ]);

        $post3 = $author1->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'content' => 'Exquisite sint occaecat cupidatat non proident, sunt lpa qui officia deserunt mollit anim id est laborum.',
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg'
          ]);

          $post4 = $author3->posts()->create([
              'title' => 'Congratulate and thank to Maryam for joining our team',
              'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
              'content' => 'Exquisite sint occaecat cupidatat non proident, sunt lpa qui officia deserunt mollit anim id est laborum.',
              'category_id' => $category2->id,
              'image' => 'posts/4.jpg'
            ]);

            $tag1 = Tag::create([
              'name' => 'Job'
            ]);

            $tag2 = Tag::create([
              'name' => 'Customers'
            ]);

            $tag3 = Tag::create([
              'name' => 'Record'
            ]);

            $post1->tags()->attach([$tag1->id, $tag2->id]);
            $post2->tags()->attach([$tag2->id, $tag3->id]);
            $post3->tags()->attach([$tag1->id, $tag3->id]);


    }
}
