<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kurikulum extends CI_Controller
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
        $this->load->model('Model_kurikulum');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/kurikulum/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/kurikulum/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/kurikulum/index.html';
            $config['first_url'] = base_url() . 'admin/kurikulum/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Model_kurikulum->total_rows($q);
        $kurikulum = $this->Model_kurikulum->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kurikulum_data' => $kurikulum,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('kurikulum/table_kurikulum_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Model_kurikulum->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kurikulum' => $row->id_kurikulum,
		'tahun' => $row->tahun,
		'ket' => $row->ket,
	    );
            $this->load->view('kurikulum/table_kurikulum_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/kurikulum'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/kurikulum/create_action'),
	    'id_kurikulum' => set_value('id_kurikulum'),
	    'tahun' => set_value('tahun'),
	    'ket' => set_value('ket'),
	);
        $this->load->view('kurikulum/table_kurikulum_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tahun' => $this->input->post('tahun',TRUE),
		'ket' => $this->input->post('ket',TRUE),
	    );

            $this->Model_kurikulum->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/kurikulum'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Model_kurikulum->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/kurikulum/update_action'),
		'id_kurikulum' => set_value('id_kurikulum', $row->id_kurikulum),
		'tahun' => set_value('tahun', $row->tahun),
		'ket' => set_value('ket', $row->ket),
	    );
            $this->load->view('kurikulum/table_kurikulum_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/kurikulum'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kurikulum', TRUE));
        } else {
            $data = array(
		'tahun' => $this->input->post('tahun',TRUE),
		'ket' => $this->input->post('ket',TRUE),
	    );

            $this->Model_kurikulum->update($this->input->post('id_kurikulum', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/kurikulum'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Model_kurikulum->get_by_id($id);

        if ($row) {
            $this->Model_kurikulum->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/kurikulum'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/kurikulum'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');

	$this->form_validation->set_rules('id_kurikulum', 'id_kurikulum', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}