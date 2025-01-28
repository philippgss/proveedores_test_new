<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameCompanyBusinessTypeTable extends Migration
{
    public function up()
    {
        Schema::rename('company_business_type', 'business_type_company');
    }

    public function down()
    {
        Schema::rename('business_type_company', 'company_business_type');
    }
}