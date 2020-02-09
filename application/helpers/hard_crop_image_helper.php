<?php
Class resize
{
	private $image;
	private $width;
	private $height;
	private $imageResized;

	function __construct($file)
	{
		$this->image = $this->openImage($file);

		$this->width  = imagesx($this->image);
		$this->height = imagesy($this->image);
	}

	## --------------------------------------------------------

	private function openImage($file)
	{
		$extension = strtolower(strrchr($file, '.'));

		switch($extension)
		{
			case '.jpg':
			case '.jpeg':
				$img = @imagecreatefromjpeg($file);
				break;
			case '.gif':
				$img = @imagecreatefromgif($file);
				break;
			case '.png':
				$img = @imagecreatefrompng($file);
				break;
			default:
				$img = false;
				break;
		}
		
		return $img;
	}

	## --------------------------------------------------------

	public function resizeImage($expected_width, $expected_height, $option="auto")
	{
		$optionArray = $this->getDimensions($expected_width, $expected_height, $option);

		$optimal_width  = $optionArray['optimal_width'];
		$optimal_height = $optionArray['optimal_height'];

		if($option=='crop')
		{
			$this->imageResized = imagecreatetruecolor($expected_width , $expected_height);

			imagecopyresampled(
				$this->imageResized,
				$this->image,
				0 - ($optimal_width - $expected_width) / 2, // center the image horizontally
				0 - ($optimal_height - $expected_height) / 2, // center the image vertically
				0,
				0,
				$optimal_width,
				$optimal_height,
				$this->width,
				$this->height
			);
		}
		else
		{
			$this->imageResized = imagecreatetruecolor($optimal_width, $optimal_height);

			imagecopyresampled(
				$this->imageResized,
				$this->image,
				0,
				0,
				0,
				0,
				$optimal_width,
				$optimal_height,
				$this->width,
				$this->height
			);
		}
	}

	## --------------------------------------------------------

	private function getDimensions($expected_width, $expected_height, $option)
	{
		switch ($option)
		{
			case 'exact':
				$optimal_width = $expected_width;
				$optimal_height= $expected_height;
				break;
			case 'portrait':
				$optimal_width = $this->getSizeByFixedHeight($expected_height);
				$optimal_height= $expected_height;
				break;
			case 'landscape':
				$optimal_width = $expected_width;
				$optimal_height= $this->getSizeByFixedWidth($expected_width);
				break;
			case 'auto':
				$optionArray = $this->getSizeByAuto($expected_width, $expected_height);
				$optimal_width = $optionArray['optimal_width'];
				$optimal_height = $optionArray['optimal_height'];
				break;
			case 'crop':
				$optionArray = $this->getOptimalCrop($expected_width, $expected_height);
				$optimal_width = $optionArray['optimal_width'];
				$optimal_height = $optionArray['optimal_height'];
				break;
		}
		
		return array('optimal_width'=>$optimal_width, 'optimal_height'=>$optimal_height);
	}

	## --------------------------------------------------------

	private function getSizeByFixedHeight($expected_height)
	{
		$ratio = $this->width / $this->height;
		$expected_width = $expected_height * $ratio;
		return $expected_width;
	}

	private function getSizeByFixedWidth($expected_width)
	{
		$ratio = $this->height / $this->width;
		$expected_height = $expected_width * $ratio;
		return $expected_height;
	}

	private function getSizeByAuto($expected_width, $expected_height)
	{
		if ($this->height < $this->width)
		{
			$optimal_width = $expected_width;
			$optimal_height= $this->getSizeByFixedWidth($expected_width);
		}
		elseif ($this->height > $this->width)
		{
			$optimal_width = $this->getSizeByFixedHeight($expected_height);
			$optimal_height= $expected_height;
		}
		else
		{
			if($expected_height < $expected_width)
			{
				$optimal_width = $expected_width;
				$optimal_height= $this->getSizeByFixedWidth($expected_width);
			}
			elseif($expected_height > $expected_width)
			{
				$optimal_width = $this->getSizeByFixedHeight($expected_height);
				$optimal_height= $expected_height;
			}
			else
			{
				$optimal_width = $expected_width;
				$optimal_height= $expected_height;
			}
		}

		return array('optimal_width'=>$optimal_width, 'optimal_height'=>$optimal_height);
	}

	## --------------------------------------------------------

	private function getOptimalCrop($expected_width, $expected_height)
	{
		$original_aspect = $this->width / $this->height;
		$thumb_aspect = $expected_width / $expected_height;

		if($original_aspect >= $thumb_aspect)
		{
		   $optimal_height = $expected_height;
		   $optimal_width = $this->width / ($this->height / $expected_height);
		}
		else
		{
		   $optimal_width = $expected_width;
		   $optimal_height = $this->height / ($this->width / $expected_width);
		}

		return array('optimal_width'=>$optimal_width, 'optimal_height'=>$optimal_height);
	}

	## --------------------------------------------------------

	public function saveImage($savePath, $imageQuality="100")
	{
		$extension = strrchr($savePath, '.');
		$extension = strtolower($extension);

		switch($extension)
		{
			case '.jpg':
			case '.jpeg':
				if(imagetypes() & IMG_JPG)
				{
					imagejpeg($this->imageResized, $savePath, $imageQuality);
				}
				break;

			case '.gif':
				if(imagetypes() & IMG_GIF)
				{
					imagegif($this->imageResized, $savePath);
				}
				break;

			case '.png':
				$scaleQuality = round(($imageQuality/100) * 9);

				$invertScaleQuality = 9 - $scaleQuality;

				if(imagetypes() & IMG_PNG)
				{
					imagepng($this->imageResized, $savePath, $invertScaleQuality);
				}
				break;

			default:
				break;
		}

		imagedestroy($this->imageResized);
	}
}

