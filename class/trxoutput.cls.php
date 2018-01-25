<?php
class Trxoutput{
	private $table='dtbarang';
	private $barangkeluar='dtbarangkeluar';
	private $barangkeluaritem='dtbarangkeluaritem';
	function getAll(){
		$sql=mysql_query("select * from $this->table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getLike($cari){
		$sql=mysql_query("select * from $this->barangkeluar where id like '%$cari%'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getRekap($r,$s,$i){
		switch($i){
			case '0':
				$ix='ASC';
			break;
			case '1':
				$ix='DESC';
			break;
		}
		$sql=mysql_query("select * from $this->barangkeluar where tanggal between '$r[mtgl]' and '$r[htgl]' order by $s $ix");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getRekapTotal($r){
		$sql=mysql_query("select sum(total) as total from $this->barangkeluar where tanggal between '$r[mtgl]' and '$r[htgl]'");
		while($row=mysql_fetch_assoc($sql))
		return $row['total'];
	}
	function getItem($idt){
		$sql=mysql_query("select * from $this->barangkeluaritem where idt='$idt'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;		
	}
	function getTrx(){
		$sql=mysql_query("select * from $this->barangmasuk");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getStokOut(){
		$sql=mysql_query("select * from $this->table where stok > 0");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;	
	}
	function getSrc($col,$key){
		$sql=mysql_query("select * from $this->table where $col like '%$key%' and stok > 0");
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
	function getTotalTemp(){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select sum(jumlah) as jum from $table");
		while($data=mysql_fetch_row($sql))
		return $data[0];
	}
	function getTotal($id){
		$sql=mysql_query("select sum(jumlah) as total from $this->barangmasukitem where idt='$id'");
		while($row=mysql_fetch_assoc($sql))
		$total=$row['total'];
		return $total;		
	}
	function getDiskon($id){
		$sql=mysql_query("select sum(diskon) as diskon from $this->barangmasukitem where idt='$id'");
		while($row=mysql_fetch_assoc($sql))
		$diskon=$row['diskon'];
		return $diskon;		
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
				case 'pemohon':
					return $data['pemohon'];
				break;
				case 'id_pengajuan':
					return $data['id_pengajuan'];
				break;
				case 'id_user':
					return $data['id_user'];
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
				case 'qty':
					return $data['qty'];
				break;
				case 'keterangan':
					return $data['keterangan'];
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
				case 'qty':
					return $data['qty'];
				break;
				case 'keterangan':
					return $data['keterangan'];
				break;
			}
		}
	}
	function addTemp($data){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("insert into $table values('$data[idt]','$data[id]','$data[kode]','$data[qty]','$data[keterangan]')");
		if($sql){
			return true;
		}
		return false;
	}
	function addItem($data){
		$sql=mysql_query("insert into dtbarangkeluaritem values('$data[idt]','$data[id]','$data[barcode]','$data[qty]','$data[keterangan]')");
		if($sql){
			return true;
		}
		return false;
	}
	function addData($data){
		$sql=mysql_query("insert into $this->barangkeluar values('$data[id]','$data[id_pengajuan]','$data[tanggal]','$data[pemohon]','$data[total]','$data[id_user]')");
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
		$sql=mysql_query("update $this->barangmasuk set diskon='$data[diskon]',total='$data[total]' where id='$id'");
		if($sql){
			return true;
		}
		return false;		
	}
	function updateDetail($data){
		$sql=mysql_query("update $this->barangmasukitem set harga_beli='$data[harga_beli]',qty='$data[qty]',jumlah='$data[jumlah]',diskon='$data[diskon]' where idt='$data[idt]' and id='$data[id]'");
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
		//print_r($data);
			return true;
		}
		return false;
	}
	function updateQtyItem($data){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table set qty='$data[qty]' where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateQtyTemp($data){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table set qty='$data[qty]' where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateQty($data){
		$table='tempoutput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table set qty='$data[qty]' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->barangmasuk set tanggal='$data[tanggal]',nota='$data[nota]',suplayer='$data[suplayer]',diskon='$data[diskon]',total='$data[total]' where id='$id'");
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