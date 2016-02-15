<?php
if (isset($_POST["btnRigester"])) {
    echo "<pre>";
    print_r($_FILES);
    echo "<pre>";

    $dirName    = "attach/";
    $allowedExts= array("pdf","doc","txt","docx");
    $file_name  = $_FILES['txtAttachment']['name'];
    $file_temp  = explode(".", $_FILES["txtAttachment"]["tmp_name"]);
    $extension  = end($file_temp);
    $file_size  = $_FILES['txtAttachment']['size'];

    if (($_FILES["txtAttachment"]["type"] == "application/pdf") || 
        ($_FILES["txtAttachment"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") ||
        ($_FILES["txtAttachment"]["type"] == "text/plain") ||
        ($_FILES["txtAttachment"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") && 
        ($_FILES["file"]["size"] < 2000000) && in_array($extension, $allowedExts)) {

        if (($_FILES["txtAttachment"]["error"] > 0)) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
        } else {
            echo "Upload: " . $_FILES["txtAttachment"]["name"] . "<br>";
            echo "Type: " . $_FILES["txtAttachment"]["type"] . "<br>";
            echo "Size: " . ($_FILES["txtAttachment"]["size"] / 1024) . " kB<br>";
            echo "Temp file: " . $_FILES["txtAttachment"]["tmp_name"] . "<br>";

            if (file_exists("attach/" . $_FILES["txtAttachment"]["name"])) {
                echo $_FILES["txtAttachment"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($file_temp, $dirName.$file_name);
                $attachfile = "http://localhost/attach/".$file_name;
                echo "Stored in: " . "attach/" . $_FILES["txtAttachment"]["name"];
            }
        }
    } else {
        echo "Invalid file.";
    }

}

$day = 14;
$month = 12;
$year = 1985;
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form name="" id="" enctype="multipart/form-data" method="post">
    <div><input type="file" alt="Attachment" title="Attach File Here" name="txtAttachment" id="txtAttachment"></div>
    <div><input type="submit" name="btnRigester" id="btnRigester" value="Register a new customer"/></div>


    <div>
        <select>
            <option>Day</option>
            <?php 
            // $i = array();
            for ($i=1; $i <= 31; $i++) { 

                if ($i == $day) {
                    $a = "selected";
                } else {
                    $a = "";
                }

                // if (in_array($day,$i)) {
                //     $selected = "selected";
                // } else {
                //     $selected = "";
                // }
            ?>
            <option <?php echo $a ?>><?php echo $i?></option>
            <?php } ?>
        </select>
        <select>
            <option>Month</option>
            <?php for ($i=1; $i <= 12; $i++) { ?>
            <option><?php echo $i?></option>
            <?php } ?>
        </select>
        <select>
            <option>Year</option>
            <?php for ($i=2000; $i <= 3000; $i++) { ?>
            <option><?php echo $i?></option>
            <?php } ?>
        </select>
    </div>
</form>
</body>
</html>