<?php
function cmb_dinamis($name,$table,$field,$pk,$selected=null,$order=null){
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control'>";
    if($order){
        $ci->db->order_by($field,$order);
    }
    $data = $ci->db->get($table)->result();
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  strtoupper($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
}

function select2_dinamis($name,$table,$field,$placeholder){
    $ci = get_instance();
    $select2 = '<select name="'.$name.'" class="form-control select2 select2-hidden-accessible" multiple="" 
               data-placeholder="'.$placeholder.'" style="width: 100%;" tabindex="-1" aria-hidden="true">';
    $data = $ci->db->get($table)->result();
    foreach ($data as $row){
        $select2.= ' <option>'.$row->$field.'</option>';
    }
    $select2 .='</select>';
    return $select2;
}
function select2_prov($name,$table,$field0,$field1,$field2,$placeholder,$order=null,$selected=null){
    $ci = get_instance();
    $select2 = '<select name="'.$name.'" class="form-control select2 select2-hidden-accessible" 
               data-placeholder="'.$placeholder.'" style="width: 100%;" tabindex="-1" aria-hidden="true"><option></option>';
    $ci->db->order_by($field1,$order);
    $data = $ci->db->get($table)->result();
    // foreach ($data as $row){
    //     $select2.= '<option id="'.$row->$field0.'"></option>';
    //     $select2.= $selected==$row->$field0?' selected="selected"':'';
    //     $select2.='>'.$row->$field1.' || '.$row->$field2.'</option>';
    // }
    foreach ($data as $d){
        $select2 .="<option value='".$d->$field0."'";
        $select2 .= $selected==$d->$field0?" selected='selected'":'';
        $select2 .=">".$d->$field1." || ".$d->$field2."</option>";
    }
    $select2 .='</select>';
    return $select2;
}
function cmb_dinamiswhere($name,$table,$field,$pk,$selected=null,$order=null,$where,$placeholder=null){
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control select2' data-placeholder='$placeholder'><option></option>";
    if($order){
        $ci->db->order_by($field,$order);
    }
    $data = $ci->db->get_where($table,$where)->result();
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  strtoupper($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
}

function datalist_dinamis($name,$table,$field,$value=null){
    $ci = get_instance();
    $string = '<input value="'.$value.'" name="'.$name.'" list="'.$name.'" class="form-control">
    <datalist id="'.$name.'">';
    $data = $ci->db->get($table)->result();
    foreach ($data as $row){
        $string.='<option value="'.$row->$field.'">';
    }
    $string .='</datalist>';
    return $string;
}

function rename_string_is_aktif($string){
        return $string=='y'?'Aktif':'Tidak Aktif';
    }
    

function is_login(){
    $ci = get_instance();
    if(!$ci->session->userdata('id_users')){
        redirect('auth');
    }else{
        $modul = $ci->uri->segment(1);
        
        $id_user_level = $ci->session->userdata('id_user_level');
        // dapatkan id menu berdasarkan nama controller
        $menu = $ci->db->get_where('tbl_menu',array('url'=>$modul))->row_array();
        $id_menu = $menu['id_menu'];
        // chek apakah user ini boleh mengakses modul ini
        $hak_akses = $ci->db->get_where('tbl_hak_akses',array('id_menu'=>$id_menu,'id_user_level'=>$id_user_level));
        if($hak_akses->num_rows()<1){
            redirect('blokir');
            exit;
        }
    }
}

function alert($class,$title,$description){
    return '<div class="alert '.$class.' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> '.$title.'</h4>
                '.$description.'
              </div>';
}

// untuk chek akses level pada modul peberian akses
function checked_akses($id_user_level,$id_menu){
    $ci = get_instance();
    $ci->db->where('id_user_level',$id_user_level);
    $ci->db->where('id_menu',$id_menu);
    $data = $ci->db->get('tbl_hak_akses');
    if($data->num_rows()>0){
        return "checked='checked'";
    }
}
function replace_str($text){
    //$stringawal="json_extract(uncompress('.$text.'), '$.BLOK_13.PROP_TEXT')as prov";
    $string=str_replace('"', '', $text);
    return $string;
}



function autocomplate_json($table,$field){
    $ci = get_instance();
    $ci->db->like($field, $_GET['term']);
    $ci->db->select($field);
    $collections = $ci->db->get($table)->result();
    foreach ($collections as $collection) {
        $return_arr[] = $collection->$field;
    }
    echo json_encode($return_arr);
}
function korwil($bln)
	{
		switch ($bln)
		{
			case 1:
                $data=array('nm'=>'Koordinator Wilayah 1','jmh'=>'100','url'=>'korwil1');
				return $data;
				break;
			case 2:
                $data=array('nm'=>'Koordinator Wilayah 2','jmh'=>'N/A','url'=>'korwil2');
				return $data;
				break;
			case 3:
                $data=array('nm'=>'Koordinator Wilayah 3','jmh'=>'N/A','url'=>'korwil3');
				return $data;
				break;
		}
	}
    function jmhbstprovk1($data)
	{$datamasuk=substr($data,0,2);
		switch ($datamasuk)
		{
			case 13:
				return 'jumlah BS 300';
				break;
			case 32:
                return 'jumlah BS 400';
				break;
            default:
                return 'N/A';
                break;
		}
	}
    function jmhbstprovk2($data)
	{$datamasuk=substr($data,0,2);
		switch ($datamasuk)
		{
			case 13:
				return 'jumlah BS 300';
				break;
			case 32:
                return 'jumlah BS 400';
				break;
            default:
                return 'N/A';
                break;
		}
	}
    function jmhbstprovk3($data)
	{$datamasuk=substr($data,0,2);
		switch ($datamasuk)
		{
			case 13:
				return 'jumlah BS 300';
				break;
			case 32:
                return 'jumlah BS 400';
				break;
            default:
                return 'N/A';
                break;
		}
	}
    function jmhbstkabk3($data)
	{$datamasuk=substr($data,0,4);
		switch ($datamasuk)
		{
			case 3501:
				return 'jumlah BS 300';
				break;
			case 3502:
                return 'jumlah BS 400';
				break;
            default:
                return 'N/A';
                break;
		}
	}
    function jmhbstkabk2($data)
	{$datamasuk=substr($data,0,4);
		switch ($datamasuk)
		{
			case 3501:
				return 'jumlah BS 300';
				break;
			case 3502:
                return 'jumlah BS 400';
				break;
            default:
                return 'N/A';
                break;
		}
	}
    function jmhbstkabk1($data)
	{$datamasuk=substr($data,0,4);
		switch ($datamasuk)
		{
			case 3501:
				return 'jumlah BS 300';
				break;
			case 3502:
                return 'jumlah BS 400';
				break;
            default:
                return 'N/A';
                break;
		}
	}
    function convdatime($data)
	{
        $datetime = "28-1-2011 14:32:55";
        $tahun = date('d M Y', strtotime($data));
        $waktu = date('H:i:s', strtotime($data));
        $result='<i class="fa fa-fw fa-clock-o"></i>'.$waktu.'<i class="fa fa-fw fa-calendar"></i>'.$tahun;
        return $result;
	}
    function cstatus($data)
	{if($data=== NULL){
        $result='Lenkap';
    }else{
        $result='Belum Lenkap ('.$data.')';
    }
    return $result;
	}
