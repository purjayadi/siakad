<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ukmppd extends CI_Controller
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
        $this->load->model('Table_ukmppd_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/ukmppd/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/ukmppd/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/ukmppd/index.html';
            $config['first_url'] = base_url() . 'admin/ukmppd/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Table_ukmppd_model->total_rows($q);
        $ukmppd = $this->Table_ukmppd_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'ukmppd_data' => $ukmppd,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('ukmppd/table_ukmppd_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Table_ukmppd_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idtable_ukmppd' => $row->idtable_ukmppd,
		'table_koas_nim' => $row->table_koas_nim,
		'yudisium' => $row->yudisium,
		'buku' => $row->buku,
		'administrasi' => $row->administrasi,
		'ktp' => $row->ktp,
		'akta_kelahiran' => $row->akta_kelahiran,
		'ktm' => $row->ktm,
		'ijasah_sked' => $row->ijasah_sked,
		'ijasah_sma' => $row->ijasah_sma,
		'photo' => $row->photo,
	    );
            $this->load->view('ukmppd/table_ukmppd_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/ukmppd'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/ukmppd/create_action'),
	    'idtable_ukmppd' => set_value('idtable_ukmppd'),
	    'table_koas_nim' => set_value('table_koas_nim'),
	    'yudisium' => set_value('yudisium'),
	    'buku' => set_value('buku'),
	    'administrasi' => set_value('administrasi'),
	    'ktp' => set_value('ktp'),
	    'akta_kelahiran' => set_value('akta_kelahiran'),
	    'ktm' => set_value('ktm'),
	    'ijasah_sked' => set_value('ijasah_sked'),
	    'ijasah_sma' => set_value('ijasah_sma'),
	    'photo' => set_value('photo'),
	);
        $this->load->view('ukmppd/table_ukmppd_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
          $number_of_files = sizeof($_FILES['userfiles']['tmp_name']);  
          $files = $_FILES['userfiles'];  
                $config['upload_path'] = './assets/images/mahasiswa/';
                $config['allowed_types'] = 'jpg|png|gif|bmp';
                $config['max_size'] = '2000';
                         for ($i = 0;$i < $number_of_files; $i++)  
                         {  
                                 $_FILES['userfiles']['name'] = $files['name'][$i];  
                                 $_FILES['userfiles']['type'] = $files['type'][$i];  
                                 $_FILES['userfiles']['tmp_name'] = $files['tmp_name'][$i];  
                                 $_FILES['userfiles']['error'] = $files['error'][$i];  
                                 $_FILES['userfiles']['size'] = $files['size'][$i];  
                                 $this->load->library('upload', $config);  
                                 $this->upload->do_upload('userfiles');  
                         }  
        $hasil = $this->upload->data();
        if ($hasil['file_name']==''){
         $data = array('table_koas_nim'=>$this->db->escape_str($this->input->post('table_koas_nim', TRUE)),
                    'yudisium'=>$this->db->escape_str($this->input->post('yudisium', TRUE)),
                    'buku'=>$this->db->escape_str($this->input->post('buku', TRUE)),
                    'administrasi'=>$this->db->escape_str($this->input->post('administrasi', TRUE)),
                    'ktp'=>$hasil['file_name'],
                    'akta_kelahiran'=>$hasil['file_name'],
                    'ktm'=>$hasil['file_name'],
                    'ijasah_sked'=>$hasil['file_name'],
                    'ijasah_sma'=>$hasil['file_name'],
                    'photo'=>$hasil['file_name'],
             );
            }else{
            $data = array('table_koas_nim'=>$this->db->escape_str($this->input->post('table_koas_nim', TRUE)),
                    'yudisium'=>$this->db->escape_str($this->input->post('yudisium', TRUE)),
                    'buku'=>$this->db->escape_str($this->input->post('buku', TRUE)),
                    'administrasi'=>$this->db->escape_str($this->input->post('administrasi', TRUE)),
                    'ktp'=>$hasil['file_name'],
                    'akta_kelahiran'=>$hasil['file_name'],
                    'ktm'=>$hasil['file_name'],
                    'ijasah_sked'=>$hasil['file_name'],
                    'ijasah_sma'=>$hasil['file_name'],
                    'photo'=>$hasil['file_name'],
                    );
            }

            $this->Table_ukmppd_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/ukmppd'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Table_ukmppd_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ukmppd/update_action'),
		'idtable_ukmppd' => set_value('idtable_ukmppd', $row->idtable_ukmppd),
		'table_koas_nim' => set_value('table_koas_nim', $row->table_koas_nim),
		'yudisium' => set_value('yudisium', $row->yudisium),
		'buku' => set_value('buku', $row->buku),
		'administrasi' => set_value('administrasi', $row->administrasi),
		'ktp' => set_value('ktp', $row->ktp),
		'akta_kelahiran' => set_value('akta_kelahiran', $row->akta_kelahiran),
		'ktm' => set_value('ktm', $row->ktm),
		'ijasah_sked' => set_value('ijasah_sked', $row->ijasah_sked),
		'ijasah_sma' => set_value('ijasah_sma', $row->ijasah_sma),
		'photo' => set_value('photo', $row->photo),
	    );
            $this->load->view('ukmppd/table_ukmppd_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ukmppd'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idtable_ukmppd', TRUE));
        } else {
            $data = array(
		'table_koas_nim' => $this->input->post('table_koas_nim',TRUE),
		'yudisium' => $this->input->post('yudisium',TRUE),
		'buku' => $this->input->post('buku',TRUE),
		'administrasi' => $this->input->post('administrasi',TRUE),
		'ktp' => $this->input->post('ktp',TRUE),
		'akta_kelahiran' => $this->input->post('akta_kelahiran',TRUE),
		'ktm' => $this->input->post('ktm',TRUE),
		'ijasah_sked' => $this->input->post('ijasah_sked',TRUE),
		'ijasah_sma' => $this->input->post('ijasah_sma',TRUE),
		'photo' => $this->input->post('photo',TRUE),
	    );

            $this->Table_ukmppd_model->update($this->input->post('idtable_ukmppd', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ukmppd'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Table_ukmppd_model->get_by_id($id);

        if ($row) {
            $this->Table_ukmppd_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ukmppd'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ukmppd'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('table_koas_nim', 'table koas nim', 'trim|required');
	$this->form_validation->set_rules('yudisium', 'yudisium', 'trim|required');
	$this->form_validation->set_rules('buku', 'buku', 'trim|required');
	$this->form_validation->set_rules('administrasi', 'administrasi', 'trim|required');
	//$this->form_validation->set_rules('ktp', 'ktp', 'trim|required');
	//$this->form_validation->set_rules('akta_kelahiran', 'akta kelahiran', 'trim|required');
	//$this->form_validation->set_rules('ktm', 'ktm', 'trim|required');
	//$this->form_validation->set_rules('ijasah_sked', 'ijasah sked', 'trim|required');
	//$this->form_validation->set_rules('ijasah_sma', 'ijasah sma', 'trim|required');

	$this->form_validation->set_rules('idtable_ukmppd', 'idtable_ukmppd', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "table_ukmppd.xls";
        $judul = "table_ukmppd";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Table Koas Nim");
	xlsWriteLabel($tablehead, $kolomhead++, "Yudisium");
	xlsWriteLabel($tablehead, $kolomhead++, "Buku");
	xlsWriteLabel($tablehead, $kolomhead++, "Administrasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Ktp");
	xlsWriteLabel($tablehead, $kolomhead++, "Akta Kelahiran");
	xlsWriteLabel($tablehead, $kolomhead++, "Ktm");
	xlsWriteLabel($tablehead, $kolomhead++, "Ijasah Sked");
	xlsWriteLabel($tablehead, $kolomhead++, "Ijasah Sma");
	xlsWriteLabel($tablehead, $kolomhead++, "Photo");

	foreach ($this->Table_ukmppd_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->table_koas_nim);
	    xlsWriteLabel($tablebody, $kolombody++, $data->yudisium);
	    xlsWriteLabel($tablebody, $kolombody++, $data->buku);
	    xlsWriteLabel($tablebody, $kolombody++, $data->administrasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ktp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->akta_kelahiran);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ktm);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ijasah_sked);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ijasah_sma);
	    xlsWriteLabel($tablebody, $kolombody++, $data->photo);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Ukmppd.php */
/* Location: ./application/controllers/Ukmppd.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-02-27 02:22:08 */
/* http://harviacode.com */