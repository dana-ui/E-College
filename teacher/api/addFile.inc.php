<?php
if (isset($_POST['addFile'])){
require '../../assets/setup/db.inc.php';
if (!empty($_FILES['upFile']['name']))
        {
            $fileName = $_FILES['upFile']['name'];
            $fileTmpName = $_FILES['upFile']['tmp_name'];
            $fileSize = $_FILES['upFile']['size'];
            $fileError = $_FILES['upFile']['error'];
            $fileType = $_FILES['upFile']['type']; 

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('pdf', 'pptx', 'doc', 'docx', 'php', 'html', 'sql', 'rar', 'zip', 'mp3', 'mp4', 'wav');
            if (in_array($fileActualExt, $allowed))
            {
                if ($fileError === 0)
                {
                    if ($fileSize < 1000000000)
                    {
                        $FileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = '../uploads/files/' . $FileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);

                    }
                    else
                    {
                        $_SESSION['ERRORS']['fileerror'] = 'file size should be less than 10MB';
                        header("Location: ../");
                        exit(); 
                    }
                }
                else
                {
                    $_SESSION['ERRORS']['fileerror'] = 'file upload failed, try again';
                    header("Location: ../");
                    exit();
                }
            }
            else
            {
                $_SESSION['ERRORS']['fileerror'] = 'invalid file type, try again';
                header("Location: ../");
                exit();
            }
        }

        $classid = $_POST['classid'];
        $caption = $_POST['caption'];
        $date = date("Y-m-d h:i:sa");
        $sql = "INSERT INTO meterials (meterialName, upTime, Classid, caption) VALUES ('$FileNameNew', '$date', '$classid', '$caption')";
        $addC = mysqli_query($conn, $sql);
            if($addC){
                header("Location: ../showClass.php?classid=$classid"); 
        }else{
            echo"ERROR";
        }
    }else{
        header("Location: ../showClass.php?classid=$classid"); 
    }