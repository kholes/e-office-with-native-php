<?php
class Dtkiba{
	private $table='dtkiba';
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
				case 'luas':
					return $data['luas'];
				break;
				case 'tahun':
					return $data['tahun'];
				break;
				case 'alamat':
					return $data['alamat'];
				break;
				case 'hak_sertifikat':
					return $data['hak_sertifikat'];
				break;
				case 'tgl_sertifikat':
					return $data['tgl_sertifikat'];
				break;
				case 'no_sertifikat':
					return $data['no_sertifikat'];
				break;
				case 'penggunaan':
					return $data['penggunaan'];
				break;
				case 'asalusul':
					return $data['asalusul'];
				break;
				case 'harga':
					return $data['harga'];
				break;
				case 'kondisi':
					return $data['kondisi'];
				break;
				case 'keterangan':
					return $data['keterangan'];
				break;
				case 'idkir':
					return $data['idkir'];
				break;
			}
		}
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[nama]','$data[kode]','$data[register]','$data[luas]','$data[tahun]','$data[alamat]','$data[hak_sertifikat]','$data[tgl_sertifikat]','$data[no_sertifikat]','$data[penggunaan]','$data[asalusul]','$data[harga]','$data[keterangan]','$data[kondisi]','$data[idkir]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set nama='$data[nama]',kode='$data[kode]',register='$data[register]',luas='$data[luas]',tahun='$data[tahun]',alamat='$data[alamat]',hak_sertifikat='$data[hak_sertifikat]',tgl_sertifikat='$data[tgl_sertifikat]',no_sertifikat='$data[no_sertifikat]',penggunaan='$data[penggunaan]',asalusul='$data[asalusul]',harga='$data[harga]',keterangan='$data[keterangan]',kondisi='$data[kondisi]',idkir='$data[idkir]' where id='$id'");
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