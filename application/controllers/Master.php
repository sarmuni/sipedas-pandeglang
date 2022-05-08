<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('transaksi_model');
    }

    ########################## New Jenis Kendaraan ##########################
    public function kendaraan()
    {
        $data['title'] = 'Master Jenis Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jenis_kendaraan'] = $this->db->get('jenis_kendaraan')->result_array();

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();

        $this->form_validation->set_rules('nama_jenis_kendaraan', 'Jenis Kendaraan', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jenis/kendaraan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('jenis_kendaraan', ['nama_jenis_kendaraan' => $this->input->post('nama_jenis_kendaraan')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New added!</div>');
            redirect('master/kendaraan');
        }
    }

    public function update_jenis_kendaraan()
    {
        $data['title'] = 'Edit Save Jenis Kendaraan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->form_validation->set_rules('nama_jenis_kendaraan', 'Nama Jenis Kendaraan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jenis/kendaraan', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $nama_jenis_kendaraan = $this->input->post('nama_jenis_kendaraan');
            $this->db->set('nama_jenis_kendaraan', $nama_jenis_kendaraan);
            $this->db->where('id', $id);
            $this->db->update('jenis_kendaraan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your updated!</div>');
            redirect('master/kendaraan');
        }
    }

    public function delete_jenis_kendaraan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jenis_kendaraan');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your deleted!</div>');
        redirect('master/kendaraan');
    }

    ########################## End Jenis Kendaraan ##########################


    ########################## New Jenis Perawatan ##########################
    public function perawatan()
    {
        $data['title'] = 'Master Jenis Perawatan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jenis_perawatan'] = $this->db->get('jenis_perawatan')->result_array();

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();

        $this->form_validation->set_rules('nama_jenis_perawatan', 'Jenis Perawatan', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jenis/perawatan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('jenis_perawatan', ['nama_jenis_perawatan' => $this->input->post('nama_jenis_perawatan')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New added!</div>');
            redirect('master/perawatan');
        }
    }

    public function update_jenis_perawatan()
    {
        $data['title'] = 'Edit Save Jenis Perawatan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama_jenis_perawatan', 'Nama Jenis Perawatan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jenis/perawatan', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $nama_jenis_perawatan = $this->input->post('nama_jenis_perawatan');
            $this->db->set('nama_jenis_perawatan', $nama_jenis_perawatan);
            $this->db->where('id', $id);
            $this->db->update('jenis_perawatan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your updated!</div>');
            redirect('master/perawatan');
        }
    }

    public function delete_jenis_perawatan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jenis_perawatan');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your deleted!</div>');
        redirect('master/perawatan');
    }

    ########################## End Jenis Perawatan ##########################

    ########################## New Jenis Bahan Bakar ##########################
    public function bahan_bakar()
    {
        $data['title'] = 'Master Jenis Bahan Bakar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jenis_bahan_bakar'] = $this->db->get('jenis_bahan_bakar')->result_array();

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();

        $this->form_validation->set_rules('nama_bahan_bakar', 'Jenis Perawatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jenis/bahan_bakar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('jenis_bahan_bakar', ['nama_bahan_bakar' => $this->input->post('nama_bahan_bakar')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New added!</div>');
            redirect('master/bahan_bakar');
        }
    }

    public function update_jenis_bahan_bakar()
    {
        $data['title'] = 'Edit Save Jenis Bahan Bakar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama_bahan_bakar', 'Nama Jenis Bahan Bakar', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jenis/bahan_bakar', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $nama_bahan_bakar = $this->input->post('nama_bahan_bakar');
            $this->db->set('nama_bahan_bakar', $nama_bahan_bakar);
            $this->db->where('id', $id);
            $this->db->update('jenis_bahan_bakar');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your updated!</div>');
            redirect('master/bahan_bakar');
        }
    }

    public function delete_jenis_bahan_bakar($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jenis_bahan_bakar');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your deleted!</div>');
        redirect('master/bahan_bakar');
    }
    ########################## End Jenis Bahan Bakar ##########################


    ########################## New Vendor ##########################
    public function vendor()
    {
        $data['title'] = 'Master Vendor';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['vendor'] = $this->db->get('vendor')->result_array();

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();

        $this->form_validation->set_rules('nama_vendor', 'nama vendor', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('vendor/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('vendor', [
                'nama_vendor' => $this->input->post('nama_vendor'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New added!</div>');
            redirect('master/vendor');
        }
    }

    public function update_vendor()
    {
        $data['title'] = 'Edit Save Vendor';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama_vendor', 'Nama', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('vendor/index', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $nama_vendor = $this->input->post('nama_vendor');
            $alamat = $this->input->post('alamat');
            $no_telp = $this->input->post('no_telp');

            $this->db->set('nama_vendor', $nama_vendor);
            $this->db->set('alamat', $alamat);
            $this->db->set('no_telp', $no_telp);
            $this->db->where('id', $id);
            $this->db->update('vendor');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your updated!</div>');
            redirect('master/vendor');
        }
    }

    public function delete_vendor($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('vendor');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your deleted!</div>');
        redirect('master/vendor');
    }
    ########################## End Vendor ##########################


    ########################## New Anggaran ##########################
    public function anggaran()
    {
        $data['title'] = 'Master Anggaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['master_anggaran'] = $this->transaksi_model->master_anggaran();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();

        $data['list_opd'] = $this->db->get('master_opd')->result_array();

        $this->form_validation->set_rules('kode_akun', 'kode_akun', 'required');
        $this->form_validation->set_rules('kode_opd', 'kode_opd', 'required');
        $this->form_validation->set_rules('nama_akun', 'nama_akun', 'required');
        $this->form_validation->set_rules('tahun_anggaran', 'tahun_anggaran', 'required');
        $this->form_validation->set_rules('jan', 'jan', 'required');
        $this->form_validation->set_rules('feb', 'feb', 'required');
        $this->form_validation->set_rules('mar', 'mar', 'required');
        $this->form_validation->set_rules('apr', 'apr', 'required');
        $this->form_validation->set_rules('mei', 'mei', 'required');
        $this->form_validation->set_rules('jun', 'jun', 'required');
        $this->form_validation->set_rules('jul', 'jul', 'required');
        $this->form_validation->set_rules('ags', 'ags', 'required');
        $this->form_validation->set_rules('sep', 'sep', 'required');
        $this->form_validation->set_rules('okt', 'okt', 'required');
        $this->form_validation->set_rules('nov', 'nov', 'required');
        $this->form_validation->set_rules('des', 'des', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('anggaran/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('anggaran', [
                'kode_opd' => $this->input->post('kode_opd'),
                'kode_akun' => $this->input->post('kode_akun'),
                'nama_akun' => $this->input->post('nama_akun'),
                'tahun_anggaran' => $this->input->post('tahun_anggaran'),
                'jan' => $this->input->post('jan'),
                'feb' => $this->input->post('feb'),
                'mar' => $this->input->post('mar'),
                'apr' => $this->input->post('apr'),
                'mei' => $this->input->post('mei'),
                'jun' => $this->input->post('jun'),
                'jul' => $this->input->post('jul'),
                'ags' => $this->input->post('ags'),
                'sep' => $this->input->post('sep'),
                'okt' => $this->input->post('okt'),
                'nov' => $this->input->post('nov'),
                'des' => $this->input->post('des'),
                'created_date' => date('Y-m-d H:i:s'),
                'creted_user' => $this->session->userdata('email')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New added!</div>');
            redirect('master/anggaran');
        }
    }

    public function update_anggaran()
    {
        $data['title'] = 'Edit Save Anggaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('kode_opd', 'Kode OPD', 'required|trim');
        $this->form_validation->set_rules('kode_akun', 'Kode Akun', 'required|trim');
        $this->form_validation->set_rules('nama_akun', 'nama akun', 'required|trim');
        $this->form_validation->set_rules('tahun_anggaran', 'No Telp', 'required|trim');
        $this->form_validation->set_rules('jan', 'jan', 'required|trim');
        $this->form_validation->set_rules('feb', 'feb', 'required|trim');
        $this->form_validation->set_rules('mar', 'mar', 'required|trim');
        $this->form_validation->set_rules('apr', 'apr', 'required|trim');
        $this->form_validation->set_rules('mei', 'mei', 'required|trim');
        $this->form_validation->set_rules('jun', 'jun', 'required|trim');
        $this->form_validation->set_rules('jul', 'jul', 'required|trim');
        $this->form_validation->set_rules('ags', 'ags', 'required|trim');
        $this->form_validation->set_rules('sep', 'sep', 'required|trim');
        $this->form_validation->set_rules('okt', 'okt', 'required|trim');
        $this->form_validation->set_rules('nov', 'nov', 'required|trim');
        $this->form_validation->set_rules('des', 'des', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('anggaran/index', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $kode_opd = $this->input->post('kode_opd');
            $kode_akun = $this->input->post('kode_akun');
            $nama_akun = $this->input->post('nama_akun');
            $tahun_anggaran = $this->input->post('tahun_anggaran');
            $jan = $this->input->post('jan');
            $feb = $this->input->post('feb');
            $mar = $this->input->post('mar');
            $apr = $this->input->post('apr');
            $mei = $this->input->post('mei');
            $jun = $this->input->post('jun');
            $jul = $this->input->post('jul');
            $ags = $this->input->post('ags');
            $sep = $this->input->post('sep');
            $okt = $this->input->post('okt');
            $nov = $this->input->post('nov');
            $des = $this->input->post('des');

            $this->db->set('kode_opd', $kode_opd);
            $this->db->set('kode_akun', $kode_akun);
            $this->db->set('nama_akun', $nama_akun);
            $this->db->set('tahun_anggaran', $tahun_anggaran);
            $this->db->set('jan', str_replace(',', '', $jan));
            $this->db->set('feb', str_replace(',', '', $feb));
            $this->db->set('mar', str_replace(',', '', $mar));
            $this->db->set('apr', str_replace(',', '', $apr));
            $this->db->set('mei', str_replace(',', '', $mei));
            $this->db->set('jun', str_replace(',', '', $jun));
            $this->db->set('jul', str_replace(',', '', $jul));
            $this->db->set('ags', str_replace(',', '', $ags));
            $this->db->set('sep', str_replace(',', '', $sep));
            $this->db->set('okt', str_replace(',', '', $okt));
            $this->db->set('nov', str_replace(',', '', $nov));
            $this->db->set('des', str_replace(',', '', $des));
            $this->db->set('update_date', date('Y-m-d H:i:s'));
            $this->db->set('update_user', $this->session->userdata('email'));

            $this->db->where('id', $id);
            $this->db->update('anggaran');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your updated!</div>');
            redirect('master/anggaran');
        }
    }

    public function delete_anggaran($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('anggaran');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your deleted!</div>');
        redirect('master/anggaran');
    }

    ########################## End Anggaran ##########################
}
