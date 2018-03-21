<?php

    include_once('../kbFunctions.php');

    if(isset($_POST['protocolName'])) {
        $filepath = '../' . getFilepath('../mainTabs', '/' . $_POST['elem_id'] . '/' . $_POST['parentMenu'] . '/' . $_POST['protocolName'] . '.php');
        if(isset($_POST['newData'])) {
            $fileData = $_POST['newData'];
        } else {
            $fileData = '<h1>Data was unsuccessfully saved</h1>';
        }

        $file = fopen($filepath, "w+");
        fwrite($file, $fileData);
        fclose($file);
    } else {
        echo 'There was no file found with the name of "' . $_POST['protocolName'] . '"';
    }

?>