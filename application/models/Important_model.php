<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Important_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_key($table_name, $column_name, $prefix)
    {
        $key = $this->__generate_key($prefix);

        while ($this->__key_exist($key, $table_name, $column_name)) {
            $key = $this->__generate_key($prefix);
        }
        return $key;

    }

    private function __generate_key($prefix)
    {
        $a = md5(uniqid(mt_rand(), true));
        $a = substr($a, 0, 20);
        $str = $prefix . "_" . $a;
        return $str;
    }

    private function __key_exist($key, $table_name, $column_name)
    {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where($column_name, $key);
        $this->db->limit(1); //ons is good enough
        $num_rows = $this->db->get()->num_rows();

        return $num_rows > 0 ? true : false;

    }

}
