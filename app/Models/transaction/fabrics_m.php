<?php

namespace App\Models\transaction;

use App\Models\core_m;

class fabrics_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";

        if ($this->request->getVar("fabrics_id")) {
            $fabricsd["fabrics_id"] = $this->request->getVar("fabrics_id");
        } else {
            $fabricsd["fabrics_id"] = -1;
        }
        $us = $this->db
            ->table("fabrics")
            ->getWhere($fabricsd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "fabrics_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $fabrics) {
                foreach ($this->db->getFieldNames('fabrics') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $fabrics->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('fabrics') as $field) {
                $data[$field] = "";
            }
        }

        //upload image
        $data['uploadfabrics_cad'] = "";
        if (isset($_FILES['fabrics_cad']) && $_FILES['fabrics_cad']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('fabrics_cad');
            $name = $file->getName(); // Mengetahui Nama File
            $originalName = $file->getClientName(); // Mengetahui Nama Asli
            $tempfile = $file->getTempName(); // Mengetahui Nama TMP File name
            $ext = $file->getClientExtension(); // Mengetahui extensi File
            $type = $file->getClientMimeType(); // Mengetahui Mime File
            $size_kb = $file->getSize('kb'); // Mengetahui Ukuran File dalam kb
            $size_mb = $file->getSize('mb'); // Mengetahui Ukuran File dalam mb


            //$namabaru = $file->getRandomName();//define nama fiel yang baru secara acak

            if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png') //cek mime file
            {    // File Tipe Sesuai   
                helper('filesystem'); // Load Helper File System
                $direktori = 'images/fabrics_cad'; //definisikan direktori upload            
                $fabrics_cad = str_replace(' ', '_', $name);
                $fabrics_cad = date("H_i_s_") . $fabrics_cad; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $fabrics_cad) {
                        delete_files($direktori, $fabrics_cad); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->identity($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $fabrics_cad)) {
                    $data['uploadfabrics_cad'] = "Upload Success !";
                    $input['fabrics_cad'] = $fabrics_cad;
                } else {
                    $data['uploadfabrics_cad'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadfabrics_cad'] = "Format File Salah !";
            }
        }
        // dd($data);

        //delete
        if ($this->request->getPost("delete") == "OK") {
            $fabrics_id =   $this->request->getPost("fabrics_id");
            $cek = $this->db->table("fabricsd")->where("fabrics_id", $fabrics_id)->get()->getNumRows();
            if ($cek > 0) {
                $data["message"] = "Hapus detail terlebih dahulu!";
            } else {
                $this->db
                    ->table("fabrics")
                    ->delete(array("fabrics_id" =>  $fabrics_id));
                $data["message"] = "Delete Success";
            }
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'fabrics_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }

            $builder = $this->db->table('fabrics');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $fabrics_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;

        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'fabrics_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $this->db->table('fabrics')->update($input, array("fabrics_id" => $this->request->getPost("fabrics_id")));
            $data["message"] = "Update Success";
            // echo $this->db->getLastQuery();die;
        }
        return $data;
    }
}
