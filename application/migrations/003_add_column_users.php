<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Column_Users extends CI_Migration 
{

	public function up()
	{
		if (!$this->db->field_exists('us_token_forgot', 'users')) {
			$this->dbforge->add_column(
				'users', 
				[
					'us_token_forgot' => array(
							'type' => 'VARCHAR',
							'constraint' => '255',
							'null' => true,
							'after' => 'us_token'
					)
				]
			);
		}
	}

	public function down()
	{
		if ($this->db->field_exists('us_token_forgot', 'users')) {
			$this->dbforge->drop_column('users', 'us_token_forgot');
		}
	}
}
