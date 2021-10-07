<!doctype html>
<?php session_start(); ?>
<html>
    <head>
        <title>Enrolment</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <style>
        body{
            background-color: #F2F2F2;
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
            margin-top: 60px;
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
            background-color: #A9F5BC;
            border: 1px solid black;
            width: 60px;
            padding: 3px;
        }
    </style>
    <body>
        <?php
        include_once('dbconnect.php');        
        if(!isset($_SESSION['uname']) || !isset($_SESSION['sid']) ) {
        print "<script language=javascript> alert('로그인을 해주세요.'); location.replace('login.html'); </script>";
        }
        else{
            $name = $_SESSION['uname'];
        ?>
        <ul>          
            <li style="float: right" class="menus"><a href="javascript:void(0)">회원정보</a>
                <div class="submenu">
                    <a href="UserModifiy.php">회원정보 수정</a>
                    <a href="logout.php">로그아웃</a>
                </div>
            </li>
            <li style="float: right" class="menus"><a href="javascript:void(0)">학적정보</a>
                <div class="submenu">
                    <a href="Enrolment.php">수강신정</a>
                    <a href="ShowEnrolment.php">수강강좌</a>
                    <a href="ShowAchieve.php">성적</a>
                    <a href="ShowAcademic.php">학사정보</a>
                </div>
            </li>
            <li  style="float: right" class="menus"><a href="javascript:void(0)">공지사항</a>
                <div class="submenu">
                    <a href="NoticeList.php?type=일반">일반공지</a>
                    <a href="NoticeList.php?type=학사">학사공지</a>
                    <a href="NoticeList.php?type=장학">장학공지</a>
                    <a href="NoticeList.php?type=취업">취업공지</a>
                </div>
            </li>           
            <a href="MainPage.php"><li><img src="img/daejinlogo1.png" style="width: 230px; margin-top: 10px; padding: 5px;"></li></a>
            <p style="margin-top: 15px; font-size:x-large">&emsp;&emsp;<span class="material-icons"> account_circle </span> <?=$name?></p>
        </ul>
        <div class="bar" style="width: 20%;float: left">
            <h1>수강신청</h1>
            <br>
            <a href="Enrolment.php">수강신청</a><br>
            <a href="ShowEnrolment.php">수강강좌</a><br>
            <a href="ShowAchieve.php">성적</a><br>
            <a href="ShowAcademic.php">학사정보</a><br>
        </div>
        <div class="table" style="width: 80%; float: right;">
            <h3>수강신청</h3>
            <?php $sql = "select * from enrolment";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                ?>
            <table>
            <tr>
                <th>과목코드</th>
                <th style="width:400px;">과목명</th>
                <th>미수구문</th>
                <th>학점</th>
                <th>담당교수</th>
                <th>강의시간</th>
                <th></th>
            </tr>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['Code']?></td>
                <td><?= $row['Subject']?></td>
                <td><?= $row['Major']?></td>
                <td><?= $row['Score']?></td>
                <td><?= $row['Professor']?></td>
                <td><?= $row['Time']?></td>
                <td style="width:100px;"><a href="EnrolmentProc.php
                ?code=<?= $row['Code']?>&sub=<?= $row['Subject']?>&major=<?= $row['Major']?>&score=<?= $row['Score']?>
                &pro=<?= $row['Professor']?>&time=<?= $row['Time']?>"
                class="btn">신청</a></td>
            </tr>
            <?php } ?>
            </table>
            <?php }
            else{ ?>
                <h1 style="text-align: center; margin-top:50px;">수강 신청 가능한 강좌가 없습니다..</h1>
            <?php
            } ?>
        </div>
        <?php }?>
    </body>
</html>