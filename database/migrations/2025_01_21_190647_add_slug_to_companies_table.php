<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
		public function up()
		{
		    Schema::table('companies', function (Blueprint $table) {
		        // First add the column without unique constraint
		        $table->string('slug')->after('com_name');
		    });

		    // We'll add the unique constraint after we populate the slugs
		    Schema::table('companies', function (Blueprint $table) {
		        $table->unique('slug');
		    });
		}

    /**
     * Reverse the migrations.
     */

		public function down()
		{
		    Schema::table('companies', function (Blueprint $table) {
		        $table->dropColumn('slug');
		    });
		}
};
