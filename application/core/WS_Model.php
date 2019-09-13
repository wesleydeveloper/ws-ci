<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WS_Model extends CI_Model
{
    protected $table;
    protected $safe = array('id', 'created_at', 'updated_at');
    protected $data;
    protected $fillables;

    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
        $this->load->library('inflect');

        $this->table = $this->inflect->pluralize(mb_strtolower(get_class($this)));
        $this->fillables = $this->db->list_fields($this->table);
        //Do your magic here
        $this->populate();
    }

    public function all()
    {
        $this->data = $this->db->get($this->table)->result();
        $this->populate();
    }

    public function get()
    {
        $this->data = $this->db->get_where($this->table, array('id' => $this->id))->first_row();
        $this->populate();
    }

    public function find()
    {
        if (!func_get_args()) {
            return false;
        }
        if (func_num_args() == 1) {
            if (is_array(func_get_arg(0))) {
                $params = func_get_arg(0);
            } elseif (is_int(func_get_arg(0))) {
                $params = array('id' => func_get_arg(0));
            } else {
                return false;
            }
        } elseif (func_num_args() == 2) {
            if (is_array(func_get_arg(0)) || is_array(func_get_arg(1))) {
                return false;
            }
            $params = array(func_get_arg(0) => func_get_arg(1));
        } else {
            if (func_num_args() % 2 != 0) {
                return false;
            }
            $params = array();
            for ($i = 0; $i < func_num_args(); $i++) {
                if ($i == func_num_args() - 1) {
                    break;
                }
                if (is_array(func_get_arg($i))) {
                    return false;
                }
                if ($i % 2 == 0) {
                    $params[func_get_arg($i)] = func_get_arg($i + 1);
                }
            }
        }
        $result = $this->db->get_where($this->table, $params);
        if ($result->num_rows() > 1) {
            $this->data = $result->result();
        } else {
            $this->data = $result->first_row();
        }
        $this->populate();
    }

    public function save()
    {
        if (!empty($this->id)) {
            $where = array('id' => $this->id);
            unset($this->safe[0]);
            $this->safe();
            $this->updated_at = date('Y-m-d H:i:s');
            $this->db->update($this->table, $this, $where);
            $updated_status = $this->db->affected_rows();
            if ($updated_status) $save_id = $where['id'];
        } else {
            $this->safe();
            $this->created_at = date('Y-m-d H:i:s');
            $this->updated_at = date('Y-m-d H:i:s');
            $this->db->insert($this->table, $this);
            $save_id = $this->db->insert_id();
        }

        $this->data = $this->db->get_where($this->table, array('id' => $save_id))->first_row();
        $this->populate();
    }

    private function populate()
    {
        if (!empty($this->data)) {
            if (is_array($this->data)) {
                $this->{$this->table} = $this->data;
            } else {
                foreach ($this->data as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }

    private function safe()
    {
        foreach ($this->safe as $safe) {
            unset($this->{$safe});
        }
    }

}

/* End of file WS_Model.php */
