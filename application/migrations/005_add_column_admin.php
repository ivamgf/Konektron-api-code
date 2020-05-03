<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Column_Admin extends CI_Migration
{

	public function up()
	{
		if (!$this->db->field_exists('ad_token', 'admin')) {
			$this->dbforge->add_column(
				'admin',
				[
					'ad_token' => array(
							'type' => 'VARCHAR',
							'constraint' => '255',
							'null' => TRUE,
							'after' => 'ad_password'
					)
				]
			);
			$this->db->set('ad_token', 'MD5(CONCAT(ad_email,ad_password))', false);
			$this->db->where('ad_token is null', null, false);
			$this->db->update('admin');
		}
	}

	public function down()
	{
		if ($this->db->field_exists('ad_token', 'admin')) {
			$this->dbforge->drop_column('admin', 'ad_token');
		}
	}
}
