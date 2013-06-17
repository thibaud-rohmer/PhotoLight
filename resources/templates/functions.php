<?php
/**
 * 
 * PHP versions 3, 4 and 5
 *
 * LICENSE:
 * 
 * This file is part of PhotoLight.
 *
 * PhotoLight is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PhotoLight is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PhotoLight.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  Website
 * @package   Photolight
 * @author    Thibaud Rohmer <thibaud.rohmer@gmail.com>
 * @copyright 2011 Thibaud Rohmer
 * @license   http://www.gnu.org/licenses/
 * @link      http://github.com/thibaud-rohmer/PhotoLight
 */


/**
 * List directories in $dir, omit hidden directories
 *
 * @param string $dir 
 * @return void
 * @author Thibaud Rohmer
 */
function list_dirs($dir,$rec=false, $hidden=false){
	
	/// Directories list
	$list=array();

	/// Check that $dir is a directory, or throw exception
	if(!is_dir($dir)) 
		throw new Exception("'".$dir."' is not a directory");
		
	/// Directory content
	$dir_content = scandir($dir);

    if (empty($dir_content)){
        // Directory is empty or no right to read
        return $list;
    }
	
	/// Check each content
	foreach ($dir_content as $content){
		
		/// Content isn't hidden and is a directory
		if(	($content[0] != '.' || $hidden) && is_dir($path=$dir."/".$content)){
			
			/// Add content to list
			$list[]=$path;

			if($rec){
				$list = array_merge($list,list_dirs($dir."/".$content,true));
			}

		}
		
	}

	/// Return directories list
	return $list;
}

/**
 * List files in $dir, omit hidden files
 *
 * @param string $dir 
 * @return void
 * @author Thibaud Rohmer
 */
function list_files($dir,$rec = false, $first = false){
	/// Directories list
	$list=array();
	
	/// Check that $dir is a directory, or throw exception
	if(!is_dir($dir)) 
		throw new Exception("'".$dir."' is not a directory");

	/// Directory content
	$dir_content = scandir($dir);

    if (empty($dir_content)){
        // Directory is empty or no right to read
        return $list;
    }
	
	/// Check each content
	foreach ($dir_content as $content){
		
		/// Content isn't hidden and is a file
		if($content[0] != '.'){
			if(is_file($path=$dir."/".$content)){
				if($first){
					return $path;
				}
				$list[]=$path;
			}else{
				if($rec){
					$list = array_merge($list,list_files($dir."/".$content,true));
				}
			}
		}
	
	}

	/// Return files list
	if($first){
		return $list[0];
	}
	return $list;
}


function nice($t){
	if(strpos($t,"/") > -1){
		return substr($t,strrpos($t,"/")+1);
	}else{
		return $t;
	}
}

function inGoodPlace($f,$path){

	$rf =	realpath($f);
	$rd =	realpath($path);
	
	if($rf == $rd) return true;

	if( substr($rf,0,strlen($rd)) == $rd ){
		return true;
	}
	return false;
}

function output($i){
	$expires = 60*60*24*14;
	$last_modified_time = filemtime($i); 
	$last_modified_time = 0;
	$etag = md5_file($i);
	
	header("Last-Modified: " . 0 . " GMT");
	header("Pragma: public");
	header("Cache-Control: max-age=360000");
	header("Etag: $etag"); 
	header("Cache-Control: maxage=".$expires);
	header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
	header('Content-type: image/jpeg');

	readfile($i);
}


/**
 * Check that $a is inside $b
 *
 * @param string $file 
 * @param string $dir Directory from where the relative path will be (if NULL : photos_dir)
 * @return void
 * @author Thibaud Rohmer
 */
function is_inside($a,$b){
	return substr($b,0,strlen($a)) == $a;
}

/**
 * Absolute path comes in, relative path goes out !
 *
 * @param string $file 
 * @param string $dir Directory from where the relative path will be (if NULL : photos_dir)
 * @return void
 * @author Thibaud Rohmer
 */
function a2r($file,$dir){
	
	$rf	=	realpath($file);
	$rd =	realpath($dir);
	
	if($rf==$rd) return "";

	if( !is_inside($rd,$rf) ){
		throw new Exception("This file is not inside the photos folder !<br/>");
	}

	return ( substr($rf,strlen($rd) + 1 ) );
}

/**
 * Relative path comes in, absolute path goes out !
 *
 * @param string $file 
 * @param string $dir 
 * @return void
 * @author Thibaud Rohmer
 */
function r2a($file,$dir){
	return $dir."/".$file;
}

function breadcrumbs($p){
	$a = array();
	$pos = strpos($p,'/');
	while($pos > 0){
		$a[] = substr($p,0,$pos);
		$p = substr($p,$pos+1);
		$pos = strpos($p,'/');
	}
	if($p != ""){
		$a[] = $p;		
	}
	return $a;
}

function create_thumb($source,$thumb_path,$thumbs_folder_path){
	require_once("resources/library/phpthumb/ThumbLib.inc.php");

	if(!file_exists($thumb_path) || filectime($source) > filectime($thumb_path) ){

        /// Create directories
        if(!file_exists(dirname($thumb_path))){
            @mkdir(dirname($thumb_path),0755,true);
        }

        /// Create thumbnail
		$thumb = PhpThumbFactory::create($source);
		$thumb->resize(200, 200);
		$thumb->save($thumb_path);
		
		/// New !
		$new_file = fopen($thumbs_folder_path."/new.txt","a+");
		fwrite($new_file,realpath($source)."\n");
		
		// read the file in an array.
		$file = file($thumbs_folder_path."/new.txt");

		// slice first 20 elements.
		$file = array_slice($file,0,20);

		// write back to file after joining.
		file_put_contents($thumbs_folder_path."/new.txt",implode("",$file));
	}
}


?>