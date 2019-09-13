<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends WS_Controller
{

    public function index()
    {
        $auth = $this->auth->is_logged();
        if($auth){
            redirect('');
        }else{
            $this->data['login_action'] = 'login/auth';
            $this->render('login', 'Login', 'auth');
        }
    }

    public function auth()
    {
        $auth = $this->auth->login($this->input->post('username'), $this->input->post('password'));
        if ($auth) {
            redirect('');
        }
    }

    public function logoff()
    {
        $auth = $this->auth->logout();
        if($auth){
            redirect('login');
        }
    }

}

/* End of file Auth.php */
