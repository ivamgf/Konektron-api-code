<?php
/**
 * Model para cadastro dos dados auxiliares das tarefas
 *
 * @category   Model
 * @package    Konektron
 * @subpackage SignModel
 * @author     Orkney Tech <contato@orkneytech.com.br>
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

        $this->db->insert('users', $signup);
        return $this->db->insert_id();
    }

    /**
     * Cria um novo fornecedor
     *
     * @param stdClass $signupProviders Dados do fornecedor
     *
     * @return integer
     */
    public function insertProvider(stdClass $signupProviders): int
    {
        // au_type 2 = provider
        $signupProviders->id_auth = self::AUTH_PROVIDER;
        $signupProviders->pr_password = $this->gerarSenha(
            $signupProviders->pr_password
        );
        $signupProviders->pr_status = 'inactive';
        $signupProviders->pr_token = $this->gerarToken(
            $signupProviders->pr_email
        );
        $signupProviders->pr_modified = null;

        $this->db->insert('providers', $signupProviders);
        return $this->db->affected_rows() > 0
            ? $this->db->insert_id()
            : 0;
    }

    /**
     * Login do usuário cliente
     *
     * @param string $us_email    E-mail do usuário
     * @param string $us_password Senha do usuário
     *
     * @return array
     */
    public function signinUser(string $us_email, string $us_password): array
    {
        $this->db->where("us_email", $us_email);
        $this->db->where("us_status", "active");
        $user = $this->db->get("users")->row_array();
        $validate = !empty($user['us_password'])
            && $this->validaSenha($us_password, $user['us_password']);
        return !empty($validate) ? $user : [];
    }

    /**
     * Login do fornecedor
     *
     * @param string $pr_email    E-mail do fornecedor
     * @param string $pr_password Senha do fornecedor
     *
     * @return array
     */
    public function signinProviders(string $pr_email, string $pr_password): array
    {
        $this->db->where("pr_email", $pr_email);
        $this->db->where("pr_status", "active");
        $provider = $this->db->get("providers")->row_array();
        $validate = !empty($provider['pr_password'])
            && $this->validaSenha($pr_password, $provider['pr_password']);
        return !empty($validate) ? $provider : [];
    }

    /**
     * Retorna os admins
     *
     * @param int $id_auth Id do admin
     *
     * @return stdClass
     */
    public function getAuthUsers(int $id_auth): stdClass
    {
        return $this->db->get_where(
            'authorization',
            [
                'id_auth' => $id_auth
            ]
        )->row() ?? new stdClass();
    }

    /**
     * Verifica o e-mail do usuário
     *
     * @param string $us_email E-mail do usuário
     *
     * @return array
     */
    public function verify(string $us_email): array
    {
        $this->db->where("us_email", $us_email);
        $user = $this->db->get("users")->row_array();
        return $user ?? [];
    }

    /**
     * Verifica o e-mail do fornecedor
     *
     * @param string $pr_email E-mail do usuário
     *
     * @return array
     */
    public function verifyProviders(string $pr_email): array
    {
        $this->db->where("pr_email", $pr_email);
        $provider = $this->db->get("providers")->row_array();
        return $provider ?? [];
    }

    /**
     * Atualiza o token do usuário
     *
     * @param string $us_email E-mail do usuário
     * @param string $us_token Token do usuário
     *
     * @return boolean
     */
    public function tokenUpdate(string $us_email, string $us_token): bool
    {
        $this->db->where('us_email', $us_email);
        $this->db->update(
            'users',
            [
                'us_token' => $us_token
            ]
        );
        return $this->db->affected_rows() > 0;
    }

    /**
     * Atualiza o token do fornecedor
     *
     * @param string $pr_email E-mail do fornecedor
     * @param string $pr_token Token do fornecedor
     *
     * @return boolean
     */
    public function tokenUpdateProvider(string $pr_email, string $pr_token): bool
    {
        $this->db->where('pr_email', $pr_email);
        $this->db->update(
            'providers',
            [
                'pr_token' => $pr_token
            ]
        );
        return $this->db->affected_rows() > 0;
    }

    /**
     * Atualiza o token do usuário
     *
     * @param string $us_email        E-mail do usuário
     * @param string $us_token_forgot Token do usuário
     *
     * @return boolean
     */
    public function tokenForgotUpdate(string $us_email, string $us_token_forgot): bool
    {
        $this->db->where('us_email', $us_email);
        $this->db->update(
            'users',
            [
                'us_token_forgot' => $us_token_forgot
            ]
        );
        return $this->db->affected_rows() > 0;
    }

    /**
     * Valida o token de redefinição da senha do cliente
     *
     * @param string $us_token_forgot Token de redefinição da senha
     *
     * @return boolean
     */
    public function tokenValidForgot(string $us_token_forgot): bool
    {
        $user = $this->db->get_where(
            'users',
            [
                'us_token_forgot' => $us_token_forgot
            ]
        )->row();
        return !empty($user);
    }

    /**
     * Valida o token de autenticação do cliente
     *
     * @param string $us_token Token de redefinição da senha
     *
     * @return boolean
     */
    public function tokenValidRecover(string $us_token): bool
    {
        $user = $this->db->get_where(
            'users',
            [
                'us_token' => $us_token
            ]
        )->row();
        return !empty($user);
    }

    /**
     * Atualiza a senha do cliente
     *
     * @param string $us_token_forgot Token de recuperação da senha
     * @param string $us_password     Nova senha do cliente
     *
     * @return boolean
     */
    public function updatePassword(
        string $us_token_forgot,
        string $us_password
    ): bool {
        $this->db->where('us_token_forgot', $us_token_forgot);
        $this->db->update(
            'users',
            [
                'us_password' => $this->gerarSenha($us_password),
                'us_token_forgot' => null
            ]
        );
        return $this->db->affected_rows() > 0;
    }

    /**
     * Valida o token de redefinição da senha do fornecedor
     *
     * @param string $pr_token_forgot Token de recuperação da senha
     *
     * @return boolean
     */
    public function tokenValidForgotProviders(string $pr_token_forgot): bool
    {
        $user = $this->db->get_where(
            'providers',
            [
                'pr_token_forgot' => $pr_token_forgot
            ]
        )->row();
        return !empty($user);
    }

    /**
     * Atualiza o token de redefinição da senha do fornecedor
     *
     * @param string $pr_email        E-mail do fornecedor
     * @param string $pr_token_forgot Token de recuperação da senha
     *
     * @return boolean
     */
    public function tokenForgotProvidersUpdate(
        string $pr_email,
        string $pr_token_forgot
    ): bool {
        $this->db->where('pr_email', $pr_email);
        $this->db->update(
            'providers',
            [
                'pr_token_forgot' => $pr_token_forgot
            ]
        );
        return $this->db->affected_rows() > 0;
    }

    /**
     * Valida o token de autenticação do fornecedor
     *
     * @param string $pr_token Token de autenticação
     *
     * @return boolean
     */
    public function tokenValidRecoverProviders(string $pr_token): bool
    {
        $provider = $this->db->get_where(
            'providers',
            [
                'pr_token' => $pr_token
            ]
        )->row();
        return !empty($provider);
    }

    /**
     * Valida o token de autenticação do admin
     *
     * @param string $ad_token Token de autenticação
     *
     * @return boolean
     */
    public function tokenValidRecoverAdmin(string $ad_token): bool
    {
        $admin = $this->db->get_where(
            'admin',
            [
                'ad_token' => $ad_token
            ]
        )->row();
        return !empty($admin);
    }

    /**
     * Atualiza a senha do fornecedor
     *
     * @param string $pr_token_forgot Token de recuperação da senha
     * @param string $pr_password     Nova senha
     *
     * @return boolean
     */
    public function updatePasswordProviders(
        string $pr_token_forgot,
        string $pr_password
    ): bool {
        $this->db->where('pr_token_forgot', $pr_token_forgot);
        $this->db->update(
            'providers',
            [
                'pr_password' => $this->gerarSenha($pr_password),
                'pr_token_forgot' => null
            ]
        );
        return $this->db->affected_rows() > 0;
    }

    /**
     * Ativa a conta do cliente
     *
     * @param string $us_token Token de autenticação
     *
     * @return boolean
     */
    public function activationModel(string $us_token): bool
    {
        $this->db->where('us_token', $us_token);
        $this->db->update(
            'users',
            [
                'us_status' => 'active'
            ]
        );
        return $this->db->affected_rows() > 0;
    }

    /**
     * Ativa a conta do fornecedor
     *
     * @param string $pr_token Token de autenticação
     *
     * @return boolean
     */
    public function activationProvidersModel(string $pr_token): bool
    {
        $this->db->where('pr_token', $pr_token);
        $this->db->update(
            'providers',
            [
                'pr_status' => 'active'
            ]
        );
        return $this->db->affected_rows() > 0;
    }
}
