<form method="post" action="<?php echo $linkdata; ?>" enctype="multipart/form-data">
	<table width="285" border="0" cellspacing="0" cellpadding="0">
		<th width="141" colspan="2">FORM BACKUP DATABASE</th>
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
		<a href="index.php"><< Kembali</a>
		<input type="submit" name="btn" id="btn" value="Backup" />
		</td>
	  </tr>
	</table>
</form>