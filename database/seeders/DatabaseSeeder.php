<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;
use App\Models\Comments;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Eloquent\Factories\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
    //     Posts::factory(10)->create();





    public function run()
    {
        for($i = 1; $i<50; $i++){
            Comments::insert([  //вносим в таблицу данные если есть колонки

                'like'  =>  rand(1,50),
                'post'  =>  rand(1,20),
                'comment'  =>  Str::random(5).' '.Str::random(10).' '.Str::random(15),
                'activ'  =>  0,


                'data'=>  rand(0,24).'-'.rand(0,24).'-'.rand(0,24),
                'name'=>  fake()->unique()->name(),

            ]);
        }

    }


}

    // $table->id();
    //         $table->text('comment')->nullable();
    //         $table->integer('post')->nullable();
    //         $table->integer('like')->nullable();
    //         $table->string('name')->nullable();
    //         $table->integer('activ')->nullable();

            // $table->id();
            // $table->timestamps();
            // $table->text('caption')->nullable();
            // $table->bigInteger('message_id')->nullable();
            // $table->text('text')->nullable();
            // $table->tinyText('date',32)->nullable();
            // $table->tinyText('first_name',32)->nullable();
            // $table->text('file_id')->nullable();
            // $table->text('reply_mess')->nullable();
            // $table->tinyText('fotoNoZip',32)->nullable();
            // $table->text('reply_caption')->nullable();
            // $table->tinyText('username',32)->nullable();
            //
            // //     for($i = 1; $i<20; $i++){
            // Posts::insert([  //вносим в таблицу данные если есть колонки
            //     'reply_caption' =>  Str::random(9).' '.Str::random(8),
            //     'file_id'  =>  rand(1,50),
            //     'text'  =>  Str::random(5).' '.Str::random(10).' '.Str::random(15),
            //     'message_id'=>  $i,
            //     'caption'=>  Str::random(9).' '.Str::random(8),
            //     'date'=>  rand(0,24).'-'.rand(0,24).'-'.rand(0,24),
            //     'username'=>  fake()->unique()->name(),
            //     'first_name'=>  fake()->unique()->name(),
            // ]);