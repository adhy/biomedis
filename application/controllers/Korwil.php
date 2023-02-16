<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Korwil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
       $this->load->model('Korwil_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
	$this->load->library('template');
    }

    public function index()
    {   
        $this->template->tempub('korwil');

    } 
    public function showkor(){
        $nmkab="count(json_extract(uncompress(questionnaire), '$.id.P108'))as ruta";
        $where="json_extract(uncompress(questionnaire), '$.BLOK_13.NM_KORWIL')=3";
        $group="json_extract(uncompress(questionnaire), '$.BLOK_13.NM_KORWIL')";
        $jmhkor1=$this->Korwil_model->get_by_id($nmkab,$where,$group);
        //var_dump($jmhkor1);
        $data=array('k1'=> $jmhkor1->ruta,'k2'=>'','k3'=>'');
        echo json_encode($data);
    }
}
?>