<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

       /* $ci = & get_instance();
        $session = $ci->session->userdata('level', TRUE);
        $session2 = $ci->session->userdata('status' , TRUE);
        
        if ($session =='')
         {
            redirect('login');
        }
        elseif ($session=='tidak aktif') {
            return show_error('Status user belum aktif, silahkan menghubungi admin.');
            $this->_render_page('login', $this->data);
            # code...
        }
        else if ($session=='Mahasiswa') {
            session_destroy();
            redirect('login');
        }*/
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('admin')) {//cek admin ga?
                redirect('login','refresh');
            }
        }

        $data['username'] = $this->session->userdata('username');
        $this->load->model('Modelmahasiswa');
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
            $config['base_url'] = base_url() . 'administrator/mahasiswa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'administrator/mahasiswa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'administrator/mahasiswa/index.html';
            $config['first_url'] = base_url() . 'administrator/mahasiswa/index.html';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Modelmahasiswa->total_rows($q);
        $mahasiswa = $this->Modelmahasiswa->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'mahasiswa_data' => $mahasiswa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('mahasiswa/table_mahasiswa_list', $data);
    }

    public function read($id)
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $row = $this->Modelmahasiswa->get_by_id($id);
        if ($row) {
            $data = array(
		'nim' => $row->nim,
		'nama_mahasiswa' => $row->nama_mahasiswa,
        'tempat_lahir' => $row->tempat_lahir,
		'tgl_lahir' => $row->tgl_lahir,
		'agama' => $row->agama,
		'jenis_kelamin' => $row->jenis_kelamin,
		'alamat' => $row->alamat,
		'angkatan' => $row->angkatan,
		'sekolah_asal' => $row->sekolah_asal,
		'no_hp' => $row->no_hp,
		'gol_darah' => $row->gol_darah,
		'photo' => $row->photo,
	    );
            $this->load->view('mahasiswa/table_mahasiswa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/mahasiswa'));
        }
    }

    public function dashboard()
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
       $this->load->view('dashboard');
    }

    public function create()
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/mahasiswa/create_action'),
	    'nim' => set_value('nim'),
	    'nama_mahasiswa' => set_value('nama_mahasiswa'),
        'tempat_lahir' => set_value('tempat_lahir'),
	    'tgl_lahir' => set_value('tgl_lahir'),
	    'agama' => set_value('agama'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'alamat' => set_value('alamat'),
	    'angkatan' => set_value('angkatan'),
	    'sekolah_asal' => set_value('sekolah_asal'),
	    'no_hp' => set_value('no_hp'),
	    'gol_darah' => set_value('gol_darah'),
	    'photo' => set_value('photo'),
	);
        $this->load->view('mahasiswa/table_mahasiswa_form', $data);
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
        $config['upload_path'] = './assets/images/mahasiswa/';
        $config['allowed_types'] = 'jpg|png|gif|bmp';
        $config['max_size'] = '2000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('photo');
        $this->upload->set_xss_clean(TRUE);
        $hasil = $this->upload->data();
        if ($hasil['file_name']==''){
         $data = array('nim'=>$this->db->escape_str($this->input->post('nim', TRUE)),
                    'nama_mahasiswa'=>$this->db->escape_str($this->input->post('nama_mahasiswa', TRUE)),
                    'tempat_lahir'=>$this->db->escape_str($this->input->post('tempat_lahir', TRUE)),
                    'tgl_lahir'=>$this->db->escape_str($this->input->post('tgl_lahir', TRUE)),
                    'agama'=>$this->db->escape_str($this->input->post('agama', TRUE)),
                    'jenis_kelamin'=>$this->db->escape_str($this->input->post('jenis_kelamin', TRUE)),
                    'alamat'=>$this->db->escape_str($this->input->post('alamat', TRUE)),
                    'angkatan'=>$this->db->escape_str($this->input->post('angkatan', TRUE)),
                    'sekolah_asal'=>$this->db->escape_str($this->input->post('sekolah_asal', TRUE)),
                    'no_hp'=>$this->db->escape_str($this->input->post('no_hp', TRUE)),
                    'gol_darah'=>$this->db->escape_str($this->input->post('gol_darah', TRUE)),
                    'photo'=>$hasil['file_name'],
             );
            }else{
            $data = array('nim'=>$this->db->escape_str($this->input->post('nim', TRUE)),
                    'nama_mahasiswa'=>$this->db->escape_str($this->input->post('nama_mahasiswa', TRUE)),
                    'tempat_lahir'=>$this->db->escape_str($this->input->post('tempat_lahir', TRUE)),
                    'tgl_lahir'=>$this->db->escape_str($this->input->post('tgl_lahir', TRUE)),
                    'agama'=>$this->db->escape_str($this->input->post('agama', TRUE)),
                    'jenis_kelamin'=>$this->db->escape_str($this->input->post('jenis_kelamin', TRUE)),
                    'alamat'=>$this->db->escape_str($this->input->post('alamat', TRUE)),
                    'angkatan'=>$this->db->escape_str($this->input->post('angkatan', TRUE)),
                    'sekolah_asal'=>$this->db->escape_str($this->input->post('sekolah_asal', TRUE)),
                    'no_hp'=>$this->db->escape_str($this->input->post('no_hp', TRUE)),
                    'gol_darah'=>$this->db->escape_str($this->input->post('gol_darah', TRUE)),
                    'photo'=>$hasil['file_name'],
                    );
            }

            $this->Modelmahasiswa->insert($data);
            $this->session->set_flashdata("message", "<div class=\"alert alert-success alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Berhasil tambah data</div>");
            redirect(site_url('admin/mahasiswa'));
        }

    }

    public function update($id)
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $row = $this->Modelmahasiswa->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/mahasiswa/update_action'),
		'nim' => set_value('nim', $row->nim),
		'nama_mahasiswa' => set_value('nama_mahasiswa', $row->nama_mahasiswa),
        'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
		'agama' => set_value('agama', $row->agama),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'alamat' => set_value('alamat', $row->alamat),
		'angkatan' => set_value('angkatan', $row->angkatan),
		'sekolah_asal' => set_value('sekolah_asal', $row->sekolah_asal),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'gol_darah' => set_value('gol_darah', $row->gol_darah),
		'photo' => set_value('photo', $row->photo),
	    );
            $this->load->view('mahasiswa/table_mahasiswa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/mahasiswa'));
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
            $this->update($this->input->post('id_mahasiswa', TRUE));
        } else {
        $config['upload_path'] = './assets/images/mahasiswa/';
            $config['allowed_types'] = 'jpg|png|gif|bmp';
            $config['max_size'] = '2000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('photo');
            $this->upload->set_xss_clean(TRUE);
            $hasil = $this->upload->data();
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
            $data = array('nim'=>$this->db->escape_str($this->input->post('nim', TRUE)),
                    'nama_mahasiswa'=>$this->db->escape_str($this->input->post('nama_mahasiswa', TRUE)),
                    'tempat_lahir'=>$this->db->escape_str($this->input->post('tempat_lahir', TRUE)),
                    'tgl_lahir'=>$this->db->escape_str($this->input->post('tgl_lahir', TRUE)),
                    'agama'=>$this->db->escape_str($this->input->post('agama', TRUE)),
                    'jenis_kelamin'=>$this->db->escape_str($this->input->post('jenis_kelamin', TRUE)),
                    'alamat'=>$this->db->escape_str($this->input->post('alamat', TRUE)),
                    'angkatan'=>$this->db->escape_str($this->input->post('angkatan', TRUE)),
                    'sekolah_asal'=>$this->db->escape_str($this->input->post('sekolah_asal', TRUE)),
                    'no_hp'=>$this->db->escape_str($this->input->post('no_hp', TRUE)),
                    'gol_darah'=>$this->db->escape_str($this->input->post('gol_darah', TRUE)),
                     );
            }elseif ($hasil['file_name']!='' ){
            $data = array('nim'=>$this->db->escape_str($this->input->post('nim', TRUE)),
                    'nama_mahasiswa'=>$this->db->escape_str($this->input->post('nama_mahasiswa', TRUE)),
                    'tempat_lahir'=>$this->db->escape_str($this->input->post('tempat_lahir', TRUE)),
                    'tgl_lahir'=>$this->db->escape_str($this->input->post('tgl_lahir', TRUE)),
                    'agama'=>$this->db->escape_str($this->input->post('agama', TRUE)),
                    'jenis_kelamin'=>$this->db->escape_str($this->input->post('jenis_kelamin', TRUE)),
                    'alamat'=>$this->db->escape_str($this->input->post('alamat', TRUE)),
                    'angkatan'=>$this->db->escape_str($this->input->post('angkatan', TRUE)),
                    'sekolah_asal'=>$this->db->escape_str($this->input->post('sekolah_asal', TRUE)),
                    'no_hp'=>$this->db->escape_str($this->input->post('no_hp', TRUE)),
                    'gol_darah'=>$this->db->escape_str($this->input->post('gol_darah', TRUE)),
                    'photo'=>$hasil['file_name'],
                    //unlink("./assets/images/mahasiswa/".$photo),
                        );
            }
            $this->Modelmahasiswa->update($this->input->post('nim', TRUE), $data);
            $this->session->set_flashdata("message", "<div class=\"alert alert-info alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Data sudah diubah</div>");
            redirect(site_url('admin/mahasiswa'));
        }
    }

    public function delete($id)
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $row = $this->Modelmahasiswa->get_by_id($id);

        if ($row) {
            $this->Modelmahasiswa->delete($id);
            $this->session->set_flashdata("message", "<div class=\"alert alert-warning alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Data sudah dihapus</div>");
            redirect(site_url('admin/mahasiswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/mahasiswa'));
        }
    }

   
    function backup(){
    $this->load->helper('download');
    $tanggal=date('Ymd-His');
    $namaFile=$tanggal . '.sql.zip';
    $this->load->dbutil();
    $backup=& $this->dbutil->backup();
    force_download($namaFile, $backup);
    }


    public function _rules()
    {
	$this->form_validation->set_rules('nim', 'nim', 'trim|required');
	$this->form_validation->set_rules('nama_mahasiswa', 'nama mahasiswa', 'trim|required');
    $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
	$this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
	$this->form_validation->set_rules('agama', 'agama', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('angkatan', 'angkatan', 'trim|required');
	$this->form_validation->set_rules('sekolah_asal', 'sekolah asal', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	//$this->form_validation->set_rules('gol_darah', 'gol darah', 'trim|required');
	//$this->form_validation->set_rules('photo', 'photo', 'trim|required');

	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $this->load->helper('exportexcel');
        $namaFile = "table_mahasiswa.xls";
        $judul = "table_mahasiswa";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nim");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Mahasiswa");
    xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Angkatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Sekolah Asal");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp");
	xlsWriteLabel($tablehead, $kolomhead++, "Gol Darah");
	xlsWriteLabel($tablehead, $kolomhead++, "Photo");

	foreach ($this->Modelmahasiswa->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nim);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_mahasiswa);
        xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->agama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->angkatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->sekolah_asal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->gol_darah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->photo);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
