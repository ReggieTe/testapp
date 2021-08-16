<?php 
namespace TestApp\Core;

class Image {

   private $image;
   private $imageType;
   private $width;
   private $height;
   private $rawImage;

   /**
    * 
    * @param type $filename
    */
   public function __construct($filename="") {


      $this->rawImage=(is_file($filename))?$filename:null;

      if ($this->rawImage!=null) {
          switch (filetype($this->rawImage)) {
         case  IMAGETYPE_JPEG:
               $this->image = imagecreatefromjpeg($this->rawImage);
            break;
         case IMAGETYPE_PNG:
               $this->image = imagecreatefrompng($this->rawImage);
            break;
         default:
               return false;
            break;
      }
          $this->width = imagesx($this->image);
          $this->height = imagesy($this->image);
          return true;
      }
      return false;
      
   }


   /**
    * 
    * @param type $filename
    * @param type $image_type
    * @param type $compression
    * @param type $permissions
    */
   public function save($filename='', $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=0755) {

      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {

         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {

         imagepng($this->image,$filename);
      }
      if( $permissions != null) {

         chmod($filename,$permissions);
      }
   }
   /**
    * 
    * @param type $image_type
    */
   public function output($image_type=IMAGETYPE_PNG) {

      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {

         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {

         imagepng($this->image);
      }
   }
   
  
   /**
    * 
    * @param type $height
    */
   public function resizeToHeight($height) {

      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   /**
    * 
    * @param type $width
    */
    public function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
/**
 * 
 * @param type $scale
 */
   public function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }

   /**
    * 
    * @param type $width
    * @param type $height
    */
   public function resize($width=240,$height=240) {
      if($this->image){
         $new_image = imagecreatetruecolor($width, $height);
         imagecopyresampled($new_image,$this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());      
         imagepng($new_image);   
      }
      
   }
   /**
    * 
    * @param type $path
    * @param type $image_type
    * @param type $degrees
    */
   public static function rotate($path, $image_type, $degrees = 120) {

    switch ($image_type) {
        case 'image/png':

            $source = imagecreatefromjpeg($path);
            $bgColor = imagecolorallocatealpha($source, 255, 255, 255, 127);
            $rotate = imagerotate($source, $degrees, $bgColor);
            imagepng($rotate, $path);

            break;

        case 'image/jpeg':

            $source = imagecreatefromjpeg($path);
            $bgColor = imagecolorallocatealpha($source, 255, 255, 255, 127);
            $rotate = imagerotate($source, $degrees, $bgColor);
            imagejpeg($rotate, $path);
        default:
            break;
        
    }
    imagedestroy($source);
}
/**
 * 
 * @param type $target
 * @param type $wtrmrk_file
 * @param type $newcopy
 */
  public static function watermark($target, $wtrmrk_file, $newcopy) {
    
    $watermark = imagecreatefrompng($wtrmrk_file);
    imagealphablending($watermark, false);
    imagesavealpha($watermark, true);
    $img = imagecreatefromjpeg($target);
    $img_w = imagesx($img);
    $img_h = imagesy($img);
    $wtrmrk_w = imagesx($watermark);
    $wtrmrk_h = imagesy($watermark);
    $dst_x = ($img_w / 2) - ($wtrmrk_w / 2); // For centering the watermark on any image
    $dst_y = ($img_h / 2) - ($wtrmrk_h / 2); // For centering the watermark on any image
    imagecopy($img, $watermark, $dst_x, $dst_y, 0, 0, $wtrmrk_w, $wtrmrk_h);
    imagejpeg($img, $newcopy, 100);
    imagedestroy($img);
    imagedestroy($watermark);
}
   
 


   /**
    * Get the value of imageType
    */ 
   public function getImageType()
   {
      return $this->imageType;
   }

   /**
    * Get the value of width
    */ 
   public function getWidth()
   {
      return $this->width;
   }

   /**
    * Get the value of height
    */ 
   public function getHeight()
   {
      return $this->height;
   }

   /**
    * Get the value of rawImage
    */ 
   public function getRawImage()
   {
      return $this->rawImage;
   }
}


