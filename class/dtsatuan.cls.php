<?php
class Dtsatuan{
	private $table='dtsatuan';
	function getAll(){
		$sql=mysql_query("select * from $this->table order by satuan");
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
				case 'satuan':
					return $data['satuan'];
				break;
			}
		}
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[satuan]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set satuan='$data[satuan]' where id='$id'");
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