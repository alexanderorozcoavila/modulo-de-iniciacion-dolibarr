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

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'
	. $langs->trans("BackToModuleList") . '</a>';
print load_fiche_titre($langs->trans($page_name), $linkback);

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

//header module
echo '<div class="container-fluid">';


echo '
<div class="card-deck mb-3 text-center">
    <div class="card mb-12 box-shadow">
        <div class="card-header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="'.$data_decode['header']['home']['link'].'">'.$langs->trans($data_decode['header']['home']['label']).'</a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    
                    
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <button type="button" class="btn btn-outline-danger">'.$langs->trans($data_decode['header']['init']['label']).' <span class="badge danger">5</span></button>
                    <span data-toggle="modal" data-target="#exampleModal" class="fa fa-question-circle" style="font-size:25px;color:red; margin-left:5px;"></span>
                </form>
                </div>
            </nav>
        </div>
        <div class="card-body">';


        foreach ($data_decode['body-list'] as $d) {
            echo '
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand">
            <span class="fa '.$d['icon'].'" style="font-size:50px;color:#3F729B; margin-left:5px;"></span>
            </a>
            <a class="navbar-brand">
            '.$d['title'].'
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                
            </ul>
            <div class="form-inline my-2 my-lg-0">';
            foreach ($d['list-links'] as $a) {
                echo '<a class="navbar-brand" href="'.$a['link'].'">
                '.$a['title'].'
                </a>';
            }        
            echo '</div>
            </div>
        </nav>';
        }

            
        echo '</div>
    </div>
</div>';

echo '</div>';


dol_include_once('/onboading/core/modules/modOnboading.class.php');
$tmpmodule = new modOnboading($db);
//print $tmpmodule->getDescLong();

echo '<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h4 class="text-center" style="color:#90caf9;margin-bottom: 50px;">Como te podemos ayudar</h4>
      <div class="card-deck mb-3 text-center">
      <div class="card mb-4 box-shadow">
      <span class="fa fa-clipboard" style="font-size:50px;color:#3F729B; margin-left:5px;margin-top:20px;margin-bottom:30px;"></span>
        Guia de Inicio
        <br><br><br><br>
      </div>
      <div class="card mb-4 box-shadow">
      <span class="fa fa-envelope" style="font-size:50px;color:#3F729B; margin-left:5px;margin-top:20px;margin-bottom:30px;"></span>
      Haz una pregunta
      <br><br><br><br>
      </div>
      <div class="card mb-4 box-shadow">
      <span class="fa fa-search" style="font-size:50px;color:#3F729B; margin-left:5px;margin-top:20px;margin-bottom:30px;"></span>
      Busca en nuestro centro de ayuda
      <br><br><br><br>
      </div>
    </div>
      </div>
    </div>
  </div>
</div>';

// Page end
dol_fiche_end();
llxFooter();
$db->close();
