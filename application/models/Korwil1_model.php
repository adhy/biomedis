<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Korwil1_model extends CI_Model
{

    public $table = 'ssgi2022_dict';
    public $id = 'caseids';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($data) {
        //$this->datatables->select("caseids,json_extract(uncompress(questionnaire), '$.id.P101')as kode_p,json_extract(uncompress(questionnaire), '$.BLOK_13.PROP_TEXT')as prov,count(json_extract(uncompress(questionnaire), '$.id.P101'))as jmh_ruta,modified_time,created_time");
        $this->datatables->select("caseids,json_extract(uncompress(questionnaire), '$.id.P101')as kode_p,json_extract(uncompress(questionnaire), '$.BLOK_13.PROP_TEXT')as prov,count(json_extract(uncompress(questionnaire), '$.id.P101'))as jmh_ruta");
        $this->datatables->from('ssgi2022_dict');
        //$this->datatables->where("json_extract(uncompress(questionnaire), '$.id.P101')=13");
        $this->datatables->add_column("jmhbsbps",'$1','jmhbs(caseids)');
        //$this->datatables->add_column("modified_time",'$1','convdatime(modified_time)');
        //$this->datatables->add_column("created_time",'$1','convdatime(created_time)');
        $this->datatables->where_in("json_extract(uncompress(`questionnaire`), '$.BLOK_13.NM_KORWIL')",$data);
        $this->datatables->group_by("json_extract(uncompress(questionnaire), '$.id.P101')");
        //add this line for join
        //$this->datatables->join('table2', 'vis.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('korwil1/provinsi/$1'),'Lihat Daftar Kab/Kota', array('class' => 'btn btn-default btn-sm')), 'substr(caseids,0,2)');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('caseids', $q);
	$this->db->or_like("json_extract(uncompress(questionnaire), '$.id.P101')as kode_p", $q);
	$this->db->or_like("json_extract(uncompress(questionnaire), '$.BLOK_13.PROP_TEXT')as prov", $q);
	$this->db->or_like('modified_time', $q);
	$this->db->or_like('created_time', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('caseids', $q);
	$this->db->or_like("json_extract(uncompress(questionnaire), '$.id.P101')as kode_p", $q);
	$this->db->or_like("json_extract(uncompress(questionnaire), '$.BLOK_13.PROP_TEXT')as prov", $q);
	$this->db->or_like('modified_time', $q);
	$this->db->or_like('created_time', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // // insert data
    // function insert($data)
    // {
    //     $this->db->insert($this->table, $data);
    // }

    // // update data
    // function update($id, $data)
    // {
    //     $this->db->where($this->id, $id);
    //     $this->db->update($this->table, $data);
    // }

    // // delete data
    // function delete($id)
    // {
    //     $this->db->where($this->id, $id);
    //     $this->db->delete($this->table);
    // }

}

/* End of file Monitoring_model.php */
/* Location: ./application/models/Monitoring_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-10 10:37:36 */
/* http://harviacode.com */