<?php

class Create_Users_Table {    

	public function up()
    {
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('email');
			$table->string('password');
			$table->text('note')->nullable();
			$table->text('tbd')->nullable();
			$table->boolean('actived')->default(0);
			$table->string('random');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('users');

    }

}