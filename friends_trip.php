<?php 
include("config.php"); 
$fb_id=$_REQUEST["fb_id"];
$device_id=$_REQUEST["device_id"];
$trip_cat = $serviceUrl."getFriendsTrips.php?device_id=".$device_id."&fb_id=".$fb_id;
$cat_list = get_data($trip_cat);
$cat_list = str_replace("@attributes","attributes",$cat_list);
$xml = json_decode($cat_list,false);
echo "<pre>";
print_r($xml);
echo "</pre>";
$tot_rec = $xml->content->attributes->end_limit;
	echo $tot_rec;
exit;

?>
<!DOCTYPE html>
<html>
<head>
<title>Trips</title>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="index,follow" name="robots" />
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
<meta name="viewport" content="minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width, target-densitydpi=device-dpi">
<meta name="HandheldFriendly" content="True" />

<link rel="stylesheet" href="css/hotels.css">

<link rel="stylesheet" href="css/mdpi.css" media="only screen and (-webkit-max-device-pixel-ratio:1.0), (-webkit-max-device-pixel-ratio:0.75)">


<script language="javascript" type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-scroll.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".ui-scroller-view").addClass("transformHack");
});

$(window).load(function(){
	var winhei = $(window).height();
	var wrapperH = $('#top_bar').height();
	document.getElementById('scrollH_list').style.height = winhei - wrapperH  + 'px';
});
  
</script>
</head>

<body>
<div id="top_bar">
<div style="text-align:center;padding:10px 0">
<a href="add_trips.php?device_id=<?php echo $device_id;?>&fb_id=<?php echo $fb_id;?>"><img src="images/Mytrips_createatrip.png"></a>
</div>
<ul class="tabs">
    <li><a href="index.php?device_id=<?php echo $device_id;?>&fb_id=<?php echo $fb_id;?>">Created</a></li>
    <li><a href="javascript:;" class="active">Friends</a></li>
    <li><a href="">All Trips</a></li>
    <li><a href="">Bookmarked</a></li>
    
</ul>
</div>
<div style="background:#fff;">
	<div id="scrollH_list" class="ui-scroller">
		<div class="ui-scroller-view">
        	<ul class="list">
<?php
	$arraylist = $xml->content->trip;
	$tot_rec = $cityXml->content->attributes()->total_records;
	echo $tot_rec;
	foreach($arraylist as $list)
                { 
                
                ?> 
                              
                    <li>
                    <a href="">
                      <div style="float:left;width:250px;"><span style="float:left;margin-right:10px"><img src="<?php echo $list->trip_thumbnail_url; ?>" height="40" width="40"></span>
                      <span class="catlist_title"><?php echo stripcslashes($list->trip_name); ?></span><br>
                      <span style="font-size:12px;">By <span style="color:#6CF;"><?php echo $list->created_by_name; ?></span></span><br>
                      <span><?php echo $list->trip_description; ?></span>
                      <div class="clear"></div> 
                    </div>
                      <div style="float:right;width:50px;padding-top:15px;"><img src="images/likes.png" width="20" height="18" align="absmiddle"> <span style="color:#6cf;font-size:11px;"><?php echo $list->number_of_likes; ?></span></div>
                     <div class="clear"></div> 
                     </a>
                    </li>
	<?php } ?>
</ul>
    	</div>
    </div>
    </div>
    

<script type="text/javascript">
 $(".ui-scroller").momentumScroller({ direction: "vertical" });
</script>
</body>
</html>