<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stase_besar extends CI_Controller
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
        $this->load->model('Table_nilai_stase_besar_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/stase_besar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/stase_besar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/stase_besar/index.html';
            $config['first_url'] = base_url() . 'admin/stase_besar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Table_nilai_stase_besar_model->total_rows($q);
        $stase_besar = $this->Table_nilai_stase_besar_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'stase_besar_data' => $stase_besar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('stase_besar/table_nilai_stase_besar_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Table_nilai_stase_besar_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idtable_nilai_stase' => $row->idtable_nilai_stase,
		'table_stase_idtable_stase' => $row->table_stase_idtable_stase,
		'table_koas_nim' => $row->table_koas_nim,
		'table_stase_idtable_stase' => $row->table_stase_idtable_stase,
		'mini_cex' => $row->mini_cex,
		'mini_cex2' => $row->mini_cex2,
		'cbd' => $row->cbd,
		'cbd2' => $row->cbd2,
		'dops' => $row->dops,
		'dops2' => $row->dops2,
		'pylhn' => $row->pylhn,
		'pylhn2' => $row->pylhn2,
		'j_reading' => $row->j.reading,
		'j_reading2' => $row->j.reading2,
		'nform' => $row->nform,
		'ujian_lisan' => $row->ujian_lisan,
		'n_lisan' => $row->n_lisan,
		'ujian_tulis' => $row->ujian_tulis,
		'n_tulis' => $row->n_tulis,
		'kondite' => $row->kondite,
		'nilai_angka' => $row->nilai_angka,
		'nilai_huruf' => $row->nilai_huruf,
	    );
            $this->load->view('stase_besar/table_nilai_stase_besar_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stase_besar'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('stase_besar/create_action'),
	    'idtable_nilai_stase' => set_value('idtable_nilai_stase'),
	    'table_stase_idtable_stase' => set_value('table_stase_idtable_stase'),
	    'table_koas_nim' => set_value('table_koas_nim'),
	    'mini_cex' => set_value('mini_cex'),
	    'mini_cex2' => set_value('mini_cex2'),
	    'cbd' => set_value('cbd'),
	    'cbd2' => set_value('cbd2'),
	    'dops' => set_value('dops'),
	    'dops2' => set_value('dops2'),
	    'pylhn' => set_value('pylhn'),
	    'pylhn2' => set_value('pylhn2'),
	    'j_reading' => set_value('j_reading'),
	    'j_reading2' => set_value('j_reading2'),
	    'nform' => set_value('nform'),
	    'ujian_lisan' => set_value('ujian_lisan'),
	    'n_lisan' => set_value('n_lisan'),
	    'ujian_tulis' => set_value('ujian_tulis'),
	    'n_tulis' => set_value('n_tulis'),
	    'kondite' => set_value('kondite'),
	    'nilai_angka' => set_value('nilai_angka'),
	    'nilai_huruf' => set_value('nilai_huruf'),
	);
        $this->load->view('stase_besar/table_nilai_stase_besar_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'table_stase_idtable_stase' => $this->input->post('table_stase_idtable_stase',TRUE),
		'table_koas_nim' => $this->input->post('table_koas_nim',TRUE),
		'mini_cex' => $this->input->post('mini_cex',TRUE),
		'mini_cex2' => $this->input->post('mini_cex2',TRUE),
		'cbd' => $this->input->post('cbd',TRUE),
		'cbd2' => $this->input->post('cbd2',TRUE),
		'dops' => $this->input->post('dops',TRUE),
		'dops2' => $this->input->post('dops2',TRUE),
		'pylhn' => $this->input->post('pylhn',TRUE),
		'pylhn2' => $this->input->post('pylhn2',TRUE),
		'j_reading' => $this->input->post('j_reading',TRUE),
		'j_reading2' => $this->input->post('j_reading2',TRUE),
		'nform' => $this->input->post('nform',TRUE),
		'ujian_lisan' => $this->input->post('ujian_lisan',TRUE),
		'n_lisan' => $this->input->post('n_lisan',TRUE),
		'ujian_tulis' => $this->input->post('ujian_tulis',TRUE),
		'n_tulis' => $this->input->post('n_tulis',TRUE),
		'kondite' => $this->input->post('kondite',TRUE),
		'nilai_angka' => $this->input->post('nilai_angka',TRUE),
		'nilai_huruf' => $this->input->post('nilai_huruf',TRUE),
	    );

            $this->Table_nilai_stase_besar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('stase_besar'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Table_nilai_stase_besar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('stase_besar/update_action'),
		'idtable_nilai_stase' => set_value('idtable_nilai_stase', $row->idtable_nilai_stase),
		'table_stase_idtable_stase' => set_value('table_stase_idtable_stase', $row->table_stase_idtable_stase),
		'table_koas_nim' => set_value('table_koas_nim', $row->table_koas_nim),
		'mini_cex' => set_value('mini_cex', $row->mini_cex),
		'mini_cex2' => set_value('mini_cex2', $row->mini_cex2),
		'cbd' => set_value('cbd', $row->cbd),
		'cbd2' => set_value('cbd2', $row->cbd2),
		'dops' => set_value('dops', $row->dops),
		'dops2' => set_value('dops2', $row->dops2),
		'pylhn' => set_value('pylhn', $row->pylhn),
		'pylhn2' => set_value('pylhn2', $row->pylhn2),
		'j_reading' => set_value('j_reading', $row->j.reading),
		'j_reading2' => set_value('j_reading2', $row->j.reading2),
		'nform' => set_value('nform', $row->nform),
		'ujian_lisan' => set_value('ujian_lisan', $row->ujian_lisan),
		'n_lisan' => set_value('n_lisan', $row->n_lisan),
		'ujian_tulis' => set_value('ujian_tulis', $row->ujian_tulis),
		'n_tulis' => set_value('n_tulis', $row->n_tulis),
		'kondite' => set_value('kondite', $row->kondite),
		'nilai_angka' => set_value('nilai_angka', $row->nilai_angka),
		'nilai_huruf' => set_value('nilai_huruf', $row->nilai_huruf),
	    );
            $this->load->view('stase_besar/table_nilai_stase_besar_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stase_besar'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idtable_nilai_stase', TRUE));
        } else {
            $data = array(
		'table_stase_idtable_stase' => $this->input->post('table_stase_idtable_stase',TRUE),
		'table_koas_nim' => $this->input->post('table_koas_nim',TRUE),
		'mini_cex' => $this->input->post('mini_cex',TRUE),
		'mini_cex2' => $this->input->post('mini_cex2',TRUE),
		'cbd' => $this->input->post('cbd',TRUE),
		'cbd2' => $this->input->post('cbd2',TRUE),
		'dops' => $this->input->post('dops',TRUE),
		'dops2' => $this->input->post('dops2',TRUE),
		'pylhn' => $this->input->post('pylhn',TRUE),
		'pylhn2' => $this->input->post('pylhn2',TRUE),
		'j_reading' => $this->input->post('j_reading',TRUE),
		'j_reading2' => $this->input->post('j_reading2',TRUE),
		'nform' => $this->input->post('nform',TRUE),
		'ujian_lisan' => $this->input->post('ujian_lisan',TRUE),
		'n_lisan' => $this->input->post('n_lisan',TRUE),
		'ujian_tulis' => $this->input->post('ujian_tulis',TRUE),
		'n_tulis' => $this->input->post('n_tulis',TRUE),
		'kondite' => $this->input->post('kondite',TRUE),
		'nilai_angka' => $this->input->post('nilai_angka',TRUE),
		'nilai_huruf' => $this->input->post('nilai_huruf',TRUE),
	    );

            $this->Table_nilai_stase_besar_model->update($this->input->post('idtable_nilai_stase', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('stase_besar'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Table_nilai_stase_besar_model->get_by_id($id);

        if ($row) {
            $this->Table_nilai_stase_besar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('stase_besar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stase_besar'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('table_stase_idtable_stase', 'table stase idtable stase', 'trim|required');
	$this->form_validation->set_rules('table_koas_nim', 'table stase idtable stase', 'trim|required');
	$this->form_validation->set_rules('mini_cex', 'mini cex', 'trim|required');
	$this->form_validation->set_rules('mini_cex2', 'mini cex2', 'trim|required');
	$this->form_validation->set_rules('cbd', 'cbd', 'trim|required');
	$this->form_validation->set_rules('cbd2', 'cbd2', 'trim|required');
	$this->form_validation->set_rules('dops', 'dops', 'trim|required');
	$this->form_validation->set_rules('dops2', 'dops2', 'trim|required');
	$this->form_validation->set_rules('pylhn', 'pylhn', 'trim|required');
	$this->form_validation->set_rules('pylhn2', 'pylhn2', 'trim|required');
	$this->form_validation->set_rules('j_reading', 'j_reading', 'trim|required');
	$this->form_validation->set_rules('j_reading2', 'j_reading2', 'trim|required');
	$this->form_validation->set_rules('nform', 'nform', 'trim|required');
	$this->form_validation->set_rules('ujian_lisan', 'ujian lisan', 'trim|required');
	$this->form_validation->set_rules('n_lisan', 'n lisan', 'trim|required');
	$this->form_validation->set_rules('ujian_tulis', 'ujian tulis', 'trim|required');
	$this->form_validation->set_rules('n_tulis', 'n tulis', 'trim|required');
	$this->form_validation->set_rules('kondite', 'kondite', 'trim|required');
	$this->form_validation->set_rules('nilai_angka', 'nilai angka', 'trim|required');
	$this->form_validation->set_rules('nilai_huruf', 'nilai huruf', 'trim|required');

	$this->form_validation->set_rules('idtable_nilai_stase', 'idtable_nilai_stase', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "table_nilai_stase_besar.xls";
        $judul = "table_nilai_stase_besar";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Table Stase Idtable Stase");
	xlsWriteLabel($tablehead, $kolomhead++, "Nim");
	xlsWriteLabel($tablehead, $kolomhead++, "Mini Cex");
	xlsWriteLabel($tablehead, $kolomhead++, "Mini Cex2");
	xlsWriteLabel($tablehead, $kolomhead++, "Cbd");
	xlsWriteLabel($tablehead, $kolomhead++, "Cbd2");
	xlsWriteLabel($tablehead, $kolomhead++, "Dops");
	xlsWriteLabel($tablehead, $kolomhead++, "Dops2");
	xlsWriteLabel($tablehead, $kolomhead++, "Pylhn");
	xlsWriteLabel($tablehead, $kolomhead++, "Pylhn2");
	xlsWriteLabel($tablehead, $kolomhead++, "J.reading");
	xlsWriteLabel($tablehead, $kolomhead++, "J.reading2");
	xlsWriteLabel($tablehead, $kolomhead++, "Nform");
	xlsWriteLabel($tablehead, $kolomhead++, "Ujian Lisan");
	xlsWriteLabel($tablehead, $kolomhead++, "N Lisan");
	xlsWriteLabel($tablehead, $kolomhead++, "Ujian Tulis");
	xlsWriteLabel($tablehead, $kolomhead++, "N Tulis");
	xlsWriteLabel($tablehead, $kolomhead++, "Kondite");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Angka");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Huruf");

	foreach ($this->Table_nilai_stase_besar_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->table_stase_idtable_stase);
	    xlsWriteNumber($tablebody, $kolombody++, $data->table_koas_nim);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mini_cex);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mini_cex2);
	    xlsWriteLabel($tablebody, $kolombody++, $data->cbd);
	    xlsWriteLabel($tablebody, $kolombody++, $data->cbd2);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dops);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dops2);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pylhn);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pylhn2);
	    xlsWriteLabel($tablebody, $kolombody++, $data->j_reading);
	    xlsWriteLabel($tablebody, $kolombody++, $data->j_reading2);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nform);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ujian_lisan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->n_lisan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ujian_tulis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->n_tulis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kondite);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai_angka);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai_huruf);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Stase_besar.php */
/* Location: ./application/controllers/Stase_besar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-02-27 23:34:56 */
/* http://harviacode.com */