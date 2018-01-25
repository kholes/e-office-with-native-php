<?php
class Asettetaphis{
	private $table='dtasethis';
	function getAll($by){
		$sql=mysql_query("select * from $this->table order by $by");
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
	function getLike($col,$txt){
		$sql=mysql_query("select * from $this->table where $col like '%$txt%'");
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
				case 'kode':
					return $data['kode'];
				break;
				case 'tanggal':
					return $data['tanggal'];
				break;
				case 'jenis':
					return $data['jenis'];
				break;
				case 'sparepart':
					return $data['sparepart'];
				break;
				case 'harga':
					return $data['harga'];
				break;
				case 'status':
					return $data['status'];
				break;
				case 'keterangan':
					return $data['keterangan'];
				break;
				case 'pelaksana':
					return $data['pelaksana'];
				break;
				case 'userid':
					return $data['userid'];
				break;
			}
		}
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[kode]','$data[tanggal]','$data[jenis]','$data[sparepart]','$data[harga]','$data[status]','$data[keterangan]','$data[pelaksana]','$data[userid]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set kode='$data[kode]',tanggal='$data[tanggal]',jenis='$data[jenis]',sparepart='$data[sparepart]',harga='$data[harga]',harga='$data[harga]',status='$data[status]',keterangan='$data[keterangan]',pelaksana='$data[pelaksana]',userid='$data[userid]' where id='$id'");
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