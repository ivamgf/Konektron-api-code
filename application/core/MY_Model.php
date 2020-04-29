<?php
/**
 * This file is part of the Orkney Tech (http://orkneytech.com.br)
 *
 * Copyright (c) 2020  Orkney Tech (http://orkneytech.com.br)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 *
 * PHP Version 7
 *
 * @category Controller
 * @package  Orkney
 * @author   Orkney Tech <suporte@orkneytech.com.br>
 * @license  Copyright (c) 2020
 * @link     https://www.orkneytech.com.br/license.md
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model base para validação dos dados dos models
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage MY_Model
 * @author     Orkney Tech <suporte@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class MY_Model  extends CI_Model
{
    /**
     * Gera uma nova senha
     *
     * @param string $senha Senha do usuário
     *
     * @return void
     */
    protected function gerarSenha(string $senha)
    {
        return password_hash($senha, PASSWORD_BCRYPT);
    }

    /**
     * Validar a senha do usuário
     *
     * @param string $senha Senha do usuário
     * @param string $hash  Hash com a senha criptografada
     *
     * @return void
     */
    protected function validaSenha(string $senha, string $hash)
    {
        return password_verify($senha, $hash);
    }

    /**
     * Gera um novo token
     *
     * @param string $email Email utilizado para geração do token
     *
     * @return void
     */
    protected function gerarToken(string $email)
    {
        $salt = uniqid();
        return md5(time().$email.$salt);
    }
}
