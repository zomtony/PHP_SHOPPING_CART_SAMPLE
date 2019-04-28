

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/createConnection.php'); //import database connection     
    session_start();
    $myconn = new createConnection(); //create new database connected
    $conn = $myconn->connect();
    $sql = "SELECT * FROM Products";
    $totalIteam = 0;
    $totalCost = 0;
    asort($_COOKIE);

    echo "<div  class='postionCenter'><h1>Shopping Cart</h1></div>";
    echo "<form class='form-signin' action='ShoppingCart.php' method='POST' >
            <div class='row'>
            <div class='col-sm-2'>
            </div>
                <div class='col-sm-9'>
                    <div class='row'>
                        <div class='col-xs-2 form-group'>
                            Quantity
                        </div>
                        <div class='col-xs-4'>Product Name</div>
                        <div class='col-xs-4'>Price</div>                                                       
                        <hr>   
                    </div>
                </div>
            </div>
            <div  class='row'>
                <div class='col-sm-2'>
                </div>
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
                                <label for='" . $key . "'>Quantity: " . $val . "</label>
                            </div>
                            <div class='col-xs-4'>" . $row['proName'] . "</div>
                            <div class='col-xs-4'>" . '$' . $row['price'] . "</div>                                                       
                            <hr>   
                        </div>";
                    }
                 
                }
        if($totalIteam != 0){
            echo    "</div>                                
                </div>";
        }
        echo "<div class='row'>
                <div class='col-xs-4'>
                </div>
                <div class='col-xs-4'>
                    <span class='spanFontType'>
                        Subtotal (" . $totalIteam . " items):
                    </span>
                    <span class='spanFontType subtotalNum'>$" . $totalCost . "</span>
                    <button type='button' class='btn btn-primary'  type='submit'>Ali Pay</button>
                </div>
            </div>  
            </form>";
?>