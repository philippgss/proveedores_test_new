<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('type'); // either 'product' or 'service'
            $table->timestamps();
        });

        // Assign types to categories
        $categoryTypes = [
            1 => 'product',
            2 => 'product',
            3 => 'product',
            4 => 'service',
            5 => 'product',
        ];

        foreach ($categoryTypes as $categoryId => $type) {
            DB::table('category_types')->insert([
                'category_id' => $categoryId,
                'type' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_types');
    }
}