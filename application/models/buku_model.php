<?php

class buku_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    public function getData($id = null){
        $this->db->select("*");
        $this->db->from("buku");

        if ($id == null){
            $this->db->order_by('id', 'asc');
        } else {
            $this->db->where('id', $id);
        }
        return $this->db->get();
    }

    public function cari($cari)
    {
        $this->db->select("*");
        $this->db->from("buku");
        $this->db->like('nama', $cari);
        $this->db->or_like('harga', $cari);
        $this->db->or_like('stok', $cari);
        $this->db->or_like('kategori', $cari);
        return $this->db->get();

    }

    public function insert($data){
       $this->db->insert('buku', $data);
       return $this->db->affected_rows();
    }

    public function update($table, $data, $par, $var) {
        $this->db->update($table, $data, array($par => $var));
        return $this->db->affected_rows();
    }
    
    public function delete($table, $par, $var){
        $this->db->where($par, $var);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }
}