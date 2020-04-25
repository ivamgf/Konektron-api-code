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
 * Controller para controle dos migrations
 *
 * @category   Controller
 * @package    Konektron
 * @subpackage Migrate
 * @author     Orkney Tech <suporte@orkneytech.com.br>
 * @copyright  2020 Orkney Tech
 * @license    Copyright (c) 2020
 * @link       https://www.orkneytech.com.br/license.md
 */
class Migrate extends MY_Controller
{

    /**
     * Executa o migration com as modificações do banco de dados.
     *
     * @return void
     */
    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->current() === false) {
            show_error($this->migration->error_string());
        } else {
            echo 'Migração bem sucedida!';
        }
    }
}
