<?php namespace shayankhaksar\Zarinpal\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAtZarinpalTranstacions9 extends Migration
{
    public function up()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->integer('user_id')->nullable()->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->dropColumn('user_id');
        });
    }
}
