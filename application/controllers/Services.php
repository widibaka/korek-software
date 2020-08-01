<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Isinya adalah API
 */
class Services extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("KoreksoftModel");
		$this->load->model("LinkPreviewerModel");
	}
	
/**
* LINK PREVIEWER start
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

	// MAIN METHOD
	public function link_previewer_api($url){

		// terima $url dengan mereplace "garis_miring" menjadi /
		$url = str_replace( "garis_miring", "/", $url);

		if (strpos($url, "http://") !== false)
		    $url = str_replace("http://", "http://www.", $url);
		elseif (strpos($url, "https://") !== false)
		    $url = str_replace("https://", "https://www.", $url);

		$url = base64_decode($url);

		// var_dump(get_meta_tags( $url ));
		// die();

		// get meta tags
		if ( !get_meta_tags( $url ) ) {

			$rmetas['status'] = "gagal";
			$rmetas['meta_tags'] = ''; // inisialisasi biar ga error di JS nanti

			// final output
			$json = json_encode($rmetas);
			echo $json;
		}
		else{
			$meta_tags = get_meta_tags( $url );


			// get og components
			$html = $this->url_get_contents( $url );

			libxml_use_internal_errors(true); // Yeah if you are so worried about using @ with warnings
			$doc = new DomDocument();
			$doc->loadHTML($html);
			$xpath = new DOMXPath($doc);
			$query = '//*/meta[starts-with(@property, \'og:\')]';
			$metas = $xpath->query($query);
			$rmetas = array();

			foreach ($metas as $meta) {
			    $property = $meta->getAttribute('property'); // hilangkan "og:" biar objek json nya bisa diakses
			    $content = $meta->getAttribute('content');
			    $rmetas[$property] = $content;
			}

			// get web page title
			$rmetas['page_title'] = $this->getTitle( $url );

			// mengganti index yang mengandung : dengan _ agar bisa diakses memakai JavaScript
			$rmetas = $this->menyaring_keys_index( $rmetas );

			# get media thumbnail
			// $rmetas['image'] = $this->LinkPreviewerModel->getMedia( $url );

			if ($this->LinkPreviewerModel->isImage($url)) {
			    $images = [$url];
			    $rmetas['media_thumbnail'] = $images;
			}

			$rmetas['status'] = "berhasil";

			if ( $meta_tags ) {
				// mengganti index yang mengandung : dengan _ agar bisa diakses memakai JavaScript
				$meta_tags = $this->menyaring_keys_index( $meta_tags );
				$rmetas['meta_tags'] = $meta_tags;
			}else{
				$rmetas['meta_tags'] = ''; // inisialisasi biar ga error di JS nanti
			}
			

			// final output
			$json = json_encode($rmetas);
			echo $json;
		}
	}
/**
* LINK PREVIEWER end
*/
}