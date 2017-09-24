<?php
    include_once ('../connection.php');

    if($_GET['type'] == "msg"){

        $query = "SELECT * FROM contact_us WHERE seen = 0";
        $result = mysqli_query($conn, $query);
        $output = '';
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
                 <li>
                    <a href="contact-us-view.php?id='.$row['id'].'">
                        <div class="pull-left">
                            <i class="fa fa-user lg"></i>
                        </div>
                        <h4>
                            '.$row["name"].'
                            <small><i class="fa fa-clock-o"></i>'.$row['date'].'</small>
                        </h4>
                        <p'.$row["message"].'</p>
                    </a>
                </li>';
        }
        echo $output;
    }
    if($_GET['type'] == "total"){
        $sql = "SELECT COUNT(id) as totalUnread FROM contact_us WHERE seen = '0'";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($result))
        {
            $output = $row['totalUnread'];
        }
        echo $output;
    }

//$update_query = "UPDATE comments SET comment_status = 1 WHERE comment_status = 0";
//mysqli_query($connect, $update_query);

?>