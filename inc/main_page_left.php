<?php

$pname = $_SESSION['CurrentProductName'];
$pid = $_SESSION['CurrentProductID'];
$query = "SELECT  count(`per_id`) AS cc FROM `product_persona` WHERE `p_id` = $pid";     
                     $stmt = $db->query($query);
                     if($row = $stmt->fetch_assoc()){
                            $count = $row['cc'];
                        }
                        else{
                            $count = 0;
                        }
 
$footer = '<div class="col-md-6">
        <div class="portlet light portlet-fit ">
            <div class="portlet-body">
                <h1 id="" class="heading-large">
                    '.$pname.'
                    <a id="edit-product" type="button" class="btn btn-sm btn-default rounded-4 left-marginMedium" href="edit.php?id='.$pid.'">
                        Edit Information
                    </a>
                </h1>
                <div>
                    <div>
                                            </div>
                </div>
                <hr>
                <div class="persona-div">
                    <h3 class="heading-large">Personas&nbsp;';
                        if($count == 0){
                            $footer.='<span id="persona-selected-count" class="badge badge-persona animated flip bg-red">
                                NA';
                        }
                        else{
                             $footer.='<span id="persona-selected-count" class="badge badge-persona animated flip bg-green-meadow">
                                '.$count;
                        }
                                                    
                                                    
                            $footer.='</span>
                                                &nbsp;&nbsp;
                        <a type="button" id="add-manage-persona" class="btn btn-sm btn-default rounded-4 left-marginSmall persona" data-toggle="modal" >
                                                            Add Personas
                                                    </a>
                    </h3>
                    <a type="button" id="campaign-persona" class="btn btn-sm btn-default rounded-4 left-marginSmall persona hide" data-toggle="modal" ></a>
					';
					echo $footer;
					
					include 'modals/personas.php';
					
                    $footer = '<div class="caption-product-info font-grey-cascade">Pick personas for your product, so we can prioritize it to key users and help you generate better demand.
                                                     <a id="add-persona" type="button" class="link" data-toggle="modal" >
                                Add Personas</a>
                                            </div>
                    <div class="tiles" id="personaTiles">
                                            </div>
                                            <a type="button" id="view-more-personas" class="link rounded-4 hide" >
                            View More Personas
                        </a>
                                    </div>
                
            </div>
        </div>
    </div>';

echo $footer;