<?php

class Create_Websites_Table {    

	public function up()
    {
		Schema::create('websites', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('url');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('websites');

    }

}