<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status') != 'login'){
            redirect('auth/login');
        }
        $this->load->model('M_data');
        $this->load->library('upload');
    }

	public function index()
	{
		$data['view'] = 'admin/setting/index';
        $data['setting'] = $this->M_data->selectDataWhere('*', 'setting');
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);
	}

    public function edit($id) 
    {
        $data['view'] = 'admin/setting/edit';
        $data['setting'] = $this->M_data->selectDataWhere('*', 'setting', 'id', $id)->row();
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);        
    }

    public function update($id) 
    {
        $this->form_validation->set_rules('nama_website', 'Nama Website', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('google_map', 'Google Map', 'required');
        $this->form_validation->set_message('required', '{field} Wajib Diisi!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/setting/edit/'.$id));
        } else {
            $insert['nama_website'] = $this->input->post('nama_website');
            $insert['email'] = $this->input->post('email');
            $insert['no_telp'] = $this->input->post('no_telp');
            $insert['alamat'] = $this->input->post('alamat');
            $insert['google_map'] = $this->input->post('google_map');
            $insert['facebook'] = $this->input->post('facebook');
            $insert['twitter'] = $this->input->post('twitter');
            $insert['instagram'] = $this->input->post('instagram');
            $insert['youtube'] = $this->input->post('youtube');
            
            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF|ico';
            $dname = explode(".", $_FILES['logo']['name']);
            $ext = end($dname);
            $nama = 'Logo'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('logo')) {
            } else {
                $upload_data = $this->upload->data();

                $insert['logo'] = 'assets/images/'.$nama;
            }

            $config2['upload_path'] = "assets/images/";
            $config2['overwrite'] = TRUE;            
            $config2['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF|ico';
            $dname2 = explode(".", $_FILES['favicon']['name']);
            $ext2 = end($dname2);
            $nama2 = 'Favicon'."-".time().'-'.rand(100,999).".".$ext2;
            $config2['file_name'] = $nama2;
            $config2['remove_spaces'] = FALSE;
            $this->upload->initialize($config2);
            if (!$this->upload->do_upload('favicon')) {
            } else {
                $upload_data = $this->upload->data();

                $insert['favicon'] = 'assets/images/'.$nama2;
            }

            $config3['upload_path'] = "assets/images/";
            $config3['overwrite'] = TRUE;            
            $config3['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF|ico';
            $dname3 = explode(".", $_FILES['bg_login']['name']);
            $ext3 = end($dname3);
            $nama3 = 'BG-Login'."-".time().'-'.rand(100,999).".".$ext3;
            $config3['file_name'] = $nama3;
            $config3['remove_spaces'] = FALSE;
            $this->upload->initialize($config3);
            if (!$this->upload->do_upload('bg_login')) {
            } else {
                $upload_data = $this->upload->data();

                $insert['bg_login'] = 'assets/images/'.$nama3;
            }

            $config4['upload_path'] = "assets/images/";
            $config4['overwrite'] = TRUE;            
            $config4['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF|ico';
            $dname4 = explode(".", $_FILES['bg_register']['name']);
            $ext4 = end($dname4);
            $nama4 = 'BG-Register'."-".time().'-'.rand(100,999).".".$ext4;
            $config4['file_name'] = $nama4;
            $config4['remove_spaces'] = FALSE;
            $this->upload->initialize($config4);
            if (!$this->upload->do_upload('bg_register')) {
            } else {
                $upload_data = $this->upload->data();

                $insert['bg_register'] = 'assets/images/'.$nama4;
            }

            $this->M_data->updateData($insert, 'setting', 'id', $id);

            $this->session->set_flashdata('berhasil', 'Berhasil mengedit Setting');
            redirect(base_url('admin/setting'));
        }
    }
}
