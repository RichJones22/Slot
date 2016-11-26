<?php

use Illuminate\Database\Seeder;

use App\User;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{

    protected $seeds = [
      SeedDBLangTranslations::class,
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UsersTableSeeder::class);

        User::truncate();

        factory(App\User::class, 50)->create();
        

        // run each seed class
        foreach($this->seeds as $seed)
        {
            $this->call($seed);
        }

    }
}
