<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    protected $_nama1 = 'PEMERINTAH PROVINSI BANTEN';
    protected $_nama2 = 'BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH';
    protected $_alamat1 = 'Kawasan Pusat Pemerintahan Provinsi Banten (KP3B)';
    protected $_alamat2 = 'Jl. Syech Nawawi Al-Bantani, Palima Serang Telp./Fax. (0254) 267019,267008,267009,267020';


    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('pdf_barcode');
        $this->load->model('nota_dinas_model');
        $this->load->model('transaksi_model');
    }

    public function index()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jenis_kendaraan'] = $this->db->get('jenis_kendaraan')->result_array();
        $data['jenis_perawatan'] = $this->db->get('jenis_perawatan')->result_array();
        $data['kode_akun'] = $this->db->get('anggaran')->result_array();

        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function cetak_perawatan()
    {
        $jenis_perawatan = $this->uri->segment(3);
        $tanggal_awal = $this->uri->segment(4);
        $tanggal_akhir = $this->uri->segment(5);

        ///////////////////// HEADER ///////////////////////////////
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->SetTitle('Laporan Perawatan');
        $pdf->addpage('L', 'A4');
        $pdf->AliasNbPages();

        $pdf->image(base_url() . 'assets/img/pandeglang-cetak.png', 15, 10, 20, 22);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->cell(90);
        $pdf->cell(0, 7, $this->_nama1, 0, 1);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->cell(70);
        $pdf->cell(0, 5, $this->_nama2, 0, 1);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->cell(85);
        $pdf->cell(0, 5, $this->_alamat1, 0, 1);

        $pdf->SetFont('Arial', '', 8);
        $pdf->cell(75);
        $pdf->cell(0, 3, $this->_alamat2, 0, 1);

        $pdf->SetFont('Arial', 'B', 15);
        $pdf->cell(5);
        $pdf->cell(0, 3, '__________________________________________________________________________________________', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->cell(4);
        $pdf->cell(0, 1, '________________________________________________________________________________________________________________________________________', 0, 1);
        ///////////////////// END HEADER ///////////////////////////////
        $date1 = str_replace('/', '-', $tanggal_awal);
        $date2 = str_replace('/', '-', $tanggal_akhir);

        $perawatan = $this->db->get_where('jenis_perawatan', ['id' => $jenis_perawatan])->row_array();
        $pdf->ln(10);
        $pdf->SetFont('Arial', '', 10);
        $pdf->cell(0, 2, 'LAPORAN PEMELIHARAAN KENDARAAN DINAS RODA 4 (EMPAT)', 0, 1, 'C');
        $pdf->ln();
        $pdf->cell(0, 2, 'KATEGORI ' . strtoupper($perawatan['nama_jenis_perawatan']), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 9);
        $pdf->cell(0, 7, 'TAHUN ANGGARAN ( Periode : ' . date('d F Y', strtotime($date1)) . ' ~ ' . date('d F Y', strtotime($date2)) . ' )', 0, 1, 'C');
        $pdf->ln(2);

        $pdf->SetFont('Arial', '', 7);
        // Column headings
        $header = array(
            'NO',
            'NAMA KENDARAAN / BARANG',
            'NOMOR POLISI',
            'RINCIAN BELANJA',
            'WAKTU PEMELIHARAAN',
            'PENYEDIA / VENDOR',
            'NO BKU DAN TANGGAL',
            'DIBAYAR RP'
        );

        // Data loading
        $data = $this->transaksi_model->get_join_laporan_transaksi_id($jenis_perawatan, $date1, $date2);

        // Colors, line width and bold font
        $pdf->SetFillColor(224, 224, 224);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('', 'B');
        // Header
        $w = array(8, 50, 25, 65, 35, 40, 31, 20);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        // Color and font restoration
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;

        $no = 1;
        $total_ = 0;
        foreach ($data as $row) {
            $pdf->Cell($w[0], 50, $no, 1, 0, 'C', $fill);
            $pdf->Cell($w[1], 50, $row['type'] . ' - ' . $row['jenis'], 1, 0, 'L', $fill);
            $pdf->Cell($w[2], 50, $row['nomor_polisi'], 1, 0, 'C', $fill);

            $data1 = $this->transaksi_model->get_laporan_transaksi_detail_by_code($row['code']);
            foreach ($data1 as $row1) {
                $pdf->Cell($w[3], 50, $row1['nama_barang'], 1, 0, 'L', $fill);
            }
            $pdf->Cell($w[4], 50, date('d F Y', strtotime($row['tanggal_perawatan'])), 1, 0, 'C', $fill);
            $pdf->Cell($w[5], 50, $row['nama_vendor'], 1, 0, 'L', $fill);
            $pdf->Cell($w[6], 50, $row['kode_akun'], 1, 0, 'C', $fill);
            $pdf->Cell($w[7], 50, number_format($row['total']), 1, 0, 'R', $fill);
            $pdf->Ln();
            $fill = !$fill;
            $no = $no + 1;
            $total_ = $total_ + $row['total'];
        }

        // Column footer
        $footer = array(
            'Total', number_format($total_),
        );

        // Colors, line width and bold font
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('', 'B');
        // footer
        $w = array(254, 20);
        for ($i = 0; $i < count($footer); $i++)
            if ($i == 0) {
                $pdf->Cell($w[$i], 7, $footer[$i], 1, 0, 'C', true);
            } else {
                $pdf->Cell($w[$i], 7, $footer[$i], 1, 0, 'R', true);
            };
        $pdf->Ln(15);




        $pdf->Output('Register Pemeliharaan Kategori - ' . $perawatan['nama_jenis_perawatan'] . '.pdf', 'I');
    }

    public function cetak_kendaraan()
    {

        $id_merek = $this->uri->segment(3);
        $tanggal_awal = $this->uri->segment(4);
        $tanggal_akhir = $this->uri->segment(5);

        ///////////////////// HEADER ///////////////////////////////
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->SetTitle('Laporan Kendaraan');
        $pdf->addpage('L', 'A4');
        $pdf->AliasNbPages();

        $pdf->image(base_url() . 'assets/img/pandeglang-cetak.png', 15, 10, 20, 22);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->cell(90);
        $pdf->cell(0, 7, $this->_nama1, 0, 1);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->cell(70);
        $pdf->cell(0, 5, $this->_nama2, 0, 1);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->cell(85);
        $pdf->cell(0, 5, $this->_alamat1, 0, 1);

        $pdf->SetFont('Arial', '', 8);
        $pdf->cell(75);
        $pdf->cell(0, 3, $this->_alamat2, 0, 1);

        $pdf->SetFont('Arial', 'B', 15);
        $pdf->cell(5);
        $pdf->cell(0, 3, '__________________________________________________________________________________________', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->cell(4);
        $pdf->cell(0, 1, '________________________________________________________________________________________________________________________________________', 0, 1);
        ///////////////////// END HEADER ///////////////////////////////

        $date1 = str_replace('/', '-', $tanggal_awal);
        $date2 = str_replace('/', '-', $tanggal_akhir);

        $kendaraan = $this->db->get_where('jenis_kendaraan', ['id' => $id_merek])->row_array();
        $pdf->ln(10);
        $pdf->SetFont('Arial', '', 10);
        $pdf->cell(0, 2, 'LAPORAN REGISTER KENDARAAN DINAS RODA 4 (EMPAT)', 0, 1, 'C');
        $pdf->ln();
        if ($id_merek == 0) {
            $pdf->cell(0, 2, 'SEMUA MEREK KENDARAAN ', 0, 1, 'C');
        } else {
            $pdf->cell(0, 2, 'MEREK KENDARAAN ' . strtoupper($kendaraan['nama_jenis_kendaraan']), 0, 1, 'C');
        }
        $pdf->SetFont('Arial', '', 9);
        $pdf->cell(0, 7, 'TANGGAL REGISTRASI ( Periode : ' . date('d F Y', strtotime($date1)) . ' ~ ' . date('d F Y', strtotime($date2)) . ' )', 0, 1, 'C');
        $pdf->ln(2);

        $pdf->SetFont('Arial', '', 7);
        // Column headings
        $header = array(
            'NO',
            'NOMOR POLISI',
            'NAMA PEMILIK',
            'ALAMAT',
            'PENGGUNA KENDARAAN',
            'MEREK',
            'TYPE/JENIS/MODEL',
            'TAHUN',
            'TANGGAL BERLAKU',
        );

        // Data loading
        $data = $this->transaksi_model->get_join_laporan_kendaraan_id($id_merek, $date1, $date2);

        // Colors, line width and bold font
        $pdf->SetFillColor(224, 224, 224);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('', 'B');
        // Header
        $w = array(8, 20, 35, 70, 40, 25, 31, 12, 30);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        // Color and font restoration
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;


        $no = 1;
        foreach ($data as $row) {
            $pdf->Cell($w[0], 7, $no, 1, 0, 'C', $fill);
            $pdf->Cell($w[1], 7, $row['nomor_polisi'], 1, 0, 'C', $fill);
            $pdf->Cell($w[2], 7, $row['nama_pemilik'], 1, 0, 'L', $fill);
            $pdf->Cell($w[3], 7, $row['alamat'], 1, 0, 'L', $fill);
            $pdf->Cell($w[4], 7, $row['pengguna_kendaraan'], 1, 0, 'L', $fill);
            $pdf->Cell($w[5], 7, $row['nama_jenis_kendaraan'], 1, 0, 'L', $fill);
            $pdf->Cell($w[6], 7, $row['type'] . '/' . $row['jenis'], 1, 0, 'L', $fill);
            $pdf->Cell($w[7], 7, $row['tahun_registrasi'], 1, 0, 'C', $fill);
            $pdf->Cell($w[8], 7, $row['tanggal_berlaku'], 1, 0, 'C', $fill);
            $pdf->Ln();
            $fill = !$fill;
            $no = $no + 1;
        }
        $pdf->Ln(5);

        $pdf->Output('Register Kendaraan - ' . '.pdf', 'I');
    }


    // Notda Dinas
    public function surat_pengantar($id)
    {
        $data = $this->nota_dinas_model->get_join_cetak_id($id);
        foreach ($data as $row) {
            $id = $row['id'];
            $nomor_nota_dinas = $row['nomor_nota_dinas'];
            $nama_vendor = $row['nama_vendor'];
            $nomor_polisi = $row['nomor_polisi'];
            $type = $row['type'];
            $jenis = $row['jenis'];
            $rincian_penggantian = $row['rincian_penggantian'];
            $silinder = $row['silinder'];
            $warna = $row['warna'];
            $nama_opd = $row['nama_opd'];
            $dari = $row['dari'];
        }

        //BEGIN PDF///////////////////////////////////////////
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->SetTitle($nomor_nota_dinas);
        $pdf->addpage('P', 'A4');
        $pdf->AliasNbPages();

        $pdf->image(base_url() . 'assets/img/pandeglang-cetak.png', 15, 10, 20, 22);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->cell(52);
        $pdf->cell(0, 7, $this->_nama1, 0, 1);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->cell(27);
        $pdf->cell(0, 5, $this->_nama2, 0, 1);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->cell(47);
        $pdf->cell(0, 5, $this->_alamat1, 0, 1);

        $pdf->SetFont('Arial', '', 8);
        $pdf->cell(37);
        $pdf->cell(0, 3, $this->_alamat2, 0, 1);

        $pdf->SetFont('Arial', 'B', 15);
        $pdf->cell(5);
        $pdf->cell(0, 3, '___________________________________________________________', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->cell(4);
        $pdf->cell(0, 1, '_________________________________________________________________________________________', 0, 1);

        $pdf->ln(15);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->cell(15);
        $pdf->cell(0, 5, "SURAT PENGANTAR SERVICE KENDARAAN DINAS", 0, 1);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->cell(15);
        $pdf->cell(0, 5, strtoupper($nama_opd), 0, 1);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->cell(15);
        $pdf->cell(0, 5, "KABUPATEN PANDEGLANG", 0, 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->cell(15);
        $pdf->cell(0, 5, 'No. ' . $nomor_nota_dinas, 0, 1);



        $pdf->ln(10);
        $pdf->cell(15);
        $pdf->SetFont('Arial', '', 9);
        // Column headings
        $header = array(
            'Kepada',
            ':',
            $nama_vendor
        );

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('', '');
        // Header
        $w = array(60, 5, 100,);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'L', true);
        $pdf->Ln();

        $pdf->cell(15);
        $pdf->SetFont('Arial', '', 9);
        // Column headings
        $header = array(
            'Dari',
            ':',
            strtoupper($dari)
        );

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('', '');
        // Header
        $w = array(60, 5, 100,);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'L', true);
        $pdf->Ln(10);

        $pdf->SetWidths(array(200));
        $pdf->SetAligns(array('L'));
        $pdf->cell(15);
        $pdf->row(array('Mohon dilayani Kendaraan Bermotor Dinas Roda 4 (empat) sebagai berikut:'));
        $pdf->Ln(5);

        $pdf->cell(15);
        $pdf->SetFont('Arial', '', 9);
        // Column headings
        $header = array(
            'Nomor Polisi',
            ':',
            $nomor_polisi
        );

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('', '');
        // Header
        $w = array(60, 5, 100,);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'L', true);
        $pdf->Ln();

        $pdf->cell(15);
        $pdf->SetFont('Arial', '', 9);
        // Column headings
        $header = array(
            'Type / Model',
            ':',
            $type . ' / ' . $jenis
        );

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('', '');
        // Header
        $w = array(60, 5, 100,);
        for ($i = 0; $i < count($header); $i++)
            $pdf->cell($w[$i], 7, $header[$i], 1, 0, 'L', true);
        $pdf->Ln();

        $pdf->cell(15);
        $pdf->SetFont('Arial', '', 9);
        // Column headings
        $header = array(
            'Silinder',
            ':',
            $silinder
        );

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('', '');
        // Header
        $w = array(60, 5, 100,);
        for ($i = 0; $i < count($header); $i++)
            $pdf->cell($w[$i], 7, $header[$i], 1, 0, 'L', true);
        $pdf->Ln();

        $pdf->cell(15);
        $pdf->SetFont('Arial', '', 9);
        // Column headings
        $header = array(
            'Warna',
            ':',
            $warna
        );

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('', '');
        // Header
        $w = array(60, 5, 100,);
        for ($i = 0; $i < count($header); $i++)
            $pdf->cell($w[$i], 7, $header[$i], 1, 0, 'L', true);
        $pdf->Ln(15);


        $pdf->SetWidths(array(200));
        $pdf->SetAligns(array('L'));
        $pdf->cell(15);
        $pdf->row(array('Spare part yang akan diganti dengan rincian sebagai berikut:'));
        $pdf->cell(2);
        $pdf->Ln(3);

        $pdf->cell(20);
        $pdf->row(array($rincian_penggantian));

        $pdf->Ln(10);

        $tanggal = date('d F Y');
        //////////////////////////////////////////////////
        $pdf->SetWidths(array(130, 0, 0, 0, 0, 0, 40));
        $pdf->row(array('', '', '', '', '', '', 'Serang, ' . $tanggal));

        $pdf->SetWidths(array(20, 50, 0, 50, 0, 50, 0));
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetFonts(array(9, 9, 9, 9, 9, 9, 9));
        $pdf->SetFontsType(array('', '', '', '', '', '', ''));
        $pdf->row(array('', 'PEMEGANG KENDARAAN', '', 'PENGURUS BARANG', '', 'PEJABAT PELAKSANA TEKNIS', ''));
        $pdf->row(array('', '', '', '', '', '(PPTSK)', ''));
        $pdf->row(array('', '', '', '', '', '', ''));
        $pdf->row(array('', '', '', '', '', '', ''));
        $pdf->row(array('', '', '', '', '', '', ''));
        $pdf->SetFont('Arial', 'BU', 9);
        $pdf->row(array('', '', '', '', '', '', ''));
        $pdf->SetFont('Arial', '', 8);
        $pdf->row(array('', '( _______________________ )', '', '( _______________________ )', '', '( _______________________ )', ''));
        $pdf->SetFont('Arial', '', 5);
        $pdf->row(array('', '', '', '', '', '', ''));

        $pdf->Ln(10);

        //END PDF//////////////////////////////////////////

        $pdf->Output('Surat Pengantar - ' . $nomor_nota_dinas . '.pdf', 'I');
    }


    // Notda Dinas
    public function invoice($id)
    {
        $data = $this->transaksi_model->get_join_transaksi_id($id);
        foreach ($data as $row) {
            $id = $row['id'];
            $code = $row['code'];
            $nomor_polisi = $row['nomor_polisi'];
            $tanggal_perawatan = $row['tanggal_perawatan'];
            $nama_jenis_perawatan = $row['nama_jenis_perawatan'];
            $kilometer_kendaraan = $row['kilometer_kendaraan'];
            $kode_akun = $row['kode_akun'];
            $type = $row['type'];
            $jenis = $row['jenis'];
            $nama_pemilik = $row['nama_pemilik'];
            $pengguna_kendaraan = $row['pengguna_kendaraan'];
            $warna = $row['warna'];
            $tahun_registrasi = $row['tahun_registrasi'];
            $nama_jenis_kendaraan = $row['nama_jenis_kendaraan'];
        }

        //BEGIN PDF///////////////////////////////////////////
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->SetTitle('Invoice ' . $code);
        $pdf->addpage('P', 'A4');
        $pdf->AliasNbPages();

        $pdf->image(base_url() . 'assets/img/pandeglang-cetak.png', 15, 10, 20, 22);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->cell(52);
        $pdf->cell(0, 7, $this->_nama1, 0, 1);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->cell(27);
        $pdf->cell(0, 5, $this->_nama2, 0, 1);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->cell(47);
        $pdf->cell(0, 5, $this->_alamat1, 0, 1);

        $pdf->SetFont('Arial', '', 8);
        $pdf->cell(37);
        $pdf->cell(0, 3, $this->_alamat2, 0, 1);

        $pdf->SetFont('Arial', 'B', 15);
        $pdf->cell(5);
        $pdf->cell(0, 3, '___________________________________________________________', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->cell(4);
        $pdf->cell(0, 1, '_________________________________________________________________________________________', 0, 1);


        $pdf->ln(10);
        $pdf->SetFont('Arial', 'BU', 14);
        $pdf->cell(0, 5, 'I N V O I C E', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->cell(0, 7, $code, 0, 1, 'C');

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetWidths(array(5, 40, 3, 50, 40, 3, 50));
        $pdf->SetAligns(array('L', 'L', 'C', 'L', 'L', 'C', 'L'));
        $pdf->SetFonts(array(9, 9, 9, 9, 9, 9, 9));
        $pdf->ln(5);

        $pdf->row(array('', '', '', '', '', '', ''));
        $pdf->SetFontsType(array('', '', '', '', '', '', ''));
        $pdf->row(array('', 'Kode Transaksi', ':', $code, 'Merek Kendaraan', ':', $nama_jenis_kendaraan));
        $pdf->row(array('', 'Nomor Polisi', ':', $nomor_polisi, 'Type/Model', ':', $type . '/' . $jenis));
        $pdf->row(array('', 'Tanggal Perawatan', ':', date('d M Y', strtotime($tanggal_perawatan)), 'Nama Pemilik', ':', $nama_pemilik));
        $pdf->row(array('', 'Jenis Perawatan', ':', $nama_jenis_perawatan, 'Pengguna Kendaraan', ':', $pengguna_kendaraan));
        $pdf->row(array('', 'Kilometer Kendaraan', ':', $kilometer_kendaraan . ' Km', 'Warna', ':', $warna));
        $pdf->row(array('', 'Kode Akun Anggaran', ':', $kode_akun, 'Tahun Registrasi', ':', $tahun_registrasi));
        $pdf->ln(5);



        ///////////////////////////////////////////////////
        $detail_transaksi = $this->transaksi_model->get_transaksi_detail_by_code($code);
        $pdf->cell(5);
        $pdf->SetFont('Arial', '', 7);
        // Column headings
        $header = array(
            'No',
            'Nama Barang',
            'Volume',
            'Satuan',
            'Harga',
            'Total',
        );

        // Data loading
        $data = $detail_transaksi;
        // Colors, line width and bold font
        $pdf->SetFillColor(224, 224, 224);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('', 'B');
        // Header
        $w = array(8, 100, 12, 15, 20, 20,);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        // Color and font restoration
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;


        $no = 1;
        $total_qty = 0;
        $total_harga = 0;
        $total_jumlah = 0;
        foreach ($data as $row) {
            $pdf->cell(5);
            $pdf->Cell($w[0], 6, $no, 1, 0, 'C', $fill);
            $pdf->Cell($w[1], 6, $row['nama_barang'], 1, 0, 'L', $fill);
            $pdf->Cell($w[2], 6, $row['volume'], 1, 0, 'C', $fill);
            $pdf->Cell($w[3], 6, $row['satuan'], 1, 0, 'C', $fill);
            $pdf->Cell($w[4], 6, number_format($row['harga']), 1, 0, 'R', $fill);
            $pdf->Cell($w[5], 6, number_format($row['jumlah']), 1, 0, 'R', $fill);
            $pdf->Ln();
            $fill = !$fill;

            $no = $no + 1;
            $total_qty += $row['volume'];
            $total_harga += $row['harga'];
            $total_jumlah += $row['jumlah'];
        }

        $pdf->cell(5);
        // Column footer
        $footer = array(
            'Total',
            number_format($total_qty),
            '',
            number_format($total_harga),
            number_format($total_jumlah)
        );

        // Colors, line width and bold font
        $pdf->SetFillColor(300, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('', 'B');

        $w = array(108, 12, 15, 20, 20, 20,);
        for ($i = 0; $i < count($footer); $i++)
            if ($i == 0 || $i == 1) {
                $pdf->Cell($w[$i], 7, $footer[$i], 1, 0, 'C', true);
            } else {
                $pdf->Cell($w[$i], 7, $footer[$i], 1, 0, 'R', true);
            };
        $pdf->Ln(10);

        $vendor = $this->transaksi_model->get_vendor_by_id($code);
        foreach ($vendor as $row) {
            $nama_vendor = $row['nama_vendor'];
            $alamat = $row['alamat'];
            $no_telp = $row['no_telp'];
        }
        $pdf->SetFont('Arial', '', 8);
        $pdf->row(array('', '', '', '', '', '', ''));
        $pdf->SetWidths(array(5, 30, 3, 65, 0, 0, 0));
        $pdf->row(array('', 'Vendor/Penyedia', '', '', '', '', ''));
        $pdf->row(array('', 'Nama', ':', $nama_vendor, '', '', ''));
        $pdf->row(array('', 'Alamat', ':', $alamat, '', '', ''));
        $pdf->row(array('', 'Telpon', ':', $no_telp, '', '', ''));

        $pdf->Ln(10);
        $tanggal = date('d F Y');
        $pdf->SetFont('Arial', '', 8);
        //////////////////////////////////////////////////
        $pdf->SetWidths(array(130, 0, 0, 0, 0, 0, 40));
        $pdf->row(array('', '', '', '', '', '', 'Serang, ' . $tanggal));

        $pdf->SetWidths(array(20, 50, 0, 50, 0, 50, 0));
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetFonts(array(9, 9, 9, 9, 9, 9, 9));
        $pdf->SetFontsType(array('', '', '', '', '', '', ''));
        $pdf->row(array('', 'PEMEGANG KENDARAAN', '', 'PENGURUS BARANG', '', 'PEJABAT PELAKSANA TEKNIS', ''));
        $pdf->row(array('', '', '', '', '', '(PPTSK)', ''));
        $pdf->row(array('', '', '', '', '', '', ''));
        $pdf->row(array('', '', '', '', '', '', ''));
        $pdf->row(array('', '', '', '', '', '', ''));
        $pdf->SetFont('Arial', 'BU', 9);
        $pdf->row(array('', '', '', '', '', '', ''));
        $pdf->SetFont('Arial', '', 8);
        $pdf->row(array('', '( _______________________ )', '', '( _______________________ )', '', '( _______________________ )', ''));
        $pdf->SetFont('Arial', '', 5);
        $pdf->row(array('', '', '', '', '', '', ''));

        $pdf->Ln(10);

        //END PDF//////////////////////////////////////////

        $pdf->Output('Invoice - ' . $code . '.pdf', 'I');
    }
}
