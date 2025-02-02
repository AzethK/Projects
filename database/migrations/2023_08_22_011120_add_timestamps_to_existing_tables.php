<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddTimestampsToExistingTables extends Migration
{
    public function up()
    {
        // Get the list of table names
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();

        foreach ($tables as $table) {
            if ($table !== 'personal_access_tokens') {
                Schema::table($table, function ($table) {
                    $table->timestamp('created_at')->useCurrent();
                    $table->timestamp('updated_at')->useCurrent();
                });
            }
        }
    }

    public function down()
    {
        // Rollback code if needed
    }
}