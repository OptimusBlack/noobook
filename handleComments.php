<?php
    $conn = mysqli_connect('sophia.cs.hku.hk', 'mlakhani', 'hku2020') or die('Error!'.mysqli_error($conn));
    mysqli_select_db($conn,	'mlakhani') or die('Error!'.mysqli_error($conn));
    $result = mysqli_query($conn, 'SELECT * FROM comments') or die ('Error!'.mysqli_error($conn));
    $numRows = mysqli_num_rows($result);
    $commID = $numRows+1;

    $query = 'INSERT INTO comments (commentID, postID, time, commContent) VALUES (' . $commID . ',' . $_GET["postID"] . ',"' . $_GET["time"] . '","' . $_GET["commContent"] . '")';
    mysqli_query($conn,$query) or die ('Error!'.mysqli_error($conn));

    print '<p>You said: ' . $_GET["commContent"] . '</p>';
    print '<p>on ' . $_GET["time"] . '</p>';
?>