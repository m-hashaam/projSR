<?php
session_start(); 
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("SweetReferrals")
							 ->setLastModifiedBy("SweetReferrals")
							 ->setTitle("SweetReferrals Export")
							 ->setSubject("SweetReferrals Export")
							 ->setDescription("This excel file was exported from SweetReferrals online dashboard")
							 ->setKeywords("office 2007")
							 ->setCategory("SweetReferrals Exports");

$iidate = $_SESSION['ifbdate'];
$eedate = $_SESSION['efbdate'];
$proid = $_SESSION['CurrentProductID'];
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1', $iidate." - ".$eedate)
            ->setCellValue('A2', 'Country')
            ->setCellValue('B2', 'Local Fans')
            ->setCellValue('C2', 'Percentage of Local Fan Base')
            ->setCellValue('D2', 'Growth')
            ->setCellValue('E2', 'Relative Growth')
            ;
$temp = 3;			
include "../../database/dbfb.php";

$idate = $_SESSION['Realifbdate'];
$edate = $_SESSION['Realefbdate'];
$fbdbid = $_SESSION['fbdbid'];

$query = "SELECT  SUM(`i_likes`) AS ss FROM `insights` WHERE `i_date` = '$edate' AND `p_id` = $fbdbid ";
$stmt = $dbfb->query($query);
if($row = $stmt->fetch_assoc()){
    $totallikes = $row['ss'];
}
else{
    echo "Unable to fetch page data.";
    exit();
}

$temp = 3;			
$result = $dbfb->query("SELECT t1.`i_country` AS cc ,t1.`i_likes` AS newl,t2.`i_likes` AS prevl FROM
                                    (SELECT `p_id`, `i_country`, `i_likes`, `i_date` FROM `insights` WHERE `i_date` = '$edate' AND `p_id` = $fbdbid ORDER BY `i_likes` desc) t1
                                    left join
                                    (SELECT `p_id`, `i_country`, `i_likes`, `i_date` FROM `insights` WHERE `i_date` = '$idate' AND `p_id` = $fbdbid ORDER BY `i_likes` desc) t2
                                    on t1.`i_country` = t2.`i_country`
                                    ORDER BY t1.`i_likes` desc");
while($row = $result->fetch_assoc()) {
	$temp = $temp+1;

    
     $country = $row['cc'];
    $newl = $row['newl'];
    $prevl = $row['prevl'];
    $perc =  $newl/$totallikes;
    $perc *= 100;
    $diff = $newl - $prevl;
    $rela = $diff / $prevl;
    $rela *= 100;
    if($diff > 0){
        $diff2 = "+ ".number_format($diff);
    }
    else if($diff < 0){
        $diff2 = $diff*-1;
        $diff2 = "- ".number_format($diff2);
    }
    else{
        $diff2 = "0.00";
    }
    if($rela > 0){
        $rela2 = "+ ".number_format($rela,2);
    }
    else if($rela < 0){
        $rela2 = $rela*-1;
        $rela2 = "- ".number_format($rela2,2);
    }
    else{
        $rela2 = "0.00";
    }
    
    
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$temp, $country);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$temp, number_format($newl));
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$temp, number_format($perc,2));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$temp, $diff2);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$temp, $rela2);
	
}

$dbfb->close();

foreach(range('A','K') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('FB_FansDistribution');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="FB_FansDistribution.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
