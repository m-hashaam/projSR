<?php

 
$footer = '<div class="form" id="addProductForm">
				<form action="">
					<div class="col-md-12 getting-started">
						<div class="bg-red margin-top-10">
							<span class="pull-left">Onboarding Guide</span>
                            <span class="pull-right">step 3 of 4</span>
						</div>
					</div>
					<div class="clearfix margin-top-10"></div>
					<div class="col-md-7 margin-top-10">
						<div class="clearfix margin-top-10"></div>
						<h3><b>Step 1: Add Your Products</b></h3>
						<div class="clearfix margin-top-10"></div>
                        <div class="text-container">
                            <span class="span-custom">
                                List your products and URL to it\'s page on your site. We’ll automatically pre-fill your product profiles to get you started. You\'ll get an email when your profiles are ready for you to check out and submit.
                                 <div class="clearfix"></div>
                                If you don’t have a product url, simply add the names, and you can take the reins later on filling out the rest.

                            </span>
                        </div>
						<div id="spinner" class="spinner spinner-get-started" hidden="">
							<img id="img-spinner" src="./On Boarding Guide_files/ajax-loader.gif" alt="Loading">
						</div>
						<div class="clearfix margin-top-10">
                        <span class="small font-grey-silver">
                                Make sure you click "Add" or press "Enter" to save the product.</span></div>
						<div class="clearfix margin-top-10">
                        <span class="small font-grey-silver">
                               * Please add at least one product in order to proceed.</span></div>

						<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><div id="sheepItForm" class="sheepItBox" style="display: block; overflow: hidden; width: auto; height: 250px;">

							<div id="sheepItForm_controls" class="row">
								<div id="sheepItForm_add" class="col-md-3 margin-right-10" style="display: none;"><a class="btn green-haze rounded-4 btn-lg getting-started-buttons add-first-product"><span>Add Your First Product</span></a>
								</div>
							</div>
							<div class="clearfix margin-top-10"></div>
								

							<div id="parentdiv0" class="row sheepItTemplate" idtemplate="sheepItForm_template">
									<div class="col-md-1 row-align">
										<span id="0_count" class="row-count">1</span>
									</div>
									<div class="col-md-5" style="margin-left: -20px">
										<input id="product0name" class="form-control" placeholder="Add Product Name" name="product[0][name]" type="text" idtemplate="sheepItForm_%23index%23_name" nametemplate="product%5B%23index%23%5D%5Bname%5D">
									</div>
									<div class="col-md-5">
										<input id="product0url" class="form-control" placeholder="Add Product URL" name="product[0][url]" type="text" idtemplate="sheepItForm_%23index%23_url" nametemplate="product%5B%23index%23%5D%5Burl%5D">
									</div>
									<div class="col-md-1" style="margin-left: -10px">
										<div class="row">
											<div class="btn btn-sm" style="margin-top: -5px">
												<a id="0" class="add-product" onclick="addtheproducts(this)"> <h5><b><i class="fa fa-plus"></i> Add</b></h5></a>
											</div>
										</div>
									</div>
								</div>
								
								
								
								
								
								
								
								<div id="sheepItForm_noforms_template" style="display: none;"><b>No Product Added Yet</b>
							</div>
						</div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.2; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 115, 183);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
					</div>
					<div class="col-md-5 margin-top-10">
						<div class="clearfix margin-top-10"></div>
						<h3>Once you’re done, click continue</h3>
						<div class="onboarding-popover display-inline" data-toggle="popover" data-placement="right" data-content="Please add at least one product in order to proceed" data-original-title="" title="">
                            <a disabled="disabled" class="btn green-haze rounded-4 btn-lg getting-started-buttons" id="step3continue" onclick="gotostep4" name="next">
                            Continue </a>
                        </div>
						<div class="horizontal-line"></div>
						<div class="horizontal-line">
							<span><h4 class="text-left"><b>Step 2:  Build Product Demand</b></h4></span>
                            <div class="text-container">
    							<span><b><h4>Once your products go live, users can signal their demand by wanting and sharing them. See this demand in your dashboard and use analysis tools to hone in on your target market.</h4></b></span>
                            </div>
						</div>
						<div class="horizontal-line"></div>
						<div class="horizontal-line">
							<span><h4 class="text-left"><b>Step 3: Get Ready to Engage</b></h4></span>
                            <div class="text-container">
    							<span><b><h4>Setup promotions to target them to key consumers and generate reviews, insights and sales.</h4></b></span>
                            </div>
						</div>
						<div class="horizontal-line"></div>
					</div>
				</form>
			</div>';

echo $footer;