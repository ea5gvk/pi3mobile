
<head>
<style type="text/css">
.auto-style2 {
	text-align: center;
}
.auto-style3 {
	text-align: right;
}
</style>
</head>
<html>
<meta name="viewport" content="width=device-width,"></html>


<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';          // MMDVMDash Config
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';        // MMDVMDash Tools
include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';    // MMDVMDash Functions
include_once $_SERVER['DOCUMENT_ROOT'].'/config/language.php';	      // Translation Code
$page = $_SERVER['PHP_SELF']; $sec = "0.5"; header("Refresh: $sec; url=$page"); 
?>
<body bgcolor="#000000" text="#FFFFFF">

  <table>
  
	  <tr>
		  <td style="width: 199px" class="auto-style3"><strong>RX</strong></td>
		  <td bgcolor="#008000"><?php echo getMHZ(getConfigItem("Info", "RXFrequency", $mmdvmconfigs)); ?></td>
		  <td style="width: 43px" class="auto-style3"><strong>TX</strong></td>
		  <td bgcolor="#FF0000"><?php echo getMHZ(getConfigItem("Info", "TXFrequency", $mmdvmconfigs)); ?></td>
		  <td> </td>
	  </tr>
  </table>

</table>
 
  <hr>
  <table style="width: 648px">
	  <tr>
      <th style="height: 27px" class="auto-style2"><a class="tooltip" ><?php echo $lang['mode'];?>
      <th style="height: 27px; width: 71px;" class="auto-style2"><a class="tooltip" ><?php echo $lang['callsign'];?>
      <th style="height: 27px" class="auto-style2"><a class="tooltip" ><?php echo $lang['target'];?>
      <th style="height: 27px" class="auto-style2"><a class="tooltip" ><?php echo $lang['src'];?>
      <th style="height: 27px" class="auto-style2"><a class="tooltip" ><?php echo $lang['dur'];?>
      <th style="height: 27px" class="auto-style2"><a class="tooltip" ><?php echo $lang['loss'];?>
      <th style="height: 27px" class="auto-style2"><a class="tooltip" ><?php echo $lang['ber'];?>
      <th style="height: 27px; width: 155px;" class="auto-style2"><a class="tooltip" ><?php echo $lang['rssi'];?>RSSI<span><b>
	  </tr></form>
	  
	
<?php
$i = 1;
for ($i = 0;  ($i <= 4); $i++) { 
	if (isset($lastHeard[$i])) {
		$listElem = $lastHeard[$i];
		if ( $listElem[2] ) {
		echo"<td align=\"center\">$listElem[1]</td>";
		if (is_numeric($listElem[2]) || strpos($listElem[2], "openSPOT") !== FALSE) {
			echo "<td align=\"center\">$listElem[2]</td>";
		} elseif (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $listElem[2])) {
                        echo "<td align=\"left\">$listElem[2]</td>";
		} else {
			if (strpos($listElem[2],"-") > 0) { $listElem[2] = substr($listElem[2], 0, strpos($listElem[2],"-")); }
			if ( $listElem[3] && $listElem[3] != '    ' ) {
				echo "<td align=\"center\">$listElem[2]</a>/$listElem[3]</td>";
			} else {
				echo "<td align=\"center\">$listElem[2]</a></td>";
			}
		}

		if ( substr($listElem[4], 0, 6) === 'CQCQCQ' ) {
			echo "<td align=\"center\">$listElem[4]</td>";
		} else {
			echo "<td align=\"center\">".str_replace(" ","&nbsp;", $listElem[4])."</td>";
		}


		if ($listElem[5] == "RF"){
			echo "<td style=\"background:#1d1;\">RF</td>";
		}else{
			echo "<td>$listElem[5]</td>";
		}
		if ($listElem[6] == null) {
				echo "<td style=\"background:#f33;\">TX</td><td></td><td></td>";
			} else if ($listElem[6] == "SMS") {
				echo "<td style=\"background:#1d1;\">SMS</td><td></td><td></td>";
			} else {
			echo "<td>$listElem[6]</td>";

			// Colour the Loss Field
			if (floatval($listElem[7]) < 1) { echo "<td>$listElem[7]</td>"; }
			elseif (floatval($listElem[7]) == 1) { echo "<td style=\"background:#1d1;\">$listElem[7]</td>"; }
			elseif (floatval($listElem[7]) > 1 && floatval($listElem[7]) <= 3) { echo "<td style=\"background:#fa0;\">$listElem[7]</td>"; }
			else { echo "<td style=\"background:#f33;\">$listElem[7]</td>"; }

			// Colour the BER Field
			if (floatval($listElem[8]) == 0) { echo "<td align=\"center\">$listElem[8]</td>"; }
			elseif (floatval($listElem[8]) >= 0.0 && floatval($listElem[8]) <= 1.9) { echo "<td style=\"background:#1d1;\">$listElem[8]</td>"; }
			elseif (floatval($listElem[8]) >= 2.0 && floatval($listElem[8]) <= 4.9) { echo "<td style=\"background:#fa0;\">$listElem[8]</td>"; }
			else { echo "<td align=\"center\">;\">$listElem[8]</td>"; }
			
			
			echo"<td align=\"center\">$listElem[9]</td>"; //rssi
		}
		echo"</tr>\n";
		}
	}
}

