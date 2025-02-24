<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use DateTime;

class ApiController extends Controller
{    


    
    /**
     * configurazioneAI
     *
     * @param  mixed $idsito
     * @return void
     */
    public function configurazioniAI(Request $request)
    {

        $select = "SELECT 
                        * 
                    FROM hospitality_configurazioniAI
                    WHERE hospitality_configurazioniAI.idsito = :idsito";
        $result = DB::select($select,['idsito' => $request->idsito]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API configurazioneAI() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Configurazioni non trovate!']);
        }
        
    }

    
    /**
     * strutture
     *
     * @return void
     */
    public function strutture()
    {

        $select = "SELECT 
                        s.idsito,
                        s.web,
                        s.nome,
                        s.email,
                        s.email_alternativa_form_quoto 
                    FROM siti as s
                    WHERE s.hospitality = 1
                    AND s.data_start_hospitality <= :startDate
                    AND s.data_end_hospitality > :endDate";
        $result = DB::select($select,['startDate' => date('Y-m-d'), 'endDate' => date('Y-m-d')]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API strutture() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Strutture non trovati!']);
        }
        
    }

    /**
     * prefissi
     *
     * @return void
     */
    public function prefissi()
    {

        $select = "SELECT * FROM prefissi ORDER BY nazione ASC";
        $result = DB::select($select);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API prefissi() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Prefissi non trovati!']);
        }
      
    }

    /**
     * lingue
     *
     * @param  mixed $request
     * @return void
     */
    public function lingue(Request $request)
    {  
        $select = "SELECT * FROM hospitality_lingue WHERE idsito = :idsito";
        $result = DB::select($select,['idsito' => $request->idsito]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API lingue() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Lingue non trovate!']);
        }
        
    }
        
    /**
     * operatori
     *
     * @param  mixed $request
     * @return void
     */
    public function operatori(Request $request)
    {
        $select = "SELECT * FROM hospitality_operatori WHERE idsito = :idsito AND Abilitato = :Abilitato";
        $result = DB::select($select,['idsito' => $request->idsito,'Abilitato' => 1]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API operatori() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Operatori non trovati!']);
        }
       
    }
  
    /**
     * target
     *
     * @param  mixed $request
     * @return void
     */
    public function target(Request $request)
    {
        $select = "SELECT * FROM hospitality_target WHERE idsito = :idsito AND Abilitato = :Abilitato";
        $result = DB::select($select,['idsito' => $request->idsito,'Abilitato' => 1]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API target() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Target non trovati!']);
        }
        
    }
    
    /**
     * template
     *
     * @param  mixed $request
     * @return void
     */
    public function template(Request $request)
    {
        $select = "	SELECT
						hospitality_template_background.TemplateName,
						hospitality_template_background.Thumb,
						hospitality_template_background.Id as id_template
					FROM
						hospitality_template_background
					WHERE
						hospitality_template_background.idsito = :idsito
                    AND
                        hospitality_template_background.Visibile = 1";
        $result = DB::select($select,['idsito' => $request->idsito]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API template() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'template non trovati!']);
        }
       
    }
    
    /**
     * template_default
     *
     * @param  mixed $request
     * @return void
     */
    public function template_default(Request $request)
    {
        $select = "SELECT * FROM hospitality_template_landing WHERE idsito = :idsito";
        $result = DB::select($select,['idsito' => $request->idsito]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API template_default() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'template impostato di default non trovati!']);
        }
        
    }
    
    /**
     * template_link_preventivo
     *
     * @param  mixed $request
     * @return void
     */
    public function template_link_preventivo(Request $request)
    {
        $select = "SELECT * FROM hospitality_template_link_landing WHERE idsito = :idsito AND id_richiesta = :id_richiesta";
        $result = DB::select($select,['idsito' => $request->idsito,'id_richiesta' => $request->id_richiesta]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API template_link_preventivo() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Template NON impostato nel preventivo, oppure non trovato!']);
            $message = date('d-m-Y H:i:s').' -> API template_link_preventivo() -> Esito: error; i dati richiesti non sono stati trovati, oppure la chiamata effettuata era errata!';
        }
       
    }
    
    
    /**
     * proposte_pacchetti
     *
     * @param  mixed $request
     * @return void
     */
    public function proposte_pacchetti(Request $request)
    {
        $select = "SELECT 
                        hospitality_tipo_pacchetto.TipoPacchetto,
                        hospitality_tipo_pacchetto_lingua.* 
                    FROM 
                        hospitality_tipo_pacchetto_lingua
					INNER JOIN 
                        hospitality_tipo_pacchetto ON hospitality_tipo_pacchetto.Id = hospitality_tipo_pacchetto_lingua.pacchetto_id
					WHERE 
                        hospitality_tipo_pacchetto_lingua.lingue = :lingua
					AND 
                        hospitality_tipo_pacchetto.Abilitato = 1
					AND 
                        hospitality_tipo_pacchetto_lingua.idsito = :idsito
					ORDER BY 
                        hospitality_tipo_pacchetto_lingua.Pacchetto ASC";
        $result = DB::select($select,['idsito' => $request->idsito,'lingua' => $request->lingua]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API proposte_pacchetti() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Proposte e Pacchetti non trovati!']);
        }
        
    }
    
    /**
     * tipologie_soggiorni
     *
     * @param  mixed $request
     * @return void
     */
    public function tipo_soggiorni(Request $request)
    {
        $select = "SELECT * FROM hospitality_tipo_soggiorno WHERE idsito = :idsito  AND Abilitato = :Abilitato ORDER BY TipoSoggiorno ASC";
        $result = DB::select($select,['idsito' => $request->idsito,'Abilitato' => 1]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API tipo_soggiorni() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Tipo Soggiorni non trovati!']);
        }
        
    }
    
    /**
     * tipo_camere
     *
     * @param  mixed $request
     * @return void
     */
    public function tipo_camere(Request $request)
    {
        $select = "SELECT * FROM hospitality_tipo_camere WHERE idsito = :idsito  AND Abilitato = :Abilitato ORDER BY TipoCamere ASC";
        $result = DB::select($select,['idsito' => $request->idsito,'Abilitato' => 1]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API tipo_camere() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Tipo Camere non trovati!']);
        }
       
    }
    
    /**
     * servizi_aggiuntivi
     *
     * @param  mixed $request
     * @return void
     */
    public function servizi_aggiuntivi(Request $request)
    {
        $select = "SELECT 
                        hospitality_tipo_servizi.*,
                        hospitality_tipo_servizi_lingua.Servizio,
                        hospitality_tipo_servizi_lingua.Descrizione
                    FROM 
                        hospitality_tipo_servizi 
                    INNER JOIN
                        hospitality_tipo_servizi_lingua ON hospitality_tipo_servizi_lingua.servizio_id = hospitality_tipo_servizi.id
                    AND 
                        hospitality_tipo_servizi_lingua.idsito = hospitality_tipo_servizi.idsito
                    WHERE 
                        hospitality_tipo_servizi.idsito = :idsito
                    AND 
                        hospitality_tipo_servizi_lingua.lingue = :Lingua
                    AND 
                        hospitality_tipo_servizi.Abilitato = :Abilitato
                    ORDER BY 
                        hospitality_tipo_servizi.Ordine ASC";
        $result = DB::select($select,['idsito' => $request->idsito,'Lingua' => $request->lingua,'Abilitato' => 1]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API servizi_aggiuntivi() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Servizi aggiuntivi non trovati!']);
        }  
                  
    }

    
    /**
     * lista_sconti
     *
     * @return void
     */
    public function lista_sconti()
    {
        $result = [
                    ['value' => 1, 'sconto' => '1%'],
                    ['value' => 2, 'sconto' => '2%'],
                    ['value' => 3, 'sconto' => '3%'],
                    ['value' => 4, 'sconto' => '4%'],
                    ['value' => 5, 'sconto' => '5%'],
                    ['value' => 6, 'sconto' => '6%'],
                    ['value' => 7, 'sconto' => '7%'],
                    ['value' => 8, 'sconto' => '8%'],
                    ['value' => 9, 'sconto' => '9%'],
                    ['value' => 10, 'sconto' => '10%'],
                    ['value' => 11, 'sconto' => '11%'],
                    ['value' => 12, 'sconto' => '12%'],
                    ['value' => 13, 'sconto' => '13%'],
                    ['value' => 14, 'sconto' => '14%'],
                    ['value' => 15, 'sconto' => '15%'],
                    ['value' => 16, 'sconto' => '16%'],
                    ['value' => 17, 'sconto' => '17%'],
                    ['value' => 18, 'sconto' => '18%'],
                    ['value' => 19, 'sconto' => '19%'],
                    ['value' => 20, 'sconto' => '20%'],
                    ['value' => 21, 'sconto' => '21%'],
                    ['value' => 22, 'sconto' => '22%'],
                    ['value' => 23, 'sconto' => '23%'],
                    ['value' => 24, 'sconto' => '24%'],
                    ['value' => 25, 'sconto' => '25%'],
                    ['value' => 30, 'sconto' => '30%'],
                    ['value' => 35, 'sconto' => '35%'],
                    ['value' => 40, 'sconto' => '40%'],
                    ['value' => 45, 'sconto' => '45%'],
                    ['value' => 50, 'sconto' => '50%'],
                    ['value' => 100, 'sconto' => '100%'],
                ];
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API lista_sconti() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message); 
            return response()->json($result); 
        }else{
            return response()->json(['error' => 'Lista sconti non trovati!']);
        }
        
    }
    
    /**
     * lista_caparra
     *
     * @param  mixed $request
     * @return void
     */
    public function lista_caparra(Request $request)
    {
        $select = "SELECT * FROM hospitality_acconto_pagamenti WHERE idsito = :idsito";
        $res = DB::select($select,['idsito' => $request->idsito]);
        if(sizeof($res)>0){
            $rec = $res[0];
            $caparra_default = $rec->Acconto;
        }

        $result = [
                    ['value' => 'importo', 'caparra' => 'Importo'],
                    ['value' => 'garanzia', 'caparra' => 'Carta Credito a garanzia'],
                    ['value' => 10, 'caparra' => '10%', 'default' => ($caparra_default==10?1:0)],
                    ['value' => 15, 'caparra' => '15%', 'default' => ($caparra_default==15?1:0)],
                    ['value' => 20, 'caparra' => '20%', 'default' => ($caparra_default==20?1:0)],
                    ['value' => 25, 'caparra' => '25%', 'default' => ($caparra_default==25?1:0)],
                    ['value' => 30, 'caparra' => '30%', 'default' => ($caparra_default==30?1:0)],
                    ['value' => 40, 'caparra' => '40%', 'default' => ($caparra_default==40?1:0)],
                    ['value' => 50, 'caparra' => '50%', 'default' => ($caparra_default==50?1:0)],
                    ['value' => 60, 'caparra' => '60%', 'default' => ($caparra_default==60?1:0)],
                    ['value' => 70, 'caparra' => '70%', 'default' => ($caparra_default==70?1:0)],
                    ['value' => 80, 'caparra' => '80%', 'default' => ($caparra_default==80?1:0)],
                    ['value' => 90, 'caparra' => '90%', 'default' => ($caparra_default==90?1:0)],
                    ['value' => 100, 'caparra' => '100%', 'default' => ($caparra_default==100?1:0)],
                ];
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API lista_caparra() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Lista caparre non trovati!']);
        }
          
    }

    
    /**
     * tipologia_tariffe
     *
     * @param  mixed $request
     * @return void
     */
    public function tipologia_tariffe(Request $request)
    {
        $select = "SELECT
                        hospitality_condizioni_tariffe.etichetta, 
                        hospitality_condizioni_tariffe_lingua.* 
                    FROM 
                        hospitality_condizioni_tariffe_lingua
                    INNER JOIN
                        hospitality_condizioni_tariffe 
                            ON hospitality_condizioni_tariffe.id = hospitality_condizioni_tariffe_lingua.id_tariffe 
                    WHERE 
                        hospitality_condizioni_tariffe_lingua.Lingua = :lingua 
                    AND 
                        hospitality_condizioni_tariffe.idsito = :idsito 
                    ORDER BY 
                        hospitality_condizioni_tariffe_lingua.tariffa ASC";
        $result = DB::select($select,['idsito' => $request->idsito,'lingua' => $request->lingua]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API tipologia_tariffe() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Lista condizioni tariffarie non trovati!']);
        }
         
    }
    
    /**
     * fonte_provenienza
     *
     * @return void
     */
    public function fonte_provenienza()
    {
        $result =   [
                        ['value' => 'Sito Web', 'etichetta' => 'Sito Web'],
                    ];
                    
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API fonte_provenienza() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result); 
        }else{
            return response()->json(['error' => 'Lista condizioni tariffarie non trovati!']);
        }
    
    }
    
    /**
     * lista_info_box
     *
     * @param  mixed $request
     * @return void
     */
    public function lista_info_box(Request $request)
    {
        $select = "SELECT * FROM hospitality_info_box WHERE idsito = :idsito AND Abilitato = :Abilitato";
        $result = DB::select($select,['idsito' => $request->idsito,'Abilitato' => 1]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API lista_info_box() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Lista Info Box non trovati!']);
        }
         
    }    
    /**
     * info_box_by_template
     *
     * @param  mixed $request
     * @return void
     */
    public function info_box_by_template(Request $request)
    {
        $select = "SELECT 
                        hospitality_info_box.*,
                        hospitality_rel_infobox_template.*
                    FROM 
                        hospitality_rel_infobox_template
                    INNER JOIN
                        hospitality_info_box ON hospitality_info_box.Id = hospitality_rel_infobox_template.id_infobox
                    WHERE 
                        hospitality_rel_infobox_template.idsito = :idsito
                    AND
                        hospitality_info_box.idsito = :idsito1
                    AND 
                        hospitality_rel_infobox_template.id_template = :id_template
                    AND 
                        hospitality_info_box.Abilitato = :Abilitato";
        $result = DB::select($select,['idsito' => $request->idsito,'idsito1' => $request->idsito,'id_template' => $request->id_template, 'Abilitato' => 1]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API info_box_by_template() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result); 
        }else{
            return response()->json(['error' => 'Info Box per template non trovati!']);
        }
        
    }
    
    /**
     * info_box_by_preventivo
     *
     * @param  mixed $request
     * @return void
     */
    public function info_box_by_preventivo(Request $request)
    {
        $select = "SELECT 
                        hospitality_info_box.*,
                        hospitality_rel_infobox_preventivo.*
                    FROM 
                        hospitality_rel_infobox_preventivo
                    INNER JOIN
                        hospitality_info_box ON hospitality_info_box.Id = hospitality_rel_infobox_preventivo.id_infobox
                    WHERE 
                        hospitality_rel_infobox_preventivo.idsito = :idsito
                    AND
                        hospitality_info_box.idsito = :idsito1
                    AND 
                        hospitality_rel_infobox_preventivo.id_richiesta = :id_richiesta
                    AND 
                        hospitality_info_box.Abilitato = :Abilitato";
        $result = DB::select($select,['idsito' => $request->idsito,'idsito1' => $request->idsito,'id_richiesta' => $request->id_richiesta, 'Abilitato' => 1]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API info_box_by_preventivo() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result); 
        }else{
            return response()->json(['error' => 'Info Box per preventivo non trovati!']);
        }
        
    }
    
    /**
     * cndizioni_generali
     *
     * @param  mixed $request
     * @return void
     */
    public function condizioni_generali(Request $request)
    {
        $select = "SELECT * FROM hospitality_politiche WHERE idsito = :idsito AND tipo = :tipo ORDER BY Id ASC";
        $result = DB::select($select,['idsito' => $request->idsito, 'tipo' => 0]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API condizioni_generali() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result); 
        }else{
            return response()->json(['error' => 'Condizioni generali non trovati!']);
        }
        
    }
    
    /**
     * tipo_pagamenti
     *
     * @param  mixed $request
     * @return void
     */
    public function tipo_pagamenti(Request $request)
    {
        $select = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito = :idsito AND Abilitato = :Abilitato ORDER BY Ordine ASC";
        $result = DB::select($select,['idsito' => $request->idsito, 'Abilitato' => 1]);
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API tipo_pagamenti() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Tipologia pagamenti non trovati!']);
        }
         
    }

    public function lista_preventivi(Request $request)
    {
        $select = "SELECT g.* 
                    FROM hospitality_guest as g
                    WHERE g.idsito = :idsito 
                    AND g.TipoRichiesta = :TipoRichiesta 
                    AND g.FontePrenotazione = :FontePrenotazione 
                    AND g.Hidden = :Hidden 
                    AND g.Archivia = :Archivia 
                    AND g.Chiuso = :Chiuso
                    AND g.Accettato = :Accettato 
                    AND g.NoDisponibilita = :NoDisponibilita
                    ORDER BY
                        g.NumeroPrenotazione DESC, g.DataRichiesta DESC";
        $result = DB::select($select,[
                                    'idsito'            => $request->idsito, 
                                    'TipoRichiesta'     => 'Preventivo',
                                    'FontePrenotazione' => 'Sito Web',
                                    'Hidden'            => 0,
                                    'Archivia'          => 0,
                                    'Chiuso'            => 0,
                                    'Accettato'         => 0,
                                    'NoDisponibilita'   => 0,
                                    ]
                                );
        if(sizeof($result)>0){
            $message = date('d-m-Y H:i:s').' -> API lista_preventivi() -> Esito: success; response dati richiesti andata a buon fine!';
            Log::info($message);
            return response()->json($result); 
        }else{
            return response()->json(['error' => 'Lista preventivi non trovati!']);
        }
        
    }



    
    /**
     * compila_preventivo_libero
     *
     * @param  mixed $request
     * @return void
     */
    public function compila_preventivo_libero(Request $request)
    {

            // controllo se è gia stata riempita la tabella rel_pagamenti
            $selP = "SELECT * FROM hospitality_rel_pagamenti_preventivi WHERE idsito = ".$request->idsito." AND id_richiesta = ".$request->Id;
            $resP = DB::select($selP);
            $totP = sizeof($resP);
            if($totP > 0){
                $up_template = "UPDATE hospitality_rel_pagamenti_preventivi SET CC = '".($request->CC==''?0:$request->CC)."', BB = '".($request->BB==''?0:$request->BB)."', VP = '".($request->VP==''?0:$request->VP)."', PP = '".($request->PP==''?0:$request->PP)."', GB = '".($request->GB==''?0:$request->GB)."', GBVP = '".($request->GBVP==''?0:$request->GBVP)."', GBS = '".($request->GBS==''?0:$request->GBS)."', linkStripe = '".$request->linkStripe."', GBNX = '".($request->GBNX==''?0:$request->GBNX)."' WHERE idsito = '".$request->idsito."' AND id_richiesta = '".$request->Id."'";
                DB::select($up_template);
            }else{
                $ins_pag = "INSERT INTO hospitality_rel_pagamenti_preventivi(idsito,id_richiesta,CC,BB,VP,PP,GB,GBVP,GBS,linkStripe,GBNX) VALUES ('".$request->idsito."','".$request->Id."','".($request->CC==''?0:$request->CC)."','".($request->BB==''?0:$request->BB)."','".($request->VP==''?0:$request->VP)."','".($request->PP==''?0:$request->PP)."','".($request->GB==''?0:$request->GB)."','".($request->GBVP==''?0:$request->GBVP)."','".($request->GBS==''?0:$request->GBS)."','".$request->linkStripe."','".($request->GBNX==''?0:$request->GBNX)."')";
                DB::select($ins_pag);
            }

            // controllo se è gia stata riempita la tabella (questo per i QUOTO senza gestione template)
            $selT = "SELECT * FROM hospitality_template_link_landing WHERE idsito = ".$request->idsito." AND id_richiesta = ".$request->Id;
            $resT = DB::select($selT);
            $totT = sizeof($resT);
            if($totT > 0){
                $up_template = "UPDATE hospitality_template_link_landing SET id_template = '".$request->id_template."' WHERE idsito = '".$request->idsito."' AND id_richiesta = '".$request->Id."'";
                DB::select($up_template);
            }else{
                $in_template = "INSERT INTO hospitality_template_link_landing(id_richiesta,id_template,idsito) VALUES ('".$request->Id."','".$request->id_template."','".$request->idsito."')";
                DB::select($in_template);
            }

            $sel          = "SELECT * FROM hospitality_guest WHERE Id = :Id AND idsito = :idsito";
            $res          = DB::select($sel,['Id' => $request->Id,'idsito' => $request->idsito]);
            $record       = $res[0];
            $DataArrivo   = $record->DataArrivo;
            $DataPartenza = $record->DataPartenza;
            $Lingua       = $record->Lingua;

            if($request->Lingua!= ''){
                $Lingua = $request->Lingua;
            }else{
                $Lingua = $Lingua;
            }
            // query di modifica
            $update = "UPDATE hospitality_guest SET 
                                                ChiPrenota             = '".addslashes($request->ChiPrenota)."',
                                                EmailSegretaria        = '".$request->EmailSegretaria."',
                                                TipoVacanza            = '".$request->TipoVacanza."',
                                                idsito                 = '".$request->idsito."',
                                                id_politiche           = '".$request->id_politiche."',
                                                id_template            = '".$request->id_template."',
                                                Lingua                 = '".$Lingua."',
                                                DataScadenza           = '".$request->DataScadenza."',
                                                AbilitaInvio           = 1,
                                                InvioAutomatico        = 1
                                                WHERE Id               = ".$request->Id;
            DB::select($update);
                
                 if($request->PrezzoP1!=''){

                    if($request->DataArrivo1 != ''){
                        $DataArrivo1 = $request->DataArrivo1;
                    }else{
                        $DataArrivo1 = $DataArrivo;
                    }
                    if($request->DataPartenza1 != ''){
                        $DataPartenza1 = $request->DataPartenza1;
                    }else{
                        $DataPartenza1 = $DataPartenza;
                    }

                    $insertP1 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                        Arrivo,
                                                        Partenza,
                                                        NomeProposta,
                                                        TestoProposta,
                                                        CheckProposta,
                                                        PrezzoL,
                                                        PrezzoP,
                                                        AccontoPercentuale,
                                                        AccontoImporto,
                                                        AccontoTariffa,
                                                        AccontoTesto
                                                        ) VALUES (
                                                        '".$request->Id."',
                                                        '".$DataArrivo1."',
                                                        '".$DataPartenza1."',
                                                        '".addslashes($request->NomeProposta1)."',
                                                        '".addslashes($request->TestoProposta1)."',
                                                        '0',
                                                        '0',
                                                        '".$request->PrezzoP1."',
                                                        '".$request->AccontoPercentuale1."',
                                                        '".$request->AccontoImporto1."',
                                                        '".addslashes($request->EtichettaTariffa1)."',
                                                        '".addslashes($request->AccontoTesto1)."')";
                    DB::select($insertP1);
                    $IdProposta = DB::getPdo()->lastInsertId();

                        $n_camere = count($request->TipoCamere1);
                        for($i=0; $i<=($n_camere-1); $i++){
                            DB::select("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                id_proposta,
                                                                TipoSoggiorno,
                                                                NumeroCamere,
                                                                TipoCamere,
                                                                NumAdulti,
                                                                NumBambini,
                                                                EtaB,
                                                                Prezzo
                                                                ) VALUES (
                                                                '".$request->Id."',
                                                                '".$IdProposta."',
                                                                '".$request->TipoSoggiorno1[$i]."',
                                                                '1',
                                                                '".$request->TipoCamere1[$i]."',
                                                                '".$request->NumAdulti1[$i]."',
                                                                '".$request->NumBambini1[$i]."',
                                                                '".$request->EtaB1[$i]."',
                                                                '".$request->Prezzo1[$i]."')");
                        } 

                    if($request->VisibileServizio1 != '' && $IdProposta != '') {   
                        foreach($request->VisibileServizio1 as $key => $value){
                            DB::select("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta."','".$key."','".$value."')");
                        }
                    }
                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE  
                    DB::select("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta."','".$request->SC1."')");    
        
                } 


                if($request->PrezzoP2!=''){

                    if($request->DataArrivo2 != ''){
                        $DataArrivo2 = $request->DataArrivo2;
                    }else{
                        $DataArrivo2 = $DataArrivo;
                    }
                    if($request->DataPartenza2 != ''){
                        $DataPartenza2 = $request->DataPartenza2;
                    }else{
                        $DataPartenza2 = $DataPartenza;
                    }


                    $insertP2 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                Arrivo,
                                                                Partenza,
                                                                NomeProposta,
                                                                TestoProposta,
                                                                CheckProposta,
                                                                PrezzoL,
                                                                PrezzoP,
                                                                AccontoPercentuale,
                                                                AccontoImporto,
                                                                AccontoTariffa,
                                                                AccontoTesto
                                                                ) VALUES (
                                                                '".$request->Id."',
                                                                '".$DataArrivo2."',
                                                                '".$DataPartenza2."',
                                                                '".addslashes($request->NomeProposta2)."',
                                                                '".addslashes($request->TestoProposta2)."',
                                                                '0',
                                                                '0',
                                                                '".$request->PrezzoP2."',
                                                                '".$request->AccontoPercentuale2."',
                                                                '".$request->AccontoImporto2."',
                                                                '".addslashes($request->EtichettaTariffa2)."',
                                                                '".addslashes($request->AccontoTesto2)."')";
                    DB::select($insertP2);
                    $IdProposta2 = DB::getPdo()->lastInsertId();

                        $n_camere2 = count($request->TipoCamere2);
                        for($i=0; $i<=($n_camere2-1); $i++){
                            DB::select("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                id_proposta,
                                                                TipoSoggiorno,
                                                                NumeroCamere,
                                                                TipoCamere,
                                                                NumAdulti,
                                                                NumBambini,
                                                                EtaB,
                                                                Prezzo
                                                                ) VALUES (
                                                                '".$request->Id."',
                                                                '".$IdProposta2."',
                                                                '".$request->TipoSoggiorno2[$i]."',
                                                                '1',
                                                                '".$request->TipoCamere2[$i]."',
                                                                '".$request->NumAdulti2[$i]."',
                                                                '".$request->NumBambini2[$i]."',
                                                                '".$request->EtaB2[$i]."',
                                                                '".$request->Prezzo2[$i]."')");
                    }

                    if($request->VisibileServizio2 != '' && $IdProposta2 != '') { 
                        foreach($request->VisibileServizio2 as $key2 => $value2){
                            DB::select("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta2."','".$key2."','".$value2."')");
                        }
                    }
                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    DB::select("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta2."','".$request->SC2."')");  
                }


                if($request->PrezzoP3!=''){

                    if($request->DataArrivo3 != ''){
                        $DataArrivo3 = $request->DataArrivo3;
                    }else{
                        $DataArrivo3 = $DataArrivo;
                    }
                    if($request->DataPartenza3 != ''){
                        $DataPartenza3 = $request->DataPartenza3;
                    }else{
                        $DataPartenza3 = $DataPartenza;
                    }

                    $insertP3 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                Arrivo,
                                                                Partenza,
                                                                NomeProposta,
                                                                TestoProposta,
                                                                CheckProposta,
                                                                PrezzoL,
                                                                PrezzoP,
                                                                AccontoPercentuale,
                                                                AccontoImporto,
                                                                AccontoTariffa,
                                                                AccontoTesto
                                                                ) VALUES (
                                                                '".$request->Id."',
                                                                '".$DataArrivo3."',
                                                                '".$DataPartenza3."',
                                                                '".addslashes($request->NomeProposta3)."',
                                                                '".addslashes($request->TestoProposta3)."',
                                                                '0',
                                                                '0',
                                                                '".$request->PrezzoP3."',
                                                                '".$request->AccontoPercentuale3."',
                                                                '".$request->AccontoImporto3."',
                                                                '".addslashes($request->EtichettaTariffa3)."',
                                                                '".addslashes($request->AccontoTesto3)."')";

                    DB::select($insertP3);
                    $IdProposta3 = DB::getPdo()->lastInsertId();

                        $n_camere3 = count($request->TipoCamere3);
                        for($i=0; $i<=($n_camere3-1); $i++){
                            DB::select("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                id_proposta,
                                                                TipoSoggiorno,
                                                                NumeroCamere,
                                                                TipoCamere,
                                                                NumAdulti,
                                                                NumBambini,
                                                                EtaB,
                                                                Prezzo
                                                                ) VALUES (
                                                                '".$request->Id."',
                                                                '".$IdProposta3."',
                                                                '".$request->TipoSoggiorno3[$i]."',
                                                                '1',
                                                                '".$request->TipoCamere3[$i]."',
                                                                '".$request->NumAdulti3[$i]."',
                                                                '".$request->NumBambini3[$i]."',
                                                                '".$request->EtaB3[$i]."',
                                                                '".$request->Prezzo3[$i]."')");
                        }
                        
                        if($request->VisibileServizio3 != '' && $IdProposta3 != '') {
                            foreach($request->VisibileServizio3 as $key3 => $value3){
                                DB::select("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta3."','".$key3."','".$value3."')");
                            }
                        }
                 ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    DB::select("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta3."','".$request->SC3."')");  

                }

                
                if($request->PrezzoP4!=''){

                    if($request->DataArrivo4 != ''){
                        $DataArrivo4 = $request->DataArrivo4;
                    }else{
                        $DataArrivo4 = $DataArrivo;
                    }
                    if($request->DataPartenza4 != ''){
                        $DataPartenza4 = $request->DataPartenza4;
                    }else{
                        $DataPartenza4 = $DataPartenza;
                    }


                        $insertP4 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                Arrivo,
                                                                Partenza,
                                                                NomeProposta,
                                                                TestoProposta,
                                                                CheckProposta,
                                                                PrezzoL,
                                                                PrezzoP,
                                                                AccontoPercentuale,
                                                                AccontoImporto,
                                                                AccontoTariffa,
                                                                AccontoTesto
                                                                ) VALUES (
                                                                '".$request->Id."',
                                                                '".$DataArrivo4."',
                                                                '".$DataPartenza4."',
                                                                '".addslashes($request->NomeProposta4)."',
                                                                '".addslashes($request->TestoProposta4)."',
                                                                '0',
                                                                '0',
                                                                '".$request->PrezzoP4."',
                                                                '".$request->AccontoPercentuale4."',
                                                                '".$request->AccontoImporto4."',
                                                                '".addslashes($request->EtichettaTariffa4)."',
                                                                '".addslashes($request->AccontoTesto4)."')";

                DB::select($insertP4);
                $IdProposta4 = DB::getPdo()->lastInsertId();

                        $n_camere4 = count($request->TipoCamere4);
                        for($i=0; $i<=($n_camere4-1); $i++){
                            DB::select("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                id_proposta,
                                                                TipoSoggiorno,
                                                                NumeroCamere,
                                                                TipoCamere,
                                                                NumAdulti,
                                                                NumBambini,
                                                                EtaB,
                                                                Prezzo
                                                                ) VALUES (
                                                                '".$request->Id."',
                                                                '".$IdProposta4."',
                                                                '".$request->TipoSoggiorno4[$i]."',
                                                                '1',
                                                                '".$request->TipoCamere4[$i]."',
                                                                '".$request->NumAdulti4[$i]."',
                                                                '".$request->NumBambini4[$i]."',
                                                                '".$request->EtaB4[$i]."',
                                                                '".$request->Prezzo4[$i]."')");
                        }

                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    DB::select("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta4."','".$request->SC4."')");  


                if($request->VisibileServizio4 != '' && $IdProposta4 != '') {
                    foreach($request->VisibileServizio4 as $key4 => $value4){
                        DB::select("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta4."','".$key4."','".$value4."')");
                    }
                } 
            }

                if($request->PrezzoP5!=''){

                    if($request->DataArrivo5 != ''){
                        $DataArrivo5 = $request->DataArrivo5;
                    }else{
                        $DataArrivo5 = $DataArrivo;
                    }
                    if($request->DataPartenza5 != ''){
                        $DataPartenza5 = $request->DataPartenza5;
                    }else{
                        $DataPartenza5 = $DataPartenza;
                    }


                    $insertP5 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                Arrivo,
                                                                Partenza,
                                                                NomeProposta,
                                                                TestoProposta,
                                                                CheckProposta,
                                                                PrezzoL,
                                                                PrezzoP,
                                                                AccontoPercentuale,
                                                                AccontoImporto,
                                                                AccontoTariffa,
                                                                AccontoTesto
                                                                ) VALUES (
                                                                '".$request->Id."',
                                                                '".$DataArrivo5."',
                                                                '".$DataPartenza5."',
                                                                '".addslashes($request->NomeProposta5)."',
                                                                '".addslashes($request->TestoProposta5)."',
                                                                '0',
                                                                '0',
                                                                '".$request->PrezzoP5."',
                                                                '".$request->AccontoPercentuale5."',
                                                                '".$request->AccontoImporto5."',
                                                                '".addslashes($request->EtichettaTariffa5)."',
                                                                '".addslashes($request->AccontoTesto5)."')";
                DB::select($insertP5);
                $IdProposta5 = DB::getPdo()->lastInsertId();

                        $n_camere5 = count($request->TipoCamere5);
                        for($h=0; $h<=($n_camere5-1); $h++){
                            DB::select("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                id_proposta,
                                                                TipoSoggiorno,
                                                                NumeroCamere,
                                                                TipoCamere,
                                                                NumAdulti,
                                                                NumBambini,
                                                                EtaB,
                                                                Prezzo
                                                                ) VALUES (
                                                                '".$request->Id."',
                                                                '".$IdProposta5."',
                                                                '".$request->TipoSoggiorno5[$h]."',
                                                                '1',
                                                                '".$request->TipoCamere5[$h]."',
                                                                '".$request->NumAdulti5[$h]."',
                                                                '".$request->NumBambini5[$h]."',
                                                                '".$request->EtaB5[$h]."',
                                                                '".$request->Prezzo5[$h]."')");
                        }

                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    DB::select("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta5."','".$request->SC5."')");  
     
            
                if($request->VisibileServizio5 != '' && $IdProposta5 != '') {
                    foreach($request->VisibileServizio5 as $key5 => $value5){
                        DB::select("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta5."','".$key5."','".$value5."')");
                    }
                } 
            }

            ## relazione per inserire info box visibili nel template
            if(!is_null($request->id_infobox) && !empty($request->id_infobox)) {
                DB::select("DELETE FROM hospitality_rel_infobox_preventivo WHERE idsito = ".$request->idsito." AND id_richiesta = ".$request->Id);
                foreach($request->id_infobox as $key => $value){
                    DB::select("INSERT INTO hospitality_rel_infobox_preventivo(idsito,id_richiesta,id_infobox) VALUES('".$request->idsito."','".$request->Id."','".$value."')");
                }
            }


            Log::info(date('d-m-Y H:i:s').' -> API compila_preventivo() -> Esito: success; compilato il preventivo {Id} per il QUOTO di {idsito}!',['Id' => $request->Id,'idsito' => $request->idsito]);

    }

    
    /**
     * get_configurazioneAI
     *
     * @param  mixed $idsito
     * @return void
     */
    public function get_configurazioniAI($idsito)
    {
        $select = "SELECT 
                        * 
                    FROM hospitality_configurazioniAI
                    WHERE hospitality_configurazioniAI.idsito = :idsito";
        $result = DB::select($select,['idsito' => $idsito]);
        if(sizeof($result)>0){
            return $result[0];
        }else{
            return '';
        }      
    }

        
    /**
     * get_pacchettiAI
     *
     * @param  mixed $idsito
     * @param  mixed $id_pacchetto
     * @param  mixed $lingua
     * @return void
     */
    public function get_pacchettiAI($idsito,$id_pacchetto,$lingua)
    {
        $select = "SELECT 
                        * 
                    FROM 
                        hospitality_tipo_pacchetto_lingua
                    WHERE 
                        hospitality_tipo_pacchetto_lingua.idsito = :idsito
                    AND 
                        hospitality_tipo_pacchetto_lingua.pacchetto_id = :id_pacchetto
                    AND 
                        hospitality_tipo_pacchetto_lingua.lingue = :lingua";
        $result = DB::select($select,['idsito' => $idsito,'id_pacchetto' => $id_pacchetto,'lingua' => $lingua]);
        if(sizeof($result)>0){
            return $result[0];
        }else{
            return '';
        }      
    }
        
    public function get_condizioniTariffeAI($idsito,$id_tariffa,$lingua)
    {
        $select = "SELECT 
                        * 
                    FROM 
                        hospitality_condizioni_tariffe_lingua
                    WHERE 
                        hospitality_condizioni_tariffe_lingua.idsito = :idsito
                    AND 
                        hospitality_condizioni_tariffe_lingua.id_tariffe = :id_tariffa
                    AND 
                        hospitality_condizioni_tariffe_lingua.Lingua = :lingua";
        $result = DB::select($select,['idsito' => $idsito,'id_tariffa' => $id_tariffa,'lingua' => $lingua]);
        if(sizeof($result)>0){
            return $result[0];
        }else{
            return '';
        }      
    }
    
    /**
     * get_caparraAI
     *
     * @param  mixed $idsito
     * @return void
     */
    public function get_caparraAI($idsito)
    {
        $select = "SELECT * FROM hospitality_acconto_pagamenti WHERE idsito = :idsito";
        $res = DB::select($select,['idsito' => $idsito]);
        if(sizeof($res)>0){
            $rec = $res[0];
            $caparra_default = $rec->Acconto;
        }else{
            $caparra_default = '';
        }
        return $caparra_default;
    }

    /**
     * compila_preventivo
     *
     * @param  mixed $request
     * @return void
     */
    public function compila_preventivo(Request $request)
    {
            $config = $this->get_configurazioniAI($request->idsito);
            $abilita             = $config->abilita;
            $dal                 = $config->dal;
            $al                  = $config->al;
            $ora_dal             = $config->ora_dal;
            $ora_al              = $config->ora_al;
            $ripetizione         = $config->ripetizione;
            $operatore           = $config->operatore;
            $email_operatore     = $config->email_operatore;
            $target              = $config->target;
            $id_template         = $config->id_template;
            $id_pacchetto        = $config->id_pacchetto;
            $servizi_aggiuntivi  = $config->servizi_aggiuntivi;
            $ordine_prezzo       = $config->ordine_prezzo;
            $id_tariffe          = $config->id_tariffa;
            $id_politiche        = $config->id_politiche;
            $tipologie_pagamento = $config->tipologie_pagamento;
            $giorni_scadenza     = $config->giorni_scadenza;


            /** Controllo se il modulo è abilitato per che giorno e per che ora */
            if($abilita == 1 && date('Y-m-d H:i:s') >= $dal.' '.$ora_dal && date('Y-m-d H:i:s') <= $al.' '.$ora_al){

                /** Esplodo il campo tipologia_pagamenti e controllo se nell'array ci sono i valori per assegnare le variabili */
                $array_pagamenti = explode(",", $tipologie_pagamento);
                if(in_array('CC',$array_pagamenti)){
                    $CC = 1; 
                }else{
                    $CC = 0;
                }
                if(in_array('BB',$array_pagamenti)){
                    $BB = 1; 
                }else{
                    $BB = 0;
                }
                if(in_array('VP',$array_pagamenti)){
                    $VP = 1; 
                }else{
                    $VP = 0;
                }
                if(in_array('PP',$array_pagamenti)){
                    $PP = 1; 
                }else{
                    $PP = 0;
                }
                if(in_array('GB',$array_pagamenti)){
                    $GB = 1; 
                }else{
                    $GB = 0;
                }
                if(in_array('GBVP',$array_pagamenti)){
                    $GBVP = 1; 
                }else{
                    $GBVP = 0;
                }
                if(in_array('GBS',$array_pagamenti)){
                    $GBS = 1; 
                }else{
                    $GBS = 0;
                }
                if(in_array('GBNX',$array_pagamenti)){
                    $GBNX = 1; 
                }else{
                    $GBNX = 0;
                }
                 /** Compilo la tabella relazionale con i tipo di  pagamento per il preventivo */
                DB::table('hospitality_rel_pagamenti_preventivi')->insert([
                                                                            'idsito'       => $request->idsito,
                                                                            'id_richiesta' => $request->Id,
                                                                            'CC'           => $CC,
                                                                            'BB'           => $BB,
                                                                            'VP'           => $VP,
                                                                            'PP'           => $PP,
                                                                            'GB'           => $GB,
                                                                            'GBVP'         => $GBVP,
                                                                            'GBS'          => $GBS,
                                                                            'linkStripe'   => $request->linkStripe,
                                                                            'GBNX'         => $GBNX
                                                                        ]);
                
                 /** Compilo la tabella assegnando il template al preventivo */
                 DB::table('hospitality_template_link_landing')->insert([                                                                                
                                                                            'id_richiesta' => $request->Id,
                                                                            'id_template'  => $id_template,
                                                                            'idsito'       => $request->idsito
                                                                        ]);

                

                $sel          = "SELECT * FROM hospitality_guest WHERE Id = :Id AND idsito = :idsito";
                $res          = DB::select($sel,['Id' => $request->Id,'idsito' => $request->idsito]);
                $record       = $res[0];
                $DataRichiesta = $record->DataRichiesta;
                $DataArrivo    = $record->DataArrivo;
                $DataPartenza  = $record->DataPartenza;
                $Lingua        = $record->Lingua;

                if($request->Lingua!= ''){
                    $Lingua = $request->Lingua;
                }else{
                    $Lingua = $Lingua;
                }

                $DataR        = explode("-",$DataRichiesta);
                $n_giorni     = mktime(0,0,0,$DataR[1],($DataR[2]+$giorni_scadenza),$DataR[0]);
                $DataScadenza = date('Y-m-d',$n_giorni);
                // query di modifica
                DB::table('hospitality_guest')->where('Id','=',$request->Id)->update([                                                                                
                                                                                        'ChiPrenota'             => addslashes($operatore),
                                                                                        'EmailSegretaria'        => $email_operatore,
                                                                                        'TipoVacanza'            => $target,
                                                                                        'idsito'                 => $request->idsito,
                                                                                        'id_politiche'           => $id_politiche,
                                                                                        'id_template'            => $id_template,
                                                                                        'Lingua'                 => $Lingua,
                                                                                        'DataScadenza'           => $DataScadenza,
                                                                                        'AbilitaInvio'           => 1,
                                                                                        'InvioAutomatico'        => 1
                                                                                    ]);

                    
                    if($request->PrezzoP1!=''){

                        if($request->DataArrivo1 != ''){
                            $DataArrivo1 = $request->DataArrivo1;
                        }else{
                            $DataArrivo1 = $DataArrivo;
                        }
                        if($request->DataPartenza1 != ''){
                            $DataPartenza1 = $request->DataPartenza1;
                        }else{
                            $DataPartenza1 = $DataPartenza;
                        }
                        /** chiamata funzione per popolare pacchetti e porposte per lingua */
                        $pacchetti = $this->get_pacchettiAI($request->idsito,$id_pacchetto,$Lingua);
                        if($pacchetti != ''){
                            $NomeProposta1  = $pacchetti->Pacchetto;
                            $TestoProposta1 = $pacchetti->Descrizione;
                        }else{
                            $NomeProposta1  = '';
                            $TestoProposta1 = '';
                        }
                        /** Chimamata funzione per popolare le condizione tariffarie per lingua */
                        $tariffe = $this->get_condizioniTariffeAI($request->idsito,$id_tariffe,$Lingua);
                        if($tariffe != ''){
                            $EtichettaTariffa1 = $tariffe->tariffa;
                            $AccontoTesto1     = $tariffe->testo;
                        }else{
                            $EtichettaTariffa1 = '';
                            $AccontoTesto1     = '';
                        }            
                        /** chimata per compilare la percentuale di caparra richiesta */
                        $caparra = $this->get_caparraAI($request->idsito);

                        $insertP1 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                            Arrivo,
                                                            Partenza,
                                                            NomeProposta,
                                                            TestoProposta,
                                                            CheckProposta,
                                                            PrezzoL,
                                                            PrezzoP,
                                                            AccontoPercentuale,
                                                            AccontoImporto,
                                                            AccontoTariffa,
                                                            AccontoTesto
                                                            ) VALUES (
                                                            '".$request->Id."',
                                                            '".$DataArrivo1."',
                                                            '".$DataPartenza1."',
                                                            '".addslashes($NomeProposta1)."',
                                                            '".addslashes($TestoProposta1)."',
                                                            '0',
                                                            '0',
                                                            '".$request->PrezzoP1."',
                                                            '".$caparra."',
                                                            '0',
                                                            '".addslashes($EtichettaTariffa1)."',
                                                            '".addslashes($AccontoTesto1)."')";
                        DB::select($insertP1);
                        $IdProposta = DB::getPdo()->lastInsertId();

                            $n_camere = count($request->TipoCamere1);
                            for($i=0; $i<=($n_camere-1); $i++){
                                DB::select("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                    id_proposta,
                                                                    TipoSoggiorno,
                                                                    NumeroCamere,
                                                                    TipoCamere,
                                                                    NumAdulti,
                                                                    NumBambini,
                                                                    EtaB,
                                                                    Prezzo
                                                                    ) VALUES (
                                                                    '".$request->Id."',
                                                                    '".$IdProposta."',
                                                                    '".$request->TipoSoggiorno1[$i]."',
                                                                    '1',
                                                                    '".$request->TipoCamere1[$i]."',
                                                                    '".$request->NumAdulti1[$i]."',
                                                                    '".$request->NumBambini1[$i]."',
                                                                    '".$request->EtaB1[$i]."',
                                                                    '".$request->Prezzo1[$i]."')");
                            } 

                        $array_servizi = explode(",", $servizi_aggiuntivi);

                        if($array_servizi != '' && $IdProposta != '') {   
                            foreach($array_servizi as $key => $value){
                                DB::select("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta."','".$value."','1')");
                            }
                        }
                        ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE  
                        DB::select("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta."','".$request->SC1."')");    

                    } 


                    if($request->PrezzoP2!=''){

                        if($request->DataArrivo2 != ''){
                            $DataArrivo2 = $request->DataArrivo2;
                        }else{
                            $DataArrivo2 = $DataArrivo;
                        }
                        if($request->DataPartenza2 != ''){
                            $DataPartenza2 = $request->DataPartenza2;
                        }else{
                            $DataPartenza2 = $DataPartenza;
                        }

                        /** chiamata funzione per popolare pacchetti e porposte per lingua */
                        $pacchetti2 = $this->get_pacchettiAI($request->idsito,$id_pacchetto,$Lingua);
                        if($pacchetti2 != ''){
                            $NomeProposta2  = $pacchetti2->Pacchetto;
                            $TestoProposta2 = $pacchetti2->Descrizione;
                        }else{
                            $NomeProposta2  = '';
                            $TestoProposta2 = '';
                        }
                        /** Chimamata funzione per popolare le condizione tariffarie per lingua */
                        $tariffe2 = $this->get_condizioniTariffeAI($request->idsito,$id_tariffe,$Lingua);
                        if($tariffe2 != ''){
                            $EtichettaTariffa2 = $tariffe2->tariffa;
                            $AccontoTesto2     = $tariffe2->testo;
                        }else{
                            $EtichettaTariffa2 = '';
                            $AccontoTesto2     = '';
                        }            
                        /** chimata per compilare la percentuale di caparra richiesta */
                        $caparra2 = $this->get_caparraAI($request->idsito);

                        $insertP2 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                    Arrivo,
                                                                    Partenza,
                                                                    NomeProposta,
                                                                    TestoProposta,
                                                                    CheckProposta,
                                                                    PrezzoL,
                                                                    PrezzoP,
                                                                    AccontoPercentuale,
                                                                    AccontoImporto,
                                                                    AccontoTariffa,
                                                                    AccontoTesto
                                                                    ) VALUES (
                                                                    '".$request->Id."',
                                                                    '".$DataArrivo2."',
                                                                    '".$DataPartenza2."',
                                                                    '".addslashes($NomeProposta2)."',
                                                                    '".addslashes($TestoProposta2)."',
                                                                    '0',
                                                                    '0',
                                                                    '".$request->PrezzoP2."',
                                                                    '".$caparra2."',
                                                                    '0',
                                                                    '".addslashes($EtichettaTariffa2)."',
                                                                    '".addslashes($AccontoTesto2)."')";
                        DB::select($insertP2);
                        $IdProposta2 = DB::getPdo()->lastInsertId();

                            $n_camere2 = count($request->TipoCamere2);
                            for($i=0; $i<=($n_camere2-1); $i++){
                                DB::select("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                    id_proposta,
                                                                    TipoSoggiorno,
                                                                    NumeroCamere,
                                                                    TipoCamere,
                                                                    NumAdulti,
                                                                    NumBambini,
                                                                    EtaB,
                                                                    Prezzo
                                                                    ) VALUES (
                                                                    '".$request->Id."',
                                                                    '".$IdProposta2."',
                                                                    '".$request->TipoSoggiorno2[$i]."',
                                                                    '1',
                                                                    '".$request->TipoCamere2[$i]."',
                                                                    '".$request->NumAdulti2[$i]."',
                                                                    '".$request->NumBambini2[$i]."',
                                                                    '".$request->EtaB2[$i]."',
                                                                    '".$request->Prezzo2[$i]."')");
                        }

                        $array_servizi2 = explode(",", $servizi_aggiuntivi);

                        if($array_servizi2 != '' && $IdProposta2 != '') { 
                            foreach($array_servizi2 as $key2 => $value2){
                                DB::select("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta2."','".$value2."','1')");
                            }
                        }

                        ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                        DB::select("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta2."','".$request->SC2."')");  
                    
                    }


                    if($request->PrezzoP3!=''){

                        if($request->DataArrivo3 != ''){
                            $DataArrivo3 = $request->DataArrivo3;
                        }else{
                            $DataArrivo3 = $DataArrivo;
                        }
                        if($request->DataPartenza3 != ''){
                            $DataPartenza3 = $request->DataPartenza3;
                        }else{
                            $DataPartenza3 = $DataPartenza;
                        }
                        /** chiamata funzione per popolare pacchetti e porposte per lingua */
                        $pacchetti3 = $this->get_pacchettiAI($request->idsito,$id_pacchetto,$Lingua);
                        if($pacchetti3 != ''){
                            $NomeProposta3  = $pacchetti3->Pacchetto;
                            $TestoProposta3 = $pacchetti3->Descrizione;
                        }else{
                            $NomeProposta3  = '';
                            $TestoProposta3 = '';
                        }
                        /** Chimamata funzione per popolare le condizione tariffarie per lingua */
                        $tariffe3 = $this->get_condizioniTariffeAI($request->idsito,$id_tariffe,$Lingua);
                        if($tariffe3 != ''){
                            $EtichettaTariffa3 = $tariffe3->tariffa;
                            $AccontoTesto3     = $tariffe3->testo;
                        }else{
                            $EtichettaTariffa3 = '';
                            $AccontoTesto3     = '';
                        }            
                        /** chimata per compilare la percentuale di caparra richiesta */
                        $caparra3 = $this->get_caparraAI($request->idsito);

                        $insertP3 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                    Arrivo,
                                                                    Partenza,
                                                                    NomeProposta,
                                                                    TestoProposta,
                                                                    CheckProposta,
                                                                    PrezzoL,
                                                                    PrezzoP,
                                                                    AccontoPercentuale,
                                                                    AccontoImporto,
                                                                    AccontoTariffa,
                                                                    AccontoTesto
                                                                    ) VALUES (
                                                                    '".$request->Id."',
                                                                    '".$DataArrivo3."',
                                                                    '".$DataPartenza3."',
                                                                    '".addslashes($NomeProposta3)."',
                                                                    '".addslashes($TestoProposta3)."',
                                                                    '0',
                                                                    '0',
                                                                    '".$request->PrezzoP3."',
                                                                    '".$caparra3."',
                                                                    '0',
                                                                    '".addslashes($EtichettaTariffa3)."',
                                                                    '".addslashes($AccontoTesto3)."')";

                        DB::select($insertP3);
                        $IdProposta3 = DB::getPdo()->lastInsertId();

                            $n_camere3 = count($request->TipoCamere3);
                            for($i=0; $i<=($n_camere3-1); $i++){
                                DB::select("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                    id_proposta,
                                                                    TipoSoggiorno,
                                                                    NumeroCamere,
                                                                    TipoCamere,
                                                                    NumAdulti,
                                                                    NumBambini,
                                                                    EtaB,
                                                                    Prezzo
                                                                    ) VALUES (
                                                                    '".$request->Id."',
                                                                    '".$IdProposta3."',
                                                                    '".$request->TipoSoggiorno3[$i]."',
                                                                    '1',
                                                                    '".$request->TipoCamere3[$i]."',
                                                                    '".$request->NumAdulti3[$i]."',
                                                                    '".$request->NumBambini3[$i]."',
                                                                    '".$request->EtaB3[$i]."',
                                                                    '".$request->Prezzo3[$i]."')");
                            }

                            $array_servizi3 = explode(",", $servizi_aggiuntivi);

                            if($array_servizi3 != '' && $IdProposta3 != '') {
                                foreach($array_servizi3 as $key3 => $value3){
                                    DB::select("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta3."','".$value3."','1')");
                                }
                            }

                            ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                            DB::select("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta3."','".$request->SC3."')");  
                      
                    }

                    
                    if($request->PrezzoP4!=''){

                        if($request->DataArrivo4 != ''){
                            $DataArrivo4 = $request->DataArrivo4;
                        }else{
                            $DataArrivo4 = $DataArrivo;
                        }
                        if($request->DataPartenza4 != ''){
                            $DataPartenza4 = $request->DataPartenza4;
                        }else{
                            $DataPartenza4 = $DataPartenza;
                        }
                        /** chiamata funzione per popolare pacchetti e porposte per lingua */
                        $pacchetti4 = $this->get_pacchettiAI($request->idsito,$id_pacchetto,$Lingua);
                        if($pacchetti4 != ''){
                            $NomeProposta4  = $pacchetti4->Pacchetto;
                            $TestoProposta4 = $pacchetti4->Descrizione;
                        }else{
                            $NomeProposta4  = '';
                            $TestoProposta4 = '';
                        }
                        /** Chimamata funzione per popolare le condizione tariffarie per lingua */
                        $tariffe4 = $this->get_condizioniTariffeAI($request->idsito,$id_tariffe,$Lingua);
                        if($tariffe4 != ''){
                            $EtichettaTariffa4 = $tariffe4->tariffa;
                            $AccontoTesto4     = $tariffe4->testo;
                        }else{
                            $EtichettaTariffa4 = '';
                            $AccontoTesto4     = '';
                        }            
                        /** chimata per compilare la percentuale di caparra richiesta */
                        $caparra4 = $this->get_caparraAI($request->idsito);

                        $insertP4 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                Arrivo,
                                                                Partenza,
                                                                NomeProposta,
                                                                TestoProposta,
                                                                CheckProposta,
                                                                PrezzoL,
                                                                PrezzoP,
                                                                AccontoPercentuale,
                                                                AccontoImporto,
                                                                AccontoTariffa,
                                                                AccontoTesto
                                                                ) VALUES (
                                                                '".$request->Id."',
                                                                '".$DataArrivo4."',
                                                                '".$DataPartenza4."',
                                                                '".addslashes($NomeProposta4)."',
                                                                '".addslashes($TestoProposta4)."',
                                                                '0',
                                                                '0',
                                                                '".$request->PrezzoP4."',
                                                                '".$caparra4."',
                                                                '0',
                                                                '".addslashes($EtichettaTariffa4)."',
                                                                '".addslashes($AccontoTesto4)."')";

                    DB::select($insertP4);
                    $IdProposta4 = DB::getPdo()->lastInsertId();

                    $n_camere4 = count($request->TipoCamere4);
                    for($i=0; $i<=($n_camere4-1); $i++){
                        DB::select("INSERT INTO hospitality_richiesta(id_richiesta,
                                                            id_proposta,
                                                            TipoSoggiorno,
                                                            NumeroCamere,
                                                            TipoCamere,
                                                            NumAdulti,
                                                            NumBambini,
                                                            EtaB,
                                                            Prezzo
                                                            ) VALUES (
                                                            '".$request->Id."',
                                                            '".$IdProposta4."',
                                                            '".$request->TipoSoggiorno4[$i]."',
                                                            '1',
                                                            '".$request->TipoCamere4[$i]."',
                                                            '".$request->NumAdulti4[$i]."',
                                                            '".$request->NumBambini4[$i]."',
                                                            '".$request->EtaB4[$i]."',
                                                            '".$request->Prezzo4[$i]."')");
                    }

                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    DB::select("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta4."','".$request->SC4."')");  


                    $array_servizi4 = explode(",", $servizi_aggiuntivi);

                    if($array_servizi4 != '' && $IdProposta4 != '') {
                        foreach($array_servizi4 as $key4 => $value4){
                            DB::select("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta4."','".$value4."','1')");
                        }
                    } 
                }

                    if($request->PrezzoP5!=''){

                        if($request->DataArrivo5 != ''){
                            $DataArrivo5 = $request->DataArrivo5;
                        }else{
                            $DataArrivo5 = $DataArrivo;
                        }
                        if($request->DataPartenza5 != ''){
                            $DataPartenza5 = $request->DataPartenza5;
                        }else{
                            $DataPartenza5 = $DataPartenza;
                        }

                        /** chiamata funzione per popolare pacchetti e porposte per lingua */
                        $pacchetti5 = $this->get_pacchettiAI($request->idsito,$id_pacchetto,$Lingua);
                        if($pacchetti5 != ''){
                            $NomeProposta5  = $pacchetti5->Pacchetto;
                            $TestoProposta5 = $pacchetti5->Descrizione;
                        }else{
                            $NomeProposta5  = '';
                            $TestoProposta5 = '';
                        }
                        /** Chimamata funzione per popolare le condizione tariffarie per lingua */
                        $tariffe5 = $this->get_condizioniTariffeAI($request->idsito,$id_tariffe,$Lingua);
                        if($tariffe5 != ''){
                            $EtichettaTariffa5 = $tariffe5->tariffa;
                            $AccontoTesto5     = $tariffe5->testo;
                        }else{
                            $EtichettaTariffa5 = '';
                            $AccontoTesto5     = '';
                        }            
                        /** chimata per compilare la percentuale di caparra richiesta */
                        $caparra5 = $this->get_caparraAI($request->idsito);

                        $insertP5 = "INSERT INTO hospitality_proposte(id_richiesta,
                                                                    Arrivo,
                                                                    Partenza,
                                                                    NomeProposta,
                                                                    TestoProposta,
                                                                    CheckProposta,
                                                                    PrezzoL,
                                                                    PrezzoP,
                                                                    AccontoPercentuale,
                                                                    AccontoImporto,
                                                                    AccontoTariffa,
                                                                    AccontoTesto
                                                                    ) VALUES (
                                                                    '".$request->Id."',
                                                                    '".$DataArrivo5."',
                                                                    '".$DataPartenza5."',
                                                                    '".addslashes($NomeProposta5)."',
                                                                    '".addslashes($TestoProposta5)."',
                                                                    '0',
                                                                    '0',
                                                                    '".$request->PrezzoP5."',
                                                                    '".$caparra5."',
                                                                    '0',
                                                                    '".addslashes($EtichettaTariffa5)."',
                                                                    '".addslashes($AccontoTesto5)."')";
                    DB::select($insertP5);
                    $IdProposta5 = DB::getPdo()->lastInsertId();

                        $n_camere5 = count($request->TipoCamere5);
                        for($h=0; $h<=($n_camere5-1); $h++){
                            DB::select("INSERT INTO hospitality_richiesta(id_richiesta,
                                                                id_proposta,
                                                                TipoSoggiorno,
                                                                NumeroCamere,
                                                                TipoCamere,
                                                                NumAdulti,
                                                                NumBambini,
                                                                EtaB,
                                                                Prezzo
                                                                ) VALUES (
                                                                '".$request->Id."',
                                                                '".$IdProposta5."',
                                                                '".$request->TipoSoggiorno5[$h]."',
                                                                '1',
                                                                '".$request->TipoCamere5[$h]."',
                                                                '".$request->NumAdulti5[$h]."',
                                                                '".$request->NumBambini5[$h]."',
                                                                '".$request->EtaB5[$h]."',
                                                                '".$request->Prezzo5[$h]."')");
                        }

                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    DB::select("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta5."','".$request->SC5."')");  


                    $array_servizi5 = explode(",", $servizi_aggiuntivi);

                    if($array_servizi5 != '' && $IdProposta5 != '') {
                        foreach($array_servizi5 as $key5 => $value5){
                            DB::select("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".$request->idsito."','".$request->Id."','".$IdProposta5."','".$value5."','1')");
                        }
                    } 
                }

                ## relazione per inserire info box visibili nel template
                if(!is_null($request->id_infobox) && !empty($request->id_infobox)) {
                    DB::select("DELETE FROM hospitality_rel_infobox_preventivo WHERE idsito = ".$request->idsito." AND id_richiesta = ".$request->Id);
                    foreach($request->id_infobox as $key => $value){
                        DB::select("INSERT INTO hospitality_rel_infobox_preventivo(idsito,id_richiesta,id_infobox) VALUES('".$request->idsito."','".$request->Id."','".$value."')");
                    }
                }


                Log::info(date('d-m-Y H:i:s').' -> API compila_preventivo() -> Esito: success; compilato il preventivo {Id} per il QUOTO di {idsito}!',['Id' => $request->Id,'idsito' => $request->idsito]);

            }else{

                Log::info(date('d-m-Y H:i:s').' -> API compila_preventivo() -> Esito: error; la compilazione dei preventivi per il QUOTO di {idsito}, NON è ATTIVO!',['idsito' => $request->idsito]);
            }


    }













    
}
