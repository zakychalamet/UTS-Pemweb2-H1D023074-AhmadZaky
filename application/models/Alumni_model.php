<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Mengambil semua data alumni
    public function get_all_alumni() {
        $query = $this->db->order_by('name', 'ASC')->get('Alumni');
        return $query->result();
    }
    
    // Mengambil ID tertentu
    public function get_alumni($alumni_id) {
        $query = $this->db->where('alumni_id', $alumni_id)->get('Alumni');
        return $query->row();
    }
    
    // Insert new alumni record
    public function insert_alumni($data) {
        return $this->db->insert('Alumni', $data);
    }
    
    // Update existing alumni record
    public function update_alumni($alumni_id, $data) {
        $this->db->where('alumni_id', $alumni_id);
        return $this->db->update('Alumni', $data);
    }
    
    // Delete alumni record
    public function delete_alumni($alumni_id) {
        $this->db->where('alumni_id', $alumni_id);
        return $this->db->delete('Alumni');
    }
    
    // Search alumni by name and/or tahun_lulus
    public function search_alumni($name = '', $tahun = '') {
        if (!empty($name)) {
            $this->db->like('name', $name);
        }
        
        if (!empty($tahun)) {
            $this->db->where('tahun_lulus', $tahun);
        }
        
        $query = $this->db->order_by('name', 'ASC')->get('Alumni');
        return $query->result();
    }
    
    // Get alumni count per year for statistics
    public function get_alumni_stats() {
        $this->db->select('tahun_lulus, COUNT(*) as count');
        $this->db->group_by('tahun_lulus');
        $this->db->order_by('tahun_lulus', 'ASC');
        $query = $this->db->get('Alumni');
        return $query->result();
    }
    
    // Get distinct tahun_lulus for dropdown
    public function get_distinct_years() {
        $this->db->select('DISTINCT(tahun_lulus) as year');
        $this->db->order_by('tahun_lulus', 'DESC');
        $query = $this->db->get('Alumni');
        return $query->result();
    }
}