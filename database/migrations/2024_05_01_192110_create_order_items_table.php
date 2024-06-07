<?php

use App\Enums\ProductType;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('size')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->integer('product_type')
                ->default(ProductType::PIZZA);
            $table->integer('count');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
