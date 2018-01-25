<?php
class Dtkibe{
	private $table='dtkibe';
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
	function getTotal(){
		$sql=mysql_query("select sum(harga) as tot from $this->table");
		while($row=mysql_fetch_assoc($sql))
		$data=$row['tot'];
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
				case 'judul':
					return $data['judul'];
				break;
				case 'spesifikasi':
					return $data['spesifikasi'];
				break;
				case 'daerah':
					return $data['daerah'];
				break;
				case 'pencipta':
					return $data['pencipta'];
				break;
				case 'bahan':
					return $data['bahan'];
				break;
				case 'jenis':
					return $data['jenis'];
				break;
				case 'ukuran':
					return $data['ukuran'];
				break;
				case 'renovasi':
					return $data['renovasi'];
				break;
				case 'jumlah':
					return $data['jumlah'];
				break;
				case 'thn_cetak':
					return $data['thn_cetak'];
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
				case 'kondisi':
					return $data['kondisi'];
				break;
			}
		}
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[nama]','$data[kode]','$data[register]','$data[judul]','$data[spesifikasi]','$data[daerah]','$data[pencipta]','$data[bahan]','$data[jenis]','$data[ukuran]','$data[renovasi]','$data[jumlah]','$data[thn_cetak]','$data[asalusul]','$data[harga]','$data[keterangan]','$data[kondisi]','$data[idkir]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set nama='$data[nama]',kode='$data[kode]',register='$data[register]',judul='$data[judul]',spesifikasi='$data[spesifikasi]',daerah='$data[daerah]',pencipta='$data[pencipta]',bahan='$data[bahan]',jenis='$data[jenis]',ukuran='$data[ukuran]',renovasi='$data[renovasi]',jumlah='$data[jumlah]',thn_cetak='$data[thn_cetak]',asalusul='$data[asalusul]',harga='$data[harga]',keterangan='$data[keterangan]',kondisi='$data[kondisi]',idkir='$data[idkir]' where id='$id'");
		if($sql){
			print_r($data);
			return true;
		}
		return false;
	}
	function delData($id){
		$sql=mysql_query("delete from $this->table where id='$id'");
	}
}
?>