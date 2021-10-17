<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableFeatureEventsAddFeatureId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('feature_events');

        // audit logs..
        Schema::create('feature_events', function (Blueprint $table) {
            $table->id();
            $table->enum('level', ['INFO', 'WARNING'])->default('INFO');
            $table->enum('type', [
                'CREATED',
                'UPDATED',
                'TREATMENT UPDATED',
                'TREATMENT INFO UPDATED',
                'APPLICATION ADDED',
                'SCHEDULE',
                'ON/OFF',
                'COMMENT',
                'OVERRIDE ADDED',
                'OVERRIDE DELETED',
                'ALLOCATION UPDATED',
                'SYSTEM'
            ]);
            $table->unsignedBigInteger('feature_id');
            $table->unsignedBigInteger('user_id');
            $table->mediumText('description');
            $table->mediumText('raw');

            $table->timestamps();

            $table->foreign('feature_id')->references('id')->on('features');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_events');

        // audit logs..
        Schema::create('feature_events', function (Blueprint $table) {
            $table->id();

            $table->enum('level', ['INFO', 'WARNING'])->default('INFO');
            $table->enum('type', ['SCHEDULE', 'ON/OFF', 'COMMENT']);
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('user_id');
            $table->mediumText('description');

            $table->timestamps();

            $table->foreign('application_id')->references('id')->on('applications');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
