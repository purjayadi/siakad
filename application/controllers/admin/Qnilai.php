<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Qnilai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
         if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('admin')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
        $this->load->model('Qnilai_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/qnilai/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/qnilai/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/qnilai/index.html';
            $config['first_url'] = base_url() . 'admin/qnilai/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Qnilai_model->total_rows($q);
        $qnilai = $this->Qnilai_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'qnilai_data' => $qnilai,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('qnilai/qnilai_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Qnilai_model->get_by_id($id);
        if ($row) {
            $data = array(
		'nim' => $row->nim,
		'nama_mahasiswa' => $row->nama_mahasiswa,
		'kode_matakuliah' => $row->kode_matakuliah,
		'nama_matakuliah' => $row->nama_matakuliah,
		'nilai' => $row->nilai,
		'grade' => $row->grade,
	    );
            $this->load->view('qnilai/qnilai_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('qnilai'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('qnilai/create_action'),
	    'nim' => set_value('nim'),
	    'nama_mahasiswa' => set_value('nama_mahasiswa'),
	    'kode_matakuliah' => set_value('kode_matakuliah'),
	    'nama_matakuliah' => set_value('nama_matakuliah'),
	    'nilai' => set_value('nilai'),
	    'grade' => set_value('grade'),
	);
        $this->load->view('qnilai/qnilai_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nim' => $this->input->post('nim',TRUE),
		'nama_mahasiswa' => $this->input->post('nama_mahasiswa',TRUE),
		'kode_matakuliah' => $this->input->post('kode_matakuliah',TRUE),
		'nama_matakuliah' => $this->input->post('nama_matakuliah',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
		'grade' => $this->input->post('grade',TRUE),
	    );

            $this->Qnilai_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('qnilai'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Qnilai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('qnilai/update_action'),
		'nim' => set_value('nim', $row->nim),
		'nama_mahasiswa' => set_value('nama_mahasiswa', $row->nama_mahasiswa),
		'kode_matakuliah' => set_value('kode_matakuliah', $row->kode_matakuliah),
		'nama_matakuliah' => set_value('nama_matakuliah', $row->nama_matakuliah),
		'nilai' => set_value('nilai', $row->nilai),
		'grade' => set_value('grade', $row->grade),
	    );
            $this->load->view('qnilai/edit_nilai_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('qnilai'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'nim' => $this->input->post('nim',TRUE),
		'nama_mahasiswa' => $this->input->post('nama_mahasiswa',TRUE),
		'kode_matakuliah' => $this->input->post('kode_matakuliah',TRUE),
		'nama_matakuliah' => $this->input->post('nama_matakuliah',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
		'grade' => $this->input->post('grade',TRUE),
	    );

            $this->Qnilai_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('qnilai'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Qnilai_model->get_by_id($id);

        if ($row) {
            $this->Qnilai_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('qnilai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('qnilai'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nim', 'nim', 'trim|required');
	$this->form_validation->set_rules('nama_mahasiswa', 'nama mahasiswa', 'trim|required');
	$this->form_validation->set_rules('kode_matakuliah', 'kode matakuliah', 'trim|required');
	$this->form_validation->set_rules('nama_matakuliah', 'nama matakuliah', 'trim|required');
	$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
	$this->form_validation->set_rules('grade', 'grade', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "qnilai.xls";
        $judul = "qnilai";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nim");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Mahasiswa");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Matakuliah");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Matakuliah");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai");
	xlsWriteLabel($tablehead, $kolomhead++, "Grade");

	foreach ($this->Qnilai_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nim);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_mahasiswa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_matakuliah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_matakuliah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->grade);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
