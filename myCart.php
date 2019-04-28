

<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/createConnection.php'); //import database connection     
    session_start();
    $myconn = new createConnection(); //create new database connected
    $conn = $myconn->connect();
    $sql = "SELECT * FROM Products";
    $totalIteam = 0;
    $totalCost = 0;
    asort($_COOKIE);

    echo "<div  class='postionCenter'><h1>Shopping List</h1></div>";
    echo "<form class='form-signin' action='ShoppingCart.php' method='POST' >
            <div  class='row'>
                <div class='col-sm-9'>";
                foreach ($_COOKIE as $key=>$val)
                {
                    if(substr($key, 0, 4) == "cart"){
                        $id = substr($key, 4);

                        $sql = $conn -> prepare( "SELECT * FROM Products WHERE id = $id Limit 1" );
                        $sql -> execute();
                        $row = $sql -> fetch();

                        $totalIteam += $val;
                        $totalCost += $val * $row['price'];
                    echo "<div class='row'>
                            <div class='col-xs-2 form-group'>
                                <label for='" . $key . "'>Quantity:</label>
                                <input type='number' id='" . $key . "' class='form-control' value='" . $val . "' onchange='changeQuantity(" . $row['id'] . ")'>
                            </div>
                            <div class='col-xs-4 listFontSize listStringPosition'>" . $row['proName'] . "</div>
                            <div class='col-xs-4 listFontSize listStringPosition'>" . '$' . $row['price'] . "</div>     
                            <div class='col-xs-2'>
                                <button type='button' class='btn btn-danger buttonPosition' onclick='removeProduct(" . $row['id'] . ")'>remove</button>
                            </div>                                                     
                            <hr>   
                        </div>";
                    }
                 
                }
        if($totalIteam != 0){
            echo    "</div> 
                    <div class='col-sm-3 postionCenter bkg'>
                        <span class='spanFontType'>
                            Subtotal (" . $totalIteam . " items):
                        </span>
                        <span class='spanFontType subtotalNum'>$" . $totalCost . "</span>
                        <br/>
                        <button type='submit' class='btn btn-primary buttonPosition'>Process to Checkout</button>
                    </div>                  
                </div>";
        }
        echo "</form>";
?>