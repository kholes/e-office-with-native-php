<?php
class News{
	private $table_in='dtmail_in';
	private $table_in_out='dtmail_in_out';
	private $table_out='dtmail_out';
	private $table_int='dtmail_int';
	private $table_int_out='dtmail_int_out';
	private $table_pengajuan='dtpengajuan';
//========================= fungsi untuk menghasilkan peringatan / notifikasi ========================//
	function getmenu_star_in($logid){
		$sql=mysql_query("select count(id) as num from $this->table_in where mto='$logid' and reading='0000-00-00 00:00:00'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return '0';
	}
	function getmenu_star_int($logid){
		$sql=mysql_query("select count(id) as num from $this->table_int where mto='$logid' and reading='0000-00-00 00:00:00'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return '0';
	}
	function getmin_star($logid){
		$sql=mysql_query("select count(id) as num from $this->table_in where mto='$logid' and reading='0000-00-00 00:00:00' and mail_status in('new','dis','prc')");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return '0';
	}
	function getmint_star($logid){
		$sql=mysql_query("select count(id) as num from $this->table_int where mto='$logid' and reading='0000-00-00 00:00:00'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return '0';
	}
	function check_news($logid){
		$sql=mysql_query("select count(id) as num from $this->table_in where mto='$logid' and reading='0000-00-00 00:00:00' and mail_status in('new','dis')");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return '0';
	}
	function getold_mail_in($id){
		$sql=mysql_query("select count(id) as num from $this->table_in where mto='$id' and reading='0000-00-00 00:00:00'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return '0';
	}
	function getold_mail_int($id){
		$sql=mysql_query("select count(id) as num from $this->table_int where mto='$id' and reading='0000-00-00 00:00:00'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return '0';
	}
//================ Fungi untuk menjumlahkan jumlah surat masuk (Dari luar kantor) di database =================//
	function getmin_head_new($id){
		$sql=mysql_query("select count(id) as num from $this->table_in where mto='$id' and mail_status='new' and reading='0000-00-00 00:00:00'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getmin_head_dis($id){
		$sql=mysql_query("select count(id) as num from $this->table_in where mto='$id' and mail_status='dis' and reading='0000-00-00 00:00:00'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getmin_head_prc($id){
		$sql=mysql_query("select count(id) as num from $this->table_in where mto='$id' and mail_status='prc' and reading='0000-00-00 00:00:00'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getmin_head_rem($id){
		$sql=mysql_query("select count(id) as num from $this->table_in where mto='$id' and mail_status='rem'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
//=====Fungi untuk menjumlahkan jumlah surat keluar (Dari luar kantor yang diteruskan) di database==//
	function getmout($id){
		$sql=mysql_query("select count(id) as num from $this->table_in_out where mfrom='$id' and reading='0000-00-00 00:00:00'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
//===== SURAT INTERNAL menjumlahkan di database =====//
	function getint_head_in($id){
		$sql=mysql_query("select count(id) as num from $this->table_int where mto='$id' and reading='0000-00-00 00:00:00'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getint_head_out($id){
		$sql=mysql_query("select count(id) as num from $this->table_int where mfrom='$id' and reading='0000-00-00 00:00:00'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
//===== PENGAJUAN BARANG =====//
	function getmenu_star_pengajuan($level){
		switch($level){
			case'KTU':$sts='0';break;
			case'KKR':$sts='1';break;
			case'STB':$sts='2';break;
		}
		$sql=mysql_query("select count(id) as num from $this->table_pengajuan where status='$sts'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return '0';
	}
	function getpengajuan_head_new($level){
		switch($level){
			case'KTU':$sts='0';break;
			case'KKR':$sts='1';break;
			case'STB':$sts='2';break;
		}
		$sql=mysql_query("select count(id) as num from $this->table_pengajuan where status='$sts'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return false;
	}
	function getold_pengajuan($level){
		switch($level){
			case'KTU':$sts='0';break;
			case'KKR':$sts='1';break;
			case'STB':$sts='2';break;
		}
		$sql=mysql_query("select count(id) as num from $this->table_pengajuan where status='$sts'");
		while($row=mysql_fetch_assoc($sql))
		if($row['num']>0){
			return $row['num'];
		}
		return '0';
	}
}
?> 