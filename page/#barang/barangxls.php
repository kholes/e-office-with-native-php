<?php
include '../../lib/xls.php';
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=Databarang_".$tgl.".xls ");
header("Content-Transfer-Encoding: binary ");

xlsBOF();
	xlsWriteLabel(3,0,"TANGGAL BTSTB");
	xlsWriteLabel(3,1,"#BTSTB");
	xlsWriteLabel(3,2,"NO.ORDER");
	xlsWriteLabel(3,3,"PENGIRIM");
	xlsWriteLabel(3,4,"PENERIMA");
	xlsWriteLabel(3,5,"AMOUNT");
	xlsWriteLabel(3,6,"REMARK");
	$c=4;
	xlsWriteLabel($c,0,$xx);				
	xlsWriteLabel($c,1,'');
	xlsWriteLabel($c,2,'');
	xlsWriteLabel($c,3,'');
	xlsWriteLabel($c,4,'');
	xlsWriteLabel($c,5,'TES');
	xlsWriteLabel($c,6,'');
xlsEOF();
exit();
?>