<?php
if(!defined('DS'))define('DS', DIRECTORY_SEPARATOR);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__).DS.'DEBUG_error_log.txt');
error_reporting(E_ALL);		//php 5 only


if(!file_exists('config.json')){
	die('File Not Found: '.__DIR__.DS.'config.json');
}

$config=json_decode(file_get_contents('config.json'));

if(empty($config)){
	die('Failed to decode json: config.json');
}

if(!key_exists('easyimage', $config)){
	die('Missing Key: config.json->easyimage');
}

if(!file_exists($config->easyimage)){
	die('File Not Found: config.json->easyimage:\''.$config->easyimage.'\'');
}





$default=dirname(__FILE__).DS;

$file=dirname(__FILE__).DS.urldecode($_GET['file']);
$e_ex=explode('.', $file);
$ext=array_pop($e_ex);
$tint=$_GET['tint'];
//die(print_r($_GET,true));
$rgb=explode(',', $tint);
//$brightness=key_exists('bright', $_GET)?(int)$_GET['bright']:0;
$contrast=key_exists('contrast', $_GET)?(int)$_GET['contrast']:255;
//$smoothness=key_exists('smooth', $_GET)?(int)$_GET['smooth']:0;


$r_0_ex=explode('(', $rgb[0]);
$r_0_po=array_pop($r_0_ex);

$rgb[0]=(int) trim($r_0_po);

$rgb[1]=(int) trim($rgb[1]);

$r_2_ex=explode(')', $rgb[2]);
$r_2_sh=array_shift($r_2_ex);

$rgb[2]=(int) trim($r_2_sh);

if(file_exists($file)&&in_array($ext, array('png', 'jpg', 'gif', 'jpeg'))){
	
	
	//dirname(dirname(dirname(__FILE__))).DS.'library'.DS.'easyimage'.DS.'easyimage.php';
	$toolpath=$config->easyimage;
	include_once $toolpath;
	$image=EasyImage::Open($file);
	$s=EasyImage::GetSize($image);

	$tinted=imagecreatetruecolor($s['w'], $s['h']);
	$color=imagecolorallocatealpha($tinted, $rgb[0], $rgb[1], $rgb[2], 127);
	
	imagefill($tinted, 0, 0, $color);
	
	//imagesavealpha($image, true);
	//$tinted=EasyImage::Open($file);
	//imagesavealpha($tinted, true);
	
	
	//imagefilter($tinted, IMG_FILTER_CONTRAST, $contrast);
	//imagefilter($tinted, IMG_FILTER_BRIGHTNESS, $brightness);
	//imagefilter($tinted, IMG_FILTER_SMOOTH, $smoothness);
	//imagefilter($tinted, IMG_FILTER_COLORIZE, $rgb[0], $rgb[1], $rgb[2]);

	//$s=EasyImage::GetSize($image);
	for($x=0;$x<$s['w'];$x++){
		for($y=0;$y<$s['h'];$y++){
	
			
			$a=imagecolorsforindex($image, imagecolorat($image, $x, $y));
			$t=imagecolorsforindex($tinted, imagecolorat($tinted, $x, $y));
			
			imagesetpixel($tinted, $x, $y, imagecolorallocatealpha($tinted, $t['red'], $t['green'], $t['blue'], $a['alpha']));
			//echo print_r(array($x, $y, $a, $t), true).'<br/>';
		}
	}
	
	imageAlphaBlending($tinted, true);
	imageSaveAlpha($tinted, true);
	//die();
	
	header('Content-Type: image/png;');
	imagepng($tinted);

}else{
	header("HTTP/1.0 404 Not Found");
}

