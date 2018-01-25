<?php
class Dtkibb{
	private $table='dtkibb';
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
	function getTotal(){
		$sql=mysql_query("select sum(harga) as tot from $this->table");
		while($row=mysql_fetch_assoc($sql))
		$data=$row['tot'];
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
				case 'nama':
					return $data['nama'];
				break;
				case 'kode':
					return $data['kode'];
				break;
				case 'register':
					return $data['register'];
				break;
				case 'merek':
					return $data['merek'];
				break;
				case 'ukuran':
					return $data['ukuran'];
				break;
				case 'bahan':
					return $data['bahan'];
				break;
				case 'thn_beli':
					return $data['thn_beli'];
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
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[nama]','$data[kode]','$data[register]','$data[merek]','$data[ukuran]','$data[bahan]','$data[thn_beli]','$data[no_pabrik]','$data[no_rangka]','$data[no_mesin]','$data[no_polisi]','$data[no_bpkb]','$data[asalusul]','$data[harga]','$data[keterangan]','$data[kondisi]','')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set nama='$data[nama]',kode='$data[kode]',register='$data[register]',merek='$data[merek]',ukuran='$data[ukuran]',bahan='$data[bahan]',thn_beli='$data[thn_beli]',no_pabrik='$data[no_pabrik]',no_rangka='$data[no_rangka]',no_mesin='$data[no_mesin]',no_polisi='$data[no_polisi]',no_bpkb='$data[no_bpkb]',asalusul='$data[asalusul]',harga='$data[harga]',keterangan='$data[keterangan]',kondisi='$data[kondisi]',idkir='$data[idkir]' where id='$id'");
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