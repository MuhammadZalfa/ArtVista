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
    Schema::table('users', function (Blueprint $table) {
        $table->timestamp('updated_at')->nullable();
        $table->timestamp('created_at')->nullable()->change(); // Pastikan created_at nullable jika tidak selalu diisi
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('updated_at');
    });
}

};
