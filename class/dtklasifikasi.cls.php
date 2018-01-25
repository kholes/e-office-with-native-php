<?php
class Dtklasifikasi{
	private $table='dtklasifikasi';
	function getAll(){
		$sql=mysql_query("select * from $this->table order by id");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getWhere($col,$dta){
		$sql=mysql_query("select * from $this->table where $col='$dta' order by id");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getLike($cari){
		$sql=mysql_query("select * from $this->table where keterangan like '%$cari%' order by id");
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
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[idindex]','$data[keterangan]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set idindex='$data[idindex]',keterangan='$data[keterangan]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function deleteData($id){
		$sql=mysql_query("delete from $this->table where id='$id'");
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
				case 'idindex':
					return $data['idindex'];
				break;
				case 'keterangan':
					return $data['keterangan'];
				break;
			}
		}
	}
}
?>
