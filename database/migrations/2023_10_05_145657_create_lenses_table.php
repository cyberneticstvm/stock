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
        Schema::create('lenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('coating_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('material_id')->nullable();
            $table->enum('eye', ['re', 'le', 'both'])->default('both');
            $table->string('sph', 7)->nullable();
            $table->string('cyl', 7)->nullable();
            $table->string('axis', 7)->nullable();
            $table->string('add', 7)->nullable();
            $table->integer('qty')->default(0);
            $table->string('shelf')->nullable();
            $table->string('box')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
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
        Schema::dropIfExists('lenses');
    }
};
