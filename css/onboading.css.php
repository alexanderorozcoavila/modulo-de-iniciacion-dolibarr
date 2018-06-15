
<?php
/* Copyright (C) ---Put here your own copyright and developer email---
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * \file    htdocs/modulebuilder/template/css/mymodule.css.php
 * \ingroup mymodule
 * \brief   CSS file for module MyModule.
 */

//if (! defined('NOREQUIREUSER')) define('NOREQUIREUSER','1');	// Not disabled because need to load personalized language
//if (! defined('NOREQUIREDB'))   define('NOREQUIREDB','1');	// Not disabled. Language code is found on url.
if (! defined('NOREQUIRESOC'))    define('NOREQUIRESOC','1');
//if (! defined('NOREQUIRETRAN')) define('NOREQUIRETRAN','1');	// Not disabled because need to do translations
if (! defined('NOCSRFCHECK'))     define('NOCSRFCHECK',1);
if (! defined('NOTOKENRENEWAL'))  define('NOTOKENRENEWAL',1);
if (! defined('NOLOGIN'))         define('NOLOGIN',1);          // File must be accessed by logon page so without login
//if (! defined('NOREQUIREMENU'))   define('NOREQUIREMENU',1);  // We need top menu content
if (! defined('NOREQUIREHTML'))   define('NOREQUIREHTML',1);
if (! defined('NOREQUIREAJAX'))   define('NOREQUIREAJAX','1');

// Load Dolibarr environment
$res=0;
// Try main.inc.php into web root known defined into CONTEXT_DOCUMENT_ROOT (not always defined)
if (! $res && ! empty($_SERVER["CONTEXT_DOCUMENT_ROOT"])) $res=@include($_SERVER["CONTEXT_DOCUMENT_ROOT"]."/main.inc.php");
// Try main.inc.php into web root detected using web root caluclated from SCRIPT_FILENAME
$tmp=empty($_SERVER['SCRIPT_FILENAME'])?'':$_SERVER['SCRIPT_FILENAME'];$tmp2=realpath(__FILE__); $i=strlen($tmp)-1; $j=strlen($tmp2)-1;
while($i > 0 && $j > 0 && isset($tmp[$i]) && isset($tmp2[$j]) && $tmp[$i]==$tmp2[$j]) { $i--; $j--; }
if (! $res && $i > 0 && file_exists(substr($tmp, 0, ($i+1))."/main.inc.php")) $res=@include(substr($tmp, 0, ($i+1))."/main.inc.php");
if (! $res && $i > 0 && file_exists(substr($tmp, 0, ($i+1))."/../main.inc.php")) $res=@include(substr($tmp, 0, ($i+1))."/../main.inc.php");
// Try main.inc.php using relative path
if (! $res && file_exists("../../main.inc.php")) $res=@include("../../main.inc.php");
if (! $res && file_exists("../../../main.inc.php")) $res=@include("../../../main.inc.php");
if (! $res) die("Include of main fails");

require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';

session_cache_limiter(FALSE);

// Load user to have $user->conf loaded (not done by default here because of NOLOGIN constant defined) and load permission if we need to use them in CSS
/*if (empty($user->id) && ! empty($_SESSION['dol_login']))
{
    $user->fetch('',$_SESSION['dol_login']);
	$user->getrights();
}*/


// Define css type
header('Content-type: text/css');
// Important: Following code is to cache this file to avoid page request by browser at each Dolibarr page access.
// You can use CTRL+F5 to refresh your browser cache.
if (empty($dolibarr_nocache)) header('Cache-Control: max-age=3600, public, must-revalidate');
else header('Cache-Control: no-cache');

?>


// .body{ text-align: center; }
.cont{ width: 100%; margin: 0 auto 0 auto; text-align: left;}
// .encabezado{ height: 32px; margin-bottom: 40px; width: 693px;}
.contenido{ width: 300px;  border:1px solid #000;}
.menu{ width: 300px; text-transform: uppercase;border:1px solid #000;}
// .pie{ clear: both; height: 296px;}


.fiche{
    margin-left: 0px !important;
margin-right: 0px !important;
margin-top: -16px !important;
}

.Inicio {
font-family: Roboto;
font-size: 22px;
font-weight: 300;
font-style: normal;
font-stretch: normal;
line-height: 1.45;
letter-spacing: 0.6px;
color: #0a4d7c;
float:left;
margin-top:48px;
margin-left:16px;
width: 56px;
height: 32px;
}


.Rectangle-5 {
width: 100%;
height: 904px;
opacity: 0.99;
background-color: #f9f9f9;
}

.Rectangle-11 {
  width: 128px;
  height: 32px;
  border-radius: 3px;
  float:right;
  border: solid 1px #b10053;
  margin-top:48px;
  margin-right:16px;
  background-color: #ffffff;
}

.Comenzar {
  width: 72px;
  height: 16px;
  margin-left:16px;
  margin-top:5px;
  font-family: Roboto;
  font-size: 14px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: normal;
  letter-spacing: normal;
  color: #b10053;
}

.layer {
  width: 16px;
  height: 16px;
  font-family: Roboto;
  font-size: 14px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: normal;
  letter-spacing: normal;
  text-align: center;
  color: #ffffff;
}

.Group-9 {
  
  height: 32px;
  object-fit: contain;
  float:right;
  margin-top:48px;
  margin-right:16px;
}
.Group-9 img {
  width: 32px;
  height: 32px;
}

.Line {
  width: 100%;
  height: 3px;
  border: solid 1px #eaeaea;
}

.div_line{
  float:left;
  width: 98%;
  margin-top:15px;
  margin-left:8px;
}

.div_line_list{
  float:left;
  width: 98%;
  margin-top:0px;
  margin-left:8px;
}

.div_list_img{
  float:left;
  margin-left:8px;
  height: 90px;
  width:120px;
  display: inline-block;
  vertical-align: top;
  position: relative;
}

.img_list_center{
  max-height: 100%;
  max-width: 100%;
  width: auto;
  height: auto;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}

.div_list_text{
  float:left;
  margin-left:0px;
  height: 90px;
  
  width:280px;
}

.title_list{
  width: 208px;
  height: 16px;
  font-family: Roboto;
  font-size: 14px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: normal;
  letter-spacing: normal;
  color: #0a4d7c;
}

.description_list {
  width: 384px;
  height: 16px;
  font-family: Roboto;
  font-size: 12px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: 1.33;
  letter-spacing: normal;
  color: #9b9b9b;
}

.div_list_link{
  
  float:right;
  margin-right:16px;
  height: 90px;
  width:600px;
 
}

.div_list_link_item{
    float:right;
  margin-right:15px;
  margin-top:30px;
  border-left: solid 1px #eaeaea;
}

.div_list_link_item a{
  height: 32px;
  font-family: Roboto;
  font-size: 12px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: 2.29;
  letter-spacing: normal;
  text-align: center;
  color: #b10053;
  margin-left:15px;
}

.divider2 {
  width: 2px;
  height: 32px;
  border: solid 1px #eaeaea;
}
