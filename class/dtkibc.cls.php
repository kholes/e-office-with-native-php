<?php
class Dtkibc{
	private $table='dtkibc';
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
	function getTotal(){
		$sql=mysql_query("select sum(harga) as tot from $this->table");
		while($row=mysql_fetch_assoc($sql))
		$data=$row['tot'];
		return $data;
	}
	function getSrc($col,$key){
		$sql=mysql_query("select * from $this->table where $col like '%$key%'");
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
				case 'kode':
					return $data['kode'];
				break;
				case 'register':
					return $data['register'];
				break;
				case 'kondisi':
					return $data['kondisi'];
				break;
				case 'tingkat':
					return $data['tingkat'];
				break;
				case 'beton':
					return $data['beton'];
				break;
				case 'luas_lantai':
					return $data['luas_lantai'];
				break;
				case 'lokasi':
					return $data['lokasi'];
				break;
				case 'tanggal':
					return $data['tanggal'];
				break;
				case 'nomor':
					return $data['nomor'];
				break;
				case 'luas_tanah':
					return $data['luas_tanah'];
				break;
				case 'status_tanah':
					return $data['status_tanah'];
				break;
				case 'kode_tanah':
					return $data['kode_tanah'];
				break;
				case 'asalusul':
					return $data['asalusul'];
				break;
				case 'harga':
					return $data['harga'];
				break;
				case 'keterangan':
					return $data['keterangan'];
				break;
			}
		}
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[nama]','$data[kode]','$data[register]','$data[kondisi]','$data[tingkat]','$data[beton]','$data[luas_lantai]','$data[lokasi]','$data[tanggal]','$data[nomor]','$data[luas_tanah]','$data[status_tanah]','$data[kode_tanah]','$data[asalusul]','$data[harga]','$data[keterangan]','')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set nama='$data[nama]',kode='$data[kode]',register='$data[register]',kondisi='$data[kondisi]',tingkat='$data[tingkat]',beton='$data[beton]',luas_lantai='$data[luas_lantai]',lokasi='$data[lokasi]',tanggal='$data[tanggal]',nomor='$data[nomor]',luas_tanah='$data[luas_tanah]',status_tanah='$data[status_tanah]',kode_tanah='$data[kode_tanah]',asalusul='$data[asalusul]',harga='$data[harga]',keterangan='$data[keterangan]',idkir='$data[idkir]' where id='$id'");
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