<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Webklex\IMAP\Client;
use DateTime;

class ApiFormController extends Controller
{    
        
    /**
     * mini_clean
     *
     * @param  mixed $stringa
     * @return void
     */
    public function mini_clean($stringa)
    {

        $clean_title = str_replace( "*", "", $stringa );
        $clean_title = str_replace( "'", "", $clean_title );
        $clean_title = str_replace( "/", "", $clean_title );
        $clean_title = str_replace( "\"", "", $clean_title );
        $clean_title = trim($clean_title);
    
        return($clean_title);
    }

        
    /**
     * top_email
     *
     * @param  mixed $hotel
     * @param  mixed $base_url
     * @return void
     */
    public function top_email($hotel,$base_url)
    {
    
        $top = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
                <head>
                    <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
                    <title>".$hotel."</title>
                    <link rel=\"stylesheet\" type=\"text/css\" href=\"".$base_url."css/style_email.css\" />
                    <style>
                        @charset \"UTF-8\";
    
                    @font-face {
                      font-family: 'Source Sans Pro';
                      font-style: normal;
                      font-weight: 300;
                      src: local('Source Sans Pro Light'), local('SourceSansPro-Light'), url(".$base_url."css/fonts/toadOcfmlt9b38dHJxOBGNbE_oMaV8t2eFeISPpzbdE.woff) format('woff');
                    }
                    @font-face {
                      font-family: 'Source Sans Pro';
                      font-style: normal;
                      font-weight: 400;
                      src: local('Source Sans Pro'), local('SourceSansPro-Regular'), url(".$base_url."css/fonts/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
                    }
                    @font-face {
                      font-family: 'Source Sans Pro';
                      font-style: normal;
                      font-weight: 700;
                      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(".$base_url."css/fonts/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
                    }
    
                    @font-face {
                      font-family: 'Vollkorn';
                      font-style: normal;
                      font-weight: 400;
                      src: local('Vollkorn Regular'), local('Vollkorn-Regular'), url(".$base_url."css/fonts/BCFBp4rt5gxxFrX6F12DKvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
                    }
                    @font-face {
                      font-family: 'Vollkorn';
                      font-style: normal;
                      font-weight: 700;
                      src: local('Vollkorn Bold'), local('Vollkorn-Bold'), url(".$base_url."css/fonts/wMZpbUtcCo9GUabw9JODeobN6UDyHWBl620a-IRfuBk.woff) format('woff');
                    }
    
                    body { margin:0 auto; font-family:Tahoma,Geneva,sans-serif; font-size:11px; }
                    a{ text-decoration:none; color:#333333; }
                    h2{ font-size:12pt; }
                    .tbl_body { width:850px; font-size:9pt; background-color:#FFFFFF; border-collapse:collapse; }
                    .tbl_body td { padding:5px; }
                     td{white-space: nowrap;}
                    .tbl_body .spacer_td { border-top:solid 1px #999999; background-color:#EEEEEE; height:30px; }
                    .tbl_body .spacer_btm_td { border-bottom:solid 1px #999999; height:15px; }
                    .title{ background-color:#FFFFFF; color:#666666; font-size:14pt; }
                    .footer{ background-color:#BBBBBB; color:#666666; font-size:8pt; }
                    .footer a{ color:#EEEEEE; }
                    </style>
                </head>
                <body>
                <table class=\"tbl_body\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">
                    <tr>
                        <td align=\"left\" valign=\"top\">";
    
        return $top;
    }

    
    /**
     * footer_email
     *
     * @return void
     */
    public function footer_email()
    {
    
            $footer = '   </td>
                        </tr>
                    </table>
                </body>
            </html>';
        
        return $footer;
    }
        
    /**
     * check_double_syncro_form_sito
     *
     * @param  mixed $idsito
     * @param  mixed $NumeroPrenotazione
     * @return void
     */
    public function check_double_syncro_form_sito($idsito,$NumeroPrenotazione)
    {
            $select    = "SELECT COUNT(NumeroPrenotazione) as numero FROM hospitality_guest WHERE idsito = :idsito AND NumeroPrenotazione = :NumeroPrenotazione AND TipoRichiesta = 'Preventivo'";
            $risultato = DB::select($select,['idsito' => $idsito,'NumeroPrenotazione' => $NumeroPrenotazione]);
            if(sizeof($rsultato)>0){
                $row    = $risultato[0];
                return  $row->numero;
            }

    }
        
    /**
     * NewNumeroPreno
     *
     * @param  mixed $idsito
     * @return void
     */
    public function NewNumeroPreno($idsito)
    {
            $select2    = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE idsito = :idsito ORDER BY NumeroPrenotazione DESC";
            $res2       = DB::select($select2,['idsito' => $idsito]);
            if(sizeof($res2)>0){
                $rws                 = $res2[0];
                $numero_prenotazione =  (intval($rws->NumeroPrenotazione)+1);
                return $numero_prenotazione;
            }
    }
    
    /**
     * from_id_to_cod
     *
     * @param  mixed $value
     * @return void
     */
    public function from_id_to_cod($value)
    {
    
            switch($value) {
                    case"1":
                        $cod_lang = 'it';
                    break;
                    case"2":
                        $cod_lang = 'en';
                    break;
                    case"3":
                        $cod_lang = 'fr';
                    break;
                    case"4":
                        $cod_lang = 'de';
                    break;
                    case"5":
                        $cod_lang = 'es';
                    break;
                    case"6":
                        $cod_lang = 'ru';
                    break;
                    case"7":
                        $cod_lang = 'nl';
                    break;
                    case"8":
                        $cod_lang = 'pl';
                    break;
                    case"9":
                        $cod_lang = 'hu';
                    break;
    
                    case"10":
                        $cod_lang = 'pt';
                    break;
    
                    case"11":
                        $cod_lang = 'ae';
                    break;
    
                    case"12":
                        $cod_lang = 'cz';
                    break;
    
                    case"13":
                        $cod_lang = 'cn';
                    break;
                    case"14":
                        $cod_lang = 'br';
                    break;
                    case"15":
                        $cod_lang = 'jp';
                    break;
    
                }
    
    
            return $cod_lang;
        }
            
        /**
         * field_clean
         *
         * @param  mixed $stringa
         * @return void
         */
        public function field_clean($stringa)
        {
    
            $clean_title = str_replace( "!", "", $stringa );
            $clean_title = str_replace( "?", "", $clean_title );
            $clean_title = str_replace( ":", "", $clean_title );
            $clean_title = str_replace( "+", "", $clean_title );
            $clean_title = str_replace( "à", "a", $clean_title );
            $clean_title = str_replace( "è", "e", $clean_title );
            $clean_title = str_replace( "é", "e", $clean_title );
            $clean_title = str_replace( "ì", "i", $clean_title );
            $clean_title = str_replace( "ò", "o", $clean_title );
            $clean_title = str_replace( "ù", "u", $clean_title );
            $clean_title = str_replace( "n.", "", $clean_title );
            $clean_title = str_replace( ".", "", $clean_title );
            $clean_title = str_replace( ",", "", $clean_title );
            $clean_title = str_replace( ";", "", $clean_title );
            $clean_title = str_replace( "'", "", $clean_title );
            $clean_title = str_replace( "*", "", $clean_title );
            $clean_title = str_replace( "/", "", $clean_title );
            $clean_title = str_replace( "\"", "", $clean_title );
            $clean_title = str_replace( " ", "", $clean_title );
            $clean_title = strtolower($clean_title);
            $clean_title = trim($clean_title);
        
            return($clean_title);
        }
            
        /**
         * clean_email
         *
         * @param  mixed $valore
         * @return void
         */
        public function clean_email($valore)
        {
    
            $clean_valore = str_replace( "'", "", $valore );
            $clean_valore = str_replace( "?", "", $clean_valore );
            $clean_valore = str_replace( ":", "", $clean_valore );
            $clean_valore = str_replace( "+", "", $clean_valore );
            $clean_valore = str_replace( "à", "a", $clean_valore );
            $clean_valore = str_replace( "è", "e", $clean_valore );
            $clean_valore = str_replace( "é", "e", $clean_valore );
            $clean_valore = str_replace( "ì", "i", $clean_valore );
            $clean_valore = str_replace( "ò", "o", $clean_valore );
            $clean_valore = str_replace( "ù", "u", $clean_valore );
            $clean_valore = str_replace( ",", "", $clean_valore );
            $clean_valore = str_replace( ";", "", $clean_valore );
            $clean_valore = str_replace( "*", "", $clean_valore );
            $clean_valore = str_replace( "/", "", $clean_valore );
            $clean_valore = str_replace( "\"", "", $clean_valore );
            $clean_valore = str_replace( "#", "", $clean_valore );
            $clean_valore = trim($clean_valore);
        
            return($clean_valore);
        }
        

        public function insert_preventivo(Request $request)
        {
            if($request->action=='send') {
        
                $idsito           = $request->idsito;
                $urlback          = $request->urlback;
                $iubendapolicy    = $request->iubendapolicy;
                $language         = $request->language;
                $check_valid      = $request->check_valid;
                $res              = $request->res;
        
                $sql = "SELECT siti.*,anagrafica.rag_soc
                    FROM siti
                    INNER JOIN utenti ON utenti.idsito = siti.idsito
                    INNER JOIN anagrafica ON anagrafica.idanagra = utenti.idanagra
                    WHERE siti.idsito = " . $idsito . "
                    AND utenti.blocco_accesso = 0
                    AND siti.hospitality = 1
                    AND siti.data_start_hospitality <= '" . date('Y-m-d') . "'
                    AND siti.data_end_hospitality > '" . date('Y-m-d') . "'";
                $record   = DB::select($sql);             
                $permessi = sizeof($record);

            if ($permessi > 0) {
                    $ret      = $record[0];

                    $idsito   = $ret->idsito;
                    $sito_tmp = str_replace("http://","",$ret->web);
                    $sito_tmp = str_replace("https://","",$sito_tmp );
                    $http = 'https://';
                    $SitoWeb   = $http.$sito_tmp;
                    $SitoHotel = $SitoWeb;
                    $chiave_sito_recaptcha    = $ret->chiave_sito_recaptcha_invisible;
                    $chiave_segreta_recaptcha = $ret->chiave_segreta_recaptcha_invisible;
                    $Cliente                  = $ret->rag_soc;
        
                    switch ($language) {
                        case "it":
                            $id_lingua = 1;
                            break;
                        case "en":
                            $id_lingua = 2;
                            break;
                        case "fr":
                            $id_lingua = 3;
                            break;
                        case "de":
                            $id_lingua = 4;
                            break;
                        case "es":
                            $id_lingua = 2;
                            break;
                        case "ru":
                            $id_lingua = 2;
                            break;
                        case "nl":
                            $id_lingua = 2;
                            break;
                        case "pl":
                            $id_lingua = 2;
                            break;
                        case "hu":
                            $id_lingua = 2;
                            break;
                        case "pt":
                            $id_lingua = 2;
                            break;
                        case "ea":
                            $id_lingua = 2;
                            break;
                        case "cz":
                            $id_lingua = 2;
                            break;
                        case "cn":
                            $id_lingua = 2;
                            break;
                        case "br":
                            $id_lingua = 2;
                            break;
                        case "jp":
                            $id_lingua = 2;
                            break;
                        default:
                            $id_lingua = 1;
                            break;
                    }
        
        
        
                        $idsito           = $request->idsito;
                        $urlback          = $request->urlback;
                        $iubendapolicy    = $request->iubendapolicy;
                        $language         = $request->language;
                        $res              = $request->res;
        
                        $Ip               = $request->REMOTE_ADDR;
                        $Agent            = $request->HTTP_USER_AGENT;
        
        
                        $s = "SELECT siti.*,
                                    anagrafica.rag_soc,
                                    anagrafica.p_iva,
                                    utenti.logo,
                                    utenti.idutente,
                                    comuni.nome_comune,
                                    province.nome_provincia,
                                    province.sigla_provincia,
                                    stati.nome_stato
                        FROM siti
                        INNER JOIN utenti ON utenti.idsito = siti.idsito
                        INNER JOIN anagrafica ON anagrafica.idanagra = utenti.idanagra
                        INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
                        INNER JOIN province ON province.codice_provincia = siti.codice_provincia
                        INNER JOIN stati ON stati.id_stato = siti.id_stato
                        WHERE siti.idsito = " . $idsito . "
                        AND utenti.blocco_accesso = 0
                        AND siti.hospitality = 1
                        AND siti.data_start_hospitality <= '" . date('Y-m-d') . "'
                        AND siti.data_end_hospitality > '" . date('Y-m-d') . "'";
                        $rec = DB::select($s);
                        $r   = $rec[0];
        
                        $EmailHotel        = $r->email;
                        $email_hotel       = $EmailHotel;
                        $email_alternativa = $r->email_alternativa_form_quoto;
                        $Hotel             = $r->nome;
                        $sito_tmp          = str_replace("http://","",$r->web);
                        $sito_tmp          = str_replace("https://","",$sito_tmp);
                        $http = 'https://';
                        $SitoWeb   = $http.$sito_tmp;
                        $SitoHotel = $SitoWeb;
        
                        $riferimenti_hotel = '<strong>'.$Hotel.'</strong><br />';
                        $riferimenti_hotel .= $r->indirizzo.' '.$r->cap.' '.$r->nome_comune.' ('.$r->sigla_provincia.'), '.$r->nome_stato.' - Tel:+39 '.$r->tel.''.($r->fax!=''?' | Fax: +39 '.$r->fax:'').'<br />';
                        $riferimenti_hotel .= 'Web: <a href="'.$SitoHotel.'">'.$r->web.'</a> | Email: <a href="mailto:'.$EmailHotel.'">'.$EmailHotel.'</a>';
        
                        $idsito                   = $r->idsito;
                        $chiave_sito_recaptcha    = $ret->chiave_sito_recaptcha_invisible;
                        $chiave_segreta_recaptcha = $ret->chiave_segreta_recaptcha_invisible;
                        $idutente                 = $r->idutente;
                        $logo                     = $r->logo;
        
                        $nome                     = ucfirst($request->nome);
                        $cognome                  = ucfirst($request->cognome);
                        $email                    = $this->clean_email($request->email);
                        $telefono                 = $request->telefono;
        
                        $dataA                    = explode("-",$request->data_arrivo);
                        $arrivo                   = $dataA[2].'-'.$dataA[1].'-'.$dataA[0];
        
                        $dataP                    = explode("-",$request->data_partenza);
                        $partenza                 = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
        
                        if($request->DataArrivo!=''){
                            $dataAa                   = explode("-",$request->DataArrivo);
                            $DataArrivo               = $dataAa[2].'-'.$dataAa[1].'-'.$dataAa[0];
                        }else{
                            $DataArrivo = '';
                        }
        
                        if($request->DataPartenza!=''){
                            $dataPa                   = explode("-",$request->DataPartenza);
                            $DataPartenza             = $dataPa[2].'-'.$dataPa[1].'-'.$dataPa[0];
                        }else{
                            $DataPartenza = '';
                        }

                        if($request->TipoVacanza!=''){
                            $TipoVacanza             = $request->TipoVacanza;
                        }else{
                            $TipoVacanza = '';
                        } 

                        $TipoCamere               = $request->TipoCamere;
        
                        $adulti                                     = $request->adulti;
                        $bambini                                    = $request->bambini;
        
                        $messaggio                                  = $request->messaggio;
                        $hotel                                      = $request->hotel;
                        $codice_sconto                              = $request->codice_sconto;
                        $animali_ammessi_tmp                        = $request->animali_ammessi;
                        if($animali_ammessi_tmp == 1){
                            $animali_ammessi = 'Si';
                        }elseif($animali_ammessi_tmp == 0){
                            $animali_ammessi = 'No';
                        }
        
        
                        /**
                         * !DIZIONARIO FORM
                         */
                        switch ($language) {
                            case "it":
                                $language = 'it';
                                $etichettaPulsanteRispondi = 'Clicca qui per rispondere a: ';
                                $etichettaFraseBottom = 'Questa e-mail è stata inviata automaticamente, non rispondere a questa e-mail!';
                                break;
                            case "en":
                                $language = 'en';
                                $etichettaPulsanteRispondi = 'Click here to answer: ';
                                $etichettaFraseBottom = 'This email was sent automatically, do not reply to this email!';
                                break;
                            case "fr":
                                $language = 'fr';
                                $etichettaPulsanteRispondi = 'Cliquez ici pour répondre : ';
                                $etichettaFraseBottom = 'Cet e-mail a été envoyé automatiquement, ne répondez pas à cet e-mail!';
                                break;
                            case "de":
                                $language = 'de';
                                $etichettaPulsanteRispondi = 'Klicken Sie hier, um zu antworten: ';
                                $etichettaFraseBottom = 'Diese E-Mail wurde automatisch versendet, antworten Sie nicht auf diese E-Mail!';
                                break;
                            case "es":
                            case "ru":
                            case "nl":
                            case "pl":
                            case "hu":
                            case "pt":
                            case "ea":
                            case "cz":
                            case "cn":
                            case "br":
                            case "jp":
                                $language = 'en';
                                $etichettaPulsanteRispondi = 'Click here to answer: ';
                                $etichettaFraseBottom = 'This email was sent automatically, do not reply to this email!';
                                break;
                            default:
                                $language = 'it';
                                $etichettaPulsanteRispondi = 'Clicca qui per rispondere a: ';
                                $etichettaFraseBottom = 'Questa e-mail è stata inviata automaticamente, non rispondere a questa e-mail!';
                                break;
                        }
        
                        $select = "SELECT dizionario_form_quoto.etichetta,dizionario_form_quoto_lingue.testo FROM dizionario_form_quoto
                                        INNER JOIN dizionario_form_quoto_lingue ON dizionario_form_quoto_lingue.id_dizionario = dizionario_form_quoto.id
                                        WHERE dizionario_form_quoto_lingue.Lingua = '".$language."'
                                        AND dizionario_form_quoto.etichetta LIKE '%RESPONSE_FORM%'
                                        AND dizionario_form_quoto_lingue.idsito = ".$idsito;
                        $res = DB::select($select);
                        foreach($res as $key => $value){
                            define($value->etichetta,$value->testo);
        
                        }
        
        
                        $responseform['nome'][$language]                 = RESPONSE_FORM_NOME;
                        $responseform['cognome'][$language]              = RESPONSE_FORM_COGNOME;
                        $responseform['email'][$language]                = RESPONSE_FORM_EMAIL;
                        $responseform['telefono'][$language]             = RESPONSE_FORM_TELEFONO;
        
                        $responseform['arrivo'][$language]               = RESPONSE_FORM_ARRIVO;
                        $responseform['partenza'][$language]             = RESPONSE_FORM_PARTENZA;
        
                        $responseform['arrivo_alternativo'][$language]   = RESPONSE_FORM_ARRIVO_ALTERNATIVO;
                        $responseform['partenza_alternativo'][$language] = RESPONSE_FORM_PARTENZA_ALTERNATIVO;
                        $responseform['adulti_totale'][$language]        = RESPONSE_FORM_TOTALE_ADULTI;
                        $responseform['bambini_totale'][$language]       = RESPONSE_FORM_TOTALE_BAMBINI;
        
                        $responseform['adulti'][$language]               = RESPONSE_FORM_ADULTI;
                        $responseform['bambini'][$language]              = RESPONSE_FORM_BAMBINI;
                        $responseform['bambini_eta'][$language]          = RESPONSE_FORM_BAMBINI_ETA;
        
                        $responseform['sistemazione'][$language]         = RESPONSE_FORM_SISTEMAZIONE;
                        $responseform['trattamento'][$language]          = RESPONSE_FORM_TRATTAMENTO;
                        $responseform['target'][$language]               = RESPONSE_FORM_TARGET;
        
                        $responseform['messaggio'][$language]            = RESPONSE_FORM_MESSAGGIO;
                        $responseform['codice_sconto'][$language]        = RESPONSE_FORM_CODICE_SCONTO;
                        $responseform['animali'][$language]              = RESPONSE_FORM_ANIMALI_AMMESSI;
                        $responseform['h1'][$language]                   = RESPONSE_FORM_H1;
                        $responsoform_oggetto                            = str_replace('[sito]',$SitoHotel,RESPONSE_FORM_OGGETTO);
                        $responsoform_oggetto                            = str_replace('[nome]',$nome.' '.$cognome,$responsoform_oggetto);
                        $responseform_oggetto                            = $responsoform_oggetto;
                        $responseform['successo'][$language]             = RESPONSE_FORM_SUCCESSO;
        

        
                        $BaseUrl = 'https://www.quotocrm.it/';
        
                        $msg = $this->top_email($Hotel,$BaseUrl);
        
                        $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                    <tr>
                                        <td valign="top">
                                            <div style="clear:both" style="height:10px">&nbsp;</div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00ACC1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.$EmailHotel.'">'.$etichettaPulsanteRispondi.' '.$Hotel.'</a></div>
                                        </td>
                                    </tr>
                                </table>';
        
                        $msg .= '
                                            <img src="'.$BaseUrl.'uploads/loghi_siti/' . $logo . '" alt="Logo Struttura">
                                            <h1  class="title">' . $responseform['h1'][$language] . '</h1>
                                                <table cellpadding="0" cellspacing="0" width="100%"  border="0" align="center">
                                                <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['nome'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $nome . '</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['cognome'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $cognome . '</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['email'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $email . '</td>
                                                </tr>';
        
                        if ($telefono != '') {
                            $msg .= '      <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['telefono'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $telefono . '</td>
                                                </tr>';
                        }
                        $msg .= '      <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['arrivo'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $arrivo . '</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['partenza'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $partenza . '</td>
                                                </tr>';
                        if ($DataArrivo != '' || $DataPartenza != '') {
                            $msg .= '      <tr>
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['arrivo_alternativo'][$language] . '</b></td>
                                                <td align="left" valign="top" style="width:70%">' . $DataArrivo . '</td>
                                                </tr>
                                                <tr>
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['partenza_alternativo'][$language] . '</b></td>
                                                <td align="left" valign="top" style="width:70%">' . $DataPartenza . '</td>
                                                </tr>';
                        }
                        $msg .= '        <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['adulti_totale'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $adulti . '</td>
                                                    </tr>';
                        if ($bambini != '') {
                            $msg .= '      <tr>
                                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['bambini_totale'][$language] . '</b></td>
                                                        <td align="left" valign="top" style="width:70%">' . $bambini . '</td>
                                                    </tr>';
                        }
                        if(isset($request->codice_sconto)){
                            if ($codice_sconto != '') {
                                $msg .= '      <tr>
                                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['codice_sconto'][$language] . '</b></td>
                                                        <td align="left" valign="top" style="width:70%">' . $codice_sconto . '</td>
                                                    </tr>';
                            }
                        }
                        if ($TipoVacanza != '') {
                            $msg .= '      <tr>
                                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['target'][$language] . '</b></td>
                                                        <td align="left" valign="top" style="width:70%">' . $TipoVacanza. '</td>
                                                      </tr>';
                        }
                        if(isset($request->animali_ammessi)){
                            if ($animali_ammessi_tmp != '') {
                                $msg .= '      <tr>
                                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['animali'][$language] . '</b></td>
                                                            <td align="left" valign="top" style="width:70%">' . $animali_ammessi. '</td>
                                                        </tr>';
                            }
                        }
                        if(isset($request->TipoCamere)){
                            if ($TipoCamere != '') {
                                $msg .= '      <tr>
                                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['sistemazione'][$language] . '</b></td>
                                                            <td align="left" valign="top" style="width:70%">' . $request->TipoCamere . '</td>
                                                        </tr>';
                            }
                        }
                        $msg .= ' </table>';
        
                        if(isset($request->TipoSoggiorno_1) && $request->TipoSoggiorno_1 != ''){
                            $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';
        
        
                                $msg .= '    <tr>';
                                if(isset($request->TipoSoggiorno_1) && $request->TipoSoggiorno_1 != ''){
                                    $msg .= '
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->TipoSoggiorno_1 . '</td>
                                            ';
                                }
        
                                if(isset($request->NumAdulti_1)){
                                    if ($request->NumAdulti_1!= '') {
                                        $msg .= '
                                                    <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                                    <td align="left" valign="top">' . $request->NumAdulti_1. '</td>
                                                ';
                                        }
                                }
                                if(isset($request->NumBambini_1)){
                                    if ($request->NumBambini_1!= '') {
                                    $msg .= '
                                                <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->NumBambini_1. '</td>
                                            ';
                                    }
                                }
                                if(isset($request->EtaB1_1)){
                                    if ($request->EtaB1_1!= '') {
                                    $msg .= '
                                                <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->EtaB1_1 . ''.(isset($request->EtaB2_1) && $request->EtaB2_1 != ''?', '.$request->EtaB2_1:'').''.(isset($request->EtaB3_1) && $request->EtaB3_1 != ''?', '.$request->EtaB3_1:'').''.(isset($request->EtaB4_1) && $request->EtaB4_1 != ''?', '.$request->EtaB4_1:'').''.(isset($request->EtaB5_1) && $request->EtaB5_1 != ''?', '.$request->EtaB5_1:'').''.(isset($request->EtaB6_1) && $request->EtaB6_1 != ''?', '.$request->EtaB6_1:'').'</td>
                                        ';
                                    }
                                }
                                $msg .= ' </tr>';
        
                            $msg .= '   </table>';
                        }
        
        
        
                        if(isset($request->TipoSoggiorno_2) && $request->TipoSoggiorno_2 != ''){
                            $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';
        
        
                                $msg .= '    <tr>';
                                if(isset($request->TipoSoggiorno_2) && $request->TipoSoggiorno_2 != ''){
                                    $msg .= '
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->TipoSoggiorno_2 . '</td>
                                            ';
                                }
        
                                if(isset($request->NumAdulti_2)){
                                    if ($request->NumAdulti_2!= '') {
                                        $msg .= '
                                                    <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                                    <td align="left" valign="top">' . $request->NumAdulti_2. '</td>
                                                ';
                                        }
                                }
                                if(isset($request->NumBambini_2)){
                                    if ($request->NumBambini_2!= '') {
                                    $msg .= '
                                                <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->NumBambini_2. '</td>
                                            ';
                                    }
                                }
                                if(isset($request->EtaB1_2)){
                                    if ($request->EtaB1_2!= '') {
                                    $msg .= '
                                                <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->EtaB1_2 . ''.(isset($request->EtaB2_2) && $request->EtaB2_2 != ''?', '.$request->EtaB2_2:'').''.(isset($request->EtaB3_2) && $request->EtaB3_2 != ''?', '.$request->EtaB3_2:'').''.(isset($request->EtaB4_2) && $request->EtaB4_2 != ''?', '.$request->EtaB4_2:'').''.(isset($request->EtaB5_2) && $request->EtaB5_2 != ''?', '.$request->EtaB5_2:'').''.(isset($request->EtaB6_2) && $request->EtaB6_2 != ''?', '.$request->EtaB6_2:'').'</td>
                                        ';
                                    }
                                }
                                $msg .= ' </tr>';
        
                            $msg .= '   </table>';
                        }
        
        
        
                        if(isset($request->TipoSoggiorno_3) && $request->TipoSoggiorno_3 != ''){
                            $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';
        
        
                                $msg .= '    <tr>';
                                if(isset($request->TipoSoggiorno_3) && $request->TipoSoggiorno_3 != ''){
                                    $msg .= '
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->TipoSoggiorno_3 . '</td>
                                            ';
                                }
        
                                if(isset($request->NumAdulti_3)){
                                    if ($request->NumAdulti_3!= '') {
                                        $msg .= '
                                                    <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                                    <td align="left" valign="top">' . $request->NumAdulti_3. '</td>
                                                ';
                                        }
                                }
                                if(isset($request->NumBambini_3)){
                                    if ($request->NumBambini_3!= '') {
                                    $msg .= '
                                                <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->NumBambini_3. '</td>
                                            ';
                                    }
                                }
                                if(isset($request->EtaB1_3)){
                                    if ($request->EtaB1_3!= '') {
                                    $msg .= '
                                                <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->EtaB1_3 . ''.(isset($request->EtaB2_3) && $request->EtaB2_3 != ''?', '.$request->EtaB2_3:'').''.(isset($request->EtaB3_3) && $request->EtaB3_3 != ''?', '.$request->EtaB3_3:'').''.(isset($request->EtaB4_3) && $request->EtaB4_3 != ''?', '.$request->EtaB4_3:'').''.(isset($request->EtaB5_3) && $request->EtaB5_3 != ''?', '.$request->EtaB5_3:'').''.(isset($request->EtaB6_3) && $request->EtaB6_3 != ''?', '.$request->EtaB6_3:'').'</td>
                                        ';
                                    }
                                }
                                $msg .= ' </tr>';
        
                            $msg .= '   </table>';
                        }
        
                        if ($messaggio != '') {
                            $msg .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['messaggio'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . wordwrap($messaggio, 120, "<br />\n",true) . '</td>
                                        </tr>
                                    </table>';
                        }
                        $msg .= '  <table  cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                        <tr>
                                            <td valign="top" class="footer" style="padding:10px 3px; text-align:left;">
                                                '.$riferimenti_hotel.'
                                            </td>
                                        </tr>
                                    </table>';
        
                        $msg .= $this->footer_email();
        
                        $msg .= '<table cellpadding="0" cellspacing="0" width="850px" border="0" align="center">
                                        <tr>
                                            <td valign="top">
                                                <p style="margin: 0;font-size: 11px;line-height: 14px;text-align: right"><em>'.$etichettaFraseBottom.'</em></p>
                                            </td>
                                        </tr>
                                    </table>';
        
                        $msg_hotel = $this->top_email($Hotel,$BaseUrl);
        
                        $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                        <tr>
                                            <td valign="top">
                                                <div style="clear:both" style="height:10px">&nbsp;</div><div style="width:100%;text-align:center"><a style="-webkit-appearance:button;-moz-appearance:button;appearance:button;text-decoration:none;background-color:#00ACC1;color:#FFFFFF;height:auto;width:auto;padding:5px" href="mailto:'.$email.'">'.$etichettaPulsanteRispondi.' '.$nome.' '.$cognome.'</a></div>
                                            </td>
                                        </tr>
                                    </table>';
        
                        $msg_hotel .= '
                                            <img src="'.$BaseUrl.'uploads/loghi_siti/' . $logo . '">
                                            <h1  class="title">' . $responseform['h1'][$language] . '</h1>
                                                <table cellpadding="0" cellspacing="0" width="100%"  border="0" align="center">
                                                <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['nome'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $nome . '</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['cognome'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $cognome . '</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['email'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $email . '</td>
                                                </tr>';
        
                        if ($telefono != '') {
                            $msg_hotel .= '      <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['telefono'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $telefono . '</td>
                                                </tr>';
                        }
                        $msg_hotel .= '      <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['arrivo'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $arrivo . '</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['partenza'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $partenza . '</td>
                                                </tr>';
                        if ($DataArrivo != '' || $DataPartenza != '') {
                            $msg_hotel .= '      <tr>
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['arrivo_alternativo'][$language] . '</b></td>
                                                <td align="left" valign="top" style="width:70%">' . $DataArrivo . '</td>
                                                </tr>
                                                <tr>
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['partenza_alternativo'][$language] . '</b></td>
                                                <td align="left" valign="top" style="width:70%">' . $DataPartenza . '</td>
                                                </tr>';
                        }
                        $msg_hotel .= '        <tr>
                                                    <td align="left" valign="top" style="width:30%"><b>' . $responseform['adulti_totale'][$language] . '</b></td>
                                                    <td align="left" valign="top" style="width:70%">' . $adulti . '</td>
                                                    </tr>';
                        if ($bambini != '') {
                            $msg_hotel .= '      <tr>
                                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['bambini_totale'][$language] . '</b></td>
                                                        <td align="left" valign="top" style="width:70%">' . $bambini . '</td>
                                                    </tr>';
                        }
                        if(isset($request->codice_sconto)){
                            if ($codice_sconto != '') {
                                $msg_hotel .= '      <tr>
                                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['codice_sconto'][$language] . '</b></td>
                                                        <td align="left" valign="top" style="width:70%">' . $codice_sconto . '</td>
                                                    </tr>';
                            }
                        }
                        if ($TipoVacanza != '') {
                            $msg_hotel .= '      <tr>
                                                        <td align="left" valign="top" style="width:30%"><b>' . $responseform['target'][$language] . '</b></td>
                                                        <td align="left" valign="top" style="width:70%">' . $TipoVacanza. '</td>
                                                      </tr>';
                        }
                        if(isset($request->animali_ammessi)){
                            if ($animali_ammessi_tmp != '') {
                                $msg_hotel .= '      <tr>
                                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['animali'][$language] . '</b></td>
                                                            <td align="left" valign="top" style="width:70%">' . $animali_ammessi. '</td>
                                                        </tr>';
                            }
                        }
                        if(isset($request->TipoCamere)){
                            if ($TipoCamere != '') {
                                $msg_hotel .= '      <tr>
                                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['sistemazione'][$language] . '</b></td>
                                                            <td align="left" valign="top" style="width:70%">' . $request->TipoCamere . '</td>
                                                        </tr>';
                            }
                        }
                        $msg_hotel .= ' </table>';
        
                        if(isset($request->TipoSoggiorno_1) && $request->TipoSoggiorno_1 != ''){
                            $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';
        
        
                                $msg_hotel .= '    <tr>';
                                if(isset($request->TipoSoggiorno_1) && $request->TipoSoggiorno_1 != ''){
                                    $msg_hotel .= '
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->TipoSoggiorno_1 . '</td>
                                            ';
                                }
        
                                if(isset($request->NumAdulti_1)){
                                    if ($request->NumAdulti_1!= '') {
                                        $msg_hotel .= '
                                                    <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                                    <td align="left" valign="top">' . $request->NumAdulti_1. '</td>
                                                ';
                                        }
                                }
                                if(isset($request->NumBambini_1)){
                                    if ($request->NumBambini_1!= '') {
                                    $msg_hotel .= '
                                                <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->NumBambini_1. '</td>
                                            ';
                                    }
                                }
                                if(isset($request->EtaB1_1)){
                                    if ($request->EtaB1_1!= '') {
                                    $msg_hotel .= '
                                                <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->EtaB1_1 . ''.(isset($request->EtaB2_1) && $request->EtaB2_1 != ''?', '.$request->EtaB2_1:'').''.(isset($request->EtaB3_1) && $request->EtaB3_1 != ''?', '.$request->EtaB3_1:'').''.(isset($request->EtaB4_1) && $request->EtaB4_1 != ''?', '.$request->EtaB4_1:'').''.(isset($request->EtaB5_1) && $request->EtaB5_1 != ''?', '.$request->EtaB5_1:'').''.(isset($request->EtaB6_1) && $request->EtaB6_1 != ''?', '.$request->EtaB6_1:'').'</td>
                                                ';
                                    }
                                }
                                $msg_hotel .= ' </tr>';
        
                            $msg_hotel .= '   </table>';
                        }
        
        
        
                        if(isset($request->TipoSoggiorno_2) && $request->TipoSoggiorno_2 != ''){
                            $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';
        
        
                                $msg_hotel .= '    <tr>';
                                if(isset($request->TipoSoggiorno_2) && $request->TipoSoggiorno_2 != ''){
                                    $msg_hotel .= '
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->TipoSoggiorno_2 . '</td>
                                            ';
                                }
        
                                if(isset($request->NumAdulti_2)){
                                    if ($request->NumAdulti_2!= '') {
                                        $msg_hotel .= '
                                                    <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                                    <td align="left" valign="top">' . $request->NumAdulti_2. '</td>
                                                ';
                                        }
                                }
                                if(isset($request->NumBambini_2)){
                                    if ($request->NumBambini_2!= '') {
                                    $msg_hotel .= '
                                                <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->NumBambini_2. '</td>
                                            ';
                                    }
                                }
                                if(isset($request->EtaB1_2)){
                                    if ($request->EtaB1_2!= '') {
                                    $msg_hotel .= '
                                                <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->EtaB1_2 . ''.(isset($request->EtaB2_2) && $request->EtaB2_2 != ''?', '.$request->EtaB2_2:'').''.(isset($request->EtaB3_2) && $request->EtaB3_2 != ''?', '.$request->EtaB3_2:'').''.(isset($request->EtaB4_2) && $request->EtaB4_2 != ''?', '.$request->EtaB4_2:'').''.(isset($request->EtaB5_2) && $request->EtaB5_2 != ''?', '.$request->EtaB5_2:'').''.(isset($request->EtaB6_2) && $request->EtaB6_2 != ''?', '.$request->EtaB6_2:'').'</td>
                                        ';
                                    }
                                }
                                $msg_hotel .= ' </tr>';
        
                            $msg_hotel .= '   </table>';
                        }
        
        
        
                        if(isset($request->TipoSoggiorno_3) && $request->TipoSoggiorno_3 != ''){
                            $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">';
        
        
                                $msg_hotel .= '    <tr>';
                                if(isset($request->TipoSoggiorno_3) && $request->TipoSoggiorno_3 != ''){
                                    $msg_hotel .= '
                                                <td align="left" valign="top" style="width:30%"><b>' . $responseform['trattamento'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->TipoSoggiorno_3 . '</td>
                                            ';
                                }
        
                                if(isset($request->NumAdulti_3)){
                                    if ($request->NumAdulti_3!= '') {
                                        $msg_hotel .= '
                                                    <td align="left" valign="top"><b>' . $responseform['adulti'][$language] . '</b></td>
                                                    <td align="left" valign="top">' . $request->NumAdulti_3. '</td>
                                                ';
                                        }
                                }
                                if(isset($request->NumBambini_3)){
                                    if ($request->NumBambini_3!= '') {
                                    $msg_hotel .= '
                                                <td align="left" valign="top"><b>' . $responseform['bambini'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->NumBambini_3. '</td>
                                            ';
                                    }
                                }
                                if(isset($request->EtaB1_3)){
                                    if ($request->EtaB1_3!= '') {
                                    $msg_hotel .= '
                                                <td align="left" valign="top"><b>' . $responseform['bambini_eta'][$language] . '</b></td>
                                                <td align="left" valign="top">' . $request->EtaB1_3 . ''.(isset($request->EtaB2_3) && $request->EtaB2_3 != ''?', '.$request->EtaB2_3:'').''.(isset($request->EtaB3_3) && $request->EtaB3_3 != ''?', '.$request->EtaB3_3:'').''.(isset($request->EtaB4_3) && $request->EtaB4_3 != ''?', '.$request->EtaB4_3:'').''.(isset($request->EtaB5_3) && $request->EtaB5_3 != ''?', '.$request->EtaB5_3:'').''.(isset($request->EtaB6_3) && $request->EtaB6_3 != ''?', '.$request->EtaB6_3:'').'</td>
                                        ';
                                    }
                                }
                                $msg_hotel .= ' </tr>';
        
                            $msg_hotel .= '   </table>';
                        }
        
                        if ($messaggio != '') {
                            $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                        <tr>
                                            <td align="left" valign="top" style="width:30%"><b>' . $responseform['messaggio'][$language] . '</b></td>
                                            <td align="left" valign="top" style="width:70%">' . wordwrap($messaggio, 120, "<br />\n",true) . '</td>
                                        </tr>
                                    </table>';
                        }
        
                        $msg_hotel .= '  <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                                        <tr>
                                            <td valign="top" class="footer" style="padding:10px 3px; text-align:left;">
                                                '.$riferimenti_hotel.'
                                            </td>
                                        </tr>
                                    </table>';
        
                        $msg_hotel .= $this->footer_email();
                        $msg_hotel .= '<table cellpadding="0" cellspacing="0" width="850px" border="0" align="center">
                                        <tr>
                                            <td valign="top">
                                                <p style="margin: 0;font-size: 11px;line-height: 14px;text-align: right"><em>'.$etichettaFraseBottom.'</em></p>
                                            </td>
                                        </tr>
                                    </table>';

        
                    if ($nome != '' && $cognome != '' && $email != '' && $urlback != '' && $language != '' && $adulti != '' && $arrivo != '' && $partenza != '') {
        
                        $mail = new PHPMailer;
        
                        $mail->CharSet = "UTF-8"; 
                        $mail->SMTPDebug = 0;
                        $mail->isSMTP();
                        $mail->Host = env('MAIL_HOST');
                        $mail->SMTPAuth = true;
                        $mail->Username = env('MAIL_USERNAME');
                        $mail->Password = env('MAIL_PASSWORD');
                        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
                        $mail->Port = env('MAIL_PORT');
        
                        $mail->setFrom(env('MAIL_FROM_ADDRESS'),$Hotel);
                        $mail->addAddress($email, $nome.' '.$cognome);

                        $mail->isHTML(true);

                        $mail->Subject = $responsoform_oggetto;
                        $mail->msgHTML($msg, dirname(__FILE__));
                        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                        $mail->send();

                        $mail_hotel = new PHPMailer;

                        $mail_hotel->CharSet = "UTF-8"; 
                        $mail_hotel->SMTPDebug = 0;
                        $mail_hotel->isSMTP();
                        $mail_hotel->Host = env('MAIL_HOST');
                        $mail_hotel->SMTPAuth = true;
                        $mail_hotel->Username = env('MAIL_USERNAME');
                        $mail_hotel->Password = env('MAIL_PASSWORD');
                        $mail_hotel->SMTPSecure = env('MAIL_ENCRYPTION');
                        $mail_hotel->Port = env('MAIL_PORT');
        
                        $mail_hotel->setFrom(env('MAIL_FROM_ADDRESS'),$nome.' '.$cognome);
                        $mail_hotel->addAddress($EmailHotel, $nome.' '.$cognome);

                        if($email_alternativa!=''){
                            $array_alternativa = array();
                            $array_alternativa = explode(",",$email_alternativa);
                            foreach ($array_alternativa as $key => $value) {
                                $mail_hotel->addAddress($value, $nome.' '.$cognome);
                            }
                        }
                        $mail_hotel->isHTML(true);
                        $mail_hotel->Subject = $responsoform_oggetto;
                        $mail_hotel->msgHTML($msg_hotel, dirname(__FILE__));
                        $mail_hotel->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                        $mail_hotel->send();
        
                        $data_richiesta = date('Y-m-d');
    
                        $id_lingua      =  $request->id_lingua;
                        $lingua         =  $this->from_id_to_cod($id_lingua);
    
                        $numero_prenotazione = $this->NewNumeroPreno($idsito);
                        $cellulare           = $this->field_clean($request->telefono);
    
                        $data_arrivo         = $request->data_arrivo;
    
                        $data_partenza       = $request->data_partenza;
        
        
                        if(isset($request->TipoSoggiorno_1) && $request->TipoSoggiorno_1 != ''){
                            $RigheCompilate  = (isset($request->TipoSoggiorno_1) && $request->TipoSoggiorno_1 != ''?' - Trattamento: '.$request->TipoSoggiorno_1:'').'  '.(isset($request->TipoCamere) && $request->TipoCamere!= '' ?'  -   Sistemazione: '.$request->TipoCamere:'').' '.(isset($request->NumAdulti_1)?'  -  Nr.Adulti: '.$request->NumAdulti_1:'').' '.(isset($request->NumBambini_1) && $request->NumBambini_1!= '' ?'  -  Nr.Bambini: '.$request->NumBambini_1:'').'  '.(isset($request->EtaB1_1) && $request->EtaB1_1 != '' ?'  -  Età: '.$request->EtaB1_1:'').''.(isset($request->EtaB2_1) && $request->EtaB2_1 != '' ?', '.$request->EtaB2_1:'').''.(isset($request->EtaB3_1) && $request->EtaB3_1 != '' ?', '.$request->EtaB3_1:'').''.(isset($request->EtaB4_1) && $request->EtaB4_1 != '' ?', '.$request->EtaB4_1:'').''.(isset($request->EtaB5_1) && $request->EtaB5_1 != '' ?', '.$request->EtaB5_1:'').''.(isset($request->EtaB6_1) && $request->EtaB6_1 != '' ?', '.$request->EtaB6_1:'')."\r\n";
                        }
                        if(isset($request->TipoSoggiorno_2) && $request->TipoSoggiorno_2 != ''){
                            $RigheCompilate  .= (isset($request->TipoSoggiorno_2) && $request->TipoSoggiorno_2 != ''?' - Trattamento: '.$request->TipoSoggiorno_2:'').'  '.(isset($request->TipoCamere) && $request->TipoCamere!= '' ?'  -   Sistemazione: '.$request->TipoCamere:'').' '.(isset($request->NumAdulti_2)?'  -  Nr.Adulti: '.$request->NumAdulti_2:'').' '.(isset($request->NumBambini_2) && $request->NumBambini_2!= '' ?'  -  Nr.Bambini: '.$request->NumBambini_2:'').'  '.(isset($request->EtaB1_2) && $request->EtaB1_2 != '' ?'  -  Età: '.$request->EtaB1_2:'').''.(isset($request->EtaB2_2) && $request->EtaB2_2 != '' ?', '.$request->EtaB2_2:'').''.(isset($request->EtaB3_2) && $request->EtaB3_2 != '' ?', '.$request->EtaB3_2:'').''.(isset($request->EtaB4_2) && $request->EtaB4_2 != '' ?', '.$request->EtaB4_2:'').''.(isset($request->EtaB5_2) && $request->EtaB5_2 != '' ?', '.$request->EtaB5_2:'').''.(isset($request->EtaB6_2) && $request->EtaB6_2 != '' ?', '.$request->EtaB6_2:'')."\r\n";
                        }
                        if(isset($request->TipoSoggiorno_3) && $request->TipoSoggiorno_3 != ''){
                            $RigheCompilate  .= (isset($request->TipoSoggiorno_3) && $request->TipoSoggiorno_3 != ''?' - Trattamento: '.$request->TipoSoggiorno_3:'').'  '.(isset($request->TipoCamere) && $request->TipoCamere!= '' ?'  -   Sistemazione: '.$request->TipoCamere:'').' '.(isset($request->NumAdulti_3)?'  -  Nr.Adulti: '.$request->NumAdulti_3:'').' '.(isset($request->NumBambini_3) && $request->NumBambini_3!= '' ?'  -  Nr.Bambini: '.$request->NumBambini_3:'').' '.(isset($request->EtaB1_3) && $request->EtaB1_3 != '' ?'  -  Età: '.$request->EtaB1_3:'').''.(isset($request->EtaB2_3) && $request->EtaB2_3 != '' ?', '.$request->EtaB2_3:'').''.(isset($request->EtaB3_3) && $request->EtaB3_3 != '' ?', '.$request->EtaB3_3:'').''.(isset($request->EtaB4_3) && $request->EtaB4_3 != '' ?', '.$request->EtaB4_3:'').''.(isset($request->EtaB5_2) && $request->EtaB5_3 != '' ?', '.$request->EtaB5_3:'').''.(isset($request->EtaB6_3) && $request->EtaB6_3 != '' ?', '.$request->EtaB6_3:'')."\r\n";
                        }
                        $note           =  (($hotel!='' || $hotel!='--')?addslashes($hotel)."\r\n":'');
                        $note           =  (isset($request->animali_ammessi) && $animali_ammessi_tmp!=''?'Viaggiamo con animali domestici: '.$animali_ammessi."\r\n":'');
                        $note          .=  (($request->DataArrivo!='' || $request->DataPartenza!='')?"\r\n".'Data Arrivo Alternativa: '.$DataArrivo.' Data Partenza Alternativa: '.$DataPartenza."\r\n":'');
                        $note          .=  ($RigheCompilate!=''?"\r\n".$RigheCompilate."\r\n":'');
                        $note          .=  ($request->messaggio!=''?"\r\n".'Note: '.$request->messaggio:'');

                        $ConsensoMarketing    = ($request->marketing!=''?1:0);
                        $ConsensoProfilazione = ($request->profilazione!=''?1:0);
                        $ConsensoPrivacy      = ($request->consenso!=''?1:0);
        
        
                        $data      =  [   
                                        'idsito'                    => $idsito,
                                        'id_politiche'              => 0,
                                        'MultiStruttura'            => addslashes($hotel),
                                        'Nome'                      => addslashes($nome),
                                        'Cognome'                   => addslashes($cognome),
                                        'EmailSegretaria'           => $email_hotel,
                                        'Cellulare'                 => $telefono,
                                        'Email'                     => $email,
                                        'NumeroPrenotazione'        => $numero_prenotazione,
                                        'DataArrivo'                => $data_arrivo,
                                        'DataPartenza'              => $data_partenza,
                                        'FontePrenotazione'         => "Sito Web",
                                        'Note'                      => addslashes($note),
                                        'TipoRichiesta'             => 'Preventivo',
                                        'TipoVacanza'               => $TipoVacanza,
                                        'Lingua'                    => $lingua,
                                        'NumeroAdulti'              => $adulti,
                                        'NumeroBambini'             => $bambini,
                                        'DataRichiesta'             => $data_richiesta,
                                        'CheckConsensoPrivacy'      => $ConsensoPrivacy,
                                        'CheckConsensoMarketing'    => $ConsensoMarketing,
                                        'CheckConsensoProfilazione' => $ConsensoProfilazione,
                                        'Ip'                        => $Ip,
                                        'Agent'                     => $Agent,
                                        'CodiceSconto'              => addslashes($codice_sconto)
                                        ];
                        DB::table('hospitality_guest')->insert($data);
        
                        // SALVO IL CLIENT ID DI ANALYTICS IN TABELLA RELAZIONALE DI QUOTO
                        $insertclientId = "INSERT INTO hospitality_client_id(idsito,NumeroPrenotazione,CLIENT_ID) VALUES('".$idsito."','".$numero_prenotazione."','".$request->CLIENT_ID."')";
                        DB::select($insertclientId);
        
                        $Tracking = urldecode($request->tracking);
                        if($Tracking){
                            if((strstr($Tracking,'facebook')) && (strstr($Tracking,'utm_campaign'))){
                                $array_traccia = explode('utm_campaign=',$Tracking);
                                $track_tmp     = explode('&fbclid', $array_traccia[1]);
                                $track         = 'facebook';
                                $campagna      = $track_tmp[0];
                                $daDove        = '';
                            }elseif((strstr($Tracking,'campagna')) && (strstr($Tracking,'gclid'))){
                                $array_traccia = explode('campagna=',$Tracking);
                                $track_tmp     = explode('&gclid', $array_traccia[1]);
                                $track         = 'google';
                                $campagna      = $track_tmp[0];
                                $daDove        = '';
                            }elseif((strstr($Tracking,'facebook')) && (!strstr($Tracking,'utm_campaign'))){
                                $track         = 'facebook';
                                $campagna      = '';
                                $daDove        = '';
                            }elseif((strstr($Tracking,'gclid')) && (!strstr($Tracking,'facebook')) && (!strstr($Tracking,'campagna'))){
                                $track         = 'google';
                                $campagna      = '';
                                $daDove        = '';
                            }elseif((!strstr($Tracking,'facebook')) && (!strstr($Tracking,'utm_campaign')) && (!strstr($Tracking,'campagna')) && (!strstr($Tracking,'gclid'))){
                                $track         = '';
                                $campagna      = '';
                                $daDove        =  $Tracking;
                            }
    
                            $insert_tracking = "INSERT INTO hospitality_tracking_ads
                                                            (idsito,
                                                            NumeroPrenotazione,
                                                            Url,
                                                            Tracking,
                                                            Campagna)
                                                        VALUES
                                                            ('".$idsito."',
                                                            '".$numero_prenotazione."',
                                                            '".addslashes($daDove)."',
                                                            '".addslashes($track)."',
                                                            '".addslashes($campagna)."')";
                            DB::select($insert_tracking);
                        }
                        /**
                        *? NUOVO CODICE PER LA TRACCIABILITA'
                        ** Data 29 Agosto 2023
                        */
                        $request->utm_campaign = str_replace("%20"," ",$request->utm_campaign);
                        $request->utm_campaign = str_replace("%7C","|",$request->utm_campaign);
                        $request->utm_campaign = str_replace("+"," ",$request->utm_campaign);
                        $utm_insert = "INSERT INTO hospitality_utm_ads
                                            ( idsito
                                            , NumeroPrenotazione
                                            , referrer
                                            , utm_source
                                            , utm_medium
                                            , utm_campaign
                                            , data_operazione
                                            )
                                        VALUES
                                            ( '".$idsito."'
                                            , '".$numero_prenotazione."'
                                            , '".addslashes($request->HTTP_REFERRER)."'
                                            , '".addslashes($request->utm_source)."'
                                            , '".addslashes($request->utm_medium)."'
                                            , '".addslashes($request->utm_campaign)."'
                                            , '".date('Y-m-d H:i:s')."'
                                            )";
                        DB::select($utm_insert);
    
                        $syncro = "INSERT INTO hospitality_data_syncro(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
                        DB::select($syncro);
    
                        // ritorno alla pagina OK
                        $responseContent = '   <form  action="' . $urlback . '?res=sent&'.base64_encode('NumeroPrenotazione').'='.base64_encode($numero_prenotazione).'" name="form_response_q" id="form_response_q"  method="post">
                                    <input type="hidden" name="NumeroPrenotazione" value="'.$numero_prenotazione.'"/>
                                    <input type="hidden" name="idsito" value="'.$idsito.'"/>
                                </form>
                                <script language="JavaScript">
                                    document.form_response_q.submit();
                                </script>'."\r\n";
    
    
                    } else {
    
                        $message = 'ERRORE: Potrebbero esserci alcune variabili obbligatorie non compilate!';
                        $responseContent = '<script language="javascript">alert("' . $message . '");history.go(-1)</script>';
                    }
        

        
                }else{
        
                    $s   = "SELECT siti.email FROM siti WHERE siti.idsito = " . $idsito . "";
                    $re  = DB::select($s);
                    $rec = $re[0];
        
                    $responseContent = '<div>
                            Il modulo di richiesta by Quoto! CRM non è più attivo!
                            <br>
                            Per mandare il tuo messaggio alla struttura, scrivi direttamente a '.$rec['email'].'
                            <br>
                            Se sei il proprietario del sito, contatta Network Service
                            <br>
                            <b>Network Service</b><br>
                            <b>Contatto tecnico:</b> support@quoto.travel
                        </div>';
                }
        
            }else{
                $responseContent = '<div>
                        <b>ERRORE</b><br><br>
                        Variabile <b>action</b> non instanziata!
                    </div>';
            }

            Log::info(date('d-m-Y H:i:s').' -> API insert_preventivo() -> Esito: success; da compilazione form inserito nuovo preventivo per il QUOTO di {idsito}!',['idsito' => $request->idsito]);
            return response($responseContent)->header('Content-Type', 'text/html;charset=utf-8');
        }

 /*      
         public function send_form(Request $request)
        {
            $data = [

                                'oggetto_email'   => 'Richiesta per https://test.suiteweb.it',
                                'idsito'          => 1740,
                                'id_lingua'       => 1,
                                'language'        => 'it',
                                'lang_dizionario' => 'it',
                                'id_lang'         => 1,
                                'captcha'         => 0,
                                'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0, Win64, x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36',
                                'REMOTE_ADDR'     => '5.89.51.153',
                                'adulti'          => 2,
                                'bambini'         => 0,
                                'utm_source'      => '',
                                'utm_medium'      => '',
                                'utm_campaign'    => '',
                                'HTTP_REFERRER'   => '/',
                                '_ga'             => 'GA1.1.1680011225.1738573267',
                                'CLIENT_ID'       => '1680011225.1738573267',
                                'action'          => 'send',
                                'urlback'         => 'https://test.suiteweb.it',
                                'hotel'           => '/script_php/utm/form_utm.php',
                                'nome'            => 'Marcello',
                                'cognome'         => 'Visigalli',
                                'email'           => 'marcello@network-service.it',
                                'telefono'        => '3333333333',
                                'data_arrivo'     => '2025-06-20',
                                'data_partenza'   => '2025-06-26',
                                'TipoSoggiorno_1' => 'Pensione Completa',
                                'NumAdulti_1'     => 2,
                                'NumBambini_1'    => 0,
                                'messaggio'       => 'Test di prova',
                                'marketing'       => 'on',
                                'consenso'        => 'on'
                    
                    ];
                    
                    
                    
                    $apiKey = 'QTbpNZiwhbJlcIVQjwgyUnaUqFp21Y2x2aN3o5EXQljjdflf/!aKU8EPgFxvS!hacpOoUCL9kv/lVDJVtRI=';
                    
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'http://restapi.quotocrm.it.dvl.to/api/insert_preventivo');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "X-API-KEY: $apiKey",
                    "Content-Type: application/json"]); 
                    
                    $response = curl_exec($ch);
                    
                    if (curl_errno($ch)) {
                        echo "Errore cURL: " . curl_error($ch);
                    } else {
                        echo "Risposta dal server: " . $response;
                    }
                        //print_r($response);
                    
                    curl_close($ch);
                    Log::info($response);
        } 
*/
  /*   
        public function send_form(Request $request)
        {
    
    
            $response = Http::asForm()->post(
                'http://restapi.quotocrm.it.dvl.to/api/insert_preventivo', [
                    'oggetto_email'   => 'Richiesta per https://test.suiteweb.it',
                    'idsito'          => 1740,
                    'id_lingua'       => 1,
                    'language'        => 'it',
                    'lang_dizionario' => 'it',
                    'id_lang'         => 1,
                    'captcha'         => 0,
                    'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0, Win64, x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36',
                    'REMOTE_ADDR'     => '5.89.51.153',
                    'adulti'          => 2,
                    'bambini'         => 0,
                    'utm_source'      => '',
                    'utm_medium'      => '',
                    'utm_campaign'    => '',
                    'HTTP_REFERRER'   => '/',
                    '_ga'             => 'GA1.1.1680011225.1738573267',
                    'CLIENT_ID'       => '1680011225.1738573267',
                    'action'          => 'send',
                    'urlback'         => 'https://test.suiteweb.it',
                    'hotel'           => '/script_php/utm/form_utm.php',
                    'nome'            => 'Marcello',
                    'cognome'         => 'Visigalli',
                    'email'           => 'marcello@network-service.it',
                    'telefono'        => '3333333333',
                    'data_arrivo'     => '2025-06-20',
                    'data_partenza'   => '2025-06-26',
                    'TipoSoggiorno_1' => 'Pensione Completa',
                    'NumAdulti_1'     => 2,
                    'NumBambini_1'    => 0,
                    'messaggio'       => 'Test di prova',
                    'marketing'       => 'on',
                    'consenso'        => 'on'
                ]
            );
            

            $jsonContent = $response->body();

            Log::info($jsonContent);

            return response($jsonContent)->header('Content-Type', 'text/html;charset=utf-8');
        }
*/

    
}
