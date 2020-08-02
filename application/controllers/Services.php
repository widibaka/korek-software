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
	// MAIN METHOD
	public function link_previewer_api($url){
		$data_website = array(); // begin

		// terima $url dengan meng-replace "garis_miring" menjadi /
		$url = str_replace( "garis_miring", "/", $url);

		if (strpos($url, "http://") !== false)
		    $url = str_replace("http://", "http://www.", $url);
		elseif (strpos($url, "https://") !== false)
		    $url = str_replace("https://", "https://www.", $url);

		$url = base64_decode($url);
		$data_website['URL_SUMBER'] = $url;
		// get meta tags
		if ( !get_meta_tags( $url ) ) {

			$data_website['status'] = "gagal";
			$data_website['meta_tags'] = ''; // inisialisasi biar ga error di JS nanti

			// final output
			$json = json_encode($data_website);
			echo $json;
		}
		else{
			$meta_tags = get_meta_tags( $url );


			// get og components
			$html = $this->LinkPreviewerModel->url_get_contents( $url );

			libxml_use_internal_errors(true); // Yeah if you are so worried about using @ with warnings
			$doc = new DomDocument();
			$doc->loadHTML($html);
			$xpath = new DOMXPath($doc);
			$query = '//*/meta[starts-with(@property, \'og:\')]';
			$metas = $xpath->query($query);

			foreach ($metas as $meta) {
			    $property = $meta->getAttribute('property'); // hilangkan "og:" biar objek json nya bisa diakses
			    $content = $meta->getAttribute('content');
			    $data_website[$property] = $content;
			}

			// get web page title
			$data_website['page_title'] = $this->LinkPreviewerModel->getTitle( $url );

			// mengganti index yang mengandung : dengan _ agar bisa diakses memakai JavaScript
			$data_website = $this->LinkPreviewerModel->menyaring_keys_index( $data_website );

			# get media thumbnail. og:image diganti dengan output Method getMedia. Ini berlaku untuk youtube, dailymotion dan lain2, fungsinya agar gambar thumbnail yang diambil gak terlalu besar
			$data_website['og_image'] = $this->LinkPreviewerModel->getMedia( $url );

			if ($this->LinkPreviewerModel->isImage($url)) {
			    $images = [$url];
			    $data_website['media_thumbnail'] = $images;
			}

			$data_website['status'] = "berhasil";

			if ( $meta_tags ) {
				// mengganti index yang mengandung : dengan _ agar bisa diakses memakai JavaScript
				$meta_tags = $this->LinkPreviewerModel->menyaring_keys_index( $meta_tags );
				$data_website['meta_tags'] = $meta_tags;
			}else{
				$data_website['meta_tags'] = ''; // inisialisasi biar ga error di JS nanti
			}
			

			// final output
			$json = json_encode($data_website);
			echo $json;
		}
	}
/**
* LINK PREVIEWER end
*/
}