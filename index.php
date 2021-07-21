<?php
$servername = "localhost";
$database = "stockproject";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
//Connected successfully";

//get existing values

//addstock
if(isset($_POST["addstock"])){
  //getting values from input fields
  $select1Var = $_POST["select1"];
  $txt1Var = $_POST["txt1"];
  $txt2Var = $_POST["txt2"];
  $fullPrice = $txt1Var * $txt2Var ;

  //get existing values
  $sql = "SELECT N_Items, A_Price FROM stocktable WHERE product='$select1Var'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $N_Items = $row["N_Items"];
    $A_Price = $row["A_Price"];
  }
} else {
  echo "0 results";
}
$txt1Var = $txt1Var + $N_Items;
$fullPrice = $fullPrice + $A_Price;
//update values

  $sql = "UPDATE stocktable SET N_Items = '$txt1Var',
                                A_Price = '$fullPrice'
                                WHERE product = '$select1Var'";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Stock Added !")</script>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

}
if(isset($_POST["itemsshipped"])){

$txt3Var = $_POST["txt3"];
$txt4Var = $_POST["txt4"];
$select2Var = $_POST["select2"];
$sql = "SELECT Emails FROM stocktable WHERE product='$select2Var'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
  $ExEmail =  $row["Emails"];
}
} else {
echo "0 results";
}
     $pos = strpos($ExEmail,$txt3Var);
         if($pos === false){
           //sellstock
           $sql = "SELECT * FROM stocktable WHERE product='$select2Var'";
           $result = $conn->query($sql);

           if ($result->num_rows > 0) {
           // output data of each row
           while($row = $result->fetch_assoc()) {
             $ExEmail =  $row["Emails"];
             $N_Items1 = $row["N_Items"];
             $A_Price1 = $row["A_Price"];
           }
           } else {
           echo "0 results";
           }
           //calculate price to subtract
           $AvPrice = $A_Price1 / $N_Items1;
           $AvPrice = $txt4Var * $AvPrice;
           $A_Price1 = $A_Price1 - $AvPrice;

           $ExEmail .= $txt3Var;
           $txt4Var = $N_Items1 - $txt4Var;
           $sql = "UPDATE stocktable SET Emails = '$ExEmail',
                                         N_Items = '$txt4Var',
                                         A_Price = '$A_Price1'
                                         WHERE product = '$select2Var'";
         if ($conn->query($sql) === TRUE) {
             echo '<script>alert("items shipped, stock level and values updated !")</script>';
         } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
         }
         }else {
           echo '<script>alert("You Have Bought Before !")</script>';
         }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, input[type=number] , input[type=email]{
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 99%
}

input[type=submit]:hover {
  background-color:blue;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  display: inline-block;
  width: 49%;
}
.display{
  background: lightblue;
  width: 50%;
  margin-top: 20px;
  padding-left: 50px;
  padding-top: 1px;
  padding-bottom: 1px;
  border-radius: 5px;
}
h3{
  font-family:sans-serif;
  text-align: center;
  text-decoration: underline;
  color: blue;
}
br{
  margin-top: 40px;
}
</style>
</head>
<body>

<div class="container">
  <form id="form1 " method="post" action="index.php">
    <h4>Add Stock</h4>
    <label>Select A Product</label>
    <select id="select1" name="select1">
      <option value="PRODUCT1">PRODUCT1</option>
      <option value="PRODUCT2">PRODUCT2</option>
      <option value="PRODUCT3">PRODUCT3</option>
    </select>
    <label>Items Received</label>
    <input type="number" id="txt1" name="txt1" placeholder="7">
    <label >Price Per Item Received</label>
    <input type="number" id="txt2" name="txt2" placeholder="2400.99">
    <input type="submit" value="Add Stock" name="addstock">
  </form>
</div>

<div class="container">
    <form id="form2" method="post" action="index.php">
    <h4>Remove Stock</h4>
    <label>Select A Product</label>
    <select id="select2" name="select2">
      <option value="PRODUCT1">PRODUCT1</option>
      <option value="PRODUCT2">PRODUCT2</option>
      <option value="PRODUCT3">PRODUCT3</option>
    </select>
    <label>Buyer Email address</label>
    <input type="text" id="txt3" name="txt3" placeholder="test@test.com">
    <label >Items Bought</label>
    <input type="text" id="txt4" name="txt4" placeholder="7">
    <input type="submit" value="Items Shipped" name="itemsshipped">
  </form>
</div>
</br>
<div class="display">
  <h4>Stock Levels</h4>
  <?php
  $sql = "SELECT * FROM stocktable";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $av =  $row["A_Price"]  / $row ["N_Items"];

    echo "<p>" . $row["Product"] . "   --------- " . $row["N_Items"] . "   --------- R" . number_format((float)$av, 2, '.', '') . "</p>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
</div>
</body>
</html>
