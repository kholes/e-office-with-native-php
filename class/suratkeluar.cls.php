<?php
class Suratkeluar{
	private $table='dtsuratkeluar';
	function getAll(){
		$sql=mysql_query("select * from $this->table");
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
	function getMailKsi($sts,$level){
		$logid=decrypt_url($_SESSION['id_user']);
		$sql=mysql_query("select * from $this->table where disposisi like '%$logid%' and status='$sts'");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		return $data;
	}
	function getCountKkr($sts,$jab){
		$sql=mysql_query("select count(id) as num from $this->table where disetujui='$jab' and status='$sts'");
		while($row=mysql_fetch_assoc($sql))
		return $row['num'];
	}
	function getCountKtu($sts,$jab){
		$sql=mysql_query("select count(id) as num from $this->table where status='$sts'");
		while($row=mysql_fetch_assoc($sql))
		return $row['num'];
	}
	function getCountKsi($sts,$jabatan){
		$sql=mysql_query("select count(id) as num from $this->table where diketahui like '%$jabatan%'");
		while($row=mysql_fetch_assoc($sql))
		return $row['num'];
	}
	function getCountStf($sts,$logid){
		$sql=mysql_query("select count(id) as num from $this->table where jabatan_user='$logid' and status='$sts'");
		while($row=mysql_fetch_assoc($sql))
		return $row['num'];
	}
	function getCountSkr($sts,$level){
		$sql=mysql_query("select count(id) as num from $this->table where status='terkirim'");
		while($row=mysql_fetch_assoc($sql))
		return $row['num'];
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
				case 'jenis':
					return $data['jenis'];
				break;
				case 'idrep':
					return $data['idrep'];
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
				case 'diketahui':
					return $data['diketahui'];
				break;
				case 'noindex':
					return $data['noindex'];
				break;
				case 'kode':
					return $data['kode'];
				break;
				case 'uraian':
					return $data['uraian'];
				break;
				case 'surat':
					return $data['surat'];
				break;
				case 'lampiran':
					return $data['lampiran'];
				break;
				case 'jabatan_user':
					return $data['jabatan_user'];
				break;
				case 'keterangan':
					return $data['keterangan'];
				break;
				case 'status':
					return $data['status'];
				break;
			}
		}
	}
	function addData($data){
		$sql=mysql_query("insert into $this->table values('$data[id]','$data[jenis]','$data[idrep]','$data[nourut]','$data[nosurat]','$data[tanggal]','$data[dari]','$data[tujuan]','$data[diketahui]','$data[disetujui]','$data[noindex]','$data[kode]','$data[uraian]','$data[surat]','$data[lampiran]','$data[keterangan]','proses','$data[logid]')");
		if($sql){
			return true;
		}
		return false;
	}
	function updateData($id,$data){
		$sql=mysql_query("update $this->table set nosurat='$data[nosurat]',tanggal='$data[tanggal]',dari='$data[dari]',tujuan='$data[tujuan]',diketahui='$data[diketahui]',noindex='$data[noindex]',kode='$data[kode]',rangkuman='$data[rangkuman]',surat='$data[surat]',lampiran='$data[lampiran]' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function register($data){
		$sql=mysql_query("update $this->table set noindex='$data[noindex]',kode='$data[kode]',tanggal='$data[tanggal]',nourut='$data[nourut]',nosurat='$data[nosurat]',tujuan='$data[tujuan]',uraian='$data[uraian]',status='$data[status]' where id='$data[id]'");
		if($sql){
			return true;
		}
		return false;
	}
	function updateRevisi($id,$data){
		$sql=mysql_query("update $this->table set dari='$data[dari]',tujuan='$data[tujuan]',uraian='$data[uraian]',keterangan='$data[keterangan]',surat='$data[surat]',status='proses' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function revisi($id,$keterangan){
		$sql=mysql_query("update $this->table set keterangan='$keterangan',status='revisi' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function pengajuan($id,$kkr){
		$sql=mysql_query("update $this->table set disetujui='$kkr' where id='$id'");
		if($sql){
			return true;
		}
		return false;
	}
	function disetujui($id){
		$sql=mysql_query("update $this->table set status='disetujui' where id='$id'");
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