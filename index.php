<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>index</title>
</head>
<body>
<?php
    require("SetSessionStatus.php");
?>
<nav class="navbar navbar-light bg-danger">
    <a class="navbar-brand text-light" href="#">
        <img src="" width="30" height="30" class="d-inline-block align-top" alt="">
        FoodKoala
    </a>
    <form class="form-inline" action="check.php?s=3" method='POST'>
        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">เข้าสู่ระบบ</button>
    </form>
</nav>
<form class="form-inline justify-content-center">



</form>
    <form class="form-inline justify-content-center" action="SearchSeller.php" onsubmit="return checkSearch()" method="get">
        <div class="btn-group mt-2">
<!--            <select class="custom-select " style="color: red;border-color: red" id="inputGroupSelect01" onchange="switchShow()">-->
            <select class="custom-select " style="color: red;border-color: red" id="inputGroupSelect01" onchange="">
                    <option selected >ค้นหาด้วย ชื่อร้านค้า</option>
                    <option value="1" >ค้นหาด้วย ชื่ออาหาร</option>
            </select>
<!--            <select class="custom-select ml-2" style="color: red;border-color: red" id="inputGroupSelect02" hidden>-->
<!--                <option selected>เมนู ทั้งหมด</option>-->
<!--                <option value="1">เมนู อาหาร</option>-->
<!--                <option value="2">เมนู เครื่องดื่ม</option>-->
<!--                <option value="3">เมนู ขนม</option>-->
<!--            </select>-->
            <div class="ml-2">
                <input class="form-control" id="SearchID" placeholder="คำที่ใช้ค้นหา" name="SearchID" style="color: red;border-color: red">
                <button type="submit" class="btn btn-outline-danger ">ค้นหา</button>
            </div>
            <a href="check.php?s=2&pt=อาหาร" class="btn btn-outline-warning ml-5">เมนู อาหาร</a>
            <a href="check.php?s=2&pt=เครื่องดื่ม" class="btn btn-outline-warning ml-2">เมนู เครื่องดื่ม</a>
            <a href="check.php?s=2&pt=ขนม" class="btn btn-outline-warning ml-2">เมนู ขนม</a>
        </div>
    </form>

<ul class="list-inline">
<?php
//echo $result->num_rows;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
?>
    <li class="list-inline-item">
            <div class="card border-danger ml-5 mt-3" style="max-width: 20rem;">
                <!--    <div class="card-header bg-transparent border-danger">Header</div>-->
                <div class="card-body">
                    <img class="card-img-top" height="155px" width="255px"
                         src="<?php echo $row["seller_img"] ?>"
                         alt="Card image cap">
                    <h5 class="card-title text-danger"><?php echo $row["seller_name"] ?></h5>
                    <p class="card-text">
                        <?php
                        $result3 = $conn->getStar($row["seller_id"]);
                        $sum = 0;

                        if ($result3->num_rows > 0) {
                            $n = 0;
                            while($row3 = $result3->fetch_assoc()) {
                                $sum = $sum+$row3["reviews_start"];
                                $n++;
                            }
                        }
                        $stra = ($sum/$n)*2;
                        for($i= 1 ;$i<=10;$i++) {
                            if($stra >= $i) {
                                if ($i % 2 != 0 && $i == floor($stra)) {
                                    echo '<i class="fas fa-star-half-alt" style="font-size: 20px;color: gold"></i>';
                                } else if($i%2==0){
                                    echo '<i class="fas fa-star" style="font-size: 20px;color: gold"></i>';
                                }
                            }else if($i%2==0 && $i-$stra != 1){
                                echo '<i class="far fa-star" style="font-size: 20px;color: gold"></i>';
                            }
                        }
                        ?>
                        <a class="font-weight-light" style="font-size: small"><?php  echo "  ".($sum/$n)."/5"; ?></a>
                        <?php
                        $result2 = $conn->getType($row["seller_id"]);
                        ?>
                        <br>ประเภท :
                        <?php
                        if ($result2->num_rows > 0) {
                            $i = 1;
                            // output data of each row
                            while($row2 = $result2->fetch_assoc()) {
                                if( $i != 1){
                                    echo " , ";
                                }
                                echo $row2["product_type"];
                                $i++;
                            }}
                        ?>
                        <br>
                        เปิด <?php echo $row["seller_time"]?><br>
                        ที่อยู่ :<br>
                        <?php echo $row["seller_address"]?>
                    </p>
                    <button type="button" class="btn btn-outline-warning  float-right">ดูรายการอาหาร</button>
                </div>
            </div>
    </li>
<?php
        }
    } else {
        echo "0 results";
    }
?>
</ul>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    function switchShow() {
        let x = document.getElementById("inputGroupSelect01");
        let y = document.getElementById("inputGroupSelect02");
        if(x.options[x.selectedIndex].value == 1){
            y.hidden = false;
        }
        else{
            y.hidden = true;
        }
    }
    function checkSearch() {
        let x = document.getElementById("SearchID");
        if(x.value == ""){
            window.alert('กรุณาใส่ข้อความที่ต้องการค้นหา')
            return false
        }
        else{
            return true
        }
    }
</script>
</body>
</html>

