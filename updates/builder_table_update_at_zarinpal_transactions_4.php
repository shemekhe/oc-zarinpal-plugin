<?php namespace ShayanKhaksar\Zarinpal\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class builder_table_update_at_zarinpal_transactions_4 extends Migration
{
    public function up()
    {
         Schema::table('at_zarinpal_transtacions', function($table)
         {
             $table->string('authority')->unique()->change();
         });
    }

    public function down()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->string('authority')->unique(false)->change();
        });
    }
}