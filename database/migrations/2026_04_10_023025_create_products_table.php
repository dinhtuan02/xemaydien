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

            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();

            $table->string('name', 200);
            $table->string('slug', 220)->unique();

            $table->decimal('price', 15, 2);
            $table->decimal('sale_price', 15, 2)->nullable();

            $table->integer('quantity')->default(0);
            $table->string('color', 50)->nullable();
            $table->integer('max_speed')->nullable()->comment('km/h');
            $table->integer('range_per_charge')->nullable()->comment('km');
            $table->integer('battery_capacity')->nullable()->comment('Wh');
            $table->integer('charging_time')->nullable()->comment('minutes');

            $table->string('thumbnail')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('specifications')->nullable();

            $table->integer('sold_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_sale')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
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
