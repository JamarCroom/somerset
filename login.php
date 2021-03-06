<?php
	ob_start();
	session_start();
	$style="
	#signin
	{
		background: #F1F1F1;
		border-radius: 5px;
		width: 60%;
		margin: 100px auto;
		-moz-box-shadow:    3px 1px 3px 4px rgb(95,95,95);
  		-webkit-box-shadow: 3px 1px 3px 4px rgb(95,95,95);
 	 	box-shadow:         2px 1px 2px 3px rgb(95,95,95);
 	 	padding: 20px 0;
	}

	.inputs
	{
		text-align:center;
		font-weight: bold;
		font-size: 1.3em;
		border-radius: 5px;
	}

	#button
	{
		text-align:center;

	}

	#submit
	{
		width: 20%;
	}

	#heading
	{
		text-align:center;
		font-size: 1.5em;
	}
	";

include 'include/head.inc';
?>

		<form id="signin" action="login.php" method="POST">
<?php



		if(isset($_POST['submit']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			require_once 'objects/Validation.php';
			$validation = new Validation();
			$username =$validation->validateInput($username,'Username');
			$password =$validation->validateInput($password,'Password');
			
			
			$errorNum=$validation->getErrorCount();
			if($errorNum==0)
			{
				try
				{

					$password1 = crypt($password,'%20This%20is%20the%20salt');
					require_once 'include/dbaseConnect.inc';
					$sql = 'SELECT * FROM userTable WHERE userName =:userName AND password = :password';
					$statement=$db->prepare($sql);
					$statement->bindValue(':userName', $username);
					$statement->bindValue(':password',$password1);
					$statement->execute();
					$results = $statement->fetchAll();
					$statement->closeCursor();
					if(empty($results) )
					{
						echo'<p class="error center">Error:Username and password combination are invalid.</p>';
					}
					else
					{
						$_SESSION['logged_in']= true;

					
						session_regenerate_id();
						header('Location:somersetAdd.php');
					}

				}

				catch(PDOException $e)
				{
					echo "<p class='error'>Error:Unable to connect to the database at this time: ".$e->getMessage()."</p>";
				}

			}
			else
			{
				$validation->printErrorMsgs();
			}


		}

	
?>

		
			<h3 id="heading">User Authentication</h3>
			
			<p class="inputs">Username:&nbsp;&nbsp;<input name="username" id="username" type="text"
				<?php
				if (isset($username))
				{
					echo"value='".$username."'";
				}
				?>
				/></p>

			<p class="inputs">Password:&nbsp;&nbsp;<input name="password" id="password" type="password"
				<?php
				if (isset($password))
				{
					echo"value='".$password."'";
				}
				?>
			/></p>

			<p id="button"><input id="submit" name="submit" type="submit" value="Submit"/></p>
			



		</form>
<?php
include 'include/foot.inc';
?>