<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    function get_last_code($day, $month, $year)
    {
        $this->db->where('DAY(created_date)', $day);
        $this->db->where('MONTH(created_date)', $month);
        $this->db->where('YEAR(created_date)', $year);

        $this->db->order_by('created_date', 'desc');
        $this->db->limit(1);

        return $this->db->get('transaksi')->row_array();
    }

    function get_last_kode_qr($day, $month, $year)
    {
        $this->db->where('DAY(created_date)', $day);
        $this->db->where('MONTH(created_date)', $month);
        $this->db->where('YEAR(created_date)', $year);

        $this->db->order_by('created_date', 'desc');
        $this->db->limit(1);

        return $this->db->get('kendaraan')->row_array();
    }

    function get_nomor_polisi_id($nomor_polisi)
    {
        $hasil = $this->db->query("SELECT 
        a.*,
        b.nama_jenis_kendaraan,
        c.nama_bahan_bakar
        FROM kendaraan a
        LEFT JOIN jenis_kendaraan b ON a.`id_merek`=b.`id`
        LEFT JOIN jenis_bahan_bakar c ON a.`id_bahan_bakar`=c.`id`
        WHERE a.`nomor_polisi`='$nomor_polisi'");
        return $hasil->result();
    }

    function get_kendaraan_nota_dinas()
    {
        $sql = "SELECT * FROM nota_dinas WHERE status=2";
        return $this->db->query($sql)->result_array();
    }


    function get_kode_akun_id($kode_akun)
    {
        $hasil = $this->db->query("SELECT * FROM anggaran WHERE kode_akun='$kode_akun'");
        return $hasil->result();
    }

    function get_join_transaksi()
    {
        $sql = "SELECT
        a.id,
        a.code,
        a.nomor_polisi,
        a.tanggal_perawatan,
        b.nama_jenis_perawatan,
        a.kilometer_kendaraan,
        SUM(c.jumlah) AS jumlah
        FROM transaksi a
        LEFT JOIN jenis_perawatan b ON a.`jenis_perawatan`=b.`id`
        LEFT JOIN transaksi_detail c ON a.`code`=c.`code_transaksi`
        GROUP BY a.`code` order by a.`id` desc";
        return $this->db->query($sql)->result_array();
    }

    function get_join_perawatan()
    {
        $year = date('Y');
        $sql = "SELECT SUM(jumlah)AS total FROM transaksi_detail WHERE YEAR(created_date)='$year'";
        return $this->db->query($sql)->result_array();
    }

    function get_join_anggaran()
    {
        $year = date('Y');
        $sql = "SELECT * FROM anggaran WHERE tahun_anggaran='$year'";
        return $this->db->query($sql)->result_array();
    }

    function get_join_kendaraan()
    {
        if ($this->session->userdata('role_id') == 1) {
            $sql = "SELECT 
            a.*,
            b.nama_jenis_kendaraan,
            c.nama_bahan_bakar,
            d.nama_opd,
            e.nama_assets
            FROM kendaraan a
            LEFT JOIN jenis_kendaraan b ON a.`id_merek`=b.`id`
            LEFT JOIN jenis_bahan_bakar c ON a.`id_bahan_bakar`=c.`id`
            LEFT JOIN master_opd d ON a.`kode_opd`=d.`id`
            LEFT JOIN jenis_assets e ON a.`jenis_assets`=e.`id`";
            return $this->db->query($sql)->result_array();
        } else {
            $sql = "SELECT 
            a.*,
            b.nama_jenis_kendaraan,
            c.nama_bahan_bakar,
            d.nama_opd,
            e.nama_assets
            FROM kendaraan a
            LEFT JOIN jenis_kendaraan b ON a.`id_merek`=b.`id`
            LEFT JOIN jenis_bahan_bakar c ON a.`id_bahan_bakar`=c.`id`
            LEFT JOIN master_opd d ON a.`kode_opd`=d.`id`
            LEFT JOIN jenis_assets e ON a.`jenis_assets`=e.`id`
            WHERE a.`kode_opd`='" . $this->session->userdata('opd') . "'";
            return $this->db->query($sql)->result_array();
        }
    }

    function get_join_nota_dinas()
    {
        if ($this->session->userdata('role_id') == 1) {
            $sql = "SELECT * FROM nota_dinas";
            return $this->db->query($sql)->result_array();
        } else {
            $sql = "SELECT * FROM nota_dinas WHERE kode_opd='" . $this->session->userdata('opd') . "'";
            return $this->db->query($sql)->result_array();
        }
    }


    function get_join_transaksi_id($id)
    {
        $sql = "SELECT
        a.id,
        a.code,
        a.nomor_polisi,
        a.tanggal_perawatan,
        b.nama_jenis_perawatan,
        a.kilometer_kendaraan,
        a.kode_akun,
        SUM(c.jumlah) AS jumlah,
        d.*,
        e.nama_jenis_kendaraan
        FROM transaksi a
        LEFT JOIN jenis_perawatan b ON a.`jenis_perawatan`=b.`id`
        LEFT JOIN transaksi_detail c ON a.`code`=c.`code_transaksi`
        LEFT JOIN kendaraan d ON a.`nomor_polisi`=d.`nomor_polisi`
        LEFT JOIN jenis_kendaraan e ON e.`id`=d.`id_merek`
        WHERE a.`id`='$id'
        GROUP BY a.`code`";
        return $this->db->query($sql)->result_array();
    }

    function get_join_laporan_transaksi_id($jenis_perawatan, $tanggal_awal, $tanggal_akhir)
    {
        $sql = "SELECT
        a.code,
        a.nomor_polisi,
        a.tanggal_perawatan,
        a.jenis_perawatan,
        a.kode_akun,
        b.`vendor`,
        c.nama_vendor,
        d.type,
        d.jenis,
        d.pengguna_kendaraan,
        (SELECT SUM(jumlah) FROM transaksi_detail WHERE code_transaksi=a.`code`)AS total
        FROM transaksi a
        LEFT JOIN nota_dinas b ON a.`nomor_polisi`=b.`no_polisi`
        LEFT JOIN vendor c ON b.`vendor`=c.`id`
        LEFT JOIN kendaraan d ON d.`nomor_polisi`=a.`nomor_polisi`
        WHERE a.`jenis_perawatan`='$jenis_perawatan' AND a.`tanggal_perawatan` BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
        GROUP BY a.`code`";
        return $this->db->query($sql)->result_array();
    }


    function get_join_laporan_kendaraan_id($id_merek, $tanggal_awal, $tanggal_akhir)
    {

        if ($id_merek == 0) {
            $sql = "SELECT 
            a.*,
            b.nama_jenis_kendaraan 
            FROM kendaraan a
            LEFT JOIN jenis_kendaraan b ON a.`id_merek`=b.`id`
            WHERE a.created_date BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            return $this->db->query($sql)->result_array();
        } else {
            $sql = "SELECT 
            a.*,
            b.nama_jenis_kendaraan 
            FROM kendaraan a
            LEFT JOIN jenis_kendaraan b ON a.`id_merek`=b.`id`
            WHERE a.`id_merek`='$id_merek' AND a.created_date BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            return $this->db->query($sql)->result_array();
        }
    }


    function delete_kendaraan_id($id)
    {
        $sql = "DELETE FROM kendaraan WHERE id = '$id'";
        return $this->db->query($sql);
    }

    function delete($id)
    {
        $sql = "DELETE FROM transaksi WHERE id = '$id'";
        return $this->db->query($sql);
    }

    function delete_detail($code)
    {
        $sql = "DELETE FROM transaksi_detail WHERE code_transaksi = '$code'";
        return $this->db->query($sql);
    }

    function get_transaksi_by_id($id)
    {
        $sql = "SELECT * FROM transaksi WHERE id = '$id'";
        return $this->db->query($sql)->result_array();
    }

    function get_transaksi_detail_by_code($code)
    {
        $sql = "SELECT * FROM transaksi_detail WHERE code_transaksi = '$code'";
        return $this->db->query($sql)->result_array();
    }

    function get_laporan_transaksi_detail_by_code($code)
    {
        $sql = "SELECT
        code_transaksi,
        GROUP_CONCAT(nama_barang SEPARATOR ',')AS nama_barang
        FROM transaksi_detail WHERE code_transaksi='$code'
        GROUP BY code_transaksi";
        return $this->db->query($sql)->result_array();
    }


    function delete_detail_by_id($id_detail)
    {
        $sql = "DELETE FROM transaksi_detail WHERE id_detail = '$id_detail'";
        return $this->db->query($sql);
    }


    function delete_nota_dinas_id($id)
    {
        $sql = "DELETE FROM nota_dinas WHERE id = '$id'";
        return $this->db->query($sql);
    }

    function update_nota_dinas_id($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('nota_dinas', $data);
    }

    function get_vendor_by_id($code)
    {
        $sql = "SELECT
        a.*,
        b.nama_vendor,
        b.alamat,
        b.no_telp,
        c.*
        FROM nota_dinas a
        LEFT JOIN vendor b ON a.`vendor`=b.`id`
        LEFT JOIN kendaraan c ON a.`no_polisi`=c.`nomor_polisi`
        WHERE a.`code`='$code'";
        return $this->db->query($sql)->result_array();
    }


    function master_anggaran()
    {
        if ($this->session->userdata('role_id') == 1) {
            $sql = "SELECT
            a.*,
            b.nama_opd
            FROM anggaran a
            LEFT JOIN master_opd b ON b.`id`=a.`kode_opd`";
            return $this->db->query($sql)->result_array();
        } else {
            $sql = "SELECT
            a.*,
            b.nama_opd
            FROM anggaran a
            LEFT JOIN master_opd b ON b.`id`=a.`kode_opd`
            WHERE a.`kode_opd`='" . $this->session->userdata('opd') . "'";
            return $this->db->query($sql)->result_array();
        }
    }
}
