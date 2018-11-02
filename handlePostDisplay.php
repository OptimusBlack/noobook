<?php
    $conn = mysqli_connect('sophia.cs.hku.hk', $USER, $PSW) or die('Error!'.mysqli_error($conn));
    mysqli_select_db($conn,	'mlakhani') or die('Error!'.mysqli_error($conn));
    $result = mysqli_query($conn, 'SELECT * FROM posts') or die ('Error!'.mysqli_error($conn));
    $numRows = mysqli_num_rows($result);

    if ($_GET["numOfPosts"] >= $numRows){
        
    }

    else if ( ($numRows - $_GET["numOfPosts"]) <= 3){
        //$posts = mysqli_query($conn, 'SELECT * FROM posts') or die ('Error!'.mysqli_error($conn));
        //print '<p>elseif ' . $_GET["numOfPosts"] . '</p>';
        $rowIdx = $_GET["numOfPosts"]+1;
        while ($rowIdx <= $numRows){
            $posts = mysqli_query($conn, 'SELECT * FROM posts WHERE postID =' . $rowIdx) or die ('Error!'.mysqli_error($conn));
            $row = mysqli_fetch_array($posts);
            $friends = mysqli_query($conn, 'SELECT * FROM friends WHERE friendID = ' . $row['friendID']) or die ('Error!'.mysqli_error($conn));
            $rowFriends = mysqli_fetch_array($friends);
            print '<div id="post' . $row['postID'] . '" class="post">';
            print "<h3>" . $rowFriends['name'] . " ";
            if ($rowFriends['starred'] == "Y"){
                print '<img id="starPost' . $row['postID'] . 'Fri' . $row['friendID'] . '" src="icons/star.png" onclick="starFriend(' . $rowFriends['friendID'] . ')">';
            }
            else{
                print '<img id="starPost' . $row['postID'] . 'Fri' . $row['friendID'] . '" src="icons/unstar.png" onclick="starFriend(' . $rowFriends['friendID'] . ')">';
            }
            print '</h3>';
            print "<h5>" . $row['time'] . "     " . $row['location'] . "</h5>";
            print "<p>" . $row['content'] . "</p>";
            print '<img src=' . $row['image'] . ' class="postImages">';
            $commQuery = mysqli_query($conn, 'SELECT * FROM comments WHERE postID = ' . $row['postID']) or die ('Error!'.mysqli_error($conn));
            while ($rowComm = mysqli_fetch_array($commQuery)){
                print '<p>You said: ' . $rowComm['commContent'] . '</p>';
                print '<p>on ' . $rowComm['time'] . '</p>';
            }
            print '<input id=' . $row['postID'] . ' type="text" placeholder="write a comment here..." onkeydown="if (event.keyCode == 13){postComment(this)}">';
            print '</div>';
            $rowIdx++;
        }
    }

    else{
        $rowIdx = $_GET["numOfPosts"]+1;
        while ($rowIdx <= ($_GET["numOfPosts"] + 3)){
            $posts = mysqli_query($conn, 'SELECT * FROM posts WHERE postID =' . $rowIdx) or die ('Error!'.mysqli_error($conn));
            $row = mysqli_fetch_array($posts);
            $friends = mysqli_query($conn, 'SELECT * FROM friends WHERE friendID = ' . $row['friendID']) or die ('Error!'.mysqli_error($conn));
            $rowFriends = mysqli_fetch_array($friends);
            print '<div id="post' . $row['postID'] . '" class="post">';
            print "<h3>" . $rowFriends['name'] . " ";
            if ($rowFriends['starred'] == "Y"){
                print '<img id="starPost' . $row['postID'] . 'Fri' . $row['friendID'] . '" src="icons/star.png" onclick="starFriend(' . $rowFriends['friendID'] . ')">';
            }
            else{
                print '<img id="starPost' . $row['postID'] . 'Fri' . $row['friendID'] . '" src="icons/unstar.png" onclick="starFriend(' . $rowFriends['friendID'] . ')">';
            }
            print '</h3>';
            print "<h5>" . $row['time'] . "     " . $row['location'] . "</h5>";
            print "<p>" . $row['content'] . "</p>";
            print '<img src=' . $row['image'] . ' class="postImages">';
            $commQuery = mysqli_query($conn, 'SELECT * FROM comments WHERE postID = ' . $row['postID']) or die ('Error!'.mysqli_error($conn));
            while ($rowComm = mysqli_fetch_array($commQuery)){
                print '<p>You said: ' . $rowComm['commContent'] . '</p>';
                print '<p>on ' . $rowComm['time'] . '</p>';
            }
            print '<input id=' . $row['postID'] . ' type="text" placeholder="write a comment here..." onkeydown="if (event.keyCode == 13){postComment(this)}">';
            print '</div>';
            $rowIdx++;
        }
    }
    mysqli_close($conn);
?>
