<?php
/**
 * Model para cadastro dos dados auxiliares das tarefas
 *
 * @category   Model
 * @package    Konektron
 * @subpackage SignModel
 * @author     Orkney Tech <suporte@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
*/
class SignModel extends MY_Model
{
    const AUTH_USER = 1;
    const AUTH_PROVIDER  = 2;
    const AUTH_ADMIN  = 3;

    /**
     * Cria um novo usuário cliente
     *
     * @param stdClass $signup Dados do usuário
     *
     * @return void
     */
    public function insertUser(stdClass $signup)
    {
        // au_type 1 = user
        $signup->id_auth = self::AUTH_USER;
        $signup->us_password = $this->gerarSenha($signup->us_password);
        $signup->us_status = 'inactive';
        $signup->us_token = $this->gerarToken($signup->us_email);
        $signup->us_modified = null;

        $this->db->insert('orkney10_konektron_cli.users', $signup);
        return $this->db->insert_id();
    }

    /**
     * Cria um novo fornecedor
     *
     * @param stdClass $signupProviders Dados do fornecedor
     *
     * @return void
     */
    public function insertProvider(stdClass $signupProviders)
    {
        // au_type 2 = provider
        $signupProviders->id_auth = self::AUTH_PROVIDER;
        $signupProviders->pr_password = $this->gerarSenha($signupProviders->pr_password);
        $signupProviders->pr_status = 'inactive';
        $signupProviders->pr_token = $this->gerarToken($signupProviders->pr_email);
        $signupProviders->pr_modified = null;

        $this->db->insert('orkney10_konektron_cli.providers', $signupProviders);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : 0;
    }

    /**
     * Login do usuário cliente
     *
     * @param string $us_email    E-mail do usuário
     * @param string $us_password Senha do usuário
     *
     * @return void
     */
    public function signinUser(string $us_email, string $us_password)
    {
        $this->db->where("us_email", $us_email);
        $this->db->where("us_status", "active");
        $user = $this->db->get("users")->row_array();
        $validate = !empty($user['us_password'])
            && $this->validaSenha($us_password, $user['us_password']);
        return !empty($validate) ? $user : null;
    }

    /**
     * Login do fornecedor
     *
     * @param string $pr_email    E-mail do fornecedor
     * @param string $pr_password Senha do fornecedor
     *
     * @return void
     */
    public function signinProviders(string $pr_email, string $pr_password)
    {
        $this->db->where("pr_email", $pr_email);
        $this->db->where("pr_status", "active");
        $provider = $this->db->get("providers")->row_array();
        $validate = !empty($provider['pr_password'])
            && $this->validaSenha($pr_password, $provider['pr_password']);
        return !empty($validate) ? $provider : null;
    }

    /**
     * Retorna os admins
     *
     * @param int $id_auth
     *
     * @return void
     */
    public function getAuthUsers($id_auth)
    {
        return $this->db->get_where(
            'orkney10_konektron_cli.authorization',
            [
                'id_auth' => $id_auth
            ]
        )->row();
    }

    /**
     * Verifica o e-mail do usuário
     *
     * @param string $us_email E-mail do usuário
     *
     * @return void
     */
    public function verify(string $us_email)
    {
        $this->db->where("us_email", $us_email);
        $user = $this->db->get("users")->row_array();
        return $user;
    }

    /**
     * Verifica o e-mail do fornecedor
     *
     * @param string $pr_email E-mail do usuário
     *
     * @return void
     */
    public function verifyProviders(string $pr_email)
    {
        $this->db->where("pr_email", $pr_email);
        $provider = $this->db->get("providers")->row_array();
        return $provider;
    }

    /**
     * Atualiza o token do usuário
     *
     * @param string $us_email E-mail do usuário
     * @param string $token    Token do usuário
     *
     * @return void
     */
    public function tokenUpdate($us_email, $token)
    {
        $this->db->where('us_email', $us_email);
        $this->db->update(
            'orkney10_konektron_cli.users',
            [
                'us_token' => $token
            ]
        );
        return $this->db->affected_rows() > 0;
    }

    /**
     * Atualiza o token do fornecedor
     *
     * @param string $pr_email E-mail do fornecedor
     * @param string $token    Token do fornecedor
     *
     * @return void
     */
    public function tokenUpdateProvider($pr_email, $token)
    {
        $this->db->where('pr_email', $pr_email);
        $this->db->update(
            'orkney10_konektron_cli.providers',
            [
                'pr_token' => $token
            ]
        );
        return $this->db->affected_rows() > 0;
    }

    /**
     * Atualiza o token do usuário
     *
     * @param string $us_email E-mail do usuário
     * @param string $token    Token do usuário
     * @return void
     */
    public function tokenForgotUpdate($us_email, $token)
    {
        $this->db->where('us_email', $us_email);
        $this->db->update(
            'orkney10_konektron_cli.users',
            [
                'us_token_forgot' => $token
            ]
        );
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

    public function tokenValidRecoverAdmin($token)
    {
        $admin = $this->db->get_where('orkney10_konektron_cli.admin', array('ad_token' => $token))->row();
        return !empty($admin);
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
