<?php
        $query_stile = "SELECT hospitality_stile_landing.*,hospitality_template_landing.BackgroundCellLink FROM hospitality_stile_landing
                        INNER JOIN hospitality_template_landing ON hospitality_template_landing.idsito = hospitality_stile_landing.idsito
                        WHERE hospitality_stile_landing.idsito = :idsito";
        $res_stile   = DB::select($query_stile,['idsito' => $idsito]);
        if(sizeof($res_stile)>0){
            $rec_stile   = $res_stile[0];
            $BackgroundEmail    = $rec_stile->BackgroundEmail;
            $BackgroundCellData = $rec_stile->BackgroundCellData;
            $BackgroundCellLink = $rec_stile->BackgroundCellLink;
        }else{
            $BackgroundEmail    = '#EBEBEB';
            $BackgroundCellData = '#dbd7d8';
            $BackgroundCellLink = '#EF4047';
        }

        $messaggio = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html>
                          <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                            <title>'.ucfirst($NomeHotel).'</title>
                            <!--[if gte mso 9]>
                            <xml>
                              <o:OfficeDocumentSettings>
                                <o:AllowPNG/>
                                <o:PixelsPerInch>96</o:PixelsPerInch>
                              </o:OfficeDocumentSettings>
                            </xml>
                            <![endif]-->
                            <meta name="viewport" content="width=device-width">
                            <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
                          </head>
                          <body style=\'width: 100% !important;min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100% !important;margin: 0;padding: 0;background-color: '.$BackgroundEmail.'\'>
                          <br>
                          <style id="media-query">
                              /* Client-specific Styles & Reset */
                              #outlook a {
                                  padding: 0;
                              }

                              /* .ExternalClass applies to Outlook.com (the artist formerly known as Hotmail) */
                              .ExternalClass {
                                  width: 100%;
                              }

                              .ExternalClass,
                              .ExternalClass p,
                              .ExternalClass span,
                              .ExternalClass font,
                              .ExternalClass td,
                              .ExternalClass div {
                                  line-height: 100%;
                              }

                              #backgroundTable {
                                  margin: 0;
                                  padding: 0;
                                  width: 100% !important;
                                  line-height: 100% !important;
                              }

                              /* Buttons */
                              .button a {
                                  display: inline-block;
                                  text-decoration: none;
                                  -webkit-text-size-adjust: none;
                                  text-align: center;
                              }

                              .button a div {
                                  text-align: center !important;
                              }

                              /* Outlook First */
                              body.outlook p {
                                  display: inline !important;
                              }

                              /*  Media Queries */
                          @media only screen and (max-width: 650px) {
                            table[class="body"] img {
                              height: auto !important;
                              width: 100% !important; }
                            table[class="body"] img.fullwidth {
                              max-width: 100% !important; }
                            table[class="body"] center {
                              min-width: 0 !important; }
                            table[class="body"] .container {
                              width: 95% !important; }
                            table[class="body"] .row {
                              width: 100% !important;
                              display: block !important; }
                            table[class="body"] .wrapper {
                              display: block !important;
                              padding-right: 0 !important; }
                            table[class="body"] .columns, table[class="body"] .column {
                              table-layout: fixed !important;
                              float: none !important;
                              width: 100% !important;
                              padding-right: 0px !important;
                              padding-left: 0px !important;
                              display: block !important; }
                            table[class="body"] .wrapper.first .columns, table[class="body"] .wrapper.first .column {
                              display: table !important; }
                            table[class="body"] table.columns td, table[class="body"] table.column td, .col {
                              width: 100% !important; }
                            table[class="body"] table.columns td.expander {
                              width: 1px !important; }
                            table[class="body"] .right-text-pad, table[class="body"] .text-pad-right {
                              padding-left: 10px !important; }
                            table[class="body"] .left-text-pad, table[class="body"] .text-pad-left {
                              padding-right: 10px !important; }
                            table[class="body"] .hide-for-small, table[class="body"] .show-for-desktop {
                              display: none !important; }
                            table[class="body"] .show-for-small, table[class="body"] .hide-for-desktop {
                              display: inherit !important; }
                            .mixed-two-up .col {
                              width: 100% !important; } }
                           @media screen and (max-width: 650px) {
                                div[class="col"] {
                                    width: 100% !important;
                                }
                              }

                              @media screen and (min-width: 651px) {
                                table[class="container"] {
                                    width: 650px !important;
                                }
                              }
                            </style>

                            <table cellpadding="0" cellspacing="0" width="100%" class="body" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;height: 100%;width: 100%;table-layout: fixed">
                                     <tbody>
                                        <tr style="vertical-align: top">
                                           <td class="center" align="left" valign="top" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;text-align: left;background-color: '.$BackgroundEmail.'">
                                              <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                 <tbody>
                                                    <tr style="vertical-align: top">
                                                       <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.'">
                                                          <!--[if gte mso 9]>
                                                          <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center">
                                                             <tr>
                                                                <td>
                                                                   <![endif]--> <!--[if (IE)]>
                                                                   <table width="650" align="center" cellpadding="0" cellspacing="0" border="0">
                                                                      <tr>
                                                                         <td>
                                                                            <![endif]-->
                                                                            <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 650px;margin: 0 auto;text-align: inherit">
                                                                               <tbody>
                                                                                  <tr style="vertical-align: top">
                                                                                     <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="transparent" class="block-grid two-up" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 650px;color: #333;background-color: transparent">
                                                                                           <tbody>
                                                                                              <tr style="vertical-align: top">
                                                                                                 <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;text-align: center;font-size: 0">
                                                                                                    <!--[if (gte mso 9)|(IE)]>
                                                                                                    <table width="100%" align="center" bgcolor="transparent" cellpadding="0" cellspacing="0" border="0">
                                                                                                       <tr>
                                                                                                          <![endif]--><!--[if (gte mso 9)|(IE)]>
                                                                                                          <td valign="top" width="325" style="width:325px;">
                                                                                                             <![endif]-->
                                                                                                             <div class="col num6" style="display: inline-block;vertical-align: central;text-align: left;width: 325px">
                                                                                                                <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                                                   <tbody>
                                                                                                                      <tr style="vertical-align: top">
                                                                                                                         <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 5px;padding-right: 0px;padding-bottom: 5px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
                                                                                                                            <table cellpadding="0" cellspacing="0" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                                                               <tbody>
                                                                                                                                  <tr style="vertical-align: top">
                                                                                                                                     <td align="left" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;width: 90%;padding-top: 0px;padding-right: 30px;padding-bottom: 0px;padding-left: 5px">
                                                                                                                                        <div align="left" style="width:215px" width="215"><b>'.($logo!=''?'<img src="'.url('uploads/loghi_siti/'.$logo.'').'" alt="'.$NomeHotel.'" class="center fullwidth" align="left" border="0" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block;border: 0;height: auto;line-height: 100%;margin: 0 auto;float: none;width: 215px;max-width: 215px" width="215" data-bee="true">':ucfirst($NomeHotel)).'</b></div>
                                                                                                                                     </td>
                                                                                                                                  </tr>
                                                                                                                               </tbody>
                                                                                                                            </table>
                                                                                                                         </td>
                                                                                                                      </tr>
                                                                                                                   </tbody>
                                                                                                                </table>
                                                                                                             </div>
                                                                                                             <!--[if (gte mso 9)|(IE)]>
                                                                                                          </td>
                                                                                                          <![endif]-->
                                                                                                          <!--[if (gte mso 9)|(IE)]>
                                                                                                          <td valign="top" width="325" style="width:325px;">
                                                                                                             <![endif]-->
                                                                                                             <div class="col num6" style="display: inline-block;vertical-align: top;text-align: center;width: 325px">
                                                                                                                <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                                                   <tbody>
                                                                                                                      <tr style="vertical-align: top">
                                                                                                                         <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.';padding-top: 20px;padding-right: 0px;padding-bottom: 15px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
                                                                                                                            <table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: central">
                                                                                                                               <tbody>
                                                                                                                                  <tr style="vertical-align: central">
                                                                                                                                     <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
                                                                                                                                        <div style="color:#5E5E5E;line-height:120%;font-family:Georgia, serif;">
                                                                                                                                           <div style="font-size:14px;line-height:17px;color:#5E5E5E;font-family:Georgia, serif;text-align:right;">
                                                                                                                                              <p style="margin: 0;font-size: 14px;line-height: 17px"><b>'.DATA_RICHIESTA.'</b><br>'.date('d-m-Y').'</p>
                                                                                                                                           </div>
                                                                                                                                        </div>
                                                                                                                                     </td>
                                                                                                                                  </tr>
                                                                                                                               </tbody>
                                                                                                                            </table>
                                                                                                                         </td>
                                                                                                                      </tr>
                                                                                                                   </tbody>
                                                                                                                </table>
                                                                                                             </div>
                                                                                                             <!--[if (gte mso 9)|(IE)]>
                                                                                                          </td>
                                                                                                          <![endif]--><!--[if (gte mso 9)|(IE)]></td>
                                                                                                       </tr>
                                                                                                    </table>
                                                                                                    <![endif]-->
                                                                                                 </td>
                                                                                              </tr>
                                                                                           </tbody>
                                                                                        </table>
                                                                                     </td>
                                                                                  </tr>
                                                                               </tbody>
                                                                            </table>
                                                                            <!--[if mso]>
                                                                         </td>
                                                                      </tr>
                                                                   </table>
                                                                   <![endif]--> <!--[if (IE)]>
                                                                </td>
                                                             </tr>
                                                          </table>
                                                          <![endif]-->
                                                       </td>
                                                    </tr>
                                                 </tbody>
                                              </table>

                                    <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                       <tbody>
                                          <tr style="vertical-align: top">
                                             <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.'">
                                                <!--[if gte mso 9]>
                                                <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center">
                                                   <tr>
                                                      <td>
                                                         <![endif]--> <!--[if (IE)]>
                                                         <table width="650" align="center" cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                               <td>
                                                                  <![endif]-->
                                                                  <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 650px;margin: 0 auto;text-align: inherit">
                                                                     <tbody>
                                                                        <tr style="vertical-align: top">
                                                                           <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top; padding-left:5px; padding-right:5px">
                                                                              <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF" class="block-grid" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 650px;color: #000000;background-color: #FFFFFF">
                                                                                 <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                       <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: #FFFFFF;text-align: center;font-size: 0">
                                                                                          <!--[if (gte mso 9)|(IE)]>
                                                                                          <table width="100%" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" border="0">
                                                                                             <tr>
                                                                                                <![endif]--><!--[if (gte mso 9)|(IE)]>
                                                                                                <td valign="top" width="650" style="width:650px;">
                                                                                                   <![endif]-->
                                                                                                   <div class="col num12" style="display: inline-block;vertical-align: top;width: 100%">
                                                                                                      <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                                         <tbody>
                                                                                                            <tr style="vertical-align: top">
                                                                                                               <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;padding-left: 5px;border-top: 1px solid #D0D0D0;border-right: 1px solid #D0D0D0;border-bottom: 1px solid #D0D0D0;border-left: 1px solid #D0D0D0">
                                                                                                                  <table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                                                     <tbody>
                                                                                                                        <tr style="vertical-align: top">
                                                                                                                           <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
                                                                                                                              <div style="color:#5E5E5E;line-height:120%;font-family:Georgia, serif;">
                                                                                                                                 <div style="font-size:16px;line-height:25px;color:#5E5E5E;font-family:Georgia, serif;text-align:left;">';
                                                                                                            $messaggio .= str_replace("[cliente]",('<b>'.stripslashes($Nome).' '.stripslashes($Cognome).'</b>'),$rw->Messaggio);
                                                                                                            $messaggio .='    </div>
                                                                                                                              </div>
                                                                                                                           </td>
                                                                                                                        </tr>
                                                                                                                     </tbody>
                                                                                                                  </table>
                                                                                                               </td>
                                                                                                            </tr>
                                                                                                         </tbody>
                                                                                                      </table>
                                                                                                   </div>
                                                                                                   <!--[if (gte mso 9)|(IE)]>
                                                                                                </td>
                                                                                             </tr>
                                                                                          </table>
                                                                                          <![endif]-->
                                                                                       </td>
                                                                                    </tr>
                                                                                 </tbody>
                                                                              </table>
                                                                           </td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                                  <!--[if mso]>
                                                               </td>
                                                            </tr>
                                                         </table>
                                                         <![endif]--> <!--[if (IE)]>
                                                      </td>
                                                   </tr>
                                                </table>
                                                <![endif]-->
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>


                                    <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                      <tbody>
                                        <tr style="vertical-align: top">
                                          <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.'">
                                            <!--[if gte mso 9]>
                                            <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center">
                                              <tr>
                                                <td>
                                                  <![endif]--> <!--[if (IE)]>
                                                  <table width="650" align="center" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                      <td>
                                                        <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 650px;margin: 0 auto;text-align: inherit">
                                                          <tbody>
                                                            <tr style="vertical-align: top">
                                                              <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                <table cellpadding="0" cellspacing="0" width="100%" bgcolor="'.$BackgroundEmail.'" class="block-grid " style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 650px;color: #000000;background-color: '.$BackgroundEmail.'">
                                                                  <tbody>
                                                                    <tr style="vertical-align: top">
                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: trasparent;text-align: center;font-size: 0">
                                                                        <!--[if (gte mso 9)|(IE)]>
                                                                        <table width="100%" align="center" bgcolor="'.$BackgroundEmail.'" cellpadding="0" cellspacing="0" border="0">
                                                                          <tr>
                                                                            <![endif]--><!--[if (gte mso 9)|(IE)]>
                                                                            <td valign="top" width="650" style="width:650px;">
                                                                              <![endif]-->
                                                                              <div class="col num12" style="display: inline-block;vertical-align: top;width: 100%">
                                                                                <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                  <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 5px;padding-right: 0px;padding-bottom: 5px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                          <tbody>
                                                                                            <tr style="vertical-align: top">
                                                                                              <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 20px;padding-right: 10px;padding-bottom: 5px;padding-left: 10px">
                                                                                                <div style="color:#5E5E5E;line-height:120%;font-family:Georgia, serif;">
                                                                                                  <div style="font-size:16px;line-height:14px;color:#5E5E5E;font-family:Georgia, serif;text-align:left;">
                                                                                                    <p style="margin: 0;font-size: 16px;line-height: 17px"><strong>'.$_datisoggiorno.'</strong></p>
                                                                                                  </div>
                                                                                                </div>
                                                                                              </td>
                                                                                            </tr>
                                                                                          </tbody>
                                                                                        </table>
                                                                                      </td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                                </table>
                                                                              </div>
                                                                              <!--[if (gte mso 9)|(IE)]>
                                                                            </td>
                                                                          </tr>
                                                                        </table>
                                                                        <![endif]-->
                                                                      </td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                  <![endif]--> <!--[if (IE)]>
                                                </td>
                                              </tr>
                                            </table>
                                            <![endif]-->
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                      <tbody>
                                        <tr style="vertical-align: top">
                                          <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.'">
                                            <!--[if gte mso 9]>
                                            <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center">
                                              <tr>
                                                <td>
                                                  <![endif]--> <!--[if (IE)]>
                                                  <table width="650" align="center" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                      <td>
                                                        <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 650px;margin: 0 auto;text-align: inherit">
                                                          <tbody>
                                                            <tr style="vertical-align: top">
                                                              <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                <table cellpadding="0" cellspacing="0" width="100%" bgcolor="transparent" class="block-grid two-up" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 650px;color: #333;background-color: transparent">
                                                                  <tbody>
                                                                    <tr style="vertical-align: top">
                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;text-align: center;font-size: 0">
                                                                        <!--[if (gte mso 9)|(IE)]>
                                                                        <table width="100%" align="center" bgcolor="transparent" cellpadding="0" cellspacing="0" border="0">
                                                                          <tr>
                                                                            <![endif]--><!--[if (gte mso 9)|(IE)]>
                                                                            <td valign="top" width="325" style="width:325px;">
                                                                              <![endif]-->
                                                                              <div class="col num6" style="display: inline-block;vertical-align: top;text-align: center;width: 325px;background-color:trasparent">
                                                                                <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                  <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;padding-left: 5px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: central">
                                                                                          <tbody>
                                                                                            <tr style="vertical-align: central; background-color:'.$BackgroundCellData.'">
                                                                                              <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: central;padding-top: 10px;padding-right: 0px;padding-bottom: 10px;padding-left: 10px; max-width:55px" width="55">
                                                                                                <img src="'.url('img/icon_email/calendar.png').'" alt=">" width="50px" max-width="50px" />
                                                                                              </td>
                                                                                              <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: central;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
                                                                                                <div style="color:#5E5E5E;line-height:120%;font-family:Georgia, serif;">
                                                                                                  <div style="font-size:18px;line-height:18px;color:#5E5E5E;font-family:Georgia, serif;text-align:left;">
                                                                                                    <p style="margin: 0;font-size: 18px;line-height: 18px"><b>'.$_dataarrivo.'</b> <br><em>'.$DataArrivo.'</em></p>
                                                                                                  </div>
                                                                                                </div>
                                                                                              </td>
                                                                                            </tr>
                                                                                          </tbody>
                                                                                        </table>
                                                                                      </td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                                </table>
                                                                              </div>
                                                                              <!--[if (gte mso 9)|(IE)]>
                                                                            </td>
                                                                            <![endif]--><!--[if (gte mso 9)|(IE)]>
                                                                            <td valign="top" width="325" style="width:325px;">
                                                                              <![endif]-->
                                                                              <div class="col num6" style="display: inline-block;vertical-align: top;text-align: center;width: 325px;background-color:trasparent">
                                                                                <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                  <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 5px;padding-right: 5px;padding-bottom: 5px;padding-left: 5px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: central">
                                                                                          <tbody>
                                                                                            <tr style="vertical-align: central; background-color:'.$BackgroundCellData.'">
                                                                                              <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: central;padding-top: 10px;padding-right: 0px;padding-bottom: 10px;padding-left: 10px; max-width:55px" width="55">
                                                                                                <img src="'.url('img/icon_email/calendar.png').'" alt=">" width="50px" max-width="50px" />
                                                                                              </td>
                                                                                              <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: central;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
                                                                                                <div style="color:#5E5E5E;line-height:120%;font-family:Georgia, serif;">
                                                                                                  <div style="font-size:18px;line-height:18px;color:#5E5E5E;font-family:Georgia, serif;text-align:left;">
                                                                                                    <p style="margin: 0;font-size: 18px;line-height: 18px"><b>'.$_datapartenza.'</b> <br><em>'.$DataPartenza.'</em></p>
                                                                                                  </div>
                                                                                                </div>
                                                                                              </td>
                                                                                            </tr>
                                                                                          </tbody>
                                                                                        </table>
                                                                                      </td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                                </table>
                                                                              </div>
                                                                              <!--[if (gte mso 9)|(IE)]>
                                                                            </td>
                                                                          </tr>
                                                                        </table>
                                                                        <![endif]-->
                                                                      </td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                  <![endif]--> <!--[if (IE)]>
                                                </td>
                                              </tr>
                                            </table>
                                            <![endif]-->
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>

                                    <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                      <tbody>
                                        <tr style="vertical-align: top">
                                          <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.'">
                                            <!--[if gte mso 9]>
                                            <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center">
                                              <tr>
                                                <td>
                                                  <![endif]--> <!--[if (IE)]>
                                                  <table width="650" align="center" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                      <td>
                                                        <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 650px;margin: 0 auto;text-align: inherit">
                                                          <tbody>
                                                            <tr style="vertical-align: top">
                                                              <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                <table cellpadding="0" cellspacing="0" width="100%" bgcolor="'.$BackgroundEmail.'" class="block-grid " style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 650px;color: #000000;background-color: '.$BackgroundEmail.'">
                                                                  <tbody>
                                                                    <tr style="vertical-align: top">
                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.';text-align: center;font-size: 0">
                                                                        <!--[if (gte mso 9)|(IE)]>
                                                                        <table width="100%" align="center" bgcolor="'.$BackgroundEmail.'" cellpadding="0" cellspacing="0" border="0">
                                                                          <tr>
                                                                            <![endif]--><!--[if (gte mso 9)|(IE)]>
                                                                            <td valign="top" width="650" style="width:650px;">
                                                                              <![endif]-->
                                                                              <div class="col num12" style="display: inline-block;vertical-align: top;width: 100%">
                                                                                <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                  <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 2px;padding-right: 0px;padding-bottom: 2px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                          <tbody>
                                                                                            <tr style="vertical-align: top">
                                                                                              <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 2px;padding-right: 10px;padding-bottom: 2px;padding-left: 10px">
                                                                                                <div style="color:#5E5E5E;line-height:120%;font-family:Georgia, serif;">  </div>
                                                                                              </td>
                                                                                            </tr>
                                                                                          </tbody>
                                                                                        </table>
                                                                                      </td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                                </table>
                                                                              </div>
                                                                              <!--[if (gte mso 9)|(IE)]>
                                                                            </td>
                                                                          </tr>
                                                                        </table>
                                                                        <![endif]-->
                                                                      </td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                  <![endif]--> <!--[if (IE)]>
                                                </td>
                                              </tr>
                                            </table>
                                            <![endif]-->
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                      <tbody>
                                        <tr style="vertical-align: top">
                                          <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.'">
                                            <!--[if gte mso 9]>
                                            <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center">
                                              <tr>
                                                <td>
                                                  <![endif]--> <!--[if (IE)]>
                                                  <table width="650" align="center" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                      <td>
                                                        <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 650px;margin: 0 auto;text-align: inherit">
                                                          <tbody>
                                                            <tr style="vertical-align: top">
                                                              <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                <table cellpadding="0" cellspacing="0" width="100%" bgcolor="'.$BackgroundCellLink.'" class="block-grid" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 650px;color: #000000;background-color: '.$BackgroundCellLink.'">
                                                                  <tbody>
                                                                    <tr style="vertical-align: top">
                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundCellLink.';text-align: center;font-size: 0">
                                                                        <!--[if (gte mso 9)|(IE)]>
                                                                        <table width="100%" align="center" bgcolor="'.$BackgroundCellLink.'" cellpadding="0" cellspacing="0" border="0">
                                                                          <tr>
                                                                            <![endif]--><!--[if (gte mso 9)|(IE)]>
                                                                            <td valign="top" width="650" style="width:650px;">
                                                                              <![endif]-->
                                                                              <div class="col num12" style="display: inline-block;vertical-align: top;width: 100%">
                                                                                <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                  <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 0px;padding-right: 0px;padding-bottom: 5px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                          <tbody>
                                                                                            <tr style="vertical-align: top">
                                                                                              <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 0px;padding-right: 10px;padding-bottom: 5px;padding-left: 10px">

                                                                                                  <div style="color:#FFFFFF;line-height:120%;font-family:Georgia, serif;">
                                                                                                    <div style="font-size:12px;line-height:14px;color:#5E5E5E;font-family:Georgia, serif;text-align:left;">
                                                                                                      <table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                                        <tbody>
                                                                                                          <tr style="vertical-align: central">
                                                                                                            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: central;padding-top: 15px;padding-right: 5px;padding-bottom: 10px;padding-left: 10px">
                                                                                                              <a href="'.$link.'" style="text-decoration:none"><p style="margin: 0;font-size: 22px;line-height: 25px; color:#FFFFFF"><strong>'.$_txtlink1.'</strong></p></a>
                                                                                                              <a href="'.$link.'" style="text-decoration:none"><p style="margin: 0;font-size: 18px;line-height: 20px; color:#FFFFFF">'.$_txtlink2.'</p></a>
                                                                                                            </td>
                                                                                                            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: central;padding-top: 10px;padding-right: 5px;padding-bottom: 10px;padding-left: 5px"><a href="'.$link.'" style="text-decoration:none"><img src="'.url('img/icon_email/arrow.png').'" style="vertical-align:central" alt=">" /></a></td>
                                                                                                          </tr>
                                                                                                        </tbody>
                                                                                                      </table>
                                                                                                    </div>
                                                                                                  </div>

                                                                                              </td>
                                                                                            </tr>
                                                                                          </tbody>
                                                                                        </table>
                                                                                      </td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                                </table>
                                                                              </div>
                                                                              <!--[if (gte mso 9)|(IE)]>
                                                                            </td>
                                                                            <![endif]--><!--[if (gte mso 9)|(IE)]></td>
                                                                          </tr>
                                                                        </table>
                                                                        <![endif]-->
                                                                      </td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                  <![endif]--> <!--[if (IE)]>
                                                </td>
                                              </tr>
                                            </table>
                                            <![endif]-->
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>';
                  // query per le tre foto
                  $sel_img = "SELECT * FROM hospitality_minigallery WHERE idsito = :idsito ORDER BY Id DESC LIMIT 3";
                  $res_img = DB::select($sel_img,['idsito' => $idsito]);
                  if(sizeof($res_img)>0){
                      $messaggio .='
                                    <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                      <tbody>
                                        <tr style="vertical-align: top">
                                          <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.'">
                                            <!--[if gte mso 9]>
                                            <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center">
                                              <tr>
                                                <td>
                                                  <![endif]--> <!--[if (IE)]>
                                                  <table width="650" align="center" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                      <td>
                                                        <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 650px;margin: 0 auto;text-align: inherit">
                                                          <tbody>
                                                            <tr style="vertical-align: top">
                                                              <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                <table cellpadding="0" cellspacing="0" width="100%" bgcolor="transparent" class="block-grid three-up" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 650px;color: #000000;background-color: transparent">
                                                                  <tbody>
                                                                    <tr style="vertical-align: top">
                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;text-align: center;font-size: 0">
                                                                        <!--[if (gte mso 9)|(IE)]>
                                                                        <table width="100%" align="center" bgcolor="transparent" cellpadding="0" cellspacing="0" border="0">
                                                                          <tr>';
                                                      foreach ($res_img as $key => $value) {
                                                            $messaggio .='<![endif]--><!--[if (gte mso 9)|(IE)]>
                                                                            <td valign="top" width="216" style="width:216px;">
                                                                              <![endif]-->
                                                                              <div class="col num4" style="display: inline-block;vertical-align: top;text-align: center;width: 216px">
                                                                                <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                  <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 10px;padding-right: 5px;padding-bottom: 5px;padding-left: 5px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                          <tbody>
                                                                                            <tr style="vertical-align: top">
                                                                                              <td align="center" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;width: 100%;padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px">
                                                                                                <div align="center" style="font-size:12px"> <img class="center fullwidth" align="center" border="0" src="'.url('/uploads/'.$idsito.'/'.$value->Immagine.'').'" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block;border: 0;height: auto;line-height: 100%;margin: 0 auto;float: none;width: 100% !important;max-width: 216px" width="216" data-bee="true"> </div>
                                                                                              </td>
                                                                                            </tr>
                                                                                          </tbody>
                                                                                        </table>
                                                                                      </td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                                </table>
                                                                              </div>
                                                                              <!--[if (gte mso 9)|(IE)]>
                                                                            </td>
                                                                            <![endif]--><!--[if (gte mso 9)|(IE)]>';
                                                        }
                                                        $messaggio .='  </tr>
                                                                        </table>
                                                                        <![endif]-->
                                                                      </td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                  <![endif]--> <!--[if (IE)]>
                                                </td>
                                              </tr>
                                            </table>
                                            <![endif]-->
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>';
                  }else{
                    $messaggio .='  <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                      <tbody>
                                        <tr style="vertical-align: top">
                                          <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.'">
                                            <!--[if gte mso 9]>
                                            <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center">
                                              <tr>
                                                <td>
                                                  <![endif]--> <!--[if (IE)]>
                                                  <table width="650" align="center" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                      <td>
                                                        <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 650px;margin: 0 auto;text-align: inherit">
                                                          <tbody>
                                                            <tr style="vertical-align: top">
                                                              <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                <table cellpadding="0" cellspacing="0" width="100%" bgcolor="'.$BackgroundEmail.'" class="block-grid " style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 650px;color: #000000;background-color: '.$BackgroundEmail.'">
                                                                  <tbody>
                                                                    <tr style="vertical-align: top">
                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.';text-align: center;font-size: 0">
                                                                        <!--[if (gte mso 9)|(IE)]>
                                                                        <table width="100%" align="center" bgcolor="'.$BackgroundEmail.'" cellpadding="0" cellspacing="0" border="0">
                                                                          <tr>
                                                                            <![endif]--><!--[if (gte mso 9)|(IE)]>
                                                                            <td valign="top" width="650" style="width:650px;">
                                                                              <![endif]-->
                                                                              <div class="col num12" style="display: inline-block;vertical-align: top;width: 100%">
                                                                                <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                  <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 2px;padding-right: 0px;padding-bottom: 2px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                          <tbody>
                                                                                            <tr style="vertical-align: top">
                                                                                              <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 2px;padding-right: 10px;padding-bottom: 2px;padding-left: 10px">
                                                                                                <div style="color:#5E5E5E;line-height:120%;font-family:Georgia, serif;">  </div>
                                                                                              </td>
                                                                                            </tr>
                                                                                          </tbody>
                                                                                        </table>
                                                                                      </td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                                </table>
                                                                              </div>
                                                                              <!--[if (gte mso 9)|(IE)]>
                                                                            </td>
                                                                          </tr>
                                                                        </table>
                                                                        <![endif]-->
                                                                      </td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                  <![endif]--> <!--[if (IE)]>
                                                </td>
                                              </tr>
                                            </table>
                                            <![endif]-->
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>';
                  }
                  $messaggio .='    <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                      <tbody>
                                        <tr style="vertical-align: top">
                                          <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.'">
                                            <!--[if gte mso 9]>
                                            <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center">
                                              <tr>
                                                <td>
                                                  <![endif]--> <!--[if (IE)]>
                                                  <table width="650" align="center" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                      <td>
                                                        <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 650px;margin: 0 auto;text-align: inherit">
                                                          <tbody>
                                                            <tr style="vertical-align: top">
                                                              <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF" class="block-grid " style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 650px;color: #000000;background-color: #FFFFFF">
                                                                  <tbody>
                                                                    <tr style="vertical-align: top">
                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: #FFFFFF;text-align: center;font-size: 0">
                                                                        <!--[if (gte mso 9)|(IE)]>
                                                                        <table width="100%" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" border="0">
                                                                          <tr>
                                                                            <![endif]--><!--[if (gte mso 9)|(IE)]>
                                                                            <td valign="top" width="650" style="width:650px;">
                                                                              <![endif]-->
                                                                              <div class="col num12" style="display: inline-block;vertical-align: top;width: 100%">
                                                                                <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                  <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 5px;padding-right: 0px;padding-bottom: 5px;padding-left: 0px;border-top: 1px solid #D0D0D0;border-right: 1px solid #D0D0D0;border-bottom: 1px solid #D0D0D0;border-left: 1px solid #D0D0D0">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                          <tbody>
                                                                                            <tr style="vertical-align: top">
                                                                                              <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
                                                                                                <div style="color:#5E5E5E;line-height:120%;font-family:Georgia, serif;">
                                                                                                  <div style="font-size:18px;line-height:20px;color:#5E5E5E;font-family:Georgia, serif;text-align:left;">
                                                                                                    <p style="margin: 0;font-size: 18px;line-height: 20px"><em>'.$_saluti.'</em></p>
                                                                                                  </div>
                                                                                                </div>
                                                                                              </td>
                                                                                            </tr>
                                                                                            <tr style="vertical-align: top">
                                                                                              <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
                                                                                                <div style="color:#5E5E5E;line-height:120%;font-family:Georgia, serif;">
                                                                                                  <div style="font-size:14px;line-height:20px;color:#5E5E5E;font-family:Georgia, serif;text-align:left;">
                                                                                                    <p style="margin: 0;font-size: 14px;line-height: 20px">
                                                                                                        '.$Operatore.' - <span style="color:#EF4047">'.ucfirst($NomeHotel).'</span><br>
                                                                                                         '.$indirizzo.' - '.$cap.' '.$comune.' ('.$prov.')<br>
                                                                                                          Tel. '.$tel.' '.($fax!=''?' Fax. '.$fax:'').' E-mail: '.$EmailHotel.'
                                                                                                    </p>
                                                                                                  </div>
                                                                                                </div>
                                                                                              </td>
                                                                                            </tr>
                                                                                          </tbody>
                                                                                        </table>
                                                                                      </td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                                </table>
                                                                              </div>
                                                                              <!--[if (gte mso 9)|(IE)]>
                                                                            </td>
                                                                            <![endif]--><!--[if (gte mso 9)|(IE)]></td>
                                                                          </tr>
                                                                        </table>
                                                                        <![endif]-->
                                                                      </td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                  <![endif]--> <!--[if (IE)]>
                                                </td>
                                              </tr>
                                            </table>
                                            <![endif]-->
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                      <tbody>
                                        <tr style="vertical-align: top">
                                          <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.'">
                                            <!--[if gte mso 9]>
                                            <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center">
                                              <tr>
                                                <td>
                                                  <![endif]--> <!--[if (IE)]>
                                                  <table width="650" align="center" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                      <td>
                                                        <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 650px;margin: 0 auto;text-align: inherit">
                                                          <tbody>
                                                            <tr style="vertical-align: top">
                                                              <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                <table cellpadding="0" cellspacing="0" width="100%" bgcolor="transparent" class="block-grid " style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 650px;color: #000000;background-color: transparent">
                                                                  <tbody>
                                                                    <tr style="vertical-align: top">
                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;text-align: center;font-size: 0">
                                                                        <!--[if (gte mso 9)|(IE)]>
                                                                        <table width="100%" align="center" bgcolor="transparent" cellpadding="0" cellspacing="0" border="0">
                                                                          <tr>
                                                                            <![endif]--><!--[if (gte mso 9)|(IE)]>
                                                                            <td valign="top" width="650" style="width:650px;">
                                                                              <![endif]-->
                                                                              <div class="col num12" style="display: inline-block;vertical-align: top;width: 100%">
                                                                                <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                  <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 5px;padding-right: 0px;padding-bottom: 5px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                          <tbody>
                                                                                            <tr style="vertical-align: top">
                                                                                              <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
                                                                                                <div style="color:#5E5E5E;line-height:120%;font-family: Arial; font-style:italic; font-size: 11px;">
                                                                                                  <div style="line-height:14px;color:#5E5E5E;font-family: Arial; font-size: 11px;text-align:left;">
                                                                                                    <p style="margin: 0;font-size: 11px;line-height: 14px;text-align: right"><em>'.NO_REPLAY_EMAIL.'</em></p>
                                                                                                  </div>
                                                                                                </div>
                                                                                              </td>
                                                                                            </tr>
                                                                                          </tbody>
                                                                                        </table>
                                                                                      </td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                                </table>
                                                                              </div>
                                                                              <!--[if (gte mso 9)|(IE)]>
                                                                            </td>
                                                                          </tr>
                                                                        </table>
                                                                        <![endif]-->
                                                                      </td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                  <![endif]--> <!--[if (IE)]>
                                                </td>
                                              </tr>
                                            </table>
                                            <![endif]-->
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                      <tbody>
                                        <tr style="vertical-align: top">
                                          <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: '.$BackgroundEmail.'">
                                            <!--[if gte mso 9]>
                                            <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center">
                                              <tr>
                                                <td>
                                                  <![endif]--> <!--[if (IE)]>
                                                  <table width="650" align="center" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                      <td>
                                                        <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 650px;margin: 0 auto;text-align: inherit">
                                                          <tbody>
                                                            <tr style="vertical-align: top">
                                                              <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                <table cellpadding="0" cellspacing="0" width="100%" bgcolor="transparent" class="block-grid " style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 650px;color: #000000;background-color: transparent">
                                                                  <tbody>
                                                                    <tr style="vertical-align: top">
                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;text-align: center;font-size: 0">
                                                                        <!--[if (gte mso 9)|(IE)]>
                                                                        <table width="100%" align="center" bgcolor="transparent" cellpadding="0" cellspacing="0" border="0">
                                                                          <tr>
                                                                            <![endif]--><!--[if (gte mso 9)|(IE)]>
                                                                            <td valign="top" width="650" style="width:650px;">
                                                                              <![endif]-->
                                                                              <div class="col num12" style="display: inline-block;vertical-align: top;width: 100%">
                                                                                <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                  <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                      <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 5px;padding-right: 0px;padding-bottom: 5px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
                                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                                                                                          <tbody>
                                                                                            <tr style="vertical-align: top">
                                                                                              <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
                                                                                                <div style="color:#5E5E5E;line-height:120%;font-family:Georgia, serif;">
                                                                                                  <div style="font-size:11px;line-height:14px;color:#5E5E5E;font-family: Arial; text-align:left;">
                                                                                                    <p style="margin: 0;font-size: 11px;line-height: 14px;text-align: right"><em>Powered By QUOTO! - Network Service s.r.l</em></p>
                                                                                                  </div>
                                                                                                </div>
                                                                                              </td>
                                                                                            </tr>
                                                                                          </tbody>
                                                                                        </table>
                                                                                      </td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                                </table>
                                                                              </div>
                                                                              <!--[if (gte mso 9)|(IE)]>
                                                                            </td>
                                                                          </tr>
                                                                        </table>
                                                                        <![endif]-->
                                                                      </td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                      </td>
                                                    </tr>
                                                  </table>
                                                  <![endif]--> <!--[if (IE)]>
                                                </td>
                                              </tr>
                                            </table>
                                            <![endif]-->
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>';
   $messaggio .= '        </body>
                        </html>';
?>
