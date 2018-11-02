<?php
    $conn = mysqli_connect('sophia.cs.hku.hk', $USER, $PSW) or die('Error!'.mysqli_error($conn));
    mysqli_select_db($conn,	'mlakhani') or die('Error!'.mysqli_error($conn));
    $query = 'SELECT * FROM friends WHERE starred="Y"';

    $result = mysqli_query($conn, $query) or die ('Error!'.mysqli_error($conn));

    while ($row = mysqli_fetch_array($result)){
        print '<p class="starredEntries">' . $row['name'] . '</p>';
    }
?>
