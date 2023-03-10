<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nks_model extends CI_Model
{

    public $table = 'ssgi2022_dict';
    public $id = 'caseids';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($da,$ad) {
        $this->datatables->select("concat('KECAMATAN ',json_unquote(json_extract(uncompress(questionnaire), '$.BLOK_13.KEC_TEXT')))as kec,caseids,json_extract(uncompress(questionnaire), '$.BLOK_13.KRT_UP')as krt,JSON_LENGTH(uncompress(questionnaire), '$.BLOK_4')as jmh_art,JSON_LENGTH(uncompress(questionnaire), '$.IND')as jmh_balita,JSON_LENGTH(uncompress(questionnaire), '$.WUS')as jmh_wus,json_unquote(json_extract(uncompress(questionnaire), '$.BLOK_13.NM_ENTRY'))as nm_entry,modified_time,created_time,partial_save_mode");
        $this->datatables->from('ssgi2022_dict');
        //$this->datatables->where("json_extract(uncompress(questionnaire), '$.id.P101')=13");
        $this->datatables->add_column("status",'$1','cstatus(partial_save_mode)');
        $this->datatables->add_column("modified_time",'$1','convdatime(modified_time)');
        //$this->datatables->add_column("created_time",'$1','convdatime(created_time)');
        $this->datatables->where($da);
        $this->datatables->where($ad);
        $this->datatables->group_by("json_extract(uncompress(questionnaire), '$.id.P108')");
        //add this line for join
        //$this->datatables->join('table2', 'vis.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('korwil1/nks/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')), 'substr(caseids, 11, 5)');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id,$di,$gp)
    {   $this->db->select($id);
        $this->db->where($di);
        $this->db->group_by($gp);
        return $this->db->get($this->table)->row();
        //$this->db->group_by($this->table);
        //return $this->db->get($this->table)->row();
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