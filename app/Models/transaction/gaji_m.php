<?php

namespace App\Models\transaction;

use App\Models\core_m;

class gaji_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek absen
        if ($this->request->getVar("absen_id")) {
            $absend["absen_id"] = $this->request->getVar("absen_id");
        } else {
            $absend["absen_id"] = -1;
        }
        $us = $this->db
            ->table("absen")
            ->getWhere($absend);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "absen_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $absen) {
                foreach ($this->db->getFieldNames('absen') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $absen->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('absen') as $field) {
                $data[$field] = "";
            }
        }



        //delete
        if ($this->request->getPost("delete") == "OK") {
            $absen_id =   $this->request->getPost("absen_id");
            $this->db
                ->table("absen")
                ->delete(array("absen_id" =>  $absen_id));
            $data["message"] = "Delete Success";
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'absen_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }

            $cekabsen = $this->db
                ->table("absen")
                ->orderBy("absen_id", "desc")
                ->limit(1)
                ->get();
            $absen_no = 1;
            foreach ($cekabsen->getResult() as $cekabsen) {
                $aabsen_no = explode("/", $cekabsen->absen_no);
                $absen_no = $aabsen_no[0] + 1;
            }
            $absen_no = str_pad($absen_no, 3, "0", STR_PAD_LEFT);

            $bulan = date("n"); // angka bulan 1-12

            $romawi = [
                1 => 'I',
                2 => 'II',
                3 => 'III',
                4 => 'IV',
                5 => 'V',
                6 => 'VI',
                7 => 'VII',
                8 => 'VIII',
                9 => 'IX',
                10 => 'X',
                11 => 'XI',
                12 => 'XII',
            ];

            $absen_no = $absen_no . "/QT/NKL-" . $input["absen_singkatan"] . "/" . $romawi[$bulan] . "/" . date("Y");
            $input["absen_no"] = $absen_no;
            $input["user_id"] = $this->session->get("user_id");

            $builder = $this->db->table('absen');
            $builder->insert($input);
            // echo $this->db->getLastQuery(); die;
            $absen_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;

        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'absen_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $absen_id = $this->request->getPost("absen_id");
            $this->db->table('absen')->update($input, array("absen_id" => $absen_id));

            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
