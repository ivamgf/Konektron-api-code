<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require FCPATH.'vendor/phpmailer/phpmailer/src/Exception.php';
require FCPATH.'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require FCPATH.'vendor/phpmailer/phpmailer/src/SMTP.php';

class Sign extends CI_Controller 
{

    public function signin()
    {
        $this->load->model('SignModel', 'signModel', true);
        $input = (array)json_decode($this->input->raw_input_stream);
        $signin = $this->signModel->signinUser($input['us_email'], $input['us_password']);
        
        $output = !empty($signin['us_token'])
            ? json_encode([ 'us_token' => $signin['us_token']])
            : null;
        
        $status_code = $output ? 200 : 403;

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code)
            ->set_output($output);
    }
    
    public function signinProviders()
    {
        $this->load->model('SignModel', 'signModel', true);
        $input = (array)json_decode($this->input->raw_input_stream);
        $signinProviders = $this->signModel->signinProviders($input['pr_email'], $input['pr_password']);
        $output = !empty($signinProviders['pr_token'])
            ? json_encode([ 'pr_token' => $signinProviders['pr_token']])
            : null;
        
        $status_code = $output ? 200 : 403;

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code)
            ->set_output($output);
    }

    public function signup()
    {
        $this->load->model('SignModel', 'signModel', true);
        $signup = (array)json_decode($this->input->raw_input_stream);
        $signup['us_created'] = date('Y-m-d H:i:s');
        $signup['us_modified'] = date('Y-m-d H:i:s');
        $this->signModel->db->insert('users', $signup);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200);
    }

    public function signupProviders()
    {
        $this->load->model('SignModel', 'signModel', true);
        $signupProviders = (array)json_decode($this->input->raw_input_stream);
        $signupProviders['pr_created'] = date('Y-m-d H:i:s');
        $signupProviders['pr_modified'] = date('Y-m-d H:i:s');
        $this->signModel->db->insert('providers', $signupProviders);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200);
    }

    public function verify()
    {
        $this->load->helper('url');
        $this->load->model('SignModel', 'signModel', true);
        $input = (array)json_decode($this->input->raw_input_stream);
        $signin = $this->signModel->verify($input['us_email']);
        if (!empty($signin) && $signin['us_status'] == 'inactive') {
            $token = md5(time().$signin['us_email']);
            if ($this->signModel->tokenValidActive($input['us_email'], $token)) {
                // Message E-mail
                $subject = 'Ativação de conta';
                $msg  = 'Ative sua conta para começar a usar o sistema, <br>';
                $msg .= 'Se não foi você que se registrou, entre em contato conosco, <br>';
                $msg .= 'pelo e-mail contatos@orkneytech.com.br <br>';
                $msg .= 'Se você se registrou em nosso sistema recentemente, clique no link abaixo. <br>';
                $msg .= "<a href='" . base_url('activation/'.$token) . "' target='_blank'>Clique aqui para ativar sua conta!</a>";
                // Message E-mail

                $email = $this->_phpMailer(
                    [
                        'to' => $signin['us_email'],
                        'subject' => $subject,
                        'msg' => $msg
                    ]
                );
                
                // var_dump($email->send());
                // var_dump($email->ErrorInfo);
                // die;

                // var_dump($email);die;
                // echo $email->send();
                // Send E-mail

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

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code)
            ->set_output(
                json_encode(
                    [
                        'msg' => $message
                    ]
                )
            );
    }

    public function verifyProviders()
    {
        $this->load->helper('url');
        $this->load->model('SignModel', 'signModel', true);
        $input = (array)json_decode($this->input->raw_input_stream);
        $signin = $this->signModel->verifyProviders($input['pr_email']);
        if (!empty($signin) && $signin['pr_status'] == 'inactive') {
            $token = md5(time().$signin['pr_email']);
            if ($this->signModel->tokenValidProviderActive($input['pr_email'], $token)) {
                // Message E-mail
                $subject = 'Ativação de conta';
                $msg  = 'Ative sua conta para começar a usar o sistema, <br>';
                $msg .= 'Se não foi você que se registrou, entre em contato conosco, <br>';
                $msg .= 'pelo e-mail contatos@orkneytech.com.br <br>';
                $msg .= 'Se você se registrou em nosso sistema recentemente, clique no link abaixo. <br>';
                $msg .= "<a href='" . base_url('activationProviders/'.$token) . "' target='_blank'>Clique aqui para ativar sua conta!</a>";
                // Message E-mail

                $email = $this->_phpMailer(
                    [
                        'to' => $signin['pr_email'],
                        'subject' => $subject,
                        'msg' => $msg
                    ]
                );
                
                // var_dump($email->send());
                // var_dump($email->ErrorInfo);
                // die;

                // var_dump($email);die;
                // echo $email->send();
                // Send E-mail

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

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code)
            ->set_output(
                json_encode(
                    [
                        'msg' => $message
                    ]
                )
            );
    }

    public function activation($us_token)
    {
        // Update for ativation
        $this->load->model('SignModel', 'signModel', true);
        $active = $this->signModel->activationModel($us_token);
        
        $status_code = $active ? 200 : 400;

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
    }

    public function activationProviders($pr_token)
    {
        // Update for ativation
        $this->load->model('SignModel', 'signModel', true);
        $active = $this->signModel->activationProvidersModel($pr_token);
        
        $status_code = $active ? 200 : 400;

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code);
    }

    public function recoverToken($token)
    {
        $this->load->model('SignModel', 'signModel', true);
        $tokenValidRecover = $this->signModel->tokenValidRecover($token);

        $output = !empty($tokenValidRecover) 
            ? json_encode([ 'token' => $token, 'tokenValidRecover' => $tokenValidRecover])
            : null;
        $status_code = $output ? 200 : 400;

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code)
            ->set_output($output);
    }

    public function recover($token)
    {
        $password = sha1($this->input->post('password'));
        $newPassword = $this->usersSession->updatePassword($token, $password);
        if ($newPassword) {
            $message = 'Senha alterada com sucesso!';
            redirect(base_url('sign/signin'));
        } else {
            $message = 'Erro, não foi possível alterar a senha!';
            redirect(base_url('sign/recover/{$token}'));
        }
    }

    public function forgot()
    {
        $this->load->model('SignModel', 'signModel', true);
        $input = (array)json_decode($this->input->raw_input_stream);
        $token = md5(time().$input['us_email']);
        $tokenValid = $this->signModel->tokenValidForgot($input['us_email'], $token);
        
        // Message E-mail
        if ($tokenValid) {
            // Message E-mail
            $subject = 'Redefinição de senha';
            $msg .= 'Recentemente recebemos uma solicitação sua para redefinição de senha, <br>';
            $msg .= 'Se não foi você que solicitou, entre em contato conosco, <br>';
            $msg .= 'pelo e-mail contatos@orkneytech.com.br <br>';
            $msg .= 'Se foi você que solicitou a redefinição de senha, clique no link abaixo. <br>';
            $msg .= "<a href='" . base_url('recover/'.$token) . "' target='_blank'>Clique aqui para redefinir sua senha!</a>";
            // Message E-mail

            $email = $this->_phpMailer(
                [
                    'to' => $signin['us_email'],
                    'subject' => $subject,
                    'msg' => $msg
                ]
            );
            
            // var_dump($email->send());
            // var_dump($email->ErrorInfo);
            // die;

            // var_dump($email);die;
            // echo $email->send();
            // Send E-mail

            $status_code = 400;
            $message = 'Não foi possível enviar o e-mail de redefinição! Tente novamente mais tarde.';
            if ($email->send()) {
                $status_code = 200;
                $message = 'Enviamos um e-mail para você poder redefinir sua senha!';
            }
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code)
            ->set_output(
                json_encode(
                    [
                        'msg' => $message
                    ]
                )
            );
    }

    public function recoverTokenProviders($token)
    {
        $this->load->model('SignModel', 'signModel', true);
        $tokenValidRecoverproviders = $this->signModel->tokenValidRecoverProviders($token);

        $output = !empty($tokenValidRecoverproviders) 
            ? json_encode([ 'token' => $token, 'tokenValidRecoverProviders' => $tokenValidRecoverproviders])
            : null;
        $status_code = $output ? 200 : 400;

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code)
            ->set_output($output);
    }

    public function recoverProviders($token)
    {
        $password = sha1($this->input->post('password'));
        $newPassword = $this->providerSession->updatePassword($token, $password);
        if ($newPassword)
        {
            $message = 'Senha alterada com sucesso!';
            redirect(base_url('sign/signupProviders'));
        }
        else
        {
            $message = 'Erro, não foi possível alterar a senha!';
            redirect(base_url('sign/recoverProviders/{$token}'));
        }
    }

    public function forgotProviders($us_email)
    {
        // $this->load->library('email');
                
        $token = md5(date('YmdHis'), $us_email);
        $tokenValid = $this->providerSession->tokenValidForgotProviders($pr_email, $token);
        if($tokenValid)
        {			
            // Config E-mail
            $config['protocol'] = 'sendmail';
            $config['smtp_host'] = 'ssl://orkneytech.com.br';
            $config['smtp_port'] = 465;
            $config['smtp_user'] = 'contatos@orkneytech.com.br';
            $config['smtp_pass'] = 'Orkneytech10106088';
            $config['smtp_charset'] = 'utf-8';
            $config['smtp_mailtype'] = 'html';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);
            // Config E-mail

            // Message E-mail
            $URL = '';
            $Title = 'Redefinição de senha';
            $Paragraph_1 = 'Recentemente recebemos uma solicitação sua para redefinição de senha, <br>';
            $Paragraph_2 = 'Se não foi você que solicitou, entre em contato conosco, <br>';
            $paragraph_3 = 'pelo e-mail contatos@orkneytech.com.br <br>';
            $paragraph_4 = 'Se foi você que solicitou a redefinição de senha, clique no link abaixo. <br>';
            $link_1 = "<a href='" . base_url("'".$URL."/{".$token."}'") . "' target='_blank'>". base_url("'".$URL."/{".$token."}'") ."</a>";
            $Msg = $Title . $Paragraph_1 . $Paragraph_2 . $paragraph_3 . $paragraph_4 . $link_1;
            // Message E-mail

            // Send E-mail
            $this->email->from($config['smtp_user'], 'Konektron');
            $this->email->to($us_email);
            $this->email->subject('Recuperação de Senha');
            $this->email->message($Msg);
            $this->email->send();			
            // echo $this->email->print_debugger();
            // Send E-mail
            
            // Message App
            $message = 'Enviamos um e-mail para você poder redefinir a senha!';
        } 
        else 
        {
            $message = 'Não existe um usuário cadastrado com este E-mail!';
        }
        
    }

    public function contact($Message)
    {
        // Config E-mail
        $config['protocol'] = 'sendmail';
        $config['smtp_host'] = 'ssl://orkneytech.com.br';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'contatos@orkneytech.com.br';
        $config['smtp_pass'] = 'Orkneytech10106088';
        $config['smtp_charset'] = 'utf-8';
        $config['smtp_mailtype'] = 'html';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        // Config E-mail

        // Message E-mail
        $URL = '';
        $Title = 'Mensagem de cliente';
        $Msg = $Title . $Message;
        // Message E-mail

        // Send E-mail
        $this->email->from($config['smtp_user'], 'Konektron');
        $this->email->to('contatos@orkneytech.com.br');
        $this->email->subject('Mensagem de cliente');
        $this->email->message($Msg);
        $this->email->send();			
        // echo $this->email->print_debugger();
        // Send E-mail
        
        // Message App
        $message = 'Enviamos um e-mail para você poder redefinir a senha!';
    }

    public function logoutUser()
    {
        $this->session->unset_userdata('usersSession');
    }

    public function logoutProviders()
    {
        $this->session->unset_userdata('providerSession');
    }

    private function _emailConfig() {
        // Config E-mail
        // $config['protocol'] = 'sendmail';
        // $config['smtp_host'] = 'ssl://orkneytech.com.br';
        // $config['smtp_port'] = 465;
        // $config['smtp_user'] = 'contatos@orkneytech.com.br';
        // $config['smtp_pass'] = 'Orkneytech10106088';
        // $config['mailpath'] = '/usr/sbin/sendmail';
        // $config['charset'] = 'iso-8859-1';

        $config = [
            'protocol' => 'smtp',
            '_smtp_auth' => TRUE,
            'smtp_host' => 'smtp.zoho.com',
            'smtp_port' => 587,
            'smtp_user' => 'no-reply@rsb.cc',
            'smtp_pass' => '!HGhbxh98pDsXC#',
            'smtp_crypto' => 'tls',
            'smtp_charset' => 'utf-8',
            'smtp_mailtype' => 'html',
            'charset' => 'UTF-8',
            'wordwrap' => TRUE,
        ];
        return $config;
    }

    private function _emailCreate(
        $mail = [
            'to' => null,
            'subject' => null,
            'msg' => null
        ]
    ) 
    {
        $config = $this->_emailConfig();
        // var_dump($config);die;
        $this->load->library('email', $config);
        // Config E-mail

        // Send E-mail
        $this->email->from($config['smtp_user'], 'Konektron');
        $this->email->to($mail['to']);
        $this->email->subject($mail['subject']);
        $this->email->message($mail['msg']);
        
        return $this->email;
    }

    private function _phpMailer(
        $setting = [
            'to' => null,
            'subject' => null,
            'msg' => null
        ]
    )
    {
        $config = $this->_emailConfig();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
            )
        );
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 1;
        $mail->Debugoutput = 'html';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $config['smtp_crypto'];
        $mail->Host = $config['smtp_host'];
        $mail->Port = $config['smtp_port'];
        $mail->Username = $config['smtp_user'];
        $mail->Password = $config['smtp_pass'];
        $mail->setFrom($config['smtp_user'], 'Konektron');
        $mail->addAddress($setting['to']);

        $mail->Subject = $setting['subject'];
        $mail->msgHTML($setting['msg']);
        $mail->AltBody = $setting['msg'];
    
        // var_dump($mail->send());
        // var_dump($mail->ErrorInfo);
        return $mail;
    }
}
