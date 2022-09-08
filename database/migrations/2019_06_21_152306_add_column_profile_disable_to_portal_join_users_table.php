<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProfileDisableToPortalJoinUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portal_join_users', function (Blueprint $table) {
            $table->boolean('profile_disable')->after('isvisible')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portal_join_users', function (Blueprint $table) {
            $table->dropColumn('profile_disable');
        });
    }
}
