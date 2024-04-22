<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_bn')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->string('code');
            $table->string('short_description_en');
            $table->string('short_description_bn')->nullable();
            $table->longText('long_description_en');
            $table->longText('long_description_bn')->nullable();
            $table->string('image');
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0.00);
            $table->integer('quantity');
            $table->boolean('status')->default(1);
            $table->timestamps();

            // foreign category_id
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
