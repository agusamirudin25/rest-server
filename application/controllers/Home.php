<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


class Home extends CI_Controller
{
    
    public function __construct(){
    	parent::__construct();
    	$this->load->model('m_mahasiswa');
    }

    // menampilkan data
    public function index_get(){
    	$npm = $this->input->get('npm');
    	//var_dump($npm);die();
    	if($npm == NULL){
    		$data['data'] = $this->m_mahasiswa->getAllData();
    	}else{
    		$data['data'] = $this->m_mahasiswa->getDataBynpm($npm);
    	}

    	if($data['data']){
    		$data['status'] = true;
        	$response = $this->output->set_header('HTTP/1.0 200');
        	echo json_encode($data);
    		return $response;
    	}else{
    		$data['status'] = false;
        	$response = $this->output->set_header('HTTP/1.0 404');
        	unset($data['data']);
        	$data['message'] = "Data Tidak Ditemukan !";
        	echo json_encode($data);
    		return $response;
    	}
        
    	
    }

    // tambah data
    public function index_post(){
    	$data = ['NPM' => $this->input->input_stream('npm'),
    			 'nama' => $this->input->input_stream('nama'),
    			 'jk' => $this->input->input_stream('jk'),
    			 'tgl_lahir' => $this->input->input_stream('tanggal_lahir'),
    			 'alamat' => $this->input->input_stream('alamat'),
    			 'jurusan' => $this->input->input_stream('jurusan')
    	];

    	if( $this->m_mahasiswa->addData($data) > 0 ){
    		$response['status'] = true;
    		$response['message'] = "Data Berhasil di tambah !";
    		$info = $this->output->set_header('HTTP/1.0 201');
    	}else{
    		$response['status'] = false;
    		$response['message'] = "Data gagal di tambah !";
    		$info = $this->output->set_header('HTTP/1.0 400');
    	}

    	echo json_encode($response);
    }

    // edit data
    public function index_put(){
    	$data = ['nama' => $this->input->input_stream('nama'),
    			 'jk' => $this->input->input_stream('jk'),
    			 'tgl_lahir' => $this->input->input_stream('tanggal_lahir'),
    			 'alamat' => $this->input->input_stream('alamat'),
    			 'jurusan' => $this->input->input_stream('jurusan')
    	];
    	$npm = $this->input->input_stream('npm');

    	if( $this->m_mahasiswa->editData($data, $npm) > 0 ){
    		$response['status'] = true;
    		$response['message'] = "Data Berhasil di ubah !";
    		$info = $this->output->set_header('HTTP/1.0 201');
    	}else{
    		$response['status'] = false;
    		$response['message'] = "Data gagal di ubah !";
    		$info = $this->output->set_header('HTTP/1.0 400');
    	}

    	echo json_encode($response);
    }



    // hapus data
    public function index_delete($npm = null){
    	//$npm = $this->input->input_stream('npm');
    	if($npm == null){
    		$data['status'] = false;
    		$response = $this->output->set_header('HTTP/1.0 400');
    		$data['message'] = "request salah !";
    	}else{
    		$hapus = $this->m_mahasiswa->deleteData($npm);
    		if( $hapus > 0 ){
    			$data['status'] = true;
	    		$response = $this->output->set_header('HTTP/1.0 202');
	    		$data['message'] = "Data Berhasil di hapus !";	
	    	}else{
	    		$data['status'] = false;
	    		$response = $this->output->set_header('HTTP/1.0 400');
	    		$data['message'] = "NPM tidak di temukan !";	
	    	}
    		
    	}
    	//var_dump($data);die();
    	echo json_encode($data);
    }






}

?>