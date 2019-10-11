<?php


require_once('guzzle/vendor/autoload.php');

use GuzzleHttp\Client;

function fetchMedium($yourusername)
{
	$client = new GuzzleHttp\Client();



    $client = new Client();

    try {
        $res = $res = $client->get("https://medium.com/$yourusername?format=json");
    } catch (Exception $exception) {
        return false;
    }

    if (!$res->getStatusCode() == 200) {
         return false;
    }

    $body = json_decode(str_replace('])}while(1);</x>', '', $res->getBody()));

    if (!isset($body->success, $body->payload)) {
        return false;
    }

	$posts = $body->payload->references->Post;
	return $posts;
}
//Pass your medium username here ex. olabodeabesin
$results = fetchMedium($yourusername); 
?>

<div class="row posts">
	<?php foreach($results as $key=>$post): ?>
	<div class="col-md-6 col-sm-6">
		<div class="blog-post row">
			<div class="col-xs-3">
				<div class="image">
					<a href="https://medium.com/@yourusername/<?php echo $post->uniqueSlug  ?>"  target = "_blank">
						<img src="https://miro.medium.com/fit/c/1400/600/<?php echo $post->virtuals->previewImage->imageId  ?>">
					</a>
				</div>
			</div>
			<div class="col-xs-9">
				<div class="info">
				<a href="https://medium.com/@yourusername/<?php echo $post->uniqueSlug  ?>"  target = "_blank">
						<div class="title"><?php echo $post->title  ?></div>
						<div class="excerpt"><?php echo $post->content->subtitle  ?></div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>

<div class="view-all">
	<div class="link">
		<a href="https://medium.com/@yourusername" target = "_blank">View All</a>
	</div>
</div>

