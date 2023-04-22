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
        Schema::create('pemesans', function (Blueprint $table) {
            $table->id();
            $table->char('kodepemesan', 7);
            $table->string('namapemesan', 50);
            $table->enum('jeniskelamin', ['F', 'M']);
            $table->string('tempatlahir', 50);
            $table->date('tanggallahir');
            $table->string('alamat', 50);
            $table->string('email', 100);
            $table->char('nohandphone', 15);
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
        Schema::dropIfExists('pemesans');
    }
};
