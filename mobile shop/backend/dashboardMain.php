<?php
    include 'configuration.php';
    include 'dashboard.php';
    
    $sql_count = "SELECT * from tbl_count";

    $result = mysqli_query($conn,$sql_count);
    
    if (mysqli_num_rows($result) > 0) {
        $i = 0;
        while($row = mysqli_fetch_assoc($result)) {
          $count[$i] = Array(
              'count'=>$row['count_id'],
              'type'=>$row['count_type'],
              'no'=>$row['count_no']
            );
            $i++;
        }
      }


 mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>
    <div id="main-content">
        <div class="title">
            Welcome <?=$_SESSION["admin"]?>
        </div>
        
        <div class="complete-count-holder">
            <?php foreach($count as $i => $c){?>
                <div class="count-holder">
                    <span class="count-header"><?=$c['type']?></span>
                    <div class="count-number-holder"><?=$c['no']?></div>
                </div>
            <?php }?>
        </div>
        <div id="chart-container">
            <canvas id="graphCanvas"></canvas>
        </div>
    </div>
        
</body>
<style>
    .title{
        font-size: 80px;
        position: relative;
        margin-left: auto;
        margin-right: auto;
        text-decoration: underline;
        color: black;
    }


    #main-content{
        
        color: whitesmoke;
        display: flex;
        flex-direction: column;
    }



    #dashboardMain{
        background-color: lavender;
    }
</style>
<script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/Chart.min.js"></script>
    <script type="text/javascript" src="../js/script2.js"></script>
<script>
      $(document).ready(function () {
            showGraph();
        });
</script>   
</html>