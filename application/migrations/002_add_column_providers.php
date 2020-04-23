<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Column_Providers extends CI_Migration 
{

	public function up()
	{
		if (!$this->db->field_exists('pr_status', 'providers')) {
			$this->dbforge->add_column(
				'providers', 
				[
					'pr_status' => array(
							'type' => 'VARCHAR',
							'constraint' => '9',
							'null' => false,
							'after' => 'pr_token'
					)
				]
			);
			$this->db->set('pr_status', 'inactive');
			$this->db->where('pr_status is null', null, false);
			$this->db->update('providers');
		}
	}

	public function down()
	{
		if ($this->db->field_exists('pr_status', 'providers')) {
			$this->dbforge->drop_column('providers', 'pr_status');
		}
	}
}
