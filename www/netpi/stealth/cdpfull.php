<?PHP
    if (isset($_GET['function']))
    {
         $function = $_GET['function'];
		 if($function == "lldp")
		 {
		 	exec('lxterminal -e /opt/netpi/scripts/lldpdetails.sh');
		 }
		 elseif($function == "cdp")
		 {
		 	exec('lxterminal -e /opt/netpi/scripts/cdpdetails.sh');
		 }
		 elseif($function == "draw")
		 {
		 	exec('dia &');
		 }
		 elseif($function == "wlanfix")
		 {
		 	exec('lxterminal -e /opt/netpi/scripts/netwake.sh');
		 }
		 elseif($function == "notepad")
		 {
		 	exec('/opt/netpi/scripts/notepad.sh');
		 }
		 elseif($function == "int")
		 {
		 	exec('/opt/netpi/scripts/gnet-if.sh');
		 }
		 elseif($function == "pentest")
		 {
		 	exec('/opt/netpi/scripts/netmode.sh pentest');
			echo "<meta http-equiv='refresh' content='3; URL=http://127.0.0.2/netpi/pentest' />";
		 }
		 elseif($function == "active")
		 {
			echo "<meta http-equiv='refresh' content='3; URL=http://127.0.0.2/netpi/active' />";
			exec('lxterminal -e /opt/netpi/scripts/netmode.sh active &');
		 }
		 elseif($function == "power")
		 {
		 	exec('sudo init 0');
		 }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>NetPi - Analyze - Stealth</title>
<style type="text/css">
<!--
body {
	background-color: #3b5997;
}
-->
</style></head>

<body>
<div align="center"><a href="index.php"><img src="img/header.png" /></a>
  <br />
<?PHP
	$path = "/var/log/netpi/cdp"; 

$latest_ctime = 0;
$latest_filename = '';    

$d = dir($path);
while (false !== ($entry = $d->read())) {
  $filepath = "{$path}/{$entry}";
  // could do also other checks than just checking whether the entry is a file
  if (is_file($filepath) && filectime($filepath) > $latest_ctime) {
    $latest_ctime = filectime($filepath);
    $latest_filename = $entry;
  }
}

$readfile = "/var/log/netpi/cdp/" . $latest_filename;
$file = $readfile;

$result = fopen($file, "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($result)) {
  echo fgets($result) . "<br>";
}
fclose($myfile);


?>

  <br />
  <br />
  <a href="http://127.0.0.2/netpi/stealth/cdpresult.php"><img src="img/back.png" border="0" /></a><br />

  <a href="http://127.0.0.2/netpi/stealth/index.php?function=pentest"><img src="img/mode.png" border="0" /></a><a href="http://127.0.0.2/netpi/stealth/index.php?function=active"><img src="img/active.png" border="0" /></a><a href="http://127.0.0.2/netpi/stealth/index.php?function=power"><img src="img/power.png" border="0" /></a></div>
</body>
</html>
<!---
"There is only one god, and his name is Death. And there is only one thing we say to Death: 'Not today'."
-->