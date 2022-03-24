<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labelables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('label_id');
            $table->integer('labelable_id');
            $table->string('labelable_type');

            $table->index('labelable_id');
            $table->index('label_id');
            $table->unique(['label_id', 'labelable_id', 'labelable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('labelables');
    }
};
