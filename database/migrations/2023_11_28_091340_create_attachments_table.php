<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('display_name')->nullable();
            $table->string('extra_identifier')->nullable();
            $table->string('path_original');
            $table->string('path_512')->nullable();
            $table->string('path_1024')->nullable();
            $table->string('size');
            $table->string('type')->nullable();
            $table->nullableMorphs('attachment');
            $table->integer('sequence')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
