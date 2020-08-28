<?php 

include_once APPPATH."libraries/Regex.php";

class LinkPreviewerModel extends CI_Model
{

	public function reset_request()
	{
		// reset ke seribu
		$this->db->where('jenis', 'public');
		$this->db->update("link_previewer", [ "request_remains" => '1000' ]);
		// reset ke seratus
		$this->db->where('jenis', 'free');
		$this->db->update("link_previewer", [ "request_remains" => '100' ]);
		// reset ke 5000
		$this->db->where('jenis', 'premium');
		$this->db->update("link_previewer", [ "request_remains" => '5000' ]);

		// ambil data
		$this->db->where('jenis', 'public');
		$result = $this->db->get('link_previewer');
		return ($result->row_array());

	}

    public function generate_random_string()
    {
    	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    	$pass = array(); //remember to declare $pass as an array
    	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    	for ($i = 0; $i < 8; $i++) {
    		$n = rand(0, $alphaLength);
    		$pass[] = $alphabet[$n];
    	}
    	return implode($pass); //turn the array into a string
    }

    

	static function isImage($url)
    {
        if (preg_match(Regex::$IMAGE_PREFIX_REGEX, $url))
            return true;
        else
            return false;
    }


    /*
    * MEMPROSES META DATA WEBSITE
    */
    public function url_get_contents($url, $useragent='cURL', $headers=false, $follow_redirects=true, $debug=false) {

        // initialise the CURL library
        $ch = curl_init();

        // specify the URL to be retrieved
        curl_setopt($ch, CURLOPT_URL,$url);

        // we want to get the contents of the URL and store it in a variable
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

        // specify the useragent: this is a required courtesy to site owners
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

        // ignore SSL errors
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // return headers as requested
        if ($headers==true){
            curl_setopt($ch, CURLOPT_HEADER,1);
        }

        // only return headers
        if ($headers=='headers only') {
            curl_setopt($ch, CURLOPT_NOBODY ,1);
        }

        // follow redirects - note this is disabled by default in most PHP installs from 4.4.4 up
        if ($follow_redirects==true) {
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        }

        // if debugging, return an array with CURL's debug info and the URL contents
        if ($debug==true) {
            $result['contents']=curl_exec($ch);
            $result['info']=curl_getinfo($ch);
        }

        // otherwise just return the contents as a variable
        else $result=curl_exec($ch);

        // free resources
        curl_close($ch);

        // send back the data
        return $result;
    }
    // function to get webpage title
    public function getTitle($url) {
        $page = $this->url_get_contents($url);
        $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;
        return $title;
    }
    // mengganti index yang mengandung : dengan _ agar bisa diakses memakai JavaScript
    public function menyaring_keys_index($rmetas)
    {
    	$rmetas_keys = array_keys( $rmetas ); // memisahkan keys
    	$rmetas_values = array_values( $rmetas ); // memisahkan values
    	foreach ($rmetas_keys as $key => $value) {
    		$rmetas_keys[$key] = str_replace(":", "_", $value);
    	}
    	return array_combine( $rmetas_keys, $rmetas_values );
    }
    public function getMetaTags($str)
    {
      $pattern = '
      ~<\s*meta\s

      # using lookahead to capture type to $1
        (?=[^>]*?
        \b(?:name|property|http-equiv)\s*=\s*
        (?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
        ([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
      )

      # capture content to $2
      [^>]*?\bcontent\s*=\s*
        (?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
        ([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
      [^>]*>

      ~ix';
     
      if(preg_match_all($pattern, $str, $out)){
      	for ($i=0; $i < count($out[1]); $i++) { 
      		$property = $out[1][$i];
      	    $content = $out[2][$i];
      	    return array_combine($out[1], $out[2]);
      	}
      }
      return array();
    }
    /*
    * MEMPROSES META DATA WEBSITE
    */


	/*
	* MEDIA THUMBNAIL
	*/

	/** Return iframe code for Youtube videos */
	static function mediaYoutube($url)
	{
		$vid = false;
	    if ( strpos( $url , "youtube.com") !== false ) {
	    	if (preg_match("/(.*?)v=(.*?)($|&)/i", $url, $matching)) {
	    	    $vid = $matching[2];
	    	    // array_push($media, '<div class="embed-responsive embed-responsive-16by9"><iframe id="' . date("YmdHis") . $vid . '" class="embed-responsive-item" width="499" height="368" src="http://www.youtube.com/embed/' . $vid . '" frameborder="0" allowfullscreen></iframe></div>');
	    	}
	    }
	    return $vid;
	}

	/** Return iframe code for TED videos */
	static function mediaTED($url)
	{
	    $url = explode("/", $url);
	    $media = array();
	    if (count($url) > 0) {
	        $url = $url[count($url) - 1];
	        $url = explode("?", $url);
	        if (count($url) > 0) {
	            $url = $url[0];
	            $embed = '<iframe src="https://embed-ssl.ted.com/talks/' . $url . '.html" width="640" height="360" frameborder="0" scrolling="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	            // array_push($media, "", '<div class="embed-responsive embed-responsive-16by9">' . $embed . '</div>');
	        } else {
	            array_push($media, "", "");
	        }
	    } else {
	        array_push($media, "", "");
	    }
	    return $media;
	}

	/** Return iframe code for Vine videos */
	static function mediaVine($url)
	{
	    $url = str_replace("https://", "", $url);
	    $url = str_replace("http://", "", $url);
	    $breakUrl = explode("/", $url);
	    $media = array();
	    if ($breakUrl[2] != "") {
	        $vid = $breakUrl[2];
	        array_push($media, $this->mediaVineThumb($vid));
	        // array_push($media, '<div class="embed-responsive embed-responsive-16by9 lp-vine-fix"><iframe id="' . date("YmdHis") . $vid . '" class="vine-embed embed-responsive-item" src="https://vine.co/v/' . $vid . '/embed/simple" width="499" height="499" frameborder="0"></iframe></div><script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script>');
	    } else {
	        array_push($media, "", "");
	    }
	    return $media;
	}

	static function mediaVineThumb($id)
	{
	    $vine = file_get_contents("http://vine.co/v/{$id}");
	    preg_match('/property="og:image" content="(.*?)"/', $vine, $matches);

	    return ($matches[1]) ? $matches[1] : false;
	}

	/** Return iframe code for Vimeo videos */
	static function mediaVimeo($url)
	{
	    $url = str_replace("https://", "", $url);
	    $url = str_replace("http://", "", $url);
	    $breakUrl = explode("/", $url);
	    $media = array();
	    if ($breakUrl[1] != "") {
	        $imgId = $breakUrl[1];
	        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgId.php"));
	        array_push($media, $hash[0]['thumbnail_large']);
	        // array_push($media, '<div class="embed-responsive embed-responsive-16by9"><iframe id="' . date("YmdHis") . $imgId . '" class="embed-responsive-item" width="499" height="280" src="http://player.vimeo.com/video/' . $imgId . '" width="654" height="368" frameborder="0" webkitallowfullscreen mozallowfullscreen allowFullScreen ></iframe></div>');
	    } else {
	        array_push($media, "", "");
	    }
	    return $media;
	}

	/** Return iframe code for Metacafe videos */
	static function mediaMetacafe($url)
	{
	    $media = array();
	    preg_match('|metacafe\.com/watch/([\w\-\_]+)(.*)|', $url, $matching);
	    if ($matching[1] != "") {
	        $vid = $matching[1];
	        $vtitle = trim($matching[2], "/");
	        array_push($media, "http://s4.mcstatic.com/thumb/{$vid}/0/6/videos/0/6/{$vtitle}.jpg");
	        // array_push($media, '<div class="embed-responsive embed-responsive-16by9"><iframe id="' . date("YmdHis") . $vid . '" class="embed-responsive-item" width="499" height="368" src="http://www.metacafe.com/embed/' . $vid . '" allowFullScreen frameborder=0></iframe></div>');
	    } else {
	        array_push($media, "", "");
	    }
	    return $media;
	}

	/** Return iframe code for Dailymotion videos */
	static function mediaDailymotion($url)
	{
	    $id = strtok(basename($url), '_');
	    if ($id != "") {
	        //$hash = file_get_contents("http://www.dailymotion.com/services/oembed?format=json&url=http://www.dailymotion.com/embed/video/$id");
	        //$hash=json_decode($hash,true);
	        //array_push($media, $hash['thumbnail_url']);

	        $media = "http://www.dailymotion.com/thumbnail/160x120/video/{{$id}}";
	        // array_push($media, '<div class="embed-responsive embed-responsive-16by9"><iframe id="' . date("YmdHis") . $id . '" class="embed-responsive-item" width="499" height="368" src="http://www.dailymotion.com/embed/video/' . $id . '" allowFullScreen frameborder=0></iframe></div>');
	    } else {
	        array_push($media, "", "");
	    }
	    return $media;
	}

	/** Return iframe code for College Humor videos */
	static function mediaCollegehumor($url)
	{
	    $media = array();
	    preg_match('#(?<=video/).*?(?=/)#', $url, $matching);
	    $id = $matching[0];
	    if ($id != "") {
	        $hash = file_get_contents("http://www.collegehumor.com/oembed.json?url=http://www.dailymotion.com/embed/video/{{$id}}");
	        $hash = json_decode($hash, true);
	        array_push($media, $hash['thumbnail_url']);
	        // array_push($media, '<div class="embed-responsive embed-responsive-16by9"><iframe id="' . date("YmdHis") . $id . '" class="embed-responsive-item" width="499" height="368" src="http://www.collegehumor.com/e/' . $id . '" allowFullScreen frameborder=0></iframe></div>');
	    } else {
	        array_push($media, "", "");
	    }
	    return $media;

	}

	/** Return iframe code for Blip videos */
	static function mediaBlip($url)
	{
	    $media = array();
	    if ($url != "") {
	        $hash = file_get_contents("http://blip.tv/oembed?url=$url");
	        $hash = json_decode($hash, true);
	        preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $hash['html'], $matching);
	        $src = $matching[1];
	        array_push($media, $hash['thumbnail_url']);
	        // array_push($media, '<div class="embed-responsive embed-responsive-16by9"><iframe id="' . date("YmdHis") . 'blip" class="embed-responsive-item" width="499" height="368" src="' . $src . '" allowFullScreen frameborder=0></iframe></div>');
	    } else {
	        array_push($media, "", "");
	    }
	    return $media;
	}

	/** Return iframe code for Funny or Die videos */
	static function mediaFunnyordie($url)
	{
	    $media = array();
	    if ($url != "") {
	        $hash = file_get_contents("http://www.funnyordie.com/oembed.json?url=$url");
	        $hash = json_decode($hash, true);
	        preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $hash['html'], $matching);
	        $src = $matching[1];
	        array_push($media, $hash['thumbnail_url']);
	        // array_push($media, '<div class="embed-responsive embed-responsive-16by9"><iframe id="' . date("YmdHis") . 'funnyordie" class="embed-responsive-item" width="499" height="368" src="' . $src . '" allowFullScreen frameborder=0></iframe></div>');
	    } else {
	        array_push($media, "", "");
	    }
	    return $media;

	}

	// MAIN FUNCTION
	function getMedia($pageUrl)
	{
	    if (strpos($pageUrl, "ted.com") !== false) {
	        $media = $this->mediaTED($pageUrl);
	    } else if (strpos($pageUrl, "vimeo.com") !== false) {
	        $media = $this->mediaVimeo($pageUrl);
	    } else if (strpos($pageUrl, "vine.co") !== false) {
	        $media = $this->mediaVine($pageUrl);
	    } else if (strpos($pageUrl, "metacafe.com") !== false) {
	        $media = $this->mediaMetacafe($pageUrl);
	    } else if (strpos($pageUrl, "dailymotion.com") !== false) {
	        $media = $this->mediaDailymotion($pageUrl);
	    } else if (strpos($pageUrl, "collegehumor.com") !== false) {
	        $media = $this->mediaCollegehumor($pageUrl);
	    } else if (strpos($pageUrl, "blip.tv") !== false) {
	        $media = $this->mediaBlip($pageUrl);
	    } else if (strpos($pageUrl, "funnyordie.com") !== false) {
	        $media = $this->mediaFunnyordie($pageUrl);
	    }
	    if ( !empty($media) ) {
	    	return $media;
	    }
	}

	/*
	* MEDIA THUMBNAIL
	*/


}
