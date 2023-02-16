<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vis extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Vis_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/vis/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/vis/index/';
            $config['first_url'] = base_url() . 'index.php/vis/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Vis_model->total_rows($q);
        $vis = $this->Vis_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'vis_data' => $vis,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','vis/vis_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Vis_model->get_by_id($id);
        if ($row) {
            $data = array(
		'questionnaire' => $row->questionnaire,
		'modified_time' => $row->modified_time,
		'created_time' => $row->created_time,
	    );
            $this->template->load('template','vis/vis_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('vis'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('vis/create_action'),
	    'questionnaire' => set_value('questionnaire'),
	    'modified_time' => set_value('modified_time'),
	    'created_time' => set_value('created_time'),
	);
        $this->template->load('template','vis/vis_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'questionnaire' => $this->input->post('questionnaire',TRUE),
		'modified_time' => $this->input->post('modified_time',TRUE),
		'created_time' => $this->input->post('created_time',TRUE),
	    );

            $this->Vis_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('vis'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Vis_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('vis/update_action'),
		'questionnaire' => set_value('questionnaire', $row->questionnaire),
		'modified_time' => set_value('modified_time', $row->modified_time),
		'created_time' => set_value('created_time', $row->created_time),
	    );
            $this->template->load('template','vis/vis_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('vis'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'questionnaire' => $this->input->post('questionnaire',TRUE),
		'modified_time' => $this->input->post('modified_time',TRUE),
		'created_time' => $this->input->post('created_time',TRUE),
	    );

            $this->Vis_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('vis'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Vis_model->get_by_id($id);

        if ($row) {
            $this->Vis_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('vis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('vis'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('questionnaire', 'questionnaire', 'trim|required');
	$this->form_validation->set_rules('modified_time', 'modified time', 'trim|required');
	$this->form_validation->set_rules('created_time', 'created time', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Vis.php */
/* Location: ./application/controllers/Vis.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-12 17:38:46 */
/* http://harviacode.com */