<?php
$pname = $_SESSION['CurrentProductName'];
$pid = $_SESSION['CurrentProductID'];

$qqq = "SELECT `p_category`,  `p_desc`, `p_picture`,`p_islive` FROM `product` WHERE `p_id` = $pid";
$sss = $db->query($qqq);
if($rrr = $sss->fetch_assoc()){
    $pcat = $rrr['p_category'];
    $pdesc = $rrr['p_desc'];
    $ppic = $rrr['p_picture'];
    $plive = $rrr['p_islive'];
}
else{
   $pcat = "";
   $pdesc = "";
   $ppic = ""; 
   $plive = 0;
}
 
$query = "SELECT `com_id` FROM `compaign` WHERE `p_id` = $pid";
$stmt = $db->query($query);
if($row = $stmt->fetch_assoc()){
    $com = 1;
}
else{
    $com = 0;
}	
        
$footer = '<div class="col-md-6">
        <div id="checklist-div" class="portlet light">
            <h2 class="heading-large">Is this product ready? Here\'s your checklist!</h2>
            <div class="mt-element-list">
                <div class="mt-list-container list-simple ext-1">
                    <ul>
                        <li class="mt-list-item  done ">
                            <div class="left-marginMedium list-icon-container top-marginSmall">
                                                                    <i class="fa fa-check fa-2x font-green"></i>
                                                            </div>
                                                        <div class="list-item-content">
                                <h3 class="checklist-font">
                                    <span class="font-grey-cascade">Added Product Name</span>
                                </h3>
                            <span class="font-sm font-grey-salt">
                                To let us know what its called
                            </span>
                            </div>
                        </li>';
                        
                        if($pcat != "" && $pdesc != "" && $ppic != ""){
                             $footer .= '<li class="mt-list-item done">
                            <div class="left-marginMedium list-icon-container top-marginSmall">
                                                                     <i class="fa fa-check fa-2x font-green"></i>
                                                            </div>
                                                            <div class="list-datetime">
                                   
                                </div>
                                                        <div class="list-item-content">
                                <h3 class="checklist-font">
                                    <span class="font-grey-cascade">Finish Product Profile</span>
                                </h3>
                                <span class="font-sm font-grey-salt">
                                                                 Product information is added.       
                                                                     </span>
                            </div>
                        </li>';
                        }
                        else{
                             $footer .= '<li class="mt-list-item ">
                            <div class="left-marginMedium list-icon-container top-marginSmall">
                                                                     <i class="fa fa-square-o fa-2x font-grey-salt "></i>
                                                            </div>
                                                            <div class="list-datetime">
                                    <button type="button" class="btn green-meadow rounded-4 add-info" onclick="location.href=\'edit.php?id='.$pid.'\'">Add info</button>
                                </div>
                                                        <div class="list-item-content">
                                <h3 class="checklist-font">
                                    <span class="font-grey-cascade">Finish Product Profile</span>
                                </h3>
                                <span class="font-sm font-grey-salt">
                                                                         Missing info is ';
                                                                         if($pcat == ""){
                                                                            $footer.='Catergory. ';
                                                                         }
                                                                         if($pdesc == ""){
                                                                            $footer.='Description. ';
                                                                         }
                                                                         if($ppic == ""){
                                                                            $footer.='Picture. ';
                                                                         }
                                                                         
                                                                         $footer.='
                                                                     </span>
                            </div>
                        </li>';
                        }
                       
                        $footer .= ' <li class="mt-list-item ">
                            <div class="left-marginMedium list-icon-container top-marginSmall">';
                            if($plive == 0 || $plive == "0"){
                                $footer.='<i id="submit-check" class="fa fa-square-o fa-2x font-grey-salt "></i>';
                            }
                            else{
                                $footer.=' <i id="submit-tick" class="fa fa-check fa-2x font-green"></i>';
                            }
                                   
                                    
                                                           $footer.=' </div>
                                                            <div class="list-datetime" id="submit-product-div">';
                                   if($plive == "0" || $plive == 0){
                                        if($pcat != "" && $pdesc != "" && $ppic != ""){
                                        
                                        $footer.=' <button type="button" class="btn green-meadow rounded-4" id="submitProduct" onclick="makeitlive()">';
                                   }
                                   else{
                                        $footer.=' <button type="button" class="btn green-meadow rounded-4" id="submitProduct" disabled="disabled">';
                                   }
                                        $footer.=' Request Live
                                    </button>';
                                   }
                                   $footer.='
                                </div>
                                                        <div class="list-item-content">
                                <h3 class="checklist-font">
                                    <span class="font-grey-cascade">Take Profile Public</span>
                                </h3>
                            <span class="font-sm font-grey-salt">
                                Get your product in-front of our users.
                            </span>
                            </div>
                        </li>';
                        
                       if($com == 1){
                            $footer.=' <li class="mt-list-item ">
                            <div class="left-marginMedium list-icon-container top-marginSmall">
                                                                    <i id="campaign-tick" class="fa fa-check fa-2x font-green "></i>
                                    <i id="campaign-check" class="fa fa-square-o fa-2x font-grey-salt hide"></i>
                                                            </div>
                            <div class="list-datetime">
                                <div class="col-md-12">
                <div class=" center">
           
        </div>
    </div>
                            </div>
                            <div class="list-item-content">
                                <h3 class="checklist-font">
                                    <span class="font-grey-cascade">Setup Campaign</span>
                                </h3>
                            <span class="font-sm font-grey-salt">
                                Setup promotions and explore options
                            </span>
                            </div>
                        </li>';
                       }
                       else{
                        $footer.=' <li class="mt-list-item ">
                            <div class="left-marginMedium list-icon-container top-marginSmall">
                                                                    <i id="campaign-tick" class="fa fa-check fa-2x font-green hide"></i>
                                    <i id="campaign-check" class="fa fa-square-o fa-2x font-grey-salt "></i>
                                                            </div>
                            <div class="list-datetime">
                                <div class="col-md-12">
                <div class=" center">
            <a class="btn rounded-4 engage-button green-meadow"  onclick="location.href=\'compaignbuilder.php\'; ">
                 Get Started
            </a>
        </div>
    </div>
                            </div>
                            <div class="list-item-content">
                                <h3 class="checklist-font">
                                    <span class="font-grey-cascade">Setup Campaign</span>
                                </h3>
                            <span class="font-sm font-grey-salt">
                                Setup promotions and explore options
                            </span>
                            </div>
                        </li>';
                       }
                     $footer.='</ul>
                </div>
            </div>
            <hr>
            <div><h2 class="checklist-font font-grey-mint">After running a campaign you\'ll be able to:</h2></div>
            <div style="padding-left: 5%;">
                <div><h4 class="font-grey-cascade"><i class="fa fa-angle-right font-blue"></i>&nbsp;&nbsp;See product
                                                                                              demand</h4></div>
                <div><h4 class="font-grey-cascade"><i class="fa fa-angle-right font-blue"></i>&nbsp;&nbsp;Receive
                                                                                              written product reviews
                    </h4></div>
                <div><h4 class="font-grey-cascade"><i class="fa fa-angle-right font-blue"></i>&nbsp;&nbsp;Drive Sales
                    </h4></div>
            </div>
        </div>
 </div>';

echo $footer;