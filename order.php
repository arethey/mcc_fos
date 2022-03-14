<?php 
    if(!isset($_SESSION['login_user_id'])){
        header("location: index.php?page=home");
    }else{
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $get = $conn->query("SELECT * from order_list ol INNER JOIN product_list pl ON pl.id = ol.product_id WHERE ol.order_id = ".$_GET["id"]);
        }else{
            header("location: index.php?page=account");
        }
    }
 ?>

<header class="masthead">
     <div class="container h-100">
         <div class="row h-100 d-flex align-items-center justify-content-center text-center">
             <div class="col-lg-10 align-self-end mb-4 page-title">
                 <h3 class="text-white">Order #<?php echo $_GET["id"] ?></h3>
                 <hr class="divider my-4" />
             </div>
         </div>
     </div>
 </header>

 <div class="container mt-5">
    <table class="table table-bordered;">    
    <thead>
    <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>qty</th>
        <th>Total</th>
    </tr>
</thead>
    <tbody>
<?php 
//$total = 0;
$i = 1;
while($row= $get->fetch_assoc()):
?>
    <tr>
        <td><?php echo $i++?></td>
        <td><?php echo $row['name']?></td>  
        <td><?php echo $row['price']?></td>
        <td><?php echo $row['qty']?></td>
        <td><?php echo number_format($row['qty'] * $row['price'])?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>    
 <div>