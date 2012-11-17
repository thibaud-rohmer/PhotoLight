<?
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">  
<html lang="en">  
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
	
	<!-- JS -->
	<script src='resources/library/jquery.js'></script>
	<script src='resources/library/jquery-ui.js'></script>
	
	<!-- CSS -->
	<link rel="stylesheet" href="public_html/css/main.css" />
	<noscript>
	<link rel="stylesheet" href="public_html/css/980.css" />
	</noscript>
	
	<script>
	// Edit to suit your needs.
	var ADAPT_CONFIG = {
	  // Where is your CSS?
	  path: 'public_html/css/',

	  // false = Only run once, when page first loads.
	  // true = Change on window resize and page tilt.
	  dynamic: true,

	  // First range entry is the minimum.
	  // Last range entry is the maximum.
	  // Separate ranges by "to" keyword.
	  range: [
	    '0px    to 760px  = mobile.css',
	    '980px            = large.css'
	  ]
	};
	</script>
	<script src="resources/library/adapt.min.js"></script>
	
	<title>PhotoLight</title> 
</head>