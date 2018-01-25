<div style="display:block;padding:10px;height:50px; width:100%;">
HTML EDIT : <?php echo $_GET['id'];?>
</div>
<textarea style="width:100%; height:100%">
<?php 
	$file_handle = fopen($_GET['id'], "r");
	while (!feof($file_handle)) {
		$line_of_text = fgets($file_handle);
		print $line_of_text;
	}
	fclose($file_handle);
?>
</textarea>