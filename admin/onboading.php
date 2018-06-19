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
// if (! $user->admin) {
// 	accessforbidden();
// }

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
print "<style>
@import url('https://fonts.googleapis.com/css?family=Roboto');
</style>";

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
//print $_SERVER["PHP_SELF"];
//print_r($conf);


// Show info setup company
$correo_box = "div_line_modal_correo_active";
$correo_line = "Line3_active";
$correo_text = "text_status_modal_active";
$correo_text_text = '<img src="../img/path-2.png" srcset="../img/path-2@2x.png 2x,../img/path-2@3x.png 3x"> TERMINADO';
$c = 30;
$c1 =0;

$empresa_box = "div_line_modal_empresa_active";
$empresa_line = "Line3_active";
$empresa_text = "text_status_modal_active";
$empresa_text_text = '<img src="../img/path-2.png" srcset="../img/path-2@2x.png 2x,../img/path-2@3x.png 3x"> TERMINADO';
$e = 40;
$c1 = 0;


$equipo_box = "div_line_modal_equipo_active";
$equipo_line = "Line3_active";
$equipo_text = "text_status_modal_active";
$equipo_text_text = '<img src="../img/path-2.png" srcset="../img/path-2@2x.png 2x,../img/path-2@3x.png 3x"> TERMINADO';
$q = 30;
$q1 = 0;



if (empty($conf->global->MAIN_INFO_SOCIETE_NOM) || empty($conf->global->MAIN_INFO_SOCIETE_COUNTRY)) $setupcompanynotcomplete=1;
//print img_picto('','puce').' '.$langs->trans("SetupDescription3", DOL_URL_ROOT.'/admin/company.php?mainmenu=home'.(empty($setupcompanynotcomplete)?'':'&action=edit'), $langs->transnoentities("Setup"), $langs->transnoentities("MenuCompanySetup"));
if (! empty($setupcompanynotcomplete))
{
	$empresa_box = "div_line_modal_empresa";
    $empresa_line = "Line3";
    $empresa_text = "text_status_modal";
    $empresa_text_text = "X SIN COMPLETAR";
    $e = 0;
    $e1 = 1;

}


if (empty($conf->global->MAIN_MAIL_SMTP_SERVER) || empty($conf->global->MAIN_MAIL_SMTP_PORT)) $setupmailnotcomplete=1;
//print img_picto('','puce').' '.$langs->trans("SetupDescription3", DOL_URL_ROOT.'/admin/company.php?mainmenu=home'.(empty($setupcompanynotcomplete)?'':'&action=edit'), $langs->transnoentities("Setup"), $langs->transnoentities("MenuCompanySetup"));
if (! empty($setupmailnotcomplete))
{
	$correo_box = "div_line_modal_correo";
    $correo_line = "Line3";
    $correo_text = "text_status_modal";
    $correo_text_text = "X SIN COMPLETAR";
    $c = 0;
    $c1 = 1;
}

$sql = "SELECT u.rowid, u.lastname, u.firstname, u.admin, u.login, u.fk_soc, u.datec, u.statut";
$sql.= ", u.entity";
$sql.= ", u.ldap_sid";
$sql.= ", u.photo";
$sql.= ", u.admin";
$sql.= ", u.email";
$sql.= ", u.skype";
$sql.= ", s.nom as name";
$sql.= ", s.code_client";
$sql.= ", s.canvas";
$sql.= " FROM ".MAIN_DB_PREFIX."user as u";
$sql.= " LEFT JOIN ".MAIN_DB_PREFIX."societe as s ON u.fk_soc = s.rowid";
if (! empty($conf->multicompany->enabled) && $conf->entity == 1 && ($conf->global->MULTICOMPANY_TRANSVERSE_MODE || ($user->admin && ! $user->entity)))
{
	$sql.= " WHERE u.entity IS NOT NULL";
}
else
{
	$sql.= " WHERE u.entity IN (0,".$conf->entity.")";
}
if (!empty($socid)) $sql.= " AND u.fk_soc = ".$socid;
$sql.= $db->order("u.datec","DESC");
$sql.= $db->plimit($max);

$resql=$db->query($sql);
if ($resql)
{
    $num = $db->num_rows($resql);
}

if($num==1){
    $equipo_box = "div_line_modal_equipo";
    $equipo_line = "Line3";
    $equipo_text = "text_status_modal";
    $equipo_text_text = 'X SIN COMPLETAR';
    $q = 0;
    $q1 = 1;
}

