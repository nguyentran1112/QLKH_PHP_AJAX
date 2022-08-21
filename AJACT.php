<?php
    include 'db.php';
    //Chèn dữ liệu
    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $birthDate = $_POST['birthDate'];
        $result = mysqli_query($con, "INSERT INTO tbl_kh (hovaten, email, namsinh) VALUES('$name','$email','$birthDate')");
        if($result) {
            echo "1";
        }
        else {
            echo "0";
        }
    };
    //Edit data
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $text = $_POST['text'];
        $columnName = $_POST['columnName'];
        $result = mysqli_query($con, "UPDATE tbl_kh SET $columnName='$text' WHERE `khanghang_id` = '$id'");
        echo json_encode($result);
    };
    //Lấy data
    $output = "";
    $sqlSelect = mysqli_query($con,"SELECT * FROM tbl_kh");
    $output .= '
        <div class="table  table-responsive">
            <table class="table table-bordered table-sm table-striped table-hover">
                <tr>
                    <td>ID</td>
                    <td>Họ và tên</td>
                    <td>Email</td>
                    <td>Năm sinh</td>
                </tr>

    ';
    if(mysqli_num_rows($sqlSelect) > 0) {
        while($row = mysqli_fetch_array($sqlSelect)) {
            $output .= '
            <tr>
                <td>'.$row['khanghang_id'].'</td>
                <td data-id1='.$row['khanghang_id'].' id="fullName" contenteditable>'.$row['hovaten'].'</td>
                <td contenteditable>'.$row['email'].'</td>
                <td contenteditable>'.$row['namsinh'].'</td>
            </tr>

            ';
        }
    }
    else {
        $output .= '
            <tr>
                <td colspan="5">
                    Chưa có dữ liệu
                </td>
            </tr>
        ';
    }
    $output .= '
        </table>
    </div>
    ';

echo $output;
