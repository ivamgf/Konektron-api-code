<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Column_Providers extends CI_Migration 
{

	public function up()
	{
		if (!$this->db->field_exists('pr_token', 'providers')) {
			$this->dbforge->add_column(
				'providers', 
				[
					'pr_token' => array(
							'type' => 'VARCHAR',
							'constraint' => '255',
							'null' => TRUE,
							'after' => 'pr_balance'
					)
				]
			);
			$this->db->set('pr_token', 'MD5(CONCAT(pr_email,pr_password))', false);
			$this->db->where('pr_token is null', null, false);
			$this->db->update('providers');
		}
	}

	public function down()
	{
		if ($this->db->field_exists('pr_token', 'providers')) {
			$this->dbforge->drop_column('providers', 'pr_token');
		}
	}
}
