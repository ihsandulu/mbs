<?php

namespace App\Models\master;

use App\Models\core_m;

class msize_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek size
        if ($this->request->getVar("size_id")) {
            $sized["size_id"] = $this->request->getVar("size_id");
        } else {
            $sized["size_id"] = -1;
        }
        $us = $this->db
            ->table("size")
            ->getWhere($sized);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "size_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $size) {
                foreach ($this->db->getFieldNames('size') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $size->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('size') as $field) {
                $data[$field] = "";
            }
        }



        //delete
        if ($this->request->getPost("delete") == "OK") {
            $size_id =   $this->request->getPost("size_id");
            $this->db
                ->table("size")
                ->delete(array("size_id" =>  $size_id));
            $data["message"] = "Delete Success";
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'size_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }

            $builder = $this->db->table('size');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $size_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;

        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'size_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $this->db->table('size')->update($input, array("size_id" => $this->request->getPost("size_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
