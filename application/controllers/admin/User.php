<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
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
        $this->load->model('Muser');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/user/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/user/index.html';
            $config['first_url'] = base_url() . 'admin/user/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Muser->total_rows($q);
        $user = $this->Muser->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_data' => $user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
       
        $this->load->view('user/table_user_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Muser->get_by_id($id);
        if ($row) {
            $data = array(
		'uid' => $row->uid,
		'username' => $row->username,
		'password' => $row->password,
		'nama_lengkap' => $row->nama_lengkap,
		'level' => $row->level,
		'status' => $row->status,
		'photo' => $row->photo,
	    );
            $this->load->view('user/table_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/user'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/user/create_action'),
	    'uid' => set_value('uid'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'nama_lengkap' => set_value('nama_lengkap'),
	    'level' => set_value('level'),
	    'status' => set_value('status'),
	    'photo' => set_value('photo'),
	);
        $this->load->view('user/table_user_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $config['upload_path'] = './assets/images/users/';
            $config['allowed_types'] = 'jpg|png|gif|bmp';
            $config['max_size'] = '2000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('photo');
            $hasil = $this->upload->data();
        if ($hasil['file_name']==''){
         $data = array('username'=>$this->db->escape_str($this->input->post('username', TRUE)),
                    'password'=>hash("sha512", md5($this->input->post('password', TRUE))),
                    'nama_lengkap'=>$this->db->escape_str($this->input->post('nama_lengkap', TRUE)),
                    'level'=>$this->db->escape_str($this->input->post('level', TRUE)),
                    'status'=>$this->db->escape_str($this->input->post('status', TRUE)),
                    'photo'=>$hasil['file_name'],
             );
            }else{
            $data = array('username'=>$this->db->escape_str($this->input->post('username', TRUE)),
                    'password'=>hash("sha512", md5($this->input->post('username'. TRUE))),
                    'nama_lengkap'=>$this->db->escape_str($this->input->post('nama_lengkap', TRUE)),
                    'level'=>$this->db->escape_str($this->input->post('level', TRUE)),
                    'status'=>$this->db->escape_str($this->input->post('status', TRUE)),
                    'photo'=>$hasil['file_name'],
                    );
            }
            $this->Muser->insert($data);
           $this->session->set_flashdata("message", "<div class=\"alert alert-success alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Berhasil tambah data</div>");
            redirect(site_url('admin/user'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Muser->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/user/update_action'),
		'uid' => set_value('uid', $row->uid),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
		'level' => set_value('level', $row->level),
		'status' => set_value('status', $row->status),
		'photo' => set_value('photo', $row->photo),
	    );
            $this->load->view('user/table_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('uid', TRUE));
        } else {
         $config['upload_path'] = './assets/images/users/';
            $config['allowed_types'] = 'jpg|png|gif|bmp';
            $config['max_size'] = '2000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('photo',TRUE);
            $hasil = $this->upload->data();
            $hasil=$this->upload->data();
            $idgbr     = $this->input->post('uid', TRUE); /* variabel id gambar */
            $filelama  = $this->input->post('filelama', TRUE); /* variabel fil */
            if ($hasil['file_name']=='' AND $this->input->post('password', TRUE) ==''){
            $data = array('username'=>$this->db->escape_str($this->input->post('username', TRUE)),
                        'nama_lengkap'=>$this->db->escape_str($this->input->post('nama_lengkap', TRUE)),
                        'level'=>$this->db->escape_str($this->input->post('level', TRUE)),
                        'status'=>$this->db->escape_str($this->input->post('status', TRUE)),
                                    );
            }elseif ($hasil['file_name']!='' AND $this->input->post('password', TRUE) ==''){
            $data = array('username'=>$this->db->escape_str($this->input->post('username', TRUE)),
                        'nama_lengkap'=>$this->db->escape_str($this->input->post('nama_lengkap', TRUE)),
                        'status'=>$this->db->escape_str($this->input->post('status', TRUE)),
                        'level'=>$this->db->escape_str($this->input->post('level', TRUE)),
                        'photo'=>$hasil['file_name'],
                        );
                            @unlink($path.$filelama);//menghapus gambar lama, variabel dibawa dari form
 
                           $where =array('uid'=>$idgbr); //array where query sebagai identitas pada saat query dijalankan
                           $this->Muser->get_update($data,$where);
            }elseif ($hasil['file_name']=='' AND $this->input->post('password', TRUE) !=''){
            $data = array('username'=>$this->db->escape_str($this->input->post('username', TRUE)),
                        'password'=>hash("sha512", md5($this->input->post('password', TRUE))),
                        'nama_lengkap'=>$this->db->escape_str($this->input->post('nama_lengkap', TRUE)),
                        'level'=>$this->db->escape_str($this->input->post('level', TRUE)),
                        'status'=>$this->db->escape_str($this->input->post('status', TRUE)),
                        );
            }elseif ($hasil['file_name']!='' AND $this->input->post('password', TRUE) !=''){
            $data = array('username'=>$this->db->escape_str($this->input->post('username', TRUE)),
                        'password'=>hash("sha512", md5($this->input->post('password', TRUE))),
                        'nama_lengkap'=>$this->db->escape_str($this->input->post('nama_lengkap', TRUE)),
                        'level'=>$this->db->escape_str($this->input->post('level', TRUE)),
                        'status'=>$this->db->escape_str($this->input->post('status', TRUE)),
                        'photo'=>$hasil['file_name'],
                      
                        );
                        $hapus = $this->Muser->get_detail($id);
                       $namafile = $hapus->photo;
                       unlink('./assets/images/users/'.$namafile);
            }

            $this->Muser->update($this->input->post('uid', TRUE), $data);
            $this->session->set_flashdata("message", "<div class=\"alert alert-info alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Data sudah diubah</div>");
            redirect(site_url('admin/user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->ion_auth_model->delete_user($id);

            $this->session->set_flashdata("message", "<div class=\"alert alert-warning alert-styled-left alert-arrow-left alert-component\" id=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button>Data sudah dihapus</div>");
            redirect(site_url('admin/user'));
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
	$this->form_validation->set_rules('level', 'level', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('uid', 'uid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}