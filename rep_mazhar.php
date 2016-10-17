<?php
session_start(); 
include 'database/db.php';
$userid = $_SESSION['idSR'];
$proid = $_SESSION['CurrentProductID'];

$html='<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">


<title>Sweet Referrals | Reports</title>

<style>



#myownsidebar {
    position: fixed;
    top: 49px;
    left: 0px;
    bottom: 0px;
    width: 200px;
    background-color: #fafafa;
}
#myownparent {
    margin-left: 200px;
    margin-bottom:100px;
}

.sidebarli{
    padding-left: 10%;
     cursor: pointer;
     padding-top:7px;
     padding-bottom:7px;
     margin:0;
}

.sidebarli:hover{
    background: #ddd;    
}


 
#circle circle {
fill: none;
pointer-events: all;
}
 
.group path {
fill-opacity: .5;
}
 
path.chord {
stroke: #000;
stroke-width: .25px;
}
 
#circle:hover path.fade {
display: none;
}
 
</style>
<script src="http://d3js.org/d3.v2.min.js?2.8.1"></script>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

 <link rel="icon" href="assets/favicon.ico" type="image/x-icon">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-migrate.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.blockui.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/respond.min.js"></script>
<script type="text/javascript" src="js/excanvas.min.js"></script>
<script type="text/javascript" src="js/jquery.cokie.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="js/bootstrap-modal.js"></script>
<script type="text/javascript" src="js/metronic.js"></script>
<script type="text/javascript" src="js/layout.js"></script>
<script type="text/javascript" src="js/ui-extended-modals.js"></script>
<script type="text/javascript" src="js/select2.min.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script type="text/javascript" src="js/toastr.min.js"></script>
<script type="text/javascript" src="js/components-pickers.js"></script>
<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/pace.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/helpers.js"></script>
<script type="text/javascript" src="js/steps.js"></script>
<script type="text/javascript" src="js/sidebar.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="js/pager.js"></script>
<script type="text/javascript" src="js/rep_mazhar.js"></script>


<link rel="stylesheet" type="text/css" href="css/filtergrid.css">
<link href="css/jquery-multi-step-form.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/simple-line-icons.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/uniform.default.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-modal.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-modal-bs3patch.css">
<link rel="stylesheet" type="text/css" href="css/select2.css">
<link rel="stylesheet" type="text/css" href="css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="css/components.css">
<link rel="stylesheet" type="text/css" href="css/plugins.css">
<link rel="stylesheet" type="text/css" href="css/layout.css">
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/tooltipster.css">
<link rel="stylesheet" type="text/css" href="css/pace-theme-flash.css">
<link rel="stylesheet" type="text/css" href="css/datepicker.css">
<link rel="stylesheet" type="text/css" href="css/tasks.css">
<link rel="stylesheet" type="text/css" href="css/components-rounded.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-fileinput.css">
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/ion.rangeSlider.css">
<link rel="stylesheet" type="text/css" href="css/ion.rangeSlider.Metronic.css">
<link rel="stylesheet" type="text/css" href="css/introLoader.min.css">
<link rel="stylesheet" type="text/css" href="css/timeline.css">
<link rel="stylesheet" type="text/css" href="css/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/flaticon(1).css">
<link rel="stylesheet" type="text/css" href="css/flaticon(2).css">
<link rel="stylesheet" type="text/css" href="css/fontcustom.css">
<link rel="stylesheet" type="text/css" href="css/jquery.tagsinput.css">
<link rel="stylesheet" type="text/css" href="css/animate.min.css">
<link rel="stylesheet" type="text/css" href="css/hover-min.css">
<link rel="stylesheet" type="text/css" href="css/media.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-tour.min.css">

<link rel="stylesheet" type="text/css" href="css/alignment.css">
<link rel="stylesheet" type="text/css" href="css/headings-texts.css">
<link rel="stylesheet" type="text/css" href="css/select-boxes.css">
      
	   <link rel="stylesheet" type="text/css" href="css/MyTabs.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        
         <link href=\'http://fonts.googleapis.com/css?family=Roboto\' rel=\'stylesheet\' type=\'text/css\'>
         
              
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
         

  <!-- use the font -->
  <style>
    body {
      font-family: \'Roboto\', sans-serif;
    }
  </style>
       
    </head>';
	
	echo $html;
	
	$html='<body style="color: rgba(0, 0, 0, 0.65);" class=" page-header-menu-fixed  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=433118806862462";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>

';
echo $html;

include 'inc/public_header.php';

//include 'inc/sidebar.php';

echo '<div class="page-container">';

include 'inc/top_menu.php';

echo '<div class="page-content"><div class="container-fluid"><div class="row"><div class="profile-content col-md-12 col-sm-12">';


compaignContent($pname); 


echo '</div></div></div></div></div>';

include 'inc/footer2.php';

echo '</body>';


