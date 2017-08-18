<?php namespace shayankhaksar\Zarinpal\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAtZarinpalTranstacions4 extends Migration
{
    public function up()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->integer('amount')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->dropColumn('amount');
        });
    }
}
