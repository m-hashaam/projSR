<?php

 
$footer = '<div id="responsive" class="modal fade" tabindex="-1" data-width="1100" style="display: none; width: 1100px; margin-left: -549px; margin-top: 0px;" aria-hidden="true">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title">Consumer Archetypes</h4>
   </div>
   <div class="modal-body">
      <div id="personaSearch" class="element-search container">
    <div class="  col-md-8  ">
        <form action="javascript:;" class="top-marginMedium bottom-marginLarge">
            <div class="portlet-body">
                <div class="well well-sm">
                      <div class="icon-addon addon-lg">
                        <input type="text" id="personaSearch-input" placeholder="Search Consumer Archetypes." class="form-control clearable  element-search-input">
                        
                      </div>
                      <span class="input-group-btn hide">
                            <button id="personaSearch-button" type="button" class="btn green-haze element-search-btn">
                                Search &nbsp;
                                <i class="m-icon-swapright m-icon-white"></i>
                            </button>
                      </span>
                </div>
                <p id="personaSearch-status" class="search-status" hidden=""></p>
            </div>
        </form>
    </div>
            <div class="col-md-4 col-md-offset-0">
            <form action="javascript:;" class="top-marginMedium bottom-marginLarge">
                <div class="input-group add-retailer-top-margin">
                    <span class="input-group-btn">
                    <a id="addPersonas" onclick="addpersonas()" class="btn btn-lg btn-primary green-jungle rounded-4" disabled="disabled">Save</a>
                    </span>
                </div>
            </form>
            <div class="persona-selection-div hint">
                <span id="count" hidden=""></span>
                <span id="selected-personas" class="padding-right-3" hidden=""> consumer archetype selected</span>
                <span id="seperator-persona" class="seperator-black" hidden=""></span>
                            </div>
        </div>
    </div>

      <div class="row">
         <div class="col-md-12">
            <div style="background-color: rgb(255, 255, 255);" class="col-md-6 box toppadding-xs personas-tab persona-list" id="tab_add_personas">
               <div class="tiles col-md-12 popUp" id="sectionPersonas">
                                ';
                     $pid = $_SESSION['CurrentProductID'];           
                     $query = "SELECT `per_id`, `per_name`, `per_desc`, `per_image` FROM `persona` WHERE `per_id` not in (SELECT  `product_persona`.`per_id` FROM `product_persona` WHERE `p_id` = $pid)";     
                     $stmt = $db->query($query);
                     while($row = $stmt->fetch_assoc()){
                        $footer.='<div id="persona-tile-'.$row['per_id'].'" class="mypersonatile" onclick="tileSelected('.$row['per_id'].')" style="   cursor: pointer; background-color: hsla(177, 53%, 16%, 0.25); border-radius:15px !important; width: 60%;
    margin-left: auto;
    margin-right: auto;">
                                                   
                                                   
                                            		<div style="display: flex; margin-top:3px; margin-bottom:3px;">
                                                    <img class="hide" id="personatick-'.$row['per_id'].'" width="10" height="10" src="../assets/pertick.png"  style="margin-top: 9%; margin-left: 2%;"/>
                                                   <img style="        max-width: 50px; max-height: 50px; margin: auto;  margin-left: 20px; margin-right: 50px;" src="'.$row['per_image'].'" />
                                                    <p >'.$row['per_name'].'</p>   
                                                
                                                </div>
                                                
                                            </div>';
                     }     
                     
                        
                                
                                
                      $query = "SELECT  count(`per_id`) AS cc FROM `product_persona` WHERE `p_id` = $pid";     
                     $stmt = $db->query($query);
                     if($row = $stmt->fetch_assoc()){
                            $count = $row['cc'];
                        }
                        else{
                            $count = 0;
                        }

                                                    $footer.=' </div>
                  
            </div>
            <div class="col-md-6" id="your-personas">
               <h4 id="added_personas" class="font-blue-hoki retailer-tree-heading text-center">
                  Added Consumer Archetypes
                  <span id="added_personas_count">
                                                  '.$count.'
                                        </span>
               </h4>
               <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;"><div class="tiles col-md-12 personaTileSpace" style="overflow: scroll; width: auto;">
                ';                                                  

                                               
                    $query = "SELECT `per_name`, `per_desc`, `per_image`, `persona`.`per_id` FROM `product_persona`,`persona` WHERE `product_persona`.per_id = `persona`.per_id AND`p_id` = $pid";     
                     $stmt = $db->query($query);
                     while($row = $stmt->fetch_assoc()){
                        $footer.='<div id="persona-tile-'.$row['per_id'].'" style="    background-color: hsla(177, 53%, 16%, 0.25); border-radius:15px !important;
    margin-left: auto;
    margin-right: auto;">
                                                   
                                                   
                                            		<div style="display: flex; margin-top:3px; margin-bottom:3px;">
                                                    <img onclick="removepersona('.$row['per_id'].')" id="personatick-'.$row['per_id'].'" width="15" height="15" src="../assets/percross.png"  style=" cursor: pointer; margin-top: 9%; margin-left: 2%;"/>
                                                   <img style=" max-width: 50px; max-height: 50px; margin: auto;  margin-left: 20px; margin-right: 20px;" src="'.$row['per_image'].'" />
                                                    <p style="padding-right: 20px;">'.$row['per_name'].'</p>   
                                                
                                                </div>
                                                
                                            </div>';
                     }                                                  

                                                      $footer.=' </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 164px; opacity: 0.2; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 98.5407px; background: rgb(135, 117, 167);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
            </div>
         </div>
      </div>
   </div>
</div>';

echo $footer;