<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_labkom extends CI_Model{
	function __construct(){
		$this->wares_ts		= 'wares_ts';

	}

	public function get_auth($uname,$pass){
		$query = $this->db->query("select * from active_user where username = '$uname' or password = '$pass'");
		return $query->result_array();
		//return $this->db->get('user')->result_array();
	}

	//KELOLA PENGGUNA
	public function newUserbyAdmin($nama,$aslab,$status,$email,$kontak,$username,$password){
		$cekMaxPosition = $this->db->query("SELECT COUNT(A.lab_id) as jmlAslab FROM user_detail AS A INNER JOIN user AS B ON A.u_id = B.u_id INNER JOIN laboratory AS C ON A.lab_id = C.lab_id WHERE B.level = '$status' AND C.lab_id = '$aslab' AND B.u_status = '1'");
		$value = $cekMaxPosition->row()->jmlAslab;

		if ($status == "Koordinator Laboratorium") {
			if ($value < 1) {
				$query_newUser = $this->db->query("insert into user set username = '$username', password = '$password', level = '$status'");
				if ($query_newUser) {
					$query_newUserdetail = $this->db->query("insert into user_detail set lab_id = '$aslab', name='$nama', email = '$email', cp = '$kontak'");
					if ($query_newUserdetail) {
						redirect(base_url('admin_kelolapengguna?warn=success&labId=&get_valueKoordi='.$value));
					}else{
						redirect(base_url('admin_kelolapengguna?warn=failed&labId='));
					}
				}
			}else{
				redirect(base_url('admin_kelolapengguna?warn=maxKoordi&labId='));
			}

		}elseif ($status == "Asisten Laboratorium") {
			if ($value < 2) {
				$query_newUser = $this->db->query("insert into user set username = '$username', password = '$password', level = '$status'");
				if ($query_newUser) {
					$query_newUserdetail = $this->db->query("insert into user_detail set lab_id = '$aslab', name='$nama', email = '$email', cp = '$kontak'");
					if ($query_newUserdetail) {
						redirect(base_url('admin_kelolapengguna?warn=success&labId=&get_valueAslab='.$value));
					}else{
						redirect(base_url('admin_kelolapengguna?warn=failed&labId='));
					}
				}
			}else{
				redirect(base_url('admin_kelolapengguna?warn=maxAslab&labId='));
			}
		}else{

		}
	}

	public function newUserbyKoordi($nama,$aslab,$status,$email,$kontak,$username,$password,$maxAslab,$labId){
		if ($maxAslab < 2 ) {
			$query_newUser = $this->db->query("insert into user set username = '$username', password = '$password', level = '$status'");
			if ($query_newUser) {
				$query_newUserdetail = $this->db->query("insert into user_detail set lab_id = '$aslab', name='$nama', email = '$email', cp = '$kontak'");
				if ($query_newUserdetail) {
				redirect(base_url('admin_kelolalab/lab_info?warn=success&id=').$labId.'&lab='.$aslab);
			}else{
				redirect(base_url('admin_kelolalab/lab_info?warn=failed&id=').$labId.'&lab='.$aslab);
				}
			}
		}else{
			redirect(base_url('admin_kelolalab/lab_info?warn=aslabfull&id=').$labId.'&lab='.$aslab);
		}
	}

	public function maxAslab($labId){
		$query_maxAslab = $this->db->query("SELECT COUNT(lab_id) AS maxAslab FROM user_detail AS A INNER JOIN user AS B ON A.u_id = B.u_id WHERE lab_id = '$labId' AND B.`level` = 'Asisten Laboratorium' AND B.u_status = '1'");
		return $query_maxAslab;
	}

	public function maxAslabInAdmin(){
		$query_maxAslab = $this->db->query("SELECT COUNT(lab_id) AS maxAslabInAdmin FROM user_detail AS A INNER JOIN user AS B ON A.u_id = B.u_id WHERE B.`level` = 'Asisten Laboratorium' AND B.u_status = '1'");
		return $query_maxAslab;
	}

	public function editUser($nama,$aslab,$status,$email,$kontak,$username,$u_id,$password, $labId){
		$query_modUser = $this->db->query("update user set username = '$username', password='$password', level = '$status' where u_id = '$u_id'");
		if ($query_modUser) {
			$query_modUserdetail = $this->db->query("update user_detail set lab_id = '$aslab', name='$nama', email = '$email', cp = '$kontak' where u_id = '$u_id'");
			if ($query_modUser && $query_modUserdetail) {
				redirect(base_url('admin_kelolapengguna?warn=updsuccess&labId='.$labId.'&id='.$username.'&lab='.$aslab));
			}else{
				redirect(base_url('admin_kelolapengguna?warn=updfailed&labId='.$labId.'&id='.$username.'&lab='.$aslab));
			}
		}
	}

	public function deleteUser($u_id, $labId){
		if (!empty($labId)) {
			$remove_user = $this->db->query("DELETE A,B from user as A inner join user_detail as B on A.u_id = B.u_id where A.u_id = '$u_id'");

			if ($remove_user) {
					redirect(base_url('admin_kelolapengguna?warn=del_success&labId='.$labId));
				}
		}else{
			$remove_user = $this->db->query("DELETE A,B from user as A inner join user_detail as B on A.u_id = B.u_id where A.u_id = '$u_id'");

			if ($remove_user) {
					redirect(base_url('admin_kelolapengguna?warn=del_success&labId='));
				}
			}
	}

	public function updateUserStatusActive($id, $stat, $labId, $level){
		$get_maxAslab = $this->db->query("SELECT COUNT(lab_id) AS maxAslabInAdmin FROM user_detail AS A INNER JOIN user AS B ON A.u_id = B.u_id WHERE B.`level` = '$level' AND B.u_status = '1' AND A.lab_id = '$labId'");
		$value = $get_maxAslab->row()->maxAslabInAdmin;
		if ($level == "Asisten Laboratorium") {
			if ($value < 2) {
				$update = $this->db->query("update user set u_status = '$stat' where u_id = '$id'");
				redirect(base_url('admin_kelolapengguna?labId=0&user='.$id.'&warn=active'));
			}else{
				redirect(base_url('admin_kelolapengguna?labId=0&user='.$id.'&warn=updStatFailed'));
			}
		}elseif ($level == "Koordinator Laboratorium"){
			if ($value < 1) {
				$update = $this->db->query("update user set u_status = '$stat' where u_id = '$id'");
				redirect(base_url('admin_kelolapengguna?labId=0&user='.$id.'&warn=active'));
			}else{
				redirect(base_url('admin_kelolapengguna?labId=0&user='.$id.'&warn=updStatKoordiFailed'));
			}
		}
	}

	public function updateUserStatusFailed($id, $stat, $labId, $level){
		$update = $this->db->query("update user set u_status = '$stat' where u_id = '$id'");
	}

	public function updateLabStatus($id, $stat){
		$update = $this->db->query("update laboratory set lab_status = '$stat' where lab_id = '$id'");
	}

	public function showUser($labId){
		if (!empty($labId)) {
			$query = $this->db->query("SELECT B.name, A.lab_name, A.lab_id, B.email, B.cp, C.username, C.password, C.level, B.u_id, C.u_status FROM `laboratory` AS A INNER JOIN `user_detail` AS B ON  A.lab_id = B.lab_id INNER JOIN `user` AS C ON B.u_id = C.u_id WHERE A.lab_id = '$labId' AND C.level = 'Asisten Laboratorium' AND C.u_status = '1' ORDER BY B.name asc ");
			return $query;
		}else{
			return $this->db->get('show_user');
		}
		//$query_showUser = $this->db->query("select * FROM show_user");
	}

	public function selectUser($getUser){
		$query = $this->db->query("select u_id from user where username = '$getUser'");
		return $query;
	}

	public function filterUser($filter){
		if ($filter == "KoordinatorLaboratorium") {
			$query_showUser = $this->db->query("select * FROM show_user where level = 'Koordinator Laboratorium'");
		}else{
			$query_showUser = $this->db->query("select * FROM show_user where level = 'Asisten Laboratorium' order by u_status desc");
		}
		return $query_showUser;
	}

	public function filterUserLab($filter){
		$query_showUser = $this->db->query("select * FROM show_user where lab_id = '$filter'");
		return $query_showUser;
	}

	public function addLab($labName, $capacity){
		$query = $this->db->query("insert into laboratory set lab_name = '$labName', capacity = '$capacity'");
		if ($query) {
			redirect(base_url('admin_kelolalab?warn=success'));
		}else{
			redirect(base_url('admin_kelolalab?warn=failed'));
		}
	}

	public function editLab($labName, $capacity, $labId){
		$query = $this->db->query("update laboratory set lab_name = '$labName', capacity = '$capacity' where lab_id = '$labId'");
		if ($query) {
			redirect(base_url('admin_kelolalab?warn=updsuccess'));
		}else{
			redirect(base_url('admin_kelolalab?warn=updfailed'));
		}
	}

	public function takeLabID($name){
		$query = $this->db->query("select A.lab_id as labId from laboratory as A inner join user_detail as B on A.lab_id = B.lab_id inner join user AS C on B.u_id = C.u_id where C.username = '$name'");
			return $query->num_rows()->labId;
	}

	public function showLab($name){
		if (!empty($name)) {
			$query = $this->db->query("select * from laboratory as A inner join user_detail as B on A.lab_id = B.lab_id inner join user AS C on B.u_id = C.u_id where C.username = '$name'");
			return $query;
		}else{
			return $this->db->get('laboratory');
		}
	}

	public function optionLab(){
		return $this->db->get('laboratory');
	}

	/*public function countAslab($labId){
		$query = $this->db->query("
			SELECT COUNT(A.lab_id) AS maxAslab
			FROM user_detail AS A
			INNER JOIN user AS B
			ON A.u_id = B.u_id
			WHERE A.lab_id = '$labId' AND B.level = 'Asisten Laboratorium'
			");
		return $query;
	}*/

	public function Laboratorium($lab){
		$query = $this->db->query("select * from laboratory where lab_id = '$lab'");
		return $query;
	}

	public function showALab($lab){ //koordi
		if (!empty($lab)) {
			$query_showLab = $this->db->query("select * from laboratory as A inner join user_detail as B on A.lab_id = B.lab_id inner join user AS C on B.u_id = C.u_id where A.lab_id = '$lab' AND C.level = 'Koordinator Laboratorium'");
			return $query_showLab;
		}else{
			$query = $this->db->query("select * from laboratory as A inner join user_detail as B on A.lab_id = B.lab_id inner join user as C on B.u_id = C.u_id where C.level = 'Koordinator Laboratorium'");
			return $query;
		}
	}

	public function koordiLabInfo($lab){
		$query = $this->db->query("select B.name as koordinator from laboratory as A inner join user_detail as B on A.lab_id = B.lab_id inner join user AS C on B.u_id = C.u_id where A.lab_id = '$lab' AND C.level = 'Koordinator Laboratorium' AND C.u_status = '1'");
		if ($query->num_rows()>0) {
			return $query->row()->koordinator;
		}else{
			return ' ';
		}
	}

	public function active_aslab($lab){
		$query = $this->db->query("SELECT * from user_detail as A INNER JOIN user AS B ON A.u_id = B.u_id WHERE A.lab_id = '$lab' AND B.level = 'Asisten Laboratorium' AND B.u_status = '1' limit 2");
		return $query;
	}

	public function showAslab($lab){ //aslab
		$query = $this->db->query("SELECT * from user_detail as A INNER JOIN user AS B ON A.u_id = B.u_id WHERE A.lab_id = '$lab' AND B.level = 'Asisten Laboratorium'");
		return $query;
	}

	public function take_Aslab($labId){
		$query = $this->db->query("SELECT B.name, A.lab_name, B.email, B.cp, C.username, C.password, C.level, B.u_id FROM `laboratory` AS A INNER JOIN `user_detail` AS B ON  A.lab_id = B.lab_id INNER JOIN `user` AS C ON B.u_id = C.u_id WHERE A.lab_id = '1' AND C.level = 'Asisten Laboratorium' ORDER BY B.name asc ");
		return $query;
	}

	public function take_id($get_id, $labId){
		if (!empty($labId)) {
			$query = $this->db->query("select * from show_user where u_id = '$get_id' and lab_id = '$labId'");
			return $query;
		}else{
			$query = $this->db->query("select * from show_user where u_id = '$get_id'");
			return $query;
		}
	}


	public function showLab_Things($lab){ //MUNGKIN NDA JADI PAKE
		$query = $this->db->query("select * from laboratory_things where lab_id = '$lab'");
		return $query;
	}

	public function admin_kelolalabEditPage($lab){
		$query = $this->db->query("select * from laboratory where lab_id = '$lab'");
		return $query;
	}	

	public function addTrouble($nameTrouble, $desc, $pc, $labId){
		$query = $this->db->query("insert into laboratory_things set lab_id = '$labId', wares_name = '$nameTrouble', description = '$desc', pc = '$pc'"); //BACA INSERT pc = 'PC-$pc'
		if ($query) {
			redirect(base_url('admin_kelolalab/lab_Info?warn=success&id=').$labId);
		}else{
			redirect(base_url('admin_kelolalab/lab_Info?warn=failed&id=').$labId);
		}
	}

	public function editTrouble($nameTrouble, $desc, $pc, $labId, $id){
		$query = $this->db->query("update laboratory_things set lab_id = '$labId', wares_name = '$nameTrouble', description = '$desc', pc = '$pc' where lab_id = '$labId' and things_id = '$id'"); //BACA INSERT pc = 'PC-$pc'
		if ($query) {
			redirect(base_url('admin_kelolalab/lab_Info?warn=updsuccess&id=').$labId.'&tID='.$id);
		}else{
			redirect(base_url('admin_kelolalab/lab_Info?warn=updfailed&id=').$labId.'&tID='.$id);
		}
	}

	public function removeTrouble($id, $labId){
		$query = $this->db->query("delete from laboratory_things where things_id = '$id'");
		if ($query) {
			redirect(base_url('admin_kelolalab/lab_Info?warn=delsuccess'.'&id='.$labId));
		}else{
			redirect(base_url('admin_kelolalab/lab_Info?warn=delfailed'.'&id='.$labId));
		}
	}

	public function countTrouble($labId){
		$query = $this->db->query("SELECT * FROM laboratory_things WHERE lab_id = '$labId' group by pc");
		return $query->num_rows(); //TAKE sumTrouble to COUNTtROUBLE VARIABLE

	}

	public function countPC($labId){
		$query = $this->db->query("SELECT COUNT(pc) AS sumPC FROM laboratory_things WHERE lab_id = '$labId'");
		return $query;
	}	




	//KELOLA PERANGKAT
	public function newHw($nama, $jp, $icon){
		$query = $this->db->query("insert into wares set w_name = '$nama', w_kind = '$jp', w_icon = '$icon'");
		if ($query) {
			redirect(base_url('kelolaperangkat/hardware?warn=success'));
		} else{
			redirect(base_url('kelolaperangkat/hardware?warn=failed'));
		}
	}

	public function showHw(){
		$query = $this->db->query("select * from wares where w_kind = 'Hardware' order by w_name asc");
		return $query;
	}

	public function deleteHw($id,$url){
		$query1 = $this->db->query("DELETE A, B from wares as A inner join wares_ts as B on A.w_id = B.w_id where A.w_id = '$id'");

		$query2 = $this->db->query("DELETE from wares where w_id = '$id'");
		if ($query1 && $query2) {
			unlink($url);
			redirect(base_url('kelolaperangkat/hardware?warn=delsuccess'));
		}
	}

	public function updateHw($id,$nama,$jp,$icon,$url){
		if ($icon == '') {
			$query = $this->db->query("update wares set w_name = '$nama', w_kind = '$jp' where w_id = '$id'");
			if ($query) {
				redirect(base_url('kelolaperangkat/hardware?warn=updsuccess'));
			}
		}else{
			$query = $this->db->query("update wares set w_name = '$nama', w_kind = '$jp', w_icon = '$icon' where w_id = '$id'");
			if ($query) {
				unlink($url);
				redirect(base_url('kelolaperangkat/hardware?warn=updsuccess'));
			}
		}
	}

	public function take_Hwid($get_id){
		$query = $this->db->query("select * from wares where w_id = '$get_id'");
		return $query;
	}




	//TROUBLESHOOTING PERANGKAT
	public function take_ware_ts($get_id, $get_user){ //PASSING USERDATA DISINI
		if ($get_user == 'admin' || $get_user == '1') {
			$query = $this->db->query("select * from wares as A inner join wares_ts as B on A.w_id = B.w_id inner join user as C on B.upd_by = C.u_id inner join user_detail as D on C.u_id = D.u_id where A.w_id = '$get_id' order by B.status asc");
		}else{
			$query = $this->db->query("select * from wares as A inner join wares_ts as B on A.w_id = B.w_id inner join user as C on B.upd_by = C.u_id inner join user_detail as D on C.u_id = D.u_id where A.w_id = '$get_id' and B.status = '1'");
		}
		return $query;
	}

	public function take_a_ware($get_id){
		$query = $this->db->query("select * from wares where w_id = '$get_id'");
		return $query;
	}

	public function updateStat2($stat,$get_tsId){
		$update = $this->db->query("update wares_ts set status = '$stat' where ts_id = '$get_tsId'");
		//$base_url = base_url('kelolaperangkat/ts_data?id='.$get_wId.'&user='.$get_user);
	}



	//TROUBLESHOOTING HARDWARE
	public function new_ts_data($masalah,$id_perangkat,$id_user,$deskripsi,$solusi,$linkVid,$date){

		$query_ts = $this->db->query("insert into wares_ts set w_id = '$id_perangkat', title = '$masalah', detail = '$deskripsi', solving = '$solusi', video = '$linkVid', upd_by = '$id_user', upd_date = '$date'");


		$base_url = base_url("kelolaperangkat/ts_data?warn=success&id=".$id_perangkat."&user=".$id_user);

		if ($query_ts) {
			redirect($base_url);
		}else{
			redirect(base_url('kelolaperangkat/ts_data?warn=failed&id='.$id_perangkat."&user=".$id_user));
		}
	}

	//insertdata array
	public function insert_ts_hw($data = array()){
		if (!empty($data)) {
			$insert = $this->db->insert($this->wares_ts, $data);

			return $insert?$this->db->insert_id():false;
		}
		return false;
	}

	public function take_dataTs($get_id){
		$query = $this->db->query("select * from wares as A inner join wares_ts as B on A.w_id = B.w_id inner join user as C on B.upd_by = C.u_id inner join user_detail as D on C.u_id = D.u_id where B.ts_id = '$get_id'");
		return $query;
	}

	public function update_ts_data($masalah,$id_ts,$id_user,$id_perangkat,$deskripsi,$solusi,$linkVid,$date){
		//$youTube = "https://www.youtube.com/embed/";
		//$key = $youTube.$linkVid;

		$update_ts 	= $this->db->query("update wares_ts set title = '$masalah', detail = '$deskripsi', solving = '$solusi', video = '$linkVid', upd_by = '$id_user', upd_date = '$date' where ts_id = '$id_ts'");

		$base_url = base_url("kelolaperangkat/ts_data?warn=updsuccess&id=".$id_perangkat."&user=".$id_user);

		if ($update_ts) {
			redirect($base_url);
		}else{
			redirect(base_url('kelolaperangkat/ts_data?warn=failed'));
		}		

	}

	public function remove_ts_data($ts_id, $id_ware, $get_user){
		$query = $this->db->query("delete from wares_ts where ts_id = '$ts_id'");
		if ($query) {
			redirect(base_url('kelolaperangkat/ts_data?warn=delsuccess&id=').$id_ware."&user=".$get_user);
		}
	}




	//SOFTWARE
	public function showSw(){
		$query = $this->db->query("select * from wares where w_kind = 'Software' order by w_name asc");
		return $query;
	}

	public function newSw($nama, $jp, $icon){
		$query = $this->db->query("insert into wares set w_name = '$nama', w_kind = '$jp', w_icon = '$icon'");
		if ($query) {
			redirect(base_url('kelolaperangkat/software?warn=success'));
		} else{
			redirect(base_url('kelolaperangkat/software?warn=failed'));
		}
	}

	public function deleteSw($id,$url){
		$query1 = $this->db->query("DELETE A, B from wares as A inner join wares_ts as B on A.w_id = B.w_id where A.w_id = '$id'");

		$query2 = $this->db->query("DELETE from wares where w_id = '$id'");
		if ($query1 && $query2) {
			unlink($url);
			redirect(base_url('kelolaperangkat/software?warn=delsuccess'));
		}
	}

	public function updateSw($id,$nama,$jp,$icon,$url){
		if ($icon == '') {
			$query = $this->db->query("update wares set w_name = '$nama', w_kind = '$jp' where w_id = '$id'");
			if ($query) {
				redirect(base_url('kelolaperangkat/software?warn=updsuccess'));
			}
		}else{
			$query = $this->db->query("update wares set w_name = '$nama', w_kind = '$jp', w_icon = '$icon' where w_id = '$id'");
			if ($query) {
				unlink($url);
				redirect(base_url('kelolaperangkat/software?warn=updsuccess'));
			}
		}
	}

	public function take_Swid($get_id){
		$query = $this->db->query("select * from wares where w_id = '$get_id'");
		return $query;
	}


	//MODEL FOR ANDROID
	public function daftar_perangkat($type){
		$query = $this->db->query("select * from wares where w_kind = '$type' order by w_name asc");
		return $query;
	}

	public function daftar_solusi($wId){
		$query = $this->db->query("select * from wares_ts where w_id = '$wId' and status = '1'");
		return $query;
	}

	public function tableWare($wId){
		$query = $this->db->query("select w_name, w_kind, w_icon from wares where w_id = '$wId'");
		return $query;
	}

	public function solusi($tsId){
		$query = $this->db->query("select * from wares_ts where ts_id = '$tsId'");
		return $query;
	}

	public function cariSolusi($kata){
		$query = $this->db->query("select title, ts_id from wares_ts where title like '%$kata%' order by title asc");
		return $query;
		//redirect(base_url('Android_controller?msg='.$kata));
	}

	public function countHasilSolusi($kata){
		$query = $this->db->query("select count(title) as countResult from wares_ts where title like '%$kata%' order by title asc");
		if ($query->num_rows() > 0) {
			return $query->row()->countResult;
		}else{
			return 0;
		}
	}

}

?>