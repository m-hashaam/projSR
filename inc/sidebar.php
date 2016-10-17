<?php

 
$footer = '<!-- BEGIN QUICK SIDEBAR -->
<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
    <div class="page-quick-sidebar">
        <div class="page-quick-sidebar-nav">
            <ul>
                <li>
                    <a id="close-sidebar" onclick="closesidebar()" class="quick-sidebar-toggler" style="margin-left: 85%;">
                        <i class="icon-arrow-left" style="margin-top: 5%;"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd">
                    <ul class="media-list list-items">
                        <h3 class="list-heading font-grey-cascade">Draft Products <i class="fa fa-info-circle font-grey-cararra fa-info-size information" data-toggle="popover" data-placement="bottom" data-html="true" data-content="Draft products are unfinished product profiles. &lt;br /&gt; &lt;span class=&#39;small&#39;&gt;(Consumers can&#39;t see these)&lt;/span&gt;"></i></h3>
								';
                                  
					include 'database/db.php';
					$userid = $_SESSION['idSR'];
					$query = "SELECT `p_id`, `u_id`, `p_name`, `p_url` FROM `product` WHERE `u_id` = $userid AND `p_islive` = 0";
					$stmt = $db->query($query);
					while($row = $stmt->fetch_assoc()){
						$footer.='<li class="media" id="media-1435082663">
                                    <a class="quick-sidebar-toggler" href="changeproduct.php?id='.$row['p_id'].'">
                                        <div class="media-status">
                                            <span class="badge badge-danger" style="color: transparent; background-color: #FF7565;">0</span>
                                        </div>
                                        </a><div class="media-body"><a class="quick-sidebar-toggler" href="changeproduct.php?id='.$row['p_id'].'">
                                            <h2 class="media-heading col-md-12">
                                                 '.$row['p_name'].'</h2>
                                            </a><div class="media-heading-sub" hidden=""><a class="quick-sidebar-toggler" href="edit.php?id='.$row['p_id'].'">
                                                </a><a href="edit.php?id='.$row['p_id'].'" class="btn btn-sm btn-side-panel quick-sidebar-toggler left-marginMedium edit">
                                                    <i class="fa fa-edit"></i>
                                                    Edit
                                                </a>
                                                <a href="http://portal.sweetreferrals.com/product/'.$row['p_id'].'#clone_product_modal" onclick="clonecalled('.$row['p_id'].');" class="btn btn-sm btn-side-panel left-marginSmall cloneProduct" data-toggle="modal" data-product-id="'.$row['p_id'].'" data-backdrop="static">
                                                    <i class="fa fa-copy"></i>
                                                    Make a clone
                                                </a>
                                            </div>
                                        </div>
                                    
                                </li>
								';
					}

					$footer.='</ul>
                    <ul class="media-list list-items" style="margin-top: 20%;">
                    <h3 class="list-heading font-grey-cascade">Live Products <i class="fa fa-info-circle fa-info-size  font-grey-cararra information" data-toggle="popover" data-placement="bottom" data-content="Our Online Visitors can see Live Products."></i></h3>
                                         	';
                                  
				
					$query = "SELECT `p_id`, `u_id`, `p_name`, `p_url` FROM `product` WHERE `u_id` = $userid AND p_islive = 1";
					$stmt = $db->query($query);
					while($row = $stmt->fetch_assoc()){
						$footer.='<li class="media" id="media-1435082663">
                                    <a class="quick-sidebar-toggler" href="changeproduct.php?id='.$row['p_id'].'">
                                        <div class="media-status">
                                            <span class="badge badge-danger" style="color: transparent; background-color: #8DFF65;;">0</span>
                                        </div>
                                        </a><div class="media-body"><a class="quick-sidebar-toggler" href="changeproduct.php?id='.$row['p_id'].'">
                                            <h2 class="media-heading col-md-12">
                                                 '.$row['p_name'].'</h2>
                                            </a><div class="media-heading-sub" hidden=""><a class="quick-sidebar-toggler" href="edit.php?id='.$row['p_id'].'">
                                                </a><a href="edit.php?id='.$row['p_id'].'" class="btn btn-sm btn-side-panel quick-sidebar-toggler left-marginMedium edit">
                                                    <i class="fa fa-edit"></i>
                                                    Edit
                                                </a>
                                                <a href="http://portal.sweetreferrals.com/product/'.$row['p_id'].'#clone_product_modal" onclick="clonecalled('.$row['p_id'].');" class="btn btn-sm btn-side-panel left-marginSmall cloneProduct" data-toggle="modal" data-product-id="'.$row['p_id'].'" data-backdrop="static">
                                                    <i class="fa fa-copy"></i>
                                                    Make a clone
                                                </a>
                                            </div>
                                        </div>
                                    
                                </li>
								';
					}

					$footer.='                                                                                                                                      
                                        </ul>
                </div>
                ';
              
              
              /*)<a type="button" class="btn btn-small green-jungle rounded-4 add-product-side-panel" data-toggle="modal" data-backdrop="static" href="http://portal.sweetreferrals.com/product/1435082663#add_product">Add a product</a>
                <div id="add_product" class="modal fade" tabindex="-1" data-width="500">
                    <input type="hidden" id="productId">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Enter name of new product</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control input-lg clearable" id="product_name_field_sidebar" placeholder="Enter name of new product..." value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey rounded-4" data-dismiss="modal" id="categoryCancel"> Cancel</button>
                        <button type="button" onclick="addnewproduct()"class="btn green-jungle rounded-4" id="add_new_product_sidebar" hidden=""><i class="fa fa-check"></i> Add</button>
                    </div>
                </div>*/
                
                
              $footer.='
            </div>
        </div>
    </div>
</div>
<div id="clone_product_modal" class="modal fade" tabindex="-1" data-width="500">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Provide name of product</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="text" class="form-control input-lg clearable" id="cloneName" placeholder="Enter name of new product..." value="">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn grey rounded-4" data-dismiss="modal" id="categoryCancel"> Cancel</button>
        <button type="button" class="btn green-jungle rounded-4" data-dismiss="modal" onclick="cloneproduct()" id="clone" hidden=""><i class="fa fa-check"></i> Clone</button>
    </div>
</div>



';

//<button class="product-sticker page-quick-sidebar-toggler side-panel-padding nav-products-truncate tour-compatible" onclick="opensidebar()">
//	<i class="fa fa-bars fa-2x font-white"></i>  '.$_SESSION['CurrentProductName'].'
//</button>

//echo $footer;