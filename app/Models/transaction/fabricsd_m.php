<?php

namespace App\Models\transaction;

use App\Models\core_m;

class fabricsd_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";

        if ($this->request->getVar("fabricsd_id")) {
            $fabricsdd["fabricsd_id"] = $this->request->getVar("fabricsd_id");
        } else {
            $fabricsdd["fabricsd_id"] = -1;
        }
        $us = $this->db
            ->table("fabricsd")
            ->getWhere($fabricsdd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "fabricsd_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $fabricsd) {
                foreach ($this->db->getFieldNames('fabricsd') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $fabricsd->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('fabricsd') as $field) {
                $data[$field] = "";
            }
        }

        //upload image
        $data['uploadfabricsd_cad'] = "";
        if (isset($_FILES['fabricsd_cad']) && $_FILES['fabricsd_cad']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('fabricsd_cad');
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
                $direktori = 'images/fabricsd_cad'; //definisikan direktori upload            
                $fabricsd_cad = str_replace(' ', '_', $name);
                $fabricsd_cad = date("H_i_s_") . $fabricsd_cad; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $fabricsd_cad) {
                        delete_files($direktori, $fabricsd_cad); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->identity($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $fabricsd_cad)) {
                    $data['uploadfabricsd_cad'] = "Upload Success !";
                    $input['fabricsd_cad'] = $fabricsd_cad;
                } else {
                    $data['uploadfabricsd_cad'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploadfabricsd_cad'] = "Format File Salah !";
            }
        }
        // dd($data);

        //delete
        if ($this->request->getPost("delete") == "OK") {
            $fabricsd_id =   $this->request->getPost("fabricsd_id");
            $this->db
                ->table("fabricsd")
                ->delete(array("fabricsd_id" =>  $fabricsd_id));
            $data["message"] = "Delete Success";
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'fabricsd_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }

            $builder = $this->db->table('fabricsd');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $fabricsd_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;

        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'fabricsd_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $this->db->table('fabricsd')->update($input, array("fabricsd_id" => $this->request->getPost("fabricsd_id")));
            $data["message"] = "Update Success";
            // echo $this->db->getLastQuery();die;
        }
        return $data;
    }
}
