<?php 

class Login extends MY_Controller{

	function __construct()
  {
    parent::__construct();
    $this->controller = "login"; 
    $this->load->model('loginmodel', 'login');
  }
	public function index(){
		if($this->session->userdata('user_id'))
			return redirect('admin/dashboard');
		$this->load->helper('form');
		$this->load->view('public/admin_login');
		
	}


	public function admin_login()
	{
		 $this->load->library('form_validation');
	//$this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[5]|max_length[12]');

			//$this->form_validation->set_rules('password', 'Password', 'required');

		if( $this->form_validation->run('login') )
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');	
			$this->load->model('loginmodel');
			$login_id=$this->loginmodel->login_valid($username, $password);
			if($login_id){
				$this->session->set_userdata('user_id', $login_id);
				return redirect('admin/dashboard');
			}
			else{
				$this->session->set_flashdata('login_failed', 'invalid username & password combination');
				return redirect('login');

			}
		}
		else
		{
			
			$this->load->view('public/admin_login');
		}
	}

	public function logout(){
		$this->load->helper('url');
		$this->session->unset_userdata('user_id');
		return redirect ('login');

	}

	// Sign Up //
 	public function signup(){
	    $data = $this->input->post();
	    $rslt = $this->login->signup($data);
	    echo json_encode($rslt);
  	}
  	// verify email after sign up
  	public function verify_email(){
  		$uri = $_SERVER['REQUEST_URI'];
  		$uri_segments = explode('/', $uri);
  		$user_id = base64_decode($uri_segments[4]);
  		$this->login->verify_email($user_id);
  		$this->load->view('public/verify_email');
  	}

  	// login //
  	public function do_login(){
  		$data = $this->input->post();
  		$rslt = $this->login->do_login($data);
  		echo json_encode($rslt);
  	}
}
 ?>