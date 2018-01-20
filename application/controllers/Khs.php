<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Khs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Qkhs_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'khs/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'khs/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'khs/index.html';
            $config['first_url'] = base_url() . 'khs/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Qkhs_model->total_rows($q);
        $khs = $this->Qkhs_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'khs_data' => $khs,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('khs/qkhs_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Qkhs_model->get_by_id($id);
        if ($row) {
            $data = array(
		'identry_khs' => $row->identry_khs,
		'nim' => $row->nim,
		'nama_mahasiswa' => $row->nama_mahasiswa,
		'kode_matakuliah' => $row->kode_matakuliah,
		'nama_matakuliah' => $row->nama_matakuliah,
		'sks' => $row->sks,
		'nilai' => $row->nilai,
		'grade' => $row->grade,
		'sksn' => $row->sksn,
		'nama_semester' => $row->nama_semester,
		'tahun_ajaran' => $row->tahun_ajaran,
	    );
            $this->load->view('khs/qkhs_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('khs'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('khs/create_action'),
	    'identry_khs' => set_value('identry_khs'),
	    'nim' => set_value('nim'),
	    'nama_mahasiswa' => set_value('nama_mahasiswa'),
	    'kode_matakuliah' => set_value('kode_matakuliah'),
	    'nama_matakuliah' => set_value('nama_matakuliah'),
	    'sks' => set_value('sks'),
	    'nilai' => set_value('nilai'),
	    'grade' => set_value('grade'),
	    'sksn' => set_value('sksn'),
	    'nama_semester' => set_value('nama_semester'),
	    'tahun_ajaran' => set_value('tahun_ajaran'),
	);
        $this->load->view('khs/qkhs_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'identry_khs' => $this->input->post('identry_khs',TRUE),
		'nim' => $this->input->post('nim',TRUE),
		'nama_mahasiswa' => $this->input->post('nama_mahasiswa',TRUE),
		'kode_matakuliah' => $this->input->post('kode_matakuliah',TRUE),
		'nama_matakuliah' => $this->input->post('nama_matakuliah',TRUE),
		'sks' => $this->input->post('sks',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
		'grade' => $this->input->post('grade',TRUE),
		'sksn' => $this->input->post('sksn',TRUE),
		'nama_semester' => $this->input->post('nama_semester',TRUE),
		'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
	    );

            $this->Qkhs_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('khs'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Qkhs_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('khs/update_action'),
		'identry_khs' => set_value('identry_khs', $row->identry_khs),
		'nim' => set_value('nim', $row->nim),
		'nama_mahasiswa' => set_value('nama_mahasiswa', $row->nama_mahasiswa),
		'kode_matakuliah' => set_value('kode_matakuliah', $row->kode_matakuliah),
		'nama_matakuliah' => set_value('nama_matakuliah', $row->nama_matakuliah),
		'sks' => set_value('sks', $row->sks),
		'nilai' => set_value('nilai', $row->nilai),
		'grade' => set_value('grade', $row->grade),
		'sksn' => set_value('sksn', $row->sksn),
		'nama_semester' => set_value('nama_semester', $row->nama_semester),
		'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),
	    );
            $this->load->view('khs/qkhs_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('khs'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'identry_khs' => $this->input->post('identry_khs',TRUE),
		'nim' => $this->input->post('nim',TRUE),
		'nama_mahasiswa' => $this->input->post('nama_mahasiswa',TRUE),
		'kode_matakuliah' => $this->input->post('kode_matakuliah',TRUE),
		'nama_matakuliah' => $this->input->post('nama_matakuliah',TRUE),
		'sks' => $this->input->post('sks',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
		'grade' => $this->input->post('grade',TRUE),
		'sksn' => $this->input->post('sksn',TRUE),
		'nama_semester' => $this->input->post('nama_semester',TRUE),
		'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
	    );

            $this->Qkhs_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('khs'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Qkhs_model->get_by_id($id);

        if ($row) {
            $this->Qkhs_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('khs'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('khs'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('identry_khs', 'identry khs', 'trim|required');
	$this->form_validation->set_rules('nim', 'nim', 'trim|required');
	$this->form_validation->set_rules('nama_mahasiswa', 'nama mahasiswa', 'trim|required');
	$this->form_validation->set_rules('kode_matakuliah', 'kode matakuliah', 'trim|required');
	$this->form_validation->set_rules('nama_matakuliah', 'nama matakuliah', 'trim|required');
	$this->form_validation->set_rules('sks', 'sks', 'trim|required');
	$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
	$this->form_validation->set_rules('grade', 'grade', 'trim|required');
	$this->form_validation->set_rules('sksn', 'sksn', 'trim|required');
	$this->form_validation->set_rules('nama_semester', 'nama semester', 'trim|required');
	$this->form_validation->set_rules('tahun_ajaran', 'tahun ajaran', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Khs.php */
/* Location: ./application/controllers/Khs.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-01-17 10:13:22 */
/* http://harviacode.com */