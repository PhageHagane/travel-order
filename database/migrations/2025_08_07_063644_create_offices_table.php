<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('offices')) {
            Schema::create('offices', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('abbr')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });

            // Insert permissions into the permissions table
            $permissions = [
                ['name' => 'View Office', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Store Office', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Update Office', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Delete Office', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ];

            DB::table('permissions')->insert($permissions);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offices');

        // Remove permissions added in up()
        DB::table('permissions')
            ->whereIn('name', [
                'View Office',
                'Store Office',
                'Update Office',
                'Delete Office',
            ])
            ->delete();
    }
}
