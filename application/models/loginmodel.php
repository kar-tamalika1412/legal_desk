<?php

class loginmodel extends CI_Model{

	public function login_valid($username, $password)
	{
		$q = $this->db-> where (['uname'=> $username, 'pword'=>$password])
                        ->get('user');
//$q = $this->db->get_where('user', array('uname' => $username, 'pword' => $password ));


	if($q->num_rows())
	{
			return $q->row()->id;
				}	
	else{
			return FALSE;
	}

	}

	// Sign Up //
	public function signup($data){
		$this->db->insert('user',$data);
		$last_insertId = $this->db->insert_id();
		if($last_insertId){
			$config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'ssl://smtp.googlemail.com',
			  'smtp_port' => 465,
			  'smtp_user' => 'kar.tamalika1412@gmail.com',
			  'smtp_pass' => 'ipshamammu', 
			  'mailtype' => 'html',
			  'charset' => 'iso-8859-1',
			  'wordwrap' => TRUE
			);
			$to_email = $data['user_email'];
			$from_email = 'kar.tamalika1412@gmail.com';
			$subject = 'Please verify your email';
			$id = base64_encode($last_insertId);
			$link = base_url('/login/verify_email/'.$id);
			$message = 'Please click this link '.$link.' for verifing your email address';
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from($from_email);
			$this->email->to($to_email);
			$this->email->subject($subject);
			$this->email->message($message);
			if($this->email->send())
		    {
		      $rslt = true;
		    }else
		    {
		     $rslt = false;
		    }
		}
  		return  $rslt;
	}

	public function verify_email($id){
		return $this->db->where(array('user_id'=>$id))->set(array('is_email_verified'=>1,'updated_at'=>date('Y-m-d h:i:s')))->update('user');
	}

	public function do_login($data){
		$query = $this->db->where(array('user_email'=>$data['user_email'],'user_password'=>$data['user_password'],'is_email_verified'=>1))->get('user');
		if($query->num_rows() >0){
			$val = $query->result_array();
			$this->session->set_userdata("user_id",$val[0]['user_id']);
			$rslt = true;
		}else{
			$rslt = false;
		}
		return $rslt;
	}
}

?>