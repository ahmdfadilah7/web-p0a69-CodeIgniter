<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {


    #################################
    ####### LOGIN DATA WEB ##########

    public function cek_login($data,$where){
		return $this->db->get_where($data,$where);
    }
    
	public function insertLog($tabel,$data){
		return $this->db->insert($tabel,$data);
	}


    ######################################
    ####### All Function Master ##########

    public function insert($set,$tabel){
        $this->db->set($set);
        return $this->db->insert($tabel);
    }

    public function selectDataWhere($select,$tabel,$whereAsc = '',$id = '', $urutan = '', $order = 'DESC'){
        $this->db->select($select);
        if($whereAsc <> '')
            $this->db->where($whereAsc,$id);
        $this->db->order_by('id', $order);
        return $this->db->get($tabel);
    }

    public function updateData($set,$tabel,$where,$id){
        $this->db->where($where,$id);
        return $this->db->update($tabel,$set);
    }
    
    public function delete($tabel,$where){
        return $this->db->delete($tabel,$where);
    }
}