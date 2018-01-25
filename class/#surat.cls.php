<?php
class Surat{
	private $table='dtsuratmasuk';
	function getAll(){
		$sql=mysql_query("select * from $this->table");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getMailKkr($sts,$level,$ord,$point,$limit){
		/*
		if($sts==''){
			$sql=mysql_query("select * from $this->table where tujuan like '%$level%' and status='new'");
		}else{
			$sql=mysql_query("select * from $this->table where tujuan like '%$level%' and status='$sts'");
		}
		*/
		$sql=mysql_query("select * from $this->table where tujuan like '%$level%' order by $ord limit $point,$limit");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getMailKtu($sts,$level){
		$sql=mysql_query("select * from $this->table where tujuan like '%$level%' and status='$sts'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getMailSkr($sts,$level){
		if($sts=='all'){
			$sql=mysql_query("select * from $this->table");
		}else{
			$sql=mysql_query("select * from $this->table where status='$sts'");
		}
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getRem($level){
		$logid=decrypt_url($_SESSION['id_user']);
		if($level!='KSI'){
			$sql=mysql_query("select count(id) as num from dtsuratmasuk where bataswaktu!='0000-00-00' and status!='fin' and status!='new'");
		}else{
			$sql=mysql_query("select count(id) as num from dtsuratmasuk where disposisi like '%$logid%' and bataswaktu!='0000-00-00' and status!='fin' and status!='new'");
		}
		while($row=mysql_fetch_assoc($sql))
		return $row['num'];
	}
	function getMailKsi($sts,$level){
		$logid=decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select * from $this->table where disposisi like '%$logid%' and status='$sts'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getCountKkr($sts,$jab){
		if($sts!='rem'){
			$sql=mysql_query("select count(id) as num from $this->table where tujuan like '%$jab%' and status='$sts'");
		}else{
			$sql=mysql_query("select count(id) as num from $this->table where tujuan like '%$jab%' and status!='fin' and bataswaktu!='0000-00-00'");
		}
		while($row=mysql_fetch_assoc($sql))
		return $row['num'];
	}
	function getCountKtu($sts,$jab){
		if($sts!='rem'){
			$sql=mysql_query("select count(id) as num from $this->table where disposisi like '%$jab%' or  tujuan like '%$jab%'");
		}else{
			$sql=mysql_query("select count(id) as num from $this->table where disposisi like '%$jab%' and status!='fin' and bataswaktu!='0000-00-00'");
		}
		$sql=mysql_query("select count(id) as num from $this->table where disposisi like '%$jab%' or  tujuan like '%$jab%'");
		while($row=mysql_fetch_assoc($sql))
		return $row['num'];
	}
	function getCountKsi($sts,$logid){
		if($sts!='rem'){
			$sql=mysql_query("select count(id) as num from $this->table where disposisi like '%$logid%' and status='$sts'");
		}else{
			$sql=mysql_query("select count(id) as num from $this->table where disposisi like '%$logid%' and status!='fin' and bataswaktu!='0000-00-00'");
		}
		while($row=mysql_fetch_assoc($sql))
		return $row['num'];
	}
	function getCountSkr($sts,$level){
		if($sts!='new'){
			$sql=mysql_query("select count(id) as num from $this->table where status='$sts'");
		}else{
			$sql=mysql_query("select count(id) as num from $this->table");
		}
		while($row=mysql_fetch_assoc($sql))
		return $row['num'];
	}
	function getRow($id){
		$sql=mysql_query("select * from $this->table where id='$id'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getWhere($col,$val){
		$sql=mysql_query("select * from $this->table where $col like '%$val%'");
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
				case 'nourut':
					return $data['nourut'];
				break;
				case 'nosurat':
					return $data['nosurat'];
				break;
				case 'tanggal':
					return $data['tanggal'];
				break;
				case 'dari':
					return $data['dari'];
				break;
				case 'tujuan':
					return $data['tujuan'];
				break;
				case 'kode':
					return $data['kode'];
				break;
				case 'noindex':
					return $data['noindex'];
				break;
				case 'rangkuman':
					return $data['rangkuman'];
				break;
				case 'surat':
					return $data['surat'];
				break;
				case 'lampiran':
					return $data['lampiran'];
				break;
				case 'status':
					return $data['status'];
				break;
				case 'bataswaktu':
					return $data['bataswaktu'];
				break;
				case 'disposisi':
					return $data['disposisi'];
				break;
				case 'tgl_dis':
					return $data['tgl_dis'];
				break;
				case 'pejabat_dis':
					return $data['pejabat_dis'];
				break;
				case 'catatan':
					return $data['catatan'];
				break;
			}
		}
	}
	function disposisi($data){
		$sql=mysql_query("update $this->table set status='$data[status]',disposisi='$data[disposisi]',tgl_dis='$data[tanggal]',pejabat_dis='$data[pejabat_dis]',catatan='$data[catatan]',bataswaktu='$data[bataswaktu]' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[nourut]','$data[nosurat]','$data[tanggal]','$data[dari]','$data[tujuan]','$data[kode]','$data[noindex]','$data[rangkuman]','$data[surat]','$data[lampiran]','$data[status]','','','','$data[bataswaktu]','','','0')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set nosurat='$data[nosurat]',tanggal='$data[tanggal]',dari='$data[dari]',tujuan='$data[tujuan]',kode='$data[kode]',noindex='$data[noindex]',rangkuman='$data[rangkuman]',file='$data[file]',lampiran='$data[lampiran]',status='$data[status]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateRep($data){
		$sql=mysql_query("update $this->table set status='$data[status]',idrep='$data[idrep]' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateStatus($id,$sts){
		$sql=mysql_query("update $this->table set status='$sts' where id='$id'");
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