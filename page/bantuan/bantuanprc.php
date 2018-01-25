<?php
require("../../lib/SQL_Export.php");
require("../../lib/lib.php");
$link='?p='.encrypt_url('bantuan');
$btn=$_POST['btn'];
$host=$_POST['host'];
$user=$_POST['user'];
$password=$_POST['password'];
$database=$_POST['database'];
switch($btn){
	case 'Backup':
		$cnx = mysql_connect($host, $user, $password) or die(mysql_error());
		mysql_select_db($database, $cnx) or die(mysql_error());
		$tables = mysql_list_tables($database) or die(mysql_error());
		$table_list = array();
		while($t = mysql_fetch_array($tables)){
			array_push($table_list, $t[0]);
		}
		$e = new SQL_Export($host,$user,$password,$database, $table_list);
		echo $e->export();
		mysql_close($cnx);                                       
		?>
		<meta http-equiv='refresh' content='0; url=<?php echo $link;?>&m=fback'>
		<?php	
	break;
	case 'Kosongkan DB':
	break;
}
?>

