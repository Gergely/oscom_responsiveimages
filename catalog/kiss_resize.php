<?php
// KISS image simple resizer script with direct URL access
// usage: https://yourdomain/kiss_resize.php?file=imagefilename&size=imagewidthinpixel
// gif/png/jpeg/jpg pictures enabled only
// This script takes an image and resizes it to the given sizes for media screens
// Resize by image width

define('DIR_WS_MODULES', 'includes/modules/');

$size = $_GET['size'];
$file = $_GET['file'];

// Configuration section
$imagedir = "images";
$cachedir = DIR_WS_MODULES . 'kiss_image_thumbnailer/thumbs/';
$width = $height = (int)$size;
$alt = $attributes = $parameters = '';
$src = $imagedir . "/" . $file;
$attributes = array( 'alt' => $alt, 'width' => $width, 'height' => $height );

require_once DIR_WS_MODULES . 'kiss_image_thumbnailer/classes/Image.php';
/**
* Helper class to create valid thumbnails on the fly within the tep_image() wrapper
*  
* 
* @license    http://www.gnu.org/licenses/gpl-2.0.html GNU Public License)
* @author     Robert fisher - FWR Media ( www.fwrmedia.co.uk )
* @version     1.0
*/
class Image_Helper extends ArrayObject {
  /**
  * put your comment there...
  * 
  * @var mixed
  */
  protected $_valid_mime = array( 'image/png', 'image/jpeg', 'image/jpg', 'image/gif' );
  /**
  * put your comment there...
  * 
  */
  public function __construct( $input ) {
    parent::__construct( $input, parent::ARRAY_AS_PROPS );  
  } // end constructor
  /**
  * put your comment there...
  * 
  */
  public function assemble() {
    $image_check = $this->_checkImage();
    // Image check is bad so we pass control back to the old OsC image wrapper
    if ( 'abort' == $image_check ) {
      return false;
    }
    // If we have to only we generate a thumb .. this is very resource intensive
    if ( 'no_thumb_required' !== $image_check ) {
      $this->_generateThumbnail();
    }
    return $this->_imageBody();
  } // end method

  public function _imageBody() {
    if (!isset($this->_original_image_info)) {
      $this->_original_image_info = getimagesize ( $this->src );
    }
    return array('mime' => $this->_original_image_info['mime'], 'target' => $this->src);
  }
  /**
  * put your comment there...
  *  // end method
  * @param mixed $attribs
  */
  protected function _checkImage() {
    if ( !is_file ( $this->src ) ) {
      $this->src = $this->default_missing_image;  
    }
    $image_path_parts = pathinfo ( $this->src );
    $this->_image_name = $image_path_parts['basename'];
    $this->_thumb_filename = $this->attributes['width'] . 'x' . $this->attributes['height'] . '_' . $this->_image_name;
    $this->_thumb_src = $this->thumbs_dir_path . $this->_thumb_filename;
    if ( is_readable ( $this->_thumb_src ) ) {
      $this->_calculated_width = $this->attributes['width'];
      $this->_calculated_height = $this->attributes['height'];
      $this->src = $this->_thumb_src;
      return 'no_thumb_required';
    }
    if ( !$this->_original_image_info = getimagesize ( $this->src ) ) {
      return 'abort';
    } 
    if (!in_array ( $this->_original_image_info['mime'], $this->_valid_mime ) ) {
      return 'abort';
    }
  } // end method
  /**
  * put your comment there...
  * 
  */
  protected function _generateThumbnail() {
    if ( $this->attributes['width'] == $this->_original_image_info[0] && $this->attributes['height'] == $this->_original_image_info[1] ) {
      $this->_calculated_width = $this->attributes['width'];
      return $this->_calculated_height = $this->attributes['height'];
    }
    if ( $this->attributes['width'] == 0 || $this->attributes['height'] == 0 ) {
      $this->_calculated_width =  $this->_original_image_info[0];
      return $this->_calculated_height = $this->_original_image_info[1]; 
    }
    //make sure the thumbnail directory exists. 
    if ( !is_writable ( $this->thumbs_dir_path ) ) { 
      trigger_error ( 'Cannot detect a writable thumbs directory!', E_USER_NOTICE );
    }
    if ( is_readable ( $this->_thumb_src ) ) {
      $this->_calculated_width =  (int)$this->attributes['width'];
      $this->_calculated_height = (int)$this->attributes['height'];
      return $this->src = $this->_thumb_src;  
    }
    // resize image
    $image = new Image();
    $image->open( $this->src, $this->thumb_background_rgb )
          ->resize( (int)$this->attributes['width'], (int)$this->attributes['height'] )
          ->save( $this->_thumb_src, (int)$this->thumb_quality );
    $this->_thumbnail = $image;
    $this->_calculated_width = $this->_thumbnail->getWidth();
    $this->_calculated_height = $this->_thumbnail->getHeight();
    $this->src = $this->_thumb_src;
  } // end method
} // end class

$image = new Image_Helper( array( 'src'                   => $src,
                                  'attributes'            => $attributes,
                                  'parameters'            => $parameters,
                                  'default_missing_image' => 'images/no_image_available_150_150.gif',
                                  'isXhtml'               => true,
                                  'thumbs_dir_path'       => $cachedir,
                                  'thumb_quality'         => 75,
                                  'thumb_background_rgb' => array( 'red'   => 255,
                                                                   'green' => 255,
                                                                   'blue'  => 255 ) ) );
if ( false === $image_assembled = $image->assemble() ) {
  echo 'General error';
  die();
}

// Send the file header
header('Content-Type: ' . $image_assembled['mime']);

// Send the file to the browser
readfile($image_assembled['target']);