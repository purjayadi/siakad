<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mksyarat extends CI_Controller
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
        $this->load->model('Modelmksyarat');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/mksyarat/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/mksyarat/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/mksyarat/index.html';
            $config['first_url'] = base_url() . 'admin/mksyarat/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Modelmksyarat->total_rows($q);
        $mksyarat = $this->Modelmksyarat->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'mksyarat_data' => $mksyarat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('mksyarat/table_mksyarat_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Modelmksyarat->get_by_id($id);
        if ($row) {
            $data = array(
		'id_mksyarat' => $row->id_mksyarat,
		'table_matakuliah_kode_matakuliah' => $row->table_matakuliah_id_matakuliah,
		'table_semester_id_semester' => $row->table_semester_id_semester,
		'table_matakuliah_kode_matakuliah1' => $row->table_matakuliah_id_matakuliah1,
	    );
            $this->load->view('mksyarat/table_mksyarat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/mksyarat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/mksyarat/create_action'),
	    'id_mksyarat' => set_value('id_mksyarat'),
	    'table_matakuliah_kode_matakuliah' => set_value('table_matakuliah_kode_matakuliah'),
	    'table_semester_id_semester' => set_value('table_semester_id_semester'),
	    'table_matakuliah_kode_matakuliah1' => set_value('table_matakuliah_kode_matakuliah1'),
	);
        $this->load->view('mksyarat/table_mksyarat_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'table_matakuliah_kode_matakuliah' => $this->input->post('table_matakuliah_kode_matakuliah',TRUE),
		'table_semester_id_semester' => $this->input->post('table_semester_id_semester',TRUE),
		'table_matakuliah_kode_matakuliah1' => $this->input->post('table_matakuliah_kode_matakuliah1',TRUE),
	    );

            $this->Modelmksyarat->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/mksyarat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Modelmksyarat->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/mksyarat/update_action'),
		'id_mksyarat' => set_value('id_mksyarat', $row->id_mksyarat),
		'table_matakuliah_kode_matakuliah' => set_value('table_matakuliah_kode_matakuliah', $row->table_matakuliah_kode_matakuliah),
		'table_semester_id_semester' => set_value('table_semester_id_semester', $row->table_semester_id_semester),
		'table_matakuliah_kode_matakuliah1' => set_value('table_matakuliah_kode_matakuliah1', $row->table_matakuliah_kode_matakuliah1),
	    );
            $this->load->view('mksyarat/table_mksyarat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/mksyarat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_mksyarat', TRUE));
        } else {
            $data = array(
		'table_matakuliah_kode_matakuliah' => $this->input->post('table_matakuliah_kode_matakuliah',TRUE),
		'table_semester_id_semester' => $this->input->post('table_semester_id_semester',TRUE),
		'table_matakuliah_kode_matakuliah1' => $this->input->post('table_matakuliah_kode_matakuliah1',TRUE),
	    );

            $this->Modelmksyarat->update($this->input->post('id_mksyarat', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/mksyarat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Modelmksyarat->get_by_id($id);

        if ($row) {
            $this->Modelmksyarat->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/mksyarat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/mksyarat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('table_matakuliah_kode_matakuliah', 'table matakuliah id matakuliah', 'trim|required');
	$this->form_validation->set_rules('table_semester_id_semester', 'table semester id semester', 'trim|required');
	$this->form_validation->set_rules('table_matakuliah_kode_matakuliah1', 'table matakuliah id matakuliah1', 'trim|required');

	$this->form_validation->set_rules('id_mksyarat', 'id_mksyarat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "table_mksyarat.xls";
        $judul = "table_mksyarat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Table Matakuliah Id Matakuliah");
	xlsWriteLabel($tablehead, $kolomhead++, "Table Semester Id Semester");
	xlsWriteLabel($tablehead, $kolomhead++, "Table Matakuliah Id Matakuliah1");

	foreach ($this->Modelmksyarat->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->table_matakuliah_id_matakuliah);
	    xlsWriteNumber($tablebody, $kolombody++, $data->table_semester_id_semester);
	    xlsWriteNumber($tablebody, $kolombody++, $data->table_matakuliah_id_matakuliah1);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