function crop_image($url, $width=150, $height=150, $data=array())
{
	if($url)
	{
		$method = isset($data['method']) ? $data['method'] : 'url';
		$result = isset($data['result']) ? $data['result'] : 'url';
		$crop = isset($data['crop']) ? $data['crop'] : 'crop';
		$class = isset($data['class']) ? $data['class'] : '';
	
		if($method=='html')
		{
			/*$doc = new DOMDocument();
			$doc->encoding = 'utf-8';
			$doc->loadHTML(utf8_decode($url));
			$xpath = new DOMXPath($doc);
			$url = $img_url = $xpath->evaluate("string(//img/@src)");*/
		
			/*$img_slice = explode('src="', $url);
			$img_src = end($img_slice);
			$img_url = explode('"', $img_src);
			$url = $img_url = $img_url[0];*/
			
			preg_match('@src="([^"]+)"@' , $url, $match);
			$url = $img_url = array_pop($match);
		}
		
		$file_ext = pathinfo($url, PATHINFO_EXTENSION);
		$file_ext_new = '-'.$width.'x'.$height.'.'.$file_ext;
		$file_path = explode("/", $url);
		$file_path = end($file_path);
		$file_name = str_replace('.'.$file_ext, $file_ext_new, $file_path);
		
		/*$dir_name = dirname($url);	
		$file_dir = explode("uploads", $dir_name);
		$file_dir = end($file_dir);
		$file_dir = !empty($file_dir) ? $file_dir.'/' : '';*/
		
		$file_save_to = 'uploads/'.$file_name;
		
		if(!file_exists(($file_save_to)))
		{
			// server purpose only
			//$file = str_replace(array('https://www.', 'https://'), '/var/www/', $url);
			$file = $url;
			//$file = str_replace(array('https://www.trocandofraldas.com.br', 'https://test.trocandofraldas.com.br'), '/var/www/trocandofraldas.com.br/htdocs', $url);
			
			// *** 1) Initialise / load image
			$resizeObj = new resize($file);

			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			$resizeObj->resizeImage($width, $height, $crop);

			// *** 3) Save image ('image-name', 'quality [int]')
			$resizeObj->saveImage($file_save_to, 100);
		}
		
		if($result=='url')
		{
			return base_url($file_save_to);
		}
		elseif($result=='html')
		{
			return '<img src="'.base_url($file_save_to).'" class="'.$class.'">';
		}
	}
}