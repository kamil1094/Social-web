<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Friend;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

    	$faker = Faker::create('en_EN');

    	$number_of_users = 20;
      $max_posts_per_user = 20;
      $max_comments_per_post = 10;
    	$password = 'pass';

        DB::table('roles')->insert([
            'id' => 1,
            'type' => 'admin',
            ]);

        DB::table('roles')->insert([
            'id' => 2,
            'type' => 'user',
            ]);


    	for($user_id = 1; $user_id <= $number_of_users; $user_id++)
    	{

            if($user_id === 1)
            {
              $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large;
              $name = $faker->firstNameMale . ' ' . $faker->lastName;
                    DB::table('users')->insert([
                    'name' => $name,
                    'email' => str_replace('-', '', str_slug($name)) . '@' . $faker->safeEmailDomain,
                    'sex' => 'm',
                    'role_id' => 1,
                    'avatar' => $avatar,
                    'password' => bcrypt('qwerty'),
                ]);
            }
            else
            {
                $sex = $faker->randomElement(['m', 'f']);

                if($sex == 'm'){
                $name = $faker->firstNameMale . ' ' . $faker->lastName;
                $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large;
                }
                else
                {
                    $name = $faker->firstNameFemale . ' ' . $faker->firstName;
                    $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=female'))->results[0]->picture->large;
                }



                DB::table('users')->insert([
                    'name' => $name,
                    'email' => str_replace('-', '', str_slug($name)) . '@' . $faker->safeEmailDomain,
                    'sex' => $sex,
                    'role_id' => 2,
                    'avatar' => $avatar,
                    'password' => bcrypt($password),
                ]);
            }

    		for($i = 1; $i <= $faker->numberBetween($min = 0,$max = $number_of_users-1); $i++)
            {
                $friend_id = $faker->numberBetween($min = 1, $max = $number_of_users);

                $friendship = Friend::where([
                    'user_id' => $user_id,
                    'friend_id' => $friend_id,
                ])->orWhere([
                    'user_id' => $friend_id,
                    'friend_id' => $user_id,
                ])->exists();

                if(!$friendship && $user_id != $friend_id)
                {
                    DB::table('friends')->insert([
                            'user_id' => $user_id,
                            'friend_id' => $friend_id,
                            'accepted' => 1,
                            'created_at' => $faker->dateTimeThisYear($max = 'now'),
                        ]);
                }

            }

            for($user_post_id = 1; $user_post_id <= $faker->numberBetween($min = 1,$max = $max_posts_per_user); $user_post_id++)
            {
                DB::table('posts')->insert([
                    'user_id' => $user_post_id,
                    'content' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
                    'created_at' => $faker->dateTimeThisYear($max = 'now'),
                ]);
                $post_id = DB::getPdo()->lastInsertId();
                for($comment_id = 1; $comment_id <= $faker->numberBetween($min = 0,$max = $max_comments_per_post); $comment_id++)
                {
                    DB::table('comments')->insert([
                        'post_id' => $post_id,
                        'user_id' => $faker->numberBetween($min = 1, $max = $number_of_users),
                        'content' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
                        'created_at' => $faker->dateTimeThisYear($max = 'now'),
                    ]);
                }
            }

    	} //koniec petli tworzacej uzytkownika


    }
}
