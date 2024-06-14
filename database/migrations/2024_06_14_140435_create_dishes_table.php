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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 130);
            $table->text('description');
            $table->text('description');
            $table->decimal('price', 5, 2);
            $table->boolea('is_visible')->default(1);
            $table->text('image')->default('https://www.myspiceitup.ca/wp-content/plugins/osetin-helper/assets/img/placeholder-category.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
