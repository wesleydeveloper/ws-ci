<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WS_Controller extends CI_Controller {

    protected $data = array();
    public function __construct()
    {
    	parent::__construct();

        $model_files = scandir(APPPATH . 'models/');
        foreach($model_files as $file){
            if(
                strtolower(explode('.', $file)[0]) !== strtolower(__CLASS__) &&
                strtolower(explode('.', $file)[1]) === 'php')
            {
                $this->load->model(strtolower(explode('.', $file)[0]));
            }
        }
    }



	public function index()
	{

	}

    protected function render($view = NULL, $page_title = NULL, $template = 'default')
    {
        $this->data['site_title'] = 'Wesley Silva CodeIgniter';
        $this->data['page_title'] = (is_null($page_title)) ? $this->data['site_title'] : $page_title . ' | ' . $this->data['site_title'];
        if($template == 'json' || $this->input->is_ajax_request())
        {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        }
        elseif(is_null($template))
        {
            $this->load->view($view,$this->data);
        }
        else
        {
            $this->data['view_content'] = (is_null($view)) ? '' : $this->load->view($template.'/'.$view,$this->data, TRUE);;
            $this->load->view("{$template}/theme/index", $this->data);
        }
    }

}

/* End of file WS_Controller.php */
