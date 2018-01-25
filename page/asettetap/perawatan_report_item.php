<script>
	$(document).ready(function(){
		get_kib();
	});
	function get_kib(){
		var kib=$('#kategori').val();
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=get_kib&kib='+kib,
			cache :false,
			success:function (data){
				$('#infKib').html(data);
			}
		});
	}
	function get_report_item(){
		var kategori=$('#kategori').val();
		var id=$('#id_barang').val();
		var bln=$('#bln').val();
		var thn=$('#thn').val();
		$.ajax({
			type:'post',
			url:'page/asettetap/prc_aset.php',
			data:'req=get_report_item&kategori='+kategori+'&id='+id+'&bln='+bln+'&thn='+thn,
			cache :false,
			success:function (data){
				$('#inf_report_item').html(data);
			}
		});
	}
	function preview_item(){
		var kategori=$('#kategori').val();
		var id=$('#id_barang').val();
		var bln=$('#bln').val();
		var thn=$('#thn').val();
		var preview=null;
		if (preview==null){
			preview=open('page/asettetap/perawatan_report_item_print.php?kib='+kategori+'&id='+id+'&bln='+bln+'&thn='+thn,'page','navigator=0,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,left=50,right=50,top=50,buttom=50,titlebar=0,width=1180,height=600');
		}
	}
</script>
<div class="p-wrapper">
	<div class="content">
		<div id="label-form">
			<li class="fa fa-wrench">   <label>LAPORAN DETAIL PERAWATAN ASET</label></li>
			<a href="<?php echo $link;?>"><li class="fa fa-times icon-small" style="float:right"></li></a>
		</div>
		<div class="c"></div>
		<div class="page-header">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="13%"><label>Kategori Aset </label></td>
            <td width="6%">
			<select name="kategori" id="kategori">
				<?php 
				$kategori=$dtperawatan->get_field('kategori',$id);
				if(isset($kategori)){
					echo '<option value="'.$kategori.'" selected="selected">'.$kategori.'</option>';
				}else{
					echo '<option value="KIBA" selected="selected">KIBA</option>';
				}
				?>
				<option value="KIBA">KIBA</option>
				<option value="KIBB" selected="selected">KIBB</option>
				<option value="KIBC">KIBC</option>
				<option value="KIBE">KIBE</option>
            </select>
			</td>
			<td width="22%"><span id="infKib"></span></td>
            <td width="6%" align="left"><label>Bulan</label></td>
            <td width="13%">
			<select name="bln" id="bln">
				<option value="all">--- SEMUA ---</option>
				<option value="01"> Januari</option>
				<option value="02"> Februari</option>
				<option value="03"> Maret</option>
				<option value="04"> April</option>
				<option value="05"> Mei</option>
				<option value="06"> Juni</option>
				<option value="07"> Juli</option>
				<option value="08"> Agustus</option>
				<option value="09"> September</option>
				<option value="10"> Oktober</option>
				<option value="11"> November</option>
				<option value="12"> Desember</option>
			</select>
			</td>
            <td width="6%">
            <label>Tahun</label></td>
            <td width="14%"><input type="text" name="thn" id="thn" value="<?php echo $date->format('Y');?>"></td>
			<td width="20%"><input type="button" name="cari" id="cari" value="Tampilkan" onClick="get_report_item();"></td>
          </tr>
        </table>
		</div>
		<div class="c10"></div>
		<div id="inf_report_item"></div>
  </div>
</div>
<script>
	get_kib();
	$('#kategori').change(function(){
		get_kib();
	});
</script>
