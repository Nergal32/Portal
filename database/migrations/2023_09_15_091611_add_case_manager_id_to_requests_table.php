<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('applications', function (Blueprint $table) {
            $table->unsignedBigInteger('case_manager_id')->nullable();
            $table->foreign('case_manager_id')->references('id')->on('users');
        });
    }
    
    public function down() {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['case_manager_id']);
            $table->dropColumn('case_manager_id');
        });
    }
    
    
};
