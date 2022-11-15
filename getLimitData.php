<?php
include 'koneksi.php';
$page = $_POST['page'];
$limit = $_POST['limit'];
$offset = ($page-1)*$limit;
$sql = sqlsrv_connect($conn, "SELECT * FROM tblsecurity LIMIT $limit OFFSET $offset");
$result = array();
while($fetchData=sqlsrv_fetch_array($sql)){
    $result[] = $fetchData;
}
echo json_encode($result);
?>