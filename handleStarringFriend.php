<?php
    $conn = mysqli_connect('sophia.cs.hku.hk', $USER, $PSW) or die('Error!'.mysqli_error($conn));
    mysqli_select_db($conn,	'mlakhani') or die('Error!'.mysqli_error($conn));
    $query = 'SELECT * FROM friends WHERE friendID=' . $_GET["friendID"];

    $result = mysqli_query($conn, $query) or die ('Error!'.mysqli_error($conn));
    $row = mysqli_fetch_array($result);

    if ($row['starred'] == "Y"){
        mysqli_query($conn, 'UPDATE friends SET starred="N" WHERE friendID='.$_GET["friendID"]) or die ('Error!'.mysqli_error($conn));
        print 'icons/unstar.png';
    }
    else{
        mysqli_query($conn, 'UPDATE friends SET starred="Y" WHERE friendID='.$_GET["friendID"]) or die ('Error!'.mysqli_error($conn));
        print 'icons/star.png';
    }
?>
