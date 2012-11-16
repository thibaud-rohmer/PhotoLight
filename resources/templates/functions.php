<?php
/**
 * 
 * PHP versions 3, 4 and 5
 *
 * LICENSE:
 * 
 * This file is part of PhotoLight.
 *
 * PhotoShow is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PhotoShow is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PhotoShow.  If not, see <http://www.gnu.org/licenses/>.
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
function list_files($dir,$rec = false, $hidden = false){
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
		if($content[0] != '.' || $hidden){
			if(is_file($path=$dir."/".$content)){
				$list[]=$path;
			}else{
				if($rec){
					$list = array_merge($list,list_files($dir."/".$content,true));
				}
			}
		}
	
	}

	/// Return files list
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
?>