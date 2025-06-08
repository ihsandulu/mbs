<?php

namespace App\Models\master;

use App\Models\core_m;

class mbuyer_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek buyer
        if ($this->request->getVar("buyer_id")) {
            $buyerd["buyer_id"] = $this->request->getVar("buyer_id");
        } else {
            $buyerd["buyer_id"] = -1;
        }
        $us = $this->db
            ->table("buyer")
            ->getWhere($buyerd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "buyer_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $buyer) {
                foreach ($this->db->getFieldNames('buyer') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $buyer->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('buyer') as $field) {
                $data[$field] = "";
            }
        }



        //delete
        if ($this->request->getPost("delete") == "OK") {
            $buyer_id =   $this->request->getPost("buyer_id");
            $this->db
                ->table("buyer")
                ->delete(array("buyer_id" =>  $buyer_id));
            $data["message"] = "Delete Success";
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'buyer_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }

            $builder = $this->db->table('buyer');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $buyer_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;

        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'buyer_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $this->db->table('buyer')->update($input, array("buyer_id" => $this->request->getPost("buyer_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
