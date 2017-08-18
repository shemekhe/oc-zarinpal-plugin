<?php namespace at\Zarinpal\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAtZarinpalTranstacions8 extends Migration
{
    public function up()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->string('authority', 255)->nullable()->change();
            $table->boolean('is_successful')->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->string('authority', 255)->nullable(false)->change();
            $table->boolean('is_successful')->default(null)->change();
        });
    }
}
