<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Korwil1 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Korwil1_model');
        $this->load->model('Provinsi_model');
        $this->load->model('Kab_model');
        $this->load->model('Nks_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {   $urlv1=$this->uri->segment(1);
        $this->session->set_userdata('urlv1', $urlv1);
        $this->template->tempub('monitoring/korwil1_list');
    } 
    
    public function json() {
        $array = '3';
        header('Content-Type: application/json');
        echo $this->Korwil1_model->json($array);
    }
    public function provinsi()
    {   $idprov=$this->uri->segment(3);
        $urlv2='provinsi/'.$this->uri->segment(3);
        $this->session->set_userdata('urlv2', $urlv2);
        $nmprov="json_extract(uncompress(questionnaire), '$.BLOK_13.PROP_TEXT')as prov";
        $where="json_extract(uncompress(questionnaire), '$.id.P101')=".$idprov."";
        $group="json_extract(uncompress(questionnaire), '$.BLOK_13.PROP_TEXT')";
        $nmprovrow=$this->Provinsi_model->get_by_id($nmprov,$where,$group);
        $this->session->set_userdata('nmprov', str_replace('"','',$nmprovrow->prov));
        $this->session->set_userdata('publicprov', $idprov);
        $this->template->tempub('monitoring/provinsi_list');
    } 
    public function jsonprov() {
        $idprov=$this->session->userdata('publicprov');
        $contoh='ini jsonprov';
        header('Content-Type: application/json');
        echo $this->Provinsi_model->json($idprov);
    }
    public function kab_kota()
    {   $idkab=$this->uri->segment(3);
        $urlv3='kab_kota/'.$this->uri->segment(3);
        $this->session->set_userdata('urlv3', $urlv3);
        $kabid = substr($idkab, 2, 4);
        $nmkab="json_extract(uncompress(questionnaire), '$.BLOK_13.KAB_TEXT')as kab";
        $where="json_extract(uncompress(questionnaire), '$.BLOK_13.KAB')=".$idkab."";
        $group="json_extract(uncompress(questionnaire), '$.BLOK_13.KAB_TEXT')";
        $nmkabrow=$this->Kab_model->get_by_id($nmkab,$where,$group);
        $this->session->set_userdata('nmkab', str_replace('"','',$nmkabrow->kab));
        $this->session->set_userdata('publickab', $idkab);
        $this->template->tempub('monitoring/kab_list');
    } 
    public function jsonkab() {
        $idkab=$this->session->userdata('publickab');
        $contoh='ini jsonprov';
        header('Content-Type: application/json');
        echo $this->Kab_model->json($idkab);
    }
    public function nksview()
    {   $idkode_nks=$this->uri->segment(3);
       //$kabid = substr($idkab, 2, 4);
        $nmnks="json_extract(uncompress(questionnaire), '$.id.P107')as kode_nks";
        $wherea="json_extract(uncompress(questionnaire), '$.id.P107')='".$idkode_nks."'";
        $group="json_extract(uncompress(questionnaire), '$.id.P107')";
        $nmnksrow=$this->Nks_model->get_by_id($nmnks,$wherea,$group);
        $this->session->set_userdata('nmnks', str_replace('"','',$nmnksrow->kode_nks));
        $this->session->set_userdata('publicnks', $idkode_nks);
        $this->template->tempub('monitoring/nks_list');
    } 
    public function jsonnks() {
        $idkode_nks=$this->session->userdata('publicnks');
        $idkode_kab=$this->session->userdata('publickab');
        $kab="json_extract(uncompress(questionnaire), '$.BLOK_13.KAB')='".$idkode_kab."'";
        $nks="json_extract(uncompress(questionnaire), '$.id.P107')='".$idkode_nks."'";
        header('Content-Type: application/json');
        echo $this->Nks_model->json($kab,$nks);
    }


}

/* End of file Monitoring.php */
/* Location: ./application/controllers/Monitoring.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-10 10:37:36 */
/* http://harviacode.com */