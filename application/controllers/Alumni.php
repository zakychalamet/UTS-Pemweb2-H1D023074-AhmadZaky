<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Alumni_model');
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'form_validation']);
    }
    
    // Menampilkan semua data alumni
    public function index() {
        $data['alumni'] = $this->Alumni_model->get_all_alumni();
        $data['years'] = $this->Alumni_model->get_distinct_years();
        $this->load->view('alumni_list', $data);
    }
    
    // Menampilkan form alumni baru
    public function add() {
        $this->load->view('alumni_form');
    }
    
    // Proses untuk alumni baru
    public function insert() {
        // Mengatur validasi
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'required|numeric|greater_than[1963]|less_than_equal_to['.date('Y').']');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('alumni_form');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'tahun_lulus' => $this->input->post('tahun_lulus')
            ];
            
            if ($this->Alumni_model->insert_alumni($data)) {
                $this->session->set_flashdata('success', 'Data alumni berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data alumni.');
            }
            
            redirect('alumni');
        }
    }
    
    // Menampilkan form untuk mengedit alumni
    public function edit($alumni_id) {
        $data['alumni'] = $this->Alumni_model->get_alumni($alumni_id);
        
        if (empty($data['alumni'])) {
            $this->session->set_flashdata('error', 'Data alumni tidak ditemukan.');
            redirect('alumni');
        }
        
        $this->load->view('alumni_form', $data);
    }
    
    // Proses form update alumni
    public function update($alumni_id) {
        // Mengatur validasi
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'required|numeric|greater_than[1963]|less_than_equal_to['.date('Y').']');
        
        if ($this->form_validation->run() === FALSE) {
            $data['alumni'] = $this->Alumni_model->get_alumni($alumni_id);
            $this->load->view('alumni_form', $data);
        } else {
            // Mempersiapkan data di-update
            $data = [
                'name' => $this->input->post('name'),
                'tahun_lulus' => $this->input->post('tahun_lulus')
            ];
            
            // Update data
            if ($this->Alumni_model->update_alumni($alumni_id, $data)) {
                $this->session->set_flashdata('success', 'Data alumni berhasil di-update.');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data alumni.');
            }
            
            redirect('alumni');
        }
    }
    
    // Menghapus data alumni
    public function delete($alumni_id) {
        if ($this->Alumni_model->delete_alumni($alumni_id)) {
            $this->session->set_flashdata('success', 'Data alumni berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data alumni.');
        }
        
        redirect('alumni');
    }
    
    // Mencari alumni dari nama dan/atau tahun
    public function search() {
        $name = $this->input->get('name');
        $tahun = $this->input->get('tahun');
        
        $data['alumni'] = $this->Alumni_model->search_alumni($name, $tahun);
        $data['years'] = $this->Alumni_model->get_distinct_years();
        $data['search_name'] = $name;
        $data['search_tahun'] = $tahun;
        
        $this->load->view('alumni_list', $data);
    }
    
    // Menampilkan data statistik
    public function statistics() {
        $data['stats'] = $this->Alumni_model->get_alumni_stats();
        $this->load->view('alumni_statistics', $data);
    }
}