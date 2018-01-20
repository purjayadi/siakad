<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entry_khs extends CI_Controller
{
    function __construct()
    {
         parent::__construct();
       
        
        $data['username'] = $this->session->userdata('username');
        $this->load->model('Qkhs_model');
        $this->load->model('Entry_khs_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
         $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/khs/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/khs/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/khs/index.html';
            $config['first_url'] = base_url() . 'admin/khs/index.html';
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
        $row = $this->Entry_khs_model->get_by_id($id);
        if ($row) {
            $data = array(
		'identry_khs' => $row->identry_khs,
		'table_mahasiswa_nim' => $row->table_mahasiswa_nim,
		'table_matakuliah_kode_matakuliah' => $row->table_matakuliah_kode_matakuliah,
		'table_nilai_id_nilai' => $row->table_nilai_id_nilai,
		'table_semester_id_semester' => $row->table_semester_id_semester,
		'tahun_ajaran' => $row->tahun_ajaran,
		'sksn' => $row->sksn,
	    );
            $this->load->view('entry_khs/entry_khs_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/entry_khs'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/entry_khs/create_action'),
	    'identry_khs' => set_value('identry_khs'),
	    'table_mahasiswa_nim' => set_value('table_mahasiswa_nim'),
	    'table_nilai_id_nilai' => set_value('table_nilai_id_nilai'),
	    'table_semester_id_semester' => set_value('table_semester_id_semester'),
	    'tahun_ajaran' => set_value('tahun_ajaran'),
	    'sksn' => set_value('sksn'),
        'semester' => $this->Entry_khs_model->get_semester(),
        'tahun_ajaran' => $this->Entry_khs_model->get_tahun_ajaran(),
         'semester_selected' => '',
         'tahun_ajaran_selected' => '',
	);
        $data['provinsi']=$this->Entry_khs_model->ambil_provinsi();
        $this->load->view('entry_khs/entry_khs_form', $data);
    }

    public function pilih_kabupaten(){
        $data['kabupaten']=$this->Entry_khs_model->ambil_kabupaten($this->uri->segment(4));
        $this->load->view('entry_khs/v_drop_down_kabupaten',$data);
    }

     public function pilih_kecamatan(){
        $data['kecamatan']=$this->Entry_khs_model->ambil_kecamatan($this->uri->segment(4));
        $this->load->view('entry_khs/v_drop_down_kecamatan',$data);
    }

      
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'table_mahasiswa_nim' => $this->input->post('table_mahasiswa_nim',TRUE),
		'table_matakuliah_kode_matakuliah' => $this->input->post('table_matakuliah_kode_matakuliah',TRUE),
		'table_nilai_id_nilai' => $this->input->post('table_nilai_id_nilai',TRUE),
		'table_semester_id_semester' => $this->input->post('table_semester_id_semester',TRUE),
		'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
		'sksn' => $this->input->post('sksn',TRUE),
	    );

            $this->Entry_khs_model->insert($data);
            $this->session->set_flashdata("message", "<div class=\"alert alert-success alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Entry KHS berhasil</div>");
            redirect(site_url('admin/entry_khs'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Entry_khs_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/entry_khs/update_action'),
		'identry_khs' => set_value('identry_khs', $row->identry_khs),
		'table_mahasiswa_nim' => set_value('table_mahasiswa_nim', $row->table_mahasiswa_id_mahasiswa),
		'table_matakuliah_kode_matakuliah' => set_value('table_matakuliah_kode_matakuliah', $row->table_matakuliah_kode_matakuliah),
		'table_nilai_id_nilai' => set_value('table_nilai_id_nilai', $row->table_nilai_id_nilai),
		'table_semester_id_semester' => set_value('table_semester_id_semester', $row->table_semester_id_semester),
		'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),
		'sksn' => set_value('sksn', $row->sksn),
	    );
            $this->load->view('entry_khs/entry_khs_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/entry_khs'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('identry_khs', TRUE));
        } else {
            $data = array(
		'table_mahasiswa_nim' => $this->input->post('table_mahasiswa_nim',TRUE),
		'table_matakuliah_kode_matakuliah' => $this->input->post('table_matakuliah_kode_matakuliah',TRUE),
		'table_nilai_id_nilai' => $this->input->post('table_nilai_id_nilai',TRUE),
		'table_semester_id_semester' => $this->input->post('table_semester_id_semester',TRUE),
		'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
		'sksn' => $this->input->post('sksn',TRUE),
	    );

            $this->Entry_khs_model->update($this->input->post('identry_khs', TRUE), $data);
             $this->session->set_flashdata("message", "<div class=\"alert alert-info alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Data sudah diubah</div>");
            redirect(site_url('admin/entry_khs'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Entry_khs_model->get_by_id($id);

        if ($row) {
            $this->Entry_khs_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
             $this->session->set_flashdata("message", "<div class=\"alert alert-warning alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Data sudah dihapus</div>");
              redirect(site_url('admin/entry_khs'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/entry_khs'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('table_mahasiswa_nim', 'table mahasiswa id mahasiswa', 'trim|required');
	$this->form_validation->set_rules('table_matakuliah_kode_matakuliah', 'table matakuliah id matakuliah', 'trim|required');
	$this->form_validation->set_rules('table_nilai_id_nilai', 'table nilai id nilai', 'trim|required');
	$this->form_validation->set_rules('table_semester_id_semester', 'table semester id semester', 'trim|required');
	$this->form_validation->set_rules('tahun_ajaran', 'tahun ajaran', 'trim|required');
	$this->form_validation->set_rules('sksn', 'sksn', 'trim|required');

	$this->form_validation->set_rules('identry_khs', 'identry_khs', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}