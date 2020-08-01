
  <script type="text/javascript">
    function encodeBase64(string){
      // Encode the String
      var encodedString = window.btoa(string);
      return(encodedString);
    }
    function link_previewer_main(attr_val, element, URL_FOR_API){

      var target = $(".wadah_previewer-"+attr_val); // indexer untuk target
      
      let is_there_link = element.val().search('http'); // hanya jalankan kalo ada http
      // alert(n)
      if ( element.val().length > 8 && is_there_link > -1 ) { // hanya jalan kalau lebih dari 8 karakter
        let content = null; // inisialisasi
        var link = element.val();
        var encodedLink = encodeBase64(link);
        // slash diganti jadi "garis_miring" biar bisa kebaca sama CodeIgniter
        encodedLink = encodedLink.replace( "/", "garis_miring" );
        var url = URL_FOR_API+encodedLink;
        
        var request = $.get(url, function(data_mentah, status){
          console.log(data_mentah)
          var data = JSON.parse(data_mentah); // ternyata json harus diparse dulu, hehe. gak bisa langsung diakses

            if ( data.status == "gagal" ) { // kalau status isinya gagal, maka jangan dieksekusi
              close_previewer(attr_val, target);
            }
            else if ( data.status == "berhasil" ) {
              
              if ( data.og_image ) {
                let content = '<img class="previewer_gambar" src="'+data.og_image+'">';
                target.append(content);
                // console.log(data.og_image)
              }
              // Di sini meta og yang jadi prioritas untuk ditampilkan
              if ( data.og_title ) {
                content = '<p class="previewer_title">'+data.og_title+'</p>';
                target.append(content);
              }
              else if( data.page_title ){
                content = '<p class="previewer_title">'+data.page_title+'</p>';
                target.append(content);
              }

              if ( data.og_site_name ) {
                content = '<p class="previewer_url">'+data.og_site_name+'</p>';
                target.append(content);
              }
              if (  data.og_description ) {
                content = '<p class="previewer_description">'+data.og_description+'</p>';
                target.append(content);
              }else if( data.meta_tags.description  ){
                content = '<p class="previewer_description">'+data.meta_tags.description+'</p>';
                target.append(content);
              }

              content = '<a class="previewer_close" href="javascript:void(0)" onclick="close_previewer(\''+attr_val+'\')">x</a>';
              target.append(content);

              target.show(400);
            }

        });
      }
      
    }

    function close_previewer(attr_val){
      var target = $(".wadah_previewer-"+attr_val); // indexer untuk target
      target.hide(400); // sembunyikan pakai animasi
      setTimeout( function(){ 
        target.remove(); // hapus setelah 500 ms
      }, 500 );
    }

    function run_link_previewer(attr_val, URL_FOR_API){

      setTimeout((function() { // dikasih batas 1 detik biar prosesnya ga numpuk2

          let element = $('[koreksoft=\"'+attr_val+'\"]'); // indexer untuk element / textarea sumber dari link

          if ( element.length > 0 ) {
            close_previewer(attr_val, target);
          }

          element.attr('oninput','run_link_previewer("'+attr_val+'","'+URL_FOR_API+'")'); // menambahkan HTML DOM ke dalam element

          let content = '<div class="wadah_previewer-'+attr_val+'" style="display: none;"></div>'; // ketika muncul tidak boleh ditampilkan
          $( content ).insertBefore( element ); // menambah wadah previewer di atas element

          var target = $(".wadah_previewer-"+attr_val); // indexer untuk target
          if ( attr_val == '' ) {
            alert('0 ERROR .widibaka');
          }
          
          link_previewer_main(attr_val, element, URL_FOR_API);

      }), 1000);

      
    }

    var marker = 'textarea_satu';
    var API_URL = 'http://localhost/widibaka-link-previewer/services/link_previewer_api/';

    run_link_previewer( marker, API_URL );


  </script>