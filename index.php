
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.12/jquery.bxslider.min.css" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.12/jquery.bxslider.min.js" crossorigin="anonymous"></script>

<style>
.bx-wrapper img {
    margin: 0 auto;
}


</style>

</head>

<body>

<div class="d-flex container justify-content-center align-items-center" style="height: 100vh">

<div class="row row-centered">
<div class="col-md-12 col-centered mb-5">
<form>

	<input type="text" name="id" placeholder="Put in user/group nick" style="display:block" class="mx-auto" required>


	<input type="number" name="likes_count" placeholder="Put in likes count" style="display:block" class="mx-auto" required>


	<input type="number" name="postscount" value="100"  style="display:block" class="mx-auto" required>


	<button class="btn btn-primary mx-auto" style="display:block" >submit</button>

</form>
</div>
<div class="col-md-12 col-centered">
<?php
if(!isset($_GET["id"],$_GET["postscount"],$_GET["likes_count"])) die; else{
$token = '';
$id = htmlspecialchars($_GET["id"]);
$page = 0;
$count = htmlspecialchars($_GET["postscount"]);
$likescount = htmlspecialchars($_GET["likes_count"]);
$query = array();
$finalquery = array();
$query = json_decode(file_get_contents("https://api.vk.com/method/wall.get?domain=$id&count=$count&extended=0&fields=marked_as_ads&access_token=$token&expires_in=86400&user_id=32999033&state=123456&v=5.68"),true);
foreach($query['response']['items'] as $item){
	if(!isset($item['marked_as_ads']) || $item['marked_as_ads'] == 0){
		if(isset($item['attachments'])){
			if($item['attachments'][0]['type'] == 'photo' && $item['likes']['count']>$likescount){
				array_push($finalquery,$item);
			}
		}
	}	
}
}
?>

<ul class="bxslider mx-auto">
<?php foreach($finalquery as $image) :?>
	<li><img height="604" src="<?php echo($image['attachments'][0]['photo']['photo_604']) ?> "></li>
<?php endforeach; ?>
</ul>
</div>
</div>
</div>
</body>

</html>

<script>
$(document).ready(function(){
  $('.bxslider').bxSlider({

	responsive: false,
	slideWidth: 850,
	pager: false
  });
  $(".bx-wrapper").addClass("mx-auto");
});
</script>

