<div class="p-wrapper">
	<div class="surat">
<?php
					$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
					$s=$_GET['s'];
					if(isset($s)){
						$s=$s;
					}else{
						$s='tanggal';
					}
					if ($page <= 0) $page = 1;
						$per_page = 10;
						$point = ($page * $per_page) - $per_page;
						if($_GET['cari']==''){
							$sts=$_GET['sts'];
							switch($sts){
								case '':
									$sts='new';
									$statement = "dtsuratmasuk where status='".$sts."'";							
								break;
								case 'all':
									$statement = "dtsuratmasuk";
								break;
								case 'out':
									$statement = "dtsuratkeluar";
								break;
								case 'rem':
									$statement = "dtsuratmasuk where status!='new' and bataswaktu!='0000-00-00'";							
								break;
								case $sts:
									$statement = "dtsuratmasuk where status='".$sts."'";	
								break;						
							}
						}else{
							$cari=$_GET['cari'];
							$statement = "dtsuratmasuk where nourut like '%$cari%' or nosurat like '%$cari%' or tanggal like '%$cari%' or dari like '%$cari%' or tujuan like '%$cari%' or kode like '%$cari%' or noindex like '%$cari%' or rangkuman like '%$cari%'";
						}
						switch($i){case '0':$ix='ASC';break;case '1':$ix='DESC';break;}
						$data = mysql_query("SELECT * FROM $statement order by $s $ix LIMIT $point, $per_page");
						if($i=='0'){$i='1';}elseif($i=='1'){$i='0';}elseif($i==''){$i='0';}
						if($sts!='out'){
							include 'inbox.php';
						}else{
							include 'outbox.php';						
						}
						?>				
					<div class="c10"></div>
					<div id="pagination">
						<?php
						$sts=$_GET['sts'];
						$url=encrypt_url('entrisurat').'&sts='.$sts.'&i='.$i;
						echo pagination($statement,$per_page,$page,$url);
						?>
					</div>
	</div>
</div>
