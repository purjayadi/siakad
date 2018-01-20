<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dosen extends CI_Controller
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
        $this->load->model('Modeldosen');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/dosen/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/dosen/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/dosen/index.html';
            $config['first_url'] = base_url() . 'admin/dosen/index.html';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Modeldosen->total_rows($q);
        $dosen = $this->Modeldosen->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'dosen_data' => $dosen,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('dosen/table_dosen_list', $data);
    }

    public function read($id) 
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $row = $this->Modeldosen->get_by_id($id);
        if ($row) {
            $data = array(
		'id_dosen' => $row->id_dosen,
		'nidn' => $row->nidn,
		'nama_dosen' => $row->nama_dosen,
		'tempat_lahir' => $row->tempat_lahir,
		'tanggal_lahir' => $row->tanggal_lahir,
		'agama' => $row->agama,
		'jenis_kelamin' => $row->jenis_kelamin,
		'alamat' => $row->alamat,
		'bidang_keahlian' => $row->bidang_keahlian,
		'jabatan' => $row->jabatan,
		'tlpn' => $row->tlpn,
		'status' => $row->status,
	    );
            $this->load->view('dosen/table_dosen_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/dosen'));
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/dosen/create_action'),
	    'id_dosen' => set_value('id_dosen'),
	    'nidn' => set_value('nidn'),
	    'nama_dosen' => set_value('nama_dosen'),
	    'tempat_lahir' => set_value('tempat_lahir'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
	    'agama' => set_value('agama'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'alamat' => set_value('alamat'),
	    'bidang_keahlian' => set_value('bidang_keahlian'),
	    'jabatan' => set_value('jabatan'),
	    'tlpn' => set_value('tlpn'),
	    'status' => set_value('status'),
	);
        $this->load->view('dosen/table_dosen_form', $data);
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nidn' => $this->input->post('nidn',TRUE),
		'nama_dosen' => $this->input->post('nama_dosen',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'agama' => $this->input->post('agama',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'bidang_keahlian' => $this->input->post('bidang_keahlian',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
		'tlpn' => $this->input->post('tlpn',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Modeldosen->insert($data);
            $this->session->set_flashdata("message", "<div class=\"alert alert-success alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Berhasil tambah data</div>");
            redirect(site_url('admin/dosen'));
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $row = $this->Modeldosen->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/dosen/update_action'),
		'id_dosen' => set_value('id_dosen', $row->id_dosen),
		'nidn' => set_value('nidn', $row->nidn),
		'nama_dosen' => set_value('nama_dosen', $row->nama_dosen),
		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
		'agama' => set_value('agama', $row->agama),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'alamat' => set_value('alamat', $row->alamat),
		'bidang_keahlian' => set_value('bidang_keahlian', $row->bidang_keahlian),
		'jabatan' => set_value('jabatan', $row->jabatan),
		'tlpn' => set_value('tlpn', $row->tlpn),
		'status' => set_value('status', $row->status),
	    );
            $this->load->view('dosen/table_dosen_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/dosen'));
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_dosen', TRUE));
        } else {
            $data = array(
		'nidn' => $this->input->post('nidn',TRUE),
		'nama_dosen' => $this->input->post('nama_dosen',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'agama' => $this->input->post('agama',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'bidang_keahlian' => $this->input->post('bidang_keahlian',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
		'tlpn' => $this->input->post('tlpn',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Modeldosen->update($this->input->post('id_dosen', TRUE), $data);
            $this->session->set_flashdata("message", "<div class=\"alert alert-info alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Data sudah diubah</div>");
            redirect(site_url('admin/dosen'));
        }
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $row = $this->Modeldosen->get_by_id($id);

        if ($row) {
            $this->Modeldosen->delete($id);
            $this->session->set_flashdata("message", "<div class=\"alert alert-warning alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Data sudah dihapus</div>");
            redirect(site_url('admin/dosen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/dosen'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nidn', 'nidn', 'trim|required');
	$this->form_validation->set_rules('nama_dosen', 'nama dosen', 'trim|required');
	$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('agama', 'agama', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('bidang_keahlian', 'bidang keahlian', 'trim|required');
	$this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
	$this->form_validation->set_rules('tlpn', 'tlpn', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id_dosen', 'id_dosen', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $this->load->helper('exportexcel');
        $namaFile = "table_dosen.xls";
        $judul = "table_dosen";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nidn");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Dosen");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Bidang Keahlian");
	xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Tlpn");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Modeldosen->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nidn);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_dosen);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->agama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bidang_keahlian);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tlpn);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
