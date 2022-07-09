<?php 
  session_start(); 
  include_once("connection.php");
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>


<html>
<head>
<title>PHP Database Connection</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
	table,td,th{
		border:1px solid purple;
		border-collapse:collapse;
	}
</style>
</head>

<body>

<?php
		
		  
		if(isset($_POST['submit']))
		{
		  $mid=(int)$_POST['submit'];
		  $query="delete from user where id=$mid";
		  $result=$db->query($query);
		}
		?>

     <?php
			  
		if(isset($_POST['update']))
		{
		  $mid=(int)$_POST['update'];
		  $query="UPDATE user
		  SET Fname==(str)$_POST['modify'];
		  WHERE id=$mid";
		  $result=$db->query($query);
		}
		?>

<div class="wrapper">
		<header>
		</header>
		
		<div class="homeheader">
			<h2>Home Page</h2>
		</div>

		<div class="content">
				<!-- notification message -->
				<?php if (isset($_SESSION['success'])) : ?>
					<div class="error success" >
						<h3>
							<?php 
								echo $_SESSION['success']; 
								unset($_SESSION['success']);                              
							?>
						</h3>
					</div>
				<?php endif ?>

				<!-- logged in user information -->
				<?php  if (isset($_SESSION['username'])) 
	{ ?>
					<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
				<?php 
			
			
	      	$email=$_SESSION["email"];
		  if($email)
			{
				$quary="select * from user";
				$result=$db->query($quary);
				if($result)
			    {
			    print("the result of the select quary is :<br>");
				}
                ?>
				<table>
					<tr>
						<th>Id</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Gender</th>
						<th>Birth Date</th>
						<th>User Type</th>
						<th>Email</th>
						<th>Password</th>
						<th>language Type</th>
						<th>Comment</th>
	            	</tr>
		       <?php
                foreach($result as $row)
		      {
		     	?>
			  <tr>
				<td><?php echo($row["id"]);?></td>
				<td><?php echo($row["Fname"]);?></td>
				<td><?php echo($row["Lname"]);?></td>
				<td><?php echo($row["Gender"]);?></td>
				<td>
					<?php
					$date=new Datetime($row["BDate"]);
					echo date_format($date,'d/m/y');?>
					</td>
					<td><?php echo($row["User_type"]);?></td>
					<td><?php echo($row["Email"]);?></td>
					<td><?php echo($row["password"]);?></td>
					<td><?php echo($row["lang_type"]);?></td>
					<td><?php echo($row["comment"]);?></td>
					<td>
						 <form action="index1.php" method="POST">
                     <button type="submit" name ="submit" value="<?php echo($row['id'])?>">DELETE</button>
		              </form>
					</td>
					<td > <form action="index1.php" method="POST">
						<input type="text" name="modify">
                     <button type="submit" name ="update" value="<?php echo($row['id'])?>">UPDATE</button>
		              </form>
					</td>

		     </tr>
	
		      
	
		 
		        <?php 
			   	
			}
        }else

                {
                  echo"member does not exist or wrong email";
                }
   }else
          {
          echo "wrong email";
          }
          ?>

</table>
		</div>
</div>	
</body>
</html>