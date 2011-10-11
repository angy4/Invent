<?php

$soap = new SoapClient("http://dv.komput.net/test/inv/inv.php", array('location' => "http://dv.komput.net/test/inv/inv.php"));
?>
<html>
<body>
This is <tt>Invent</tt><br>
<br>
Search system, full text on description, search item number, serial or model<br>
<form name="search" method="post" action="">
Query:<input type="text" name="item_num">
<input type="submit" value="Search!" name="search">
</form>
Full text only on long description.
<?php
if (!empty($_POST['type']))
{
  $type = $_POST['type'];
  $item_num = $_POST['item_num'];
  
  $re = $soap->Get($item_num, 1);

  if (!empty($re))
  {
?>
<br><h2>Research returned</h2><br>
<table>
<tr>
<td>Item Number</td>
<td>Category</td>
<td>Short Description</td>
<td>Long Description</td>
<td>Value</td>
<td>Old Control</td>
<td>Serial</td>
<td>Model</td>
<td>Quantity</td>
<td>Source</td>
</tr>
<?php
$n = sizeof($re['number']);
for ($row = 0; $row < $n; $row++)
{
echo '<tr><td>' . $re['number'][$row] . '</td><td>' . $re['category'][$row] . '</td><td>' . $re['s_desc'][$row] . '</td><td>' . $re['l_desc'][$row] . '</td><td>' . $re['value'][$row] . '</td><td>' . $re['old_ctrl'][$row] . '</td><td>' . $re['serial'][$row] . '</td><td>' . $re['model'][$row] . '</td><td>' . $re['quantity'][$row] . '</td><td>' . $re['source'][$row] . '</td></tr>';
}
}
}
?> 
