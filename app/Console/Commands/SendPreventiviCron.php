<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;

class SendPreventiviCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-preventivi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Invio email dei preventivi abilitati e compilati da AI';

    public function check_template($idsito)
    {

        $sel  = "SELECT * FROM hospitality_template_landing WHERE idsito = :idsito";
        $res  = DB::select($sel,['idsito' => $idsito]);
        if(sizeof($res)>0){
            $record   = $res[0];
            $template = $record->Template;
        }else{
            $template = '';
        }
      
        return $template;
    }

    public function check_landing_template($idsito,$idrichiesta)
    {

        $sel    = "SELECT hospitality_template_background.TemplateName 
                    FROM hospitality_guest
                        INNER JOIN
                        hospitality_template_background 
                            ON hospitality_template_background.Id = hospitality_guest.id_template 
                    WHERE hospitality_guest.idsito = :idsito 
                    AND hospitality_guest.Id = :idrichiesta 
                    ORDER BY hospitality_guest.DataRichiesta DESC, hospitality_guest.Id DESC";

        $res    =  DB::select($sel,['idsito' => $idsito,'idrichiesta' => $idrichiesta]);
        if(sizeof($res)>0){
            $record = $res[0];
            $TemplateName = $record->TemplateName;
        }else{
            $TemplateName = '';
        }
        return $TemplateName;
    }

    public function check_landing_type_template($idsito, $idrichiesta)
    {

        $sel = "SELECT hospitality_template_background.TemplateType 
                    FROM hospitality_guest
                        INNER JOIN
                        hospitality_template_background 
                            ON hospitality_template_background.Id = hospitality_guest.id_template 
                    WHERE hospitality_guest.idsito = :idsito 
                    AND hospitality_guest.Id = :idrichiesta 
                    ORDER BY hospitality_guest.DataRichiesta DESC, hospitality_guest.NumeroPrenotazione DESC";
    
        $res          = DB::select($sel,['idsito' => $idsito,'idrichiesta' => $idrichiesta]);
        if(sizeof($res)>0){
            $record       = $res[0];
            $TemplateType = $record->TemplateType;
        }else{
            $TemplateType = '';
        }
        return $TemplateType;
    } 

    /**
     * Execute the console command.
     */
    public function handle()
    {
             // query per i dati della richiesta
        $sel = "SELECT hospitality_guest.*, hospitality_giorni_recall_preventivi.numero_giorni 
                FROM hospitality_guest 
                WHERE hospitality_guest.TipoRichiesta = 'Preventivo' 
                AND hospitality_guest.Inviata = 0 
                AND hospitality_guest.Chiuso = 0
                AND hospitality_guest.Archivia = 0 
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.Visibile = 1 
                AND hospitality_guest.Accettato = 0
                AND hospitality_guest.InvioAutomatico = 1";
        $qy  = DB::select($sel);
        $tot = sizeof($qy);
        if($tot > 0){


            foreach($qy as $key => $dati){

                $messaggio          = '';
                $DataArrivo         = '';
                $DataPartenza       = '';
                $IdRichiesta        = '';
                $IdSito             = '';
                $TemplateEmail      = '';
                $AbilitaInvio       = '';
                $TipoRichiesta      = '';
                $Nome               = '';
                $Cognome            = '';
                $NumeroAdulti       = '';
                $NumeroBambini      = '';  
                $EtaBambini1        = ''; 
                $EtaBambini2        = '';
                $EtaBambini3        = ''; 
                $EtaBambini4        = '';       
                $Email              = '';
                $Operatore          = '';
                $EmailOperatore     = '';
                $Note               = '';
                $Lingua             = '';
                $PrezzoPC           = ''; 
                $link               = '';
                $NumeroPrenotazione =  '';


                       // giro le date in formato IT
                        $DataA_tmp          = explode("-",$dati->DataArrivo);
                        $DataArrivo         = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
                        $DataP_tmp          = explode("-",$dati->DataPartenza);
                        $DataPartenza       = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];
                        // assegno alcune variabili
                        $IdRichiesta        = $dati->Id;
                        $IdSito             = $dati->idsito;
                        $TemplateEmail      = $dati->TemplateEmail;
                        $AbilitaInvio       = $dati->AbilitaInvio;
                        $TipoRichiesta      = $dati->TipoRichiesta;
                        $Nome               = stripslashes($dati->Nome);
                        $Cognome            = stripslashes($dati->Cognome);
                        $NumeroAdulti       = $dati->NumeroAdulti;
                        $NumeroBambini      = $dati->NumeroBambini;  
                        $EtaBambini1        = $dati->EtaBambini1; 
                        $EtaBambini2        = $dati->EtaBambini2; 
                        $EtaBambini3        = $dati->EtaBambini3; 
                        $EtaBambini4        = $dati->EtaBambini4;       
                        $Email              = $dati->Email;
                        $Operatore          = $dati->ChiPrenota;
                        $EmailOperatore     = $dati->EmailSegretaria;
                        $Note               = $dati->Note;
                        $Lingua             = $dati->Lingua;  
                        $NumeroPrenotazione = $dati->NumeroPrenotazione;


                        $select = "SELECT hospitality_dizionario.etichetta,hospitality_dizionario_lingua.testo FROM hospitality_dizionario
                                    INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                                    WHERE hospitality_dizionario_lingua.Lingua = :Lingua
                                    AND hospitality_dizionario_lingua.idsito = :idsito";
                        $result = DB::select($select,['Lingua' => $Lingua,'idsito' => $IdSito]);
                        $tot_l = sizeof($result);
                        if($tot_l > 0){
                            foreach ($result as $key => $value) {
                                define($value->etichetta,$value->testo);
                            }
                        }

                        $selQ = "SELECT * FROM hospitality_contenuti_email WHERE TipoRichiesta = :TipoRichiesta AND Lingua = :Lingua AND idsito = :idsito";
                        $resQ = DB::select($selQ,['TipoRichiesta' => $TipoRichiesta, 'Lingua' => $Lingua, 'idsito' => $IdSito]);
                        $rw   = $resQ[0];     
                        
                        $sit = 'SELECT siti.*
                                    , utenti.logo
                                    , comuni.nome_comune AS comune
                                    , province.sigla_provincia AS prov 
                                FROM siti
                                    INNER JOIN
                                    utenti 
                                        ON utenti.idsito = siti.idsito
                                    INNER JOIN
                                    comuni 
                                        ON comuni.codice_comune = siti.codice_comune
                                    INNER JOIN
                                    province 
                                        ON province.codice_provincia = siti.codice_provincia 
                                WHERE siti.idsito = :idsito';
                        $resu      = DB::select($sit,['idsito' => $IdSito]);
                        $rows      = $resu[0];
                        $logo      = $rows->logo;
                        $nomeHotel = $rows->nome;
                        $emailHotel= $rows->email;
                        $sito_tmp  = str_replace("https://","",$rows->web);
                        $sito_tmp  = str_replace("www.","",$sito_tmp);
                        $SitoWeb   = 'https://www.'.$sito_tmp;
                        $tel       = $rows->tel;
                        $fax       = $rows->fax;
                        $cap       = $rows->cap;
                        $indirizzo = $rows->indirizzo;
                        $comune    = $rows->comune;
                        $prov      = $rows->prov;
                        $directory_sito = str_replace(".it","",$sito_tmp);
                        $directory_sito = str_replace(".com","",$directory_sito);
                        $directory_sito = str_replace(".net","",$directory_sito);
                        $directory_sito = str_replace(".biz","",$directory_sito);
                        $directory_sito = str_replace(".eu","",$directory_sito);
                        $directory_sito = str_replace(".de","",$directory_sito);
                        $directory_sito = str_replace(".es","",$directory_sito);
                        $directory_sito = str_replace(".fr","",$directory_sito);

                        $grafica = $this->check_template($IdSito);
                        $chek_l_t = $this->check_landing_template($IdSito,$IdRichiesta);

                        if($chek_l_t != 'smart'){
                            $chek_l_t = $this->check_landing_type_template($IdSito,$IdRichiesta);
                        }
        
                        if($grafica != 'default'){
                            $grafica = $this->check_landing_type_template($IdSito,$IdRichiesta);
                        }

                        if($chek_l_t!=''){
                            
                            if($chek_l_t=='default'){
                                $link = ($UrlLanding.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$IdSito.'_p').'/count/');                     
                            }else{
                                $link = ($UrlLanding.$chek_l_t.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$IdSito.'_p').'/count/');
                            }                
            
                        }else{

                            if($grafica=='default'){
                                $link = ($UrlLanding.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$IdSito.'_p').'/count/');                 
                            }else{
                                $link = ($UrlLanding.$grafica.'/'.$directory_sito.'/'.base64_encode($IdRichiesta.'_'.$IdSito.'_p').'/count/');
                            }                

                        }

                        $mail = new PHPMailer(true);

                        /* Email SMTP Settings */                     
                        $mail->SMTPDebug = 0;
                        $mail->isSMTP();
                        $mail->Host = env('MAIL_HOST');
                        $mail->SMTPAuth = true;
                        $mail->Username = env('MAIL_USERNAME');
                        $mail->Password = env('MAIL_PASSWORD');
                        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
                        $mail->Port = env('MAIL_PORT');               

                        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                        
                        $mail->addAddress($Email, $Nome.' '.$Cognome);
                        $mail->isHTML(true);
                        $mail->Subject = str_replace("[cliente]",$Nome.' '.$Cognome,$_oggetto);

                        include_once public_path('email_template/preventivo_mail.php');
               
                        $link = '';
                        //$messaggio = utf8_encode($messaggio);
                        $mail->msgHTML($messaggio, dirname(__FILE__));
                        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

                        if($mail->send()){
                            $txt = date('d-m-Y H:i:s').' - Inviata: '.' ID '.$IdRichiesta.' NR. '.$NumeroPrenotazione.' IDSITO '.$IdSito.' '. $SitoWeb."\r\n";
                        }else{
                            $txt = date('d-m-Y H:i:s').' - Errore invio Email per  ID '.$IdRichiesta.' NR. '.$NumeroPrenotazione.' IDSITO '.$IdSito.' '. $SitoWeb.': ' . $mail->ErrorInfo."\r\n";			    
                        }

                        DB::table('hospitality_guest')->where('Id','=',$IdRichiesta)->update(['Inviata' => 1,'DataInvio' => date('Y-m-d'),'MetodoInvio' => 'E-mail']);

                        echo 'Inviata: '.' ID '.$IdRichiesta.' NR. '.$NumeroPrenotazione.' IDSITO '.$IdSito."\r\n";
              
            } // end while  
         
        }// end tot > 0
        Log::info($txt);
    }

}
