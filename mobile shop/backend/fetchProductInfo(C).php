<?php
    include "configuration.php";
    
    $sql2 = "SELECT * FROM tbl_descriptions";
    $sql3 = "SELECT * FROM tbl_catagories";

    $cat = mysqli_query($conn, $sql3);

    $all = Array();
    if (mysqli_num_rows($cat) > 0) {
        $i = 0;
        while($row = mysqli_fetch_assoc($cat)) {
            $products = Array();
            $catagories[$i] = Array(
                'cat_id' => $row['cat_id'],
                'cat_name' => $row['cat_name']
            );
            $id = $catagories[$i]['cat_id'];
            $sql = "SELECT * FROM tbl_products WHERE cat_id = '$id'";
            // print_r($catagories);
            //    echo "<br>".$sql;  
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $j = 0;
                while($row = mysqli_fetch_assoc($result)) {
                
                    $products[$j] = Array(
                    'id' => $row['p_id'],
                    'name' => $row['p_name'],
                    'price' => $row['p_price'],
                    'discount' => $row['discount'],
                    'qty' => $row['p_qty'],
                    'img_name' => $row['img_name'],
                    'cat_id' => $row['cat_id']
                        
                );
                    
                     
                // echo '<br />';
                // print_r($products);
                $j++;
                }
            
            } 
            array_push($all,$products);
            
            // $result2 = mysqli_query($conn, $sql2);
            // if (mysqli_num_rows($result2) > 0) {
            //     $k = 0;
            //     while($row = mysqli_fetch_assoc($result2)) {
            //         $pDescriptions[$k] = Array(
            //             'graphics' => $row['graphics'],
            //             'ram' => $row['RAM'],
            //             'storage' => $row['storage'],
            //             'display' => $row['display'],
            //             'color' => $row['color'],
            //             'battery' => $row['battery']
                
            //         ); 
            //     $k++;
            //     }
            // }   

            $i++;
        }
    }

    mysqli_close($conn);

?>