<?php namespace shayankhaksar\Zarinpal\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAtZarinpalTranstacions3 extends Migration
{
    public function up()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->integer('status');
        });
    }
    
    public function down()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->dropColumn('status');
        });
    }
}
