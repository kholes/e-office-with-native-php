<?php
class Dtkir{
	private $table='dtkir';
	function getAll(){
		$sql=mysql_query("select * from $this->table order by id");
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
	function getWhere($col,$txt){
		$sql=mysql_query("select * from $this->table where $col='$txt'");
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
	function getSrc($col,$key){
		$sql=mysql_query("select * from $this->table where $col like '%$key%'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;	
	}
	function getCount($id){
		$sql=mysql_query("select count(id) as b from $this->table where id='$id'");
		while($row=mysql_fetch_assoc($sql))
		return $row['b'];
	}
	function getCountKB($id){
		$sql=mysql_query("select count(id) as b from $this->table where id='$id' and kondisi='KB'");
		while($row=mysql_fetch_assoc($sql))
		return $row['b'];
	}
	function getCountRB($id){
		$sql=mysql_query("select count(id) as b from $this->table where id='$id' and kondisi='RB'");
		while($row=mysql_fetch_assoc($sql))
		return $row['b'];
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
				case 'unit':
					return $data['unit'];
				break;
				case 'bidang':
					return $data['bidang'];
				break;
				case 'ruangan':
					return $data['ruangan'];
				break;
				case 'lokasi':
					return $data['lokasi'];
				break;
			}
		}
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[unit]','$data[bidang]','$data[ruangan]','$data[lokasi]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set kode='$data[kode]',kategori='$data[kategori]',nama='$data[nama]',merek='$data[merek]',type='$data[type]',ukuran='$data[ukuran]',bahan='$data[bahan]',tahun_beli='$data[tahun_beli]',no_pabrik='$data[no_pabrik]',no_rangka='$data[no_rangka]',no_mesin='$data[no_mesin]',no_polisi='$data[no_polisi]',no_bpkb='$data[no_bpkb]',perolehan='$data[perolehan]',harga='$data[harga]',keterangan='$data[keterangan]',status='$data[status]' where id='$id'");
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