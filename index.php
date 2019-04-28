<?php
    include($_SERVER['DOCUMENT_ROOT'].'/include/header.php');

    include_once($_SERVER['DOCUMENT_ROOT'].'/createConnection.php'); //import database connection     
    session_start();

    $myconn = new createConnection(); //create new database connected
    $conn = $myconn->connect();
    
    $sql = "SELECT * FROM Products";

    echo "<div  class='postionCenter'><h1>Products List</h1></div>
        <div class='container'>";
   
    foreach ($conn->query($sql) as $row) {
        echo "<div class='row'>

            <div class='col-xs-2 MinSize'><img class='proPicListSize rounded' src='" . $row['proPic'] . "' alt='pic'></div>
            <div class='col-xs-4 listFontSize listStringPosition'>" . $row['proName'] . "</div>
            <div class='col-xs-2 listFontSize listStringPosition'>" . '$' . $row['price'] . "</div>
            
            <div class='col-xs-2 form-group'>
                <label for='" . $row['id'] . "'>Quantity:</label>
                <select class='form-control' id='" . $row['id'] . "'>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>

                <button type='button' class='btn btn-primary buttonPosition' onclick='addProduct(" . $row['id'] . ")'>Add to Cart</button>
            </div>
        </div>
        <hr>";
    }

    include($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
?>

<div id="display_myCart"></div>