<?php

require_once('misc.php');

class Invent {

public function Insert($number, $category, $s_desc, $l_desc, $value, $old_ctrl, $serial, $model, $quantity, $source)
{
  // return constructor
  $InsertResponseMessage = array(
    'number' => '',
    'category' => ''
  );

  // mandatory items, throw error
  if(empty($category) || empty($s_desc))
    {
      $return = array(
        'number' => '-1',
        'category' => '1'
      );
    return new SoapParam($return, 'InsertResponseMessage');
    }

  //prepare system
  if (empty($l_desc))
    $l_desc = $s_desc;

  if (strlen($s_desc) > 63)
    substr($s_desc, 0, 63);

  if (empty($value)
    $value = 0.01;

  // get transation lock
  $q = ("BEGIN");
  $f = Misc::query($q);

  // get last number use, and locking for non double insert
  $q = ("SELECT number FROM items WHERE category='$category' ORDER BY number DESC LIMIT 1 FOR UPDATE");
  $r = Misc::query($q);
  $number = Misc::db_wsel($r);   

  // the actual insertion
  $q = ("INSERT INTO items(number, category, s_desc, l_desc, value, old_ctrl, serial, model, quantity, source) VALUES ('$number', '$category', '$s_desc', '$l_desc', '$value', '$old_ctrl', '$serial', '$model', '$quantity', '$source')");
  $r = Misc::query($q);
  if (!$r)
    {
      $return = array(
        'number' => '-1',
        'category' => '2'
      );
    return new SoapParam($return, 'InsertResponseMessage');
    }

  // transaction commit
  $q = ("COMMIT");
  $r = Misc::query($q);
  $s = Misc::db_sel($r);

  $return = array(
    'number' => $number,
    'category' => $category
  );

  return new SoapParam($return, 'InsertResponseMessage');
}

public function Get($item_num)
{
  return $item_num;
}

public function Last($category)
{
  return $category;
}

}
?>
