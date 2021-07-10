<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class ChatModel extends CI_Model {
                        
public function login(){
                        
                                
}
public function getPesan($id_user,$id_lawan)
{
	$this->db->from('pesan');
	$this->db->where('id_user= '.$id_user.' 
	and id_lawan='.$id_lawan .' 
	or id_user= ' . $id_lawan . ' 
	and id_lawan=' . $id_user);

	$r = $this->db->get();
	
	return $r->result();
	
	# code...
}
public function TambahChatKeSatu($in)
{
	$this->db->insert('pesan', $in);
		
	# code...
}
public function getData($u,$p)
{
	$this->db->from('user');	
	$this->db->where('username', $u);
		$this->db->where('password', $p);
	return $sql = $this->db->get()->row();
	# code...
}
	public function getDataOnly($u)
	{
		$this->db->from('user');
		$this->db->where('username', $u);
		return $sql = $this->db->get()->row();
		# code...
	}
	public function getDataById($no)
	{
		$this->db->from('user');
		$this->db->where('id_user', $no);
		return $sql = $this->db->get()->row();
		# code...
	}
	public function GetAllOrangKecUser($id_user)
	{

		$this->db->from('user');
		$this->db->where('id_user!=', $id_user);
		return $sql = $this->db->get()->result();
		# code...
	}
	public function Tambah($tabel,$in)
	{
		$this->db->insert($tabel, $in);
	}
                        
                            
                        
}
                        
/* End of file ChatModel.php */
    
                        