<?php
class Asettetap{
	private $table='dtaset';
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
				case 'kategori':
					return $data['kategori'];
				break;
				case 'nama':
					return $data['nama'];
				break;
				case 'merek':
					return $data['merek'];
				break;
				case 'type':
					return $data['type'];
				break;
				case 'ukuran':
					return $data['ukuran'];
				break;
				case 'bahan':
					return $data['bahan'];
				break;
				case 'tahun_beli':
					return $data['tahun_beli'];
				break;
				case 'perolehan':
					return $data['perolehan'];
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
				case 'no_pabrik':
					return $data['no_pabrik'];
				break;
				case 'no_rangka':
					return $data['no_rangka'];
				break;
				case 'no_mesin':
					return $data['no_mesin'];
				break;
				case 'no_polisi':
					return $data['no_polisi'];
				break;
				case 'no_bpkb':
					return $data['no_bpkb'];
				break;
			}
		}
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[kode]','$data[kategori]','$data[nama]','$data[merek]','$data[type]','$data[ukuran]','$data[bahan]','$data[tahun_beli]','$data[no_pabrik]','$data[no_rangka]','$data[no_mesin]','$data[no_polisi]','$data[no_bpkb]','$data[perolehan]','$data[harga]','$data[keterangan]','$data[status]')");
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