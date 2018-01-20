<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Qmatakuliah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Qmatakuliah_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'qmatakuliah/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'qmatakuliah/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'qmatakuliah/index.html';
            $config['first_url'] = base_url() . 'qmatakuliah/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Qmatakuliah_model->total_rows($q);
        $qmatakuliah = $this->Qmatakuliah_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'qmatakuliah_data' => $qmatakuliah,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('matakuliah/qmatakuliah_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Qmatakuliah_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_matakuliah' => $row->id_matakuliah,
		'kode_matakuliah' => $row->kode_matakuliah,
		'nama_matakuliah' => $row->nama_matakuliah,
		'nama_dosen' => $row->nama_dosen,
		'nama_blok' => $row->nama_blok,
		'nama_semester' => $row->nama_semester,
	    );
            $this->load->view('qmatakuliah/qmatakuliah_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('qmatakuliah'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('qmatakuliah/create_action'),
	    'id_matakuliah' => set_value('id_matakuliah'),
	    'kode_matakuliah' => set_value('kode_matakuliah'),
	    'nama_matakuliah' => set_value('nama_matakuliah'),
	    'nama_dosen' => set_value('nama_dosen'),
	    'nama_blok' => set_value('nama_blok'),
	    'nama_semester' => set_value('nama_semester'),
	);
        $this->load->view('qmatakuliah/qmatakuliah_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_matakuliah' => $this->input->post('id_matakuliah',TRUE),
		'kode_matakuliah' => $this->input->post('kode_matakuliah',TRUE),
		'nama_matakuliah' => $this->input->post('nama_matakuliah',TRUE),
		'nama_dosen' => $this->input->post('nama_dosen',TRUE),
		'nama_blok' => $this->input->post('nama_blok',TRUE),
		'nama_semester' => $this->input->post('nama_semester',TRUE),
	    );

            $this->Qmatakuliah_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('qmatakuliah'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Qmatakuliah_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('qmatakuliah/update_action'),
		'id_matakuliah' => set_value('id_matakuliah', $row->id_matakuliah),
		'kode_matakuliah' => set_value('kode_matakuliah', $row->kode_matakuliah),
		'nama_matakuliah' => set_value('nama_matakuliah', $row->nama_matakuliah),
		'nama_dosen' => set_value('nama_dosen', $row->nama_dosen),
		'nama_blok' => set_value('nama_blok', $row->nama_blok),
		'nama_semester' => set_value('nama_semester', $row->nama_semester),
	    );
            $this->load->view('qmatakuliah/qmatakuliah_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('qmatakuliah'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'id_matakuliah' => $this->input->post('id_matakuliah',TRUE),
		'kode_matakuliah' => $this->input->post('kode_matakuliah',TRUE),
		'nama_matakuliah' => $this->input->post('nama_matakuliah',TRUE),
		'nama_dosen' => $this->input->post('nama_dosen',TRUE),
		'nama_blok' => $this->input->post('nama_blok',TRUE),
		'nama_semester' => $this->input->post('nama_semester',TRUE),
	    );

            $this->Qmatakuliah_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('qmatakuliah'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Qmatakuliah_model->get_by_id($id);

        if ($row) {
            $this->Qmatakuliah_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('qmatakuliah'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('qmatakuliah'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_matakuliah', 'id matakuliah', 'trim|required');
	$this->form_validation->set_rules('kode_matakuliah', 'kode matakuliah', 'trim|required');
	$this->form_validation->set_rules('nama_matakuliah', 'nama matakuliah', 'trim|required');
	$this->form_validation->set_rules('nama_dosen', 'nama dosen', 'trim|required');
	$this->form_validation->set_rules('nama_blok', 'nama blok', 'trim|required');
	$this->form_validation->set_rules('nama_semester', 'nama semester', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "qmatakuliah.xls";
        $judul = "qmatakuliah";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Matakuliah");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Matakuliah");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Matakuliah");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Dosen");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Blok");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Semester");

	foreach ($this->Qmatakuliah_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_matakuliah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_matakuliah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_matakuliah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_dosen);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_blok);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_semester);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
