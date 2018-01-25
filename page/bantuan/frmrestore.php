<?php
function restore($file) {
	global $rest_dir;
	
	$nama_file	= $file['name'];
	$ukrn_file	= $file['size'];
	$tmp_file	= $file['tmp_name'];
	
	if ($nama_file == "")
	{
		echo "File SQL tidak valid, restore data gagal!";
	}
	else
	{
		$alamatfile	= $rest_dir.$nama_file;
		$templine	= array();
		
		if (move_uploaded_file($tmp_file , $alamatfile))
		{
			
			$templine	= '';
			$lines		= file($alamatfile);

			foreach ($lines as $line)
			{
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
			 
				$templine .= $line;

				if (substr(trim($line), -1, 1) == ';')
				{
					$sql=mysql_query($templine);
					if($sql){
						echo $line;
					}
					$templine = '';
				}
			}
			echo "<center><h3 style='color:red'>Restore database selesai.., silahkan di cek.</h3></center>";
			remove($nama_file);
		
		}else{
			echo "Proses upload gagal, kode error = " . $file['error'];
		}	
	}
	
}
	function remove($item) 
	{
		$item = realpath($item);
		$ok = true;
		if( is_link($item) ||  is_file($item))
	  		$ok =  @unlink($item);
				elseif( is_dir($item)) {
					if(($handle= opendir($item))===false)
		  				show_error(basename($item).": ".$GLOBALS["error_msg"]["opendir"]);

			while(($file=readdir($handle))!==false) {
				if(($file==".." || $file==".")) continue;

				$new_item = $item."/".$file;
				if(!file_exists($new_item))
			  	show_error(basename($item).": ".$GLOBALS["error_msg"]["readdir"]);
			
				if( is_dir($new_item)) {
					$ok=$this->remove($new_item);
				} else {
				$ok= @unlink($new_item);
				}
			}

			closedir($handle);
			$ok=@rmdir($item);
		}
		return $ok;
	}

?>
<div style="display:block; background: width:100%; min-height:120px; background:#CCCCCC;">
	<p style=" background:#999999; padding:5px; color:#FFFFFF">
		<em>Silahkan pilih file (*.sql) yang akan dikembalikan.</em>	</p>
		<form action="" method="post" name="postform" enctype="multipart/form-data" style="background:none; padding:5px;">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="141">Host</td>
			<td width="144"><input type="text" name="host" id="host" value="localhost" /></td>
		  </tr>
		  <tr>
			<td>User</td>
			<td><input type="text" name="user" id="user" value="root" /></td>
		  </tr>
		  <tr>
			<td>Password</td>
			<td><input type="text" name="password" id="password" value="" /></td>
		  </tr>
		  <tr>
			<td>Database</td>
			<td><input type="text" name="database" id="database" value="" /></td>
		  </tr>
				<tr>
				  <td><label for="backup">File Backup Database (*.sql)</label></td>
                  <td><input type="file" name="datafile" size="30" id="gambar" /></td>
            </tr>
            <tr>
              <td colspan="2"><a href="<?php echo $link;?>"><< Kembali</a><input type="submit" name="restore" value="Restore Database" /></td>
            </tr>
          </table>
		</form>
</div>
<div style="display:block; background:#000; color:#fff;max-width:100%;min-height:340px;border-bottom:1px solid #ccc">
<?php
if(isset($_POST['restore'])){
	$host=$_POST['host'];
	$user=$_POST['user'];
	$password=$_POST['password'];
	$database=$_POST['database'];
	$cnx=mysql_connect($host, $user, $password) or die(mysql_error());
	mysql_select_db($database, $cnx) or die(mysql_error());
	restore($_FILES['datafile']);
}else{
	unset($_POST['restore']);
}
?>
</div>