<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;

class SendTestCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendtestcron:cron';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Invia test email!';

    public function __construct()
    {
        parent::__construct();
    }



    /**
     * top_mail
     *
     * @return void
     */
    public function top_mail()
    {
            $top = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
                    <head>
                        <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
                        <title>QUOTO! CRM</title>
                        <style>
                            @charset \"UTF-8\";

                        @font-face {
                        font-family: 'Source Sans Pro';
                        font-style: normal;
                        font-weight: 300;
                        src: local('Source Sans Pro Light'), local('SourceSansPro-Light'), url(".env('APP_URL')."css/fonts/toadOcfmlt9b38dHJxOBGNbE_oMaV8t2eFeISPpzbdE.woff) format('woff');
                        }
                        @font-face {
                        font-family: 'Source Sans Pro';
                        font-style: normal;
                        font-weight: 400;
                        src: local('Source Sans Pro'), local('SourceSansPro-Regular'), url(".env('APP_URL')."css/fonts/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
                        }
                        @font-face {
                        font-family: 'Source Sans Pro';
                        font-style: normal;
                        font-weight: 700;
                        src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(".env('APP_URL')."css/fonts/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
                        }

                        @font-face {
                        font-family: 'Vollkorn';
                        font-style: normal;
                        font-weight: 400;
                        src: local('Vollkorn Regular'), local('Vollkorn-Regular'), url(".env('APP_URL')."css/fonts/BCFBp4rt5gxxFrX6F12DKvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
                        }
                        @font-face {
                        font-family: 'Vollkorn';
                        font-style: normal;
                        font-weight: 700;
                        src: local('Vollkorn Bold'), local('Vollkorn-Bold'), url(".env('APP_URL')."css/fonts/wMZpbUtcCo9GUabw9JODeobN6UDyHWBl620a-IRfuBk.woff) format('woff');
                        }

                        body {margin:0 auto; font-family:Tahoma,Geneva,sans-serif; font-size:11px; }
                        a{ text-decoration:none; color:#333333; }
                        h2{ font-size:12pt; }
                        .tbl_body { width:80%; font-size:10pt; background-color:#FFFFFF; border-collapse:collapse; }
                        .tbl_body td { padding:5px; }
                        .tbl_body .spacer_td { border-top:solid 1px #999999; background-color:#EEEEEE; height:30px; }
                        .tbl_body .spacer_btm_td { border-bottom:solid 1px #999999; height:15px; }
                        .title{ background-color:#FFFFFF; color:#666666; font-size:14pt; }
                        .footer{ background-color:#BBBBBB; color:#666666; font-size:8pt; }
                        .footer a{ color:#EEEEEE; }
                        .tit_residuo{ display: inline-block; font-size: 10pt; margin: 0 0 0 40px; padding: 3px 0 0; /* text-shadow: 1px 1px 2px #333; */ filter: dropshadow(color=#333, offx=1, offy=1);}
                        .alert_tit_residuo{ color:#990000; }
                        .tit_residuo .lbl_tit_residuo { display:inline-block; width:450px; }
                        .tit_residuo .lbl_val_residuo { display:inline-block; width:100px; vertical-align: top;}
                        .tit_ass_ore_residuo{   display: inline-block; font-size: 10pt; margin: 0 5px; padding: 3px 0 0; text-align: left; /*text-shadow: 1px 1px 2px #333; */ filter: dropshadow(color=#333, offx=1, offy=1);}
                        .tit_ass_ore_consumato{ display: inline-block; font-size: 10pt; margin: 0 5px; padding: 3px 0 0; text-align: center; width: 40%; /* text-shadow: 1px 1px 2px #333; */ filter: dropshadow(color=#333, offx=1, offy=1);}
                        .tbl_pack {display:table;}
                        .tbl_pack_row {display:table-row;}
                        .tbl_pack_row:nth-child(1) {border-top: 1px solid #DDDDDD;}
                        .tbl_pack_row:nth-child(2) {background-color:#dfedfe;}
                        .tbl_pack_td {border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; display: table-cell; margin: 0 5px 5px 0; padding: 5px; font-size: 9pt; vertical-align:top;}
                        .tbl_pack_td:nth-child(1) {border-left: 1px solid #DDDDDD;}
                        .tbl_pack_td_tit { font-weight:bold; background-color:#f7fedf; font-size: 10pt;}
                        .tbl_pack_td small{font-size:8pt;}
                        .tbl_pack_td b{font-size: 9pt;}
                        .box_note_commerciali_det_storico{background-color: #FFFFFF; border: 1px solid #999999; display: inline-block; min-height: 350px; overflow: auto; padding: 0 5px; width: 465px; vertical-align: top;}
                        .info_note_commerciali_top{font-size:9pt; border-bottom:solid 1px #999999; padding:5px 0; display:block; height: auto; position:relative;}
                        .info_note_commerciali_bottom{font-size:9pt; border-top:solid 1px #999999; padding:5px 0; display:block; height: auto; position:relative;}
                        .info_note_commerciali_top p, .info_note_commerciali_bottom p{margin:0;}
                        .info_note_commerciali_top h3, .info_note_commerciali_bottom h3{margin:0;}
                        .txt_nota_commerciale{font-size:10pt; padding:5px 15px;}
                        .txt_nota_tecnica{display:block; margin:0px 0px 10px 0px; padding:10px; background-color:#F5F5F5;}
                        .row_nota_commerciale{display:block; margin:0px 0px 10px 0px; padding:10px;}
                        .row_list_note{display:block; padding: 10px 5px; border: 1px solid #666666; margin:0px 0px 5px;}
                        </style>
                    </head>
                    <body>";

    return $top;
    }
    
    /**
     * footer_mail
     *
     * @return void
     */
    public function footer_mail()
    {

            $footer = '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
                                <tr>
                                    <td valign="top" class="footer" style="padding:10px 3px; text-align:left;">
                                        <strong>QUOTO! CRM <sub></sub></strong> è una realizzazione:<br />
                                            <br/>
                                            <img height="27" src="'.env('APP_URL').'img/logo_new_nws.png" align="left" style="margin-right:10px;"> Network Service srl - Via Valentini A. e L., 11 47922 Rimini (RN) | P.I. 04297510408 | tel. 0541.790062 | fax 0541.778656 | <a href="mailto:info@network-service.it">info@network-service.it</a>
                                    </td>
                                </tr>
                            </table>
                        </body>
                    </html>';

    return $footer;
    }

    public function invia($testo,$oggetto,$to)
    {

        $msg 	= $this->top_mail();
        $msg 	.= '<table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
                        <tr>
                            <td class="title">
                                <img src="'.env('APP_URL').'img/logo_quoto.png" /><br />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <p>'.$testo.'</p>
                            </td>
                        </tr>
                    </table>';
        $msg 	.= $this->footer_mail();
        $msg    .= '<br><br><div align="center">Questa e-mail è stata inviata dal software QUOTO! CRM, non rispondere a questa e-mail!</div>';
        $body 	= $msg;

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

        $mail->AddAddress($to,env('MAIL_FROM_NAME'));

        $mail->isHTML(true);

        $mail->Subject = $oggetto;
        $mail->Body    = $body;
        $mail->CharSet = 'UTF-8';


        $mail->send();


    }



    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {





        $this->invia(date('d-m-Y H:i:s'),'Prova Cron','marcello@network-service.it');


    }
}
