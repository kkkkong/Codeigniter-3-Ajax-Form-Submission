<?php

    defined('BASEPATH') OR exit('u no here');

    class Website extends CI_Controller {
        public function __construct ()
        {
            parent::__construct();
            $this->load->library('form_validation');
        }

        public function index()
        {
                $this->load->view('form');

        }

        public function submission()
        {

            if (!$this->input->is_ajax_request()) { exit('no valid req.'); }


            $this->form_validation->set_rules('username', 'Username', 'callback_username_check');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() == TRUE)
            {
                $data_msg['err'] = '<div class="success">Your website is submitted</div>';
                $data_msg['flag'] = true;

                $data_msg = json_encode($data_msg);

                echo $data_msg;
            }
            else
            {

                $data_msg['err'] = '<div class="errors">'.validation_errors().'</div>';
                $data_msg['flag'] = false;

                $data_msg = json_encode($data_msg);

                echo $data_msg;
            }
        }

        public function username_check($str)
        {
            if ($str == 'test')
            {
                $this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }

    }
