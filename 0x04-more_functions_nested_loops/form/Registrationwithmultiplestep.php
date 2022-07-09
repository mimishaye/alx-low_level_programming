<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="style.css" />
  <title>Form Validation</title>

  <style>
    .error {
      background: #d33;
      color: white;
      padding: 0.2 em;
    }

    .button {
      width: 200px;
      height: 30px;
      background-color: rgb(63, 63, 63);
      color: white;
      border-radius: 5px;
      margin-right: 30px;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  if(isset($_POST["step"]) and
  $_POST["step"]>=1 and
  $_POST["step"]<=3)
  {
    call_user_func("processstep".
    (int)$_POST["step"]);
  }
  else
  {
    displaystep1();
  }

  function setValue($fieldValue)
  {
    if (isset($_POST[$fieldValue])) {
      echo $_POST[$fieldValue];
    }
  }
  function setchecked($fieldName, $fieldValue)
  {
    if (null !== ($_POST[$fieldName] and $_POST["fieldName"] == $fieldValue)) {
      echo 'checked="Checked"';
    }
  }
  function settextareaValue($fieldValue){
      if(isset($_POST[$fieldValue]))
      {
        echo htmlspecialchars($_POST[$fieldValue]);
      }
    }
  function setSelected($fieldName, $fieldValue)
  {
    if (isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue) {
      echo 'Selected="Selected"';
    }
  }
  function setSelectedMultipleList($fieldName, $fieldValue)
    {
      if(isset($_POST[$fieldName])and
      in_array($fieldValue,$_POST[$fieldName]))
      {
        echo 'selected="selected"';
      }
    }
  function processstep1()
  {
    displaystep2();
  }
 function processstep2()
 {
  echo $_POST["submitbutton"];  
  if(isset($_POST["submitbutton"])
    and $_POST["submitbutton"]=="< Back")
    {
        displaystep1();
    }
    else
    {
        displaystep3();
    }
 }
function processstep3(){
    if(isset($_POST["submitbutton"]) and
    $_POST["submitbutton"]=="< Back")
    {
        displaystep2();
    }
    else
    {
        displayThanks();
    }
}
function displaystep1()
    {
        ?>
        <h1> member registration step1 </h1>
        <form action="Registrationwithmultiplestep.php" method="post">
        <feildset>
        <legend> registarion form: step1 </legend>
        <input type="hidden" name="step" id="step" value="1">
        <input type="hidden" name="email" id="email" value="<?php setValue("email")?>">
        <input type="hidden" name="user type" id="user type" value="<?php setValue("user type")?>">
        <input type="hidden" name="password" id="password" value="<?php setValue("password")?>">
        <input type="hidden" name="confirm password" id="confirm password" value="<?php setValue("confirm password")?>">
        <input type="hidden" name="comment" id="comment" value="<?php setValue("comment")?>">
         <input type="hidden" name=" lan-type" id="lan-type " value="<?php setValue("lan-type")?>">
        <div>
          <div class="register">
            <label for="fname" id="fname" >First Name* </label>
            <label for="lname" id="lname" >Last Name* </label>
          </div>
          <div class="register">
            <input type="text" placeholder="Enter first name" class="m-name" id="fname" name="fname" value="<?php setValue("fname") ?>" />
            <input type="text" placeholder="Enter last name" class="m-name" id="lname" name="lname" value="<?php setValue("lname") ?>" />
          </div>
        </div>
        <div>
          <div>
            <label name="gender" id="gender">Gender * </label>
            <label name="bdate" id="bdate" >Birthday * </label>
          </div>
          <div class="gender_birth">
            <input type="radio" name="gender" value="Male" Checked($fieldName,$fieldValue) />Male
            <input type="radio" name="gender" value="Female" Checked($fieldName,$fieldValue) />Female
            <input id="bdate" type="date" name="bdate" />
          </div>
        </div>
        <input type="submit" name="submitbutton" class ="button" value="Next &gt;">
    </fieldset>
    </form>
    <?php
    }
    function displaystep2()
    {
        ?>
    <h1> member registration step2 </h1>
        <form action="Registrationwithmultiplestep.php" method="post">
        <feildset>
        <legend> registarion form: step2 </legend>
        <input type="hidden" name="step" id="step" value="2">
        <input type="hidden" name="fname" id="fname" value="<?php setValue("fname")?>">
        <input type="hiddne" name="lname" id="lname" value="<?php setValue("lname")?>">
        <input type="hiddne" name="gender" id="gender" value="<?php setValue("gender")?>">
        <input type="hiddne" name="bdate" id="bdate" value="<?php setValue("bdate")?>">
        <input type="hidden" name="comment" id="comment" value="<?php setValue("comment")?>">
         <input type="hidden" name=" lan-type" id="lan-type " value="<?php setValue("lan-type")?>">
        
        <div>
          <label name="email" id="email" >Email* </label>
        </div>
        <div>
          <input type="email" placeholder="Enter email" class="m-email" id="email" name="email" />
        </div>
        <div>
          <label name="user" id="user">Select your user type* </label>
        </div>
        <div>
          <select class="select" size="1" name="user">
            <option value="student" <?php setSelected("user", "student") ?>>Student</option>
            <option <?php setSelected("user", "Teacher") ?>>>Teacher</option>
            <option <?php setSelected("user", "Dean") ?>>Dean</option>
          </select>
        </div>
           <input type="submit" name="submitbutton" value="&lt; Back">
          <input type="submit" name="submitbutton" value="Next &gt;">

    </fieldset>

    </form>
  <?php
    }
    function displaystep3()
    {
        ?>

      <h1> member registration step3 </h1>
        <form action="Registrationwithmultiplestep.php" method="post">
        <feildset>
        <legend> registarion form: step3 </legend>
        <input type="hidden" name="step" id="step" value="3">
        <input type="email" name="email" id="email" value="<?php setValue("email")?>">
        <input type="hidden" name="user" id="user" value="<?php setValue("user")?>">
        <input type="password" name="password" id="password" value="<?php setValue("password")?>">
        <input type="password" name="confirm password" id="confirm password" value="<?php setValue("confirm password")?>">
        <input type="hidden" name="fname" id="fname" value="<?php setValue("fname")?>">
        <input type="hiddne" name="lname" id="lname" value="<?php setValue("lname")?>">
        <input type="hiddne" name="gender" id="gender" value="<?php setValue("gender")?>">
        <input type="hiddne" name="bdate" id="bdate" value="<?php setValue("bdate")?>">
          <select size="6" name="lan-type[]" id="lan-type" multiple="multiple" style="width: 450px;">
            <option value="amharic" <?php setSelected("lan-type", "Amharic") ?>>Amharic</option>
            <option value="english" <?php setSelected("lan-type", "english") ?>>English</option>
            <option value="oromifa" <?php setSelected("lan-type", "oromifa") ?>>Afanoromo</option>
            <option value="tigrigna" <?php setSelected("lan-type", "tigrigna") ?>>Tigrigna</option>
            <option value="somaligna" <?php setSelected("lan-type", "somaligna") ?>>Somaligna</option>
            <option value="guragegna" <?php setSelected("lan-type", "guragegna") ?>>Guragegn</option>
          </select>
        
        <div>
            
          <label>Comment</label>
        </div>
        <div>
          <textarea name="comment" id="ta" cols="60" rows="6"><?php settextareaValue("comment")?></textarea>
        </div>
        <input type="reset" name="reset" value="Reset" class="button" id="reset" />
          <input type="submit" name="submitbutton" value="&lt; Back">
         <input type="submit" name="submitbutton" value="Next &gt;">

      </fieldset>
    </form>
  <?php
  }
  function displayThanks()
  {
  ?>
    <h1> Thank You </h1>
    <p> You are registered! </p>
  <?php
    if (isset($_POST["fname"]) and $_POST["fname"] != "") {
      echo "First Name: " . $_POST["fname"] . "<br>";
    }
    if (isset($_POST["lname"]) and $_POST["lname"] != "") {
      echo "Last Name: " . $_POST["lname"] . "<br>";
    }
    if (isset($_POST["email"]) and $_POST["email"] != "") {
      echo "email: " . $_POST["email"] . "<br>";
    }
    if (isset($_POST["gender"]) and $_POST["gender"] != "") {
      echo "gender: " . $_POST["gender"] . "<br>";
    }
    if (isset($_POST["pass"]) and $_POST["pass"] != "") {
      echo "password: " . $_POST["pass"] . "<br>";
    }
    if (isset($_POST["lan-type"]) and $_POST["lan-type"] != "") {
      $selectedlanguage="";
      foreach($_POST["lan-type"]as $language)
      {
        if(!$selectedlanguage)
        {
          $selectedlanguage.=$language;
        }
        else{
          $selectedlanguage.=",".$language;
        }
       }
      echo "your language: ".$selectedlanguage."<br>";
    }
    
     if (isset($_POST["comment"]) and $_POST["comment"] != "") {
      echo "comment: " . $_POST["comment"] . "<br>";
    }
    


  }

  function savetoDatabase()
  {
    include_once("connection.php");
    $fname="";
    $lname="";
    $gender="";
    $bdate="";
    $user_type="";
    $email="";
    $password="";
    $confirm="";
    $lan_type="";
    $comment="";
    $error=array();
    if(isset($_POST['submit']))
    {
      $fname=mysqli_real_escape_straing($db,$_POST['fname']);
      $lname=mysqli_real_escape_straing($db,$_POST['lname']);
      $gender=mysqli_real_escape_straing($db,$_POST['gender']);
      $bdate=mysqli_real_escape_straing($db,$_POST['bdate']);
      $email=mysqli_real_escape_straing($db,$_POST['email']);
      $password=mysqli_real_escape_straing($db,$_POST['password']);
      $confirm=mysqli_real_escape_straing($db,$_POST['confirm']);
      $user_type=mysqli_real_escape_straing($db,$_POST['user_type']);
$selectedlanguage="";
foreach($_POST('lang_type')as $language){
  if($selectedlanguage=="")
  {
    $selectedlanguage=$language;
  }
  else{
    $selectedlanguage=','.$language;
  }
}
$lan_type=mysqli_real_escape_straing($db,$selectedlanguage);
      $comment=mysqli_real_escape_straing($db,$_POST['comment']);
      if(empty($fname)) {array_push($errors,"first name is required");}
      if(empty($lname)) {array_push($errors,"last name is required");}
      if(empty($gender)) {array_push($errors,"gender name is required");}
      if(empty($email)) {array_push($errors,"email name is required");}
      if(empty($password)) {array_push($errors,"password name is required");}
      if(empty($lan_type)) {array_push($errors,"lan_type name is required");}
      if(empty($user_type)) {array_push($errors,"user_type name is required");}

      if($password !=$confpassword){
        array_push($error,"the password does't match");
      }
      $user_check_queue="select * form member where email='$email' LIMIT 1";
      $result = mysql_query($db,$user_check_query);
      $user=mysqli_featch_assoc($result);
      if($user)
      {
        array_push($errors,"email already exist");
      }
      if(count($errors)==0)
      {
        $query="Insert into member
        (fname,lname,gender,bdate,user_type,email,password,lan-type,comment)
        Values('$fname','$lname','$gender','$bdate','$user_type','$email','$password','$lan_type','$comment')";
        $result=mysqli_query($db,$query);
        if($result)
        {
          $_SESSION["username"]=$fname;
          $_SESSION["success"]="your are now loged in";
          //header('location:index.php');
        }
        else{
          print("Inserting of new member is failed");
        }
      }
        else{
          echo "the data not saved on database.the error are";
        }
        foreach($error as $error)
        {
          echo "<br>" . $error;
        }
      }
    }
 savetoDatabase();
  
  ?>

</body>

</html>