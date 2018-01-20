<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Semester_sekarang extends CI_Controller
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
        $this->load->model('Modelsemestersekarang');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/semester_sekarang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/semester_sekarang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/semester_sekarang/index.html';
            $config['first_url'] = base_url() . 'admin/semester_sekarang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Modelsemestersekarang->total_rows($q);
        $semester_sekarang = $this->Modelsemestersekarang->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'semester_sekarang_data' => $semester_sekarang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('semester_sekarang/table_smstrskrg_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Modelsemestersekarang->get_by_id($id);
        if ($row) {
            $data = array(
		'id_smstrskrg' => $row->id_smstrskrg,
		'nama_semester_sekarang' => $row->nama_semester_sekarang,
	    );
            $this->load->view('semester_sekarang/table_smstrskrg_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/semester_sekarang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/semester_sekarang/create_action'),
	    'id_smstrskrg' => set_value('id_smstrskrg'),
	    'nama_semester_sekarang' => set_value('nama_semester_sekarang'),
         'status' => set_value('status'),
	);
        $this->load->view('semester_sekarang/table_smstrskrg_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_semester_sekarang' => $this->input->post('nama_semester_sekarang',TRUE),
        'status' => $this->input->post('status',TRUE),
	    );

            $this->Modelsemestersekarang->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/semester_sekarang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Modelsemestersekarang->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/semester_sekarang/update_action'),
		'id_smstrskrg' => set_value('id_smstrskrg', $row->id_smstrskrg),
		'nama_semester_sekarang' => set_value('nama_semester_sekarang', $row->nama_semester_sekarang),
        'status' => set_value('nama_semester_sekarang', $row->status),
	    );
            $this->load->view('semester_sekarang/table_smstrskrg_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/semester_sekarang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_smstrskrg', TRUE));
        } else {
            $data = array(
		'nama_semester_sekarang' => $this->input->post('nama_semester_sekarang',TRUE),
        'status' => $this->input->post('status',TRUE),
	    );

            $this->Modelsemestersekarang->update($this->input->post('id_smstrskrg', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/semester_sekarang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Modelsemestersekarang->get_by_id($id);

        if ($row) {
            $this->Modelsemestersekarang->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/semester_sekarang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/semester_sekarang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_semester_sekarang', 'nama semester sekarang', 'trim|required');
    $this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id_smstrskrg', 'id_smstrskrg', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "table_smstrskrg.xls";
        $judul = "table_smstrskrg";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Semester Sekarang");

	foreach ($this->Modelsemestersekarang->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_semester_sekarang);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}