<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nilai extends CI_Controller
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
        $this->load->model('Modelnilai');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/nilai/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/nilai/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/nilai/index.html';
            $config['first_url'] = base_url() . 'admin/nilai/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Modelnilai->total_rows($q);
        $nilai = $this->Modelnilai->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'nilai_data' => $nilai,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('nilai/table_nilai_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Modelnilai->get_by_id($id);
        if ($row) {
            $data = array(
		'id_nilai' => $row->id_nilai,
		'nilai' => $row->nilai,
		'grade' => $row->grade,
		'table_mahasiswa_nim' => $row->table_mahasiswa_nim,
		'table_matakuliah_kode_matakuliah' => $row->table_matakuliah_kode_matakuliah,
	    );
            $this->load->view('nilai/table_nilai_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/nilai'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/nilai/create_action'),
	    'id_nilai' => set_value('id_nilai'),
	    'nilai' => set_value('nilai'),
	    'grade' => set_value('grade'),
	    'table_mahasiswa_nim' => set_value('table_mahasiswa_nim'),
	    'table_matakuliah_kode_matakuliah' => set_value('table_matakuliah_kode_matakuliah'),
        'mahasiswa' => $this->Modelnilai->get_nim(),
	);
        $this->load->view('nilai/table_nilai_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nilai' => $this->input->post('nilai',TRUE),
		'grade' => $this->input->post('grade',TRUE),
		'table_mahasiswa_nim' => $this->input->post('table_mahasiswa_nim',TRUE),
		'table_matakuliah_kode_matakuliah' => $this->input->post('table_matakuliah_kode_matakuliah',TRUE),
	    );

            $this->Modelnilai->insert($data);
            $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Entry nilai berhasil</div>");
            redirect(site_url('admin/qnilai'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Modelnilai->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/nilai/update_action'),
		'id_nilai' => set_value('id_nilai', $row->id_nilai),
		'nilai' => set_value('nilai', $row->nilai),
		'grade' => set_value('grade', $row->grade),
		'table_mahasiswa_nim' => set_value('table_mahasiswa_nim', $row->table_mahasiswa_nim),
		'table_matakuliah_kode_matakuliah' => set_value('table_matakuliah_kode_matakuliah', $row->table_matakuliah_kode_matakuliah),
	    );
            $this->load->view('nilai/edit_nilai_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/qnilai'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_nilai', TRUE));
        } else {
            $data = array(
		'nilai' => $this->input->post('nilai',TRUE),
		'grade' => $this->input->post('grade',TRUE),
		'table_mahasiswa_nim' => $this->input->post('table_mahasiswa_nim',TRUE),
		'table_matakuliah_kode_matakuliah' => $this->input->post('table_matakuliah_kode_matakuliah',TRUE),
	    );

            $this->Modelnilai->update($this->input->post('id_nilai', TRUE), $data);
            $this->session->set_flashdata("message", "<div class=\"alert alert-info alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Data sudah diubah</div>");
            redirect(site_url('admin/qnilai'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Modelnilai->get_by_id($id);

        if ($row) {
            $this->Modelnilai->delete($id);
            $this->session->set_flashdata("message", "<div class=\"alert alert-warning alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Data sudah dihapus</div>");
            redirect(site_url('admin/qnilai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/qnilai'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
	$this->form_validation->set_rules('grade', 'grade', 'trim|required');
	$this->form_validation->set_rules('table_mahasiswa_nim', 'table mahasiswa id mahasiswa', 'trim|required');
	$this->form_validation->set_rules('table_matakuliah_kode_matakuliah', 'table matakuliah id matakuliah', 'trim|required');

	$this->form_validation->set_rules('id_nilai', 'id_nilai', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "table_nilai.xls";
        $judul = "table_nilai";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai");
	xlsWriteLabel($tablehead, $kolomhead++, "Grade");
	xlsWriteLabel($tablehead, $kolomhead++, "Table Mahasiswa Id Mahasiswa");
	xlsWriteLabel($tablehead, $kolomhead++, "Table Matakuliah Id Matakuliah");

	foreach ($this->Modelnilai->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->grade);
	    xlsWriteNumber($tablebody, $kolombody++, $data->table_mahasiswa_id_mahasiswa);
	    xlsWriteNumber($tablebody, $kolombody++, $data->table_matakuliah_id_matakuliah);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}