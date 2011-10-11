<?php

include_once('db.php');

class Misc {

function db_query($q)
{
  $db = DB::db_connect(FALSE);
  $xq = $db->query($q);
  return $xq;
}

function db_start()
{
  return DB::db_connect(TRUE);
}

function db_squery($db, $q)
{
  return $db->query($q);
}

function db_close($db)
{
  return $db->close();
}

function db_row($q)
{
  return $q->fetch_row();
  $q->close();
}


function db_wrow($q)
{
  return $q->fetch_row();
}

function db_wsel($q, $pos = 0)
{
  $t = $q->fetch_row();
  return $t[$pos];
}

function db_sel($q, $pos = 0)
{
  $t = $q->fetch_row();
  $q->close();
  return $t[$pos];
}

}
?>
