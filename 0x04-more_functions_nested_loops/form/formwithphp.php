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
  if (isset($_POST["Register"])) {

    processForm();
  } else {
    displayForm(array());
  }

  function validateField($fieldName, $missingFields)
  {
    if (in_array($fieldName, $missingFields)) {
      echo 'class="error"';
    }
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
  function setSelected($fieldName, $fieldValue)
  {
    if (isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue) {
      echo 'Selected="Selected"';
    }
  }
  function processForm()
  {
    $requiredFields = array("fname", "lname", "gender", "bdate", "pass", "cpass", "email", "user", "lan-type");
    $missingFields = array();
    foreach ($requiredFields as $requiredField) {
      if (!isset($_POST[$requiredField])) {
        $missingFields[] = $requiredField;
      } else if (empty($_POST[$requiredField])) {
        $missingFields[] = $requiredField;
      }
    }

    if ($missingFields) {
      displayForm($missingFields);
    } else {
      displayThanks();
    }
  }
  function displayForm($missingFields)
  {
  ?>
    <h1> Member Registration Form </h1>
    <?php
    if ($missingFields) { ?>
      <p class="error">There were some problems with the form you submitted.
        Please complete the fields highlighted below and click Send Details to resend the form.</p>
    <?php
    } else {
    ?>
      <p>Thanks for choosing to join the students placement. To register, please fill in your details below and click the register button.
        Fields marked with an asterisk (*) are required.</p>
    <?php
    }
    ?>

    <form action="formwithphp.php" method="POST">
      <fieldset class="fs">
        <legend>Register Form:</legend>
        <div>
          <div class="register">
            <label for="fname" id="fname" <?php validateField("fname", $missingFields) ?>>First Name* </label>
            <label for="lname" id="lname" <?php validateField("lname", $missingFields) ?>>Last Name* </label>
          </div>
          <div class="register">
            <input type="text" placeholder="Enter first name" class="m-name" id="fname" name="fname" value="<?php setValue("fname") ?>" />
            <input type="text" placeholder="Enter last name" class="m-name" id="lname" name="lname" value="<?php setValue("lname") ?>" />
          </div>
        </div>
        <div>
          <div>
            <label name="gender" id="gender" <?php validateField("gender", $missingFields) ?>>Gender * </label>
            <label name="bdate" id="bdate" <?php validateField("bdate", $missingFields) ?>>Birthday * </label>
          </div>
          <div class="gender_birth">
            <input type="radio" name="gender" value="Male" Checked($fieldName,$fieldValue) />Male
            <input type="radio" name="gender" value="Female" Checked($fieldName,$fieldValue) />Female
            <input id="bdate" type="date" name="bdate" />
          </div>
        </div>
        <div>
          <label name="email" id="email" <?php validateField("email", $missingFields) ?>>Email* </label>
        </div>
        <div>
          <input type="email" placeholder="Enter email" class="m-email" id="email" name="email" />
        </div>
        <div>
          <label name="user" id="user" <?php validateField("user", $missingFields) ?>>Select your user type* </label>
        </div>
        <div>
          <select class="select" size="1" name="user">
            <option value="student" <?php setSelected("user", "student") ?>>Student</option>
            <option <?php setSelected("user", "Teacher") ?>>>Teacher</option>
            <option <?php setSelected("user", "Dean") ?>>Dean</option>
          </select>
        </div>
        <div>
          <label <?php validateField("lan-type", $missingFields) ?>>Select Language* </label>
        </div>
        <div>
          <select size="6" name="lan-type[]" id="lan-type" multiple="multiple" style="width: 450px;">
            <option value="amharic" <?php setSelected("lan-type", "Amharic") ?>>Amharic</option>
            <option value="english" <?php setSelected("lan-type", "english") ?>>English</option>
            <option value="oromifa" <?php setSelected("lan-type", "oromifa") ?>>Afanoromo</option>
            <option value="tigrigna" <?php setSelected("lan-type", "tigrigna") ?>>Tigrigna</option>
            <option value="somaligna" <?php setSelected("lan-type", "somaligna") ?>>Somaligna</option>
            <option value="guragegna" <?php setSelected("lan-type", "guragegna") ?>>Guragegn</option>
          </select>
        </div>
        <div>
          <div class="register">
            <label name="pass" id="pass" <?php validateField("pass", $missingFields) ?>>Password* </label>
            <label name="cpass" id="cpass" <?php validateField("cpass", $missingFields) ?>>Confirm Password * </label>
          </div>
          <div class="register">
            <input type="password" placeholder="Password" class="m-name" id="pass" name="pass" />
            <input type="password" placeholder="Confirm Password" class="m-name" id="cpass" name="cpass" />
          </div>

        </div>
        <div>
          <label>Comment</label>
        </div>
        <div>
          <textarea name="comment" id="ta" cols="60" rows="6"></textarea>
        </div>

        <input type="submit" name="Register" value="Register" class="button" id="button" />
        <input type="reset" name="reset" value="Reset" class="button" id="reset" />

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
      echo "First Name: " . $_POST["fname"] . "<\br>";
    }
  }
  ?>

</body>

</html>