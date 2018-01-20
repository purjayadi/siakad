<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
       if ($this->session->userdata('username')=="")
         {
            redirect('auth');
        }
        elseif ($this->session->userdata('status')=='non_aktif') {
            return show_error('Status user belum aktif, silahkan menghubungi admin.');
            $this->_render_page('auth', $this->data);
            # code...
        }
        else if ($this->session->userdata('level')=="admin") {
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('level');
            session_destroy();
            redirect('auth');
            
        }
        $this->load->model('Modelblok');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/blok/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/blok/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/blok/index.html';
            $config['first_url'] = base_url() . 'admin/blok/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Modelblok->total_rows($q);
        $blok = $this->Modelblok->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'blok_data' => $blok,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('blok/table_blok_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Modelblok->get_by_id($id);
        if ($row) {
            $data = array(
		'id_blok' => $row->id_blok,
		'kode_blok' => $row->kode_blok,
		'nama_blok' => $row->nama_blok,
	    );
            $this->load->view('blok/table_blok_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/blok'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/blok/create_action'),
	    'id_blok' => set_value('id_blok'),
	    'kode_blok' => set_value('kode_blok'),
	    'nama_blok' => set_value('nama_blok'),
	    'table_kurikulum_id_kurikulum' => set_value('table_kurikulum_id_kurikulum'),
	);
        $this->load->view('blok/table_blok_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_blok' => $this->input->post('kode_blok',TRUE),
		'nama_blok' => $this->input->post('nama_blok',TRUE),
		'table_kurikulum_id_kurikulum' => $this->input->post('table_kurikulum_id_kurikulum',TRUE),
	    );

            $this->Modelblok->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/blok'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Modelblok->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/blok/update_action'),
		'id_blok' => set_value('id_blok', $row->id_blok),
		'kode_blok' => set_value('kode_blok', $row->kode_blok),
		'nama_blok' => set_value('nama_blok', $row->nama_blok),
		'table_kurikulum_id_kurikulum' => set_value('table_kurikulum_id_kurikulum', $row->table_kurikulum_id_kurikulum),
	    );
            $this->load->view('blok/table_blok_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/blok'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_blok', TRUE));
        } else {
            $data = array(
		'kode_blok' => $this->input->post('kode_blok',TRUE),
		'nama_blok' => $this->input->post('nama_blok',TRUE),
		'table_kurikulum_id_kurikulum' => $this->input->post('table_kurikulum_id_kurikulum',TRUE),
	    );

            $this->Modelblok->update($this->input->post('id_blok', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/blok'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Modelblok->get_by_id($id);

        if ($row) {
            $this->Modelblok->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/blok'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/blok'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_blok', 'kode blok', 'trim|required');
	$this->form_validation->set_rules('nama_blok', 'nama blok', 'trim|required');

	$this->form_validation->set_rules('id_blok', 'id_blok', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "table_blok.xls";
        $judul = "table_blok";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Blok");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Blok");

	foreach ($this->Modelblok->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_blok);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_blok);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
