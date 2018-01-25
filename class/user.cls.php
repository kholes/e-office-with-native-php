<?php
class User{
	private $table='user';
	function getAll(){
		$sql=mysql_query("select * from $this->table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getWhere($col,$val){
		$sql=mysql_query("select * from $this->table where $col='$val'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getLike($cari){
		$sql=mysql_query("select * from $this->table where login_id like '%$cari%'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getRow($id){
		$sql=mysql_query("select * from $this->table where id_user='$id'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getUser($val){
		$sql=mysql_query("select * from $this->table where login_id='$val'");
		while($row=mysql_fetch_assoc($sql))
		$data=$row['login_id'];
		return $data;
	}
	function cekOldPass($val){
		$sql=mysql_query("select * from $this->table where login_id='$val'");
		while($row=mysql_fetch_assoc($sql))
		$data=$row['login_id'];
		return $data;
	}
	function setUser($id,$data){
		$sql=mysql_query("update $this->table set login_id='$data[user]',password='$data[password]' where id_user='$id'");
		if($sql){
			return true;
		}else{
			return false;
		}
	}
	function getField($field,$id){
		$sql=mysql_query("select * from $this->table where id_user='$id'");
		$no=mysql_num_rows($sql);
		if($no==1){
			$data=mysql_fetch_assoc($sql);
			switch($field){
				case 'id_user':
					return $data['id_user'];
				break;
				case 'login_id':
					return $data['login_id'];
				break;
				case 'password':
					return $data['password'];
				break;
				case 'level':
					return $data['level'];
				break;
				case 'status':
					return $data['status'];
				break;			
				case 'themesid':
					return $data['themesid'];
				break;			
			}
		}
	}
	function addData($data){
		$password=md5($data['password']);
		$sql=mysql_query("insert into $this->table values('$data[id_user]','$data[user]','$password','$data[level]','$data[status]','$data[themesid]')");
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set login_id='$data[user]',password='$data[password]',level='$data[level]',status='$data[status]',themesid='$data[themesid]' where id_user='$id'");
	}
	function delData($id){
		$sql=mysql_query("delete from $this->table where id_user='$id'");
	}
	function setStatus($id,$sts){
		switch($sts){
			case '0':
				$sql=mysql_query("update $this->table set status='1' where id_user='$id'");
			break;
			case '1':
				$sql=mysql_query("update $this->table set status='0' where id_user='$id'");
			break;
		}
	}
}
?>