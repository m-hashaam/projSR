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
            ->setCellValue('A2', 'Name')
            ->setCellValue('B2', 'Total Followers')
            ->setCellValue('C2', 'Total Change in Followers')
            ->setCellValue('D2', 'Relative Change in Followers')
            ->setCellValue('E2', 'Number of Interaction per 1000 Followers')
            ;
$temp = 3;			
include "../../database/dbfb.php";

$idate = $_SESSION['Realifbdate'];
$edate = $_SESSION['Realefbdate'];
$fbdbid = $_SESSION['fbid'];

$query = "SELECT `p_id`, `p_fbid`,`p_profile`, `p_about`, `p_description`, `p_name`, `p_link` FROM `page` WHERE `p_fbid` = $fbdbid";
//echo "</br>Query is :".$query." </br>";
$stmt = $dbfb->query($query);
if($row = $stmt->fetch_assoc()){
    $fbname = $row['p_name'];
    $fbdbid = $row['p_id'];
    $fbid = $row['p_fbid'];
    $fbpic = $row['p_profile'];
}
else{
    echo $query;
    echo "Unable to fetch page data.";
    exit();
}
    
$query = "SELECT  SUM(`i_likes`) AS likes FROM `insights` WHERE `i_date` = '$edate' AND `p_id` = $fbdbid";
$stmt = $dbfb->query($query);
if($row = $stmt->fetch_assoc()){
    $newlikes = $row['likes'];
}
else{
    echo $query;
    echo "Unable to fetch page data.";
    exit();
}

$query = "SELECT  SUM(`i_likes`) AS likes FROM `insights` WHERE `i_date` = '$idate' AND `p_id` = $fbdbid";
$stmt = $dbfb->query($query);
if($row = $stmt->fetch_assoc()){
    $prevlikes = $row['likes'];
}
else{
    echo $query;
    echo "Unable to fetch page data.";
    exit();
}
$changeinlikes = $newlikes - $prevlikes;
if($changeinlikes > 0){
    $changeinlikes = "+ ".$changeinlikes;
}
else if($changeinlikes < 0){
    $changeinlikes*=-1;
    $changeinlikes = "- ".$changeinlikes;
}
$relativelikes = $newlikes - $prevlikes;
$relativelikes = $relativelikes / $prevlikes;
$relativelikes = $relativelikes * 100;
if($relativelikes > 0){
    $relativelikes = "+ ".number_format($relativelikes,2);
}
else if($relativelikes < 0){
    $relativelikes*=-1;
    $relativelikes = "- ".number_format($relativelikes,2);
}
$query = "SELECT SUM(`post_shares`) AS shares, SUM(`post_likes`) As likes, SUM(`post_comments`) AS comments, SUM(`post_haha`) AS hahas, SUM(`post_love`) AS loves, SUM(`post_wow`) AS wows FROM `post` WHERE `post_createdon` >= '$iidate' AND `post_createdon` <= '$eedate' AND `p_id` = $fbdbid";
$stmt = $dbfb->query($query);
while($row = $stmt->fetch_assoc()){
    $totalinteractions = $row['comments']+$row['likes']+$row['shares']+$row['hahas']+$row['loves']+$row['wows'];
}
$intPerThouFoll = $totalinteractions / $newlikes;
$intPerThouFoll *=1000;
    
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3', $fbname)
            ->setCellValue('B3', $newlikes)
            ->setCellValue('C3', $changeinlikes)
            ->setCellValue('D3', $relativelikes)
            ->setCellValue('E3', number_format($intPerThouFoll,2))
            ;


$dbfb->close();

foreach(range('A','K') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('FB_statistics');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="FB_statistics.xlsx"');
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
