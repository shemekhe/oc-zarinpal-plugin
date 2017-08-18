<?php namespace ShayanKhaksar\Zarinpal\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAtZarinpalTranstacions2 extends Migration
{
    public function up()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->string('ref_id', 255)->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->integer('mobile')->nullable()->change();
            $table->string('email', 255)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('at_zarinpal_transtacions', function($table)
        {
            $table->string('ref_id', 255)->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
            $table->integer('mobile')->nullable(false)->change();
            $table->string('email', 255)->nullable(false)->change();
        });
    }
}
