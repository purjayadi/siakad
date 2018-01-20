<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stase extends CI_Controller
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
        $this->load->model('Stase_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/stase/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/stase/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/stase/index.html';
            $config['first_url'] = base_url() . 'admin/stase/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Stase_model->total_rows($q);
        $stase = $this->Stase_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'stase_data' => $stase,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('stase/table_stase_list', $data);
    }


    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/stase/create_action'),
	    'idtable_stase' => set_value('idtable_stase'),
	    'stase' => set_value('stase'),
	    'status' => set_value('status'),
	);
        $this->load->view('stase/table_stase_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'stase' => $this->input->post('stase',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Stase_model->insert($data);
            $this->session->set_flashdata("message", "<div class=\"alert alert-success alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Berhasil tambah data</div>");
            redirect(site_url('admin/stase'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Stase_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/stase/update_action'),
		'idtable_stase' => set_value('idtable_stase', $row->idtable_stase),
		'stase' => set_value('stase', $row->stase),
		'status' => set_value('status', $row->status),
	    );
            $this->load->view('stase/table_stase_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/stase'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idtable_stase', TRUE));
        } else {
            $data = array(
		'stase' => $this->input->post('stase',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Stase_model->update($this->input->post('idtable_stase', TRUE), $data);
           $this->session->set_flashdata("message", "<div class=\"alert alert-info alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Data sudah diubah</div>");
            redirect(site_url('admin/stase'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Stase_model->get_by_id($id);

        if ($row) {
            $this->Stase_model->delete($id);
            $this->session->set_flashdata("message", "<div class=\"alert alert-warning alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Data sudah dihapus</div>");
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/stase'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('stase', 'stase', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('idtable_stase', 'idtable_stase', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "table_stase.xls";
        $judul = "table_stase";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Stase");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Stase_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->stase);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Stase.php */
/* Location: ./application/controllers/Stase.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-02-28 23:35:49 */
/* http://harviacode.com */