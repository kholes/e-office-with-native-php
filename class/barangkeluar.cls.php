<?php
class Barangkeluar{
	private $table='dtbarang';
	private $barangkeluar='dtbarangkeluar';
	private $barangkeluaritem='dtbarangkeluaritem';
	function getAll(){
		$sql=mysql_query("select * from $this->table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getTrx(){
		$sql=mysql_query("select * from $this->barangkeluar");
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
	function getLike($col,$key){
		$sql=mysql_query("select * from $this->barangkeluar where $col like '%$key%'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;	
	}
	function getTemp(){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select * from $table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;		
	}
	function getDetail($idt){
		$sql=mysql_query("select * from dtbarangkeluaritem where idt='$idt'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;		
	}
	function getTotal($id){
		$sql=mysql_query("select sum(jumlah) as total from $this->barangkeluaritem where idt='$id'");
		while($row=mysql_fetch_assoc($sql))
		$total=$row['total'];
		return $total;		
	}
	function getDiskon($id){
		$sql=mysql_query("select sum(diskon) as diskon from $this->barangkeluaritem where idt='$id'");
		while($row=mysql_fetch_assoc($sql))
		$diskon=$row['diskon'];
		return $diskon;		
	}
	function editQty($data){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table set qty='$data[qty]',keterangan='$data[ket]' where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function delTempOut($id){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("delete from $table where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function tempTotal(){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select sum(jumlah) as total from $table");
		while($row=mysql_fetch_assoc($sql))
		$total=$row['total'];
		return $total;		
	}
	function tempDiskon(){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select sum(diskon) as diskon from $table");
		while($row=mysql_fetch_assoc($sql))
		$diskon=$row['diskon'];
		return $diskon;		
	}
	function getHeadField($field,$id){
		$sql=mysql_query("select * from $this->barangkeluar where id='$id'");
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
				case 'nota':
					return $data['nota'];
				break;
				case 'suplayer':
					return $data['suplayer'];
				break;
				case 'diskon':
					return $data['diskon'];
				break;
				case 'total':
					return $data['total'];
				break;
			}
		}
	}
	function getField($field,$id){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select * from $table where id='$id'");
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
				case 'nama':
					return $data['nama'];
				break;
				case 'satuan':
					return $data['satuan'];
				break;
				case 'harga':
					return $data['harga_beli'];
				break;
				case 'qty':
					return $data['qty'];
				break;
				case 'diskon':
					return $data['diskon'];
				break;
			}
		}
	}
	function getFieldDetail($field,$data){
		$sql=mysql_query("select * from $this->barangkeluaritem where idt='$data[idt]' and id='$data[id]'");
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
				case 'nama':
					return $data['nama'];
				break;
				case 'satuan':
					return $data['satuan'];
				break;
				case 'harga':
					return $data['harga_beli'];
				break;
				case 'qty':
					return $data['qty'];
				break;
				case 'jumlah':
					return $data['jumlah'];
				break;
				case 'diskon':
					return $data['diskon'];
				break;
			}
		}
	}
	function addTemp($data){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("insert into $table values('$data[idt]','$data[id]','$data[kode]','$data[nama]','$data[satuan]','$data[harga]','$data[qty]','$data[jumlah]','$data[diskon]','$data[keterangan]')");
		if($sql){
			return true;
		}
		return false;
	}
	function addItem($data){
		$sql=mysql_query("insert into dtbarangkeluaritem values('$data[idt]','$data[id]','$data[kode]','$data[nama]','$data[satuan]','$data[harga]','$data[qty]','$data[diskon]','$data[keterangan]')");
		if($sql){
			return true;
		}
		return false;
	}
	function addData($data){
		$sql=mysql_query("insert into $this->barangkeluar values('$data[id]','$data[tgl_keluar]','$data[staff_gudang]','$data[tgl_kirim]','$data[penerima]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateTemp($data){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table set harga_beli='$data[harga_beli]',qty='$data[qty]',jumlah='$data[jumlah]',diskon='$data[diskon]' where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateHeadCount($id,$data){
		$sql=mysql_query("update $this->barangkeluar set diskon='$data[diskon]',total='$data[total]' where id='$id'");
		if($sql){
			return true;
		}
		return false;		
	}
	function updateDetail($data){
		$sql=mysql_query("update $this->barangkeluaritem set harga_beli='$data[harga_beli]',qty='$data[qty]',jumlah='$data[jumlah]',diskon='$data[diskon]' where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function deleteTemp($data){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("delete from $table where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function deleteDetail($data){
		$sql=mysql_query("delete from $this->barangkeluaritem where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateQty($id,$data){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table set qty='$data[qty]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->barangkeluar set tanggal='$data[tanggal]',nota='$data[nota]',suplayer='$data[suplayer]',diskon='$data[diskon]',total='$data[total]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function clearTemp($table){
		$sql=mysql_query("delete from $table");	
	}
	function delData($id){
		$sql=mysql_query("delete from $this->table where id='$id'");
	}
}
?>