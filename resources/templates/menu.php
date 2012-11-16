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


$menu_items = list_dirs($dir);
if( count($menu_items)>0 && $dir != $config["path"] ){
	echo "<div class='menu_title'>Current Path</div>";
	foreach ($menu_items as $item){
		$urlitem = $item;
		echo "<div class='menu_item'><a href=\"?f=$urlitem\">".nice($item)."</a></div>";
	}
}

echo "<div class='menu_title'>Main</div>";

echo "<div class='menu_item'><a href='.'>Home</a></div>";

$menu_items = list_dirs($config["path"]);
foreach ($menu_items as $it){
	$item = a2r($it,$config['path']);
	$urlitem = $item;
	echo "<div class='menu_item'><a href=\"?f=$urlitem\">".nice($item)."</a></div>";
}	



?>