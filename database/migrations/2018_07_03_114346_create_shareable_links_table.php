<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareable_links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash', 30)->unique();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('entry_id')->unsigned()->index();
            $table->boolean('allow_edit')->default(0);
            $table->boolean('allow_download')->default(1);
            $table->string('password')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->collation = config('database.connections.mysql.collation');
            $table->charset = config('database.connections.mysql.charset');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shareable_links');
    }
};
