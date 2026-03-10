<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('category', ['EPUB','FREE','PRESS'])->nullable(false);
            $table->string('name', 500)->nullable(false);
            $table->string('isbn', 100)->nullable(false);
            $table->text('author')->nullable(false);
            $table->text('description')->nullable(false);
            $table->float('value',6,2)->nullable(false)->default(99.99);
            $table->string('link', 1000)->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
    }
};
