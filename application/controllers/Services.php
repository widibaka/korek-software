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
	public function link_previewer_api($url = ''){


		$youtube_api_key = "AIzaSyCwsoXvuNvZ-nQv2X0MvWAd8ks1gWJM_Y0";

		$data_website = array(); // begin

		// terima $url dengan meng-replace "garis_miring" menjadi /
		$url = str_replace( "garis_miring", "/", $url);

		if (strpos($url, "http://") !== false)
		    $url = str_replace("http://", "http://www.", $url);
		elseif (strpos($url, "https://") !== false)
		    $url = str_replace("https://", "https://www.", $url);

		$url = base64_decode($url);
		$data_website['source_url'] = $url;

		// get web page title
		$data_website['page_title'] = $this->LinkPreviewerModel->getTitle( $url );

		// get target's content
		$html = $this->LinkPreviewerModel->url_get_contents( $url );
		// echo $html;
		// echo "<br>";
		// echo strlen($html);
		// die();


		// validation
		if ( !$url OR !$html OR strpos($html, "<title>404 Not Found</title>") AND strlen($html) < 600 ) { 

			$data_website['status'] = "fail";

		}
		else{

			// libxml_use_internal_errors(true); // Yeah if you are so worried about using @ with warnings
			// $doc = new DomDocument();
			// $doc->loadHTML($html);
			// $xpath = new DOMXPath($doc);
			// $query = '//*/meta[starts-with(@property, \'og:\')]';
			// $metas = $xpath->query($query);
			// foreach ($metas as $meta) {
			//     $property = $meta->getAttribute('property');
			//     $content = $meta->getAttribute('content');
			//     $data_website[$property] = $content;
			// }

			// $meta_tags = '';
			$meta_tags_mentah = $this->LinkPreviewerModel->getMetaTags( $html );
			// var_dump($meta_tags_mentah);
			// die();

			// mengganti index yang mengandung : dengan _ agar bisa diakses memakai JavaScript
			$data_website = $this->LinkPreviewerModel->menyaring_keys_index( $data_website );

			if ($this->LinkPreviewerModel->isImage($url)) {
			    $images = $url;
			    $data_website['og_image'] = $images;
			}

			$data_website['status'] = "success";

			if ( $meta_tags_mentah ) {
				// mengganti index yang mengandung : dengan _ agar bisa diakses memakai JavaScript
				$meta_tags = $this->LinkPreviewerModel->menyaring_keys_index( $meta_tags_mentah );
				$data_website = array_merge( $data_website, $meta_tags );
			}else if( !$this->LinkPreviewerModel->isImage($url) ){ // kalau gak ada isinya, dan bukan link gambar, maka data website dikosongin aja
				$data_website = ''; // inisialisasi biar ga error di JS nanti
			}

			$vid = $this->LinkPreviewerModel->mediaYoutube($url); // mendapatkan id video, sekaligus mendeteksi apakah ini link youtube atau bukan
			
			if ( $vid != false ) {
				# Untuk youtube, harus memakai API khusus dan tidak bisa mengambil dari situsnya langsung karena diproteksi
		        
		    	$data = $this->LinkPreviewerModel->url_get_contents( "https://www.googleapis.com/youtube/v3/videos?id=". $vid ."&key=AIzaSyCwsoXvuNvZ-nQv2X0MvWAd8ks1gWJM_Y0&part=snippet" );

		    	$data = json_decode( $data );

		    	$data = json_decode(json_encode($data),true); // <-- object nya diubah menjadi array dulu biar enak, seragam gitu

				$data = $data['items'][0]['snippet'];

				$data_website['og_image'] = "http://i2.ytimg.com/vi/{$vid}/hqdefault.jpg";
				$data_website['og_title'] = $data['title'];
				$data_website['og_description'] = $data['description'];
				$data_website['full_youtube_data'] = $data;
				$data_website['og_site_name'] = "YouTube";
				$data_website['description'] = null;
				$data_website['keywords'] = null;
				
			}else{
				// Google drive tidak bisa diakses sembarangan, jadi dikasih meta data seragam aja lah
				if ( strpos( $url , "drive.google.com" ) !== false ) {
					$data_website['og_image'] = "https://sites.google.com/a/kn.ac.th/krupuii/_/rsrc/1525442492460/home/Drive1.jpg";
					$data_website['og_title'] = "Google Drive";
					$data_website['og_site_name'] = "Google Drive";
					$data_website['og_description'] = "Layanan penyimpanan berkas.";

					// ini entah kenapa situsku jadi bahasa filipina, pengen dihapus aja
					$data_website['page_title'] = "Google Drive";
					$data_website['description'] = null;
					$data_website['keywords'] = null;

					// ini entah kenapa situsku jadi bahasa filipina
					
					
				}
				// kadang ada youtube search juga kan... nah, masuknya ke sini
				else if ( strpos( $url , "youtube.com" ) !== false ) {
					$data_website['og_image'] = "https://www.youtube.com/img/desktop/yt_1200.png";
					$data_website['og_title'] = "YouTube";
					$data_website['og_site_name'] = "YouTube";
					$data_website['og_description'] = "Nikmati video dan musik yang Anda suka, upload konten asli, dan bagikan dengan teman, keluarga, serta dunia di YouTube.";

					// ini entah kenapa situsku jadi bahasa filipina, pengen dihapus aja
					$data_website['page_title'] = "YouTube";
					$data_website['description'] = null;
					$data_website['keywords'] = null;

					// ini entah kenapa situsku jadi bahasa filipina
					
					
				}
				// else{
				// 	if ( empty( $data_website['og_image'] ) ) {
				// 		$data_website['media'] = $this->LinkPreviewerModel->getMedia( $url );
				// 	}
				// }
			}
		}

		// final output
		$json = json_encode($data_website);
		echo base64_encode($json);
	}
/**
* LINK PREVIEWER end
*/
}