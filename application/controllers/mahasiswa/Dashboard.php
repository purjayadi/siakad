<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('members')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
        $this->load->model('Modelmahasiswa');
    }

    public function index()
    {
        $this->load->view('dashboard');
    }

    public function read($nim) 
    {
        $row = $this->Modelmahasiswa->id($nim);
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
            $this->load->view('profile', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mahasiswa/dashboard'));
        }
    }

    public function khs(){

        
    }

     public function update($nim) 
    {
        $row = $this->Modelmahasiswa->id($this->session->username);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mahasiswa/dashboard/update_action'),
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
            $this->load->view('profile', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mahasiswa/dashboard'));
        }
    }

     public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('nim', TRUE));
        } else {
        $config['upload_path'] = './assets/images/mahasiswa/';
            $config['allowed_types'] = 'jpg|png|gif|bmp';
            $config['max_size'] = '2000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('photo');
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
            redirect(site_url('mahasiswa/dashboard'));
        }
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

}
