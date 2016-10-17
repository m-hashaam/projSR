<?php

 
$footer = '<div class="form" id="gettingStartedForm">
				<form action="">
					<div class="col-md-12 getting-started">
						<div class="bg-red margin-top-10">
                            <span class="pull-left">Onboarding Guide</span>
                            <span class="pull-right">step 1 of 4</span>
						</div>
					</div>
					<div class="clearfix margin-top-10"></div>
					<div class="clearfix margin-top-10"></div>
					<div class="clearfix margin-top-10"></div>
                    <h1 class="fs-title center"><b>'.$_SESSION['fnameSR'].', Welcome to Sweet Refferals.</b></h1>

					<div class="clearfix margin-top-10"></div>
					<div class="col-md-6 margin-top-10">
                      <div class="text-container">
                            <span class="large-font">
                            We\'re excited to help you tap into demand for your product and unlock the power of your promotions.
                            <div class="clearfix margin-top-10"></div>
                            Our users love discovering and sharing new products, so let\'s get started!
                            <div class="clearfix margin-top-10"></div>
                            Click &#8220;<b>Get Started</b>&#8222; to see how it works.
                            </span>
                      </div>
					  <div class="clearfix margin-top-10"></div>
                      <a class="btn green-haze rounded-4 btn-lg next getting-started-buttons" id="getStartedNEW" onclick="gotostep2()" name="next">
                            Get Started </a>
					</div>
					<div class="col-md-6 ">
						<img class="margin-top-10" style="margin-left: -10px" src="assets/feed.png" width="390px">
					</div>
					<div class="clearfix margin-bottom-30"></div>
				</form>
			</div>';

echo $footer;