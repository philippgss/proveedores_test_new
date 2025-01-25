<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressFieldsToCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('street')->nullable(); // Street address
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('set null'); // City (foreign key to cities table)
            $table->foreignId('province_id')->nullable()->constrained('provinces')->onDelete('set null'); // Province (foreign key to provinces table)
            $table->string('postal_code', 10)->nullable(); // Postal code (short string)
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null'); // Country (foreign key to countries table)
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['city_id']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['province_id']); // Drop the new foreign key constraint

            // Drop columns
            $table->dropColumn(['street', 'city_id', 'postal_code', 'country_id', 'province_id']); // Include province_id in the dropColumn list
        });
    }
}