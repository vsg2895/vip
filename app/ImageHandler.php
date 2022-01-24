<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ImageOriginal;

class ImageHandler extends Model
{
    // Image
    public $image;
	
    // Image Type
    public $image_type;

    // Validation
	public function __construct($filename = null){
		if (!empty($filename)) {
			$this->load($filename);
		}
	}

    // Load
	public function loadImg($filename) {
		$image_info = getimagesize($filename);
		$this->image_type = $image_info[2];

		if ($this->image_type == IMAGETYPE_JPEG) {
			$this->image = imagecreatefromjpeg($filename);
		} elseif ($this->image_type == IMAGETYPE_GIF) {
			$this->image = imagecreatefromgif($filename);
		} elseif ($this->image_type == IMAGETYPE_PNG) {
			$this->image = imagecreatefrompng($filename);
		} elseif ($this->image_type == IMAGETYPE_WEBP) {
			$this->image = imagecreatefromwebp($filename);
		} else {
			throw new Exception("The file you're trying to open is not supported");
		}
	}

    // Save
	public function saveImg($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null) {
		if ($image_type == IMAGETYPE_JPEG) {
			imagejpeg($this->image,$filename,$compression);
		} elseif ($image_type == IMAGETYPE_GIF) {
			imagegif($this->image,$filename);         
		} elseif ($image_type == IMAGETYPE_PNG) {
			imagepng($this->image,$filename);
		}

		if ($permissions != null) {
			mo($filename,$permissions);
		}
	}

    // Output
	public function outputImg($image_type=IMAGETYPE_JPEG, $quality = 80) {
		if ($image_type == IMAGETYPE_JPEG) {
			header("Content-type: image/jpeg");
			imagejpeg($this->image, null, $quality);
		} elseif ($image_type == IMAGETYPE_GIF) {
			header("Content-type: image/gif");
			imagegif($this->image);         
		} elseif ($image_type == IMAGETYPE_PNG) {
			header("Content-type: image/png");
			imagepng($this->image);
		}
	}

    // Get width
	public function getWidthImg() {
		return imagesx($this->image);
	}
    
    // Get height
	public function getHeightImg() {
		return imagesy($this->image);
	}

    // Resize to height
	public function resizeToHeightImg($height) {
        $ratio = $height / $this->getHeightImg();
        $width = round($this->getWidthImg() * $ratio);
        $this->resizeImg($width,$height);
	}
    
    // Resize to width
	public function resizeToWidthImg($width) {
        $ratio = $width / $this->getWidthImg();
        $height = round($this->getHeightImg() * $ratio);
        $this->resizeImg($width,$height);
	}

    // Resize
	public function resizeImg($width,$height) {
		$new_image = imagecreatetruecolor($width, $height);
		
        imagefill($new_image, 0, 0, imagecolorallocate($new_image, 255, 255, 255));
		
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidthImg(), $this->getHeightImg());
		$this->image = $new_image;
	}
    // Scale
	public function scaleImg($scale) {
		$width = round($this->getWidthImg() * $scale/100);
		$height = round($this->getHeightImg() * $scale/100);
		$this->resizeImg($width,$height);
	}

    // Max area
	public function maxareaImg($width, $height = null)	{
		$height = $height ? $height : $width;
		
		if ($this->getWidthImg() > $width) {
			$this->resizeToWidthImg($width);
		}
		if ($this->getHeightImg() > $height) {
			$this->resizeToheightImg($height);
		}
	}

	// Min area
	public function minareaImg($width, $height = null)	{
		$height = $height ? $height : $width;
		
		if ($this->getWidthImg() < $width) {
			$this->resizeToWidthImg($width);
		}
		if ($this->getHeightImg() < $height) {
			$this->resizeToheightImg($height);
		}
	}

    // Max area fill
    public function maxareafillImg($width, $height, $red = 0, $green = 0, $blue = 0) {
	    $this->maxarea($width, $height);
	    $new_image = imagecreatetruecolor($width, $height);
	    $color_fill = imagecolorallocate($new_image, $red, $green, $blue);
	    imagefill($new_image, 0, 0, $color_fill);
	    imagecopyresampled($new_image, $this->image, floor(($width - $this->getWidthImg()) / 2), floor(($height - $this->getHeightImg()) / 2), 0, 0, $this->getWidthImg(), $this->getHeightImg(), $this->getWidthImg(), $this->getHeightImg());
	    $this->image = $new_image;
	}
    
    // CutImg
    public function cutImg($x, $y, $width, $height) {
    	$new_image = imagecreatetruecolor($width, $height);	

		imagefill($new_image, 0, 0, imagecolorallocate($new_image, 255, 255, 255));

		imagecopy($new_image, $this->image, 0, 0, $x, $y, $width, $height);

		$this->image = $new_image;
	}

    // CutImg from center
	public function cutImgFromCenterImg($width, $height) {
        
        if($width > $this->getWidthImg()) {
            $this->resizeToWidthImg($width);
        }
        if($height > $this->getHeightImg()) {
            $this->resizeToHeightImg($height);
        }
        
		$x = ($this->getWidthImg() / 2) - ($width / 2);
		$y = ($this->getHeightImg() / 2) - ($height / 2);
		
		return $this->cutImg($x, $y, $width, $height);
	}

    // Crop
    public function cropImg($width, $height) {

        $ratio_source = $this->getWidthImg() / $this->getHeightImg();
        $ratio_dest = $width / $height;

        if ($ratio_dest < $ratio_source) {
            $this->resizeToHeightImg($height);
        } else {
            $this->resizeToWidthImg($width);
        }

        $x = ($this->getWidthImg() / 2) - ($width / 2);
        $y = ($this->getHeightImg() / 2) - ($height / 2);

        return $this->cutImg($x, $y, $width, $height);
    }

	// Remove old image
	public function removeOldImg($path){
		// Check image existing
		if(file_exists($path) && $path != NULL){
			// Unlink File
			unlink($path);
		}
	}

    // Watermark
    public function watermarkImg($right, $bottom, $watermark_url = 'watermarks/user/logo.png') {
        $new_image = imagecreatetruecolor($this->getWidthImg(), $this->getHeightImg());	
        
        $watermark = imagecreatefrompng($watermark_url);
        
        $x = imagesx($watermark);
        $y = imagesy($watermark);
        
        imagecopy($this->image, $watermark, imagesx($this->image) - $x - $right, imagesy($this->image) - $y - $bottom, 0, 0, imagesx($watermark), imagesy($watermark));
    }
}