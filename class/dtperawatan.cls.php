<?php
class Dtperawatan{
	private $table='dtperawatan';
	private $item='dtperawatanitem';
	private $temp='tempperawatan';
	//======Model Table Perawatan=========//
	function insert($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[tanggal]','$data[kategori]','$data[pelaksana]','$data[stafaset]','','','0')");
		if($sql){
			return true;
		}
		return false;
	}
	function update($data){
		$sql=mysql_query("update $this->table set tanggal='$data[tgl]',kategori='$data[kategori]',pelaksana='$data[pelaksana]' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function delete($id){
		$sql=mysql_query("delete from $this->table where id='$id'");
		if($sql){
			mysql_query("delete from $this->item where idt='$id'");
		}
	}
	function get_all(){
		$sql=mysql_query("select * from $this->table order by id");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function get_where($col,$txt){
		$sql=mysql_query("select * from $this->table where $col='$txt'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function get_field($field,$id){
		$sql=mysql_query("select * from $this->table where id='$id'");
		$no=mysql_num_rows($sql);
		if($no==1){
			$data=mysql_fetch_assoc($sql);
			switch($field){
				case 'id':
					return $data['id'];
				break;
				case 'tanggal':
					return $data['tanggal'];
				break;
				case 'kategori':
					return $data['kategori'];
				break;
				case 'pelaksana':
					return $data['pelaksana'];
				break;
				case 'stafaset':
					return $data['stafaset'];
				break;
				case 'diterima':
					return $data['diterima'];
				break;
				case 'disetujui':
					return $data['disetujui'];
				break;
				case 'status':
					return $data['status'];
				break;
			}
		}
	}
	//======End Perawatan=========//
	//======Model Table Item Perawatan=========//
	function insert_item($data){
		$sql=mysql_query("insert into $this->item  values('$data[id]','$data[idt]','$data[tanggal]','$data[jenis]','$data[sparepart]','$data[harga]','$data[status]','$data[keterangan]')");
		if($sql){
			return true;
		}
		return false;
	}
	function update_item($data){
		$sql=mysql_query("update $this->item  set tanggal='$data[tanggal]',jenis='$data[jenis]',sparepart='$data[sparepart]',harga='$data[harga]',status='$data[status]',keterangan='$data[keterangan]' where id='$data[id]' and idt='$data[idt]'");
		if($sql){
			return true;
		}
		return false;
	}
	function delete_item($idt,$id){
		$sql=mysql_query("delete from $this->item where id='$id' and idt='$idt'");
		if($sql){
			return true;
		}
		return false;
	}
	function get_where_item($col,$val){
		$sql=mysql_query("select * from $this->item where $col='$val' order by $col");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function get_all_item($idt){
		$sql=mysql_query("select * from $this->item where idt='$idt' order by idt");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function get_item($idt,$id){
		$sql=mysql_query("select * from $this->item where idt='$idt' and id='$id'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function get_total_item($idt){
		$sql=mysql_query("select sum(harga) as jum from $this->item where idt='$idt'");
		while($row=mysql_fetch_assoc($sql))
		return $row['jum'];
	}
	//======End Item Perawatan=========//
	//======Model Table Temp Perawatan=========//
	function insert_temp($data){
		$table=$this->temp.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("insert into $table  values('$data[id]','$data[idt]','$data[tanggal]','$data[jenis]','$data[sparepart]','$data[harga]','$data[status]','$data[keterangan]')");
		if($sql){
			return true;
		}
		return false;
	}
	function update_temp($data){
		$table=$this->temp.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table  set tanggal='$data[tanggal]',jenis='$data[jenis]',sparepart='$data[sparepart]',harga='$data[harga]',status='$data[status]',keterangan='$data[keterangan]' where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function delete_temp($idt,$id){
		$table=$this->temp.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("delete from $table where idt='$idt' and id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function get_all_temp(){
		$table=$this->temp.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select * from $table order by id");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function get_temp($idt,$id){
		$table=$this->temp.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select * from $table where idt='$idt' and id='$id'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function get_total_temp(){
		$table=$this->temp.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select sum(harga) as jum from $table");
		while($row=mysql_fetch_assoc($sql))
		return $row['jum'];
	}
	//======End Temp Perawatan=========//

	function get_like($col,$txt){
		$sql=mysql_query("select * from $this->table where $col like '%$txt%'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getTotal($col,$txt){
		$sql=mysql_query("select sum(harga) as total from $this->item where $col='$txt'");
		while($row=mysql_fetch_assoc($sql))
		$total=$row['total'];
		return $total;
	}
	function getSrc($col,$key){
		$sql=mysql_query("select * from $this->table where $col like '%$key%'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;	
	}
	function clearTemp(){
		$table=$this->temp.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("delete from $table");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set id_barang='$data[id_barang]',tanggal='$data[tanggal]',jenis='$data[jenis]',sparepart='$data[sparepart]',harga='$data[harga]',status='$data[status]',keterangan='$data[keterangan]' where id='$id'");
		print_r($data);
		if($sql){
			return true;
		}
		return false;
	}
}
?>