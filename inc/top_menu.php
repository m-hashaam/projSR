<?php

 $type = $_SESSION['user_type'];
$footer = ' <div class="page-head" style="margin-bottom: 60px;">
        <div class="container-fluid">
            <ul class="nav nav-pills nav-secondary ul-navigator-margin" style="border-width: 1px;
                                                                                border-color: #009ecc;
                                                                                border-style: solid;
                                                                                border-radius: 7px !important;
                                                                                float: right;
                                                                                position: absolute;
                                                                                top: 60px;
                                                                                right: 30px;
                                                                        ">
                ';
                if($type == "Normal" || $type == "Editor" || $type == "Admin"){
                    $footer.='<li role="presentation" class="nav-link-navigator">
                                        <a id="product-info" href="edit.php" class="see-opportunities">Product Info
                                </a>
                            </li>';
                }
                if($type == "Normal" || $type == "Admin"){
                    $footer.=' <li role="presentation" class="nav-link-navigator">
                                            <a id="consumer" href="demandmap.php" class="demand-tool">Demand Map
                                    </a>
                                </li>';
                }
                if($type == "Normal" || $type == "Editor" || $type == "Admin"){
                    $footer.='<li role="presentation" class="nav-link-navigator">
                                        <a id="promote-product" href="compaignbuilder.php" class="promote">Campaign Builder
                                </a>
                            </li>';
                }
               
                $footer.='<li role="presentation" class="nav-link-navigator">
                            <a id="reports-reviews" href="rep_overview.php" class="reviews-reports">Reviews and Reports
                    </a>
                </li>
            </ul>
        </div>
    </div>';

echo $footer;