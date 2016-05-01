<?php
/**
 * API Version D1(V 0.1)
 * 根据设备IMEI获取可用版本
 */
$imei = isset($_GET['IMEI'])?$_GET['IMEI']:null;
if ($imei == null | $imei == ""){
	$jsonobj = array("minVer" => 1,"ERR" => 1,"ERRinfo" => 'arg error');
	echo $str=json_encode($jsonobj);
	exit;
}
$table = "Version";
require "./connect.php";
$Itemarray = array();
$sql = "SELECT * FROM device";//获取设备IMEI对应的更新权限
$stmt = $dbh->prepare($sql);
$stmt->execute(array());
$auth=0;//默认值
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($imei == $row['IMEI']) {
        $auth = $row['Auth'];
        break;
    }
}
$sql = "SELECT * FROM Version";
$stmt = $dbh->prepare($sql);
$stmt->execute(array());
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($auth >= $row['Auth']) {
        $ltem = array("Name" => $row['Name'], "Version" => $row['Ver'], "Note" => $row['Note']);
        $Itemarray[] = $ltem;
    }
}
if ($Itemarray == null){
	$jsonobj = array("minVer" => 1,"ERR" => 0,"VersionList" => null);
}else{
	$jsonobj = array("minVer" => 1,"ERR" => 0,"VersionList" => $Itemarray);
}
echo $str=json_encode($jsonobj);
?>