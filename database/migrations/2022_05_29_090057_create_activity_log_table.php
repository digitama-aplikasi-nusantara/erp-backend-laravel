<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->string('id', 8)->primary();
            $table->string('log_name')->nullable();
            $table->text('description');
            //$table->nullableMorphs('subject', 'subject');
            //$table->nullableMorphs('subject', 'subject');
            $table->string('subject_type')->nullable();
            $table->string('subject_id', 36)->nullable();
            $table->string('causer_type')->nullable();
            $table->string('causer_id', 36)->nullable();

            $table->json('properties')->nullable();
            $table->timestamps();
            $table->index('log_name');
        });
    }

    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
    }
}
