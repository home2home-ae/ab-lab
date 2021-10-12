<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // in ab-test accessor, we can create a hashmap of identities..
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->string('detail')->nullable();
            $table->string('icon')->nullable();
            $table->enum('type', ['WEB', 'MOBILE', 'DESKTOP'])->default('WEB');

            $table->timestamps();
        });

        Schema::create('features', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->string('name')->unique();
            $table->string('title');
            $table->string('description')->nullable();
            $table->enum('type', ['LAUNCH', 'EXPERIMENT'])->default('LAUNCH');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('feature_treatments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('feature_id');

            // C, T1, T2
            $table->enum('name', ['C', 'T1', 'T2', 'T3'])->default('C');
            $table->string('description');
            $table->string('image')->nullable();

            $table->timestamps();

            $table->foreign('feature_id')->references('id')->on('features');
            $table->unique(['feature_id', 'name']); // a feature can only have one C, one T1, one T2, one T3
        });

        // max is 20 (more than 20 mean it should already be turned on for all users)
        Schema::create('feature_overrides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feature_id');

            $table->string('value'); // customer id, merchant id, address id, etc..
            $table->unsignedBigInteger('feature_treatment_id'); // linked to C, T1, T2 etc..

            $table->timestamps();

            $table->foreign('feature_id')->references('id')->on('features');
            $table->foreign('feature_treatment_id')->references('id')->on('feature_treatments');
        });

        // PROD
        Schema::create('feature_applications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('feature_id');
            $table->unsignedBigInteger('application_id');

            // by default, it's off, once we enable overrides, it's on, it can be paused and launch definition is c: 0 (sum of any other treatment 100%)
            $table->enum('status', ['OFF', 'ON', 'PAUSED', 'LAUNCHED'])->default('OFF');

            $table->timestamps();

            $table->foreign('feature_id')->references('id')->on('features');
            $table->foreign('application_id')->references('id')->on('applications');
        });

        // DEVO, STAGING, LOCAL
        Schema::create('feature_applications_devo', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('feature_id');
            $table->unsignedBigInteger('application_id');

            $table->enum('status', ['OFF', 'ON', 'PAUSED', 'LAUNCHED'])->default('OFF');

            $table->timestamps();

            $table->foreign('feature_id')->references('id')->on('features');
            $table->foreign('application_id')->references('id')->on('applications');
        });

        // treatments
        Schema::create('feature_application_treatments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('feature_application_id');
            $table->unsignedBigInteger('feature_treatment_id');

            // between 0 to 100
            $table->unsignedSmallInteger('allocation')->default(0);

            $table->timestamps();

            $table->foreign('feature_application_id')->references('id')->on('feature_applications');
            $table->foreign('feature_treatment_id')->references('id')->on('feature_treatments');
        });

        // treatments
        Schema::create('feature_applications_treatments_devo', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('feature_application_id');
            $table->unsignedBigInteger('feature_treatment_id');

            // between 0 to 100
            $table->unsignedSmallInteger('allocation')->default(0);

            $table->timestamps();

            $table->foreign('feature_application_id')->references('id')->on('feature_applications');
            $table->foreign('feature_treatment_id')->references('id')->on('feature_treatments');
        });

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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_events');
        Schema::dropIfExists('feature_applications_treatments_devo');
        Schema::dropIfExists('feature_application_treatments');
        Schema::dropIfExists('feature_applications_devo');
        Schema::dropIfExists('feature_applications');
        Schema::dropIfExists('feature_overrides');
        Schema::dropIfExists('feature_treatments');
        Schema::dropIfExists('features');
        Schema::dropIfExists('applications');
    }
}
