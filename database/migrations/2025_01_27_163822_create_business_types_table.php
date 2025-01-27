<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateBusinessTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Business type name
            $table->string('slug')->unique(); // Slug for URLs
            $table->string('category_type'); // New column for category type
            $table->timestamps(); // Created at and updated at timestamps
        });

        // Prefill the table with data
        $businessTypes = [
            'Distribuidores mayoristas' => 'product',
            'Dropshipping' => 'product',
            'Exportadores' => 'product',
            'Fabricantes' => 'product',
            'Servicios' => 'service',
        ];

        foreach ($businessTypes as $name => $type) {
            DB::table('business_types')->insert([
                'name' => $name,
                'slug' => Str::slug($name),
                'category_type' => $type,
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
        Schema::dropIfExists('business_types');
    }
}