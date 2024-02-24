<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name_product');

            $table->double('price');

            $table->foreignId('category_id')
            ->refrences('id')
            ->on('categories')
            ->cascadeOnDelete();

            $table->foreignId('user_id')
            ->refrences('id')
            ->on('users')
            ->cascadeOnDelete()
            ->nullable();

            $table->timestamps();

        });
    }


    public function down(): void
    {

    }
};
