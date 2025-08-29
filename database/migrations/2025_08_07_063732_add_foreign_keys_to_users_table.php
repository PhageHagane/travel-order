<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddForeignKeysToUsersTable.
 */
class AddForeignKeysToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add foreign key columns
            $table->unsignedBigInteger('office_id')->nullable()->after('email');
            $table->unsignedBigInteger('division_id')->nullable()->after('office_id');
            $table->unsignedBigInteger('client_type_id')->nullable()->after('division_id');
            
            // Add foreign key constraints
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('set null');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('set null');
            $table->foreign('client_type_id')->references('id')->on('client_types')->onDelete('set null');
            
            // Add indexes for better performance
            $table->index('office_id');
            $table->index('division_id');
            $table->index('client_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key constraints first
            $table->dropForeign(['office_id']);
            $table->dropForeign(['division_id']);
            $table->dropForeign(['client_type_id']);
            
            // Drop indexes
            $table->dropIndex(['office_id']);
            $table->dropIndex(['division_id']);
            $table->dropIndex(['client_type_id']);
            
            // Drop columns
            $table->dropColumn(['office_id', 'division_id', 'client_type_id']);
        });
    }
}