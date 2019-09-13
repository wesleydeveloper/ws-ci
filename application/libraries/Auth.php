<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function login($username, $password)
    {
        $user = $this->ci->db->get_where('users', array('username' => $username))->first_row();
        if ($user) {
            if (password_verify($password, $user->password)) {
                unset($user->password);
                $user->logged_in = true;
                $this->ci->session->set_userdata((array)$user);
                return true;
            }
            return false;
        }
        return false;
    }

    public function is_logged()
    {
        if ($this->ci->session->userdata('logged_in')) {
            return true;
        }
        return false;
    }

    public function logout()
    {
        $this->ci->session->sess_destroy();
        return true;
    }

}

/* End of file Auth.php */
