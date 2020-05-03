<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Column_Providers extends CI_Migration 
{

	public function up()
	{
		if (!$this->db->field_exists('pr_token_forgot', 'providers')) {
			$this->dbforge->add_column(
				'providers', 
				[
					'pr_token_forgot' => array(
							'type' => 'VARCHAR',
							'constraint' => '255',
							'null' => true,
							'after' => 'pr_token'
					)
				]
			);
		}
	}

	public function down()
	{
		if ($this->db->field_exists('pr_token_forgot', 'providers')) {
			$this->dbforge->drop_column('providers', 'pr_token_forgot');
		}
	}
}
