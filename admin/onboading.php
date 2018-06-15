<?php
/* Copyright (C) 2004-2017 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) ---Put here your own copyright and developer email---
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
 * \file    htdocs/modulebuilder/template/admin/about.php
 * \ingroup mymodule
 * \brief   About page of module MyModule.
 */

// Load Dolibarr environment
$res=0;
// Try main.inc.php into web root known defined into CONTEXT_DOCUMENT_ROOT (not always defined)
if (! $res && ! empty($_SERVER["CONTEXT_DOCUMENT_ROOT"])) $res=@include($_SERVER["CONTEXT_DOCUMENT_ROOT"]."/main.inc.php");
// Try main.inc.php into web root detected using web root caluclated from SCRIPT_FILENAME
$tmp=empty($_SERVER['SCRIPT_FILENAME'])?'':$_SERVER['SCRIPT_FILENAME'];$tmp2=realpath(__FILE__); $i=strlen($tmp)-1; $j=strlen($tmp2)-1;
while($i > 0 && $j > 0 && isset($tmp[$i]) && isset($tmp2[$j]) && $tmp[$i]==$tmp2[$j]) { $i--; $j--; }
if (! $res && $i > 0 && file_exists(substr($tmp, 0, ($i+1))."/main.inc.php")) $res=@include(substr($tmp, 0, ($i+1))."/main.inc.php");
if (! $res && $i > 0 && file_exists(dirname(substr($tmp, 0, ($i+1)))."/main.inc.php")) $res=@include(dirname(substr($tmp, 0, ($i+1)))."/main.inc.php");
// Try main.inc.php using relative path
if (! $res && file_exists("../../main.inc.php")) $res=@include("../../main.inc.php");
if (! $res && file_exists("../../../main.inc.php")) $res=@include("../../../main.inc.php");
if (! $res) die("Include of main fails");

// Libraries
require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';
require_once '../lib/onboading.lib.php';

// Translations
$langs->load("errors");
$langs->load("admin");
$langs->load("onboading@onboading");

// Access control
if (! $user->admin) {
	accessforbidden();
}

// Parameters
$action = GETPOST('action', 'alpha');


/*
 * Actions
 */

// None


/*
 * View
 */

$form = new Form($db);

$page_name = "Onboading";
llxHeader('', $langs->trans($page_name));


// Configuration header
//$head = onboadingAdminPrepareHead();
//dol_fiche_head(
//	$head,
//	'about',
//	$langs->trans("Onboading"),
//	0,
//	'mymodule@mymodule'
//);

// About page goes here
//echo $langs->trans("MyModuleAboutPage");


$data = file_get_contents("../config/index.json");
$data_decode = json_decode($data, true);


print '
<div class="Rectangle-5">
    <div class="Inicio">
    <label>'.$data_decode['header']['home']['label'].'</label>
    </div>
    
    <div class="Group-9">
        <img src="'.$data_decode['header']['help']['icon-src'].'" 
        srcset="'.$data_decode['header']['help']['icon-srcset'].'">    
    </div>
    <div class="Rectangle-11">
    <div class="Comenzar"><label for="modal-trigger-center" class="open-modal">'.$data_decode['header']['init']['label'].'</label></div>
    <div class="layer">9</div>
    </div>

    <div class="div_line">
        <hr class="Line">
    </div>';

    foreach ($data_decode['body-list'] as $d) {
    echo '    <div class="div_list_img">
            <img src="'.$d['icon-src'].'" class="img_list_center"/>
        </div>
        <div class="div_list_text">
        <table height="90px" cellspacing="0" cellpadding="0">
            <tr height="45px">
                <td style="vertical-align:bottom;">
                    <span class="title_list">'.$d['title'].'</span>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: baseline;">
                    <span class="description_list">'.$d['description'].'</span>
                </td>
            </tr>
        </table>
        </div>
        <div class="div_list_link">';
        foreach ($d['list-links'] as $a) {
        echo '<div class="div_list_link_item"><a href="'.$a['link'].'">'.$a['title'].'</a></div>';
        }
        echo '</div>

        <div class="div_line_list">
            <hr class="Line">
        </div>';
    }
echo '</div>';


echo '<!-- Bottom modal -->
<div class="modal">
        <input id="modal-trigger-center" class="checkbox" type="checkbox">
        <div class="modal-overlay">
          <label for="modal-trigger-center" class="o-close"></label>
          <div class="modal-wrap a-center">
            <label for="modal-trigger-center" class="close">x</label>
            <h2>This is the modal content</h2>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique cum sequi maxime officia provident voluptatibus aut! Non autem asperiores repellat architecto laboriosam officiis ab libero enim illo animi, error alias.
            </p>
          </div>
        </div>
      </div>
<!-- End Modal -->
<script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>';
/*



<div class="Rectangle-5">
    <div class="Inicio">
        
    </div>
    <div class="Group-9">
        <img src="../img/group-9.png"
            srcset="../img/group-9@2x.png 2x,
                    ../img/group-9@3x.png 3x">    
    </div>
</div>


*/

dol_include_once('/onboading/core/modules/modOnboading.class.php');
$tmpmodule = new modOnboading($db);

// Page end
dol_fiche_end();
llxFooter();
$db->close();
