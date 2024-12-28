<?php
class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_users($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('Tb_usuarios');
            return $query->result_array();
        }
        $query = $this->db->get_where('Tb_usuarios', array('id' => $id));
        return $query->row_array();
    }

    public function set_user($data) {
        return $this->db->insert('Tb_usuarios', $data);
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('Tb_usuarios', $data);
    }

    public function delete_user($id) {
        return $this->db->delete('Tb_usuarios', array('id' => $id));
    }
}
?>