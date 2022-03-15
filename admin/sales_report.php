<?php
    include 'db_connect.php';
?>

<div class="container">
    <div class="bg-white p-3 shadow-sm rounded">
        <h1>Sales Report</h1>
        <button type="button" class="btn btn-outline-primary" onclick="window.print()">Print</button>

        <form class="mt-3" method="GET" action="">
            <input type="hidden" name="page" value="sales_report" />
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="from_date">From</label>
                            <input type="date" class="form-control" id="from_date" name="from_date" value="<?php if(isset($_GET['from_date'])) echo $_GET['from_date']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="to_date">To</label>
                            <input type="date" class="form-control" id="to_date" name="to_date" value="<?php if(isset($_GET['to_date'])) echo $_GET['to_date']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="to_date">&nbsp;</label><br />
                            <button type="submit" class="btn btn-primary">Find</button>
                        </div>
                    </div>
                </div>
            </form>

            <table class="table table-striped mt-3 print_container">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Order #</th>
                        <th scope="col">Name</th>
                        <th scope="col">Item</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total</th>
                        <!-- <th scope="col">Status</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_GET['from_date']) && isset($_GET['to_date'])){
                            $from_date = $_GET['from_date'];
                            $to_date = $_GET['to_date'];

                            $orders = $conn->query("SELECT *,pl.name as itemName FROM order_list ol INNER JOIN product_list pl ON ol.product_id = pl.id INNER JOIN orders o ON ol.order_id = o.id WHERE o.status = 1 AND o.order_date BETWEEN '$from_date' AND '$to_date' ORDER BY o.id desc");
                            $i = 1;
                            while($row=$orders->fetch_assoc()){
                                $id = $row['id'];
                                // $order_list = $conn->query("SELECT *, sum(ol.qty) as totalQty FROM order_list ol WHERE ol.order_id = '$id' INNER JOIN product_list pl ON ol.product_id = pl.id GROUP BY product_list.id");
                                echo '<tr>';
                                echo '<th scope="row">'.$i++.'</th>';
                                echo '<td>'.date_format(date_create($row['order_date']), "F j, Y, g:i a").'</td>';
                                echo '<td>'.$row['order_id'].'</td>';
                                echo '<td>'.$row['name'].'</td>';
                                echo '<td>'.$row['itemName'].'</td>';
                                echo '<td>'.$row['price'].'</td>';
                                echo '<td>'.$row['qty'].'</td>';
                                echo '<td>'.number_format($row['qty'] * $row['price'],2).'</td>';
                                // if($row['status'] == 1){
                                //     echo '<td><span class="badge badge-success">Confirmed</span></td>';
                                // }else if($row['status'] == 2){
                                //     echo '<td><span class="badge badge-danger">Cancelled</span></td>';
                                // }else{
                                //     echo '<td><span class="badge badge-secondary">For Verification</span></td>';
                                // }
                                echo '</tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
    </div>
</div>