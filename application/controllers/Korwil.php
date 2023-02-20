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
        $where2="json_extract(uncompress(questionnaire), '$.BLOK_13.NM_KORWIL')=3";
        $where3="json_extract(uncompress(questionnaire), '$.BLOK_13.NM_KORWIL')=3";
        $group="json_extract(uncompress(questionnaire), '$.BLOK_13.NM_KORWIL')";
        $jmhkor1=$this->Korwil_model->get_by_id($nmkab,$where,$group);
        $jmhkor2=$this->Korwil_model->get_by_id2($nmkab,$where2,$group);
        $jmhkor3=$this->Korwil_model->get_by_id3($nmkab,$where3,$group);
        //var_dump($jmhkor3);
        $data1='';
        if( $jmhkor1==null){$data1=0;}else{$data1=$jmhkor1->ruta;}
        $data2='';
        if( $jmhkor2==null){$data2=0;}else{$data2=$jmhkor2->ruta;}
        $data3='';
        if( $jmhkor3==null){$data3=0;}else{$data3=$jmhkor3->ruta;}
        //var_dump($jmhkor1);
        $data=array('k1'=> $data1,'k2'=>$data2,'k3'=>$data3);
        echo json_encode($data);
    }
}
?>