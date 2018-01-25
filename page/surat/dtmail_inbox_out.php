<?php
$sts=$_GET['sts'];
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
$s=$_GET['s'];
if(isset($s)){$s=$s;}else{$s='tanggal DESC';}
if ($page <= 0) $page = 1;
$per_page = 15;
$point = ($page * $per_page) - $per_page;
$cari=$_GET['cari'];
if(isset($cari) and $cari=''){
	$statement = "dtmail_in_out where mfrom='$logid' and mail_from like '%$cari%' or mail_about like '%$cari%' or mail_date like '%$cari%'";
}else{
	$statement = "dtmail_in_out where  mfrom='$logid'";
}
switch($i){case '0':$ix='ASC';break;case '1':$ix='DESC';break;}
$data = mysql_query("SELECT * FROM $statement order by $s $ix LIMIT $point, $per_page");
if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
?>
<div class="p-wrapper">
	<div class="surat">
		<div id="head-mail">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <th width="18%" align="left" style="padding:5px;"><p style="padding-left:10px">
					<a href="<?php echo $link; ?>&m=min_out&s=mto&i=<?php echo $i;?>&sts=<?php echo $sts;?>&cari=<?php echo $cari;?>">TUJUAN</a></p>				
					</th>
				    <th width="17%" align="left" style="padding:5px;">
					<a href="<?php echo $link; ?>&m=min_out&s=tanggal&i=<?php echo $i;?>&sts=<?php echo $sts;?>&cari=<?php echo $cari;?>">TANGGAL SURAT</a>				</th>
				<th width="28%" align="left">
					<a href="<?php echo $link; ?>&m=min_out&s=mail_from&i=<?php echo $i;?>&sts=<?php echo $sts;?>&cari=<?php echo $cari;?>">SURAT DARI</a>				</th>
				<th width="30%" align="left" style="padding:5px;">
					<a href="<?php echo $link; ?>&m=min_out&s=mail_about&i=<?php echo $i;?>&sts=<?php echo $sts;?>&cari=<?php echo $cari;?>">URAIAN SURAT  </a>				</th>
				<th width="7%" align="right" style="padding:5px;">
					<a href="<?php echo $link; ?>&m=min&s=mail_status&i=<?php echo $i;?>&ds=<?php echo $ds; ?>&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">&nbsp;</a>				</th>
			</table>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="mail_box">
			<?php
			while ($row = mysql_fetch_array($data)) {
				if($row['reading']=='0000-00-00 00:00:00'){$background="#EDF3FB";}else{$background="#fff";}
				$start_time=$row['tanggal'];
				if($start_time!='0000-00-00 00:00:00'){
					$selisih=substr(lastM($start_time),-0,-5);
				}else{
					$selisih=substr(lastM($date->format('Y-m-d G:i:s')),-0,-5);
				}
				if($selisih>$max_time&&$row['reading']=='0000-00-00 00:00:00'){$display='visible';}else{$display='hidden';}
			?>			  
			<tr bgcolor="<?php echo $background;?>"  onMouseOver="this.style.color='#666';this.style.cursor='pointer';"onmouseout="this.style.color='#000';" onclick="viewDetail_out('<?php echo $row['id'];?>','<?php echo $set_sts;?>');">
				<td width="18%">
					<p style="padding-left:10px">
					<?php echo $pegawai->getField('jabatan',$row['mto'])."-".$pegawai->getField('nama',$row['mto']);?>
					</p>			  
			  </td>
				<td width="17%">
					<p style="padding-left:10px">
						<?php echo getTanggal($row['mail_date']); ?>								
					</p>								
		  	  </td>
				<td width="27%">
					<p><?php echo $row['mail_from']; ?>
					<span id="alarm" style="visibility:<?php echo $display;?>;">
						<img src="img/alarmclockx.gif" style="width:50px; margin:-5px;" />
			  		</span>
					</p>						
		  	  </td>
				<td width="30%">
					<p><?php echo $row['mail_about']; ?></p>								
		  	  </td>
				<td width="8%" align="center">
					<?php 
					$sts=$row['mail_status']; 
					switch($sts){
						case 'new':
							if($mail->getField('mfrom',$row['id'])!=$logid){
								echo "<img src='img/mail-new.png' />";
							}else{
								echo "<img src='img/mail-new-out.png' />";
							}
						break;
						case 'opn':
							echo "<img src='img/mail-open.png' />";
						break;
						case 'fwd':
							echo "<img src='img/mail-new.png' />";
						break;
						case 'rev':
							echo "<img src='img/draft-fail.png' />";
						break;
						case 'app':
							echo "<img src='img/mail-send.png' />";
						break;
						case 'dis':
							echo "<img src='img/mail-dis.png' />";
						break;
						case 'fin':
							echo "<img src='img/mail-send.png' />";
						break;
						case 'prc':
							echo "<img src='img/mail-prc.png' />";
						break;
						case 'req':
							echo "<img src='img/mail-req.png' />";
						break;
						case 'reg':
							echo "<img src='img/mail-reg.png' />";
						break;
						case 'rep':
							echo "<img src='img/mail-send.png' />";
						break;
						case 'end':
							echo "<img src='img/mail-reg.png' />";
						break;
					}
					?>				
					</td>			
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
	$sts=$_GET['sts'];
	$s=$_GET['s'];
	$i=$_GET['i'];
	if(isset($i)){$i=$i;}else{$i='1';}
	if(isset($s)){$s=$s;}else{$s='tanggal';}
	$url=$link.'&m=min_out&s='.$s.'&sts='.$sts.'&i='.$i;
	$id='id';
	echo pagination($statement,$per_page,$page,$url,$id);
?>
</div>

