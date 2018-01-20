<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tahun_ajaran extends CI_Controller
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
        $data['username'] = $this->session->userdata('username');
        $this->load->model('Table_ta_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/tahun_ajaran/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/tahun_ajaran/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/tahun_ajaran/index.html';
            $config['first_url'] = base_url() . 'admin/tahun_ajaran/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Table_ta_model->total_rows($q);
        $tahun_ajaran = $this->Table_ta_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tahun_ajaran_data' => $tahun_ajaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tahun_ajaran/table_ta_list', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/tahun_ajaran/create_action'),
	    'idtable_ta' => set_value('idtable_ta'),
	    'tahun_ajaran' => set_value('tahun_ajaran'),
        'status' => set_value('status'),
	);
        $this->load->view('tahun_ajaran/table_ta_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
	    );

            $this->Table_ta_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/tahun_ajaran'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Table_ta_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/tahun_ajaran/update_action'),
		'idtable_ta' => set_value('idtable_ta', $row->idtable_ta),
		'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),
        'status' => set_value('tahun_ajaran', $row->status),
	    );
            $this->load->view('tahun_ajaran/table_ta_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahun_ajaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idtable_ta', TRUE));
        } else {
            $data = array(
		'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
        'status' => $this->input->post('status',TRUE),
	    );

            $this->Table_ta_model->update($this->input->post('idtable_ta', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/tahun_ajaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Table_ta_model->get_by_id($id);

        if ($row) {
            $this->Table_ta_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/tahun_ajaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/tahun_ajaran'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tahun_ajaran', 'tahun ajaran', 'trim|required');
    $this->form_validation->set_rules('status', 'Status', 'trim|required');

	$this->form_validation->set_rules('idtable_ta', 'idtable_ta', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}