<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Provinsi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Provinsi_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {   $idprov=$this->uri->segment(2);
        $this->session->set_userdata('publicprov', $idprov);
        //$this->load->view('auth/login');
        $this->template->tempub('monitoring/provinsi_list');
        //$this->template->load('template','monitoring/vis_list');
    } 
    
    public function json() {
        //$data=array();
       // $array = array("json_extract(uncompress(questionnaire), '$.id.P101')=" =>'13', "json_extract(uncompress(questionnaire), '$.id.P101')=" =>'32',);
        $array = array('13','32',);
        //$array = array('caseids' => '13', 'caseids' => '32');
        header('Content-Type: application/json');
       // echo $this->Korwil1_model->json($array);
        echo $this->Provinsi_model->json($array);
    }

    // public function read($id) 
    // {
    //     $row = $this->Korwil_model->get_by_id($id);
    //     if ($row) {
    //         $data = array(
	// 	'questionnaire' => $row->questionnaire,
	// 	'modified_time' => $row->modified_time,
	// 	'created_time' => $row->created_time,
	//     );
    //         $this->template->load('template','monitoring/vis_read', $data);
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //         redirect(site_url('monitoring'));
    //     }
    // }

    // public function create() 
    // {
    //     $data = array(
    //         'button' => 'Create',
    //         'action' => site_url('monitoring/create_action'),
	//     'questionnaire' => set_value('questionnaire'),
	//     'modified_time' => set_value('modified_time'),
	//     'created_time' => set_value('created_time'),
	// );
    //     $this->template->load('template','monitoring/vis_form', $data);
    // }
    
    // public function create_action() 
    // {
    //     $this->_rules();

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->create();
    //     } else {
    //         $data = array(
	// 	'questionnaire' => $this->input->post('questionnaire',TRUE),
	// 	'modified_time' => $this->input->post('modified_time',TRUE),
	// 	'created_time' => $this->input->post('created_time',TRUE),
	//     );

    //         $this->Monitoring_model->insert($data);
    //         $this->session->set_flashdata('message', 'Create Record Success 2');
    //         redirect(site_url('monitoring'));
    //     }
    // }
    
    // public function update($id) 
    // {
    //     $row = $this->Monitoring_model->get_by_id($id);

    //     if ($row) {
    //         $data = array(
    //             'button' => 'Update',
    //             'action' => site_url('monitoring/update_action'),
	// 	'questionnaire' => set_value('questionnaire', $row->questionnaire),
	// 	'modified_time' => set_value('modified_time', $row->modified_time),
	// 	'created_time' => set_value('created_time', $row->created_time),
	//     );
    //         $this->template->load('template','monitoring/vis_form', $data);
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //         redirect(site_url('monitoring'));
    //     }
    // }
    
    // public function update_action() 
    // {
    //     $this->_rules();

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->update($this->input->post('', TRUE));
    //     } else {
    //         $data = array(
	// 	'questionnaire' => $this->input->post('questionnaire',TRUE),
	// 	'modified_time' => $this->input->post('modified_time',TRUE),
	// 	'created_time' => $this->input->post('created_time',TRUE),
	//     );

    //         $this->Monitoring_model->update($this->input->post('', TRUE), $data);
    //         $this->session->set_flashdata('message', 'Update Record Success');
    //         redirect(site_url('monitoring'));
    //     }
    // }
    
    // public function delete($id) 
    // {
    //     $row = $this->Monitoring_model->get_by_id($id);

    //     if ($row) {
    //         $this->Monitoring_model->delete($id);
    //         $this->session->set_flashdata('message', 'Delete Record Success');
    //         redirect(site_url('monitoring'));
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //         redirect(site_url('monitoring'));
    //     }
    // }

    // public function _rules() 
    // {
	// $this->form_validation->set_rules('questionnaire', 'questionnaire', 'trim|required');
	// $this->form_validation->set_rules('modified_time', 'modified time', 'trim|required');
	// $this->form_validation->set_rules('created_time', 'created time', 'trim|required');

	// $this->form_validation->set_rules('', '', 'trim');
	// $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    // }

}

/* End of file Monitoring.php */
/* Location: ./application/controllers/Monitoring.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-10 10:37:36 */
/* http://harviacode.com */