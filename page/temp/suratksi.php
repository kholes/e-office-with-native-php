<script>
	setInterval(function(){
		getDis();
		getRem();
	}, 1000);
	$(document).ready(function(){
		$('#btcari').click(function(){
			window.location='<?php echo $link; ?>&cari='+$('#cari').val();
		});
	});
	$(document).ready(function() {
		$("a.media").media({
			width:100+'%', 
			height:1000,
		});
		$('#cari').focus();
		getDis();				
   });
   	function viewHide(id){
		$('#infItem'+id).slideUp(400).html(res);
	}
	function viewItem(id){
		$.ajax({
			type: 'POST',
			url: 'ajaxtemp.php',
			data: 'req=getDetailSurat&id='+id+'',
			success: function(res){
				$('#infItem'+id).slideDown('fast').html(res);
			}
		});		
	}
	function getDis(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getCount&sts=dis',cache :false,success:function (data){
			var oldMail=document.getElementById('infDis').innerHTML;
			if(parseInt(data) > parseInt(oldMail)){
				$('#chatAudio')[0].play();
				alert('Surat baru masuk');
				window.location='<?php echo $link; ?>';
			}
			$('#infDis').html(data);

		}});
	}
	function getRem(){
		$.ajax({type:'post',url:'<?php echo $linkdata; ?>',data:'btn=getRem&sts=all',cache :false,success:function (data){$('#infRem').html(data);}});
	}
		$('<audio id="chatAudio"><source src="sound/notify.ogg" type="audio/ogg"><source src="sound/notify.wav" type="audio/mpeg"><source src="sound/notify.wav" type="audio/wav"></audio>').appendTo('body');
</script>
	<div class="p-head">
        <div class="p-head-c">
			<div id="right">
			  <input type="text" name="cari" id="cari" value="<?php echo $_GET['cari']; ?>" />
			  &nbsp;
			  <input type="button" id="btcari" value="Cari" />
		  </div>
			<div id="left">
				<div id="menu-head">
					<ul>
						<li><a href="<?php echo $link; ?>&sts=dis">Surat Masuk <span class="counter" id="infDis"></span></a></li>
						<li><a href="<?php echo $link; ?>&sts=rem">Surat Berbatas <span class="blink" id="infRem"></span></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="p-wrapper">
	  <div class="surat">
			<?php
				switch($get){
					case '':
					$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
					$s=$_GET['s'];
					if(isset($s)){
						$s=$s;
					}else{
						$s='tanggal';
					}
					if ($page <= 0) $page = 1;
						$per_page = 5;
						$point = ($page * $per_page) - $per_page;
						$cari=$_GET['cari'];
						$sts=$_GET['sts'];
						if(!isset($cari)){
							switch($sts){
								case '':
									$sts='dis';
									$statement = "dtsuratmasuk where status='".$sts."' order by $s";							
								break;
								case 'rem':
									$statement = "dtsuratmasuk where disposisi like '%$logid%' and status!='new' and bataswaktu!='0000-00-00' order by $s";							
								break;
								case $sts:
									$statement = "dtsuratmasuk where status='".$sts."' order by $s";	
								break;						
							}
						}else{
							$statement = "dtsuratmasuk where disposisi like '%$logid%' and tanggal like '%$cari%' and status='dis' order by $s";
						}
						$data = mysql_query("SELECT * FROM $statement LIMIT $point, $per_page");
						?>				
						<div id="head-mail">
							<div>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <th width="12%" align="left"><a href="<?php echo $link; ?>&s=tanggal&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">Tanggal</a></th>
									<th width="29%" align="left"><a href="<?php echo $link; ?>&s=dari&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">Dari</a></th>
								<th width="54%" align="left"><a href="<?php echo $link; ?>&s=rangkuman&sts=<?php echo $_GET['sts'];?>&cari=<?php echo $_GET['cari'];?>">Ringkasan</a></th>
								<th width="5%" align="left">&nbsp;</th>
							</table>
							</div>
						</div>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<?php
									while ($row = mysql_fetch_array($data)) {
										$sts=$row['status']; 
										if($sts=='new'){$background="EDF3FB";}else{$background='#fff';}
										?>			  
									<tr bgcolor="<?php echo $background;?>" onmouseover="this.style.cursor='pointer';">
										<td width="13%" class="mail"><?php echo getTanggal($row['tanggal']); ?></td>
										<td width="29%" class="mail"><?php echo $row['dari']; ?></td>
										<td width="54%" class="mail"><?php echo $row['rangkuman']; ?></td>
										<td width="4%" class="mail" align="right">
								<li class="tooltip">
									<?php 
									$sts=$row['status']; 
									switch($sts){
										case 'new':
											echo "<img src='img/mail-new.png' />";
										break;
										case 'dis':
											echo "<img src='img/mail-dis.png' />";
										break;
									}
									?>			  
									<span><b></b>
										<div class="main">			
											<div class="work">
												<a class="thickbox" href="page/surat/detail.php?height=400 width=200&id=<?php echo $row['id']; ?>">
													<img src="img/surat-detail.png" class="media" alt="" />
													<div class="caption">
														<div class="work_title">
															<h1>D E T A I L</h1>
														</div>
													</div>
												</a>		
											</div>
											<div class="work">
												<a class="thickbox" href="page/surat/disposisi.php?height=400 width=200&id=<?php echo $row['id']; ?>">
													<img src="img/dis.png" class="media" alt=""/>
													<div class="caption">
														<div class="work_title">
															<h1>DISPOSISI</h1>
														</div>
													</div>
												</a>		
											</div>
											<div class="work">
												<a class="thickbox" href="page/surat/lampiran.php?height=400 width=200&id=<?php echo $row['id']; ?>">
													<img src="img/file-lampiran.png" class="media" alt=""/>
													<div class="caption">
														<div class="work_title">
															<h1>LAMPIRAN</h1>
														</div>
													</div>
												</a>		
											</div>
											<div class="work">
												<a href="<?php echo $surat->getField('surat',$row['id']);?>" target="_blank">
													<img src="img/file-open.png" class="media" alt=""/>
													<div class="caption">
														<div class="work_title">
															<h1>F I L E</h1>
													  </div>
													</div>
												</a>		
											</div>
										</div>
								  </span>
								  </li>
									  </td>
								  </tr>
								<?php
								}
								?>
								</table>
								<div id="pagination">
									<?php
									$sts=$_GET['sts'];
									$url=encrypt_url('entrisurat').'&sts='.$sts.'&i='.$i;
									echo pagination($statement,$per_page,$page,$url);
									?>
								</div>
								<?php
					break;
				}
			?>
		</div>
	</div>
<script>
	$('#cari').keydown(function(e){
		if (e.keyCode==13){
			$('#btcari').click();
		}
	});
</script>
<?php
function cek($nama,$value,$mod){
	$surat=new Surat();	
	$ide=$_GET['ide'];
	$id=$ide;
	$olddis=$surat->getField('disposisi',$id);
	$data=explode(',',$olddis);
	$cdata=count($data);
	if($value==$data[0] or $value==$data[1] or $value==$data[2] or $value==$data[3] or $value==$data[4] or $value==$data[5] or $value==$data[6] or $value==$data[7] or $value==$data[8] or	$value==$data[9] or	$value==$data[10] or $value==$data[11] or $value==$data[12] or	$value==$data[13] or $value==$data[14] or $value==$data[15]){$cek="checked";}else{$cek="";}
	echo "<li><input name='$nama"."[]' type='checkbox' value='$value' $cek >&nbsp;$mod</li>";
}
?>
