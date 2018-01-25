<?php
class Pengajuan{
	private $table='dtpengajuan';
	private $barang='dtbarang';
	private $item='dtpengajuanitem';
	function getAll(){
		$sql=mysql_query("select * from $this->table order by tgl_pengajuan DESC");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getPengajuan($log){
		$sql=mysql_query("select * from $this->table where pemohon='$log' order by tgl_pengajuan DESC");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getPenerimaan(){
		$sql=mysql_query("select * from $this->table where status='0' order by tgl_pengajuan DESC");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getPersetujuan(){
		$sql=mysql_query("select * from $this->table where status='1' order by tgl_pengajuan DESC");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getPenyiapan(){
		$sql=mysql_query("select * from $this->table where status >= 2 order by tgl_pengajuan DESC");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	/*
	function getPengajuan($sts){
		$sql=mysql_query("select * from $this->table where status='$sts'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;	
	}
	*/
	function getLike($cari){
		$sql=mysql_query("select * from $this->table where id like '%$cari%'");
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
		$sql=mysql_query("select * from $this->table where tgl_pengajuan between '$r[mtgl]' and '$r[htgl]' order by $s $ix");
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
	function addTemp($data){
		$table='temppengajuan'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("insert into $table values('$data[idt]','$data[id]','$data[kode]','$data[qty]','$data[jumlah]','$data[diskon]','$data[keterangan]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateTemp($data){
		$table='temppengajuan'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table set qty='$data[qty]',jumlah='$data[jumlah]',diskon='$data[diskon]',keterangan='$data[keterangan]' where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function getTemp(){
		$table='temppengajuan'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select * from $table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;		
	}
	function getTotalTemp(){
		$table='temppengajuan'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select sum(jumlah) as jum from $table");
		while($data=mysql_fetch_row($sql))
		return $data[0];
	}
	function deleteTemp($data){
		$table='temppengajuan'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("delete from $table where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateQtyItem($data){
		$sql=mysql_query("update $this->item set qty='$data[qty]' where idt='$data[idt]' and id='$data[id]'");
		//print_r($data);
		if($sql){
			return true;
		}
		return false;
	}
	function updateQtyTemp($data){
		$table='temppengajuan'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table set qty='$data[qty]' where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function cekTemp(){
		$table='temppengajuan'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select count(idt) as idt from $table");
		while($data=mysql_fetch_row($sql))
		return $data[0];
	}
	function clearTemp(){
		$table='temppengajuan'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("delete from $table");	
	}
	function tempDiskon(){
		$table='temppengajuan'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select sum(diskon) as diskon from $table");
		while($row=mysql_fetch_assoc($sql))
		$diskon=$row['diskon'];
		return $diskon;		
	}
	function addItem($data){
		$sql=mysql_query("insert into $this->item values('$data[idt]','$data[id]','$data[kode]','$data[qty]','$data[jumlah]','$data[diskon]','$data[keterangan]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateItem($data){
		$sql=mysql_query("update $this->item set harga_beli='$data[harga]',qty='$data[qty]',jumlah='$data[jumlah]',diskon='$data[diskon]',keterangan='$data[keterangan]' where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateTerima($data){
		$sql=mysql_query("update $this->item set qty='$data[qty]',jumlah='$data[jumlah]',keterangan='$data[keterangan]' where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function setStatus($data){
		switch($_POST['set_sts']){
			case '1':$col='tgl_diterima';break;
			case '2':$col='tgl_disetujui';break;
			case '3':$col='tgl_penyiapan';break;
			case '4':$col='tgl_pengiriman';break;
		}
		echo $col;
		$sql=mysql_query("update $this->table set $col='$data[tanggal]',status='$data[status]' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function setTolak($id){
		$sql=mysql_query("update $this->table set status='6' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function deleteItem($data){
		$sql=mysql_query("delete from $this->item where idt='$data[idt]' and id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function getItem($idt){
		$sql=mysql_query("select * from $this->item where idt='$idt'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;		
	}
	function setKirim($id,$data){
		$sql=mysql_query("update $this->table set status='$data[status]',tgl_pengiriman='$data[tanggal]',staf='$data[staf]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function setPenerima($data){
		$sql=mysql_query("update $this->table set tgl_penyerahan='$data[tanggal]',status='4',penerima='$data[penerima]' where id='$data[id]'");
		if($sql){
			//print_r($data);
			return true;
		}
		return false;		
	}
	function getFieldTemp($field,$id){
		$table='temppengajuan'.decrypt_url($_SESSION['id_user']);
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
	function getFieldItem($field,$data){
		$sql=mysql_query("select * from $this->item where idt='$data[idt]' and id='$data[id]'");
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
	function getTotal($id){
		$sql=mysql_query("select sum(jumlah) as total from $this->item where idt='$id'");
		while($row=mysql_fetch_assoc($sql))
		$total=$row['total'];
		return $total;		
	}
	function getDiskon($id){
		$sql=mysql_query("select sum(diskon) as diskon from $this->item where idt='$id'");
		while($row=mysql_fetch_assoc($sql))
		$diskon=$row['diskon'];
		return $diskon;		
	}
	function getQtyPengajuan($id){
		$sql=mysql_query("SELECT sum(qty) as jumlah FROM dtpengajuanitem WHERE id='$id' and idt IN (SELECT id FROM dtpengajuan where status in ('0','1'))");
		while($row=mysql_fetch_assoc($sql))
		return $row['jumlah'];		
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[idt]','$data[pemohon]','$data[tgl_pengajuan]','$data[tgl_diterima]','$data[tgl_disetujui]','$data[tgl_pengiriman]','$data[penyerahan]','$data[penerima]','$data[status]','$data[staf]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set tanggal='$data[tanggal]',pemohon='$data[pemohon]',tgl_terima='$data[tgl_terima]',pejabat='$data[pejabat]',pengesahan='$data[pengesahan]',status='$data[status]',tgl_kirim='$data[tgl_kirim]',penerima='$data[penerima]' where id='$id'");
		if($sql){
			return true;
		}
		return false;		
	}
	function deleteData($id){
		$sql=mysql_query("delete from $this->table where id='$id'");
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
				case 'pemohon':
					return $data['pemohon'];
				break;
				case 'tgl_pengajuan':
					return $data['tgl_pengajuan'];
				break;
				case 'tgl_diterima':
					return $data['tgl_diterima'];
				break;
				case 'tgl_disetujui':
					return $data['tgl_disetujui'];
				break;
				case 'tgl_pengiriman':
					return $data['tgl_pengiriman'];
				break;
				case 'tgl_penyerahan':
					return $data['tgl_penyerahan'];
				break;
				case 'penerima':
					return $data['penerima'];
				break;
				case 'status':
					return $data['status'];
				break;
				case 'staf':
					return $data['staf'];
				break;
			}
		}
	}
	function updateQty($data){
		$table='temppengajuan'.decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("update $table set qty='$data[qty]' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
}
?>