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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'user_id')->constrained();
            $table->string(column: 'cliente_nombre', length: 125);
            $table->string(column: 'cliente_cedula', length: 125);
            $table->string(column: 'cliente_telefono', length: 125);
            $table->string(column: 'total_venta', length: 125)->nullable();
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
        Schema::dropIfExists('sales');
    }
};
