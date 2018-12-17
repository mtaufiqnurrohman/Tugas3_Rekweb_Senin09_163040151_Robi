<?php

require APPPATH . '/libraries/REST_Controller.php';

class buku extends REST_Controller
{

    public function __construct($config = "rest")
    {
        parent::__construct($config);
        $this->load->model("buku_model", "buku");
    }

    public function index_get()
    {
        $id = $this->get('id');
        $cari = $this->get('cari');

        if ($cari != ""){
            $buku = $this->buku->cari($cari)->result();
        } else if ($id == ''){
            $buku = $this->buku->getData(null)->result();
        } else {
            $buku = $this->buku->getData($id)->result();
        }
        $this->response($buku);
    }

    public function index_put()
    {
        $kategori = $this->put('kategori');
        $stok = $this->put('stok');
        $harga = $this->put('harga');
        $buku = $this->put('buku');
        $id = $this->put('id');
        $data = array(
            'buku' => $buku,
            'harga' => $harga,
            'stok' => $stok,
            'kategori' => $kategori,
            );
        $update = $this->buku->update('buku', $data, 'id', $this->put('id'));

        if ($update){
            $this->response(array('status' => 'success', 200));
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }

    public function index_post()
    {
        $kategori = $this->put('kategori');
        $stok = $this->put('stok');
        $harga = $this->put('harga');
        $buku = $this->put('buku');

        $data = array (
            'buku' => $buku,
            'harga' => $harga,
            'stok' => $stok,
            'kategori' => $kategori,
        );

        $insert = $this->buku->insert($data);

        if($insert){
            $this->response(array('status' => 'success', 200));
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    public function index_delete()
    {
       $id = $this->delete('id');
       // this->db->where('id', $id);
       $delete = $this->buku->delete('buku', 'id', $id);

       if($delete){
            $this->response(array('status' => 'success', 201));
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}