$c_progress = $c + $e + $q;
$c_circle =  $c1 + $e1 + $q1;



$data = file_get_contents("../config/list.json");
$data_decode = json_decode($data, true);


print ' <div class="Rectangle-5">
            <div class="Inicio">
                <label>'.$data_decode['header']['home']['label'].'</label>
            </div>
            <div class="Group-9">
                <label for="modal-trigger-center2" class="open-modal">
                    <img src="'.$data_decode['header']['help']['icon-src'].'" 
                    srcset="'.$data_decode['header']['help']['icon-srcset'].'">
                </label>    
            </div>
            <div class="Rectangle-11">
                <div class="Comenzar">
                    <table  cellspacing="0" cellpadding="0" style="width: 128px;
                    height: 32px;">
                        <tr>
                            <td style="vertical-align: middle;text-align: right;cursor:pointer;color:#b10053;" width="88px">
                                <label for="modal-trigger-center" class="open-modal" style="cursor:pointer;color:#b10053;">
                                    '.$data_decode['header']['init']['label'].'
                                </label>
                            </td>
                            <td style="vertical-align: middle;text-align: center;">
                            <span for="modal-trigger-center" class="open-modal" style="    background: #bf073a;
                            border-radius: 0.8em;
                            height: 16px;
                            -moz-border-radius: 0.8em;
                            -webkit-border-radius: 0.8em;
                            color: #ffffff;
                            display: inline-block;
                            font-size: 12px;
                            text-align: center;
                            width: 16px;
                            cursor:pointer;">
                            <label for="modal-trigger-center" class="open-modal" style="cursor:pointer;">
                            '.$c_circle.'
                            </label>
                            </span>
                            </td>
                        </tr>
                    </table>
                </div>
                
            </div>
            <div class="div_line">
                <hr class="Line">
            </div>';
foreach ($data_decode['body-list'] as $d) {
print '     <div class="div_list_img">
                <img src="'.$d['icon-src'].'" class="img_list_center"/>
            </div>
            <div class="div_list_text">
                <table height="90px" cellspacing="0" cellpadding="0">
                    <tr height="45px">
                        <td style="vertical-align:bottom;">
                            <span class="title_list">'.$d['title'].'</span>
                        </td>
                    </tr>
                    <tr height="45px">
                        <td style="vertical-align: baseline;">
                            <span class="description_list">'.$d['description'].'</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="div_list_link">';
foreach ($d['list-links'] as $a) {
print '     <div class="div_list_link_item">
                <a href="'.$a['link'].'">'.$a['title'].'</a>
            </div>';
}
print ' </div>
        <div class="div_line_list">
            <hr class="Line">
        </div>';
}
print ' </div>';

//inicio de modal
$modal = file_get_contents("../config/modal.json");
$modal_decode = json_decode($modal, true);

