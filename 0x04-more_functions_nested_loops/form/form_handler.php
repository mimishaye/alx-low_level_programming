<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you</title>

</head>
<body>
  <h1 >Thank you</h1>
  <p>Thank you for your registeration</p> 
  <div>


<div>
<?php 

      if(isset($_GET["fName"]) and $_GET["fName"]!="")
      {

            echo "First Name:".$_GET["fName"];
      }
       ?>
</div>

<div>
<?php  if(isset ($_GET["LName"]) and $_GET["LName"]!="")
       {
             echo "last Name:". $_GET["Name"];
             }?>
</div>
 
<!-- <div>
       <?php  if(($_GET["gender"]) and $_GET["gender"]!=""){
        echo "gender:".$_GET["gender"];
       }?>
</div> -->
<div>
      <?php if(isset ($_GET["Bday"]) and $_GET["Bday"]!=""){

      
                  echo "Bday:". $_GET["Bday"];
                  }?>
</div>
<div>
<?php if(isset ($_GET["email"]) and $_GET["email"]!=""){

      
echo "email:". $_GET["email"];
}?>

</div>
<div>
<?php if(isset ($_GET["user"]) and $_GET["user"]!=""){

      
echo "user:". $_GET["user"];
}?>
</div>

<div>
<?php if(isset ($_GET["pass"]) and $_GET["pass"]!=""){

      
echo "pass:". $_GET["pass"];
}?>
</div>

<div>
      Confirm <?php echo $_GET["Cpass"]?>
</div>

<div>
<?php if(isset ($_GET["coment"]) and $_GET["coment"]!=""){

      
echo "coment:". $_GET["coment"];
}?>
</div>
<div>
    <?php  if(isset($_GET["lang-type"])and $_GET["lang-type"]!="")
{
$selectedlanguage="";
foreach($_GET["lang-type"]as $language)
{
      $selectedlanguage=$language.",";
}
echo "your language:".$selectedlanguage;
}?>
</div>
</body>
</html>