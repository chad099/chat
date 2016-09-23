<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->string('profile_picture')->nullable();
            $table->string('token')->nullable();
            $table->string('auth_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users',function(Blueprint $table){
          $table->dropColumn('profile_picture','token', 'auth_type');
      });
    }
}
