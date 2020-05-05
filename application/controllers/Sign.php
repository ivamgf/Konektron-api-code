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
 * @author   Orkney Tech <contato@orkneytech.com.br>
 * @license  Copyright (c) 2020
 * @link     https://www.orkneytech.com.br/license.md
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller para autenticação do usuário
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Sign
 * @author     Orkney Tech <contato@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Sign extends MY_Controller
{
    /**
     * Autenticação do clientes (user)
     *
     * @return void
     */
    public function signin()
    {
        $this->load->model('SignModel', 'signModel', true);
        if ($input = $this->getData()) {
            $signin = $this->signModel->signinUser(
                $input->us_email,
                $input->us_password
            );

            $output = !empty($signin['us_token'])
                ? [ 'us_token' => $signin['us_token']]
                : null;

            $status_code = $output ? 200 : 403;

            $this->response(
                $output,
                $status_code
            );
        }
    }

    /**
     * Autenticação dos fornecedores (provider)
     *
     * @return void
     */
    public function signinProviders()
    {
        $this->load->model('SignModel', 'signModel', true);
        if ($input = $this->getData()) {
            $signinProviders = $this->signModel->signinProviders(
                $input->pr_email,
                $input->pr_password
            );
            $output = !empty($signinProviders['pr_token'])
                ? [ 'pr_token' => $signinProviders['pr_token']]
                : null;

            $status_code = $output ? 200 : 403;

            $this->response(
                $output,
                $status_code
            );
        }
    }

    /**
     * Cadastro do cliente
     *
     * @return void
     */
    public function signup()
    {
        $this->load->model('SignModel', 'signModel', true);
        if ($signup = $this->getData()) {
            $created = $this->signModel->insertUser($signup);
            $status_code = $created ? 200 : 403;
            $this->response(
                null,
                $status_code
            );
        }
    }

    /**
     * Cadastro do fornecedor
     *
     * @return void
     */
    public function signupProviders()
    {
        $this->load->model('SignModel', 'signModel', true);
        if ($signupProviders = $this->getData()) {
            $created = $this->signModel->insertProvider($signupProviders);
            $status_code = $created ? 200 : 403;
            $this->response(
                null,
                $status_code
            );
        }
    }

    /**
     * Verificação e e-mail de ativação da conta do cliente
     *
     * @return void
     */
    public function verify()
    {
        $this->load->helper('url');
        $this->load->model('SignModel', 'signModel', true);
        if ($input = $this->getData()) {
            $signin = $this->signModel->verify($input->us_email);
            if (!empty($signin) && $signin['us_status'] == 'inactive') {
                $token = md5(time().$signin['us_email']);
                if ($this->signModel->tokenUpdate($input->us_email, $token)) {
                    // Message E-mail
                    $subject = 'Ativação de conta';
                    $msg  = 'Ative sua conta para começar a usar o sistema, <br>';
                    $msg .= 'Se não foi você que se registrou, entre em contato conosco, <br>';
                    $msg .= 'pelo e-mail contatos@orkneytech.com.br <br>';
                    $msg .= 'Se você se registrou em nosso sistema recentemente, clique no link abaixo. <br>';
                    $msg .= "<a href='" . base_url('activation/'.$token) . "' target='_blank'>Clique aqui para ativar sua conta!</a>";
                    // Message E-mail

                    $email = $this->phpMailer(
                        [
                            'to' => $signin['us_email'],
                            'subject' => $subject,
                            'msg' => $msg
                        ]
                    );

                    $status_code = 400;
                    $message = 'Não foi possível enviar o e-mail de verificação! Tente novamente mais tarde.';
                    if ($email->send()) {
                        $status_code = 200;
                        $message = 'Enviamos um e-mail para você poder ativar sua conta!';
                    }
                }
            } else {
                $status_code = 400;
                $message = 'Sua conta já esta ativada!';
            }
        }

        $this->response(
            [
                'msg' => $message
            ],
            $status_code
        );
    }

    /**
     * Verificação e ativação da conta do fornecedor
     *
     * @return void
     */
    public function verifyProviders()
    {
        $this->load->helper('url');
        $this->load->model('SignModel', 'signModel', true);
        if ($input = $this->getData()) {
            $signin = $this->signModel->verifyProviders($input->pr_email);
            if (!empty($signin) && $signin['pr_status'] == 'inactive') {
                $token = md5(time().$signin->pr_email);
                if ($this->signModel->tokenUpdateProvider($input->pr_email, $token)) {
                    // Message E-mail
                    $subject = 'Ativação de conta';
                    $msg  = 'Ative sua conta para começar a usar o sistema, <br>';
                    $msg .= 'Se não foi você que se registrou, entre em contato conosco, <br>';
                    $msg .= 'pelo e-mail contatos@orkneytech.com.br <br>';
                    $msg .= 'Se você se registrou em nosso sistema recentemente, clique no link abaixo. <br>';
                    $msg .= "<a href='" . base_url('activationProviders/'.$token) . "' target='_blank'>Clique aqui para ativar sua conta!</a>";
                    // Message E-mail

                    $email = $this->phpMailer(
                        [
                            'to' => $signin['pr_email'],
                            'subject' => $subject,
                            'msg' => $msg
                        ]
                    );

                    $status_code = 400;
                    $message = 'Não foi possível enviar o e-mail de verificação! Tente novamente mais tarde.';
                    if ($email->send()) {
                        $status_code = 200;
                        $message = 'Enviamos um e-mail para você poder ativar sua conta!';
                    }
                }
            } else {
                $status_code = 400;
                $message = 'Sua conta já esta ativada!';
            }
        }

        $this->response(
            [
                'msg' => $message
            ],
            $status_code
        );
    }

    /**
     * Ativação da conta do cliente
     *
     * @param string $us_token Token do cliente
     *
     * @return void
     */
    public function activation(string $us_token = '')
    {
        // Update for ativation
        $this->load->model('SignModel', 'signModel', true);
        $active = $this->signModel->activationModel($us_token);

        $output = !empty($active)
            ? ['us_status' => 'active']
            : ['code' => 404, 'msg' => 'Token inválido ou cliente já ativo!' ];
        $status_code = $active ? 200 : 404;

        $this->response(
            $output,
            $status_code
        );
    }

    /**
     * Ativação da conta do fornecedor
     *
     * @param string $pr_token Token do fornecedor
     *
     * @return void
     */
    public function activationProviders(string $pr_token = '')
    {
        // Update for ativation
        $this->load->model('SignModel', 'signModel', true);
        $active = $this->signModel->activationProvidersModel($pr_token);

        $output = !empty($active)
            ? ['us_status' => 'active']
            : ['code' => 404, 'msg' => 'Token inválido ou fornecedor já ativo!' ];
        $status_code = $active ? 200 : 404;

        $this->response(
            $output,
            $status_code
        );
    }

    /**
     * Validação do token do cliente
     *
     * @param string $token Token do cliente
     *
     * @return void
     */
    public function recoverToken(string $token = '')
    {
        $this->load->model('SignModel', 'signModel', true);
        $tokenValidRecover = $this->signModel->tokenValidRecover($token);

        $output = !empty($tokenValidRecover)
            ? [ 'token' => $token, 'tokenValidRecover' => $tokenValidRecover]
            : [ 'code' => 404, 'msg' => 'Token inválido!' ];
        $status_code = $output ? 200 : 404;

        $this->response(
            $output,
            $status_code
        );
    }

    /**
     * Validação do token do fornecedor
     *
     * @param string $token Token do fornecedor
     *
     * @return void
     */
    public function recoverTokenProviders(string $token = '')
    {
        $this->load->model('SignModel', 'signModel', true);
        $tokenValidRecoverproviders = $this->signModel->tokenValidRecoverProviders($token);

        $output = !empty($tokenValidRecoverproviders)
            ? [ 'token' => $token, 'tokenValidRecoverProviders' => $tokenValidRecoverproviders]
            : [ 'code' => 404, 'msg' => 'Token inválido!' ];
        $status_code = $output ? 200 : 404;

        $this->response(
            $output,
            $status_code
        );
    }

    /**
     * E-mail de recuperação da senha do cliente
     *
     * @return void
     */
    public function forgot()
    {
        $this->load->helper('url');
        $this->load->model('SignModel', 'signModel', true);
        if ($input = $this->getData()) {
            $token = md5(time().$input->us_email);
            $tokenUpdated = $this->signModel->tokenForgotUpdate($input->us_email, $token);

            // Message E-mail
            if ($tokenUpdated) {
                // Message E-mail
                $subject = 'Redefinição de senha';
                $msg  = 'Recentemente recebemos uma solicitação sua para redefinição de senha, <br>';
                $msg .= 'Se não foi você que solicitou, entre em contato conosco, <br>';
                $msg .= 'pelo e-mail contatos@orkneytech.com.br <br>';
                $msg .= 'Se foi você que solicitou a redefinição de senha, clique no link abaixo. <br>';
                $msg .= "<a href='" . base_url('recover/'.$token) . "' target='_blank'>Clique aqui para redefinir sua senha!</a>";
                // Message E-mail

                $email = $this->phpMailer(
                    [
                        'to' => $input->us_email,
                        'subject' => $subject,
                        'msg' => $msg
                    ]
                );

                $status_code = 400;
                $message = 'Não foi possível enviar o e-mail de redefinição! Tente novamente mais tarde.';
                if ($email->send()) {
                    $status_code = 200;
                    $message = 'Enviamos um e-mail para você poder redefinir sua senha!';
                }
            }
        }

        $this->response(
            [
                'msg' => $message
            ],
            $status_code
        );
    }

    /**
     * Recuperação da senha do cliente
     *
     * @param string $token Token do cliente
     *
     * @return void
     */
    public function recover(string $token = '')
    {
        $this->load->helper(['form', 'url']);

        $this->load->library('form_validation');

        $this->load->model('SignModel', 'signModel', true);
        $tokenValidForgot = $this->signModel->tokenValidForgot($token);

        $output = !empty($tokenValidForgot)
            ? [ 'token' => $token, 'tokenValidForgot' => $tokenValidForgot]
            : null;

        $this->form_validation->set_rules(
            [
                [
                    'field' => 'newpassword',
                    'label' => 'Nova Senha',
                    'rules' => 'required',
                ],
                [
                    'field' => 'confirmpassword',
                    'label' => 'Conformar Senha',
                    'rules' => 'required|matches[newpassword]',
                    'errors' => [
                        'matches' => 'O campo Conformar Senha não coincide com o campo Nova Senha.'
                    ]
                ]
            ]
        );
        if (!empty($output)) {
            if ($this->form_validation->run()) {
                $newpassword = $this->input->post('newpassword');

                if ($this->signModel->updatePassword($output['token'], $newpassword)) {
                    $data = [
                        'success' => 'Senha redefinida com sucesso!'
                    ];
                } else {
                    $data = [
                        'error' => 'Senha redefinida com sucesso!'
                    ];
                }
                $this->template->set('title', 'Konektron API');
                $this->template->load('template', 'recoverMessage', $data);
            } else {
                $data = [
                    'token' => $token,
                    'csrf' => [
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                    ]
                ];
                $this->template->set('title', 'Konektron API');
                $this->template->load('template', 'recover', $data);
            }
        } else {
            $data = [
                'error' => 'Url inválida!'
            ];
            $this->template->set('title', 'Konektron API');
            $this->template->load('template', 'recoverMessage', $data);
        }
    }

    /**
     * E-mail de recuperação da senha do fornecedor
     *
     * @return void
     */
    public function forgotProviders()
    {
        $this->load->helper('url');
        $this->load->model('SignModel', 'signModel', true);
        if ($input = $this->getData()) {
            $token = md5(time().$input->pr_email);
            $tokenUpdated = $this->signModel->tokenForgotProvidersUpdate($input->pr_email, $token);

            // Message E-mail
            if ($tokenUpdated) {
                // Message E-mail
                $subject = 'Redefinição de senha';
                $msg  = 'Recentemente recebemos uma solicitação sua para redefinição de senha, <br>';
                $msg .= 'Se não foi você que solicitou, entre em contato conosco, <br>';
                $msg .= 'pelo e-mail contatos@orkneytech.com.br <br>';
                $msg .= 'Se foi você que solicitou a redefinição de senha, clique no link abaixo. <br>';
                $msg .= "<a href='" . base_url('recoverProviders/'.$token) . "' target='_blank'>Clique aqui para redefinir sua senha!</a>";
                // Message E-mail

                $email = $this->phpMailer(
                    [
                        'to' => $input->pr_email,
                        'subject' => $subject,
                        'msg' => $msg
                    ]
                );

                $status_code = 400;
                $message = 'Não foi possível enviar o e-mail de redefinição! Tente novamente mais tarde.';
                if ($email->send()) {
                    $status_code = 200;
                    $message = 'Enviamos um e-mail para você poder redefinir sua senha!';
                }
            }
        }

        $this->response(
            [
                'msg' => $message
            ],
            $status_code
        );
    }

    /**
     * Recuperação da senha do fornecedor
     *
     * @param string $token Token do fornecedor
     *
     * @return void
     */
    public function recoverProviders($token)
    {
        $this->load->helper(['form', 'url']);

        $this->load->library('form_validation');

        $this->load->model('SignModel', 'signModel', true);
        $tokenValidForgot = $this->signModel->tokenValidForgotProviders($token);

        $output = !empty($tokenValidForgot)
            ? [ 'token' => $token, 'tokenValidForgot' => $tokenValidForgot]
            : null;

        $this->form_validation->set_rules(
            [
                [
                    'field' => 'newpassword',
                    'label' => 'Nova Senha',
                    'rules' => 'required',
                ],
                [
                    'field' => 'confirmpassword',
                    'label' => 'Conformar Senha',
                    'rules' => 'required|matches[newpassword]',
                    'errors' => [
                        'matches' => 'O campo Conformar Senha não coincide com o campo Nova Senha.'
                    ]
                ]
            ]
        );
        if (!empty($output)) {
            if ($this->form_validation->run()) {
                $newpassword = $this->input->post('newpassword');

                if ($this->signModel->updatePasswordProviders($output['token'], $newpassword)) {
                    $data = [
                        'success' => 'Senha redefinida com sucesso!'
                    ];
                } else {
                    $data = [
                        'error' => 'Senha redefinida com sucesso!'
                    ];
                }
                $this->template->set('title', 'Konektron API');
                $this->template->load('template', 'recoverMessage', $data);
            } else {
                $data = [
                    'token' => $token,
                    'csrf' => [
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                    ]
                ];
                $this->template->set('title', 'Konektron API');
                $this->template->load('template', 'recover', $data);
            }
        } else {
            $data = [
                'error' => 'Url inválida!'
            ];
            $this->template->set('title', 'Konektron API');
            $this->template->load('template', 'recoverMessage', $data);
        }
    }

    /**
     * E-mail de contato
     *
     * @return void
     */
    public function contact()
    {
        $this->load->helper('url');
        $this->load->model('SignModel', 'signModel', true);
        if ($input = $this->getData()) {
            // Message E-mail
            if (!empty($input->mensagem)) {
                // Message E-mail
                $subject = 'Mensagem do Cliente';
                $msg  = 'Você recebeu uma mensagem do cliente: <br>';
                $msg .= $input->mensagem.'<br>';
                // Message E-mail

                $email = $this->phpMailer(
                    [
                        'to' => self::EMAIL_CONTATO,
                        'subject' => $subject,
                        'msg' => $msg
                    ]
                );

                $status_code = 400;
                $message = 'Não foi possível enviar o e-mail! Tente novamente mais tarde.';
                if ($email->send()) {
                    $status_code = 200;
                    $message = 'Enviamos um e-mail com sucesso!';
                }
            }
        }

        $this->response(
            [
                'msg' => $message
            ],
            $status_code
        );
    }
}
