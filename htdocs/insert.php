<?php

$soap = new SoapClient("http://dv.komput.net/test/inv/inv.php", array('location' => "http://dv.komput.net/test/inv/inv.php"));
?>
<html>
<body>
This is <tt>Invent</tt><br>
<br>
Insert section<br>
<form name="insert" method="post" action="">
Category:<select name="category">
 <option value='1'>1</option>
 <option value="2">2</option>
 <option value="3">3</option>
 <option value="4">4</option>
 <option value="5">5</option>
 <option value="6">6</option>
 <option value="7">7</option>
 <option value="8">8</option>
 <option value="9">9</option>
 <option value="10">10</option>
 <option value="11">11</option>
 <option value="12">12</option>
 <option value="13">13</option>
</select><br>
Short description: <input type="text" name="s_desc" size=64><br>
Long description: <input type="test" name="l_desc" size=100> (if empty will be short description)<br>
Value: <input type="text" name="value"> (if empty will be 0.01)<br>
Old control: <input type="text" name="old_ctrl"><br>
Serial: <input type="text" name="serial"><br>
Model: <input type="text" name="model"><br>
Quantity: <input type="text" name="quantity" value="1"><br>
Source: <input type="text" name="source"><br>
<input type="submit" value="Inventorize" name="invent"><br>
</body>
</html>
<?php
if (!empty($_POST['category']))
{
  $number = '';
  $category = $_POST['category'];
  $s_desc = $_POST['s_desc'];
  $l_desc = $_POST['l_desc'];
  $value = $_POST['value'];
  $old_ctrl = $_POST['old_ctrl'];
  $serial = $_POST['serial'];
  $model = $_POST['model'];
  $quantity = $_POST['quantity'];
  $source = $_POST['source'];
  $soap->Insert($number, $category, $s_desc, $l_desc, $value, $old_ctrl, $serial, $model, $quantity, $source);

echo $_POST['category'], $_POST['s_desc'], $_POST['l_desc'], $_POST['value'], $_POST['old_ctrl'], $_POST['serial'], $_POST['model'], $_POST['quantity'], $_POST['source'];

}
?>
