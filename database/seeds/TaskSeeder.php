<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\Checklist;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Task::class, 100)
            -> make()
            -> each(function ($tsk) {
                $chk = Checklist::inRandomOrder() -> first();
                $tsk -> checklist() -> associate($chk);
                $tsk -> save();
            });
    }
}
