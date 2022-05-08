<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('transaksi_model');
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer', $data);
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }


    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    ////////////////////////////////OPD////////////////////////////////////////////

    public function opd()
    {
        if ($this->session->userdata('opd') == '1') {
            # admin
            $data['title'] = 'Organisasi Perangkat Daerah';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();
            $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
            $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

            $data['master_opd'] = $this->db->get('master_opd')->result_array();

            $this->form_validation->set_rules('kode_opd', 'Kode OPD', 'required');
            $this->form_validation->set_rules('nama_opd', 'Nama OPD', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            $this->form_validation->set_rules('telpon', 'Telpon', 'required');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/opd', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $this->db->insert('master_opd', [
                    'kode_opd' => $this->input->post('kode_opd'),
                    'nama_opd' => $this->input->post('nama_opd'),
                    'alamat' => $this->input->post('alamat'),
                    'telpon' => $this->input->post('telpon')
                ]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New added!</div>');
                redirect('user/opd');
            }
        } else {
            #user
            $data['title'] = 'Organisasi Perangkat Daerah';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $data['kendaraan'] = $this->db->get('kendaraan')->result_array();
            $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
            $data['anggaran'] = $this->transaksi_model->get_join_anggaran();

            $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();

            $this->form_validation->set_rules('kode_opd', 'Kode OPD', 'required|trim');
            $this->form_validation->set_rules('nama_opd', 'Nama OPD / Instansi', 'required|trim');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
            $this->form_validation->set_rules('telpon', 'Telpon', 'required|trim');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/opd_user', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $id = $this->input->post('id');
                $kode_opd = $this->input->post('kode_opd');
                $nama_opd = $this->input->post('nama_opd');
                $alamat = $this->input->post('alamat');
                $telpon = $this->input->post('telpon');

                $this->db->set('kode_opd', $kode_opd);
                $this->db->set('nama_opd', $nama_opd);
                $this->db->set('alamat', $alamat);
                $this->db->set('telpon', $telpon);
                $this->db->where('id', $id);
                $this->db->update('master_opd');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">OPD updated!</div>');
                redirect('user/opd');
            }
        }
    }


    public function update_opd()
    {
        $data['title'] = 'Edit Save OPD';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['opd'] = $this->db->get_where('master_opd', ['id' => $this->session->userdata('opd')])->row_array();
        $data['perawatan'] = $this->transaksi_model->get_join_perawatan();
        $data['anggaran'] = $this->transaksi_model->get_join_anggaran();
        $data['master_opd'] = $this->db->get('master_opd')->result_array();

        $this->form_validation->set_rules('kode_opd', 'Kode OPD', 'required|trim');
        $this->form_validation->set_rules('nama_opd', 'Nama OPD Instansi', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('telpon', 'Telpon', 'required|trim');



        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/opd', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $id = $this->input->post('id');
            $kode_opd = $this->input->post('kode_opd');
            $nama_opd = $this->input->post('nama_opd');
            $alamat = $this->input->post('alamat');
            $telpon = $this->input->post('telpon');


            $this->db->set('kode_opd', $kode_opd);
            $this->db->set('nama_opd', $nama_opd);
            $this->db->set('alamat', $alamat);
            $this->db->set('telpon', $telpon);
            $this->db->set('update_date', date('Y-m-d H:i:s'));
            $this->db->set('update_by', $this->session->userdata('email'));

            $this->db->where('id', $id);
            $this->db->update('master_opd');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your updated!</div>');
            redirect('user/opd');
        }
    }

    public function delete_opd($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('master_opd');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your deleted!</div>');
        redirect('user/opd');
    }

    /////////////////////////////////END OPD////////////////////////////////////////
}
