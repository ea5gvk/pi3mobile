
<head>
<style type="text/css">
.auto-style1 {
	text-align: right;
}
.auto-style2 {
	text-align: center;
}
</style>
</head>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';          // MMDVMDash Config
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';        // MMDVMDash Tools
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';    // MMDVMDash Functions
include_once $_SERVER['DOCUMENT_ROOT'].'/config/language.php';	      // Translation Code

require_once($_SERVER['DOCUMENT_ROOT'].'/config/ircddblocal.php');
$page = $_SERVER['PHP_SELF']; $sec = "1"; header("Refresh: $sec; url=$page"); 
?>

<body bgcolor="#000000" text="#FFFFFF" style="width: 486px; height: 160px">
 
 <table>
	  <tr>
		  <td style="width: 116px" class="auto-style1"><strong>RX</strong></td>
		  <td bgcolor="#008000" class="auto-style2"><?php echo getMHZ(getConfigItem("Info", "RXFrequency", $mmdvmconfigs)); ?></td>
		  <td style="width: 43px" class="auto-style1"><strong>TX</strong></td>
		  <td bgcolor="#FF0000" class="auto-style2"><?php echo getMHZ(getConfigItem("Info", "TXFrequency", $mmdvmconfigs)); ?></td>
		  <td><?php echo"<td>$listElem[9]</td>"; //rssi ?> </td>
	  </tr>
  </table>

 
	  <table style="width: 366px; height: 48px;">
	  <tr>
      <th class="auto-style2" style="width: 139px"><a class="tooltip" ><?php echo $lang['mode'];?>
      <th style="width: 123px" class="auto-style2"><a class="tooltip" ><?php echo $lang['callsign'];?><br><?php echo $lang['target'];?></br>
      <th class="auto-style1"><a class="tooltip" ><?php echo $lang['ber'];?>
	  </tr></form>
<hr style="width: 550px">

<table style="width: 386px">

<?php
$i = 1;
for ($i = 0;  ($i <= 1); $i++) { 
	if (isset($lastHeard[$i])) {
		$listElem = $lastHeard[$i];
		if ( $listElem[2] )
		
 {
		echo"<td align=\"center\">$listElem[1]</td>";
		
		if (is_numeric($listElem[2]) || strpos($listElem[2], "openSPOT") !== TRUE) {
			echo "<td align=\"center\">$listElem[2]</td>";
		} else if (!preg_match('/[A-Za-z].*[1-1]|[1-1].*[A-Za-z]/', $listElem[2])) {
                        echo "<td align=\"left\">$listElem[2]</td>";
                        
		} else {
		?>
		<td style="height: 27px; width: 141px;"><tr><tr><tr>
	<th style="width: 141px; height: 27px;"><?php
			if (strpos($listElem[2],"-") > 0) { $listElem[2] = substr($listElem[2], 0, strpos($listElem[2],"-")); }
			if ( $listElem[3] && $listElem[3] != '    ' ) {
				echo "<td align=\"center\">$listElem[2]</a>/$listElem[3]</td>";
			} else {
				echo "<td align=\"center\">$listElem[2]</a></td>";
			}
		}
		?><td style="height: 27px"><tr>
		<th style="height: 27px; width: 141px;" class="auto-style2"><?php
		if ( substr($listElem[4], 0, 6) === 'CQCQCQ' ) {
			echo "<td align=\"center\">$listElem[4]</td>";
		} else {
			echo "<td align=\"center\">".str_replace(" ","&nbsp;", $listElem[4])."</td>";
		}
			?><?php
			if ($listElem[6] == null) {
				echo "<td style=\"background:#f33;\">TX</td><td></td><td></td>";
			} else if ($listElem[6] == "SMS") {
				echo "<td style=\"background:#1d1;\">SMS</td><td></td><td></td>";
			} else {
			echo "<td>$listElem[6]</td>";
			?>
						<td class="auto-style2"><?php
			// Colour the BER Field
			if (floatval($listElem[8]) == 0) { echo "<td align=\"center\">$listElem[8]</td>"; }
			elseif (floatval($listElem[8]) >= 0.0 && floatval($listElem[8]) <= 1.9) { echo "<td style=\"background:#1d1;\">$listElem[8]</td>"; }
			elseif (floatval($listElem[8]) >= 2.0 && floatval($listElem[8]) <= 4.9) { echo "<td style=\"background:#fa0;\">$listElem[8]</td>"; }
			else { echo "<td align=\"center\">;\">$listElem[8]</td>"; }
			
			?>			
			<?php
		}
		echo"</tr>\n";
		}
	}
}
?></table>