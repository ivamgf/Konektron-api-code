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
		$user = $this->db->get("users")->row_array();
        return $user;
    }
    public function signinProviders($pr_email, $pr_password) {
        $this->db->where("pr_email", $pr_email);
        $this->db->where("pr_password", $pr_password);
        $provider = $this->db->get("providers")->row_array();
        return $provider;
    }

    public function getAuthUsers($id_auth) {
        return $this->db->get_where('orkney10_konektron_cli.authorization', array('id_auth' => $id_auth))->row();
    }

    public function tokenValidForgot($us_email, $token)
    {
        $this->db->where($us_email);
        $this->db->update('orkney10_konektron_cli.users', array('token_forgot' => $token));
        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        return FALSE;
    }

    public function tokenValidRecover($token)
    {
        $user = $this->db->get_where('orkney10_konektron_cli.users', array('token_recover' => $token))->row();
        return !is_null($user);
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

    public function tokenValidForgotProviders($pr_email, $token)
    {
        $this->db->where($pr_email);
        $this->db->update('orkney10_konektron_cli.providers', array('token_forgotProviders' => $token));
        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        return FALSE;
    }

    public function tokenValidRecoverProviders($token)
    {
        $user - $this->db->get_where('orkney10_konektron_cli.providers', array('token_recoverProviders' => $token))->row();
        return !is_null($provider);
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

    public function ativationModel($id_users)
    {
        $status = true;
        $this->db->update('orkney10_konektron_cli.users', array('status' => $status));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function ativationProvidersModel($id_providers)
    {
        $status = true;
        $this->db->update('orkney10_konektron_cli.providers', array('status' => $status));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }
}