function compaignContent($pname){
    include 'database/db.php';
    
    $userid = $_SESSION['idSR'];
    $proid = $_SESSION['CurrentProductID'];
   
    
    
    

    	$footer = '<div class="portlet-body">        
                <div id="myownparent">';
                   
                   echo $footer;
                   include 'inc/rep_sidebar.php';
                            
    						$footer.='<div id="myowncontent">
                            
                            <h1>Tweets</h1>
                            <h3 style="font-weight: bold; text-align: center;">Humayun Mazhar</h3>
                                            <table style=" width: 80% !important; margin-left: auto; margin-right: auto;" id="firstTable" class="table table-bordered table-hover table-condensed">
                                                <tbody><tr><td style="font-weight: bold;">Timestamp</td>
                                                <td style="font-weight: bold;">Sentiment</td>
                                                <td style="font-weight: bold;">Tweet</td>
                                                </tr>
                                                <tr><td>Thu Jun 23 10:44:49 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>The WhoÔøΩs Who: Incubators and Accelerators in Pakistan https://t.co/4ryID5BE6j</td>
                                                </tr>
                                                <tr><td>Sat Jun 18 08:15:24 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>https://t.co/dM6YFfYuoj</td>
                                                </tr>
                                                <tr><td>Fri Jun 10 13:25:18 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>https://t.co/9uqPb3dDta</td>
                                                </tr>
                                                <tr><td>Mon May 09 19:15:04 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>Key Takeaways from 2nd Startup Expo in Islamabad https://t.co/v3iJyFoU3v</td>
                                                </tr>
                                                <tr><td>Sun Feb 21 06:47:40 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>@TK_HelpDesk I did but have not heard from you since</td>
                                                </tr>
                                                <tr><td>Sat Feb 20 08:05:49 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @TheSuccessKing: 3 Reasons To Create A Fear List Right Now https://t.co/0xfkfQkgql https://t.co/2LLgpEekUk</td>
                                                </tr>
                                                <tr><td>Sat Feb 20 08:04:04 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @TIME: &quot;How I learned to listen to what my gut was telling me&quot; https://t.co/a8MBAbyyHv</td>
                                                </tr>
                                                <tr><td>Sat Feb 20 08:03:01 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @MercedesBenz: Happiness: a state of mind best enjoyed when you&#39;re doing the things you love. ?? @steudtner https://t.co/Vgjl7Y8gni</td>
                                                </tr>
                                                <tr><td>Sat Feb 20 08:02:05 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @GHVAccelerator: Talking about #Investment thesis on #fundability &amp; valuation #startups @padmajaian @shantimohan @VikramUpadhyaya https:ÔøΩ</td>
                                                </tr>
                                                <tr><td>Sat Feb 20 02:11:06 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>ECommerce startup Baby Planet raises investment to fuel growth https://t.co/cQPOWrs38R via @techjuicepk</td>
                                                </tr>
                                                <tr><td>Sat Feb 20 01:58:59 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>Pakistan&#39;s return as the &#39;California of Asia&#39; [Opinion] https://t.co/JEUUrt2gyJ via @wamdaME</td>
                                                </tr>
                                                <tr><td>Sat Feb 20 01:36:15 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @sameer__jain: @hmazhark: &quot;If a startup has to ask for anything from God, ask for luck. Not intelligence.&quot; @TiECON_CHD</td>
                                                </tr>
                                                <tr><td>Fri Feb 19 12:21:42 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @TiEChandigarhs: @shantimohan @padmajaian @hmazhark @VikramUpadhyaya @abhidhal talk abt investment thesis on fundability &amp; valuation staÔøΩ</td>
                                                </tr>
                                                <tr><td>Fri Feb 19 05:46:43 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>@ravigururaj Rocks #TiEConChandigarh</td>
                                                </tr>
                                                <tr><td>Fri Feb 19 04:22:43 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>#TiE CON Chandigarh 2016 https://t.co/CTq3NwS7aK</td>
                                                </tr>
                                                <tr><td>Fri Feb 19 04:19:27 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>#TiE CON 2016 Chandigarh</td>
                                                </tr>
                                                <tr><td>Fri Feb 19 04:13:50 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>https://t.co/K5qT97Pcxm</td>
                                                </tr>
                                                <tr><td>Sun Feb 14 08:35:04 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @TiEChandigarhs: Join the experts in discussion- @hmazhark &amp; @maharajasharma on 19th Feb at @thelalitgroup https://t.co/CitRWsFi0M httpsÔøΩ</td>
                                                </tr>
                                                <tr><td>Sun Feb 14 08:34:56 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@TiEChandigarhs @maharajasharma @TheLalitGroup</td>
                                                </tr>
                                                <tr><td>Sun Feb 14 02:40:52 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@TK_HelpDesk my reservation code : VGF22M</td>
                                                </tr>
                                                <tr><td>Sun Feb 14 02:39:00 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@TK_HelpDesk item detail a Burberry Scarf in a Burberry bag bought from Istanbul Airport Duty Free Burberry Shop</td>
                                                </tr>
                                                <tr><td>Sun Feb 14 02:37:03 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@TK_HelpDesk locator # UQN8G5, my email hmazhar@crescentgroup.com.pk</td>
                                                </tr>
                                                <tr><td>Sun Feb 14 02:17:53 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>@TK_HelpDesk forgot a Burberry scarf on my seat 4K on TK 714 this morning.contacted ground staff but they could not find it. Very surprising</td>
                                                </tr>
                                                <tr><td>Thu Feb 04 12:59:07 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>@PASHAORG @jehan_ara regret could not stay longer, have some ideas which may help solve the current crisis, let meet up soon</td>
                                                </tr>
                                                <tr><td>Sat Jan 30 03:19:02 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>Pakistan startup Sukoon raises seed funding led by Crescent Ventures https://t.co/4gtNBnYqrm</td>
                                                </tr>
                                                <tr><td>Thu Jan 28 04:46:52 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>https://t.co/a8X9DSVykh</td>
                                                </tr>
                                                <tr><td>Mon Jan 18 07:15:52 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@HyattConcierge 10/19/15, hmazhar@crescentgroup.com.pk</td>
                                                </tr>
                                                <tr><td>Sat Jan 16 18:50:51 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>@HyattUnionSqNYC Extremely disappointed and upset with the service, clearly there is no priority for platinum members at this establishment.</td>
                                                </tr>
                                                <tr><td>Sat Jan 16 18:48:46 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>@HyattUnionSqNYC extremely disappointed and upset with service &amp; billing Unhappy with rooms so moved to Hyatt Andaz and was charged for both</td>
                                                </tr>
                                                <tr><td>Mon Dec 28 09:26:59 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>It&#39;s not only right time right place stupid! What about the right person ? @shivkh3</td>
                                                </tr>
                                                <tr><td>Mon Dec 28 09:24:27 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>Power breakfast with Naryana Murthy, a visionary, thought leader and Co Founder of Infosys .TiE CM Retreat Jaipur</td>
                                                </tr>
                                                <tr><td>Sun Dec 06 04:29:46 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @AdvancedEnergy: Clean energy from coal: High-efficiency coal tech drives major carbon improvements #Path2CCS https://t.co/0RphgiCIui htÔøΩ</td>
                                                </tr>
                                                <tr><td>Sun Dec 06 04:01:45 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>@TEDTalks @Campless</td>
                                                </tr>
                                                <tr><td>Wed Nov 18 12:33:20 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>ÔøΩBlitzscaling w/ Reid Hoffman ÔøΩ What IÔøΩve LearnedÔøΩ by @usmangul https://t.co/Yo6PnwKNFG</td>
                                                </tr>
                                                <tr><td>Fri Nov 13 07:49:08 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>@usmangul @shehryarm @ShameelMazhar agreed! sheroo and you are better at hustling!</td>
                                                </tr>
                                                <tr><td>Fri Nov 13 07:04:21 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>@shehryarm @usmangul @ShameelMazhar two CHO&#39;s are better than one i.e. in hand vs the bush!</td>
                                                </tr>
                                                <tr><td>Fri Nov 13 05:45:20 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>@usmangul you got it , effective today you are the CHO of CresVentures North American ops!</td>
                                                </tr>
                                                <tr><td>Fri Nov 13 05:43:32 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>@usmangul @shehryarm</td>
                                                </tr>
                                                <tr><td>Fri Nov 13 05:35:34 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>My Angel Fund! https://t.co/QILWFgeqjb</td>
                                                </tr>
                                                <tr><td>Tue Oct 27 16:49:49 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>@sherryrehman well said!</td>
                                                </tr>
                                                <tr><td>Wed Sep 23 03:57:59 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>&quot;Wisdom ceases to be wisdom when it becomes too proud to weep, too grave to laugh and too self-ful to seek other than itself&quot; Khalil Gibran</td>
                                                </tr>
                                                <tr><td>Tue Sep 22 01:29:29 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>Co: A new entrant in co-working spaces of Pakistan http://t.co/qE6ekhAMhs via @techjuicepk</td>
                                                </tr>
                                                <tr><td>Fri Sep 18 06:44:14 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>Development: The two Mexicos http://t.co/xSJySgoC6L via @TheEconomist</td>
                                                </tr>
                                                <tr><td>Thu Sep 17 10:46:50 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>This fascinating video shows a young Steve Jobs at his best @justinjbariso http://t.co/h705UcLIAn via @Inc</td>
                                                </tr>
                                                <tr><td>Tue Sep 08 04:04:45 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>Free exchange: Inflated claims http://t.co/OT3mzZqBL6 via @TheEconomist</td>
                                                </tr>
                                                <tr><td>Wed Sep 02 08:54:28 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>How To Manage Growth Versus Profit - http://t.co/0JNaMypsZq via @Entreinsights</td>
                                                </tr>
                                                <tr><td>Tue Sep 01 06:32:49 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>Famous Advertisement war between BMW and AUDI ÔøΩ who nailed it: http://t.co/uQlofiNZRW via @BeYourGoogle</td>
                                                </tr>
                                                <tr><td>Thu Dec 18 19:27:44 +0000 2014</td>
                                                <td>Negative</td>
                                                <td>Special to the Express: ÔøΩHow can they kill our kids? Because we let themÔøΩ http://t.co/gdDIsHIu6r via @sharethis</td>
                                                </tr>
                                                <tr><td>Sat Oct 25 07:49:02 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>How to Use Your Gut to Make Better Decisions http://t.co/kxbl0LzKlQ</td>
                                                </tr>
                                                <tr><td>Sat Oct 25 07:46:31 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>Eliminate These 10 Words From Your Writing http://t.co/XPAQIXo2tJ</td>
                                                </tr>
                                                <tr><td>Fri Oct 24 17:55:30 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>Engaging in a Vice Can Stimulate Creativity if ItÔøΩs Framed as a Duty http://t.co/vGwMZXnvP9</td>
                                                </tr>
                                                <tr><td>Wed Sep 24 07:23:30 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>The 4 Habits You Need to Be Successful http://t.co/fEigr8VXmU</td>
                                                </tr>
                                                <tr><td>Fri Jun 20 07:02:18 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>5 Questions to Determine If You&#39;re Ready to Be an Entrepreneur http://t.co/6GnKQ14iDh</td>
                                                </tr>
                                                <tr><td>Fri Jun 06 06:43:42 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>Apple: Frictionless fruit | The Economist http://t.co/ehPPR4Ccz4</td>
                                                </tr>
                                                <tr><td>Wed May 28 04:53:12 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>The Crazy Genius Behind Solar Roadways http://t.co/5yfk0GmKZE via @techcrunch</td>
                                                </tr>
                                                <tr><td>Tue May 06 01:37:14 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>Self-Made Billionaires Around the Globe: Where and Why They Thrive (Infographic) http://t.co/iWqN6WRxrj</td>
                                                </tr>
                                                <tr><td>Tue May 06 01:31:06 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>A Vision of the Future From Those Likely to Invent It http://t.co/ltXUNqAXXM</td>
                                                </tr>
                                                <tr><td>Wed Apr 30 02:47:19 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>Eight sleep myths debunked http://t.co/Dwp5q7xmKL via @British_Airways #TheClub</td>
                                                </tr>
                                                <tr><td>Wed Apr 30 00:45:27 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>The 6 People Every Startup Needs http://t.co/j7QVOQ803A</td>
                                                </tr>
                                                <tr><td>Fri Apr 25 01:23:51 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>5 Keys to Inspiring Leadership, No Matter Your Style http://t.co/qxIvzpUHwI</td>
                                                </tr>
                                                <tr><td>Thu Apr 24 04:22:24 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>To Enhance Your Learning, Take a Few Minutes to Think About What YouÔøΩve Learned http://t.co/wVTuTukM9J</td>
                                                </tr>
                                                <tr><td>Wed Apr 23 04:56:18 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>Career Curveballs: Embrace Change or Become Stagnant | LinkedIn http://t.co/FZGBhqZ8df</td>
                                                </tr>
                                                <tr><td>Sat Apr 19 18:51:31 +0000 2014</td>
                                                <td>Negative</td>
                                                <td>10 insane hotel suites you can&#39;t afford to spend the night in @Thrillist http://t.co/LO6cj8ekwK</td>
                                                </tr>
                                                <tr><td>Thu Apr 17 12:22:08 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>Keys to Business Success: 3 Lessons From the Masters http://t.co/nXH6q4tcGU</td>
                                                </tr>
                                                <tr><td>Fri Apr 11 02:55:14 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>10 Simple Truths Smart People Forget http://t.co/06PfSjRNLH via @marcandangel</td>
                                                </tr>
                                                <tr><td>Fri Apr 04 07:17:52 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>What will blow our minds in the *next* 30 years? http://t.co/TCVGaYfOs0 via @wordpressdotcom</td>
                                                </tr>
                                                <tr><td>Wed Apr 02 13:13:44 +0000 2014</td>
                                                <td>Negative</td>
                                                <td>7 Things You Should Never Say to Your Employees http://t.co/Z5BsJFEu5J</td>
                                                </tr>
                                                <tr><td>Tue Apr 01 09:31:36 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>Richard Branson on Learning by Doing http://t.co/qieaP8TRdL via @EntMagazine</td>
                                                </tr>
                                                <tr><td>Tue Apr 01 09:26:34 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>4 Critical Traits of Great Leaders http://t.co/i3kThWgBYK via @EntMagazine</td>
                                                </tr>
                                                <tr><td>Sun Mar 23 05:31:13 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>The Art of Innovation | LinkedIn http://t.co/Vfomi1ckqf</td>
                                                </tr>
                                                <tr><td>Sun Mar 23 05:04:16 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>How to Have a Eureka Moment - @HarvardBiz http://t.co/YPF77Muu4x</td>
                                                </tr>
                                                <tr><td>Fri Mar 21 12:51:03 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>Why Growth Hacking Won&#39;t Work for Every Company http://t.co/9yRScQcD7v</td>
                                                </tr>
                                                <tr><td>Sun Mar 16 12:16:49 +0000 2014</td>
                                                <td>Negative</td>
                                                <td>Ways You&#39;re Sabotaging Your Mornings http://t.co/9TDf2wPnLW</td>
                                                </tr>
                                                <tr><td>Fri Mar 14 15:13:32 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>Clocking It: Time Management That Rocks http://t.co/gAx0BMzLPc</td>
                                                </tr>
                                                <tr><td>Thu Mar 13 17:50:19 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>10 Ways to Become the Most Productive Person Around http://t.co/P87VHbdMrL</td>
                                                </tr>
                                                <tr><td>Thu Mar 13 17:46:52 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>Pass It On: Encourage Your Kids to Become Entrepreneurs With These 5 Lessons http://t.co/IGoqBfRgzL</td>
                                                </tr>
                                                <tr><td>Tue Mar 11 02:31:24 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>You can be an angel investor too! But it takes more than a fat wallet to be one - Economic Times http://t.co/BOHOPlrpk8 via @ArchiveDigger</td>
                                                </tr>
                                                <tr><td>Thu Feb 27 02:37:41 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>@najamsikander , I do but am traveling. Would like to follow up on this on my return to Pakistan in the second week of March</td>
                                                </tr>
                                                <tr><td>Sat Oct 12 02:06:00 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>Sales Alert: Making Eye Contact May Not Be Such a Good Idea http://t.co/SFZoDRoNST</td>
                                                </tr>
                                                <tr><td>Sat Oct 12 02:00:34 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>The 5 Traits of Wildly Successful People | LinkedIn http://t.co/JGpj1V7FrC</td>
                                                </tr>
                                                <tr><td>Thu Oct 10 13:56:46 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>My niece just got awarded a Fulbright scholarship, way to go girl!</td>
                                                </tr>
                                                <tr><td>Wed Aug 07 16:37:28 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>CEO Head-To-Head: Steve Jobs vs. Richard Branson | LinkedIn http://t.co/mSvUOGLkqi</td>
                                                </tr>
                                                <tr><td>Wed Aug 07 16:34:23 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>Are Electric Vehicles The Answer? | LinkedIn http://t.co/87rKy39bEJ</td>
                                                </tr>
                                                <tr><td>Wed Aug 07 16:31:08 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>Chewing Gum Helps You Sustain Vigilance in a Long Task http://t.co/19thF26wgl</td>
                                                </tr>
                                                <tr><td>Wed Aug 07 10:09:04 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>Are You Ready to Use Auto-Analytics Tools? @HarvardBiz http://t.co/I71ewTYy1C</td>
                                                </tr>
                                                <tr><td>Sun Aug 04 23:58:04 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>The week speaks for itself. I earned 31,294 NikeFuel with my Nike+ FuelBand. Check it out: #nikeplus: http://t.co/i7M91feesA</td>
                                                </tr>
                                                <tr><td>Sun Aug 04 07:17:15 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>15 Things Happy People DonÔøΩt Do http://t.co/OP2L9KOizy via @EliteDaily</td>
                                                </tr>
                                                <tr><td>Sun Aug 04 07:15:44 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>Recognize Your Moment of Obligation http://t.co/VfRuaK7HO1</td>
                                                </tr>
                                                <tr><td>Wed Jul 24 09:06:38 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @FamousWomen: Live your life and forget your age.</td>
                                                </tr>
                                                <tr><td>Tue Jul 23 18:30:55 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>I love days like this. I hit my Daily Goal with 5,178 NikeFuel. Help me do more. #nikeplus: http://t.co/D4ohv7nj9t</td>
                                                </tr>
                                                <tr><td>Wed Jul 17 08:34:00 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>Wish it was not Ramadan! would have gone for a long leisurely lunch right now! Take a Long Lunch http://t.co/tAI5rFTDXg</td>
                                                </tr>
                                                <tr><td>Tue Jul 16 11:58:13 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>Plan9 Events : Plan9 http://t.co/hSZM2MOsnG via @sharethis</td>
                                                </tr>
                                                <tr><td>Thu Jul 11 08:59:28 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>Finding Your Passion In Work: 20 Awesome Quotes | LinkedIn http://t.co/KoduMMsi1U</td>
                                                </tr>
                                                <tr><td>Thu Jul 11 08:58:03 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>Global Social Media Networks Set to Overtake Facebook? | LinkedIn http://t.co/c67Xvn48PH</td>
                                                </tr>
                                                <tr><td>Thu Jul 11 06:26:30 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>How about some love? I just hit my Daily Goal 5 days straight with Nike+ FuelBand. Think you can beat it? #nikeplus: http://t.co/6PM5c9BzxH</td>
                                                </tr>
                                                <tr><td>Wed Jul 10 01:48:07 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>Train Your Tired Brain http://t.co/uYf7ew6dIm</td>
                                                </tr>
                                                <tr><td>Wed Jul 10 01:47:33 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>We&#39;ve All Probably Eaten Counterfeit Food http://t.co/mUNaFW8Iqy</td>
                                                </tr>
                                                <tr><td>Tue Jul 09 04:22:49 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>Diesels: Difference Engine: Born again | The Economist http://t.co/Yn0PEPYcL3</td>
                                                </tr>
                                                <tr><td>Wed Jul 03 05:20:42 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @BillGates: If I had to pick one thing to make cheaper and reduce poverty, it would be energy. Great to see this news: http://t.co/ZiKqEÔøΩ</td>
                                                </tr>
                                                <tr><td>Wed Jan 30 16:07:49 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>http://t.co/QkGgnrWB: Reaffirming Your Core Values Helps You Perform Better http://t.co/RRiDOm0A</td>
                                                </tr>
                                                <tr><td>Mon Jan 14 14:37:35 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>Who will make the right calls for 2013? - The Express Tribune Epaper http://t.co/BkyO8LXz via @etribune</td>
                                                </tr>
                                                <tr><td>Sun Nov 25 08:03:45 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>RT @MensHealthMag: Life begins at the end of your comfort zone.ÔøΩNeale Donald Walsh #WordsToLiveBy</td>
                                                </tr>
                                                <tr><td>Thu Nov 01 14:29:03 +0000 2012</td>
                                                <td>Negative</td>
                                                <td>Is It Immoral To Earn Attractive Profits From Poor Customers? | unreasonable.is http://t.co/DSmZ2geT via @beunreasonable</td>
                                                </tr>
                                                <tr><td>Wed Oct 31 13:34:00 +0000 2012</td>
                                                <td>Neutral</td>
                                                <td>Why can&#39;t US give Pakistan preferential market access? This will result in a win win situation for both! What am I missing here?</td>
                                                </tr>
                                                <tr><td>Sun Oct 28 05:33:23 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>KISS, keep it simple stupid,solution for Pakistan&#39;s problems: improve literacy, empower women and it will take care of the rest !!!</td>
                                                </tr>
                                                <tr><td>Sun Oct 28 05:33:22 +0000 2012</td>
                                                <td>Negative</td>
                                                <td>The Pakistan problem: low literacy, no women empowerment, religious intolerance , troubled economy and a young population !</td>
                                                </tr>
                                                <tr><td>Sun Oct 28 05:33:22 +0000 2012</td>
                                                <td>Neutral</td>
                                                <td>Pakistan&#39;s did well during the rule of General Ayub and Musharaf. I wonder why? Is dictatorship more suitable for Pakistan than democracy?</td>
                                                </tr>
                                                <tr><td>Sun Oct 28 05:33:22 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>Win Win for Pakistan I.e be friends with India, leave Afghanistan alone and learn from China ,But who will convince the army?</td>
                                                </tr>
                                                <tr><td>Sun Oct 28 05:33:22 +0000 2012</td>
                                                <td>Neutral</td>
                                                <td>With looming elections in Pakistan what should one do i.e vote for an idiot you know or the one you don&#39;t?</td>
                                                </tr>
                                                </tbody></table>
                                                
                                                <div id="piechart" style="width: 100%; height: 400px;"></div>
                                                
                                                
                                        		
                                        			
                                        		
                                        		</script>	
                            <h3 style="font-weight: bold;     text-align: center;">Mehreen Humayun</h3>
                                                <table style=" width: 80% !important; margin-left: auto; margin-right: auto;" id="secondTable" class="table table-bordered table-hover table-condensed">
                                                <tbody><tr><td style="font-weight: bold;">Timestamp</td>
                                                <td style="font-weight: bold;">Sentiment</td>
                                                <td style="font-weight: bold;">Tweet</td>
                                                </tr>
                                                <tr><td>Tue Jun 14 19:16:15 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @gvicks: Neither happiness nor sadness is sold anywhere, but we still misunderstand and hope that the solution to them is sold somewhere‚Ä¶</td>
                                                </tr>
                                                <tr><td>Thu Jun 02 17:33:28 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @stanleybehrman: I am &quot;nothing surprises me anymore&quot; years old.</td>
                                                </tr>
                                                <tr><td>Thu Jun 02 17:33:04 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @tender_game: You cant just &quot;unlove&quot; someone.</td>
                                                </tr>
                                                <tr><td>Thu Jun 02 17:32:23 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: Being honest to others is easy. <br/>Difficult is to be honest to yourself.</td>
                                                </tr>
                                                <tr><td>Thu Jun 02 17:32:13 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: Childhood ~ The times in our life when everything was just simple.</td>
                                                </tr>
                                                <tr><td>Sat May 21 18:18:26 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @parekhit: Life is bizarre. And beautiful. And everything in between.</td>
                                                </tr>
                                                <tr><td>Fri May 20 11:51:47 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @parekhit: Perfection is a state of mind</td>
                                                </tr>
                                                <tr><td>Fri May 20 11:49:27 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @parekhit: We spend lots of time telling others what we want, but very little time listening to what they want</td>
                                                </tr>
                                                <tr><td>Fri May 20 11:48:59 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @parekhit: Unfortunately, people are not what they makes us think they are. <br/><br/>Sometimes, they are way better!</td>
                                                </tr>
                                                <tr><td>Mon May 16 11:45:31 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @TerseLilts: Making somebody feel beautiful can never go out of fashion.</td>
                                                </tr>
                                                <tr><td>Sun May 15 20:15:22 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: Nothing can be more magical than being understood without having to explain.</td>
                                                </tr>
                                                <tr><td>Fri May 13 21:06:17 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @PoemPorns: ‚ÄúSometimes it feels better not to talk. At all. About anything. To anyone.‚Äù</td>
                                                </tr>
                                                <tr><td>Fri May 13 21:05:56 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @ImWhoooIm: Life is good but the expectations are what makes life miserable.......</td>
                                                </tr>
                                                <tr><td>Thu May 12 18:22:59 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @parekhit: One of the most difficult thing is reading your own mind. And we think we have mastered the art of reading others.</td>
                                                </tr>
                                                <tr><td>Wed May 11 19:27:49 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @gvicks: We all make choices, but the most difficult part is to live with them.</td>
                                                </tr>
                                                <tr><td>Mon May 09 10:36:09 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @Shakti_Shetty: The most important thing is to become a kind(er) person.</td>
                                                </tr>
                                                <tr><td>Mon May 09 10:34:16 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @Shakti_Shetty: As humans, we keep changing and so do our feelings. If you or i change, let&#39;s remind each other what we were once and ho‚Ä¶</td>
                                                </tr>
                                                <tr><td>Sat May 07 16:55:15 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @LostFelicia: Sometimes we have to let ourselves be sad and know we&#39;re better than this and bigger than this.. in order to move forward.‚Ä¶</td>
                                                </tr>
                                                <tr><td>Fri May 06 03:06:14 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @MyPornKhan: So often we are so busy handling life that we forget to actually live it.</td>
                                                </tr>
                                                <tr><td>Wed May 04 18:40:33 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @Kimgee8: We are all simply trying to get that slice of happiness anywhere we could. It makes living livable.</td>
                                                </tr>
                                                <tr><td>Wed Apr 27 12:14:53 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @DearYouFromWe: everyday I&#39;m growing. everyday I&#39;m evolving. i wanna keep learning me. i wanna continue molding into the person I&#39;m supp‚Ä¶</td>
                                                </tr>
                                                <tr><td>Mon Apr 25 18:53:09 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @gvicks: Our mind is like some days when you can&#39;t see the brightest star in the sky &amp; some days when you can even see the dimmest star‚Ä¶</td>
                                                </tr>
                                                <tr><td>Sun Apr 24 11:09:15 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @DearYouFromWe: having high expectations out of people doesn&#39;t make u dependent - it makes u selective. you have every right to expect t‚Ä¶</td>
                                                </tr>
                                                <tr><td>Sun Apr 24 11:09:02 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @DearYouFromWe: love hard. bring out the best in everyone around you. show people the places within themselves that make them the most b‚Ä¶</td>
                                                </tr>
                                                <tr><td>Sun Apr 24 11:06:21 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @DearYouFromWe: you deserve these kind of people. https://t.co/Kvro1KBpdg</td>
                                                </tr>
                                                <tr><td>Sun Apr 24 11:06:16 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @DearYouFromWe: Ì†ºÌººÌ†ºÌººÌ†ºÌººÌ†ºÌºº https://t.co/F0pYJ5mcjT</td>
                                                </tr>
                                                <tr><td>Thu Apr 21 08:35:59 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @gvicks: Sometime we should buy things when we don&#39;t even want them, just because they are sold by a person, who has a self-respect not‚Ä¶</td>
                                                </tr>
                                                <tr><td>Wed Apr 20 19:41:40 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @PoemPorns: https://t.co/ai7SW6Nu5M</td>
                                                </tr>
                                                <tr><td>Wed Apr 20 19:28:19 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @onlywreckage: everyday you&#39;ll fall apart &amp; everyday you&#39;ll piece yourself into something new &amp; this is how you&#39;ll survive</td>
                                                </tr>
                                                <tr><td>Wed Apr 20 19:01:31 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @onlywreckage: she&#39;s down to earth but she&#39;s got her head in the clouds. she&#39;s beautiful.</td>
                                                </tr>
                                                <tr><td>Wed Apr 20 19:01:14 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: Being nice to someone when you have no reason to be.<br/><br/>Now that&#39;s some quality!</td>
                                                </tr>
                                                <tr><td>Mon Apr 18 19:13:11 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @PoemPorns: https://t.co/rm5bsxJg65</td>
                                                </tr>
                                                <tr><td>Mon Apr 11 12:33:59 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @DearYouFromWe: don&#39;t be afraid to hurt. don&#39;t be afraid to feel. don&#39;t shut down or bottle in your emotions - it&#39;s okay to not be okay.‚Ä¶</td>
                                                </tr>
                                                <tr><td>Mon Apr 11 12:28:25 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @wearePhat: Happiness is https://t.co/dqlufuU0wz</td>
                                                </tr>
                                                <tr><td>Sat Apr 09 07:32:43 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @gvicks: Half the world is made of people who have something to say &amp; can&#39;t, and the other half who have nothing to say, but they keep o‚Ä¶</td>
                                                </tr>
                                                <tr><td>Fri Apr 08 17:53:49 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: Some people love you so much that you can&#39;t even understand why.</td>
                                                </tr>
                                                <tr><td>Thu Apr 07 18:28:40 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: When differences start complementing and completing us, a beautiful relationship is born.</td>
                                                </tr>
                                                <tr><td>Thu Apr 07 18:27:36 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: There are some really nice people who give you this lovely feeling and leave you smiling, always.</td>
                                                </tr>
                                                <tr><td>Tue Apr 05 06:23:31 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @ednotsowise: Why change yourself to win someone&#39;s heart. <br/>Stay true and you&#39;ll find someone who likes you for being you</td>
                                                </tr>
                                                <tr><td>Tue Apr 05 06:22:11 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @gvicks: Soul that shines through simplicity is the one everyone is drawn to...</td>
                                                </tr>
                                                <tr><td>Mon Mar 28 19:32:03 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @FarahKhanAli: Sometimes I think listening to music just transports you to another world. Music is made for the soul !</td>
                                                </tr>
                                                <tr><td>Mon Mar 28 19:24:49 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @FarhanaFarook: Some amusement, some addiction, some ambition... Some madness is essential to remain sane.</td>
                                                </tr>
                                                <tr><td>Mon Mar 28 10:31:17 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @gvicks: Time &amp; again terrorists demonstrate that they don&#39;t belong to any religion,country or race but to a deranged mind of their own ‚Ä¶</td>
                                                </tr>
                                                <tr><td>Fri Mar 11 18:57:40 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @Kauaibride: anger is time stolen from happiness.</td>
                                                </tr>
                                                <tr><td>Fri Mar 11 18:56:53 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @sajitharaghu: So much to look around and appreciate and we all spend much of our time looking at the phone screens instead!</td>
                                                </tr>
                                                <tr><td>Mon Mar 07 19:55:04 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @SufficientCharm: The best men are the ones that make you fall in love with yourself while you&#39;re falling for them.</td>
                                                </tr>
                                                <tr><td>Mon Mar 07 19:03:34 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: Those special people who know just the right thing to say to make you smile are a blessing.</td>
                                                </tr>
                                                <tr><td>Mon Mar 07 19:01:38 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @filterkaapii: Sometimes you wanna learn so many things, quickly. <br/>But learning takes time. Consistency makes the difference.</td>
                                                </tr>
                                                <tr><td>Mon Mar 07 18:58:23 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @McGunnersite: It&#39;s crazy how much you&#39;ll tolerate for someone you care about.</td>
                                                </tr>
                                                <tr><td>Mon Mar 07 18:58:15 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @EnthonyRobbins: Be judgemental on your ownself than on others, so that you know when you&#39;re wrong.</td>
                                                </tr>
                                                <tr><td>Sun Feb 28 18:07:44 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @SureshMKothari: Life is a constant conflict between affection and ego.<br/>Affection always wants to say sorry while Ego wants to hear sorr‚Ä¶</td>
                                                </tr>
                                                <tr><td>Wed Feb 10 19:09:26 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: How do people get bored when there are so many books to be read!</td>
                                                </tr>
                                                <tr><td>Fri Feb 05 21:23:00 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @Prince_Madness1: Good people with beautiful<br/>loving hearts and honest<br/>souls....<br/><br/>....do not have strings attached<br/>to their intentions, a‚Ä¶</td>
                                                </tr>
                                                <tr><td>Fri Feb 05 17:31:47 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: Beautiful are the people who can make others feel good about themselves.</td>
                                                </tr>
                                                <tr><td>Fri Feb 05 17:30:26 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @MWaseemWassi: Life sometimes takes you to believe in some fairy tales.</td>
                                                </tr>
                                                <tr><td>Thu Feb 04 13:16:29 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @gvicks: Life&#39;s joys are in the sweet little gestures of love and respect for our fellow beings. And in giving, not usurping. Not in mon‚Ä¶</td>
                                                </tr>
                                                <tr><td>Tue Feb 02 11:51:00 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @Calvinn_Hobbes: Sitting by a nice warm fire! https://t.co/LX1WDwmt6g</td>
                                                </tr>
                                                <tr><td>Sat Jan 30 08:48:27 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: Beautiful is the kind of relationship where difference of opinion is just an opinion and nothing else.</td>
                                                </tr>
                                                <tr><td>Sat Jan 30 08:48:17 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: Being happy is not about proving it to others how happy you are. <br/><br/>It&#39;s all about how happy you feel within.</td>
                                                </tr>
                                                <tr><td>Thu Jan 28 06:13:24 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @Shakti_Shetty: The idea is to be there for your parents when they need to be raised.</td>
                                                </tr>
                                                <tr><td>Wed Jan 27 19:30:20 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @MWaseemWassi: You are the person that makes me believe that the magic happens in a smile.</td>
                                                </tr>
                                                <tr><td>Mon Jan 25 17:52:44 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @_harukimurakami: If something is important enough, a little mistake isn‚Äôt going to ruin it all, or make it vanish.</td>
                                                </tr>
                                                <tr><td>Mon Jan 25 11:39:47 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @eeedennn: We often want it so badly that we ruin it before it begins. Overthinking. Fantasizing. Imagining. Expecting. Worrying. Doubti‚Ä¶</td>
                                                </tr>
                                                <tr><td>Sun Jan 24 05:05:38 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @sajitharaghu: And sometimes, just like that we run out of words.</td>
                                                </tr>
                                                <tr><td>Sun Jan 24 05:03:44 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @sajitharaghu: When your ego wins, you lose.</td>
                                                </tr>
                                                <tr><td>Sun Jan 24 05:02:41 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: How beautifully the waves kiss the shore every time they meet.</td>
                                                </tr>
                                                <tr><td>Fri Jan 22 19:05:55 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @honeybadgerMel: Sometimes, you just need a little something more.</td>
                                                </tr>
                                                <tr><td>Fri Jan 22 19:03:05 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @Ra_Bies: Share your joy, share your sorrow too but fight your battle alone</td>
                                                </tr>
                                                <tr><td>Fri Jan 22 19:02:53 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @iamoppose: We could spend our whole lives worrying about what other people think of us, but it wouldn‚Äôt get us anywhere.</td>
                                                </tr>
                                                <tr><td>Wed Jan 20 11:25:47 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @FarahKhanAli: Sometimes not having the time is a great way of keeping away from negative thoughts and fears. Thank you God Ì†ΩÌπèÌ†ΩÌπèÌ†ΩÌπè</td>
                                                </tr>
                                                <tr><td>Fri Jan 15 10:19:10 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @__azar: we all are different kinds of tired.</td>
                                                </tr>
                                                <tr><td>Thu Jan 14 08:45:38 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @MeeraKhushi: Khamosh bethay hain to log kehtay hain udaasi achi nahi..<br/>Zara sa hans lein to log muskurane ki wajah pooch lete hain..!</td>
                                                </tr>
                                                <tr><td>Tue Jan 12 18:38:28 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @sajitharaghu: Some people are not very good with putting their feeling into words but doesn&#39;t mean they love any less.</td>
                                                </tr>
                                                <tr><td>Tue Jan 12 18:38:05 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: I celebrate the woman I am, whether you like my choices or not.</td>
                                                </tr>
                                                <tr><td>Mon Jan 11 18:24:04 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @gvicks: Flute is a hollow bamboo, makes music &amp; feeds our soul. Sometime emptiness brings transformation, co&#39;s old must be emptied for ‚Ä¶</td>
                                                </tr>
                                                <tr><td>Sun Jan 10 13:03:37 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @gvicks: We should have libraries around the world where one can check out humans as living books &amp; listen to their stories.</td>
                                                </tr>
                                                <tr><td>Sat Jan 09 21:15:40 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @sajitharaghu: Do what you love <br/>Enjoy it to the hilt<br/>Dress really well<br/>Stay happy<br/>Spread smiles<br/>Dream big<br/>Sleep well<br/><br/>Life is a celebra‚Ä¶</td>
                                                </tr>
                                                <tr><td>Sat Jan 09 20:22:52 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @wordstionary: Sometimes. http://t.co/1FrToocxyw</td>
                                                </tr>
                                                <tr><td>Sat Jan 09 16:27:57 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @ImWhoooIm: Yes... :)) https://t.co/YqalZZNdZQ</td>
                                                </tr>
                                                <tr><td>Sat Jan 09 16:27:16 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @envydatropic: Maybe it&#39;s PMS, maybe I really like chocolate<br/><br/>I DON&#39;T KNOW</td>
                                                </tr>
                                                <tr><td>Sat Jan 09 15:05:04 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @redwine_chic: Sometimes we don&#39;t say what we feel, not because we don&#39;t want to, but because we don&#39;t know how</td>
                                                </tr>
                                                <tr><td>Mon Nov 23 18:37:30 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @gvicks: Best way to ease your tension is to close your eyes, meditate and say &#39;screw you world&#39;.</td>
                                                </tr>
                                                <tr><td>Sun Nov 22 14:50:03 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>RT @MindsConsole: When you really miss someone, you miss the little things the most, like just laughing together.</td>
                                                </tr>
                                                <tr><td>Sun Nov 22 14:49:28 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @gvicks: We fall in love with people we can&#39;t have..</td>
                                                </tr>
                                                <tr><td>Sun Nov 08 06:48:30 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @gvicks: As we grow older, we will still do foolish things but with much more enthusiasm</td>
                                                </tr>
                                                <tr><td>Wed Nov 04 09:07:17 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @Shakti_Shetty: Are you a massive fan of random happiness too?</td>
                                                </tr>
                                                <tr><td>Thu Oct 29 22:06:24 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @Love_bug1016: Be with the one who adores your silliness as much as your sexiness.</td>
                                                </tr>
                                                <tr><td>Thu Oct 29 10:55:42 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>RT @gvicks: The most hated headlines are wrinkles......</td>
                                                </tr>
                                                <tr><td>Thu Oct 29 10:55:23 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @gvicks: Isn&#39;t everything we do in life a way to be loved a little more?.......</td>
                                                </tr>
                                                <tr><td>Wed Oct 14 18:09:43 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>RT @gvicks: Some mistakes are too much fun to make only once....</td>
                                                </tr>
                                                <tr><td>Sun Oct 11 10:56:04 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>RT @gvicks: There are times, when one feels just good not to talk. At all. About anything. To anyone.........</td>
                                                </tr>
                                                <tr><td>Thu Oct 08 09:57:19 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Soberphobiccc: What do you do with your unexpressed emotions?</td>
                                                </tr>
                                                <tr><td>Thu Oct 08 09:56:47 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @mayankluv70: Some relationships just can&#39;t be explained.<br/>They just exist.</td>
                                                </tr>
                                                <tr><td>Thu Oct 08 09:55:54 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Bloodshot_Ink: share what you feel when you&#39;re sure about your own feelings, instead of expecting yourself to be ready for it.</td>
                                                </tr>
                                                <tr><td>Thu Oct 08 09:55:47 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @TinaMav: Be kind. Love. Accept. Forgive. In the end, it won&#39;t matter if you won or if you were right.. you&#39;ll only be left with how you‚Ä¶</td>
                                                </tr>
                                                <tr><td>Sat Jun 27 18:40:54 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @miffalicious: Today I&#39;ve been reminded how attractive, how absolutely attractive, kindness is.</td>
                                                </tr>
                                                <tr><td>Sat Jun 27 18:40:38 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @miffalicious: You know what is the best thing about life? <br/>It is everywhere; there is no lack of it.</td>
                                                </tr>
                                                <tr><td>Sat Jun 27 15:28:02 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @miffalicious: &quot;People grow when they are loved well. If you want to help others heal, love them without an agenda.&quot;</td>
                                                </tr>
                                                <tr><td>Tue May 19 10:26:43 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @awk_doc: Need to fall in love again,<br/><br/>This website is not accepting my old password.</td>
                                                </tr>
                                                <tr><td>Sun May 17 09:08:15 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @awk_doc: From overeating to oversleeping,<br/>Sunday taught me everything.</td>
                                                </tr>
                                                <tr><td>Mon May 04 07:43:30 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @RenuSelfie: That‚Äôs why love is madness. It‚Äôs too easy to lose your mind when you lose your heart.</td>
                                                </tr>
                                                <tr><td>Mon May 04 07:43:15 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @RenuSelfie: Don&#39;t make anyone your world. Just make that special someone a part of your world.</td>
                                                </tr>
                                                <tr><td>Thu Apr 30 20:21:45 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Quartzjixler: &quot;I wonder how many Mini Kit Kats I can fit in my mouth?&quot;<br/><br/>- Me, every time I open the bag of Mini Kit Kats.</td>
                                                </tr>
                                                <tr><td>Mon Apr 27 18:04:27 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @its_possible__: I&#39;ve learned to forgive. <br/><br/>Sometimes... everyday.</td>
                                                </tr>
                                                <tr><td>Mon Apr 27 18:04:19 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>RT @its_possible__: She only cries when she feels her grip on life slipping.</td>
                                                </tr>
                                                <tr><td>Mon Apr 27 18:04:08 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @its_possible__: I didn&#39;t &quot;fall&quot; in love with you, I intentionally gave you my heart.</td>
                                                </tr>
                                                <tr><td>Sun Apr 26 14:23:59 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @SteveStfler: A woman saying ‚ÄúI‚Äôm not mad at you‚Äù is like a dentist saying ‚ÄúYou won‚Äôt feel a thing.‚Äù</td>
                                                </tr>
                                                <tr><td>Thu Apr 23 19:34:32 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: The idea is to grow old together if growing up together is too much to ask for.</td>
                                                </tr>
                                                <tr><td>Thu Apr 23 19:31:13 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @ella__fraser: Someone that changes the way you think for the better, is someone that leaves a mark on you that will never be erased</td>
                                                </tr>
                                                <tr><td>Thu Apr 23 19:31:01 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @jeffrhood: Find someone that makes you want to be a better person every day, but loves you for the person you already are....</td>
                                                </tr>
                                                <tr><td>Tue Apr 21 09:55:41 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @moonsez: I smiled at someone. The person didn&#39;t smile back. I want to unsmile my smile now.</td>
                                                </tr>
                                                <tr><td>Tue Apr 21 09:46:48 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @Shakti_Shetty: The beauty of time lies in the fact that it remains blissfully young despite dying every passing moment.</td>
                                                </tr>
                                                <tr><td>Mon Apr 20 11:39:42 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @parupaaj: Life is too short to wonder if it&#39;s love or lust. If it feels good it&#39;s love.</td>
                                                </tr>
                                                <tr><td>Wed Apr 15 06:50:15 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @twinitisha: People who make others feel special are really the special ones.Ì†ΩÌ≤ú</td>
                                                </tr>
                                                <tr><td>Fri Apr 10 21:04:17 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @slyoung5: Everyone&#39;s definition of forever is different. To some it&#39;s a milli-second and to others it&#39;s a million years.</td>
                                                </tr>
                                                <tr><td>Fri Apr 10 20:59:54 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @vishasuchde: Somedays I take too long warming up to a morning. It tries it&#39;s best to get me there, then gets fed up and goes away.</td>
                                                </tr>
                                                <tr><td>Fri Apr 10 20:47:31 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @vishasuchde: When I run out of ways to say &quot;I&#39;m not interested&quot;, I run.</td>
                                                </tr>
                                                <tr><td>Fri Apr 10 20:44:39 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @vishasuchde: Procrastinating goodbyes.</td>
                                                </tr>
                                                <tr><td>Fri Apr 10 20:44:00 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @vishasuchde: http://t.co/1rZ17CQYNY</td>
                                                </tr>
                                                <tr><td>Fri Apr 10 20:43:01 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>RT @vishasuchde: Shunning negativity doesn&#39;t mean you&#39;ll always stay positive. It just means you&#39;ll allow negativity to pass as quickly as ‚Ä¶</td>
                                                </tr>
                                                <tr><td>Thu Apr 09 20:53:53 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @PoemPorns: http://t.co/cW95aN1evI</td>
                                                </tr>
                                                <tr><td>Thu Apr 09 20:40:08 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @mattZillaaaa: The more you chase a butterfly the more elusive it becomes. Yet when you&#39;re still it lights in the palm of your hand.</td>
                                                </tr>
                                                <tr><td>Tue Apr 07 15:11:56 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @mayankluv70: A great attitude becomes a great mood, which becomes a great day, which becomes a great year, which becomes a great life.</td>
                                                </tr>
                                                <tr><td>Sun Apr 05 07:29:35 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @DrMiaRose: As life speeds up, you need to slow down. Make time for what matters. Fill your life with things that bring you joy. http://‚Ä¶</td>
                                                </tr>
                                                <tr><td>Tue Mar 24 19:51:17 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @TerseLilts: Expectation. Probably not a soulmate of hope but certainly an always accompanying partner.</td>
                                                </tr>
                                                <tr><td>Tue Mar 24 14:31:27 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @Amiigat: An act of kindness, however small, speaks loudly.</td>
                                                </tr>
                                                <tr><td>Tue Mar 24 14:31:12 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @LuvPug: Sometimes you need to be reminded that it&#39;s okay to not be okay, but it will be okay.</td>
                                                </tr>
                                                <tr><td>Tue Mar 24 06:53:45 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>RT @parekhit: She wasn&#39;t mad because he didn&#39;t care anymore. She was mad because when he did, she was blinded. By her ego.</td>
                                                </tr>
                                                <tr><td>Tue Mar 24 06:53:18 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @AhrSays: How long is forever...??<br/><br/>Sometimes, <br/>just one second...!!</td>
                                                </tr>
                                                <tr><td>Tue Mar 24 06:01:05 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @WordsTexts: ‚ÄúForever with you isn‚Äôt long enough.‚Äù</td>
                                                </tr>
                                                <tr><td>Mon Mar 23 18:55:27 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @JustLikeMikee: Thankfully there are many forevers in a lifetime.</td>
                                                </tr>
                                                <tr><td>Mon Mar 23 18:53:27 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @BrownBoxers: An intelligent conversation is my biggest aphrodisiac...</td>
                                                </tr>
                                                <tr><td>Sun Mar 22 09:51:12 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>RT @5exyunchained: All I want to say tonight is, I miss you.<br/>Poetry be damned.</td>
                                                </tr>
                                                <tr><td>Sun Mar 22 09:50:59 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @5exyunchained: Everything that is done in the world is done by hope.</td>
                                                </tr>
                                                <tr><td>Sun Mar 22 02:13:42 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>RT @parekhit: We fall, we rise, we make mistakes, we lived through them, we have been hurt, but we are alive. And thankful because of that.</td>
                                                </tr>
                                                <tr><td>Mon Mar 16 15:21:39 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: We keep telling others we don&#39;t give a damn but that isn&#39;t the truth. We always care whether we like it or not. That&#39;s w‚Ä¶</td>
                                                </tr>
                                                <tr><td>Mon Mar 16 15:18:30 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: Stop flattering yourself. Insomnia has nothing to do with your being awake.</td>
                                                </tr>
                                                <tr><td>Mon Mar 16 15:18:09 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: &quot;Humne dekhi hain inn aankhon ki mahekti khushboo, haath se chhuke ise rishton kaa ilzaam na do...&#39; - Gulzar</td>
                                                </tr>
                                                <tr><td>Mon Mar 16 15:17:40 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @Shakti_Shetty: Never say no to chocolate for two reasons:<br/>1. It&#39;s chocolate.<br/>2. It&#39;s chocolate.</td>
                                                </tr>
                                                <tr><td>Mon Mar 16 15:16:53 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: Never underestimate the power of ignoring.</td>
                                                </tr>
                                                <tr><td>Sun Mar 15 20:14:48 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @PoemPorns: . http://t.co/kkjAg06dCM</td>
                                                </tr>
                                                <tr><td>Sat Mar 14 12:51:15 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @silent_musings: Silly things make life far more interesting.</td>
                                                </tr>
                                                <tr><td>Sat Mar 14 12:45:22 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @RichHarris2: Everyone should have someone to write beautiful words about them.</td>
                                                </tr>
                                                <tr><td>Sat Mar 14 12:42:15 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @Blinkingeyesss: The happiness of your life depends on the quality of your thoughts.</td>
                                                </tr>
                                                <tr><td>Sat Mar 14 12:41:27 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @_ImWashim_: Live for moments you can&#39;t put into Words.</td>
                                                </tr>
                                                <tr><td>Sat Mar 14 12:38:40 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @vapidaccount: Somedays it&#39;s the simple joy of being understood without having to try to make them understand.</td>
                                                </tr>
                                                <tr><td>Sat Mar 14 12:36:29 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @50ShadesGran: She slowly licked her lips, slowly undid the buttons of her blouse and slowly lay back on the bed. She did everything slo‚Ä¶</td>
                                                </tr>
                                                <tr><td>Sat Mar 14 12:36:14 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @HarrdiiiK: sometimes words are not enough to make someone feel that we care for them sometimes it needs a little effort to convince the‚Ä¶</td>
                                                </tr>
                                                <tr><td>Fri Mar 06 17:41:12 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: There&#39;s a little bit of everything in what you are right now.</td>
                                                </tr>
                                                <tr><td>Thu Mar 05 16:59:44 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Ray_stephan: Forever is never enough.</td>
                                                </tr>
                                                <tr><td>Sun Mar 01 13:46:48 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @electrosurbhi: Kisses on forehead<br/>Long gdbyes &amp; Tight hugs<br/>Holding hands &amp; long stares<br/>Silence that isn&#39;t awkward<br/>&amp; waking up beside U<br/>‚Ä¶</td>
                                                </tr>
                                                <tr><td>Fri Feb 27 19:40:43 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @gvicks: Raise your standard of giving, if God raised your standard of living..</td>
                                                </tr>
                                                <tr><td>Mon Feb 23 16:29:48 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @Shakti_Shetty: When in love, do stupid things. When in stupid, do lovely things.</td>
                                                </tr>
                                                <tr><td>Wed Feb 18 09:57:22 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @Jan_Dhan: When you like a flower, you just pluck it; when you love a flower, you water it daily. One who understands this , understands‚Ä¶</td>
                                                </tr>
                                                <tr><td>Thu Feb 12 19:18:10 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: I have a dream too...of sleeping like i once used to!</td>
                                                </tr>
                                                <tr><td>Thu Feb 12 19:16:37 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @aanchalator: Lafz kehne walon ka kuch nahin jata, Faraz..<br/>Lafz sehne wale kamaal karte hain..</td>
                                                </tr>
                                                <tr><td>Sat Jan 24 15:12:12 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Miister_H: Men are like mascara, they usually run at the first sign of emotion.</td>
                                                </tr>
                                                <tr><td>Wed Jan 14 21:40:05 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @funnyortruth: http://t.co/slPxCqKQoR</td>
                                                </tr>
                                                <tr><td>Mon Dec 22 18:32:40 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: We seek those who complete us as they unwittingly hold those missing pieces.</td>
                                                </tr>
                                                <tr><td>Sun Dec 21 21:37:37 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: Funny how everyone&#39;s busy but hardly anything is getting done.</td>
                                                </tr>
                                                <tr><td>Sun Dec 21 21:34:40 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: Tip: Khush raho.</td>
                                                </tr>
                                                <tr><td>Tue Dec 16 06:50:53 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: The most interesting are the ones who are hurt and yet raring to make it one day at a time.</td>
                                                </tr>
                                                <tr><td>Tue Dec 16 06:40:15 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: As you grow older, your flaws become more comfortable with you. Not vice versa.</td>
                                                </tr>
                                                <tr><td>Sun Dec 14 14:39:09 +0000 2014</td>
                                                <td> </td>
                                                <td>RT @NicoAspeling: we&#39;re all addicted to something that helps eases away the pain</td>
                                                </tr>
                                                <tr><td>Sun Dec 14 14:15:46 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @itzruj: We all have that one person for whom we can give it all up.</td>
                                                </tr>
                                                <tr><td>Sun Dec 14 14:15:38 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @TweetTheDude: there&#39;s a difference between loving her &#39;cause she&#39;s beautiful and her being beautiful &#39;cause you love her.</td>
                                                </tr>
                                                <tr><td>Wed Dec 10 14:19:35 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>RT @TheAlexP: What do you do when your heart wants what your brain knows is wrong?</td>
                                                </tr>
                                                <tr><td>Wed Dec 10 14:18:50 +0000 2014</td>
                                                <td> </td>
                                                <td>RT @TheAlexP: When you can be absolutely silly with them and know they are the same...<br/><br/>There&#39;s really nothing better.</td>
                                                </tr>
                                                <tr><td>Tue Dec 09 06:09:20 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @sweetg35: When you don‚Äôt know where to start, just go to a place you miss so much.</td>
                                                </tr>
                                                <tr><td>Mon Dec 08 17:58:37 +0000 2014</td>
                                                <td> </td>
                                                <td>RT @writerPT: You care and you care and you care, and you hurt and you hurt and you hurt. But then you get mad...<br/><br/>And then you don&#39;t.</td>
                                                </tr>
                                                <tr><td>Mon Dec 08 17:57:30 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>RT @moonlightglow4: I&#39;m attracted to beautiful minds with beautiful souls and beautiful hearts to match..</td>
                                                </tr>
                                                <tr><td>Sat Dec 06 21:30:15 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>RT @TheAlexP: If tomorrow was your last day,<br/>Would you have loved with all your heart,<br/>Lived all the moments,<br/>And made the memories last...</td>
                                                </tr>
                                                <tr><td>Wed Dec 03 10:39:55 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @VB_P: You are braver than you believe. Stronger than you seem &amp; smarter than you think.</td>
                                                </tr>
                                                <tr><td>Mon Dec 01 13:16:32 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>RT @OkieGirl405: I&#39;m older, wiser and still make the same stupid mistakes. <br/><br/>Your move life!</td>
                                                </tr>
                                                <tr><td>Mon Dec 01 12:22:20 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @gvicks: Monday is just like the rest of the week, if you hate waking up in the mornings</td>
                                                </tr>
                                                <tr><td>Sun Nov 30 18:39:19 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>RT @MadelinaT: Moments are just moments...don&#39;t let those moments become days that control your life.</td>
                                                </tr>
                                                <tr><td>Sun Nov 30 18:39:01 +0000 2014</td>
                                                <td>Neutral </td>
                                                <td>RT @sass_slinger: There&#39;s a lot of good feelings to be had in this world. But my favourite by far, is feeling loved.</td>
                                                </tr>
                                                <tr><td>Sun Nov 30 18:38:50 +0000 2014</td>
                                                <td>Negative</td>
                                                <td>RT @sass_slinger: Words can make you laugh, cry, feel alive, or want to die.<br/><br/>Now tell me again how they&#39;re &#39;just&#39; words.</td>
                                                </tr>
                                                <tr><td>Sun Nov 30 11:36:32 +0000 2014</td>
                                                <td>Negative</td>
                                                <td>RT @GaziMumbai: Mujhe maloom hai ke ye khwaab jhoote hain, aur khwahishein adhoori hain .. Magar zinda rehne ke liye, kuch ghalat fehmiyan ‚Ä¶</td>
                                                </tr>
                                                <tr><td>Sun Nov 30 11:35:42 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>RT @WotDLuck: Some journeys are so beautiful, you just want to abandon the destination.</td>
                                                </tr>
                                                <tr><td>Sat Nov 29 05:41:33 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: The clear distinction between looking beautiful and feeling beautiful.</td>
                                                </tr>
                                                <tr><td>Sat Nov 29 05:40:46 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: Just because you&#39;re wearing earphones doesn&#39;t mean the whole world is enjoying music.</td>
                                                </tr>
                                                <tr><td>Thu Nov 27 06:00:57 +0000 2014</td>
                                                <td> </td>
                                                <td>RT @iCatty1: There are two types of people who are failures in life‚Ä¶ <br/>1. Those who do not listen to anybody.<br/> 2. And those who listen to ev‚Ä¶</td>
                                                </tr>
                                                <tr><td>Thu Nov 27 04:45:59 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>RT @RichHarris2: We all need to feel something extraordinary. A touch where our imagination meets our memories.</td>
                                                </tr>
                                                <tr><td>Thu Nov 27 04:41:27 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>RT @Kuhu_bole: &quot;Umr bhi..<br/>Lakeerein bhi..<br/>Daraarein bhi.. Tum<br/><br/>Khawaaish bhi..<br/>Pehli bhi..<br/>Aakhiri bhi.. Tum&quot; by @Sai_ki_bitiya :) :) #Be‚Ä¶</td>
                                                </tr>
                                                <tr><td>Sat Nov 15 17:57:05 +0000 2014</td>
                                                <td> </td>
                                                <td>RT @iRealMacklemore: Live, Love, Laugh and enjoy each moment of your life.</td>
                                                </tr>
                                                <tr><td>Sat Nov 08 03:37:13 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @AshwiniDodani: The most important learning of life is how and when you should stop asking for what you actually deserve.</td>
                                                </tr>
                                                <tr><td>Sat Nov 08 03:37:00 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: We&#39;ll be at peace when we become one with the opinion that opinions don&#39;t really matter.</td>
                                                </tr>
                                                <tr><td>Sat Nov 08 03:36:49 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @Shakti_Shetty: More than anything else, life is meant to be shared.</td>
                                                </tr>
                                                <tr><td>Sat Nov 08 03:33:44 +0000 2014</td>
                                                <td>Positive</td>
                                                <td>RT @LoveNLunchmeat: Sometimes the monsters win because you let them.</td>
                                                </tr>
                                                <tr><td>Sat Nov 08 03:32:49 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @_Philophobic_: Happiness is when you know there are still<br/>some people who just don&#39;t give up on you!!</td>
                                                </tr>
                                                <tr><td>Sat Nov 08 03:32:26 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @_Philophobic_: Sometimes, all you can do is lie in bed, and<br/>hope to fall asleep before you fall apart.</td>
                                                </tr>
                                                <tr><td>Fri Nov 07 07:51:56 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @PoemPorns: Sometimes there is no next time, no second chance, no time out. Sometimes it is now or never.</td>
                                                </tr>
                                                <tr><td>Fri Nov 07 07:40:51 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @MirchiLaddoo: Can I have your heart? Mine keeps beating for you. ^_^</td>
                                                </tr>
                                                <tr><td>Fri Nov 07 07:38:48 +0000 2014</td>
                                                <td>Neutral </td>
                                                <td>RT @funnyortruth: Don&#39;t try to understand everything. Sometimes it is not meant to be understood, just accepted.</td>
                                                </tr>
                                                <tr><td>Fri Nov 07 05:39:40 +0000 2014</td>
                                                <td>Neutral</td>
                                                <td>RT @Love_bug1016: Whether it be funny or serious, people bare their souls through their tweets and it&#39;s a beautiful gift we get to read.</td>
                                                </tr>
                                                </tbody></table>
                                                
                                                <div id="piechart2" style="width: 100%; height: 400px;"></div>
                                                
                            <h3 style="font-weight: bold;     text-align: center;">Shameel Mazhar</h3>
                                                <table style=" width: 80% !important; margin-left: auto; margin-right: auto;" id="thirdTable" class="table table-bordered table-hover table-condensed">
                                                <tbody><tr><td style="font-weight: bold;">Timestamp</td>
                                                <td style="font-weight: bold;">Sentiment</td>
                                                <td style="font-weight: bold;">Tweet</td>
                                                </tr>
                                                <tr><td>Thu Jun 30 11:16:47 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>Distance Is a State ofÔøΩMind https://t.co/PaGnx70mCH</td>
                                                </tr>
                                                <tr><td>Tue Jun 28 07:59:41 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>@PTCLOfficial Improvement in the copper wires in DHA Phase 1, Lahore? Have been overpaying for last 5-6 years for 30% or less uptime.</td>
                                                </tr>
                                                <tr><td>Tue Jun 28 06:19:21 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @Razarumi: As a tribute to the slain musician Amjad Sabri, a wall is being adorned in Pakistan v @hafi_nafees: #RIPAmjadSabri https://t.ÔøΩ</td>
                                                </tr>
                                                <tr><td>Sun Jun 26 09:02:37 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @markaustinitv: Keep hearing that 75% of 18-24 year olds voted Remain. It was 75% of the 36% who bothered to turn out. #EURef</td>
                                                </tr>
                                                <tr><td>Sat Jun 25 06:38:11 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @Independent: Second EU referendum will be considered for parliament debate as petition hits 100,000 sigs https://t.co/HFd2oXaGgF https:ÔøΩ</td>
                                                </tr>
                                                <tr><td>Sat Jun 25 06:34:50 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>@mujahidsunite little more aggression needed here</td>
                                                </tr>
                                                <tr><td>Sat Jun 25 06:31:44 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@mujahidsunite @shehryarm idk bruv, I&#39;m the worker drone here.</td>
                                                </tr>
                                                <tr><td>Wed Jun 22 11:18:15 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>Just when we thought Karachi was cleaning up its act. RIP Amjad Sabri</td>
                                                </tr>
                                                <tr><td>Wed Jun 22 11:14:17 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @ARYNEWSOFFICIAL: Amjad Sabri Shot Dead #BreakingNews https://t.co/AaoZU4nnqi</td>
                                                </tr>
                                                <tr><td>Wed Jun 22 11:12:21 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @Kashifabbasiary: Amjad sabri (qawwal) died in an attack....in shock...</td>
                                                </tr>
                                                <tr><td>Tue Jun 21 07:59:26 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>In 2014, report by Save the Children- Pakistan most first day deaths and stillbirths in the world, 40.7 per 1,000 https://t.co/MxJMVHSA1f</td>
                                                </tr>
                                                <tr><td>Mon Jun 20 09:58:11 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>Uhhhh.... such a horrible move https://t.co/3aQVBiTd2O</td>
                                                </tr>
                                                <tr><td>Sat Jun 18 10:45:18 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @ImaanZHazir: https://t.co/sy8hE1srdy</td>
                                                </tr>
                                                <tr><td>Sat Jun 18 10:44:39 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @Majid_Agha: #PPP Coordination Committee Sindh hails Govt decision to pay tribute to Sabin Mahmud, Parveen Rehman, Sultan Mahmud. https:ÔøΩ</td>
                                                </tr>
                                                <tr><td>Sat Jun 18 10:35:30 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @Independent: Donald Trump supporter horrified at facing discrimination, sees no irony whatsoever https://t.co/3WvCl3Dxy0 https://t.co/KÔøΩ</td>
                                                </tr>
                                                <tr><td>Thu Jun 16 13:08:10 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @NewsweekPak: Woman in #Multan #Pakistan throws acid on her boyfriend after he refuses to marry her https://t.co/crQGIg6P5y</td>
                                                </tr>
                                                <tr><td>Tue Jun 14 10:52:06 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @VentureBeat: Europe has gone crazy for startup accelerators, with 26 opening in 2015 https://t.co/PxI2yirgmX by @obrien https://t.co/v1ÔøΩ</td>
                                                </tr>
                                                <tr><td>Tue Jun 14 10:09:27 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @indy100: The problem with how America percieves terrorism and gun violence, in 26 words https://t.co/4eoXf8Ez2F https://t.co/xcdGRoIAWa</td>
                                                </tr>
                                                <tr><td>Tue Jun 14 10:04:40 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>@humayunmehreen @shehryarm from the Chef&#39;s table on Netflix. He does a killer &quot;Oops! I dropped the lemon tart&quot; https://t.co/77juDNsM53</td>
                                                </tr>
                                                <tr><td>Tue Jun 14 09:56:58 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @ARobertsjourno: How feeble can @realDonaldTrump become? If he can&#39;t cope with questions from Post and others, how could he possibly copÔøΩ</td>
                                                </tr>
                                                <tr><td>Tue Jun 14 09:56:14 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @Telegraph: Wales fan sleeps through Euro 2016 opener after boozy day in France https://t.co/0MVh8LkSon https://t.co/f2bcojW05j</td>
                                                </tr>
                                                <tr><td>Tue Jun 14 09:49:26 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>Don&#39;t do this unless you want to seem like a pompous ass. https://t.co/KYsowT2EtU</td>
                                                </tr>
                                                <tr><td>Tue Jun 14 09:45:20 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @TechCrunch: Why would a VC firm IPO? ÔøΩ Simon Cook of Draper Esprit explains https://t.co/8qEBZ7NGGD by @venturejedi</td>
                                                </tr>
                                                <tr><td>Mon Jun 13 10:44:36 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>Possibilities https://t.co/vbGcRPQGvN</td>
                                                </tr>
                                                <tr><td>Sat Jun 11 08:51:03 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @Entrepreneur: 5 things every business owner and entrepreneur can learn from Donald Trump -- whether you like him or not. https://t.co/jÔøΩ</td>
                                                </tr>
                                                <tr><td>Sat Jun 11 08:05:44 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @ExpressNewsPK: ?? ?? ???? ???? ??? - https://t.co/Foc4mz0feT #Nadra #Pakistan https://t.co/0SpTBZizzm</td>
                                                </tr>
                                                <tr><td>Sat Jun 11 07:57:37 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@hmazhark @Cresventures1  Interview with Humayun Mazhar https://t.co/BQw3AClZhq</td>
                                                </tr>
                                                <tr><td>Tue Jun 07 10:31:10 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @omar_quraishi: The Ehteramul Ramazan Ordinance 1981 has come into effect in Pakistan - bans eating in public during fasting hours httpsÔøΩ</td>
                                                </tr>
                                                <tr><td>Tue Jun 07 10:22:39 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @sherryrehman: Federal budget has been made by PM of Punjab, not for Pakistan, nor this century. My speech will show you exactly how #BuÔøΩ</td>
                                                </tr>
                                                <tr><td>Fri Jun 03 12:19:37 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @AFP: #BREAKING At least 104 migrant bodies washed up on Libyan beach: navy</td>
                                                </tr>
                                                <tr><td>Fri Jun 03 12:18:11 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @Newsweek: Canadian Prime Minister Justin Trudeau will legalize weed, but not smoke it https://t.co/iMJJa6wWnQ https://t.co/gR6RoU995b</td>
                                                </tr>
                                                <tr><td>Sun May 29 11:09:29 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @Independent: Italian court allows man to pay alimony to ex-wife with pizza https://t.co/OoteGK2zLh</td>
                                                </tr>
                                                <tr><td>Sat May 28 07:07:38 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>@shehryarm Good to see two United forwards picking up goals. https://t.co/hWdppXaI3E</td>
                                                </tr>
                                                <tr><td>Fri May 27 11:30:15 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @NewsweekPak: Replug: e-retailers are helping fight #Pakistan&#39;s war on counterfeit medicine https://t.co/yCL9qg57oT</td>
                                                </tr>
                                                <tr><td>Fri May 27 10:41:45 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@Cresventures1 https://t.co/dMCNXtS47Q</td>
                                                </tr>
                                                <tr><td>Fri May 27 07:39:47 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>&quot;Azerbaijan, Burundi, Cuba, Nicaragua, Pakistan, Sudan and Venezuela also voted against CPJÔøΩs application.&quot; https://t.co/RJMVf7xajS</td>
                                                </tr>
                                                <tr><td>Thu May 26 11:09:26 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>ÔøΩThereÔøΩs never been a person IÔøΩve spoken to who didnÔøΩt say, ÔøΩMy goodness I could have used this three weeks ago,&#39;ÔøΩ https://t.co/ShL67Uwkud</td>
                                                </tr>
                                                <tr><td>Fri May 20 19:40:58 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @NebojsaMalic: Secret service w rifles &amp; shotguns have blocked Penn. Ave. in front of #WhiteHouse. https://t.co/P17J8B6P6f</td>
                                                </tr>
                                                <tr><td>Fri May 20 19:39:34 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @HuffingtonPost: Shooting near White House, police say https://t.co/zTBNnYumiI https://t.co/CpAtcNeZgE</td>
                                                </tr>
                                                <tr><td>Fri May 20 07:10:44 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>Wow -minus the plastic cutlery. https://t.co/V59wKEBJKj</td>
                                                </tr>
                                                <tr><td>Fri May 20 06:59:02 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>US firearm homicide rate 20 times higher than combined rates of 22 countries with similar wealth and population  https://t.co/cGXCTxmXkD</td>
                                                </tr>
                                                <tr><td>Fri May 20 06:19:10 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @HuffingtonPost: Doctors Without Borders ditches a humanitarian summit, no longer has &quot;any hope&quot; https://t.co/bN23n0Iaet https://t.co/81ÔøΩ</td>
                                                </tr>
                                                <tr><td>Wed May 18 19:29:05 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @Benazir_Shah: Ali Haider Gilani tells the media he was kept in Faisalabad for 2 months. Shahbaz Taseer was also initially taken to FaisÔøΩ</td>
                                                </tr>
                                                <tr><td>Wed May 18 05:00:00 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@shehryarm https://t.co/Xm0HeRpfl3</td>
                                                </tr>
                                                <tr><td>Tue May 17 03:43:18 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @AP: VIDEO: Security firm head explains how he accidentally left mock bomb that triggered evacuation at UK stadium: https://t.co/3M0I0bRÔøΩ</td>
                                                </tr>
                                                <tr><td>Tue May 17 03:37:45 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @engadget: The &#39;Mr. Robot&#39; season 2 trailer is here and we have one word for you: Revolution https://t.co/XiRD5hGJXJ https://t.co/2rlrQtÔøΩ</td>
                                                </tr>
                                                <tr><td>Mon May 16 15:17:27 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>Still up in the air IMO https://t.co/w1nqKjPs5Z</td>
                                                </tr>
                                                <tr><td>Mon May 16 15:14:13 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @AFP: #BREAKING World powers ready to arm Libya unity government: statement</td>
                                                </tr>
                                                <tr><td>Mon May 16 15:04:54 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>Appalling. No form whatsoever to speak of https://t.co/qHc4FvnkLR</td>
                                                </tr>
                                                <tr><td>Mon May 16 14:58:47 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>RT @RoshanehZafar: What is shameful is that Pakistan ranks 144 out of 145 in the World Economic Forum&#39;s gender gap report. Stand up for womÔøΩ</td>
                                                </tr>
                                                <tr><td>Mon May 16 14:58:28 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @SenRehmanMalik: Sir today I request you to give it your beloved dad who will be happy to hv it and will feel proud of your decency. htÔøΩ</td>
                                                </tr>
                                                <tr><td>Mon May 09 12:26:05 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>Melatonin Sparks https://t.co/X4ABFY600h</td>
                                                </tr>
                                                <tr><td>Tue Apr 12 09:54:06 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @sameer__jain: @hmazhark: &quot;If a startup has to ask for anything from God, ask for luck. Not intelligence.&quot; @TiECON_CHD</td>
                                                </tr>
                                                <tr><td>Tue Apr 12 09:19:18 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @usmangul: Great post on @hmazhark&#39;s Angel Fund @Cresventures1 funding #startups in #Lahore https://t.co/zixoZvtt2z #gameon @shehryarm @ÔøΩ</td>
                                                </tr>
                                                <tr><td>Mon Apr 11 08:40:31 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@usmangul @Palvashits @shehryarm https://t.co/bK4AB9QKsa</td>
                                                </tr>
                                                <tr><td>Fri Apr 01 08:33:55 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>Donkey Welfare https://t.co/rqQ8BOJuvl</td>
                                                </tr>
                                                <tr><td>Tue Mar 29 15:11:32 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@mujahidsunite you didn&#39;t know I was coming that&#39;s why</td>
                                                </tr>
                                                <tr><td>Tue Mar 29 09:29:51 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@mujahidsunite damn son that&#39;s some next level trolling.</td>
                                                </tr>
                                                <tr><td>Fri Mar 25 08:04:25 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>&quot;Sometimes I can feel my bones straining under the weight of all the lives I&#39;m not living.&quot; - Jonathan Safran Foer.</td>
                                                </tr>
                                                <tr><td>Tue Mar 01 14:23:44 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>When People GetÔøΩOlder https://t.co/193S79gKJ0</td>
                                                </tr>
                                                <tr><td>Sat Feb 20 10:26:26 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>Quddus Mirza showing that he can&#39;t be a capable moderator at the #lahoreliteraryfestival</td>
                                                </tr>
                                                <tr><td>Tue Feb 09 11:21:52 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>If only steak was a vegetable- what a vegetarian I&#39;d be.</td>
                                                </tr>
                                                <tr><td>Mon Feb 08 14:27:22 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>To All My LostÔøΩLovers https://t.co/j5rg5dag2E</td>
                                                </tr>
                                                <tr><td>Tue Feb 02 12:42:13 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @TheEconomist: Bertrand Russell died #onthisday 1970. He had a profound commitment to public benevolence https://t.co/ADM0oAW3lQ https:/ÔøΩ</td>
                                                </tr>
                                                <tr><td>Tue Feb 02 12:40:53 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@parrotrana ghar ki baat hai</td>
                                                </tr>
                                                <tr><td>Tue Feb 02 12:38:30 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>Who would have thought that the #LahoreQalandars promotional truck could cause traffic jams on the canal. I thought it.</td>
                                                </tr>
                                                <tr><td>Sun Jan 31 14:55:58 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>No one ever asked a cucumber if it wanted to be a pickle.  #foodforthought #stopvegetablecruelty</td>
                                                </tr>
                                                <tr><td>Sat Jan 30 09:43:00 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>First Impressions https://t.co/BnON2VmNSw</td>
                                                </tr>
                                                <tr><td>Sat Jan 30 08:47:29 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>Oh No.. Insomnia https://t.co/7nqByNlLMZ</td>
                                                </tr>
                                                <tr><td>Fri Jan 29 18:18:32 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>On What ThereÔøΩIs https://t.co/fRrKHK8QoW</td>
                                                </tr>
                                                <tr><td>Fri Jan 29 14:39:56 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>@mishalnasir true that Holmes, screw every other philosophy</td>
                                                </tr>
                                                <tr><td>Fri Jan 29 14:05:51 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@mujahidsunite I&#39;m actually researching on this topic. Checks out</td>
                                                </tr>
                                                <tr><td>Fri Jan 29 14:04:56 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>I go to the gym so I shouldn&#39;t binge-eat = No I go to the gym so I CAN binge-eat = Yes #noshitsgiven #nobalance</td>
                                                </tr>
                                                <tr><td>Mon Jan 25 10:15:28 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>Pussycat Stole MyÔøΩVibe https://t.co/Joj7zDiPqX</td>
                                                </tr>
                                                <tr><td>Fri Jan 22 18:25:38 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@mujahidsunite screengrabs of every lewd reply you&#39;ve ever written</td>
                                                </tr>
                                                <tr><td>Fri Jan 22 18:00:13 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>@mujahidsunite lay off the booze for a minute. :)</td>
                                                </tr>
                                                <tr><td>Fri Jan 22 17:50:31 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@mujahidsunite I&#39;ll send you screenshots</td>
                                                </tr>
                                                <tr><td>Thu Jan 21 18:04:37 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>RT @mishalnasir: @Salman_ARY Would appreciate if mic volume for event at your/ARY Karachi residence could be lowered. Live close by and it ÔøΩ</td>
                                                </tr>
                                                <tr><td>Thu Jan 21 18:04:35 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>RT @mishalnasir: @Salman_ARY Also , have work tomo so would like to get some rest. Kindly convey msg to concerned ppl. And ETA would be nicÔøΩ</td>
                                                </tr>
                                                <tr><td>Fri Jan 15 17:35:28 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@ShameelMazhar @mujahidsunite</td>
                                                </tr>
                                                <tr><td>Fri Jan 15 11:18:15 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>The Battle of theÔøΩPious https://t.co/JTPSq7NvIb</td>
                                                </tr>
                                                <tr><td>Thu Jan 14 12:28:45 +0000 2016</td>
                                                <td>Positive</td>
                                                <td>Birthday Cake https://t.co/VidQbSjB5h</td>
                                                </tr>
                                                <tr><td>Mon Jan 11 07:21:06 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>Untitled https://t.co/Oisy3QoxmI</td>
                                                </tr>
                                                <tr><td>Fri Jan 08 04:58:21 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>The Cultivation of aÔøΩChild https://t.co/a1PI3zVMIh</td>
                                                </tr>
                                                <tr><td>Thu Jan 07 06:16:50 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>@DeepshriM jeez what have you come to.</td>
                                                </tr>
                                                <tr><td>Fri Jan 01 12:45:29 +0000 2016</td>
                                                <td>Negative</td>
                                                <td>@mujahidsunite we already talked about this. It&#39;s easier to die without rolling over</td>
                                                </tr>
                                                <tr><td>Fri Jan 01 11:09:38 +0000 2016</td>
                                                <td>Neutral</td>
                                                <td>Waiting for @mujahidsunite to tag me in his famous tweets.</td>
                                                </tr>
                                                <tr><td>Tue Dec 29 14:54:08 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>Untitled https://t.co/5cDUiocIck</td>
                                                </tr>
                                                <tr><td>Mon Dec 21 07:17:39 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>@mujahidsunite the Scandinavian post. As you can tell I Twittered wrong.</td>
                                                </tr>
                                                <tr><td>Mon Dec 21 06:58:14 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>@mujahidsunite should have tagged me in this bro.</td>
                                                </tr>
                                                <tr><td>Fri Dec 18 09:28:59 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>@mujahidsunite #ToleranceJumma</td>
                                                </tr>
                                                <tr><td>Fri Dec 18 08:57:29 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>@mujahidsunite how very untraditional of you to allow that. The awam may have something to say about your anti-discrimination policies.</td>
                                                </tr>
                                                <tr><td>Fri Dec 18 08:54:10 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>@mujahidsunite good question. We should start an inquiry</td>
                                                </tr>
                                                <tr><td>Fri Dec 18 07:55:13 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>@mujahidsunite says it all really.</td>
                                                </tr>
                                                <tr><td>Fri Dec 18 07:55:03 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>@mujahidsunite same goes for Lamb Of God, pic to back it up: https://t.co/XTg4JAP3V9</td>
                                                </tr>
                                                <tr><td>Fri Dec 18 07:47:37 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>RT @Shteyngart: How did the Republican debate go? Did Hillary win?</td>
                                                </tr>
                                                <tr><td>Fri Dec 18 07:43:06 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>@mujahidsunite on fire today @shehryarm</td>
                                                </tr>
                                                <tr><td>Fri Dec 18 07:41:59 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>@mujahidsunite Noice.</td>
                                                </tr>
                                                <tr><td>Fri Dec 18 07:21:56 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>My Girl FromÔøΩIpanema https://t.co/uwlm5SBNqz</td>
                                                </tr>
                                                <tr><td>Wed Dec 16 13:15:21 +0000 2015</td>
                                                <td>Negative</td>
                                                <td>Bad People https://t.co/ZRUHxDiKr3</td>
                                                </tr>
                                                <tr><td>Tue Dec 15 15:22:14 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>https://t.co/93Pr5vAMKf</td>
                                                </tr>
                                                <tr><td>Sat Dec 12 11:04:01 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>Tinder in Pakistan = people watching in a store full of mannequins.</td>
                                                </tr>
                                                <tr><td>Sun Nov 08 10:51:16 +0000 2015</td>
                                                <td>Positive</td>
                                                <td>RT @Invest2Innovate: i2i had a great mentor dinner session at Polo Lounge with Humayun Mazhar on the 4th weekend #i2i2015 https://t.co/g1DnÔøΩ</td>
                                                </tr>
                                                <tr><td>Mon Oct 19 23:06:27 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>Train Tracks On MyÔøΩForearms https://t.co/6NKym1EsLj</td>
                                                </tr>
                                                <tr><td>Wed Sep 09 23:57:59 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>WillÔøΩs $$$ https://t.co/g6Jt9tSb1n</td>
                                                </tr>
                                                <tr><td>Mon Jul 27 08:29:29 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>Silky Smooth https://t.co/kJdf12EQFp</td>
                                                </tr>
                                                <tr><td>Sat Jun 20 21:24:00 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>Hypotheticals https://t.co/L2tPzJw6OW</td>
                                                </tr>
                                                <tr><td>Thu Jun 18 11:44:40 +0000 2015</td>
                                                <td>Neutral</td>
                                                <td>Summer Rendezvous https://t.co/Sn5cFBMpUl</td>
                                                </tr>
                                                <tr><td>Sun Jun 23 15:07:05 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>Time to pack up, Lahore calling. #Lahore #summer</td>
                                                </tr>
                                                <tr><td>Fri Mar 22 21:03:41 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>RT @GeorgeCloooney: Honestly, I don&#39;t need someone who sees the good in me. I need someone who sees the bad and still wants me.</td>
                                                </tr>
                                                <tr><td>Wed Dec 05 17:02:06 +0000 2012</td>
                                                <td>Negative</td>
                                                <td>RT @MarijuanaPosts: A #weed smoker is arrested every 37 seconds in the United States, and people wonder why were paranoid.</td>
                                                </tr>
                                                </tbody></table>
                                                
                                                <div id="piechart3" style="width: 100%; height: 400px;"></div>
                                                
                            <h3 style="font-weight: bold;     text-align: center;">Iman Mazhar</h3>
                                                <table style=" width: 80% !important; margin-left: auto; margin-right: auto;" id="fourthTable" class="table table-bordered table-hover table-condensed">
                                                <tbody><tr><td style="font-weight: bold;">Timestamp</td>
                                                <td style="font-weight: bold;">Sentiment</td>
                                                <td style="font-weight: bold;">Tweet</td>
                                                </tr>
                                                <tr><td>Wed Dec 04 12:49:37 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @TedOfficialPage: 3 things I will never understand: 1. The meaning of life. 2. The universe. 3. How Spongebob &amp; Patrick made those soundÔøΩ</td>
                                                </tr>
                                                <tr><td>Mon Nov 11 15:23:13 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @itsBroStinson: Do caterpillars know that one day theyÔøΩre gonna be a butterfly or do they just build their cocoons like ÔøΩbruh wtf am i dÔøΩ</td>
                                                </tr>
                                                <tr><td>Mon Nov 11 15:22:32 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @itsBroStinson: I don&#39;t trust anyone who smiles before 9am.</td>
                                                </tr>
                                                <tr><td>Wed Oct 16 21:24:16 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>Thinking of what to draw next..</td>
                                                </tr>
                                                <tr><td>Mon Sep 09 19:15:21 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @TedOfficialPage: We don&#39;t lose friends, we just learn who our real ones are.</td>
                                                </tr>
                                                <tr><td>Mon Sep 09 19:10:35 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @FamousWomen: A woman is like a tea bag: you cannot tell how strong she is until you put her in hot water. -Nancy Reagan</td>
                                                </tr>
                                                <tr><td>Mon Sep 09 19:09:35 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @RelatableQuote: Fun thing to do: Go to a parking lot and put sticky notes on peoples cars saying &quot;sorry for the damage&quot; and watch them ÔøΩ</td>
                                                </tr>
                                                <tr><td>Mon Sep 09 19:08:49 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>RT @RelatableQuote: the most important thing iÔøΩve learnt in all my years is that it is a terrible idea to drink from a cup while lying down</td>
                                                </tr>
                                                <tr><td>Mon Sep 09 19:05:13 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @itsBroStinson: You&#39;re 15. You don&#39;t have a broken heart, shut up.</td>
                                                </tr>
                                                <tr><td>Mon Sep 09 19:04:12 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @GreatestQuotes: &quot;Three grand essentials to happiness in this life are something to do, something to love, and something to hope for.&quot; -ÔøΩ</td>
                                                </tr>
                                                <tr><td>Fri Sep 06 21:16:53 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>RT @zabreenkhan: Never interrupt someone watching an episode of Suits.</td>
                                                </tr>
                                                <tr><td>Fri Sep 06 21:16:39 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>RT @zabreenkhan: Perspective is everything</td>
                                                </tr>
                                                <tr><td>Fri Sep 06 21:15:21 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @GreatestQuotes: &quot;Raise your words, not voice. It is rain which grows flowers, not thunder.&quot; - Rumi</td>
                                                </tr>
                                                <tr><td>Mon Aug 05 23:05:04 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @girlposts: instead of banning girls from wearing certain things how about u just ban boys from being thirsty little hoes</td>
                                                </tr>
                                                <tr><td>Mon Aug 05 23:04:27 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>RT @GrumpyyCat: I wish common sense was more common.</td>
                                                </tr>
                                                <tr><td>Tue Jul 23 21:44:06 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>ÔøΩWhen your mind says give up, hope whispers one more try.ÔøΩ</td>
                                                </tr>
                                                <tr><td>Tue Jul 23 21:41:34 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @shehrbanotaseer: Sect-free mosque in Islamabad seeks to end discrimination http://t.co/4RfHLcKg9o</td>
                                                </tr>
                                                <tr><td>Tue Jul 23 21:35:01 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @funnyortruth: &quot;We can still be friends&quot; is like saying &quot;Hey, the dog died but we can keep it.&quot;</td>
                                                </tr>
                                                <tr><td>Tue Jul 23 21:32:15 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @OhMrWonka: Please smoke right in front of me. It&#39;s fine.</td>
                                                </tr>
                                                <tr><td>Tue Jul 23 21:31:09 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @CuteLoveMsgs: I&#39;m sensitive, I over think every little thing, and I care way too much</td>
                                                </tr>
                                                <tr><td>Sun Jul 21 10:27:13 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>RT @TedOfficialPage: You&#39;ve been dating for a day, you aren&#39;t in love, shut up.</td>
                                                </tr>
                                                <tr><td>Sun Jul 21 10:26:45 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @FamousWomen: Live your life and forget your age.</td>
                                                </tr>
                                                <tr><td>Mon Jul 08 21:12:09 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @SoDamnTrue: There is nothing more beautiful than a persons whose heart has been broken, but still believes in love.</td>
                                                </tr>
                                                <tr><td>Fri Jul 05 18:03:38 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @TedOfficialPage: MY job is to make you happy and please you.  YOUR job is to be there for me and hold it down.  OUR job is to make the ÔøΩ</td>
                                                </tr>
                                                <tr><td>Sun Mar 10 11:01:38 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>ÔøΩSo soon as a fashion is Universal, it is out of date.ÔøΩ</td>
                                                </tr>
                                                <tr><td>Mon Feb 25 16:34:45 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>RT @FunnyOrTruth: Did anyone notice how in Harry Potter, the soul-eating Dementors never went for Ron.</td>
                                                </tr>
                                                <tr><td>Mon Jan 14 17:02:44 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>&quot;Love isn&#39;t complicated, people are&quot;</td>
                                                </tr>
                                                <tr><td>Wed Jan 09 11:23:40 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>&quot;Games: The only legal place to kill stupid people.&quot;</td>
                                                </tr>
                                                <tr><td>Wed Jan 09 11:22:05 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>&quot;Nobody can go back and start a new beginning, but anyone can start today and make a new ending.&quot; - Maria Robinson&quot;</td>
                                                </tr>
                                                <tr><td>Tue Jan 08 15:13:47 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @FunnyOrTruth: I have a 6 pack under my fat. it&#39;s kinda shy.</td>
                                                </tr>
                                                <tr><td>Tue Jan 08 15:10:02 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @FunnyOrTruth: How I view dogs: Beagle, German Shepherd, Poodle, Maltese, Labrador. How I view cats: Cat, cat, cat, cat.</td>
                                                </tr>
                                                <tr><td>Tue Jan 08 15:08:02 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>RT @FunnyOrTruth: &#39;Bathtub&#39; spelled backwards is &#39;bathtub&#39;. It&#39;s really not, but for a second there you believed me.</td>
                                                </tr>
                                                <tr><td>Tue Jan 08 15:06:48 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>Galileo: Great mind. Einstein: Genius mind. Newton: Extraordinary mind. Bill Gates: Brilliant mind. Me: Never mind.</td>
                                                </tr>
                                                <tr><td>Sun Jan 06 17:39:54 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>I&#39;m so good at sleep, I can do it with my eyes closed.</td>
                                                </tr>
                                                <tr><td>Sat Jan 05 14:08:27 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>Live out your imagination not your history</td>
                                                </tr>
                                                <tr><td>Sat Jan 05 14:06:42 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>Can somebody lower their standards and fall in love with me please!</td>
                                                </tr>
                                                <tr><td>Sat Jan 05 05:43:15 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @FunnyOrTruth: School is pointless. English: We speak it. History: They&#39;re dead. Math: We have calculators. Spanish: We have Dora.</td>
                                                </tr>
                                                <tr><td>Sat Jan 05 05:42:12 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>There is no love sincerer than the love of food. ? - George Bernard Shaw</td>
                                                </tr>
                                                <tr><td>Fri Jan 04 18:49:23 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>&quot;Skinny jeans are like calories. Easy to put on but impossible to take off.&quot;</td>
                                                </tr>
                                                <tr><td>Fri Jan 04 18:48:44 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>&quot;Do not touch MY iPhone. It&#39;s not an usPhone, it&#39;s not a wePhone, it&#39;s not an ourPhone, it&#39;s an iPhone.&quot;</td>
                                                </tr>
                                                <tr><td>Fri Jan 04 18:44:50 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @FunnyOrTruth: I advise you, don&#39;t mess with me: I know Karate, Judo, Tai Kwon Do, Jujitsu and 28 other dangerous words.</td>
                                                </tr>
                                                <tr><td>Fri Jan 04 18:39:00 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @paulocoelho: Life is fast: in one day we go from heaven to hell (and back) several times</td>
                                                </tr>
                                                <tr><td>Thu Jan 03 18:19:22 +0000 2013</td>
                                                <td>Positive</td>
                                                <td>&quot;Don&#39;t go into business to get rich. Do it to enrich people. It will come back to you.&quot; - Stew Leonard&quot;</td>
                                                </tr>
                                                <tr><td>Thu Jan 03 18:17:26 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @GreatestQuotes: &quot;Nothing is more expensive than a missed opportunity.&quot; - H. Jackson Brown</td>
                                                </tr>
                                                <tr><td>Thu Jan 03 18:16:25 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>RT @KarachiTips: &quot;Ek yehi cheez hai jo pooray mulk ko saath kar deti hai. Jitnay bhi buray halaat hon, cricket does the magic.&quot; #Overhea ...</td>
                                                </tr>
                                                <tr><td>Thu Jan 03 14:48:53 +0000 2013</td>
                                                <td>Neutral</td>
                                                <td>&quot;I wish men could have children on their own, like seahorses, they have a little pouch, they should be called sea kangaroo&#39;s&quot; Barney Stinson</td>
                                                </tr>
                                                <tr><td>Tue Jan 01 13:40:24 +0000 2013</td>
                                                <td>Negative</td>
                                                <td>RT @GreatestQuotes: &quot;Stop leaving and you will arrive. Stop searching and you will see. Stop running away and you will be found.&quot; - Lao-tzu</td>
                                                </tr>
                                                <tr><td>Sat Dec 15 19:01:25 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>RT @OhMrWonka: I see you took a picture with a beer bottle in your hand. Tell me about how cool you are.</td>
                                                </tr>
                                                <tr><td>Sat Dec 15 18:42:58 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>RT @GreatestQuotes: &quot;Conquer your bad habits or they will conquer you.&quot; - Rob Gilbert</td>
                                                </tr>
                                                <tr><td>Wed Dec 05 14:34:28 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>RT @GreatestQuotes: &quot;Destiny is not a matter of chance, it is a matter of choice; it is not a thing to be waited for, it is a thing to b ...</td>
                                                </tr>
                                                <tr><td>Mon Dec 03 15:29:25 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>RT @GreatestQuotes: &quot;We all have possibilities we don&#39;t know about. We can do things we don&#39;t even dream we can do.&quot; - Dale Carnegie</td>
                                                </tr>
                                                <tr><td>Mon Dec 03 15:28:56 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>RT @GreatestQuotes: &quot;To be prepared is half the victory.&quot; - Miguel de Cervantes</td>
                                                </tr>
                                                <tr><td>Sat Dec 01 14:32:21 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>RT @parekhit: I hope my thoughts stop judging me</td>
                                                </tr>
                                                <tr><td>Sat Dec 01 14:28:41 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>RT @blusafire: 5. Golden rules of loving 1. Love unconditionally 2. No expectation 3. Fight n make up  4. Be there for each other always ...</td>
                                                </tr>
                                                <tr><td>Sat Dec 01 14:26:34 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>RT @paulocoelho: Sometimes we have to travel a long way to find what is near #TheAlchemist</td>
                                                </tr>
                                                <tr><td>Tue Nov 27 16:11:42 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>RT @GreatestQuotes: &quot;All great achievements have one thing in common - people with a passion to succeed.&quot; - Pat Cash</td>
                                                </tr>
                                                <tr><td>Tue Nov 27 16:08:26 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>RT @voguemagazine: &quot;Perseverance, dream a bit, and be passionate about it.&quot; - GC on her three keys to success</td>
                                                </tr>
                                                <tr><td>Tue Nov 27 15:56:30 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>RT @GreatestQuotes: &quot;Do not dwell in the past, do not dream of the future, concentrate the mind on the present moment.&quot; - Buddha</td>
                                                </tr>
                                                <tr><td>Tue Nov 20 05:00:14 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>&quot;I like being a woman, even in a manÔøΩs world. After all, men canÔøΩt wear dresses, but we can wear the pants.&quot; ÔøΩ Whitney Houston</td>
                                                </tr>
                                                <tr><td>Mon Nov 19 14:56:47 +0000 2012</td>
                                                <td>Negative</td>
                                                <td>@nehanazir go away =P</td>
                                                </tr>
                                                <tr><td>Mon Nov 19 14:50:09 +0000 2012</td>
                                                <td>Neutral</td>
                                                <td>@Dania_Nawaz @nehanazir i dont blog very often =P http://t.co/99uThCSU - i&#39;m gonna probably change it now since ive run out of space</td>
                                                </tr>
                                                <tr><td>Mon Nov 19 14:45:40 +0000 2012</td>
                                                <td>Neutral</td>
                                                <td>@nehanazir well you dont know my blog url =P</td>
                                                </tr>
                                                <tr><td>Mon Nov 19 14:44:01 +0000 2012</td>
                                                <td>Neutral</td>
                                                <td>@nehanazir :*</td>
                                                </tr>
                                                <tr><td>Mon Nov 19 14:43:29 +0000 2012</td>
                                                <td>Negative</td>
                                                <td>@nehanazir i even have a blog loser!</td>
                                                </tr>
                                                <tr><td>Mon Nov 19 13:06:32 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>ÔøΩGive a girl the right shoes and she can conquer the world.ÔøΩ ÔøΩMarilyn Monroe (1952)</td>
                                                </tr>
                                                <tr><td>Mon Nov 19 12:59:54 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>ÔøΩWhen in doubt, wear red.ÔøΩ ÔøΩBill Blass</td>
                                                </tr>
                                                <tr><td>Mon Nov 19 05:28:14 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>@MirandaMontez @rescuecyrus @Funny_Truth You&#39;ve been quoted in my #Storify story &quot;Parrot sings Gangnam style&quot; http://t.co/fn1PrXg8</td>
                                                </tr>
                                                <tr><td>Mon Nov 19 05:28:14 +0000 2012</td>
                                                <td>Positive</td>
                                                <td>@imstilkidrauhl @RealVannetti You&#39;ve been quoted in my #Storify story &quot;Parrot sings Gangnam style&quot; http://t.co/fn1PrXg8</td>
                                                </tr>
                                                <tr><td>Mon Nov 19 05:28:14 +0000 2012</td>
                                                <td>Neutral</td>
                                                <td>Parrot sings Gangnam style http://t.co/fn1PrXg8 #storify #glee</td>
                                                </tr>
                                                </tbody></table>
                                                
                                                <div id="piechart4" style="width: 100%; height: 400px;"></div>
                            <hr>
                            <h1>Keywords</h1>
                                <div style="height: 300px;">
                                    <div style="width:50%; float:left; text-align:center;">
                                        <h3 style="font-weight: bold;">Humayun Mazhar</h3>
                                        <div style="  background: #fafafa;  width: 80%; margin-left: auto; margin-right: auto;"><span>Investment</span>  <span style="font-weight: bold;">Fundability</span>  <span>Startups</span>  <span>TiEConChandigarh</span>  <span style="font-size: x-large;">TiE</span>  <span>Path2CCS</span>  <span>TheClub</span>  <span style="font-size: x-large;">nikeplus</span>  <span>WordsToLiveBy</span></div>
                                        </br>
                                        <h3 style="font-weight: bold;">Iman Mazhar</h3>
                                        <div style="  background: #fafafa;  width: 80%; margin-left: auto; margin-right: auto;"><span>RIPAmjadSabri</span>  <span style="font-weight: bold;">EURef</span>  <span>BreakingNews</span>  <span>PPP</span>  <span style="font-size: x-large;">Pakistan</span>  <span>Multan</span>  <span>WhiteHouse</span>  <span style="font-size: x-large;">BREAKING</span>  <span>Nadra</span>  <span>BudgetDebate</span></div>
                                    </div>
                                    <div style="width:50%; float:right; text-align:center;">
                                         <h3 style="font-weight: bold;">Mehreen Humayun</h3>
                                         <div style=" background: #fafafa;   width: 80%; margin-left: auto; margin-right: auto;"><span>LahoreBlast</span>  <span style="font-weight: bold;">Beautiful</span></div>
                                        </br>
                                        <h3 style="font-weight: bold;">Shameel Mazhar</h3>
                                        <div style=" background: #fafafa;   width: 80%; margin-left: auto; margin-right: auto;"><span>Overheard</span>  <span style="font-weight: bold;">PakvsInd</span>  <span>TheAlchemist</span>  <span style="font-size: x-large;">Storify</span>  <span>glee</span> </div>
                                    </div>
                                </div>
                            <hr>
                            <h1>Locations (Most Activity From)</h1>
                                <div>
                                    <div style="width:50%; float:left; text-align:center;">
                                    <h3 style="font-weight: bold;">Humayun Mazhar</h3>
                                    <h5>Lahore, PK</h5>
                                    </br>
                                    <h3 style="font-weight: bold;">Iman Mazhar</h3>
                                    <h5>N/A</h5>
                                    </div>
                                    <div style="width:50%; float:right; text-align:center;">
                                     <h3 style="font-weight: bold;">Mehreen Humayun</h3>
                                    <h5>Lahore, PK</h5>
                                    </br>
                                    <h3 style="font-weight: bold;">Shameel Mazhar</h3>
                                    <h5>N/A</h5>
                                    </div>
                                </div>
                            <hr>
                            <h1>Interests</h1>
                            <div style="display:inline-block;">
                                <div class="fb-page" data-href="https://www.facebook.com/PTIOfficial/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/PTIOfficial/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/PTIOfficial/">Pakistan Tehreek-e-Insaf</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/etribune/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/etribune/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/etribune/">Express Tribune</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/CresVentures/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/CresVentures/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/CresVentures/">CresVentures</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/nextgenpakistan/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/nextgenpakistan/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/nextgenpakistan/">Next Generation Pakistan</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/manchesterunited/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/manchesterunited/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/manchesterunited/">Manchester United</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/RealMadrid/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/RealMadrid/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/RealMadrid/">Real Madrid C.F.</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/berbatov.bg/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/berbatov.bg/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/berbatov.bg/">Dimitar Berbatov</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/Futurama/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Futurama/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Futurama/">Futurama</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/Lahorelitfest/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Lahorelitfest/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Lahorelitfest/">Lahore Literary Festival</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/MeganFox/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/MeganFox/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/MeganFox/">Megan Fox</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/EricPrydzOfficial/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/EricPrydzOfficial/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/EricPrydzOfficial/">Eric Prydz</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/TheSimpsons/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/TheSimpsons/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/TheSimpsons/">The Simpsons</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/DiegoForlanOficial/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/DiegoForlanOficial/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/DiegoForlanOficial/">Diego Forlan</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/BobMarley/" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/BobMarley/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/BobMarley/">Bob Marley</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/TheLastWordbks/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/TheLastWordbks/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/TheLastWordbks/?ref=br_rs">The Last Word</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/Thekillers/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Thekillers/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Thekillers/?ref=br_rs">The Killers</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/Aitchison-College-16890795823/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Aitchison-College-16890795823/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Aitchison-College-16890795823/?ref=br_rs">Aitchison College</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/ozzymanreviews/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ozzymanreviews/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ozzymanreviews/?ref=br_rs">Ozzy Man Reviews</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/radiohead/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/radiohead/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/radiohead/?ref=br_rs">Radiohead</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/berlinartparasites/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/berlinartparasites/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/berlinartparasites/?ref=br_rs">Berlin ArtParasites</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/hannahtrigwellmusic/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/hannahtrigwellmusic/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/hannahtrigwellmusic/?ref=br_rs">Hannah Trigwell</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/michaelphelps/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/michaelphelps/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/michaelphelps/?ref=br_rs">Michael Phelps</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/techshaw/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/techshaw/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/techshaw/?ref=br_rs">Techshaw</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/girlsatdhabas/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/girlsatdhabas/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/girlsatdhabas/?ref=br_rs">Girls at Dhabas</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/Entourage/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Entourage/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Entourage/?ref=br_rs">Entourage</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/ajokatheatrepk/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ajokatheatrepk/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ajokatheatrepk/?ref=br_rs">Ajoka Theatre Pakistan</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/depechemode/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/depechemode/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/depechemode/?ref=br_rs">Depeche Mode</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/berfrois/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/berfrois/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/berfrois/?ref=br_rs">Berfrois</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/lisahannigan/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/lisahannigan/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/lisahannigan/?ref=br_rs">Lisa Hannigan</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/ELlitmag/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ELlitmag/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ELlitmag/?ref=br_rs">Electric Literature</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/jackjohnson/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/jackjohnson/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/jackjohnson/?ref=br_rs">Jack Johnson</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/CityFM89/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/CityFM89/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/CityFM89/?ref=br_rs">CityFM89</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/parisreview/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/parisreview/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/parisreview/?ref=br_rs">The Paris Review</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/denisonuniversity/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/denisonuniversity/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/denisonuniversity/?ref=br_rs">Denison University</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/digthechowdah/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/digthechowdah/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/digthechowdah/?ref=br_rs">Chowdah</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/RioFerdinandOfficial/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/RioFerdinandOfficial/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/RioFerdinandOfficial/?ref=br_rs">Rio Ferdinand</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/Invest2Innovate/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Invest2Innovate/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Invest2Innovate/?ref=br_rs">Invest2Innovate (i2i)</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/redbull/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/redbull/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/redbull/?ref=br_rs">Red Bull</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/sharapova/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/sharapova/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/sharapova/?ref=br_rs">Maria Sharapova</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/southpark/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/southpark/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/southpark/?ref=br_rs">South Park</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/inglouriousbasterds/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
                                <div class="fb-page" data-href="https://www.facebook.com/rjkhalid.malik/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/rjkhalid.malik/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/rjkhalid.malik/?ref=br_rs">Khalid Malik [Official]</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/Brunettes-70018611060/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Brunettes-70018611060/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Brunettes-70018611060/?ref=br_rs">Brunettes</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/Hast-o-Neest-138032042916209/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Hast-o-Neest-138032042916209/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Hast-o-Neest-138032042916209/?ref=br_rs">Hast-o-Neest</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/pinkfloyd/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/pinkfloyd/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/pinkfloyd/?ref=br_rs">Pink Floyd</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/FamilyGuy/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/FamilyGuy/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/FamilyGuy/?ref=br_rs">Family Guy</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/WayneRooney/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/WayneRooney/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/WayneRooney/?ref=br_rs">Wayne Rooney</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/techjuicepk/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/techjuicepk/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/techjuicepk/?ref=br_rs">TechJuice</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/pushing-your-friends-into-things-eg-doors-people-bushes-trains-117166528320151/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/pushing-your-friends-into-things-eg-doors-people-bushes-trains-117166528320151/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/pushing-your-friends-into-things-eg-doors-people-bushes-trains-117166528320151/?ref=br_rs">pushing your friends into things. eg. doors, people, bushes, trains..</a></blockquote></div>
                                <div class="fb-page" data-href="https://www.facebook.com/Qasim-please-stop-making-pages-ab-funny-nai-hai-227552170601425/?ref=br_rs" data-tabs="timeline" data-width="220" data-height="130" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Qasim-please-stop-making-pages-ab-funny-nai-hai-227552170601425/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Qasim-please-stop-making-pages-ab-funny-nai-hai-227552170601425/?ref=br_rs">Qasim please stop making pages, ab funny nai hai.</a></blockquote></div>
                                
                            </div>
                            <hr>
                            <h1>Personas (Suggested)</h1>
                            <h5 style="  background: #fafafa;  width: 80%; margin-left: auto; margin-right: auto; font-size: 18px;">Dessets, High income earners, University educated, Home owners, Smart phone users, Car owners, Married, Parents, Makeup purchasers, Lipstick, Lipgloss</h5>
                            <hr>
                            <h1>Accounts</h1>
                                <div style="height:400px;">
                                    <div style="width:50%; float:left; text-align:center;">
                                    <h3 style="font-weight: bold;">Humayun Mazhar</h3>
                                    <img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xlp1/v/t1.0-1/10264345_10154205522110301_8231203662952063511_n.jpg?oh=6a965ad0010b779c003ea94e4988bb78&oe=58008815&__gda__=1479832876_9189861c712fe3fad9000e9da35316fd" width="100" height="100">
                                    </br><a style="font-size: x-large;" href="https://www.facebook.com/hmazhark">Facebook</a>
                                    </br><a style="font-size: x-large;" href="https://twitter.com/hmazhark">Twitter</a>
                                    </br>
                                    <h3 style="font-weight: bold;">Iman Mazhar</h3>
                                     <img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpl1/v/t1.0-1/p160x160/12472607_10207254471814986_4466847099191425352_n.jpg?oh=fbb6115083ee88dd24cb34cbbc4d0796&oe=580A276E&__gda__=1477119039_5b75b5a0339c032a0e5d4f8409db3eb9" width="100" height="100">
                                    </br><a style="font-size: x-large;" href="https://www.facebook.com/Iman.Mazhar28">Facebook</a>
                                    </br><a style="font-size: x-large;" href="https://twitter.com/Iman_Mazhar">Twitter</a>
                                    
                                    </div>
                                    <div style="width:50%; float:right; text-align:center;">
                                    <h3 style="font-weight: bold;">Mehreen Humayun</h3>
                                    <img src="https://scontent-kul1-1.xx.fbcdn.net/v/t1.0-9/12920256_1100013840020326_2718231781856567877_n.jpg?oh=687c069c7eb77a05974b78e838d88b61&oe=57EC4AD8" width="100" height="100">
                                    </br><a style="font-size: x-large;" href="https://www.facebook.com/mehreen.humayun.7">Facebook</a>
                                    </br><a style="font-size: x-large;" href="https://twitter.com/humayunmehreen">Twitter</a>
                                    </br>
                                    <h3 style="font-weight: bold;">Shameel Mazhar</h3>
                                     <img src="https://fbcdn-sphotos-a-a.akamaihd.net/hphotos-ak-xap1/v/t1.0-9/11295622_10155613763800500_819225578821231726_n.jpg?oh=13e658ca08cfbbe91d50ab02b67503b3&oe=57FDC599&__gda__=1477066912_f6a8f519f6c85dfddd6eb2d70024a7ce" width="100" height="100">
                                    </br><a style="font-size: x-large;" href="https://www.facebook.com/shameel.mazhar">Facebook</a>
                                    </br><a style="font-size: x-large;" href="https://twitter.com/ShameelMazhar">Twitter</a>
                                    </div>
                                </div>
                            <hr>
                             <h1>Live Tweet Analysis (Family friends and followers)</h1>
                             <h5 style="    text-align: center; font-size:18px;">Visit the <a href="http://137.135.107.18:8983/solr/banana/index.html#/dashboard">link</a> for live tweet analysis.</h5>
                           
                         </div>
                        </div>
                    </div>
                    
                    ';
        echo $footer;
	
  
}



