<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('transaksi_model');
    }

    public function index()
    {
        $data['title'] = 'Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['transaksi'] = $this->transaksi_model->get_join_transaksi();

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function form_add_transaksi()
    {
        //Global Location Number
        $kode = 'TRX';
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d H:i:s');
        $d = date('d', strtotime($tanggal));
        $m = date('m', strtotime($tanggal));
        $y = date('y', strtotime($tanggal));
        $yx = date('Y', strtotime($tanggal));

        $last_code = $this->transaksi_model->get_last_code($d, $m, $yx);
        if (is_countable($last_code) > 0) {
            $l_code = substr($last_code['code'], -4);
            $count = (int)$l_code + 1;
        } else {
            $count = 1;
        }
        $count = str_pad($count, 4, '0', STR_PAD_LEFT);
        $data['code'] = $kode . $d . $m . $y . '-' . $count;
        //END NO


        $data['title'] = 'Form Data Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jenis_perawatan'] = $this->db->get('jenis_perawatan')->result_array();

        $data['kendaraan_notadinas'] = $this->transaksi_model->get_kendaraan_nota_dinas();

        $data['anggaran'] = $this->db->get('anggaran')->result_array();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/form-add', $data);
        $this->load->view('templates/footer', $data);
    }

    function get_nomor_polisi()
    {
        $nomor_polisi = $this->input->post('nomor_polisi');
        $data = $this->transaksi_model->get_nomor_polisi_id($nomor_polisi);
        echo json_encode($data);
    }

    public function kendaraan()
    {
        $data['title'] = 'Data Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['join_kendaraan'] = $this->transaksi_model->get_join_kendaraan();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();

        $this->form_validation->set_rules('nama_jenis_kendaraan', 'Jenis Kendaraan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kendaraan/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('jenis_kendaraan', ['nama_jenis_kendaraan' => $this->input->post('nama_jenis_kendaraan')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New added!</div>');
            redirect('transaksi/kendaraan');
        }
    }

    public function form_add_kendaraan()
    {

        //Global Location Number
        $kode = 'OPD-KND';
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d H:i:s');
        $d = date('d', strtotime($tanggal));
        $m = date('m', strtotime($tanggal));
        $y = date('y', strtotime($tanggal));
        $yx = date('Y', strtotime($tanggal));

        $last_code = $this->transaksi_model->get_last_kode_qr($d, $m, $yx);
        if (is_countable($last_code) > 0) {
            $l_code = substr($last_code['kode_qr'], -4);
            $count = (int)$l_code + 1;
        } else {
            $count = 1;
        }
        $count = str_pad($count, 4, '0', STR_PAD_LEFT);
        $data['kode_qr'] = $kode . $d . $m . $y . $count;
        //END NO


        $data['title'] = 'Form Data Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['merek'] = $this->db->get('jenis_kendaraan')->result_array();
        $data['bahan_bakar'] = $this->db->get('jenis_bahan_bakar')->result_array();

        $data['list_assets'] = $this->db->get('jenis_assets')->result_array();
        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();
        $data['list_opd'] = $this->db->get('master_opd')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kendaraan/form-add', $data);
        $this->load->view('templates/footer', $data);
    }

    public function save_kendaraan()
    {

        //Global Location Number
        $kode = 'OPD-KND';
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d H:i:s');
        $d = date('d', strtotime($tanggal));
        $m = date('m', strtotime($tanggal));
        $y = date('y', strtotime($tanggal));
        $yx = date('Y', strtotime($tanggal));

        $last_code = $this->transaksi_model->get_last_kode_qr($d, $m, $yx);
        if (is_countable($last_code) > 0) {
            $l_code = substr($last_code['kode_qr'], -4);
            $count = (int)$l_code + 1;
        } else {
            $count = 1;
        }
        $count = str_pad($count, 4, '0', STR_PAD_LEFT);
        $data['kode_qr'] = $kode . $d . $m . $y . $count;
        //END NO

        $data['title'] = 'Form Data Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();
        $data['list_opd'] = $this->db->get('master_opd')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $this->form_validation->set_rules('kode_qr', 'kode_qr', 'required');
        $this->form_validation->set_rules('kode_opd', 'kode_opd', 'required');
        $this->form_validation->set_rules('jenis_assets', 'jenis_assets', 'required');
        $this->form_validation->set_rules('harga_pembelian', 'harga_pembelian', 'required');
        $this->form_validation->set_rules('tahun_penyusutan', 'tahun_penyusutan', 'required');

        $this->form_validation->set_rules('nomor_polisi', 'nomor_polisi', 'required');
        $this->form_validation->set_rules('nama_pemilik', 'nama_pemilik', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('pengguna_kendaraan', 'pengguna_kendaraan', 'required');
        $this->form_validation->set_rules('id_merek', 'id_merek', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('jenis', 'jenis', 'required');
        $this->form_validation->set_rules('model', 'model', 'required');
        $this->form_validation->set_rules('tahun_pembuatan', 'tahun_pembuatan', 'required');
        $this->form_validation->set_rules('silinder', 'silinder', 'required');
        $this->form_validation->set_rules('nomor_rangka', 'nomor_rangka', 'required');
        $this->form_validation->set_rules('nomor_mesin', 'nomor_mesin', 'required');
        $this->form_validation->set_rules('warna', 'warna', 'required');
        $this->form_validation->set_rules('id_bahan_bakar', 'id_bahan_bakar', 'required');
        $this->form_validation->set_rules('warna_tnkb', 'warna_tnkb', 'required');
        $this->form_validation->set_rules('tahun_registrasi', 'tahun_registrasi', 'required');
        $this->form_validation->set_rules('nomor_bpkb', 'nomor_bpkb', 'required');
        $this->form_validation->set_rules('tanggal_berlaku', 'tanggal_berlaku', 'required');
        $this->form_validation->set_rules('berat_kb', 'berat_kb', 'required');
        $this->form_validation->set_rules('jumlah_sumbu', 'jumlah_sumbu', 'required');
        $this->form_validation->set_rules('jbb_penumpang', 'jbb_penumpang', 'required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');

        if ($this->form_validation->run() ==  false) {
            $data['merek'] = $this->db->get('jenis_kendaraan')->result_array();
            $data['bahan_bakar'] = $this->db->get('jenis_bahan_bakar')->result_array();
            $data['list_assets'] = $this->db->get('jenis_assets')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kendaraan/form-add', $data);
            $this->load->view('templates/footer');
        } else {
            $date = date('Y-m-d H:i:s');
            $data = [
                'kode_qr' => $this->input->post('kode_qr'),
                'kode_opd' => $this->input->post('kode_opd'),
                'jenis_assets' => $this->input->post('jenis_assets'),
                'nomor_polisi' => $this->input->post('nomor_polisi'),
                'nama_pemilik' => $this->input->post('nama_pemilik'),
                'alamat' => $this->input->post('alamat'),
                'pengguna_kendaraan' => $this->input->post('pengguna_kendaraan'),
                'id_merek' => $this->input->post('id_merek'),
                'type' => $this->input->post('type'),
                'jenis' => $this->input->post('jenis'),
                'model' => $this->input->post('model'),
                'tahun_pembuatan' => $this->input->post('tahun_pembuatan'),
                'silinder' => $this->input->post('silinder'),
                'nomor_rangka' => $this->input->post('nomor_rangka'),
                'nomor_mesin' => $this->input->post('nomor_mesin'),
                'warna' => $this->input->post('warna'),
                'id_bahan_bakar' => $this->input->post('id_bahan_bakar'),
                'warna_tnkb' => $this->input->post('warna_tnkb'),
                'tahun_registrasi' => $this->input->post('tahun_registrasi'),
                'nomor_bpkb' => $this->input->post('nomor_bpkb'),
                'tanggal_berlaku' => $this->input->post('tanggal_berlaku'),
                'berat_kb' => $this->input->post('berat_kb'),
                'jumlah_sumbu' => $this->input->post('jumlah_sumbu'),
                'jbb_penumpang' => $this->input->post('jbb_penumpang'),
                'harga_pembelian' => $this->input->post('harga_pembelian'),
                'tahun_penyusutan' => $this->input->post('tahun_penyusutan'),
                'keterangan' => $this->input->post('keterangan'),
                'created_date' => $date,
                'created_user' => $this->session->userdata('email')
            ];


            // gambar depan
            $upload_image = $_FILES['gambar_depan']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar_depan')) {
                    // $old_image = $data['kendaraan']['gambar_depan'];
                    // if ($old_image != 'mobil-depan.png') {
                    //     unlink(FCPATH . 'assets/img/' . $old_image);
                    // }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar_depan', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }
            // end gambar depan


            // gambar belakang
            $upload_image = $_FILES['gambar_belakang']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar_belakang')) {
                    // $old_image = $data['kendaraan']['gambar_belakang'];
                    // if ($old_image != 'mobil-belakang.png') {
                    //     unlink(FCPATH . 'assets/img/' . $old_image);
                    // }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar_belakang', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }
            // end gambar belakang

            // gambar samping kiri
            $upload_image = $_FILES['gambar_samping_kiri']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar_samping_kiri')) {
                    // $old_image = $data['kendaraan']['gambar_samping_kiri'];
                    // if ($old_image != 'mobil-kiri.png') {
                    //     unlink(FCPATH . 'assets/img/' . $old_image);
                    // }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar_samping_kiri', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }
            // end gambar sampoeng kiri

            // gambar samping kanan
            $upload_image = $_FILES['gambar_samping_kanan']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar_samping_kanan')) {
                    // $old_image = $data['kendaraan']['gambar_samping_kanan'];
                    // if ($old_image != 'mobil-kanan.png') {
                    //     unlink(FCPATH . 'assets/img/' . $old_image);
                    // }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar_samping_kanan', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }
            // end gambar sampoeng kanan


            $this->db->insert('kendaraan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Kendaraan added!</div>');
            redirect('transaksi/kendaraan');
        }
    }


    public function form_edit_kendaraan()
    {
        $id = $this->uri->segment(3);

        $data['title'] = 'Form Edit Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['merek'] = $this->db->get('jenis_kendaraan')->result_array();
        $data['bahan_bakar'] = $this->db->get('jenis_bahan_bakar')->result_array();
        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();
        $data['list_opd'] = $this->db->get('master_opd')->result_array();
        $data['list_assets'] = $this->db->get('jenis_assets')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kendaraan/form-edit', $data);
        $this->load->view('templates/footer', $data);
    }

    public function save_edit_kendaraan()
    {
        $data['title'] = 'Form Edit Data Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('kode_qr', 'kode_qr', 'required');
        $this->form_validation->set_rules('kode_opd', 'kode_opd', 'required');
        $this->form_validation->set_rules('jenis_assets', 'jenis_assets', 'required');
        $this->form_validation->set_rules('nomor_polisi', 'nomor_polisi', 'required');
        $this->form_validation->set_rules('nama_pemilik', 'nama_pemilik', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('pengguna_kendaraan', 'pengguna_kendaraan', 'required');
        $this->form_validation->set_rules('id_merek', 'id_merek', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('jenis', 'jenis', 'required');
        $this->form_validation->set_rules('model', 'model', 'required');
        $this->form_validation->set_rules('tahun_pembuatan', 'tahun_pembuatan', 'required');
        $this->form_validation->set_rules('silinder', 'silinder', 'required');
        $this->form_validation->set_rules('nomor_rangka', 'nomor_rangka', 'required');
        $this->form_validation->set_rules('nomor_mesin', 'nomor_mesin', 'required');
        $this->form_validation->set_rules('warna', 'warna', 'required');
        $this->form_validation->set_rules('id_bahan_bakar', 'id_bahan_bakar', 'required');
        $this->form_validation->set_rules('warna_tnkb', 'warna_tnkb', 'required');
        $this->form_validation->set_rules('tahun_registrasi', 'tahun_registrasi', 'required');
        $this->form_validation->set_rules('nomor_bpkb', 'nomor_bpkb', 'required');
        $this->form_validation->set_rules('tanggal_berlaku', 'tanggal_berlaku', 'required');
        $this->form_validation->set_rules('berat_kb', 'berat_kb', 'required');
        $this->form_validation->set_rules('jumlah_sumbu', 'jumlah_sumbu', 'required');
        $this->form_validation->set_rules('jbb_penumpang', 'jbb_penumpang', 'required');
        $this->form_validation->set_rules('harga_pembelian', 'harga_pembelian', 'required');
        $this->form_validation->set_rules('tahun_penyusutan', 'tahun_penyusutan', 'required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');

        if ($this->form_validation->run() ==  false) {
            $data['merek'] = $this->db->get('jenis_kendaraan')->result_array();
            $data['bahan_bakar'] = $this->db->get('jenis_bahan_bakar')->result_array();
            $data['list_assets'] = $this->db->get('jenis_assets')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kendaraan/form-add', $data);
            $this->load->view('templates/footer');
        } else {

            $id = $this->input->post('id');
            $kode_qr = $this->input->post('kode_qr');
            $kode_opd = $this->input->post('kode_opd');
            $jenis_assets = $this->input->post('jenis_assets');
            $nomor_polisi = $this->input->post('nomor_polisi');
            $nama_pemilik = $this->input->post('nama_pemilik');
            $alamat = $this->input->post('alamat');
            $pengguna_kendaraan = $this->input->post('pengguna_kendaraan');
            $id_merek = $this->input->post('id_merek');
            $type = $this->input->post('type');
            $jenis = $this->input->post('jenis');
            $model = $this->input->post('model');
            $tahun_pembuatan = $this->input->post('tahun_pembuatan');
            $silinder = $this->input->post('silinder');
            $nomor_rangka = $this->input->post('nomor_rangka');
            $nomor_mesin = $this->input->post('nomor_mesin');
            $warna = $this->input->post('warna');
            $id_bahan_bakar = $this->input->post('id_bahan_bakar');
            $warna_tnkb = $this->input->post('warna_tnkb');
            $tahun_registrasi = $this->input->post('tahun_registrasi');
            $nomor_bpkb = $this->input->post('nomor_bpkb');
            $tanggal_berlaku = $this->input->post('tanggal_berlaku');
            $berat_kb = $this->input->post('berat_kb');
            $jumlah_sumbu = $this->input->post('jumlah_sumbu');
            $jbb_penumpang = $this->input->post('jbb_penumpang');
            $harga_pembelian = $this->input->post('harga_pembelian');
            $tahun_penyusutan = $this->input->post('tahun_penyusutan');
            $keterangan = $this->input->post('keterangan');


            // gambar depan
            $upload_image = $_FILES['gambar_depan']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar_depan')) {
                    $old_image = $data['kendaraan']['gambar_depan'];
                    if ($old_image != 'mobil-depan.png') {
                        unlink(FCPATH . 'assets/img/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar_depan', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Upload Image Filed!</div>');
                    redirect('transaksi/kendaraan');
                }
            }
            // end gambar depan


            // gambar belakang
            $upload_image = $_FILES['gambar_belakang']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar_belakang')) {
                    $old_image = $data['kendaraan']['gambar_belakang'];
                    if ($old_image != 'mobil-belakang.png') {
                        unlink(FCPATH . 'assets/img/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar_belakang', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Upload Image Filed!</div>');
                    redirect('transaksi/kendaraan');
                }
            }
            // end gambar belakang

            // gambar samping kiri
            $upload_image = $_FILES['gambar_samping_kiri']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar_samping_kiri')) {
                    $old_image = $data['kendaraan']['gambar_samping_kiri'];
                    if ($old_image != 'mobil-kiri.png') {
                        unlink(FCPATH . 'assets/img/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar_samping_kiri', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Upload Image Filed!</div>');
                    redirect('transaksi/kendaraan');
                }
            }
            // end gambar sampoeng kiri

            // gambar samping kanan
            $upload_image = $_FILES['gambar_samping_kanan']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar_samping_kanan')) {
                    $old_image = $data['kendaraan']['gambar_samping_kanan'];
                    if ($old_image != 'mobil-kanan.png') {
                        unlink(FCPATH . 'assets/img/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar_samping_kanan', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Upload Image Filed!</div>');
                    redirect('transaksi/kendaraan');
                }
            }
            // end gambar samping kanan


            $this->db->set('kode_qr', $kode_qr);
            $this->db->set('kode_opd', $kode_opd);
            $this->db->set('jenis_assets', $jenis_assets);
            $this->db->set('nomor_polisi', $nomor_polisi);
            $this->db->set('nama_pemilik', $nama_pemilik);
            $this->db->set('alamat', $alamat);
            $this->db->set('pengguna_kendaraan', $pengguna_kendaraan);
            $this->db->set('id_merek', $id_merek);
            $this->db->set('type', $type);
            $this->db->set('model', $model);
            $this->db->set('tahun_pembuatan', $tahun_pembuatan);
            $this->db->set('silinder', $silinder);
            $this->db->set('nomor_rangka', $nomor_rangka);
            $this->db->set('nomor_mesin', $nomor_mesin);
            $this->db->set('warna', $warna);
            $this->db->set('id_bahan_bakar', $id_bahan_bakar);
            $this->db->set('jenis', $jenis);
            $this->db->set('warna_tnkb', $warna_tnkb);
            $this->db->set('tahun_registrasi', $tahun_registrasi);
            $this->db->set('nomor_bpkb', $nomor_bpkb);
            $this->db->set('tanggal_berlaku', $tanggal_berlaku);
            $this->db->set('berat_kb', $berat_kb);
            $this->db->set('jumlah_sumbu', $jumlah_sumbu);
            $this->db->set('jbb_penumpang', $jbb_penumpang);
            $this->db->set('harga_pembelian', str_replace(',', '', $harga_pembelian));
            $this->db->set('tahun_penyusutan', $tahun_penyusutan);
            $this->db->set('keterangan', $keterangan);
            $this->db->set('update_date', date('Y-m-d H:i:s'));
            $this->db->set('update_by', $this->session->userdata('email'));

            $this->db->where('id', $id);
            $this->db->update('kendaraan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Success Kendaraan Update!</div>');
            redirect('transaksi/kendaraan');
        }
    }


    public function delete_kendaraan($id)
    {
        $delete = $this->transaksi_model->delete_kendaraan_id($id);
        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success</div>');
            redirect('transaksi/kendaraan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal</div>');
            redirect('transaksi/kendaraan');
        }
    }



    public function save_transaksi()
    {
        $data['title'] = 'Form Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->form_validation->set_rules('code', 'Code', 'required');
        $this->form_validation->set_rules('nomor_polisi', 'nomor_polisi', 'required');
        $this->form_validation->set_rules('tanggal_perawatan', 'tanggal_perawatan', 'required');
        $this->form_validation->set_rules('jenis_perawatan', 'jenis_perawatan', 'required');
        $this->form_validation->set_rules('kilometer_kendaraan', 'kilometer_kendaraan', 'required');
        $this->form_validation->set_rules('kode_akun', 'kode_akun', 'required');

        $this->form_validation->set_rules('nama_barang', 'nama_barang', 'required');
        $this->form_validation->set_rules('volume', 'volume', 'required');
        $this->form_validation->set_rules('satuan', 'satuan', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required');

        if ($this->form_validation->run() ==  true) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/form_add_transaksi', $data);
            $this->load->view('templates/footer');
        } else {
            $date = date('Y-m-d H:i:s');
            $data = [
                'code' => $this->input->post('code'),
                'nomor_polisi' => $this->input->post('nomor_polisi'),
                'tanggal_perawatan' => $this->input->post('tanggal_perawatan'),
                'jenis_perawatan' => $this->input->post('jenis_perawatan'),
                'kilometer_kendaraan' => $this->input->post('kilometer_kendaraan'),
                'kode_akun' => $this->input->post('kode_akun'),
                'created_date' => $date,
                'created_user' => $this->session->userdata('email')
            ];
            $this->db->insert('transaksi', $data);

            // update status nota dinas 
            $this->db->set('status', 3);
            $this->db->set('code', $this->input->post('code'));
            $this->db->where('no_polisi', $this->input->post('nomor_polisi'));
            $this->db->update('nota_dinas');
            // end

            $nama_barang            = $this->input->post('nama_barang');
            $volume                 = $this->input->post('volume');
            $satuan                 = $this->input->post('satuan');
            $harga                  = $this->input->post('harga');

            $data1 = array();
            $index = 0;
            foreach ($nama_barang as $k) {
                array_push($data1, array(
                    'code_transaksi'      => $this->input->post('code'),
                    'nama_barang'         => $k,
                    'volume'              => $volume[$index],
                    'satuan'              => strtoupper($satuan[$index]),
                    'harga'               => $harga[$index],
                    'jumlah'              => $volume[$index] * $harga[$index],
                    'created_date'        => $date,
                    'created_user'        => $this->session->userdata('email')
                ));
                $index++;
            }
            $this->db->insert_batch('transaksi_detail', $data1);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi added!</div>');
            redirect('transaksi');
        }
    }


    public function delete($id, $code)
    {

        $delete = $this->transaksi_model->delete($id);
        $delete = $this->transaksi_model->delete_detail($code);

        // update status nota dinas 
        $this->db->set('status', 1);
        $this->db->where('code', $code);
        $this->db->update('nota_dinas');
        // end

        if ($delete) {
            redirect('transaksi');
        } else {
            redirect('transaksi');
        }
    }


    public function form_edit_transaksi()
    {
        $id = $this->uri->segment(3);
        $code = $this->uri->segment(4);

        $data['title'] = 'Form Edit Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jenis_perawatan'] = $this->db->get('jenis_perawatan')->result_array();
        $data['kendaraan_notadinas'] = $this->transaksi_model->get_kendaraan_nota_dinas();

        $data['jenis_kendaraan'] = $this->db->get('kendaraan')->result_array();


        $data['transaksi']  = $this->transaksi_model->get_transaksi_by_id($id);
        $data['transaksi_detail'] = $this->transaksi_model->get_transaksi_detail_by_code($code);

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/form-edit', $data);
        $this->load->view('templates/footer', $data);
    }

    public function delete_items($id, $id_detail, $code_transaksi)
    {
        $delete = $this->transaksi_model->delete_detail_by_id($id_detail);
        if ($delete) {
            redirect('transaksi/form_edit_transaksi/' . $id . '/' . $code_transaksi);
        } else {
            redirect('transaksi/form_edit_transaksi/' . $id . '/' . $code_transaksi);
        }
    }

    public function save_edit_transaksi($id)
    {
        $data['title'] = 'Form Edit Transaksi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('code', 'Code', 'required');
        $this->form_validation->set_rules('nomor_polisi', 'nomor_polisi', 'required');
        $this->form_validation->set_rules('tanggal_perawatan', 'tanggal_perawatan', 'required');
        $this->form_validation->set_rules('jenis_perawatan', 'jenis_perawatan', 'required');
        $this->form_validation->set_rules('kilometer_kendaraan', 'kilometer_kendaraan', 'required');

        $this->form_validation->set_rules('nama_barang', 'nama_barang', 'required');
        $this->form_validation->set_rules('volume', 'volume', 'required');
        $this->form_validation->set_rules('satuan', 'satuan', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required');

        if ($this->form_validation->run() ==  true) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/form_add_transaksi', $data);
            $this->load->view('templates/footer');
        } else {
            $date = date('Y-m-d H:i:s');
            $data = [
                'code' => $this->input->post('code'),
                'nomor_polisi' => $this->input->post('nomor_polisi'),
                'tanggal_perawatan' => $this->input->post('tanggal_perawatan'),
                'jenis_perawatan' => $this->input->post('jenis_perawatan'),
                'kilometer_kendaraan' => $this->input->post('kilometer_kendaraan'),
                'created_date' => $date,
                'created_user' => $this->session->userdata('email')
            ];
            $this->db->where('id', $id);
            $this->db->update('transaksi', $data);

            $this->transaksi_model->delete_detail($this->input->post('code'));

            $nama_barang            = $this->input->post('nama_barang');
            $volume                 = $this->input->post('volume');
            $satuan                 = $this->input->post('satuan');
            $harga                  = $this->input->post('harga');
            $jumlah                 = $this->input->post('jumlah');

            $data1 = array();
            $index = 0;
            foreach ($nama_barang as $k) {
                array_push($data1, array(
                    'code_transaksi'      => $this->input->post('code'),
                    'nama_barang'         => $k,
                    'volume'              => $volume[$index],
                    'satuan'              => strtoupper($satuan[$index]),
                    'harga'               => $harga[$index],
                    'jumlah'              => $jumlah[$index],
                    'created_date'        => $date,
                    'created_user'        => $this->session->userdata('email')
                ));
                $index++;
            }
            $this->db->insert_batch('transaksi_detail', $data1);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi Update!</div>');
            redirect('transaksi');
        }
    }


    public function nota_dinas()
    {
        $data['title'] = 'Nota Dinas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nota_dinas'] = $this->transaksi_model->get_join_nota_dinas();
        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['vendor'] = $this->db->get('vendor')->result_array();

        $data['kendaraan_opd'] = $this->transaksi_model->get_join_kendaraan();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();
        $data['list_opd'] = $this->db->get('master_opd')->result_array();

        $this->form_validation->set_rules('kode_opd', 'kode_opd', 'required');
        $this->form_validation->set_rules('nomor_nota_dinas', 'nomor_nota_dinas', 'required');
        $this->form_validation->set_rules('kepada', 'kepada', 'required');
        $this->form_validation->set_rules('dari', 'dari', 'required');
        $this->form_validation->set_rules('tanggal_permohonan', 'tanggal_permohonan', 'required');
        $this->form_validation->set_rules('perihal', 'perihal', 'required');
        $this->form_validation->set_rules('no_polisi', 'no_polisi', 'required');
        $this->form_validation->set_rules('rincian_penggantian', 'rincian_penggantian', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('nota_dinas/index', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $config['upload_path'] = './uploads/nota_dinas';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 2000;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('dokumen')) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Upload Dokumen!</div>');
                redirect('transaksi/nota_dinas');
            } else {
                $new_pdf = $this->upload->data('file_name');
                $this->db->set('dokumen', $new_pdf);
            }

            $this->db->insert('nota_dinas', [
                'kode_opd' => $this->input->post('kode_opd'),
                'nomor_nota_dinas' => $this->input->post('nomor_nota_dinas'),
                'kepada' => $this->input->post('kepada'),
                'dari' => $this->input->post('dari'),
                'tanggal_permohonan' => $this->input->post('tanggal_permohonan'),
                'perihal' => $this->input->post('perihal'),
                'no_polisi' => $this->input->post('no_polisi'),
                'status' => 1,
                'created_date' => date('Y-m-d H:i:s'),
                'created_user' => $this->session->userdata('email'),
                'rincian_penggantian' => $this->input->post('rincian_penggantian')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New added!</div>');
            redirect('transaksi/nota_dinas');
        }
    }

    public function delete_notadinas($id)
    {
        $delete = $this->transaksi_model->delete_nota_dinas_id($id);
        if ($delete) {
            redirect('transaksi/nota_dinas');
        } else {
            redirect('transaksi/nota_dinas');
        }
    }



    // public function aprov_nota_dinas($id)
    // {
    //     $data = array(
    //         'status'         => 2,
    //         'update_user'    => $this->session->userdata('email'),
    //         'update_date'    => date('Y-m-d H:i:s')
    //     );

    //     $update = $this->transaksi_model->update_nota_dinas_id($id, $data);
    //     if ($update) {
    //         redirect('transaksi/nota_dinas');
    //     } else {
    //         redirect('transaksi/nota_dinas');
    //     }
    // }


    function get_kode_akun_anggaran()
    {
        $kode_akun = $this->input->post('kode_akun');
        $data = $this->transaksi_model->get_kode_akun_id($kode_akun);
        echo json_encode($data);
    }

    public function update_nota_dinas()
    {
        $data['title'] = 'Update Nota Dinas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nota_dinas'] = $this->db->get('nota_dinas')->result_array();
        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();

        $this->form_validation->set_rules('kode_opd', 'kode_opd', 'required');
        $this->form_validation->set_rules('nomor_nota_dinas', 'nomor_nota_dinas', 'required');
        $this->form_validation->set_rules('kepada', 'kepada', 'required');
        $this->form_validation->set_rules('dari', 'dari', 'required');
        $this->form_validation->set_rules('tanggal_permohonan', 'tanggal_permohonan', 'required');
        $this->form_validation->set_rules('perihal', 'perihal', 'required');
        $this->form_validation->set_rules('no_polisi', 'no_polisi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('nota_dinas/index', $data);
            $this->load->view('templates/footer');
        } else {

            $config['upload_path'] = './uploads/nota_dinas';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 2000;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('dokumen')) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Upload Dokumen!</div>');
                redirect('transaksi/nota_dinas');
            } else {
                $new_pdf = $this->upload->data('file_name');
                $this->db->set('dokumen', $new_pdf);
            }

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('nota_dinas', [
                'kode_opd' => $this->input->post('kode_opd'),
                'nomor_nota_dinas' => $this->input->post('nomor_nota_dinas'),
                'kepada' => $this->input->post('kepada'),
                'dari' => $this->input->post('dari'),
                'tanggal_permohonan' => $this->input->post('tanggal_permohonan'),
                'perihal' => $this->input->post('perihal'),
                'no_polisi' => $this->input->post('no_polisi'),
                'rincian_penggantian' => $this->input->post('rincian_penggantian'),
                'status' => 1,
                'update_date' => date('Y-m-d H:i:s'),
                'update_user' => $this->session->userdata('email')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Update!</div>');
            redirect('transaksi/nota_dinas');
        }
    }

    public function approval_nota_dinas()
    {
        $data['title'] = 'Aproval Nota Dinas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('vendor', 'vendor', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('nota_dinas/index', $data);
            $this->load->view('templates/footer');
        } else {

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('nota_dinas', [
                'status' => 2,
                'vendor' => $this->input->post('vendor'),
                'update_date' => date('Y-m-d H:i:s'),
                'update_user' => $this->session->userdata('email')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success</div>');
            redirect('transaksi/nota_dinas');
        }
    }
}
