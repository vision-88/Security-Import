<?php

//fetch.php
include "koneksi.php";
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$columns = array('id', 'site', 'tgl', 'event_type', 'event_details',
'check_point', 'tour_id', 'guard_name', 'img', 'audio', 'video');

$tsql = "SELECT * FROM tblsecurity WHERE ";

if($_POST["is_date_search"] == "yes")
{
 $tsql .= 'tgl BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $tsql .= '
  (site LIKE "%'.$_POST["search"]["value"].'%" 
  OR event_type LIKE "%'.$_POST["search"]["value"].'%" 
  OR event_details LIKE "%'.$_POST["search"]["value"].'%" 
  OR check_point LIKE "%'.$_POST["search"]["value"].'%")
  OR tour_id LIKE "%'.$_POST["search"]["value"].'%")
  OR guard_name LIKE "%'.$_POST["search"]["value"].'%")
  OR img LIKE "%'.$_POST["search"]["value"].'%")
  OR audio LIKE "%'.$_POST["search"]["value"].'%")
  OR video LIKE "%'.$_POST["search"]["value"].'%")
 ';
}

if(isset($_POST["order"]))
{
 $tsql .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $tsql .= 'ORDER BY id DESC ';
}

$tsql = '';

if($_POST["length"] != -1)
{
 $tsql = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = sqlsrv_num_rows(sqlsrv_query($conn, $tsql));

$result = sqlsrv_query($conn, $tsql . $tsql1);

$data = array();

while($row = sqlsrv_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["id"];
 $sub_array[] = $row["site"];
 $sub_array[] = $row["tfl"];
 $sub_array[] = $row["event_type"];
 $sub_array[] = $row["event_details"];
 $sub_array[] = $row["check_point"];
 $sub_array[] = $row["tour_id"];
 $sub_array[] = $row["guard_name"];
 $sub_array[] = $row["img"];
 $sub_array[] = $row["audio"];
 $sub_array[] = $row["video"];
 $data[] = $sub_array;
}

function get_all_data($conn)
{
 $tsql = "SELECT * FROM tblsecurity";
 $result = sqlsrv_query($conn, $tsql);
 return sqlsrv_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
