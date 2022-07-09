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
            margin-bottom:8px;
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
        #photo_image{
            width:200px;
            height: 150px;
            border: 1px solid black;
            background-position :center;
            background-size: cover;        
        }
    </style>
</head>
<body>
    <?php

        if ( isset( $_POST["submit"] ) ) {
            processForm();
        } else {
            displayForm( array(), "" );
        }
        function validateField($fieldName, $missingFields)
         {                
            if(in_array($fieldName, $missingFields))
                {
                    echo 'class="error"';
                }            
         }
         function setLabelValue($fieldvalue, $error)
         {
            echo htmlspecialchars($error);            
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
       function processFile() 
       {  
            $message="";
            if( !isset($_FILES["photo"]))
            {
                $message="No file was uploaded. Make sure you choose a file to upload.";
            }
            else if ( isset($_FILES["photo"]) and $_FILES["photo"]["error"] == UPLOAD_ERR_OK )
            {   
                if ( $_FILES["photo"]["type"] != "image/jpeg" )
                {      
                    $message="JPEG  photos only, thanks!"; 
                } 
                elseif ( !move_uploaded_file( $_FILES["photo"]["tmp_name"], "photos/" . basename( $_FILES["photo"]["name"] ) ) )
                {     
                    $message="Sorry, there was a problem uploading that photo. Moving issues " . $_FILES["photo"]["error"] ;   
                }
                else{
                    $message="Uploaded";
                } 
            }        
            else 
            {    
                
                switch( $_FILES["photo"]["error"] ) 
                {      
                    case UPLOAD_ERR_INI_SIZE:    
                            $message = "The photo is larger than the server allows.";
                            break;      
                    case UPLOAD_ERR_FORM_SIZE:    
                            $message = "The photo is larger than the script allows.";  
                            break;      
                    case UPLOAD_ERR_NO_FILE:      
                        $message = "No file was uploaded. Make sure you choose a file to upload.";
                        break;     
                    default:       
                        $message = "Please contact your server administrator for help."; 
                }                 
            }
            return $message; 
        }
     function processForm(){
       
            $requiredFields=array("fnname","lname","gender", "birthDate", "email", 
            "password", "confPassword", "memberType", "lang_type");
            $missingFields=array(); 
            $imageUploadError="";  
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
            $imageUpload=processFile();
            if($imageUpload!="Uploaded")
            {
                $missingFields[]="photo";
                $imageUploadError=$imageUpload;
            }

            if($missingFields)
            {
                
                displayForm($missingFields,$imageUploadError);
            }
            else{
                dispalyThanks();
            }
        }


     function displayForm( $missingFields,$imageUploadError ) {

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
     <form action="RegistrationwithPhoto.php" method="POST" enctype="multipart/form-data">
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
                    </div>
                
                <div>
                    <div class="register">
                        <label for="birthDate" <?php validateField("birthDate", $missingFields)?> name="birthDate"> Birth Date  * </label>
                    </div> 
                    <div class="register">
                        <input type="date" name="birthDate"  class="m-input1 all_input" value="<?php setValue("birthDate") ?>"/>
                    </div>    
                </div>
            </div>
            <div>
                 
                <label for="photo" <?php validateField("photo", $missingFields) ?>>Your photo</label> 
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />  
                <div id="photo_image"> </div>  
                <input type="file" name="photo" id="photo"/>
                <label name="imageError"><?php setLabelValue("imageError",$imageUploadError)?></label>
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
        if ( $_POST["fnname"] )
        {
    ?>
       <p>Here's your photo:</p>   
       <p><img src="photos/<?php echo $_FILES["photo"]["name"] ?>" alt="Photo" width="200px" height="200px" /></p>
    <?php
    }
     
}
    ?> 
    <script>    
        const image_input=document.querySelector("#photo");
        var  uploaded_image="";
        image_input.addEventListener("change", function(){
            console.log(image_input.value)
            const reader = new FileReader();
            reader.readAsDataURL(image_input.files[0]);
            reader.addEventListener("load", ()=>{
                uploaded_image=image_input.files[0];
                console.log(reader.result);
                    document.querySelector("#photo_image").style.backgroundImage='url(${uploaded_image})';
            });
         
        })
    </script>
</body>
</html>