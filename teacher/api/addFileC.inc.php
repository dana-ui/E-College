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

        $ssId = $_POST['ssId'];
        $assid = $_POST['assId'];
        $date = date("Y-m-d h:i:sa");
        $cap = $_POST['caption'];
        $sql = "INSERT INTO meterials (meterialName, upTime, ass_id, caption) VALUES ('$FileNameNew', '$date', '$assid', '$cap')";
        $addC = mysqli_query($conn, $sql);
            if($addC){
                header("Location: ../showAssigment.php?id=$assid&class=$ssId"); 
        }else{
            echo"ERROR";
        }
    }else{
        header("Location: ../showAssigment.php?id=$assid&class=$ssId"); 
    }