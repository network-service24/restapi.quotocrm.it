<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DateTime;

class ApiController extends Controller
{    
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
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Template NON impostato nel preventivo, oppure non trovato!']);
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
            return response()->json($result);
        }else{
            return response()->json(['error' => 'Lista preventivi non trovati!']);
        }

    }




    public function compila_preventivo(Request $request)
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


            // query di modifica
            $update = "UPDATE hospitality_guest SET 
                                                ChiPrenota             = '".addslashes($request->ChiPrenota)."',
                                                EmailSegretaria        = '".$request->EmailSegretaria."',
                                                TipoVacanza            = '".$request->TipoVacanza."',
                                                idsito                 = '".$request->idsito."',
                                                id_politiche           = '".$request->id_politiche."',
                                                id_template            = '".$request->id_template."',
                                                Lingua                 = '".$request->Lingua."',
                                                DataScadenza           = '".$request->DataScadenza."',
                                                AbilitaInvio           = 1,
                                                InvioAutomatico        = 1
                                                WHERE Id               = ".$request->Id;
            DB::select($update);
                
                 if($request->PrezzoP1!=''){

                    $DataArrivo1         = $request->DataArrivo1;
                    $DataPartenza1       = $request->DataPartenza1;

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


                    $DataArrivo2         = $request->DataArrivo2;
                    $DataPartenza2       = $request->DataPartenza2;

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

                    $DataArrivo3         = $request->DataArrivo3;
                    $DataPartenza3       = $request->DataPartenza3;

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


                        $DataArrivo4         = $request->DataArrivo4;
                        $DataPartenza4       = $request->DataPartenza4;

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

                    $DataArrivo5         = $request->DataArrivo5;
                    $DataPartenza5       = $request->DataPartenza5;

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
        


    }



















    
}
