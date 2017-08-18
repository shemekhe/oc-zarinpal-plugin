<?php namespace at\Zarinpal\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAtZarinpalTranstacions5 extends Migration
{
    public function up()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->dropColumn('mobile');
            $table->dropColumn('email');
        });
    }
    
    public function down()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->integer('mobile')->nullable();
            $table->string('email', 255)->nullable();
        });
    }
}
