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
        Schema::create('register_products', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->decimal('price',12,2);
            $table->decimal('selling_price');
            $table->enum('action_type', \App\Enums\ActionTypeEnum::toArray());
            $table->foreignId('product_id')->constrained();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('register_products');
    }
};
