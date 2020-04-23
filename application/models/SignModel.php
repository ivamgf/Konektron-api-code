<?php
class SignModel extends CI_Model 
{
    public function signup($signup) {
        $this->db->insert('orkney10_konektron_cli.users', $signup);
        return $this->db->insert_id();
    }
    
    public function signupProviders($signupProviders) {
        $this->db->insert('orkney10_konektron_cli.providers', $signupProviders);
        return $this->db->insert_id();
    }

    public function signinUser($us_email, $us_password) {
        $this->db->where("us_email", $us_email);
        $this->db->where("us_password", $us_password);
        $this->db->where("us_status", "active");
        $user = $this->db->get("users")->row_array();
        return $user;
    }
    
    public function signinProviders($pr_email, $pr_password) {
        $this->db->where("pr_email", $pr_email);
        $this->db->where("pr_password", $pr_password);
        $this->db->where("pr_status", "active");
        $provider = $this->db->get("providers")->row_array();
        return $provider;
    }

    public function getAuthUsers($id_auth) {
        return $this->db->get_where('orkney10_konektron_cli.authorization', array('id_auth' => $id_auth))->row();
    }
    
    public function verify($us_email) 
    {
        $this->db->where("us_email", $us_email);
        $user = $this->db->get("users")->row_array();
        return $user;
    }
    
    public function verifyProviders($pr_email) 
    {
        $this->db->where("pr_email", $pr_email);
        $provider = $this->db->get("providers")->row_array();
        return $provider;
    }

    public function tokenUpdate($us_email, $token)
    {
        $this->db->where('us_email', $us_email);
        $this->db->update('orkney10_konektron_cli.users', array('us_token' => $token));
        return $this->db->affected_rows() > 0;
    }
    
    public function tokenUpdateProvider($pr_email, $token)
    {
        $this->db->where('pr_email', $pr_email);
        $this->db->update('orkney10_konektron_cli.providers', array('pr_token' => $token));
        return $this->db->affected_rows() > 0;
    }

    public function tokenForgotUpdate($us_email, $token)
    {
        $this->db->where('us_email', $us_email);
        $this->db->update('orkney10_konektron_cli.users', array('us_token_forgot' => $token));
        return $this->db->affected_rows() > 0;
	}
	
	public function tokenValidForgot($token)
    {
        $user = $this->db->get_where('orkney10_konektron_cli.users', array('us_token_forgot' => $token))->row();
        return !empty($user);
	}

    public function tokenValidRecover($token)
    {
        $user = $this->db->get_where('orkney10_konektron_cli.users', array('us_token' => $token))->row();
        return !empty($user);
	}
	
    public function updatePassword($token, $password)
    {
        $this->db->where('token_recover', $token);
        $this->db->update('orkney10_konektron_cli.users', array('password' => $password, 'token_recover' => NULL));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function tokenValidForgotProviders($token)
    {
        $user = $this->db->get_where('orkney10_konektron_cli.providers', array('pr_token_forgot' => $token))->row();
        return !empty($user);
	}
	
	public function tokenForgotProvidersUpdate($pr_email, $token)
    {
        $this->db->where('pr_email', $pr_email);
        $this->db->update('orkney10_konektron_cli.providers', array('pr_token_forgot' => $token));
        return $this->db->affected_rows() > 0;
	}

    public function tokenValidRecoverProviders($token)
    {
        $provider = $this->db->get_where('orkney10_konektron_cli.providers', array('pr_token' => $token))->row();
        return !empty($provider);
    }

    public function updatePasswordProviders($token, $password)
    {
        $this->db->where('token_recoverProviders', $token);
        $this->db->update('orkney10_konektron_cli.providers', array('password' => $password, 'token_recoverProviders' => NULL));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function activationModel($us_token)
    {
        $this->db->where('us_token', $us_token);
        $this->db->update('orkney10_konektron_cli.users', array('us_status' => 'active'));
        return $this->db->affected_rows() > 0;
    }

    public function activationProvidersModel($pr_token)
    {
        $this->db->where('pr_token', $pr_token);
        $this->db->update('orkney10_konektron_cli.providers', array('pr_status' => 'active'));
        return $this->db->affected_rows() > 0;
    }
}
