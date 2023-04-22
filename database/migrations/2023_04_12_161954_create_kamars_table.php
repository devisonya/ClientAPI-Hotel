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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->char('nokamar', 7);
            $table->string('namakamar', 50);
            $table->char('harga', 20);
            $table->char('lantai', 2);
            $table->enum('jeniskamar', ['S', 'D']);
            $table->enum('status', ['O', 'V', 'VD']);
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
        Schema::dropIfExists('kamars');
    }
};
