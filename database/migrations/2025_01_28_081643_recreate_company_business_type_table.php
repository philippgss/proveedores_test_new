<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateCompanyBusinessTypeTable extends Migration
{
    public function up()
    {
        // First drop the existing table if it exists
        Schema::dropIfExists('company_business_type');

        // Create the proper pivot table
        Schema::create('company_business_type', function (Blueprint $table) {
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('business_type_id')->constrained('business_types')->onDelete('cascade');
            $table->timestamps();

            // Add a primary key using both columns
            $table->primary(['company_id', 'business_type_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_business_type');
    }
}