<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 12)->nullable();
            $table->decimal('selling_price', 12)->nullable();
            $table->string('bar_code')->unique()->nullable();
            $table->string('description')->nullable();
            $table->string('description_ru')->nullable();
            $table->string('name_ru')->nullable();
            $table->bigInteger('code')->unique()->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('category_id')->constrained();
            $table->foreignId('brand_id')->constrained();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
