<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checklists', function (Blueprint $table){

         $table -> foreign('user_id', 'chk-usr')
                -> references('id')
                -> onDelete('cascade')
                -> on('users');
       });


       Schema::table('tasks', function (Blueprint $table) {

         $table -> foreign('checklist_id', 'tsk-chk')
                -> references('id')
                -> onDelete('cascade')
                -> on('checklists');

       });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('checklists', function (Blueprint $table) {

           $table -> dropForeign('chk-usr');

         });

         Schema::table('tasks', function (Blueprint $table) {

           $table -> dropForeign('tsk-chk');

         });
    }
}
