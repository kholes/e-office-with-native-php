<?php
class Dtbarangmasuk{
	private $table='dtbarang';
	private $barangmasuk='dtbarangmasuk';
	private $barangmasukitem='dtbarangmasukitem';
	function getAll(){
		$sql=mysql_query("select * from $this->table");
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
	function get_all_trx($id){
		$sql=mysql_query("select qty from $this->barangmasukitem where id='$id'");
		while($row=mysql_fetch_row($sql))
		return $row[0];
	}
	function getSrc($col,$key){
		if($key!=''){
			$sql=mysql_query("select * from $this->table where $col like '%$key%'");
		}else{
			$sql=mysql_query("select * from $this->table");
		}
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;	
	}
	function getLike($col,$key){
		$sql=mysql_query("select * from $this->barangmasuk where $col like '%$key%'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;	
	}
	function getTemp(){
		$table='tempinput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select * from $table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;		
	}
	function getDetail($idt){
		$sql=mysql_query("select * from dtbarangmasukitem where idt='$idt'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;		
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
	function tempDiskon(){
		$table='tempinput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select sum(diskon) as diskon from $table");
		while($row=mysql_fetch_assoc($sql))
		$diskon=$row['diskon'];
		return $diskon;		
	}
	function getHeadField($field,$id){
		$sql=mysql_query("select * from $this->barangmasuk where id='$id'");
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
		$table='tempinput'.decrypt_url($_SESSION['id_user']);
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
				case 'harga':
					return $data['harga_beli'];
				break;
				case 'qty':
					return $data['qty'];
				break;
				case 'diskon':
					return $data['diskon'];
				break;
				case 'jumlah':
					return $data['jumlah'];
				break;
			}
		}
	}
	function getFieldDetail($field,$data){
		$sql=mysql_query("select * from $this->barangmasukitem where idt='$data[idt]' and id='$data[id]'");
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
		$table='tempinput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("insert into $table values('$data[idt]','$data[id]','$data[kode]','$data[nama]','$data[harga_beli]','$data[qty]','$data[jumlah]','$data[diskon]')");
		if($sql){
			return true;
		}
		return false;
	}
	function getTotalTemp(){
		$table='tempinput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select sum(jumlah) as jum from $table");
		while($data=mysql_fetch_row($sql))
		return $data[0];
	}
	function get_total($field,$id,$m,$h){
		$sql=mysql_query("select sum(dtbarangmasukitem.qty) as jumlah,dtbarangmasukitem.harga_beli from dtbarangmasuk,dtbarangmasukitem where dtbarangmasuk.id=dtbarangmasukitem.idt and dtbarangmasukitem.id='$id' and dtbarangmasuk.tanggal between '$m' and '$h' order by dtbarangmasuk.tanggal");
		$data=mysql_fetch_assoc($sql);
		switch($field){
			case 'qty':
				return $data['jumlah'];
			break;
			case 'harga':
				return $data['harga_beli'];
			break;
		}
	}
	function get_total_trx($id){
		$sql=mysql_query("select sum(qty) as jumlah from dtbarangmasukitem where id='$id'");
		while($data=mysql_fetch_row($sql))
		return $data[0];
	}
	function get_trxawal(){
		$sql=mysql_query("select tanggal from dtbarangmasuk order by tanggal limit 1");
		while($tgl=mysql_fetch_row($sql)){return $tgl[0];}
	}
	function cekTemp(){
		$table='tempinput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select count(idt) as idt from $table");
		while($data=mysql_fetch_row($sql))
		return $data[0];
	}
	function addItem($data){
		$sql=mysql_query("insert into dtbarangmasukitem values('$data[idt]','$data[id]','$data[kode]','$data[nama]','$data[harga_beli]','$data[qty]','$data[jumlah]','$data[diskon]')");
		if($sql){
			return true;
		}
		return false;
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
		$sql=mysql_query("select * from $this->barangmasuk where tanggal between '$r[mtgl]' and '$r[htgl]' order by $s $ix");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getRekapData($s,$i){
		switch($i){
			case '0':
				$ix='ASC';
			break;
			case '1':
				$ix='DESC';
			break;
		}
		$sql=mysql_query("select * from $this->barangmasuk order by $s $ix");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getRekapTotal($r){
		$sql=mysql_query("select sum(total) as total from $this->barangmasuk where tanggal between '$r[mtgl]' and '$r[htgl]'");
		while($row=mysql_fetch_assoc($sql))
		return $row['total'];
	}
	function addData($data){
		$sql=mysql_query("insert into $this->barangmasuk values('$data[id]','$data[tanggal]','$data[nota]','$data[suplayer]','$data[diskon]','$data[total]','$data[id_user]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateTemp($data){
		$table='tempinput'.decrypt_url($_SESSION['id_user']);
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
		$table='tempinput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("delete from $table where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function deleteDetail($data){
		$sql=mysql_query("delete from $this->barangmasukitem where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateQty($id,$data){
		$table='tempinput'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table set qty='$data[qty]' where id='$id'");
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