<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Registration </title>
    <style>
        .register{
            display: flex;
            align-content: center;
            margin-right: 20px;
        }
        .all_input{
            margin-right: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            width: 430px;
        }
       
        .m-input1{          
            width: 200px;
            height: 25px;
        }
        .m-email{
            width: 430px;
            height: 25px;
        }
        .m-comment{
                         
            width: 430px;           
        }
        .m-selct{                       
            width: 434px;   
            height: 25px;
            background-color: transparent;        
        }
        label{
            width: 200px;
            margin-right: 30px;
        }
        .button{
            width: 200px;
            height:30px; 
            background-color:  rgb(68, 63, 63);
            color: white; 
            border-radius: 5px;
            margin-right: 30px;
        }
        
        fieldset{
            width: 250px;
        }
        .error { 
            background: #d33;
            <background:gray>
             color: white; 
             padding: 0.2em;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        if ( isset( $_POST["submit"] ) ) {
            processForm();
        } else {
            displayForm( array() );
        }
        function validateField($fieldName, $missingFields)
         {
                
            if(in_array($fieldName, $missingFields))
                {
                    echo 'class="error"';
                }
         }
         function setValue($fieldvalue)
         {
            if(isset($_POST[$fieldvalue]))
            {
                echo $_POST[$fieldvalue];
            }
         }
         function setTextareaValue($fieldNaame)
         {
            if (isset($_POST[$fieldNaame])) 
            {
                 echo htmlspecialchars($_POST[$fieldNaame]);
            }
         }
       function setChecked($fieldname , $fieldValue){
            if(isset($_POST[$fieldname]) and $_POST[$fieldname]==$fieldValue)
            {
                echo 'checked="checked"';
            }
       }
       function setSelectedmultilist($fieldname, $fieldValue)
       {
                if(isset($_POST[$fieldname]) and in_array($fieldValue, $_POST[$fieldname]))
                    {
                        echo 'selected="selected"';
                    }
       }
       function setSelected($fieldname, $fieldValue)
       {
            if(isset($_POST[$fieldname]) and $_POST[$fieldname]==$fieldValue)
            {
                echo 'selected="selected"';
            }
       }
     function processForm(){
       
            $requiredFields=array("fnname","lname","gender", "birthDate", "email", 
            "password", "confPassword", "memberType", "lang_type");
            $missingFields=array();   
            foreach($requiredFields as $requiredField)
            {
                if(!isset($_POST[$requiredField]))
                {
                    $missingFields[]=$requiredField;
                }
                else if( empty($_POST[$requiredField])){
                    $missingFields[]=$requiredField;                  
                }
                 
            }
            if($missingFields)
            {
                
                displayForm($missingFields);
            }
            else{
                dispalyThanks();
            }
        }


     function displayForm( $missingFields ) {

    ?>
        <h1>Member Registration Form</h1>
     <?php
         if ($missingFields)
          {
     ?>
        
        <p class="error" >There were some problem with the form you submitted.
             Please complete the fileds higlighted below and click the Register button to resend the form </p>
     <?php
          }
          else{
     ?>         
              <p>Thank you for choosing to join our group! To Register, 
                  Please fill in your details and click the Register button. Fields marked by asterisk(*) 
                are required </p>
     <?php           
          }
     ?>
     <form action="Registration.php" method="POST">
         <fieldset style="width: 400px;">
            <legend>Registration Form:</legend>
            <div>
                <div class="register">
                    <label for="fnname" class="m_input1" <?php validateField("fnname", $missingFields) ?>> First Name * </label>                               
                    <label for="lname"<?php validateField("lname", $missingFields) ?>> Last Name * </label>
                </div>
                <div class="register">
                    <input type="text" name="fnname" id="fnname" class="m-input1 all_input" placeholder="Enter your first name" value="<?php setValue("fnname")?>" />

                    <input type="text" name="lname" id="lname" class="m-input1 all_input" placeholder="Enter your last name" value="<?php setValue("lname") ?>" />
                
                </div>
            </div>
            <div class="register">
                <div>   
                    <label for="gender" name="gender" <?php validateField("gender", $missingFields) ?>> Gender *</label>
                    <div style="width: 230px">
                        <input type="radio" name="gender" value="Male" <?php setChecked("gender" , "Male") ?> />
                        <label for="">Male</label>
                        <input type="radio" name="gender" value="Female" <?php setChecked("gender" , "Female") ?> />
                        <label for="">Female</label>
                    </div>
                </div> 
                <div>
                    <label for="birthDate" <?php validateField("birthDate", $missingFields)?> name="birthDate"> Birth Date  * </label>
                    <input type="date" name="birthDate"  class="m-input1 all_input" value="<?php setValue("birthDate") ?>"/>
                    
                </div>
            </div>
            <div> 
                <label for="email" <?php validateField("email", $missingFields)?>>Email Address *</label>
            </div>
            <div>
                <input type="email" name="email" placeholder="Enter email" class="m-email all_input" id="email" value="<?php setValue("email")?>"/>
            </div>
            <div>
                <div class="register">   
                    <label for="password" <?php validateField("password", $missingFields)?>>Passsword *</label>
                    <label for="ConfPassword" <?php validateField("confPassword", $missingFields)?>>Confirm Passsword *</label>
                </div>
                <div class="register">   
                    <input type="password"  name="password" placeholder="Enter password" class="m-input1 all_input" id="password" value=""/>
                    <input type="password" name="confPassword" placeholder="Enter Confirm password" class="m-input1 all_input" id="confPassword" value=""/>
               </div>
            </div>
            <div>
                <lable> Select your Member Type *</lable>
                <select name="memberType" id="memberType" size="1" class="m-selct all_input">
                    <option value="Student" <?php setSelected("memberType" , "Student" )?> >Student</option>
                     <option value="Instructor" <?php setSelected("memberType" , "Instructor" )?>> Instructor</optoion>
                     <option value="Customer" <?php setSelected("memberType" , "Customer" )?>> Customer</option>
                     <option value="office" <?php setSelected("memberType" , "office" )?>> Officer</option>
                     <option value="Admin" <?php setSelected("memberType" , "Admin" )?>> Admin</option>
                </select>
            </div>
            <div>
                <lable for="lang_type"<?php validateField("lang_type", $missingFields)?> > Select your language (posibel to select more than one language) *</lable><br>              
                <select size="6" name="lang_type[]" id="lang_type" class="all_input"  multiple="multiple">
                    <option value="Amharic" <?php setSelectedmultilist("lang_type" , "Amharic" )?> >Amharic</option>
                    <option value="English" <?php setSelectedmultilist("lang_type" , "English" )?>>English</option>
                    <option value="Oromigna" <?php setSelectedmultilist("lang_type" , "Oromigna" )?>>Oromigna</option>
                    <option value="Tigrigna" <?php setSelectedmultilist("lang_type" , "Tigrigna" )?>>Tigrigna</option>
                    <option value="Somaligna" <?php setSelectedmultilist("lang_type" , "Somaligna" )?> >Somaligna</option>
                    <option value="Guragigna" <?php setSelectedmultilist("lang_type", "Guragigna" )?> >Guragigna</option>
                </select>
            </div>
            <div>
                <div class="comment">
                    <lable>Comment</lable>
                </div>    
                     <textarea name="comment" rows="4" cols="52"  class="m-comment all_input"> <?php setTextareaValue("comment") ?></textarea>
            </div>
            <div>
                <input type="submit" name="submit" value="Register" class="button">
                <input type="Reset" name="Reset" value="Reset" class="button">
            </div>
                        
          </fieldset> 
     </form>
     <?php
       }
        function dispalyThanks()
        {
     ?>

        <h1>Thank You!</h1>
        <p> Your are Registered! Your entered informations are: </p>
     <?php
        function displayInput(){
            if(isset($_POST["fnname"]) and $_POST["fnname"]!=""){
                echo "First Name: " .$_POST["fnname"]. "<br/>";
            }
            
            if(isset($_POST["lname"]) and $_POST["lname"]!=""){
                echo "Last Name: " .$_POST["lname"]. "<br/>";
            }
            
            if(isset($_POST["gender"]) and $_POST["gender"]!=""){
                echo "Gender: " .$_POST["gender"]. "<br/>";
            }

            if(isset($_POST["birthDate"]) and $_POST["birthDate"]!=""){
                echo "Birth Date: " .$_POST["birthDate"]. "<br/>";
            }
            if(isset($_POST["email"]) and $_POST["email"]!=""){
                echo "Email: " .$_POST["email"]. "<br/>";
            }
            if(isset($_POST["password"]) and $_POST["password"]!=""){
                echo "Password: " .$_POST["password"]. "<br/>";
            }
            if(isset($_POST["memberType"]) and $_POST["memberType"]!=""){
                echo "Member Type: " .$_POST["memberType"]. "<br/>";
            }
            if(isset($_POST["lang_type"]) and $_POST["lang_type"]!=""){
                $selectedLanguage="";
                foreach($_POST["lang_type"] as $language)
                {
                    if(!$selectedLanguage){
                        $selectedLanguage.= $language ;
                    }
                    else{
                        $selectedLanguage.=  " ,". $language;
                    }
                }
                echo "Your selected languge(S) : " .  $selectedLanguage . "<br/>" ;
            }
            if(isset($_POST["comment"]) and $_POST["comment"]!=""){
                echo "Comment: " .$_POST["comment"]. "<br/>";
            }
        }

        displayInput();
     }
     
    
    function saveToDatabase ()
    {
        include_once('connection.php');
        // initializing variables

        try{
                $fname = "";
                $lname = "";
                $gender = "";
                $Bdate="";
                $email    = "";
                $user_type="";
                $password="";
                $ConfPassword="";
                $lang_type="";
                $comment="";
            
                $errors = array(); 

                // REGISTER USER
                if (isset($_POST['submit']))
                {     

                    $fname = mysqli_real_escape_string($db, $_POST['fnname']);       
                    $lname = mysqli_real_escape_string($db, $_POST['lname']);
                    $gender = mysqli_real_escape_string($db, $_POST['gender']);
                    $Bdate=mysqli_real_escape_string($db, $_POST['birthDate']);
                    $email= mysqli_real_escape_string($db, $_POST['email']);
                    $user_type=mysqli_real_escape_string($db, $_POST['memberType']);
                    $password=mysqli_real_escape_string($db, $_POST['password']);
                    $ConfPassword=mysqli_real_escape_string($db, $_POST['confPassword']);
                    $selectedLanguage="";
                    foreach($_POST["lang_type"] as $language)
                    {
                        if(!$selectedLanguage){
                            $selectedLanguage.= $language ;
                        }
                        else{
                            $selectedLanguage.=  " ,". $language;
                        }
                    }
                    $lang_type=mysqli_real_escape_string($db, $selectedLanguage);
                    $comment=mysqli_real_escape_string($db, $_POST['comment']);
                    $email = mysqli_real_escape_string($db, $_POST['email']);
                    
                    // form validation: ensure that the form is correctly filled ...
                    // by adding (array_push()) corresponding error unto $errors array
                    if (empty($fname)) { array_push($errors, "First Name is required"); }
                    if (empty($lname)) { array_push($errors, "Last Name is required"); }
                    if (empty($gender)) { array_push($errors, "Gender is required"); }
                    if (empty($email)) { array_push($errors, "Email is required"); }
                    if (empty($Bdate)) { array_push($errors, "Birth Date is required"); }
                    if (empty($user_type)) { array_push($errors, "Member type is required"); }
                    if (empty($password)) { array_push($errors, "Password  is required"); }
                    if (empty($lang_type)) { array_push($errors, "Language  is required"); }
                    if ($password != $ConfPassword) {
                        array_push($errors, "The two passwords do not match");
                    }
                                // first check the database to make sure 
                    // a user does not already exist with the same username and/or email
                    $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
                    
                    $result = mysqli_query($db, $user_check_query);
                    if($result)
                    {
                         $user = mysqli_fetch_assoc($result);
                    }
                    
                    if ($user)  // if user exists
                    {       
                        if ($user['email'] === $email) {
                            array_push($errors, "email already exists");
                        }
                    }        
                    // Finally, register user if there are no errors in the form
                    if (count($errors) == 0) 
                    {
                        $password = $password;            
                        $query = "INSERT INTO user(fname,lname,gender,Bdate, user_Type,email,password,lang_type,comment)
                        VALUES( '$fname','$lname', '$gender', '$Bdate','$user_type','$email','$password','$lang_type','$comment')";
                        echo($query);
                        
                        $result=mysqli_query($db, $query);
                        if($result){                   
                            $_SESSION['username'] = $fname." ".$lname;
                            $_SESSION['email'] = $email;
                            $_SESSION['success'] = "You are now logged in";
                            header('location: index1.php');
                        }
                        else{
                            print ("Insertion is failed due to \n");;
                        }        
                    }
                    else{
                        echo "The data is not saved on the database the erorrs are :";
                        foreach($errors as $error)
                        {
                            echo "<br>". $error ;
                        }
                    }
            } 
        }
        catch(mysqli_sql_exception $e) 
        {
            echo "Insertion failed:" . $e->getMessage();
        }
                        
                    
    }
    saveToDatabase();
    ?> 
</body>
</html>