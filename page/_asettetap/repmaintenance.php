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
		window.location='<?php echo $link; ?>&m=repmain&kategori='+$('#kategori').val()+'&mtgl='+$('#mtgl').val()+'&stgl='+$('#stgl').val()+'';
	}
	function viewDetail(idt){
		window.location='<?php echo $link; ?>&m=fper&act=edit&idt='+idt;
	}
	function prn(){
		var prn=null;
		if (prn==null){
			prn=open('page/asettetap/prnhis.php?kategori=<?php echo $kategori; ?>&mtgl=<?php echo $_GET['mtgl'];?>&stgl=<?php echo $_GET['stgl'];?>','page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1028,height=600');
		}
	}
</script>
<div class="p-wrapper">
	<div class="content">
	<div style="border-bottom:1px solid #ccc;"></div>
	<h3 id="label-form">
		<ul>
			<li><a>PERAWATAN</a></li>
		</ul>
	</h3>
		<div class="c5"></div>
		<div style="background:#ccc; padding:5px 5px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
			  <td width="7%" align="left"><label>Tanggal</label>
		      </h3></td>
				<td width="17%">
				<span class="frm">
					<input type="text" class="tgl" name="mtgl" id="mtgl" value="<?php echo $mtgl; ?>"  onclick="return showCalendar('mtgl', 'dd-mm-y')"/>
			  </span>				</td>
			  <td width="3%"><label>s/d</label></h3></td>
				<td width="17%">
				<span class="frm">
					<input type="text" class="tgl" name="stgl" id="stgl" value="<?php echo $stgl; ?>"  onclick="return showCalendar('stgl', 'dd-mm-y')"/>
			  </span>				</td>
				<td width="40%" align="left">
			  <input type="button" name="getCari" id="getCari" class="btn" onclick="getReport();" value="Cek" /></td>
		  </tr>
</table>
</div>
		<?php
		$mtgl=tgl_ind_to_eng($_GET['mtgl']);
		$stgl=tgl_ind_to_eng($_GET['stgl']);
		?>
		<div class="c10"></div>
		<div id="head-rep">
			<h2 align="center">
				LAPORAN	PERAWATAN	BARANG	</h2>
			<h3 align="center">
			MULAI TANGGAL : <?php echo getTanggal($mtgl);?> - <?php echo getTanggal($stgl);?>
			</h3>
		</div>
		<div class="c10"></div>
		<?php
		$sql=mysql_query("select dtperawatan.*,dtperawatanitem.* from dtperawatan,dtperawatanitem where dtperawatan.id=dtperawatanitem.idt and dtperawatan.kategori like '%$kategori%' and dtperawatanitem.tanggal between '$mtgl' and '$stgl' order by dtperawatan.tanggal");
		while($row=mysql_fetch_assoc($sql))
		$data[]=$row;
		if($data==array()){
			echo "Tidak ada perbaikan pada periode ini";
		}else{
		?>
			<table width="100%" cellpadding="0" cellspacing="0" class="tabel">
				<th width="3%" align="left">NO</th>
				<th width="11%" align="center">TANGGAL</th>
				<th width="11%" align="left">ID BARANG</th>
				<th width="12%" align="left">PERAWATAN </th>
				<th width="21%" align="left">KETERANGAN </th>
				<th width="13%" align="left">SPAREPART</th>
				<th width="7%" align="center">STATUS</th>
				<th width="12%" align="center">BIAYA</th>
			</table>
			<div style="height:350px; overflow:auto">
			<table width="100%" cellpadding="0" cellspacing="0" class="tabel">
				<?php
				foreach($data as $row){
				?>
				<tr onMouseOver="this.style.color='#666';this.style.cursor='pointer';" onmouseout="this.style.color='#333';" onclick="viewDetail('<?php echo $row['idt'];?>');" >
					<td width="3%" align="center"><?php echo $c=$c+1;?></td>
					<td width="11%"><?php echo getTanggal($row['tanggal']);?></td>
					<td width="11%"><?php echo $row['id'];?></td>
					<td width="12%"><?php echo $row['jenis'];?></td>
					<td width="21%"><?php echo $row['keterangan'];?></td>
					<td width="13%"><?php echo $row['sparepart'];?></td>
					<td width="7%" align="center"><?php switch($row['status']){case 'B':echo 'Baik';break;case 'KB':echo 'Kurang Baik';break;case 'RB':echo 'Rusak Berat';break;}?></td>
					<td width="12%" align="right"><?php echo format_angka($row['harga']);?></td>
				</tr>
				<?php
				}
				?>
				</table>
			</div>
		<div class="c5"></div>
		<div style="background:#ccc; padding:0 5px;">
				<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td colspan="6" align="center"><p style="font-weight:bold">T O T A L</p></td>
					<td align="right" colspan="3">
					<p style="font-weight:bold">
					<?php
					$sql=mysql_query("select sum(harga) as total from dtperawatanitem where tanggal between '$mtgl' and '$stgl'");
					while($data=mysql_fetch_assoc($sql)){
						echo rupiah($data['total']);
					}
					?>
					</p>
					</td>
				</tr>
			</table>
			</div>
			<?php
		}
	?>
	<div class="head_content" style="box-shadow:none;" >
		<input type="button" name="prn" id="prn" onClick="prn();" value="Cetak">
		&nbsp;
		<input type="button" value="Kembali" onclick="history.back();" style="float:right" />
	</div>
</div>
</div>