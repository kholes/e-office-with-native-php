<?php
if(isset($_GET['mtgl'])){
	$mtgl=$_GET['mtgl'];
	$stgl=$_GET['stgl'];
	$kategori=$_GET['kategori'];
}else{
	$mtgl=$date->format('d-m-Y');
	$stgl=$date->format('d-m-Y');
	$kategori="KIBA";
}
?>
<script>
	function getReport(){
		window.location='<?php echo $link; ?>&m=per_rep&kategori='+$('#kategori').val()+'&mtgl='+$('#mtgl').val()+'&stgl='+$('#stgl').val()+'';
	}
	function viewDetail(idt){
		window.location='<?php echo $link; ?>&m=per_detail&idt='+idt;
	}
	function prn(){
		var prn=null;
		if (prn==null){
			prn=open('page/asettetap/perawatan_prn.php?kategori=<?php echo $kategori; ?>&mtgl=<?php echo $_GET['mtgl'];?>&stgl=<?php echo $_GET['stgl'];?>','page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1028,height=600');
		}
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div class="page-top">
			<h3>LAPORAN PERAWATAN ASET </h3>
		</div>
		<div class="page-content">
			<div class="page-header">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table">
				<tr>
					<td width="8%"><label>Kategori</label></td>
					<td width="8%">
						<select name="kategori" id="kategori">
							<option value="<?php echo $kategori;?>" selected="selected"><?php echo $kategori;?></option>
							<option value="KIBA">KIBA</option>
							<option value="KIBB">KIBB</option>
							<option value="KIBC">KIBC</option>
							<option value="KIBE">KIBE</option>
						</select>
					</td>
					<td width="7%" align="left"><label>Tanggal</label></td>
					<td width="17%">
						<span class="frm">
						<input type="text" class="tgl" name="mtgl" id="mtgl" value="<?php echo $mtgl; ?>"  onclick="return showCalendar('mtgl', 'dd-mm-y')"/>
						</span>				
					</td>
					<td width="3%"><label>s/d</label></td>
					<td width="17%">
						<span class="frm">
							<input type="text" class="tgl" name="stgl" id="stgl" value="<?php echo $stgl; ?>"  onclick="return showCalendar('stgl', 'dd-mm-y')"/>
						</span>				
					</td>
					<td width="40%" align="left">
						<input type="button" name="getCari" id="getCari" class="btn" onclick="getReport();" value="Cek" />
					</td>
				</tr>	
			</table>
			</div>
			<?php
			$kategori=$_GET['kategori'];
			$mtgl=tgl_ind_to_eng($_GET['mtgl']);
			$stgl=tgl_ind_to_eng($_GET['stgl']);
			?>
			<div class="c10"></div>
			<table width="100%" cellpadding="0" cellspacing="0" class="tabel">
				<th width="15%" align="left">NO.REGISTRASI</th>
				<th width="13%" align="left">TANGGAL</th>
				<th width="67%" align="left">PELAKSANA </th>
				<th width="5%" align="right">BIAYA</th>
			</table>
			<div style="height:300px; overflow:auto">
				<table width="100%" cellpadding="0" cellspacing="0" class="tabel">
					<?php
					$sql=mysql_query("select * from dtperawatan where kategori='$kategori' and tanggal between '$mtgl' and '$stgl' order by id");
					while($row=mysql_fetch_assoc($sql))
					$data[]=$row;
					if($data!=array()){
					foreach($data as $row){
					?>
					<tr onMouseOver="this.style.color='#666';this.style.cursor='pointer';" onmouseout="this.style.color='#333';" onclick="viewDetail('<?php echo $row['id'];?>');" >
						<td width="15%"><?php echo $row['id'];?></td>
						<td width="13%"><?php echo getTanggal($row['tanggal']);?></td>
						<td width="67%"><?php echo $toko->get_field('nama',$row['pelaksana']);?></td>
						<td width="5%" align="right"><?php echo format_angka($dtperawatan->get_total_item($row['id']));?></td>
					</tr>
					<?php
					}
					}
					?>
				</table>
			</div>
			<table width="100%" cellpadding="0" cellspacing="0" class="tabel">
				<th>T O T A L</th>
				<th style="text-align:right">
				<?php 
		$tsql=mysql_query("select sum(dtperawatanitem.harga) as total from dtperawatan,dtperawatanitem where dtperawatan.id=dtperawatanitem.idt and dtperawatan.kategori like '%$kategori%' and dtperawatan.tanggal between '$mtgl' and '$stgl' order by dtperawatan.tanggal");
				while($data=mysql_fetch_assoc($tsql)){
					echo rupiah($data['total']);
				}
				?>
				</th>
			</table>
			<div class="head_content" style="box-shadow:none;" >
				<input type="button" name="prn" id="prn" onClick="prn();" value="Cetak">
				&nbsp;
				<input type="button" value="Kembali" onclick="history.back();" style="float:right" />
			</div>
		</div>
	</div>
</div>