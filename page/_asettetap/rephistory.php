<?php
$id=$_GET['id'];
?>
<script>
	//getkib();
	function cetak(id){
		window.location='<?php echo $link; ?>&m=fkibb&id='+id;
	}
	function history(id){
		window.location='<?php echo $link; ?>&m=dhis&id='+id;
	}
	function cari(){
		var id='<?php echo $id;?>';
		var bln=$('#bln').val();
		var thn=$('#thn').val();
		var id=$('#id_barang').val();
		window.location='<?php echo $link; ?>&m=rhis&id='+id+'&bln='+bln+'&thn='+thn+'';
	}
	function prn(){
		var prn=null;
		if (prn==null){
			prn=open('page/asettetap/prnhisitem.php?id=<?php echo $id;?>&bln=<?php echo $_GET['bln'];?>&thn=<?php echo $_GET['thn'];?>','page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1247,height=600');
		}
	}
	function getkib(){
		var kib=$('#aset').val();
		$.ajax({
			type:'post',
			url:'page/asettetap/kibprc.php',
			data:'req=getkib&kib='+kib,
			cache :false,
			success:function (data){
				$('#inf-kib').html(data);
			}
		});
	}
</script>
<div class="p-wrapper">
	<div class="content">
	<div style="border-bottom:1px solid #ccc;"></div>
	<h3 id="label-form">
		<ul>
			<li><a>HISTORY</a></li>
		</ul>
	</h3>
		<div class="c5"></div>
		<div style="background:#ccc; padding:0 5px;">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td width="11%">DATA ASET</td>
			<td width="16%">
				<select name="aset" id="aset" onchange="getkib();">
					<option value="KIBA" selected="selected">KIBA</option>
					<option value="KIBB">KIBB</option>
					<option value="KIBC">KIBC</option>
					<option value="KIBE">KIBE</option>
				</select>
		  </td>
			<td width="19%">ID/NAMA ASET</td>
			<td width="12%">
			<span id="inf-kib"></span>			</td>
			<td width="4%">&nbsp;</td>
			<td width="7%" id="thick-th">BULAN</td>
			<td width="8%" id="thick-th">
			<select name="bln" id="bln">
				<?php
				if(isset($_GET['bln'])){
					$bl=$_GET['bln'];
					switch($bl){case '1':$bln='Januari';break;case '2':$bln='Februari';break;case '3':$bln='Maret';break;case '4':$bln='April';break;case '5':$bln='Mei';break;case '6':$bln='Juni';break;case '7':$bln='Juli';break;case '8':$bln='Agustus';break;case '9':$bln='September';break;case '10':$bln='Oktober';break;case '11':$bln='November';break;case '12':$bln='Desember';break;}
					echo "<option value='".$bl."' selected='selected'>".$bln."</option>";
				}else{
					$bl=$date->format('m');
					switch($bl){case '1':$bln='Januari';break;case '2':$bln='Februari';break;case '3':$bln='Maret';break;case '4':$bln='April';break;case '5':$bln='Mei';break;case '6':$bln='Juni';break;case '7':$bln='Juli';break;case '8':$bln='Agustus';break;case '9':$bln='September';break;case '10':$bln='Oktober';break;case '11':$bln='November';break;case '12':$bln='Desember';break;}
					echo "<option value='".$bl."' selected='selected'>".$bln."</option>";
				}
				for($i=1;$i<13;$i++){
					if(strlen($i)<2){$i='0'.$i;}
					switch($i){
						case '1':$bln='Januari';break;
						case '2':$bln='Februari';break;
						case '3':$bln='Maret';break;
						case '4':$bln='April';break;
						case '5':$bln='Mei';break;
						case '6':$bln='Juni';break;
						case '7':$bln='Juli';break;
						case '8':$bln='Agustus';break;
						case '9':$bln='September';break;
						case '10':$bln='Oktober';break;
						case '11':$bln='November';break;
						case '12':$bln='Desember';break;
					}
					echo "<option value='".$i."'>".$bln."</option>";
				}
				?>
			</select>			
		  </td>
		  <td width="9%" id="thick-th">TAHUN</td>
		  <td width="9%">
			<select name="thn" id="thn">
				<?php
				if(isset($_GET['thn'])){$th=$_GET['thn'];}else{$th=$date->format('Y');}
				echo "<option value='".$th."' selected='selected'>".$th."</option>";
				for($i=1;$i<15;$i++){
					$thn=2013+$i;
					echo "<option value='".$thn."'>".$thn."</option>";
				}
				?>
			</select>					  
		  </td>
		  <td width="5%">
		  <input type="button" value="Cek" name="cari" id="cari" onClick="cari();">
		  </td>
		</tr>
	</table>
	</div>
	<h2 align="center">CATATAN TRANSAKSI PERAWATAN </h2>
	<h3 align="center">
	  <?php 
				switch(substr($_GET['id'],0,4)){
					case 'KIBA':
						echo "TANAH DAN BANGUNAN";
					break;
					case 'KIBB':
						echo "PERALATAN DAN MESIN";
					break;
					case 'KIBC':
						echo "GEDUNG DAN BANGUNAN";
					break;
					case 'KIBE':
						echo "BUKU DAN LAINNYA";
					break;
				}
			?>
	</h3>
		<div class="c5"></div>
		<div style="background:#ccc; padding:0 5px;">
	<table width="100%" cellpadding="0" cellspacing="0" class="form">
		<tr>
			<td width="19%" id="thick-th">KODE BARANG </td>
			<td width="34%" id="thick-th">: 
			<?php 
				switch(substr($_GET['id'],0,4)){
					case 'KIBA':
						echo $dtkiba->getField('kode',$id);
					break;
					case 'KIBB':
						echo $dtkibb->getField('kode',$id);
					break;
					case 'KIBC':
						echo $dtkibc->getField('kode',$id);
					break;
					case 'KIBE':
						echo $dtkibc->getField('kode',$id);
					break;
				}
			?>
			</td>
			<td width="8%" id="thick-th">&nbsp;</td>
			<td width="22%" id="thick-th">THN.PEMBELIAN</td>
			<td width="17%" id="thick-th">: 
			<?php 
				switch(substr($_GET['id'],0,4)){
					case 'KIBA':
						echo $dtkiba->getField('tahun',$id);
					break;
					case 'KIBB':
						echo $dtkibb->getField('thn_beli',$id);
					break;
					case 'KIBC':
						echo $dtkibc->getField('tanggal',$id);
					break;
					case 'KIBE':
						echo $dtkibc->getField('thn_cetak',$id);
					break;
				}
			?>
			</td>
		</tr>
		<tr>
			<td width="19%" id="thick-th">NAMA BARANG  </td>
			<td width="34%" id="thick-th">: 
			  <?php 
				switch(substr($_GET['id'],0,4)){
					case 'KIBA':
						echo $dtkiba->getField('nama',$id);
					break;
					case 'KIBB':
						echo $dtkibb->getField('nama',$id);
					break;
					case 'KIBC':
						echo $dtkibc->getField('nama',$id);
					break;
					case 'KIBE':
						echo $dtkibc->getField('nama',$id);
					break;
				}
			?>			</td>
			<td width="8%" id="thick-th">&nbsp;</td>
			<td width="22%" id="thick-th">MEREK / TYPE / SPEK </td>
			<td width="17%" id="thick-th">: 
		    <?php 
				switch(substr($_GET['id'],0,4)){
					case 'KIBA':
						echo $dtkiba->getField('luas',$id)."(M2)";
					break;
					case 'KIBB':
						echo $dtkibb->getField('merek',$id);
					break;
					case 'KIBC':
						echo $dtkibc->getField('luas_lantai',$id)."(M2)";
					break;
					case 'KIBE':
						echo $dtkibc->getField('judul',$id);
					break;
				}
			?></td>
		</tr>
	</table>
	</div>
	<div class="c10"></div>
	<?php
	if(!isset($_GET['bln'])){
		$param="dtperawatan where id='$id'";
	}else{
		$tgl=$_GET['thn'].'-'.$_GET['bln'];
		$param="dtperawatan where id='$id' and tanggal like '%$tgl%'";
		$paramitem="dtperawatanitem where id='$id' and tanggal like '%$tgl%'";
	}
	$sql=mysql_query("select * from $param");
	$tsql=mysql_query("select sum(harga) as total from $paramitem");
	?>
	<table width="100%" cellpadding="0" cellspacing="0" id="tabel">
			<th width="3%">NO</th>
			<th width="12%">TANGGAL</th>
			<th width="21%">JENIS</th>
			<th width="31%">KETERANGAN</th>
			<th width="16%">SPAREPART</th>
			<th width="6%">STATUS</th>
			<th width="11%">BIAYA</th>
		<?php
		while($row=mysql_fetch_assoc($sql)){
		?>
		<tr>
			<td align="center"><?php echo $c=$c+1;?></td>
			<td><?php echo getTanggal($row['tanggal']);?></td>
			<td><?php echo $row['jenis'];?></td>
			<td><?php echo $row['keterangan'];?></td>
			<td><?php echo $row['sparepart'];?></td>
			<td><?php echo $row['status'];?></td>
			<td align="right"><?php echo format_angka($row['harga']);?></td>
		</tr>
		<?php
		}
		?>
		</table>
		<div class="c5"></div>
		<div style="background:#ccc; padding:0 5px;">
		<table cellpadding="0" cellspacing="0" width="100%" class="tabel">
		<tr>
			<td colspan="6">TOTAL BIAYA</td>
			<td align="right">
			<?php 
			while($data=mysql_fetch_assoc($tsql)){
				echo rupiah($data['total']);
			}
			?>
			</td>
		</tr>		
	</table>
	</div>
	<div class="head_content" style="box-shadow:none;" >
		<input type="button" name="prn" id="prn" onClick="prn();" value="Cetak">
		<div style="float:right;">
		<input type="button" value="Kembali" onclick="history.back();">
		</div>
	</div>
</div>
</div>
<script>
getkib();
</script>