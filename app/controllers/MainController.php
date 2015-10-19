<?php 
namespace App\Controller;


/**
 * 
 *
 * @package App\Controller
 * @author Mohammed JEMMOUDI
 **/
class MainController {

    public function __construct ( ) {
    	
    }

    public function index ( )
    {
        $path =  $this->uploadFile( $_FILES['photo'] );
        $tesseract = new \TesseractOCR( $path );
        $tesseract->setTempDir('./app/temp-dir');
        $tesseract->setWhitelist(range(0,9));
        $text = $tesseract->recognize();
        echo '<pre>' . $text . '</pre>';
    }

    private function uploadFile ( $file ) {

        $img      = $file['name'];
        $type     = $file['type'];
        $filetype = ["image/png", "image/gif", "image/jpeg"];
        $tmpname  = $file['tmp_name'];
        $folder   = './app/web/images/'; 

        $imgName   = $folder . $img;

        if ( empty($img) || !in_array($type, $filetype) ) {
            return false;
        } else {
            move_uploaded_file($tmpname, $imgName);
            return $imgName;
        }
        
        return false;
    }
} 