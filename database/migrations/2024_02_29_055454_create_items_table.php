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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity')->nullable();
            $table->float('price')->nullable();
            $table->boolean('state');
            $table->timestamps();

            $table->unsignedBigInteger('shopping_list_id');
            $table->foreign('shopping_list_id')
                  ->references('id')
                  ->on('shoppinglists')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
