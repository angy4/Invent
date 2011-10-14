<?php

require_once('misc.php');

class Invent {

public function Insert($category, $number, $uid, $s_desc, $l_desc, $value, $old_ctrl, $serial, $model, $quantity, $source)
{

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

  if (empty($value))
    $value = 0.01;

  // get transation lock
  $db = Misc::db_start();
  $q = ("BEGIN");
  $f = Misc::db_squery($db, $q);

  // the actual insertion
  $q = ("INSERT INTO items(category, old_number, uid, s_desc, l_desc, value, old_ctrl, serial, model, quantity, source) VALUES ('$category', '$number', '$uid', '$s_desc', '$l_desc', '$value', '$old_ctrl', '$serial', '$model', '$quantity', '$source')");
  $r = Misc::db_squery($db, $q);
  if (!$r)
    {
      $return = array(
        'number' => '-1',
        'category' => '2'
      );
    $q = ("ROLLBACK");
    $r = Misc::db_squery($db, $q);
    Misc::db_close($db);
    return new SoapParam($return, 'InsertResponseMessage');
    }

  // Get insert id for x_ref and speedsearch
  $q = ("SELECT LAST_INSERT_ID()");
  $r = Misc::db_squery($db, $q);
  $x_ref = Misc::db_wsel($r);

  // speedsearch populate
  $q = ("INSERT INTO speedsearch(x_ref, md5) values('$x_ref', MD5('$s_desc')");
  $r = Misc::db_squery($db, $q);
  
  // if OK, increment user
  $q = ("INSERT INTO users(uid, count) VALUES('$uid', 1) ON DUPLICATE KEY UPDATE count=count+1")
  $r = Misc::db_squery($db, $q);

  // transaction commit
  $q = ("COMMIT");
  $r = Misc::db_squery($db, $q);
  Misc::db_close($db);

  $return = array(
    'number' => $number,
    'category' => $category
  );

  return new SoapParam($return, 'InsertResponseMessage');
}

public function Get($item_num, $full_text)
{
    $return = array(
      'number' => array(),
      'category' => array(),
      's_desc' => array(),
      'l_desc' => array(),
      'value' => array(),
      'old_ctrl' => array(),
      'serial' => array(),
      'quantity' => array(),
      'source' => array()
    );

    $q = ("SELECT number, category, s_desc, l_desc, value, old_ctrl, serial, model, quantity, source FROM items WHERE l_desc LIKE '%$item_num%' OR number='$item_num' OR serial='$item_num' OR model='$item_num'");
    $r = Misc::db_query($q);
    $i = 0;
    while ($s = mysqli_fetch_row($r)) {
      $return['number'][$i] = $s[0];
      $return['category'][$i] = $s[1];
      $return['s_desc'][$i] = $s[2];
      $return['l_desc'][$i] = $s[3];
      $return['value'][$i] = $s[4];
      $return['old_ctrl'][$i] = $s[5];
      $return['serial'][$i] = $s[6];
      $return['quantity'][$i] = $s[7];
      $return['source'][$i] = $s[8];
      $i++;
    }
    return new SoapParam($return, 'ItemList');

}

public function Last($category)
{

}

}
?>
