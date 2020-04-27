<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name', 32);
            $table->string('Slug', 20);
            $table->text('Description');
            $table->date('ReleaseDate');
            $table->tinyInteger('Rating');
            $table->decimal('TicketPrice', 10,2);
            $table->enum('Country', ['USA', 'PK','IN']);
            $table->enum('Genre', ['Action', 'Drama','Animation']);
            $table->string('Photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
}
