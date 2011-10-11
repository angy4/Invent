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
 <option id="o1" value='1'>1</option>
 <option id="o2" value="2">2</option>
 <option id="o3" value="3">3</option>
 <option id="o4" value="4">4</option>
 <option id="o5" value="5">5</option>
 <option id="o6" value="6">6</option>
 <option id="o7" value="7">7</option>
 <option id="o8" value="8">8</option>
 <option id="o9" value="9">9</option>
 <option id="o10" value="10">10</option>
 <option id="o11" value="11">11</option>
 <option id="o12" value="12">12</option>
 <option id="o13" value="13">13</option>
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
  $re = $soap->Insert($number, $category, $s_desc, $l_desc, $value, $old_ctrl, $serial, $model, $quantity, $source);
  
  if(!empty($re))
  {
  echo 'Last number entered was ' . $re['number'] . '<br>';
?>
<script type="text/javascript" language="JavaScript">
var obj = document.getElementById("o<?php echo $re['category']; ?>")
obj.selected = true
</script>  
<?php
  }
}
?>
