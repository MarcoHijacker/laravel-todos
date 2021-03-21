<?php

use Illuminate\Database\Seeder;
use App\Checklist;
use App\User;

class ChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Checklist::class, 20)
            -> make()
            -> each(function ($chk) {
                $usr = User::inRandomOrder() -> first();
                $chk -> user() -> associate($usr);
                $chk -> save();
            });
    }
}
