<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nota_dinas_model extends CI_Model
{

    function get_join_cetak_id($id)
    {
        $sql = "SELECT
        a.*,
        b.nama_vendor,
        b.alamat,
        b.no_telp,
        c.*,
        d.nama_opd
        FROM nota_dinas a
        LEFT JOIN vendor b ON a.`vendor`=b.`id`
        LEFT JOIN kendaraan c ON a.`no_polisi`=c.`nomor_polisi`
        LEFT JOIN master_opd d ON a.`kode_opd`=d.`kode_opd`
        WHERE a.id = '$id'";
        return $this->db->query($sql)->result_array();
    }
}
