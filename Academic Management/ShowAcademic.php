<!doctype html>
<?php session_start(); ?>
<html>
    <head>
        <title>Academic</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    </head>
    <style>
        body{
            background-color: #FAFAFA;
            height: 100vh;
            margin: 0;
        }
        ul{
            list-style-type: none;
            background-color: #98d499;
            overflow: hidden;
            margin: 0;
            padding: 0;
            position: static;
            z-index: 5;
        }
        li{
            float: left;
            border-left: 1px solid #6E6E6E;
            
        }
        li a {
            text-decoration: none;
            display: block;
            padding: 14px 16px;
            color: white;
            text-align: center;
            font-size: large;
            height: 60px; 
        }
        li a:hover{
            background-color: #F5A9BC;
        }
        .submenu {
            display: none;
            position:absolute;
            z-index: 1;
        }
        .submenu{
            background-color: #CEF6F5;
            width: 300px;
        }
        .submenu a{
            text-decoration: none;
            color: black;
            display: block;
            padding: 15px 16px;
            text-align: center;
            line-height: 2;
        }
        .menus {
            width: 300px;
            height: 60px;
        }
        .menus:hover .submenu{
            display: block;
        }
        .bar {
            background-color: #E6E6E6;
            height: 100%;
            text-align: center;
            text-decoration: none;
            padding: 50px;
        }
        .bar h1 {
            background-color: #848484;
            color: white;
            padding: 15px;
            width: 200px;
            margin: auto;
            border-radius: 20px;
        }
		.table h3 {
            background-color: #848484;
            color: white;
            padding: 10px;
            width: 130px;
            margin-left: 80px;
            border-radius: 20px;
            text-align: center;
            margin-top: 50px;
        }
        .table {
            background-color: #FAFAFA;
            height: 100%;
        }
        .bar a {
            font-size: x-large;
            line-height: 3;
            color: #0404B4;
        }
        .table table{
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            margin: auto;
            width: 1200px;
        }
        .table table th, .table table td {
            border: 1px solid #A4A4A4;
            padding: 8px;
            background-color: white;
        }
        .table table th {
            padding-top: 12px;
            padding-bottom: 12px;
            color: black;
            background-color: #E6E6E6;
            text-align: center;
        }
        .table table td{
            font-size: medium;
            text-align: center;
        }
        .table table td name:hover {
            color: blue;
        }
        .btn {
            background-color: #A9BCF5;
            border: 1px solid black;
            width: 60px;
            padding: 3px;
            margin-top: 5px;
        }
    </style>
    <body>
        <?php
        include_once('dbconnect.php');        
        if(!isset($_SESSION['uname']) || !isset($_SESSION['sid']) ) {
        print "<script language=javascript> alert('???????????? ????????????.'); location.replace('login.html'); </script>";
        }
        else{
            $name = $_SESSION['uname'];
            $sid = $_SESSION['sid'];
            $total = 0;
            $sql = "select * from stenrolment where StudentID = '$sid'";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    $total += $row['Score'];
                    }
                }
        ?>
        <ul>          
            <li style="float: right" class="menus"><a href="javascript:void(0)">????????????</a>
                <div class="submenu">
                    <a href="UserModifiy.php">???????????? ??????</a>
                    <a href="logout.php">????????????</a>
                </div>
            </li>
            <li style="float: right" class="menus"><a href="javascript:void(0)">????????????</a>
                <div class="submenu">
                    <a href="Enrolment.php">????????????</a>
                    <a href="ShowEnrolment.php">????????????</a>
                    <a href="ShowAchieve.php">??????</a>
                    <a href="ShowAcademic.php">????????????</a>
                </div>
            </li>
            <li  style="float: right" class="menus"><a href="javascript:void(0)">????????????</a>
                <div class="submenu">
                    <a href="NoticeList.php?type=??????">????????????</a>
                    <a href="NoticeList.php?type=??????">????????????</a>
                    <a href="NoticeList.php?type=??????">????????????</a>
                    <a href="NoticeList.php?type=??????">????????????</a>
                </div>
            </li>           
            <a href="MainPage.php"><li><img src="img/daejinlogo1.png" style="width: 230px; margin-top: 10px; padding: 5px;"></li></a>
            <p style="margin-top: 15px; font-size:x-large">&emsp;&emsp;<span class="material-icons"> account_circle </span> <?=$name?></p>
        </ul>
        <div class="bar" style="width: 20%;float: left">
            <h1>????????????</h1>
            <br>
            <a href="Enrolment.php">????????????</a><br>
            <a href="ShowEnrolment.php">????????????</a><br>
            <a href="ShowAchieve.php">??????</a><br>
            <a href="ShowAcademic.php">????????????</a><br>
        </div>
        <form action="ShowEnrolmentDel.php" method="post" name="del">
        <div class="table" style="width: 80%; float: right;">
            <h3>????????????</h3>
            <?php $sql = "select * from academic where StudentID = '$sid'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                ?>
            <table>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td colspan="4"style="border:none;background-color: #FAFAFA; text-align:left; height:150px;"><h2 style="font-family: 'Noto Sans KR', sans-serif;"><?=$name?>?????? ????????????</h2></td> 
            </tr>
            <tr>
                <th style=" width:160px;">??????</th>
                <td><?= $row['Name']?></td>
                <th style=" width:160px;">??????</th>
                <td><?= $row['StudentID']?></td>
                <th style="width:150px;">??????</th>
                <td><?= $row['Grade']?></td>
            </tr>
            <tr>
                <th>??????</th>
                <td colspan="5"><?= $row['Address']?></td>
            </tr>
            <tr>
                <th>????????????</th>
                <td><?= $row['Birthday']?></td>
                <th>????????????</th>
                <td><?= $row['Professor']?></td>
                <th style="border-top:0px; width:200px;">????????? ??????</th>
                <td><?= $total?></td>
            </tr>
            <tr>
                <th style="border-top:0px;">????????????</th>
                <td style="border-top:0px;"><?= $row['College']?></td>
                <th style="border-top:0px;">??????</th>
                <td style="border-top:0px;"><?= $row['Department']?></td>
                <th style="border-top:0px;">??????</th>
                <td style="border-top:0px;"><?= $row['CoDepartment']?></td>              
            </tr>
            <?php } ?>
            </table>
            <?php } ?>
        </div>
        </form>
        <?php } ?>
    </body>
</html>


















