<?php
class Pegawai{
	private $table='pegawai';
	function getAll(){
		$sql=mysql_query("select * from $this->table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getLike($cari){
		$sql=mysql_query("select * from $this->table where nama like '%$cari%'");
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
	function getBagian($bag){
		$sql=mysql_query("select * from $this->table where bagian='$bag' and level='STF' or  level='SKR'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getRow($id){
		$sql=mysql_query("select * from $this->table where id='$id'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getField($field,$id){
		$sql=mysql_query("select * from $this->table where id='$id'");
		$no=mysql_num_rows($sql);
		if($no==1){
			$data=mysql_fetch_assoc($sql);
			switch($field){
				case 'id':
					return $data['id'];
				break;
				case 'nama':
					return $data['nama'];
				break;
				case 'nip':
					return $data['nip'];
				break;
				case 'pangkat_golongan':
					return $data['pangkat_golongan'];
				break;
				case 'jabatan':
					return $data['jabatan'];
				break;
				case 'bagian':
					return $data['bagian'];
				break;
				case 'level':
					return $data['level'];
				break;
			}
		}
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[user]','$data[nama]','$data[nip]','$data[pangkat_golongan]','$data[jabatan]','$data[bagian]','$data[level]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set id='$data[user]',nama='$data[nama]',nip='$data[nip]',pangkat_golongan='$data[pangkat_golongan]',jabatan='$data[jabatan]',bagian='$data[bagian]',level='$data[level]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function delData($id){
		$sql=mysql_query("delete from $this->table where id='$id'");
	}
}
?>