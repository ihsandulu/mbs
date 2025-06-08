<?php

namespace App\Models\transaction;

use App\Models\core_m;

class target_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        
        if ($this->request->getVar("target_id")) {
            $targetd["target_id"] = $this->request->getVar("target_id");
        } else {
            $targetd["target_id"] = -1;
        }
        $us = $this->db
            ->table("target")
            ->getWhere($targetd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "target_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $target) {
                foreach ($this->db->getFieldNames('target') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $target->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('target') as $field) {
                $data[$field] = "";
            }
        }




        //delete
        if ($this->request->getPost("delete") == "OK") {
            $target_id =   $this->request->getPost("target_id");
            $this->db
                ->table("target")
                ->delete(array("target_id" =>  $target_id));
            $data["message"] = "Delete Success";
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'target_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }

            $builder = $this->db->table('target');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $target_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;

        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'target_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $this->db->table('target')->update($input, array("target_id" => $this->request->getPost("target_id")));
            $data["message"] = "Update Success";
            // echo $this->db->getLastQuery();die;
        }
        return $data;
    }
}
