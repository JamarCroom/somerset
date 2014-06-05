<!DOCTYPE html>
<html>
<head>
<title>Create Database Script</title>
</head>
<body>
<?php
//phpinfo();

		try
		{

			$query=array("CREATE TABLE IF NOT EXISTS userTable(userId INTEGER PRIMARY KEY, userName TEXT, password TEXT, email TEXT)",	
			"CREATE TABLE IF NOT EXISTS indicatorMainTable(indicatorId INTEGER PRIMARY KEY, indicatorState TEXT, dateCreated TEXT,contentArea TEXT, indicatorType TEXT, graphType TEXT, indicatorTitle TEXT, measureUnit TEXT, targetLanguage TEXT, targetNumber TEXT)",	
			"CREATE TABLE IF NOT EXISTS indicatorSecondaryTable(indicatorSecondaryId INTEGER PRIMARY KEY, indicatorId INTEGER, changeType TEXT, baselineValue TEXT, followupValue TEXT)",
			"CREATE TABLE IF NOT EXISTS indicatorTertiaryTable(indicatorTertiaryId INTEGER PRIMARY KEY, indicatorId INTEGER, xAxisTitle TEXT, yAxisTitle TEXT)",
	  		"CREATE TABLE IF NOT EXISTS yearsTable(yearId INTEGER PRIMARY KEY, indicatorId INTEGER, year INTEGER, yearData INTEGER)");
	  		
	  		$query2= "INSERT INTO userTable(userName, password, email) VALUES(:userName, :password, :email)";
	  		
	  		$userName=array('somersetUser','jamarcroom');
	  		$email=array('mlitalien@rfgh.net','jcroom@gmail.com');

	  		$password0=crypt('Pan2014!','%20This%20is%20the%20salt');
	  		$password1=crypt('myPass!','%20This%20is%20the%20salt');
	  		$password = array($password0,$password1);

	  		require_once 'include/dbaseConnect.inc';
	  		
	  		$db->beginTransaction();

	  		foreach($query as $queries)
	  		{
	  			$db->exec($queries);
	  		}
	  		
	  		$statement=$db->prepare($query2);
	  		
	  		foreach($userName as $key=>$value)
	  		{
	  			$statement->bindValue(':userName',$userName[$key]);
	  			$statement->bindValue(':email',$email[$key]);
	  			$statement->bindValue(':password',$password[$key]);	
	  			$statement->execute();
	  		}
	  		$statement->closeCursor();
	  		
	  		$db->commit();
?>

				<p>Success</p>
<?php
  		}
  		catch(PDOException $e)
  		{
  ?>
  			<p class="error center">There was an error connecting to the database. Please contact the system administrator.<br/> Error code:<?php echo $e->getCode() ;?> Error Message:
			<?php echo $e->getMessage();?></p>
<?php
  		}


?>
</body>
</html>