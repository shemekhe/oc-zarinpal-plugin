<?php namespace shayankhaksar\Zarinpal\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAtZarinpalTranstacions extends Migration
{
    public function up()
    {
        Schema::create('at_zarinpal_transtacions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('transaction_id')->unsigned();
            $table->string('authority');
            $table->boolean('is_successful');
            $table->string('ref_id');
            $table->text('description');
            $table->integer('mobile');
            $table->string('email');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('at_zarinpal_transtacions');
    }
}
