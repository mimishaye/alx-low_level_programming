<DOCTYPE html>
    <html>
        <head>
            <title>document</title>
        </head>
       <body>
        <?php
        if(isset($_POST["sendphoto"]))
        {
            processForm();
        }
        else
        {
            displayForm();
        }
        function processForm()
        {
           if(isset($_FILES["photo"]) and $_FILES["photo"]["error"]=="UPLOAD_ERR_OK")
            {
                if($_FILES["photo"]["type"]!="image/png")
                {
                    echo "<p> allowed only png photos only</p>";
                }
                else if (!move_uploaded_file($_FILES["photo"]["tmp_name"],"photos/".basename($_FILES["photo"]["name"])))
                {
                
                    echo "<p> sorry there are problem uploading the photo.</p>".$_FILES["photo"]["error"];
                }        
                else
                {
                    displayThanks();
                }
            }
            else 
            {
                switch($_FILES["photo"]["error"])
                {
                    case UPLOAD_ERR_INI_SIZE:
                        $message="The photo is larger than the server allow";
                    break;
                    case UPLOAD_ERR_FORM_SIZE:
                        $message="Two photo is larger than the script allow";
                    break;
                    case UPLOAD_ERR_NO_FILE:
                        $message="No file was uploaded make sure your chose five to upload";
                        break;
                    default:
                    $message="please contact your server adminstration"; 
            
                }
                echo "<p>sorry there was a problem uploading a photo .$message</p>";
            }
        }

        function displayForm()
            {
    ?>
                <h1>upload photo</h1>
                <p> please enter your name and choose a file to upload </p>
                <form action="file.php" method="post" enctype="multipart/form-data">
                <div>
                <label for="name">your name </label>
                <input type="text" name="name" value="">
                </div>
                <div>
                <label for="photo">your photo </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="50000">
                <input type="file" name="photo">
                </div>
                <input type="submit" name="sendphoto" value="send photo">
                </form>
    <?php

            }
            function displayThanks()
            {
    ?>
                <h1>Thank you</h1>
                <p>Thanks uploding your photo
                <?php if($_POST["name"])
                {
                    echo ",".$_POST["name"];
                }
                ?>! 
                </p>
                <p>here is your photo:</p>
                <p> <img src="photos/<?php echo $_FILES["photo"]["name"]?>"  alt="photo"/></p>
                <?php
            }
            ?>
       </body>
    </html>