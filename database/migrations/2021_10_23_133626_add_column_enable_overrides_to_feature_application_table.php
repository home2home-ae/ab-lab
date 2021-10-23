<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEnableOverridesToFeatureApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feature_applications', function (Blueprint $table) {
            $table->boolean('are_overrides_active')->default(true);
        });

        Schema::table('feature_applications_devo', function (Blueprint $table) {
            $table->boolean('are_overrides_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feature_applications', function (Blueprint $table) {
            $table->dropColumn('are_overrides_active');
        });

        Schema::table('feature_applications_devo', function (Blueprint $table) {
            $table->dropColumn('are_overrides_active');
        });
    }
}
