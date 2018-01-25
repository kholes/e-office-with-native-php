<?php
/*
$m=$_GET['m'];
$type=$_GET['o'];
$cari=$_GET['cari'];
$sts=$_GET['sts'];
if(!isset($m)){$m='min_int';}
if(!isset($type)){$type='in';}
if(!isset($sts)){$sts='new';}
*/
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
$s=$_GET['s'];
if(isset($s)){$s=$s;}else{$s='tanggal';}
if ($page <= 0) $page = 1;
$per_page = 15;
$point = ($page * $per_page) - $per_page;
$cari=$_GET['cari'];
if(isset($cari)){
	$statement = "dtmail_out where nourut like '%$cari%' or jenis like '%$cari%' or tanggal like '%$cari%' or klasifikasi like '%$cari%' or codeindex like '%$cari%' or nosurat like '%$cari%' or tgl_surat like '%$cari%' or dari like '%$cari%' or tujuan like '%$cari%' or uraian like '%$cari%'";
}else{
	$statement = "dtmail_out";
}
switch($i){case '0':$ix='ASC';break;case '1':$ix='DESC';break;}
$data = mysql_query("SELECT * FROM $statement order by $s $ix LIMIT $point, $per_page");
if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<div class="p-wrapper">
	<div class="surat">
		<div id="head-mail">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <th width="16%" align="left" style="padding:5px;"><p style="padding-left:10px">
					<a href="<?php echo $link; ?>&m=mout&s=dari&i=<?php echo $i;?>&cari=<?php echo $_GET['cari'];?>">SURAT DARI</a></p>				
					</th>
				    <th width="17%" align="left" style="padding:5px;">
					<a href="<?php echo $link; ?>&m=mout&s=tanggal&i=<?php echo $i;?>&cari=<?php echo $_GET['cari'];?>">TANGGAL SURAT</a>				</th>
				<th width="30%" align="left">
					<a href="<?php echo $link; ?>&m=mout&s=tujuan&i=<?php echo $i;?>&cari=<?php echo $_GET['cari'];?>">TUJUAN</a>				</th>
				<th width="30%" align="left" style="padding:5px;">
					<a href="<?php echo $link; ?>&m=mout&s=uraian&i=<?php echo $i;?>&cari=<?php echo $_GET['cari'];?>">URAIAN SURAT  </a>				</th>
					<th>&nbsp;</th>
				<!--
				<th width="13%" align="left">
					<a href="<?php echo $link; ?>&m=min&s=mail_forward&i=<?php echo $i;?>&ds=<?php echo $ds; ?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">DISPOSISI</a>				
				</th> 
				-->
			</table>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="mail_box">
			<?php
			while ($row = mysql_fetch_array($data)) {
			?>			  
			<tr bgcolor="<?php echo $background;?>"  onMouseOver="this.style.color='#666';this.style.cursor='pointer';"onmouseout="this.style.color='#000';" onclick="viewDetailOut('<?php echo $row['id'];?>','<?php echo $set_sts;?>');">
				<td width="16%">
					<p style="padding-left:10px">
			<?php echo $pegawai->getField('jabatan',$row['dari'])."-".$pegawai->getField('nama',$row['dari']);?>					
					</p>			  
			  </td>
				<td width="17%">
					<p style="padding-left:10px">
						<?php echo getTanggal($row['tgl_surat']); ?>								
					</p>								
		  	  </td>
				<td width="30%">
					<p><?php echo $row['tujuan']; ?></p>						
			  	</td>
				<td width="30%">
					<p><?php echo $row['uraian']; ?></p>								
		  	  </td>
				<td width="7%"><img src='img/mail-reg.png' width="25px;" /></td>
			</tr>
			<tr>
				<td colspan="7">
					<div style="width:100%" id="detail<?php echo $row['id'];?>"></div>				
				</td>
			</tr>
			<?php
			}
			?>
		</table>
	</div>
</div>
		<div class="c5"></div>
		<div id="pagination">
		<?php
			$url=$link.'&m=mout&s='.$s.'&i='.$i;
			$id='id';
			echo pagination($statement,$per_page,$page,$url,$id);
		?>
		</div>

