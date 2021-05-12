<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToastToRestaruants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaruants', function (Blueprint $table) {
            $table->text('toast_id')->nullable(true)->after('app_id');
            $table->text('toast_secret')->nullable(true)->after('toast_id');
            $table->text('toast_token')->nullable(true)->after('toast_secret');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaruants', function (Blueprint $table) {
            $table->dropColumn('toast_id');
            $table->dropColumn('toast_secret');
            $table->dropColumn('toast_token');
        });
    }
}
