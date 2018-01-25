<div style=" display:block;width:40%; float:left;">
<div id="head">&raquo; Form Pengosongan Database</div>
	<h1 style="color:#FF0000">PERINGATAN!</h1>
	<br />
	<h3><blink>Jika proses ini di lanjutkan maka semua data dalam database akan dihapus !</blink></h3>
	<br /><form method="post" action="<?php echo $link;?>&m=fclear" enctype="multipart/form-data">
		<table width="285" border="0" cellspacing="0" cellpadding="0">
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
			<td colspan="2" align="right">
			<a href="<?php echo $link;?>">&laquo; Kembali</a>
			<input type="submit" name="btn" id="btn" value="Kosongkan DB" />
			</td>
		  </tr>
		</table>
	</form>
</div>
<div style="display:block; width:50%; float:right;">
<div id="head">&raquo; Informasi Proses</div>
<div style="background:#000; color:#fff; padding:10px;">
	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$btn=$_POST['btn'];
		$host=$_POST['host'];
		$user=$_POST['user'];
		$password=$_POST['password'];
		$database=$_POST['database'];
		$koneksi = new mysqli($host,$user,$password,$database); 
		$cnx=mysql_connect($host, $user, $password) or die(mysql_error());
		mysql_select_db($database, $cnx) or die(mysql_error());
		$tables = mysql_list_tables($database) or die(mysql_error());
		$table_list = array();
		while($t = mysql_fetch_array($tables)){
			array_push($table_list, $t[0]);
		}
		foreach ($table_list as $key => $value) {
			if ($value !== 'user') {
				$sql = "TRUNCATE TABLE ".$value;
				$query = $koneksi->query($sql);
				if($query){
					echo "Tabel ".$value." telah dikosongkan...<br>";
				}
			}
		}
	}
	?>
	</div>
</div>
<div class="c10"></div>