<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        /*if ($this->session->userdata('username')=="")
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
            
        }*/
         if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('admin')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
        $this->load->model('Modeljurusan');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/jurusan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/jurusan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/jurusan/index.html';
            $config['first_url'] = base_url() . 'admin/jurusan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Modeljurusan->total_rows($q);
        $jurusan = $this->Modeljurusan->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jurusan_data' => $jurusan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('jurusan/table_jurusan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Modeljurusan->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_jurusan' => $row->kode_jurusan,
		'nama_jurusan' => $row->nama_jurusan,
		'jenjang' => $row->jenjang,
	    );
            $this->load->view('jurusan/table_jurusan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/jurusan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/jurusan/create_action'),
	    'kode_jurusan' => set_value('kode_jurusan'),
	    'nama_jurusan' => set_value('nama_jurusan'),
	    'jenjang' => set_value('jenjang'),
	);
        $this->load->view('jurusan/table_jurusan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_jurusan' => $this->input->post('nama_jurusan',TRUE),
		'jenjang' => $this->input->post('jenjang',TRUE),
	    );

            $this->Modeljurusan->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/jurusan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Modeljurusan->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/jurusan/update_action'),
		'kode_jurusan' => set_value('kode_jurusan', $row->kode_jurusan),
		'nama_jurusan' => set_value('nama_jurusan', $row->nama_jurusan),
		'jenjang' => set_value('jenjang', $row->jenjang),
	    );
            $this->load->view('jurusan/table_jurusan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/jurusan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_jurusan', TRUE));
        } else {
            $data = array(
		'nama_jurusan' => $this->input->post('nama_jurusan',TRUE),
		'jenjang' => $this->input->post('jenjang',TRUE),
	    );

            $this->Modeljurusan->update($this->input->post('kode_jurusan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/jurusan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Modeljurusan->get_by_id($id);

        if ($row) {
            $this->Modeljurusan->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/jurusan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/jurusan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_jurusan', 'nama jurusan', 'trim|required');
	$this->form_validation->set_rules('jenjang', 'jenjang', 'trim|required');

	$this->form_validation->set_rules('kode_jurusan', 'kode_jurusan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "table_jurusan.xls";
        $judul = "table_jurusan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Jurusan");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenjang");

	foreach ($this->Modeljurusan->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_jurusan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenjang);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}