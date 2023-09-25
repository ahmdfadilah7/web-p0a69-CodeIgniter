<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_data');
        $this->load->library('upload');
    }

	public function login()
	{
        $data['view'] = 'auth/login';
        $data['rekening'] = $this->db->query("SELECT * FROM rekening");
        $data['settings'] = $this->db->query("SELECT * FROM setting")->row();

        $this->load->view('layouts/app', $data);
	}

    public function register()
	{
        $data['view'] = 'auth/register';
        $data['rekening'] = $this->db->query("SELECT * FROM rekening");
        $data['settings'] = $this->db->query("SELECT * FROM setting")->row();

        $this->load->view('layouts/app', $data);
	}

    public function proses_login()
    {
        //form validasi
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_message('required', '{field} Wajib Diisi!!!');
        if($this->form_validation->run()==FALSE){
            $errors = $this->form_validation->error_array();
			$this->session->set_flashdata('gagal', $errors);
            redirect(base_url('auth/login'));
            die();
        }        

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
            'username' => $username,
            'password' => md5($password)
        );
        $cek = $this->M_data->cek_login('user', $where);

        if ($cek->num_rows() == 1) {

            $dataadmin = $cek->result_array();

            foreach ($dataadmin as $h) {
                $id_user = $h['id'];
                $nama = $h['nama_user'];
                $username = $h['username'];
                $foto = $h['foto'];
                $role = $h['role'];
                $alamat = $h['alamat'];
                $email = $h['email'];
                $no_telp = $h['no_telp'];
            }

            if ($role == 'Admin') {
                $data_session = array(
                    'status' => 'login',
                    'nama' => $nama,
                    'username' => $username,
                    'id_admin' => $id_user,
                    'foto' => $foto,
                    'role' => 'Admin'
                );
    
                $this->session->set_userdata($data_session);
                $this->session->set_flashdata('berhasil', 'Selamat datang <strong>'.$this->session->userdata('nama').'</strong>');

                redirect(base_url('admin/dashboard'));
            } else {
                $data_session = array(
                    'status_pelanggan' => 'login',
                    'nama_pelanggan' => $nama,
                    'username_pelanggan' => $username,
                    'id_pelanggan' => $id_user,
                    'alamat_pelanggan' => $alamat,
                    'email_pelanggan' => $email,
                    'no_telp_pelanggan' => $no_telp,
                    'foto_pelanggan' => $foto,
                    'role_pelanggan' => 'Pelanggan'
                );
    
                $this->session->set_userdata($data_session);
                $this->session->set_flashdata('berhasil', 'Selamat datang <strong>'.$this->session->userdata('nama_pelanggan').'</strong>');
                redirect(base_url('home'));
            }
        } else {
            $errors = array("Username dan Password tidak cocok!!!");
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('auth/login'));
        }
    }

    public function proses_register()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required');
        $this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_check_strong_password');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('auth/register'));
        } else {
            $insert['nama_user'] = $this->input->post('nama');
            $insert['email'] = $this->input->post('email');
            $insert['no_telp'] = $this->input->post('no_telp');
            $insert['jns_kelamin'] = $this->input->post('jns_kelamin');
            $insert['alamat'] = $this->input->post('alamat');
            $insert['username'] = $this->input->post('username');
            $insert['password'] = md5($this->input->post('password'));
            $insert['role'] = 'Pelanggan';

            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
            $dname = explode(".", $_FILES['foto']['name']);
            $ext = end($dname);
            $nama = 'Pelanggan'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
            } else {
                $upload_data = $this->upload->data();

                $insert['foto'] = 'assets/images/'.$nama;
            }
            $this->M_data->insert($insert, 'user');

            $this->session->set_flashdata('berhasil', 'Register berhasil.');
            redirect(base_url('auth/login'));
        }
    }

    public function check_strong_password($str)
    {
       if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
         return TRUE;
       }
       $this->form_validation->set_message('check_strong_password', 'The password field must be contains at least one letter and one digit.');
       return FALSE;
    }

    public function logout($role){    

        if ($role == 'Pelanggan') {
            $data_session = array(
                'status_pelanggan',
                'nama_pelanggan',
                'username_pelanggan',
                'id_pelanggan',
                'alamat_pelanggan',
                'email_pelanggan',
                'no_telp_pelanggan',
                'foto_pelanggan',
                'role_pelanggan' 
            );
        } elseif ($role == 'Admin') {
            $data_session = array(
                'status',
                'nama',
                'username',
                'id_admin',
                'foto',
                'role'
            );
        }

        $this->session->unset_userdata($data_session);    
		redirect(base_url('auth/login'));
    }
}