print ' <div class="modal">
            <input id="modal-trigger-center" class="checkbox" type="checkbox">
            <div class="modal-overlay">
                <label for="modal-trigger-center" class="o-close"></label>
            <div class="modal-wrap a-center">
                <label for="modal-trigger-center" class="close">x</label>
                <div class="cabecera_modal_init">
                    <table height="40px" cellspacing="0" cellpadding="0">
                        <tr height="24px">
                            <td style="vertical-align:bottom;">
                                <span class="text_modal_init_title">'.$modal_decode['init']['title'].'</span>
                            </td>
                        </tr>
                        <tr height="16px">
                            <td style="vertical-align: baseline;">
                                <span class="text_modal_init_subtitle">'.$modal_decode['init']['subtitle'].'</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cabecera_modal_circle_progress">
                    <div class="c100 p'.$c_progress.' small green">
                        <span>'.$c_progress.'%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
                <div class="div_line_modal">
                    <hr class="Line">
                </div>

                <div class="'.$correo_box.'">
                    <div class="div_icon_modal_correo">
                        <img src="../img/ic-markunread.png"
                         srcset="../img/ic-markunread@2x.png 2x,
                                 ../img/ic-markunread@3x.png 3x"
                         class="ic_markunread">
                    </div>
                    <div class="div_text_modal_correo">
                        <a class="modal_title_1" href="'.DOL_URL_ROOT.'/'.$modal_decode['init']['link-correo'].'">'.$modal_decode['init']['text1-correo'].'</a>
                        <br>
                        <span class="modal_title_2">'.$modal_decode['init']['text2-correo'].'</span>
                    </div>
                    <div class="div_divider_modal_correo">
                        <hr class="'.$correo_line.'">
                    </div>
                    <div class="div_status_modal_correo">
                        <table width="100%" height="100%">
                            <tr>
                                <td align="center">
                                <span class="'.$correo_text.'">'.$correo_text_text.'</span></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="'.$empresa_box.'">
                    <div class="div_icon_modal_correo">
                    <img src="../img/ic-markunread.png"
                            srcset="../img/ic-markunread@2x.png 2x,
                                    ../img/ic-markunread@3x.png 3x"
                            class="ic_markunread">
                    </div>
                    <div class="div_text_modal_correo">
                        <a class="modal_title_1" href="'.DOL_URL_ROOT.'/'.$modal_decode['init']['link-empresa'].'">'.$modal_decode['init']['text1-empresa'].'</a>
                        <br>
                        <span class="modal_title_2">'.$modal_decode['init']['text2-empresa'].'</span>
                    </div>
                    <div class="div_divider_modal_correo">
                        <hr class="'.$empresa_line.'">
                    </div>
                    <div class="div_status_modal_correo">
                        <table width="100%" height="100%">
                            <tr>
                                <td align="center">
                                    <span class="'.$empresa_text.'">
                                        '.$empresa_text_text.' 
                                     </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="'.$equipo_box.'">
                    <div class="div_icon_modal_correo">
                        <img src="../img/ic-markunread.png"
                        srcset="../img/ic-markunread@2x.png 2x,
                                ../img/ic-markunread@3x.png 3x"
                        class="ic_markunread">
                    </div>
                    <div class="div_text_modal_correo">
                        <a class="modal_title_1" href="'.DOL_URL_ROOT.'/'.$modal_decode['init']['link-equipo'].'">'.$modal_decode['init']['text1-equipo'].'</a>
                        <br>
                        <span class="modal_title_2">'.$modal_decode['init']['text2-equipo'].'</span>
                    </div>
                    <div class="div_divider_modal_correo">
                        <hr class="'.$equipo_line.'">
                    </div>
                    <div class="div_status_modal_correo">
                        <table width="100%" height="100%">
                            <tr>
                                <td align="center">
                                <span class="'.$equipo_text.'">'.$equipo_text_text.'</span></td>
                            </tr>
                        </table>
                    </div>
                </div>    
            </div>
        </div>
    </div>
<!-- End Modal -->  

    <div class="modal">
        <input id="modal-trigger-center2" class="checkbox" type="checkbox">
        <div class="modal-overlay">
            <label for="modal-trigger-center2" class="o-close"></label>
            <div class="modal-wrap a-center" style="width: 704px;height: 344px;">
            <label for="modal-trigger-center2" class="close">X</label>
            <div class="div_title_modal_help">
                <table width="100%" height="100%">
                    <tr>
                        <td align="center">
                            <span class="title_modal_help">'.$modal_decode['help']['title'].'</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="item1_modal_help">
                <div class="img_help_modal_1">
                    <img src="'.$modal_decode['help']['img_src_1'].'" srcset="'.$modal_decode['help']['img_srcset_1'].'">
                </div>
                <div class="box_help_modal">
                    <table width="100%" height="100%">
                        <tr>
                            <td align="center">
                            <a class="text_box_help_modal" href="'.$modal_decode['help']['link_1'].'">'.$modal_decode['help']['text_1'].'</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="item1_modal_help">
                <div class="img_help_modal_2">
                    <img src="'.$modal_decode['help']['img_src_2'].'" srcset="'.$modal_decode['help']['img_srcset_2'].'">
                </div>
                <div class="box_help_modal">
                    <table width="100%" height="100%">
                        <tr>
                            <td align="center">
                            <a class="text_box_help_modal" href="'.$modal_decode['help']['link_2'].'">'.$modal_decode['help']['text_2'].'</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="item1_modal_help">
                <div class="img_help_modal_3">
                    <img src="'.$modal_decode['help']['img_src_3'].'" srcset="'.$modal_decode['help']['img_srcset_3'].'">
                </div>
                <div class="box_help_modal">
                    <table width="100%" height="100%">
                        <tr>
                            <td align="center">
                            <a class="text_box_help_modal" href="'.$modal_decode['help']['link_3'].'">'.$modal_decode['help']['text_3'].'</a></td>
                        </tr>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>

<script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>';

dol_include_once('/onboading/core/modules/modOnboading.class.php');
$tmpmodule = new modOnboading($db);

// Page end
dol_fiche_end();
llxFooter();
$db->close();
