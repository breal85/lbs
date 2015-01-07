<?php
require("includes/connection.php");

//Get parameter from URL
$drug_name = $_GET["drug_name"];
//$c_lat = $_GET["lat"];
//$c_lng = $_GET["lng"];

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Select all the rows that have a specific product search criteria in the product table table
$query = "SELECT pharmacy.Shop_Name, pharmacy.Latitude,pharmacy.Longitude,drug.Product_Name,drug.Product_Price, drugcat.Category_Name FROM drugcat, pharmacy, drug WHERE pharmacy.Shop_ID = drug.Shop_Shop_ID AND drug.Product_Name = '$drug_name' AND drug.ProductCategory_Category_ID = drugcat.Category_ID";

$result = mysql_query($query);

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml"); 

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){  
  // ADD TO XML DOCUMENT NODE  
  $node = $dom->createElement("marker");  
  $newnode = $parnode->appendChild($node);   
  $newnode->setAttribute("shop_name",$row['Shop_Name']);
  $newnode->setAttribute("product_name", $row['Product_Name']);  
  $newnode->setAttribute("product_price", $row['Product_Price']);  
  $newnode->setAttribute("category_name", $row['Category_Name']);
  $newnode->setAttribute("latitude", $row['Latitude']);
  $newnode->setAttribute("longitude", $row['Longitude']);
} 

echo $dom->saveXML();


?>