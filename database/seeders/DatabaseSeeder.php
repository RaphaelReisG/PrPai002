<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Administrador;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use App\Models\Pais;

use App\Models\Endereco;

use App\Models\Fornecedor;
use App\Models\Vendedor;
use App\Models\Cliente;
use App\Models\Tipo_produto;
use App\Models\Tipo_movimentacao;
use App\Models\MetodoPagamento;
use App\Models\Produto;
use App\Models\Pedido;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        $pais_brasil = Pais::create(['name_country' => 'Brasil']);
        $pais_usa = Pais::create(['name_country' => 'Estados Unidos']);
        $pais_fraca = Pais::create(['name_country' => 'França']);

        // GPT País
            $pais_canada = Pais::create(['name_country' => 'Canadá']);
            $pais_italia = Pais::create(['name_country' => 'Itália']);
            $pais_japao = Pais::create(['name_country' => 'Japão']);
            $pais_australia = Pais::create(['name_country' => 'Austrália']);
            $pais_alemanha = Pais::create(['name_country' => 'Alemanha']);
        //---

        $estado_saopaulo = $pais_brasil->estados()->create(['name_state' => 'São Paulo']);
        $estado_parana = $pais_brasil->estados()->create(['name_state' => 'Paraná']);
        $estado_riodejaneiro = $pais_brasil->estados()->create(['name_state' => 'Rio de Janeiro']);
        $estado_florida = $pais_usa->estados()->create(['name_state' => 'Florida']);

        //GPT Estado
            // Estados para o Brasil
            $estado_amazonas = $pais_brasil->estados()->create(['name_state' => 'Amazonas']);
            $estado_bahia = $pais_brasil->estados()->create(['name_state' => 'Bahia']);
            $estado_ceara = $pais_brasil->estados()->create(['name_state' => 'Ceará']);

            // Estados para os Estados Unidos
            $estado_california = $pais_usa->estados()->create(['name_state' => 'Califórnia']);
            $estado_texas = $pais_usa->estados()->create(['name_state' => 'Texas']);
            $estado_ny = $pais_usa->estados()->create(['name_state' => 'Nova Iorque']);

            // Estados para o Canadá
            $estado_ontario = $pais_canada->estados()->create(['name_state' => 'Ontário']);
            $estado_quebec = $pais_canada->estados()->create(['name_state' => 'Quebec']);
            $estado_alberta = $pais_canada->estados()->create(['name_state' => 'Alberta']);

            // Estados para a Itália
            $estado_lombardia = $pais_italia->estados()->create(['name_state' => 'Lombardia']);
            $estado_toscana = $pais_italia->estados()->create(['name_state' => 'Toscana']);
            $estado_sicilia = $pais_italia->estados()->create(['name_state' => 'Sicília']);

            // Estados para o Japão
            $estado_tohoku = $pais_japao->estados()->create(['name_state' => 'Tohoku']);
            $estado_kanto = $pais_japao->estados()->create(['name_state' => 'Kanto']);
            $estado_chubu = $pais_japao->estados()->create(['name_state' => 'Chubu']);
            // Estados para a Austrália
            $estado_victoria = $pais_australia->estados()->create(['name_state' => 'Victoria']);
            $estado_nsw = $pais_australia->estados()->create(['name_state' => 'Nova Gales do Sul']);
            $estado_queensland = $pais_australia->estados()->create(['name_state' => 'Queensland']);

            // Estados para a Alemanha
            $estado_baviera = $pais_alemanha->estados()->create(['name_state' => 'Baviera']);
            $estado_berlim = $pais_alemanha->estados()->create(['name_state' => 'Berlim']);
            $estado_hessen = $pais_alemanha->estados()->create(['name_state' => 'Hessen']);
        //---

        // GPT Cidade
            // Cidades para o Estado do Amazonas (Brasil)
            $cidade_manaus = $estado_amazonas->cidades()->create(['name_city' => 'Manaus']);
            $cidade_parintins = $estado_amazonas->cidades()->create(['name_city' => 'Parintins']);
            $cidade_tefe = $estado_amazonas->cidades()->create(['name_city' => 'Tefé']);

            // Cidades para o Estado da Bahia (Brasil)
            $cidade_salvador = $estado_bahia->cidades()->create(['name_city' => 'Salvador']);
            $cidade_feiradesantana = $estado_bahia->cidades()->create(['name_city' => 'Feira de Santana']);
            $cidade_vitoriaconquista = $estado_bahia->cidades()->create(['name_city' => 'Vitória da Conquista']);

            // Cidades para o Estado do Ceará (Brasil)
            $cidade_fortaleza = $estado_ceara->cidades()->create(['name_city' => 'Fortaleza']);
            $cidade_juazeirodoceara = $estado_ceara->cidades()->create(['name_city' => 'Juazeiro do Ceará']);
            $cidade_sobral = $estado_ceara->cidades()->create(['name_city' => 'Sobral']);

            // Cidades para o Estado da Califórnia (EUA)
            $cidade_losangeles = $estado_california->cidades()->create(['name_city' => 'Los Angeles']);
            $cidade_sanfrancisco = $estado_california->cidades()->create(['name_city' => 'San Francisco']);
            $cidade_san_diego = $estado_california->cidades()->create(['name_city' => 'San Diego']);

            // Cidades para o Estado do Texas (EUA)
            $cidade_houston = $estado_texas->cidades()->create(['name_city' => 'Houston']);
            $cidade_austin = $estado_texas->cidades()->create(['name_city' => 'Austin']);
            $cidade_dallas = $estado_texas->cidades()->create(['name_city' => 'Dallas']);

            // Cidades para o Estado de Nova Iorque (EUA)
            $cidade_novaiorque = $estado_ny->cidades()->create(['name_city' => 'Nova Iorque']);
            $cidade_buffalo = $estado_ny->cidades()->create(['name_city' => 'Buffalo']);
            $cidade_rochester = $estado_ny->cidades()->create(['name_city' => 'Rochester']);

            // Cidades para o Estado de Ontário (Canadá)
            $cidade_toronto = $estado_ontario->cidades()->create(['name_city' => 'Toronto']);
            $cidade_otawa = $estado_ontario->cidades()->create(['name_city' => 'Otawa']);
            $cidade_hamilton = $estado_ontario->cidades()->create(['name_city' => 'Hamilton']);

            // Cidades para o Estado de Quebec (Canadá)
            $cidade_montreal = $estado_quebec->cidades()->create(['name_city' => 'Montreal']);
            $cidade_quebec = $estado_quebec->cidades()->create(['name_city' => 'Quebec']);
            $cidade_laval = $estado_quebec->cidades()->create(['name_city' => 'Laval']);

            // Cidades para o Estado de Alberta (Canadá)
            $cidade_calgary = $estado_alberta->cidades()->create(['name_city' => 'Calgary']);
            $cidade_edmonton = $estado_alberta->cidades()->create(['name_city' => 'Edmonton']);
            $cidade_reddeer = $estado_alberta->cidades()->create(['name_city' => 'Red Deer']);

            // Cidades para o Estado da Lombardia (Itália)
            $cidade_milao = $estado_lombardia->cidades()->create(['name_city' => 'Milão']);
            $cidade_bergamom = $estado_lombardia->cidades()->create(['name_city' => 'Bérgamo']);
            $cidade_brescia = $estado_lombardia->cidades()->create(['name_city' => 'Bréscia']);

            // Cidades para o Estado da Toscana (Itália)
            $cidade_florenca = $estado_toscana->cidades()->create(['name_city' => 'Florença']);
            $cidade_pisa = $estado_toscana->cidades()->create(['name_city' => 'Pisa']);
            $cidade_arezzo = $estado_toscana->cidades()->create(['name_city' => 'Arezzo']);

            // Cidades para o Estado da Sicília (Itália)
            $cidade_palermo = $estado_sicilia->cidades()->create(['name_city' => 'Palermo']);
            $cidade_catania = $estado_sicilia->cidades()->create(['name_city' => 'Catânia']);
            $cidade_trapani = $estado_sicilia->cidades()->create(['name_city' => 'Trapani']);

            // Cidades para o Estado de Tohoku (Japão)
            $cidade_sendai = $estado_tohoku->cidades()->create(['name_city' => 'Sendai']);
            $cidade_akita = $estado_tohoku->cidades()->create(['name_city' => 'Akita']);
            $cidade_fukushima = $estado_tohoku->cidades()->create(['name_city' => 'Fukushima']);

            // Cidades para o Estado de Kanto (Japão)
            $cidade_tokyo = $estado_kanto->cidades()->create(['name_city' => 'Tóquio']);
            $cidade_yokohama = $estado_kanto->cidades()->create(['name_city' => 'Yokohama']);
            $cidade_chiba = $estado_kanto->cidades()->create(['name_city' => 'Chiba']);

            // Cidades para o Estado de Chubu (Japão)
            $cidade_nagoya = $estado_chubu->cidades()->create(['name_city' => 'Nagoya']);
            $cidade_kanazawa = $estado_chubu->cidades()->create(['name_city' => 'Kanazawa']);
            $cidade_niigata = $estado_chubu->cidades()->create(['name_city' => 'Niigata']);

            // Cidades para a Alemanha
            $cidade_munique = $estado_baviera->cidades()->create(['name_city' => 'Munique']);
            $cidade_nuremberg = $estado_baviera->cidades()->create(['name_city' => 'Nuremberg']);
            $cidade_augsburg = $estado_baviera->cidades()->create(['name_city' => 'Augsburg']);

            $cidade_berlim = $estado_berlim->cidades()->create(['name_city' => 'Berlim']);
            $cidade_potsdam = $estado_berlim->cidades()->create(['name_city' => 'Potsdam']);
            $cidade_dresden = $estado_berlim->cidades()->create(['name_city' => 'Dresden']);

            $cidade_francforte = $estado_hessen->cidades()->create(['name_city' => 'Frankfurt']);
            $cidade_wiesbaden = $estado_hessen->cidades()->create(['name_city' => 'Wiesbaden']);
            $cidade_darmstadt = $estado_hessen->cidades()->create(['name_city' => 'Darmstadt']);

            // Cidades para a Austrália
            $cidade_melbourne = $estado_victoria->cidades()->create(['name_city' => 'Melbourne']);
            $cidade_geelong = $estado_victoria->cidades()->create(['name_city' => 'Geelong']);
            $cidade_ballarat = $estado_victoria->cidades()->create(['name_city' => 'Ballarat']);

            $cidade_sydney = $estado_nsw->cidades()->create(['name_city' => 'Sydney']);
            $cidade_newcastle = $estado_nsw->cidades()->create(['name_city' => 'Newcastle']);
            $cidade_wollongong = $estado_nsw->cidades()->create(['name_city' => 'Wollongong']);

            $cidade_brisbane = $estado_queensland->cidades()->create(['name_city' => 'Brisbane']);
            $cidade_goldcoast = $estado_queensland->cidades()->create(['name_city' => 'Gold Coast']);
            $cidade_cairns = $estado_queensland->cidades()->create(['name_city' => 'Cairns']);
        //---

        //GPT Bairro

            // Bairros para Manaus, Amazonas, Brasil
            $bairro_centro_manaus = $cidade_manaus->bairros()->create(['name_neighborhood' => 'Centro']);
            $bairro_compensa = $cidade_manaus->bairros()->create(['name_neighborhood' => 'Compensa']);
            $bairro_alvorada = $cidade_manaus->bairros()->create(['name_neighborhood' => 'Alvorada']);

            // Bairros para Salvador, Bahia, Brasil
            $bairro_barra = $cidade_salvador->bairros()->create(['name_neighborhood' => 'Barra']);
            $bairro_itapua = $cidade_salvador->bairros()->create(['name_neighborhood' => 'Itapuã']);
            $bairro_pelourinho = $cidade_salvador->bairros()->create(['name_neighborhood' => 'Pelourinho']);

            // Bairros para Fortaleza, Ceará, Brasil
            $bairro_meireles = $cidade_fortaleza->bairros()->create(['name_neighborhood' => 'Meireles']);
            $bairro_iracema = $cidade_fortaleza->bairros()->create(['name_neighborhood' => 'Iracema']);
            $bairro_aldeota = $cidade_fortaleza->bairros()->create(['name_neighborhood' => 'Aldeota']);

            // Bairros para Los Angeles, Califórnia, EUA
            $bairro_hollywood = $cidade_losangeles->bairros()->create(['name_neighborhood' => 'Hollywood']);
            $bairro_downtown_la = $cidade_losangeles->bairros()->create(['name_neighborhood' => 'Downtown']);
            $bairro_santamonica = $cidade_losangeles->bairros()->create(['name_neighborhood' => 'Santa Monica']);

            // Bairros para Houston, Texas, EUA
            $bairro_downtown_houston = $cidade_houston->bairros()->create(['name_neighborhood' => 'Downtown']);
            $bairro_montrose = $cidade_houston->bairros()->create(['name_neighborhood' => 'Montrose']);
            $bairro_the_heights = $cidade_houston->bairros()->create(['name_neighborhood' => 'The Heights']);

            // Bairros para Nova Iorque, Nova Iorque, EUA
            $bairro_manhattan = $cidade_novaiorque->bairros()->create(['name_neighborhood' => 'Manhattan']);
            $bairro_brooklyn = $cidade_novaiorque->bairros()->create(['name_neighborhood' => 'Brooklyn']);
            $bairro_queens = $cidade_novaiorque->bairros()->create(['name_neighborhood' => 'Queens']);

            // Bairros para Toronto, Ontário, Canadá
            $bairro_downtown_toronto = $cidade_toronto->bairros()->create(['name_neighborhood' => 'Downtown']);
            $bairro_yorkville = $cidade_toronto->bairros()->create(['name_neighborhood' => 'Yorkville']);
            $bairro_the_annex = $cidade_toronto->bairros()->create(['name_neighborhood' => 'The Annex']);

            // Bairros para Montreal, Quebec, Canadá
            $bairro_plateau_mont_royal = $cidade_montreal->bairros()->create(['name_neighborhood' => 'Plateau Mont-Royal']);
            $bairro_old_montreal = $cidade_montreal->bairros()->create(['name_neighborhood' => 'Old Montreal']);
            $bairro_mile_end = $cidade_montreal->bairros()->create(['name_neighborhood' => 'Mile End']);

            // Bairros para Melbourne, Victoria, Austrália
            $bairro_fitzroy = $cidade_melbourne->bairros()->create(['name_neighborhood' => 'Fitzroy']);
            $bairro_st_kilda = $cidade_melbourne->bairros()->create(['name_neighborhood' => 'St Kilda']);
            $bairro_southbank = $cidade_melbourne->bairros()->create(['name_neighborhood' => 'Southbank']);

            // Bairros para Sydney, Nova Gales do Sul, Austrália
            $bairro_surry_hills = $cidade_sydney->bairros()->create(['name_neighborhood' => 'Surry Hills']);
            $bairro_bondi = $cidade_sydney->bairros()->create(['name_neighborhood' => 'Bondi Beach']);
            $bairro_newtown = $cidade_sydney->bairros()->create(['name_neighborhood' => 'Newtown']);

            // Bairros para Brisbane, Queensland, Austrália
            $bairro_west_end = $cidade_brisbane->bairros()->create(['name_neighborhood' => 'West End']);
            $bairro_fortitude_valley = $cidade_brisbane->bairros()->create(['name_neighborhood' => 'Fortitude Valley']);
            $bairro_kangaroo_point = $cidade_brisbane->bairros()->create(['name_neighborhood' => 'Kangaroo Point']);


            // Para cada cidade:

            // Bairros para Parintins, Amazonas, Brasil
            $bairro_saobenedito = $cidade_parintins->bairros()->create(['name_neighborhood' => 'São Benedito']);
            $bairro_santaclara = $cidade_parintins->bairros()->create(['name_neighborhood' => 'Santa Clara']);
            $bairro_santana = $cidade_parintins->bairros()->create(['name_neighborhood' => 'Santana']);

            // Bairros para Tefé, Amazonas, Brasil
            $bairro_centro_tefe = $cidade_tefe->bairros()->create(['name_neighborhood' => 'Centro']);
            $bairro_saojoao = $cidade_tefe->bairros()->create(['name_neighborhood' => 'São João']);
            $bairro_novatefe = $cidade_tefe->bairros()->create(['name_neighborhood' => 'Nova Tefé']);

            // Bairros para Feira de Santana, Bahia, Brasil
            $bairro_sobradinho = $cidade_feiradesantana->bairros()->create(['name_neighborhood' => 'Sobradinho']);
            $bairro_campodagomea = $cidade_feiradesantana->bairros()->create(['name_neighborhood' => 'Campo da Gomea']);
            $bairro_sim = $cidade_feiradesantana->bairros()->create(['name_neighborhood' => 'SIM']);

            // Bairros para Vitória da Conquista, Bahia, Brasil
            $bairro_patagonia = $cidade_vitoriaconquista->bairros()->create(['name_neighborhood' => 'Patagônia']);
            $bairro_ibirapuera = $cidade_vitoriaconquista->bairros()->create(['name_neighborhood' => 'Ibirapuera']);
            $bairro_candeias = $cidade_vitoriaconquista->bairros()->create(['name_neighborhood' => 'Candeias']);

            // Bairros para San Francisco, Califórnia, EUA
            $bairro_castro = $cidade_sanfrancisco->bairros()->create(['name_neighborhood' => 'Castro']);
            $bairro_haightashbury = $cidade_sanfrancisco->bairros()->create(['name_neighborhood' => 'Haight-Ashbury']);
            $bairro_soma = $cidade_sanfrancisco->bairros()->create(['name_neighborhood' => 'SoMa']);

            // Bairros para San Diego, Califórnia, EUA
            $bairro_gaslampquarter = $cidade_san_diego->bairros()->create(['name_neighborhood' => 'Gaslamp Quarter']);
            $bairro_pacificbeach = $cidade_san_diego->bairros()->create(['name_neighborhood' => 'Pacific Beach']);
            $bairro_hillcrest = $cidade_san_diego->bairros()->create(['name_neighborhood' => 'Hillcrest']);

            // Bairros para Ottawa, Ontário, Canadá
            $bairro_bywardmarket = $cidade_otawa->bairros()->create(['name_neighborhood' => 'ByWard Market']);
            $bairro_centretown = $cidade_otawa->bairros()->create(['name_neighborhood' => 'Centretown']);
            $bairro_sandyhill = $cidade_otawa->bairros()->create(['name_neighborhood' => 'Sandy Hill']);

            // Bairros para Laval, Quebec, Canadá
            $bairro_chomedey = $cidade_laval->bairros()->create(['name_neighborhood' => 'Chomedey']);
            $bairro_saintefrancoise = $cidade_laval->bairros()->create(['name_neighborhood' => 'Sainte-Françoise']);
            $bairro_vimont = $cidade_laval->bairros()->create(['name_neighborhood' => 'Vimont']);

            // Bairros para Geelong, Victoria, Austrália
            $bairro_eastgeelong = $cidade_geelong->bairros()->create(['name_neighborhood' => 'East Geelong']);
            $bairro_belmont = $cidade_geelong->bairros()->create(['name_neighborhood' => 'Belmont']);
            $bairro_waurnponds = $cidade_geelong->bairros()->create(['name_neighborhood' => 'Waurn Ponds']);

            // Bairros para Wollongong, Nova Gales do Sul, Austrália
            $bairro_northwollongong = $cidade_wollongong->bairros()->create(['name_neighborhood' => 'North Wollongong']);
            $bairro_fairymeadow = $cidade_wollongong->bairros()->create(['name_neighborhood' => 'Fairy Meadow']);
            $bairro_keiraville = $cidade_wollongong->bairros()->create(['name_neighborhood' => 'Keiraville']);

            // Bairros para Cairns, Queensland, Austrália
            $bairro_palmcove = $cidade_cairns->bairros()->create(['name_neighborhood' => 'Palm Cove']);
            $bairro_kewarra = $cidade_cairns->bairros()->create(['name_neighborhood' => 'Kewarra Beach']);
            $bairro_trinitybeach = $cidade_cairns->bairros()->create(['name_neighborhood' => 'Trinity Beach']);

            // Bairros para Sendai, Tohoku, Japão
            $bairro_aoba = $cidade_sendai->bairros()->create(['name_neighborhood' => 'Aoba']);
            $bairro_miyagino = $cidade_sendai->bairros()->create(['name_neighborhood' => 'Miyagino']);
            $bairro_izumi = $cidade_sendai->bairros()->create(['name_neighborhood' => 'Izumi']);

            // Bairros para Akita, Tohoku, Japão
            $bairro_nishi = $cidade_akita->bairros()->create(['name_neighborhood' => 'Nishi']);
            $bairro_kita = $cidade_akita->bairros()->create(['name_neighborhood' => 'Kita']);
            $bairro_minami = $cidade_akita->bairros()->create(['name_neighborhood' => 'Minami']);

            // Bairros para Fukushima, Tohoku, Japão
            $bairro_nakadori = $cidade_fukushima->bairros()->create(['name_neighborhood' => 'Nakadori']);
            $bairro_higashidori = $cidade_fukushima->bairros()->create(['name_neighborhood' => 'Higashidori']);
            $bairro_nishisakura = $cidade_fukushima->bairros()->create(['name_neighborhood' => 'Nishisakura']);

            // Bairros para Tóquio, Kanto, Japão
            $bairro_shinjuku = $cidade_tokyo->bairros()->create(['name_neighborhood' => 'Shinjuku']);
            $bairro_shibuya = $cidade_tokyo->bairros()->create(['name_neighborhood' => 'Shibuya']);
            $bairro_ginza = $cidade_tokyo->bairros()->create(['name_neighborhood' => 'Ginza']);

            // Bairros para Yokohama, Kanto, Japão
            $bairro_minatomirai = $cidade_yokohama->bairros()->create(['name_neighborhood' => 'Minato Mirai']);
            $bairro_kannai = $cidade_yokohama->bairros()->create(['name_neighborhood' => 'Kannai']);
            $bairro_yokohamastation = $cidade_yokohama->bairros()->create(['name_neighborhood' => 'Yokohama Station']);

            // Bairros para Chiba, Kanto, Japão
            $bairro_chuoku = $cidade_chiba->bairros()->create(['name_neighborhood' => 'Chuo']);
            $bairro_honchiba = $cidade_chiba->bairros()->create(['name_neighborhood' => 'Hon Chiba']);
            $bairro_mihama = $cidade_chiba->bairros()->create(['name_neighborhood' => 'Mihama']);

            // Bairros para Milão, Lombardia, Itália
            $bairro_brera = $cidade_milao->bairros()->create(['name_neighborhood' => 'Brera']);
            $bairro_navigli = $cidade_milao->bairros()->create(['name_neighborhood' => 'Navigli']);
            $bairro_portagenova = $cidade_milao->bairros()->create(['name_neighborhood' => 'Porta Genova']);

            // Bairros para Bérgamo, Lombardia, Itália
            $bairro_cittaalta = $cidade_bergamom->bairros()->create(['name_neighborhood' => 'Città Alta']);
            $bairro_cittabassa = $cidade_bergamom->bairros()->create(['name_neighborhood' => 'Città Bassa']);
            $bairro_colli = $cidade_bergamom->bairros()->create(['name_neighborhood' => 'Colli']);

            // Bairros para Brescia, Lombardia, Itália
            $bairro_centrostorico = $cidade_brescia->bairros()->create(['name_neighborhood' => 'Centro Storico']);
            $bairro_mompiano = $cidade_brescia->bairros()->create(['name_neighborhood' => 'Mompiano']);
            $bairro_santefaustino = $cidade_brescia->bairros()->create(['name_neighborhood' => 'Santa Faustino']);

            // Bairros para Berlim, Alemanha
            $bairro_mitte = $cidade_berlim->bairros()->create(['name_neighborhood' => 'Mitte']);
            $bairro_kreuzberg = $cidade_berlim->bairros()->create(['name_neighborhood' => 'Kreuzberg']);
            $bairro_prenzlauerberg = $cidade_berlim->bairros()->create(['name_neighborhood' => 'Prenzlauer Berg']);

            // Bairros para Nuremberg, Baviera, Alemanha
            $bairro_altstadt = $cidade_nuremberg->bairros()->create(['name_neighborhood' => 'Altstadt']);
            $bairro_gostenhof = $cidade_nuremberg->bairros()->create(['name_neighborhood' => 'Gostenhof']);
            $bairro_stjohannis = $cidade_nuremberg->bairros()->create(['name_neighborhood' => 'St. Johannis']);

            // Bairros para Augsburg, Baviera, Alemanha
            $bairro_innenstadt = $cidade_augsburg->bairros()->create(['name_neighborhood' => 'Innenstadt']);
            $bairro_lechviertel = $cidade_augsburg->bairros()->create(['name_neighborhood' => 'Lechviertel']);
            $bairro_pfersee = $cidade_augsburg->bairros()->create(['name_neighborhood' => 'Pfersee']);

            // Bairros para Florença, Toscana, Itália
            $bairro_oltrarno = $cidade_florenca->bairros()->create(['name_neighborhood' => 'Oltrarno']);
            $bairro_sanfrediano = $cidade_florenca->bairros()->create(['name_neighborhood' => 'San Frediano']);
            $bairro_santacroce = $cidade_florenca->bairros()->create(['name_neighborhood' => 'Santa Croce']);

            // Bairros para Pisa, Toscana, Itália
            $bairro_sanfrancesco = $cidade_pisa->bairros()->create(['name_neighborhood' => 'San Francesco']);
            $bairro_santamaria = $cidade_pisa->bairros()->create(['name_neighborhood' => 'Santa Maria']);
            $bairro_sancataldo = $cidade_pisa->bairros()->create(['name_neighborhood' => 'San Cataldo']);

            // Bairros para Arezzo, Toscana, Itália
            $bairro_sanpaolo = $cidade_arezzo->bairros()->create(['name_neighborhood' => 'San Paolo']);
            $bairro_sanlorenzo = $cidade_arezzo->bairros()->create(['name_neighborhood' => 'San Lorenzo']);
            $bairro_santa_maria = $cidade_arezzo->bairros()->create(['name_neighborhood' => 'Santa Maria']);

            // Bairros para Palermo, Sicília, Itália
            $bairro_lapiazza = $cidade_palermo->bairros()->create(['name_neighborhood' => 'La Piazza']);
            $bairro_vucciria = $cidade_palermo->bairros()->create(['name_neighborhood' => 'Vucciria']);
            $bairro_kalsa = $cidade_palermo->bairros()->create(['name_neighborhood' => 'Kalsa']);

            // Bairros para Catania, Sicília, Itália
            $bairro_piazzaduomo = $cidade_catania->bairros()->create(['name_neighborhood' => 'Piazza Duomo']);
            $bairro_bellini = $cidade_catania->bairros()->create(['name_neighborhood' => 'Bellini']);
            $bairro_sangiuseppe = $cidade_catania->bairros()->create(['name_neighborhood' => 'San Giuseppe']);

            // Bairros para Trapani, Sicília, Itália
            $bairro_centrostorico = $cidade_trapani->bairros()->create(['name_neighborhood' => 'Centro Storico']);
            $bairro_marcopolo = $cidade_trapani->bairros()->create(['name_neighborhood' => 'Marco Polo']);
            $bairro_sanlorenzo = $cidade_trapani->bairros()->create(['name_neighborhood' => 'San Lorenzo']);

            // Bairros para Nagoya, Aichi, Japão
            $bairro_sakae = $cidade_nagoya->bairros()->create(['name_neighborhood' => 'Sakae']);
            $bairro_kanayama = $cidade_nagoya->bairros()->create(['name_neighborhood' => 'Kanayama']);
            $bairro_meieki = $cidade_nagoya->bairros()->create(['name_neighborhood' => 'Meieki']);

            // Bairros para Kanazawa, Ishikawa, Japão
            $bairro_korinbo = $cidade_kanazawa->bairros()->create(['name_neighborhood' => 'Korinbo']);
            $bairro_higashiyama = $cidade_kanazawa->bairros()->create(['name_neighborhood' => 'Higashiyama']);
            $bairro_katamachi = $cidade_kanazawa->bairros()->create(['name_neighborhood' => 'Katamachi']);

            // Bairros para Niigata, Niigata, Japão
            $bairro_bandai = $cidade_niigata->bairros()->create(['name_neighborhood' => 'Bandai']);
            $bairro_furumachi = $cidade_niigata->bairros()->create(['name_neighborhood' => 'Furumachi']);
            $bairro_chuo = $cidade_niigata->bairros()->create(['name_neighborhood' => 'Chuo']);

            // Bairros para Munique, Baviera, Alemanha
            $bairro_schwabing = $cidade_munique->bairros()->create(['name_neighborhood' => 'Schwabing']);
            $bairro_maxvorstadt = $cidade_munique->bairros()->create(['name_neighborhood' => 'Maxvorstadt']);
            $bairro_haidhausen = $cidade_munique->bairros()->create(['name_neighborhood' => 'Haidhausen']);

            // Bairros para Potsdam, Brandemburgo, Alemanha
            $bairro_brandenburger = $cidade_potsdam->bairros()->create(['name_neighborhood' => 'Brandenburger Vorstadt']);
            $bairro_hollandisches = $cidade_potsdam->bairros()->create(['name_neighborhood' => 'Holländisches Viertel']);
            $bairro_neubabelsberg = $cidade_potsdam->bairros()->create(['name_neighborhood' => 'Neu-Babelsberg']);

            // Bairros para Dresden, Saxônia, Alemanha
            $bairro_innere = $cidade_dresden->bairros()->create(['name_neighborhood' => 'Innere Altstadt']);
            $bairro_friedrichstadt = $cidade_dresden->bairros()->create(['name_neighborhood' => 'Friedrichstadt']);
            $bairro_neustadt = $cidade_dresden->bairros()->create(['name_neighborhood' => 'Äußere Neustadt']);

            // Bairros para Frankfurt, Hesse, Alemanha
            $bairro_altstadt = $cidade_francforte->bairros()->create(['name_neighborhood' => 'Altstadt']);
            $bairro_sachsenhausen = $cidade_francforte->bairros()->create(['name_neighborhood' => 'Sachsenhausen']);
            $bairro_bornheim = $cidade_francforte->bairros()->create(['name_neighborhood' => 'Bornheim']);

            // Bairros para Wiesbaden, Hesse, Alemanha
            $bairro_westend = $cidade_wiesbaden->bairros()->create(['name_neighborhood' => 'Westend']);
            $bairro_biebrich = $cidade_wiesbaden->bairros()->create(['name_neighborhood' => 'Biebrich']);
            $bairro_erbenheim = $cidade_wiesbaden->bairros()->create(['name_neighborhood' => 'Erbenheim']);

            // Bairros para Darmstadt, Hesse, Alemanha
            $bairro_darmstadtmitte = $cidade_darmstadt->bairros()->create(['name_neighborhood' => 'Darmstadt-Mitte']);
            $bairro_eberstadt = $cidade_darmstadt->bairros()->create(['name_neighborhood' => 'Eberstadt']);
            $bairro_wixhausen = $cidade_darmstadt->bairros()->create(['name_neighborhood' => 'Wixhausen']);

            // Bairros para Ballarat, Victoria, Austrália
            $bairro_goldenpoint = $cidade_ballarat->bairros()->create(['name_neighborhood' => 'Golden Point']);
            $bairro_lakewendouree = $cidade_ballarat->bairros()->create(['name_neighborhood' => 'Lake Wendouree']);
            $bairro_blackhill = $cidade_ballarat->bairros()->create(['name_neighborhood' => 'Black Hill']);

            // Bairros para Newcastle, Nova Gales do Sul, Austrália
            $bairro_thehill = $cidade_newcastle->bairros()->create(['name_neighborhood' => 'The Hill']);
            $bairro_wickham = $cidade_newcastle->bairros()->create(['name_neighborhood' => 'Wickham']);
            $bairro_hamiltonsouth = $cidade_newcastle->bairros()->create(['name_neighborhood' => 'Hamilton South']);

            // Bairros para Gold Coast, Queensland, Austrália
            $bairro_surfersparadise = $cidade_goldcoast->bairros()->create(['name_neighborhood' => 'Surfers Paradise']);
            $bairro_burleighheads = $cidade_goldcoast->bairros()->create(['name_neighborhood' => 'Burleigh Heads']);
            $bairro_southport = $cidade_goldcoast->bairros()->create(['name_neighborhood' => 'Southport']);

            // Bairros para Juazeiro do Ceará, Ceará, Brasil
            $bairro_centro_juazeiro = $cidade_juazeirodoceara->bairros()->create(['name_neighborhood' => 'Centro']);
            $bairro_jardim_gonzaga = $cidade_juazeirodoceara->bairros()->create(['name_neighborhood' => 'Jardim Gonzaga']);
            $bairro_pirajá = $cidade_juazeirodoceara->bairros()->create(['name_neighborhood' => 'Pirajá']);

            // Bairros para Sobral, Ceará, Brasil
            $bairro_centro_sobral = $cidade_sobral->bairros()->create(['name_neighborhood' => 'Centro']);
            $bairro_junqueiro = $cidade_sobral->bairros()->create(['name_neighborhood' => 'Junqueiro']);
            $bairro_cohab = $cidade_sobral->bairros()->create(['name_neighborhood' => 'COHAB']);

            // Bairros para Austin, Texas, EUA
            $bairro_downtown_austin = $cidade_austin->bairros()->create(['name_neighborhood' => 'Downtown']);
            $bairro_south_congress = $cidade_austin->bairros()->create(['name_neighborhood' => 'South Congress']);
            $bairro_east_austin = $cidade_austin->bairros()->create(['name_neighborhood' => 'East Austin']);

            // Bairros para Dallas, Texas, EUA
            $bairro_uptown = $cidade_dallas->bairros()->create(['name_neighborhood' => 'Uptown']);
            $bairro_deep_ellum = $cidade_dallas->bairros()->create(['name_neighborhood' => 'Deep Ellum']);
            $bairro_bishop_arts = $cidade_dallas->bairros()->create(['name_neighborhood' => 'Bishop Arts District']);

            // Bairros para Buffalo, Nova Iorque, EUA
            $bairro_allentown = $cidade_buffalo->bairros()->create(['name_neighborhood' => 'Allentown']);
            $bairro_elmwood_village = $cidade_buffalo->bairros()->create(['name_neighborhood' => 'Elmwood Village']);
            $bairro_north_park = $cidade_buffalo->bairros()->create(['name_neighborhood' => 'North Park']);

            // Bairros para Rochester, Nova Iorque, EUA
            $bairro_park_ave = $cidade_rochester->bairros()->create(['name_neighborhood' => 'Park Ave']);
            $bairro_east_end = $cidade_rochester->bairros()->create(['name_neighborhood' => 'East End']);
            $bairro_south_wedge = $cidade_rochester->bairros()->create(['name_neighborhood' => 'South Wedge']);

            // Bairros para Hamilton, Ontário, Canadá
            $bairro_westdale = $cidade_hamilton->bairros()->create(['name_neighborhood' => 'Westdale']);
            $bairro_ancaster = $cidade_hamilton->bairros()->create(['name_neighborhood' => 'Ancaster']);
            $bairro_dundas = $cidade_hamilton->bairros()->create(['name_neighborhood' => 'Dundas']);

            // Bairros para Quebec, Canadá
            $bairro_old_quebec = $cidade_quebec->bairros()->create(['name_neighborhood' => 'Old Quebec']);
            $bairro_saintroch = $cidade_quebec->bairros()->create(['name_neighborhood' => 'Saint-Roch']);
            $bairro_limoilou = $cidade_quebec->bairros()->create(['name_neighborhood' => 'Limoilou']);

            // Bairros para Calgary, Alberta, Canadá
            $bairro_downtown_calgary = $cidade_calgary->bairros()->create(['name_neighborhood' => 'Downtown']);
            $bairro_kensington = $cidade_calgary->bairros()->create(['name_neighborhood' => 'Kensington']);
            $bairro_beltline = $cidade_calgary->bairros()->create(['name_neighborhood' => 'Beltline']);

            // Bairros para Edmonton, Alberta, Canadá
            $bairro_whyte_ave = $cidade_edmonton->bairros()->create(['name_neighborhood' => 'Whyte Ave']);
            $bairro_oliver = $cidade_edmonton->bairros()->create(['name_neighborhood' => 'Oliver']);
            $bairro_downtown_edmonton = $cidade_edmonton->bairros()->create(['name_neighborhood' => 'Downtown']);

            // Bairros para Red Deer, Alberta, Canadá
            $bairro_sunnybrook = $cidade_reddeer->bairros()->create(['name_neighborhood' => 'Sunnybrook']);
            $bairro_glendale = $cidade_reddeer->bairros()->create(['name_neighborhood' => 'Glendale']);
            $bairro_anders = $cidade_reddeer->bairros()->create(['name_neighborhood' => 'Anders']);




        // ---

        $cidade_itanhaem = $estado_saopaulo->cidades()->create(['name_city' => 'Itanhaém']);
        $estado_saopaulo->cidades()->create(['name_city' => 'Mongagua']);
        $estado_saopaulo->cidades()->create(['name_city' => 'Peruibe']);
        $estado_parana->cidades()->create(['name_city' => 'Curitiba']);
        $estado_riodejaneiro->cidades()->create(['name_city' => 'Paraty']);
        $estado_florida->cidades()->create(['name_city' => 'Miami']);

        $cidade_itanhaem->bairros()->create(['name_neighborhood' => 'Belas Artes']);
        $cidade_itanhaem->bairros()->create(['name_neighborhood' => 'Centro']);
        $cidade_itanhaem->bairros()->create(['name_neighborhood' => 'Suarão']);

        //Pais::find(1)->estados()->find(1)->cidades()->find(1)->bairros()->create(['name_neighborhood' => 'Belas Artes']);
        //Pais::find(1)->estados()->find(1)->cidades()->find(1)->bairros()->create(['name_neighborhood' => 'Centro']);
        //Pais::find(1)->estados()->find(1)->cidades()->find(1)->bairros()->create(['name_neighborhood' => 'Suarão']);


        // GPT Fornecedor

            // Fornecedores para o Brasil
            $fornecedor_brasil_1 = Fornecedor::create([
                'name' => 'João da Silva',
                'company_name' => 'Brasil Comércio LTDA',
                'cnpj' => 987654320001,
                'email' => 'joao@brasilcomercio.com'
            ]);

            $fornecedor_brasil_1->enderecos()->create([
                'name' => 'Fábrica Principal',
                'street_name' => 'Rua do Comércio',
                'cep' => 11740000,
                'house_number' => 15,
                'complement' => 'Próximo à Praça Central',
                'bairro_id' => 5
            ]);

            $fornecedor_brasil_2 = Fornecedor::create([
                'name' => 'Maria da Silva',
                'company_name' => 'Brasil Industrial Ltda',
                'cnpj' => 987654320002,
                'email' => 'maria@brasilindustrial.com'
            ]);

            $fornecedor_brasil_2->enderecos()->create([
                'name' => 'Unidade de Produção',
                'street_name' => 'Avenida Industrial',
                'cep' => 11740000,
                'house_number' => 20,
                'complement' => 'Ao lado do Parque Industrial',
                'bairro_id' => 5
            ]);

            // Fornecedores para os EUA
            $fornecedor_usa_1 = Fornecedor::create([
                'name' => 'John Smith',
                'company_name' => 'US Trading Corp',
                'cnpj' => 987654320003,
                'email' => 'john@ustrading.com'
            ]);

            $fornecedor_usa_1->enderecos()->create([
                'name' => 'Main Facility',
                'street_name' => 'Commerce Street',
                'cep' => 90210,
                'house_number' => 30,
                'complement' => 'Next to Downtown',
                'bairro_id' => 5
            ]);

            $fornecedor_usa_2 = Fornecedor::create([
                'name' => 'Emily Johnson',
                'company_name' => 'Tech Solutions Inc',
                'cnpj' => 987654320004,
                'email' => 'emily@techsolutions.com'
            ]);

            $fornecedor_usa_2->enderecos()->create([
                'name' => 'Production Center',
                'street_name' => 'Tech Avenue',
                'cep' => 90210,
                'house_number' => 25,
                'complement' => 'Close to Innovation Park',
                'bairro_id' => 5
            ]);

            // Fornecedores para a França
            $fornecedor_franca_1 = Fornecedor::create([
                'name' => 'Jean Dupont',
                'company_name' => 'Fabrique Française SARL',
                'cnpj' => 987654320005,
                'email' => 'jean@fabriquefrancaise.com'
            ]);

            $fornecedor_franca_1->enderecos()->create([
                'name' => 'Siège Social',
                'street_name' => 'Rue de Paris',
                'cep' => 75001,
                'house_number' => 5,
                'complement' => 'Proche de la Tour Eiffel',
                'bairro_id' => 5
            ]);

            $fornecedor_franca_2 = Fornecedor::create([
                'name' => 'Claire Martin',
                'company_name' => 'Produits de Luxe SAS',
                'cnpj' => 987654320006,
                'email' => 'claire@produitsdeluxe.com'
            ]);

            $fornecedor_franca_2->enderecos()->create([
                'name' => 'Unité de Production',
                'street_name' => 'Avenue des Champs-Élysées',
                'cep' => 75008,
                'house_number' => 8,
                'complement' => 'Près de l\'Arc de Triomphe',
                'bairro_id' => 5
            ]);

            // Fornecedores para a Austrália
            $fornecedor_australia_1 = Fornecedor::create([
                'name' => 'Jack Thompson',
                'company_name' => 'Aussie Goods Pty Ltd',
                'cnpj' => 987654320007,
                'email' => 'jack@aussiegoods.com'
            ]);

            $fornecedor_australia_1->enderecos()->create([
                'name' => 'Head Office',
                'street_name' => 'Sydney Street',
                'cep' => 2000,
                'house_number' => 18,
                'complement' => 'Near Sydney Harbour',
                'bairro_id' => 5
            ]);

            $fornecedor_australia_2 = Fornecedor::create([
                'name' => 'Emily Davies',
                'company_name' => 'Tech Innovations Pty Ltd',
                'cnpj' => 987654320008,
                'email' => 'emily@techinnovations.com'
            ]);

            $fornecedor_australia_2->enderecos()->create([
                'name' => 'Tech Campus',
                'street_name' => 'Innovation Avenue',
                'cep' => 2000,
                'house_number' => 12,
                'complement' => 'Next to Tech Park',
                'bairro_id' => 5
            ]);

            // Fornecedores para a Alemanha
            $fornecedor_alemanha_1 = Fornecedor::create([
                'name' => 'Hans Müller',
                'company_name' => 'Deutsche Waren GmbH',
                'cnpj' => 987654320009,
                'email' => 'hans@deutschewaren.com'
            ]);

            $fornecedor_alemanha_1->enderecos()->create([
                'name' => 'Hauptquartier',
                'street_name' => 'Hauptstraße',
                'cep' => 10115,
                'house_number' => 7,
                'complement' => 'In der Nähe des Brandenburger Tors',
                'bairro_id' => 5
            ]);

            $fornecedor_alemanha_2 = Fornecedor::create([
                'name' => 'Anna Schmidt',
                'company_name' => 'Technologie GmbH',
                'cnpj' => 987654320010,
                'email' => 'anna@technologie.com'
            ]);

            $fornecedor_alemanha_2->enderecos()->create([
                'name' => 'Produktionsstandort',
                'street_name' => 'Technologie Allee',
                'cep' => 10115,
                'house_number' => 15,
                'complement' => 'Neben dem Technologiepark',
                'bairro_id' => 5
            ]);

            // Fornecedores para o Japão
            $fornecedor_japao_1 = Fornecedor::create([
                'name' => 'Takeshi Yamada',
                'company_name' => 'Yamada Manufacturing Co., Ltd.',
                'cnpj' => 987654320011,
                'email' => 'takeshi@yamadamfg.com'
            ]);

            $fornecedor_japao_1->enderecos()->create([
                'name' => 'Sede Principal',
                'street_name' => 'Avenida Principal',
                'cep' => 100-0001,
                'house_number' => 1,
                'complement' => 'Perto de Shibuya Crossing',
                'bairro_id' => 2
            ]);

            $fornecedor_japao_2 = Fornecedor::create([
                'name' => 'Mai Nakamura',
                'company_name' => 'Nakamura Electronics Ltd.',
                'cnpj' => 987654320012,
                'email' => 'mai@nakamuraelectronics.com'
            ]);

            $fornecedor_japao_2->enderecos()->create([
                'name' => 'Centro de Produção',
                'street_name' => 'Rua da Eletrônica',
                'cep' => 100-0002,
                'house_number' => 5,
                'complement' => 'Próximo ao Bairro Akihabara',
                'bairro_id' => 3
            ]);

        //---


        Fornecedor::create(['name' => 'Fulano Dono da Mineirão', 'company_name' => 'Mineirão', 'cnpj' => 1234567890, 'email' => 'mineirão@mineirão.com'])
            ->enderecos()->create(
                ['name' => 'Casa 5', 'street_name' => 'Rua Dagruta', 'cep' => 11740000, 'house_number' => 10, 'complement' => 'Casa', 'bairro_id' => 2],
                ['name' => 'Casa 6', 'street_name' => 'Av. graça', 'cep' => 11740000, 'house_number' => 10, 'complement' => 'Casa', 'bairro_id' => 1]
            );
        Fornecedor::create(['name' => 'Ciclano vendedor da Denise Salgados', 'company_name' => 'Denise Salgados', 'cnpj' => 1234567891, 'email' => 'denise@mdenise.com'])
            ->enderecos()->create(['name' => 'Casa 3', 'street_name' => 'Rua Pernambuco', 'cep' => 11740000, 'house_number' => 10, 'complement' => 'Casa', 'bairro_id' => 3]);


        //Marcas GPT
            // Marcas para o fornecedor no Brasil 1
            $coxinha_brasil_1 = $fornecedor_brasil_1->marcas()->create(['name' => 'Coxinha Congelada']);
            $esfiha_brasil_1 = $fornecedor_brasil_1->marcas()->create(['name' => 'Esfiha Express']);

            // Marcas para o fornecedor no Brasil 2
            $marca_brasil2_1 = $fornecedor_brasil_2->marcas()->create(['name' => 'Salgadinhos Delícia']);
            $marca_brasil2_2 = $fornecedor_brasil_2->marcas()->create(['name' => 'Sabor & Crocância']);

            // Marcas para o fornecedor nos EUA 1
            $marca_usa_1 = $fornecedor_usa_1->marcas()->create(['name' => 'SnackMaster']);
            $marca_usa_2 = $fornecedor_usa_1->marcas()->create(['name' => 'Tasty Bites']);

            // Marcas para o fornecedor nos EUA 2
            $marca_usa2_1 = $fornecedor_usa_2->marcas()->create(['name' => 'Frozen Cravings']);
            $marca_usa2_2 = $fornecedor_usa_2->marcas()->create(['name' => 'Gourmet Snacks']);

            // Marcas para o fornecedor na França 1
            $marca_franca_1 = $fornecedor_franca_1->marcas()->create(['name' => 'Petit Délice']);
            $marca_franca_2 = $fornecedor_franca_1->marcas()->create(['name' => 'Le Snack Français']);

            // Marcas para o fornecedor na França 2
            $marca_franca2_1 = $fornecedor_franca_2->marcas()->create(['name' => 'Délices de Paris']);
            $marca_franca2_2 = $fornecedor_franca_2->marcas()->create(['name' => 'Croissant Snacks']);

            // Marcas para o fornecedor na Austrália 1
            $marca_australia_1 = $fornecedor_australia_1->marcas()->create(['name' => 'Aussie Bites']);
            $marca_australia_2 = $fornecedor_australia_1->marcas()->create(['name' => 'Outback Snacks']);

            // Marcas para o fornecedor na Austrália 2
            $marca_australia2_1 = $fornecedor_australia_2->marcas()->create(['name' => 'Kangaroo Rolls']);
            $marca_australia2_2 = $fornecedor_australia_2->marcas()->create(['name' => 'Sydney Delights']);

            // Marcas para o fornecedor na Alemanha 1
            $marca_alemanha_1 = $fornecedor_alemanha_1->marcas()->create(['name' => 'Deutscher Genuss']);
            $marca_alemanha_2 = $fornecedor_alemanha_1->marcas()->create(['name' => 'Brezel Snacks']);

            // Marcas para o fornecedor na Alemanha 2
            $marca_alemanha2_1 = $fornecedor_alemanha_2->marcas()->create(['name' => 'Oktoberfest Bites']);
            $marca_alemanha2_2 = $fornecedor_alemanha_2->marcas()->create(['name' => 'Schnitzel Snacks']);

            // Marcas para o fornecedor no Japão 1
            $marca_japao_1 = $fornecedor_japao_1->marcas()->create(['name' => 'Sushi Rolls']);
            $marca_japao_2 = $fornecedor_japao_1->marcas()->create(['name' => 'Tempura Bites']);

            // Marcas para o fornecedor no Japão 2
            $marca_japao2_1 = $fornecedor_japao_2->marcas()->create(['name' => 'Mochi Delights']);
            $marca_japao2_2 = $fornecedor_japao_2->marcas()->create(['name' => 'Gyoza Bites']);
        //---


        Fornecedor::find(1)->marcas()->create(['name' => 'Mineirão']);
        Fornecedor::find(1)->marcas()->create(['name' => 'Vovó Natalia']);
        Fornecedor::find(2)->marcas()->create(['name' => 'Croissant & Cia']);

        Tipo_produto::create(['name' => 'Cru - para assar']);
        Tipo_produto::create(['name' => 'Cru - para fritar']);
        Tipo_produto::create(['name' => 'Pré assado']);
        Tipo_produto::create(['name' => 'Frito']);

        Tipo_movimentacao::create(['name' => 'Compra de um fornecedor']);
        Tipo_movimentacao::create(['name' => 'Venda para um cliente']);
        Tipo_movimentacao::create(['name' => 'Devolução de um produto comprado']);
        Tipo_movimentacao::create(['name' => 'Devolução de um produto vendido']);
        Tipo_movimentacao::create(['name' => 'Ajuste de estoque']);

        MetodoPagamento::create(['name' => 'Avista - Dinheiro']);
        MetodoPagamento::create(['name' => 'Avista - PIX']);
        MetodoPagamento::create(['name' => 'Cartão - Débito']);
        MetodoPagamento::create(['name' => 'Cartão - Crédito']);
        MetodoPagamento::create(['name' => 'A prazo']);
        MetodoPagamento::create(['name' => 'Cheque']);


        //Produtos GPT

            $produto1 = $coxinha_brasil_1->produtos()->create([
                'name' => 'Coxinha de Frango', //nome do produto
                'tipo_produto_id' => 1, // id do tipo de produto, recebe valores de 1 a 4
                'quantity' => 10, // quantidade de unidades por pacote
                'weight' => 3, //peso do pacote em kg
                'cost_price' => 18, // preço de custo em reais do pacote
                'sale_price' => 22, // preço de venda em reais do pacote
                'description' => "Coxinha de frango temperada com tempero baiano e salsinha" // descrição rapida do produto em portugues
            ]);

            // Produtos para a marca Coxinha Brasil 1
                $coxinha_produto1 = $coxinha_brasil_1->produtos()->create([
                    'name' => 'Coxinha de Frango',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.3,
                    'cost_price' => 18,
                    'sale_price' => 22,
                    'description' => "Coxinha de frango temperada com tempero baiano e salsinha"
                ]);

                $coxinha_produto2 = $coxinha_brasil_1->produtos()->create([
                    'name' => 'Coxinha de Queijo',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.25,
                    'cost_price' => 15,
                    'sale_price' => 20,
                    'description' => "Coxinha de queijo cremoso com temperos especiais"
                ]);

                $coxinha_produto3 = $coxinha_brasil_1->produtos()->create([
                    'name' => 'Kibe Frito',
                    'tipo_produto_id' => 2,
                    'quantity' => 12,
                    'weight' => 0.4,
                    'cost_price' => 20,
                    'sale_price' => 25,
                    'description' => "Kibe frito recheado com carne moída temperada"
                ]);

                $coxinha_produto4 = $coxinha_brasil_1->produtos()->create([
                    'name' => 'Esfiha de Carne',
                    'tipo_produto_id' => 2,
                    'quantity' => 9,
                    'weight' => 0.35,
                    'cost_price' => 16,
                    'sale_price' => 21,
                    'description' => "Esfiha aberta com recheio de carne temperada"
                ]);

                $coxinha_produto5 = $coxinha_brasil_1->produtos()->create([
                    'name' => 'Pastel de Queijo',
                    'tipo_produto_id' => 3,
                    'quantity' => 15,
                    'weight' => 0.2,
                    'cost_price' => 12,
                    'sale_price' => 18,
                    'description' => "Pastel crocante com recheio de queijo derretido"
                ]);

                // Produtos para a marca Esfiha Brasil 1
                $esfiha_produto1 = $esfiha_brasil_1->produtos()->create([
                    'name' => 'Esfiha de Carne',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.35,
                    'cost_price' => 20,
                    'sale_price' => 24,
                    'description' => "Esfiha aberta recheada com carne temperada"
                ]);

                $esfiha_produto2 = $esfiha_brasil_1->produtos()->create([
                    'name' => 'Esfiha de Queijo',
                    'tipo_produto_id' => 1,
                    'quantity' => 9,
                    'weight' => 0.3,
                    'cost_price' => 18,
                    'sale_price' => 22,
                    'description' => "Esfiha aberta recheada com queijo derretido"
                ]);

                $esfiha_produto3 = $esfiha_brasil_1->produtos()->create([
                    'name' => 'Pastel de Carne',
                    'tipo_produto_id' => 2,
                    'quantity' => 12,
                    'weight' => 0.4,
                    'cost_price' => 22,
                    'sale_price' => 26,
                    'description' => "Pastel crocante com recheio de carne moída temperada"
                ]);

                $esfiha_produto4 = $esfiha_brasil_1->produtos()->create([
                    'name' => 'Bolinha de Queijo',
                    'tipo_produto_id' => 3,
                    'quantity' => 15,
                    'weight' => 0.25,
                    'cost_price' => 16,
                    'sale_price' => 20,
                    'description' => "Bolinha de massa recheada com queijo cremoso"
                ]);

                $esfiha_produto5 = $esfiha_brasil_1->produtos()->create([
                    'name' => 'Enroladinho de Salsicha',
                    'tipo_produto_id' => 4,
                    'quantity' => 20,
                    'weight' => 0.2,
                    'cost_price' => 14,
                    'sale_price' => 18,
                    'description' => "Massa crocante com salsicha dentro"
                ]);

                // Produtos para a marca Salgadinhos Delícia
                $produto1_fornecedor2_brasil = $marca_brasil2_1->produtos()->create([
                    'name' => 'Pastel de Frango',
                    'tipo_produto_id' => 1,
                    'quantity' => 12,
                    'weight' => 0.3,
                    'cost_price' => 20,
                    'sale_price' => 25,
                    'description' => "Pastel recheado com frango temperado"
                ]);

                $produto2_fornecedor2_brasil = $marca_brasil2_1->produtos()->create([
                    'name' => 'Coxinha de Mandioca',
                    'tipo_produto_id' => 1,
                    'quantity' => 9,
                    'weight' => 0.25,
                    'cost_price' => 18,
                    'sale_price' => 22,
                    'description' => "Coxinha com massa de mandioca e recheio especial"
                ]);

                // Produtos para a marca Sabor & Crocância
                $produto1_fornecedor2_brasil = $marca_brasil2_2->produtos()->create([
                    'name' => 'Bolinha de Queijo',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.35,
                    'cost_price' => 19,
                    'sale_price' => 23,
                    'description' => "Bolinha de queijo derretido e crocante"
                ]);

                $produto2_fornecedor2_brasil = $marca_brasil2_2->produtos()->create([
                    'name' => 'Enroladinho de Presunto e Queijo',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.3,
                    'cost_price' => 17,
                    'sale_price' => 21,
                    'description' => "Enroladinho de massa crocante recheado com presunto e queijo"
                ]);

                // Produtos para a marca Tasty Bites
                $produto1_fornecedor1_usa = $marca_usa_2->produtos()->create([
                    'name' => 'Buffalo Chicken Wings',
                    'tipo_produto_id' => 1,
                    'quantity' => 12,
                    'weight' => 0.4,
                    'cost_price' => 25,
                    'sale_price' => 30,
                    'description' => "Asas de frango temperadas ao estilo Buffalo"
                ]);

                $produto2_fornecedor1_usa = $marca_usa_2->produtos()->create([
                    'name' => 'Cheddar Jalapeño Poppers',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.3,
                    'cost_price' => 22,
                    'sale_price' => 28,
                    'description' => "Poppers de queijo cheddar com pimenta jalapeño"
                ]);

                // Produtos para a marca Haute Couture
                $produto1_fornecedor1_franca = $marca_franca_1->produtos()->create([
                    'name' => 'Croissant Recheado',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.25,
                    'cost_price' => 20,
                    'sale_price' => 25,
                    'description' => "Croissant recheado com delicioso recheio cremoso"
                ]);

                $produto2_fornecedor1_franca = $marca_franca_1->produtos()->create([
                    'name' => 'Quiche Lorraine',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.3,
                    'cost_price' => 18,
                    'sale_price' => 22,
                    'description' => "Quiche tradicional com bacon e queijo"
                ]);

                // Produtos para a marca Outback Snacks
                $produto1_fornecedor1_australia = $marca_australia_1->produtos()->create([
                    'name' => 'Kangaroo Empanadas',
                    'tipo_produto_id' => 1,
                    'quantity' => 12,
                    'weight' => 0.35,
                    'cost_price' => 24,
                    'sale_price' => 28,
                    'description' => "Empanadas com carne de canguru e temperos especiais"
                ]);

                $produto2_fornecedor1_australia = $marca_australia_1->produtos()->create([
                    'name' => 'Aussie Meat Pies',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.4,
                    'cost_price' => 26,
                    'sale_price' => 30,
                    'description' => "Tortinhas com recheio de carne australiana"
                ]);

                // Produtos para a marca Berlin Designs
                $produto1_fornecedor1_alemanha = $marca_alemanha_1->produtos()->create([
                    'name' => 'Brezel Snacks',
                    'tipo_produto_id' => 1,
                    'quantity' => 15,
                    'weight' => 0.3,
                    'cost_price' => 22,
                    'sale_price' => 26,
                    'description' => "Snacks de pretzel crocantes"
                ]);

                $produto2_fornecedor1_alemanha = $marca_alemanha_1->produtos()->create([
                    'name' => 'Schnitzel Rolls',
                    'tipo_produto_id' => 1,
                    'quantity' => 12,
                    'weight' => 0.35,
                    'cost_price' => 25,
                    'sale_price' => 29,
                    'description' => "Rocambole de schnitzel tradicional"
                ]);

                // Produtos para a marca Fashion Chic
                $produto1_fornecedor2_franca = $marca_franca2_1->produtos()->create([
                    'name' => 'Croissant de Chocolate',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.25,
                    'cost_price' => 20,
                    'sale_price' => 25,
                    'description' => "Croissant recheado com chocolate belga"
                ]);

                $produto2_fornecedor2_franca = $marca_franca2_1->produtos()->create([
                    'name' => 'Éclair de Baunilha',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.3,
                    'cost_price' => 18,
                    'sale_price' => 22,
                    'description' => "Éclair com recheio cremoso de baunilha"
                ]);

                // Produtos para a marca Fashion Chic
                $produto1_fornecedor2_franca = $marca_franca2_1->produtos()->create([
                    'name' => 'Croissant de Chocolate',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.25,
                    'cost_price' => 20,
                    'sale_price' => 25,
                    'description' => "Croissant recheado com chocolate belga"
                ]);

                $produto2_fornecedor2_franca = $marca_franca2_1->produtos()->create([
                    'name' => 'Éclair de Baunilha',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.3,
                    'cost_price' => 18,
                    'sale_price' => 22,
                    'description' => "Éclair com recheio cremoso de baunilha"
                ]);

                // Produtos para a marca Aussie Bites
                $produto1_fornecedor2_australia = $marca_australia2_1->produtos()->create([
                    'name' => 'Tim Tam Biscuits',
                    'tipo_produto_id' => 1,
                    'quantity' => 12,
                    'weight' => 0.35,
                    'cost_price' => 24,
                    'sale_price' => 28,
                    'description' => "Biscoitos Tim Tam deliciosos"
                ]);

                $produto2_fornecedor2_australia = $marca_australia2_1->produtos()->create([
                    'name' => 'Anzac Biscuits',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.4,
                    'cost_price' => 26,
                    'sale_price' => 30,
                    'description' => "Biscoitos Anzac tradicionais"
                ]);

                // Produtos para a marca Oktoberfest Bites
                $produto1_fornecedor2_alemanha = $marca_alemanha2_1->produtos()->create([
                    'name' => 'Pretzel Sticks',
                    'tipo_produto_id' => 1,
                    'quantity' => 15,
                    'weight' => 0.3,
                    'cost_price' => 22,
                    'sale_price' => 26,
                    'description' => "Palitos de pretzel crocantes"
                ]);

                $produto2_fornecedor2_alemanha = $marca_alemanha2_1->produtos()->create([
                    'name' => 'Sauerkraut Rolls',
                    'tipo_produto_id' => 1,
                    'quantity' => 12,
                    'weight' => 0.35,
                    'cost_price' => 25,
                    'sale_price' => 29,
                    'description' => "Rocambole de chucrute"
                ]);

                // Produtos para a marca Sushi Rolls
                $produto1_fornecedor1_japao = $marca_japao_1->produtos()->create([
                    'name' => 'California Roll',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.3,
                    'cost_price' => 30,
                    'sale_price' => 35,
                    'description' => "Rolo de sushi com recheio de abacate e kani"
                ]);

                $produto2_fornecedor1_japao = $marca_japao_1->produtos()->create([
                    'name' => 'Sashimi de Salmão',
                    'tipo_produto_id' => 1,
                    'quantity' => 12,
                    'weight' => 0.4,
                    'cost_price' => 40,
                    'sale_price' => 45,
                    'description' => "Fatias finas de salmão fresco para sushi"
                ]);

                // Produtos para a marca Ramen Express
                $produto1_fornecedor1_japao = $marca_japao_2->produtos()->create([
                    'name' => 'Shoyu Ramen',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.4,
                    'cost_price' => 30,
                    'sale_price' => 35,
                    'description' => "Ramen com caldo de shoyu e fatias de porco"
                ]);

                $produto2_fornecedor1_japao = $marca_japao_2->produtos()->create([
                    'name' => 'Miso Ramen',
                    'tipo_produto_id' => 1,
                    'quantity' => 12,
                    'weight' => 0.45,
                    'cost_price' => 32,
                    'sale_price' => 37,
                    'description' => "Ramen com caldo de miso e cebolinha fresca"
                ]);

                // Produtos para a marca Sashimi Supreme
                $produto1_fornecedor2_japao = $marca_japao2_1->produtos()->create([
                    'name' => 'Sashimi de Salmão Fresco',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.3,
                    'cost_price' => 35,
                    'sale_price' => 40,
                    'description' => "Fatias finas de salmão fresco para sashimi"
                ]);

                $produto2_fornecedor2_japao = $marca_japao2_1->produtos()->create([
                    'name' => 'Sashimi de Atum Vermelho',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.35,
                    'cost_price' => 40,
                    'sale_price' => 45,
                    'description' => "Fatias de atum vermelho fresco para sashimi"
                ]);

                // Produtos para a marca Bratwurst Delights
                $produto1_fornecedor2_alemanha = $marca_alemanha2_2->produtos()->create([
                    'name' => 'Bratwurst Clássica',
                    'tipo_produto_id' => 1,
                    'quantity' => 12,
                    'weight' => 0.4,
                    'cost_price' => 22,
                    'sale_price' => 26,
                    'description' => "Salsicha alemã clássica"
                ]);

                $produto2_fornecedor2_alemanha = $marca_alemanha2_2->produtos()->create([
                    'name' => 'Currywurst',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.4,
                    'cost_price' => 25,
                    'sale_price' => 29,
                    'description' => "Salsicha alemã com molho de curry"
                ]);

                // Produtos para a marca Tokyo Sushi
                $produto1_fornecedor2_japao = $marca_japao2_2->produtos()->create([
                    'name' => 'Nigiri Sushi de Salmão',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.3,
                    'cost_price' => 30,
                    'sale_price' => 35,
                    'description' => "Nigiri sushi de salmão fresco"
                ]);

                $produto2_fornecedor2_japao = $marca_japao2_2->produtos()->create([
                    'name' => 'Maki Sushi de Atum',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.35,
                    'cost_price' => 32,
                    'sale_price' => 37,
                    'description' => "Maki sushi com atum fresco"
                ]);

                // Produtos para a marca American Snacks
                $produto1_fornecedor1_usa = $marca_usa_1->produtos()->create([
                    'name' => 'Classic Hot Dogs',
                    'tipo_produto_id' => 1,
                    'quantity' => 12,
                    'weight' => 0.4,
                    'cost_price' => 20,
                    'sale_price' => 25,
                    'description' => "Cachorros-quentes clássicos americanos"
                ]);

                $produto2_fornecedor1_usa = $marca_usa_1->produtos()->create([
                    'name' => 'Popcorn Supreme',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.35,
                    'cost_price' => 18,
                    'sale_price' => 22,
                    'description' => "Pipoca premium com manteiga"
                ]);

                // Produtos para a marca New York Sweets
                $produto1_fornecedor2_usa = $marca_usa2_1->produtos()->create([
                    'name' => 'New York Cheesecake',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.6,
                    'cost_price' => 25,
                    'sale_price' => 30,
                    'description' => "Cheesecake clássico de Nova York"
                ]);

                $produto2_fornecedor2_usa = $marca_usa2_1->produtos()->create([
                    'name' => 'Key Lime Pie',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.5,
                    'cost_price' => 22,
                    'sale_price' => 27,
                    'description' => "Torta de limão típica da Flórida"
                ]);

                // Produtos para a marca Texas BBQ
                $produto1_fornecedor2_usa = $marca_usa2_2->produtos()->create([
                    'name' => 'Brisket Defumado',
                    'tipo_produto_id' => 1,
                    'quantity' => 12,
                    'weight' => 0.5,
                    'cost_price' => 30,
                    'sale_price' => 35,
                    'description' => "Brisket suculento defumado lentamente"
                ]);

                $produto2_fornecedor2_usa = $marca_usa2_2->produtos()->create([
                    'name' => 'Ribs Ahumadas',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.6,
                    'cost_price' => 28,
                    'sale_price' => 33,
                    'description' => "Costelas defumadas no estilo texano"
                ]);

                // Produtos para a marca Parisian Delights
                $produto1_fornecedor2_franca = $marca_franca_2->produtos()->create([
                    'name' => 'Macarons Variados',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.3,
                    'cost_price' => 22,
                    'sale_price' => 26,
                    'description' => "Assortimento de macarons de sabores variados"
                ]);

                $produto2_fornecedor2_franca = $marca_franca_2->produtos()->create([
                    'name' => 'Croissant de Amêndoa',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.35,
                    'cost_price' => 20,
                    'sale_price' => 24,
                    'description' => "Croissant de amêndoa francês"
                ]);

                // Produtos para a marca French Wine & Cheese
                $produto1_fornecedor2_franca = $marca_franca2_2->produtos()->create([
                    'name' => 'Queijo Brie',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.4,
                    'cost_price' => 25,
                    'sale_price' => 30,
                    'description' => "Queijo brie francês tradicional"
                ]);

                $produto2_fornecedor2_franca = $marca_franca2_2->produtos()->create([
                    'name' => 'Vinho Bordeaux',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.75,
                    'cost_price' => 28,
                    'sale_price' => 35,
                    'description' => "Vinho tinto de Bordeaux renomado"
                ]);

                // Produtos para a marca Australian Outback Treats
                $produto1_fornecedor2_australia = $marca_australia_2->produtos()->create([
                    'name' => 'Pavlova Australiana',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.5,
                    'cost_price' => 28,
                    'sale_price' => 33,
                    'description' => "Sobremesa australiana com merengue e frutas"
                ]);

                $produto2_fornecedor2_australia = $marca_australia_2->produtos()->create([
                    'name' => 'Meat Pie',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.4,
                    'cost_price' => 25,
                    'sale_price' => 30,
                    'description' => "Torta de carne australiana clássica"
                ]);

                // Produtos para a marca Australian Wines
                $produto1_fornecedor2_australia = $marca_australia2_2->produtos()->create([
                    'name' => 'Shiraz',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.75,
                    'cost_price' => 30,
                    'sale_price' => 35,
                    'description' => "Vinho tinto australiano Shiraz"
                ]);

                $produto2_fornecedor2_australia = $marca_australia2_2->produtos()->create([
                    'name' => 'Chardonnay',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.75,
                    'cost_price' => 28,
                    'sale_price' => 33,
                    'description' => "Vinho branco australiano Chardonnay"
                ]);

                // Produtos para a marca Bavarian Beers
                $produto1_fornecedor2_alemanha = $marca_alemanha_2->produtos()->create([
                    'name' => 'Weissbier',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.5,
                    'cost_price' => 25,
                    'sale_price' => 30,
                    'description' => "Cerveja de trigo alemã Weissbier"
                ]);

                $produto2_fornecedor2_alemanha = $marca_alemanha_2->produtos()->create([
                    'name' => 'Pilsner',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.5,
                    'cost_price' => 22,
                    'sale_price' => 27,
                    'description' => "Cerveja alemã Pilsner refrescante"
                ]);

                // Produtos para a marca Bavarian Beers
                $produto1_fornecedor2_alemanha = $marca_alemanha_2->produtos()->create([
                    'name' => 'Weissbier',
                    'tipo_produto_id' => 1,
                    'quantity' => 10,
                    'weight' => 0.5,
                    'cost_price' => 25,
                    'sale_price' => 30,
                    'description' => "Cerveja de trigo alemã Weissbier"
                ]);

                $produto2_fornecedor2_alemanha = $marca_alemanha_2->produtos()->create([
                    'name' => 'Pilsner',
                    'tipo_produto_id' => 1,
                    'quantity' => 8,
                    'weight' => 0.5,
                    'cost_price' => 22,
                    'sale_price' => 27,
                    'description' => "Cerveja alemã Pilsner refrescante"
                ]);


        //---

        Fornecedor::find(1)->marcas()->find(1)->produtos()->create([
            'name' => 'Pão de Queijo 90g',
            //'type' => 'Para Assar',
            'tipo_produto_id' => 1,
            'quantity' => 22,
            'weight' => 2,
            'cost_price' => 18,
            'sale_price' => 22

        ]);

        Fornecedor::find(2)->marcas()->find(3)->produtos()->create([
            'name' => 'Coxinha de Frango',
            //'type' => 'Para Fritar',
            'tipo_produto_id' => 2,
            'quantity' => 10,
            'weight' => 2,
            'cost_price' => 24,
            'sale_price' => 30

        ]);

        Administrador::create(['name' => 'Raphael Admin'])->user()->create([
            'email' => 'raphael@adminraphael.com', 'email_verified_at' => '2023-02-07 13:33:19
                ', 'password' => Hash::make('qwerasdf'), 'remember_token' => null,
            'created_at' => '2023-02-07 13:32:43', 'updated_at' => '2023-02-07 13:33:19'
        ]);

        Vendedor::create(['name' => 'Raphael Silva'])->user()->create([
            'email' => 'raphael@vendedor.com', 'email_verified_at' => '2020-02-07 13:33:19
            ', 'password' => Hash::make('qwerasdf'), 'remember_token' => null,
            'created_at' => '2020-02-07 13:32:43', 'updated_at' => '2020-02-07 13:33:19'
        ]);


        // Vendedor GPT
            // Vendedor 1 - Brasil
            $vendedor1_brasil = Vendedor::create(['name' => 'José Gomes']);
            $vendedor1_brasil->user()->create([
                'email' => 'jose@vendedor.com',
                'email_verified_at' => '2020-02-07 13:33:19',
                'password' => Hash::make('qwerasdf'),
                'remember_token' => null,
                'created_at' => '2020-02-07 13:32:43',
                'updated_at' => '2020-02-07 13:33:19'
            ]);
            $vendedor1_brasil->enderecos()->create([
                'name' => 'Casa',
                'street_name' => 'Avenida João Carlos',
                'cep' => 11740000,
                'house_number' => 228,
                'complement' => 'Perto da padaria',
                'bairro_id' => 192 // Suarão
            ]);

            // Vendedor 2 - Brasil
            $vendedor2_brasil = Vendedor::create(['name' => 'Maria Silva']);
            $vendedor2_brasil->user()->create([
                'email' => 'maria@vendedor.com',
                'email_verified_at' => '2020-02-07 13:33:19',
                'password' => Hash::make('qazxswedc'),
                'remember_token' => null,
                'created_at' => '2020-02-07 13:32:43',
                'updated_at' => '2020-02-07 13:33:19'
            ]);
            $vendedor2_brasil->enderecos()->create([
                'name' => 'Casa',
                'street_name' => 'Rua das Flores',
                'cep' => 11000000,
                'house_number' => 123,
                'complement' => 'Próximo à escola',
                'bairro_id' => 35 // São Benedito
            ]);

            // Vendedor 1 - Estados Unidos
            $vendedor1_usa = Vendedor::create(['name' => 'John Smith']);
            $vendedor1_usa->user()->create([
                'email' => 'john@vendedor.com',
                'email_verified_at' => '2020-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzlkj'),
                'remember_token' => null,
                'created_at' => '2020-02-07 13:32:43',
                'updated_at' => '2020-02-07 13:33:19'
            ]);
            $vendedor1_usa->enderecos()->create([
                'name' => 'Home',
                'street_name' => 'Main Street',
                'cep' => 90001,
                'house_number' => 456,
                'complement' => 'Near the park',
                'bairro_id' => 164 // South Congress
            ]);

            // Vendedor 2 - Estados Unidos
            $vendedor2_usa = Vendedor::create(['name' => 'Emily Johnson']);
            $vendedor2_usa->user()->create([
                'email' => 'emily@vendedor.com',
                'email_verified_at' => '2020-02-07 13:33:19',
                'password' => Hash::make('plmoknijb'),
                'remember_token' => null,
                'created_at' => '2020-02-07 13:32:43',
                'updated_at' => '2020-02-07 13:33:19'
            ]);
            $vendedor2_usa->enderecos()->create([
                'name' => 'Home',
                'street_name' => 'Elm Street',
                'cep' => 90210,
                'house_number' => 789,
                'complement' => 'Close to the mall',
                'bairro_id' => 153 // Hamilton South
            ]);


            // Vendedor 1 - França
            $vendedor1_franca = Vendedor::create(['name' => 'Jean Baptiste']);
            $vendedor1_franca->user()->create([
                'email' => 'jean@vendedor.com',
                'email_verified_at' => '2020-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2020-02-07 13:32:43',
                'updated_at' => '2020-02-07 13:33:19'
            ]);
            $vendedor1_franca->enderecos()->create([
                'name' => 'Maison',
                'street_name' => 'Rue de la Paix',
                'cep' => 75001,
                'house_number' => 10,
                'complement' => 'Près du marché',
                'bairro_id' => 117 // San Giuseppe
            ]);

            // Vendedor 2 - França
            $vendedor2_franca = Vendedor::create(['name' => 'Marie Leclerc']);
            $vendedor2_franca->user()->create([
                'email' => 'marie@vendedor.com',
                'email_verified_at' => '2020-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzlkj'),
                'remember_token' => null,
                'created_at' => '2020-02-07 13:32:43',
                'updated_at' => '2020-02-07 13:33:19'
            ]);
            $vendedor2_franca->enderecos()->create([
                'name' => 'Domicile',
                'street_name' => 'Avenue des Champs-Élysées',
                'cep' => 75008,
                'house_number' => 99,
                'complement' => 'Proche de la tour',
                'bairro_id' => 92 // Mompiano
            ]);


            // Vendedor 1 - Austrália
            $vendedor1_australia = Vendedor::create(['name' => 'Jack McKenzie']);
            $vendedor1_australia->user()->create([
                'email' => 'jack@vendedor.com',
                'email_verified_at' => '2020-02-07 13:33:19',
                'password' => Hash::make('qazxswedc'),
                'remember_token' => null,
                'created_at' => '2020-02-07 13:32:43',
                'updated_at' => '2020-02-07 13:33:19'
            ]);
            $vendedor1_australia->enderecos()->create([
                'name' => 'Home',
                'street_name' => 'Bondi Road',
                'cep' => 2026,
                'house_number' => 123,
                'complement' => 'Near the beach',
                'bairro_id' => 154 // Centro Storico
            ]);

            // Vendedor 2 - Austrália
            $vendedor2_australia = Vendedor::create(['name' => 'Olivia White']);
            $vendedor2_australia->user()->create([
                'email' => 'olivia@vendedor.com',
                'email_verified_at' => '2020-02-07 13:33:19',
                'password' => Hash::make('plmoknijb'),
                'remember_token' => null,
                'created_at' => '2020-02-07 13:32:43',
                'updated_at' => '2020-02-07 13:33:19'
            ]);
            $vendedor2_australia->enderecos()->create([
                'name' => 'Residence',
                'street_name' => 'Queen Street',
                'cep' => 3000,
                'house_number' => 456,
                'complement' => 'Close to the park',
                'bairro_id' => 156 // Southport
            ]);

            // Vendedor 1 - Alemanha
            $vendedor1_alemanha = Vendedor::create(['name' => 'Hans Müller']);
            $vendedor1_alemanha->user()->create([
                'email' => 'hans@vendedor.com',
                'email_verified_at' => '2020-02-07 13:33:19',
                'password' => Hash::make('qazxswedc'),
                'remember_token' => null,
                'created_at' => '2020-02-07 13:32:43',
                'updated_at' => '2020-02-07 13:33:19'
            ]);
            $vendedor1_alemanha->enderecos()->create([
                'name' => 'Zuhause',
                'street_name' => 'Königstraße',
                'cep' => 10115,
                'house_number' => 12,
                'complement' => 'In der Nähe des Parks',
                'bairro_id' => 101 // Lechviertel
            ]);

            // Vendedor 2 - Alemanha
            $vendedor2_alemanha = Vendedor::create(['name' => 'Anna Schmidt']);
            $vendedor2_alemanha->user()->create([
                'email' => 'anna@vendedor.com',
                'email_verified_at' => '2020-02-07 13:33:19',
                'password' => Hash::make('plmoknijb'),
                'remember_token' => null,
                'created_at' => '2020-02-07 13:32:43',
                'updated_at' => '2020-02-07 13:33:19'
            ]);
            $vendedor2_alemanha->enderecos()->create([
                'name' => 'Heim',
                'street_name' => 'Friedrichstraße',
                'cep' => 10117,
                'house_number' => 50,
                'complement' => 'In der Nähe des Marktes',
                'bairro_id' => 102 // Pfersee
            ]);


            // Vendedor 1 - Japão
            $vendedor1_japao = Vendedor::create(['name' => 'Takashi Yamamoto']);
            $vendedor1_japao->user()->create([
                'email' => 'takashi@vendedor.com',
                'email_verified_at' => '2020-02-07 13:33:19',
                'password' => Hash::make('asdfghjkl'),
                'remember_token' => null,
                'created_at' => '2020-02-07 13:32:43',
                'updated_at' => '2020-02-07 13:33:19'
            ]);
            $vendedor1_japao->enderecos()->create([
                'name' => '自宅',
                'street_name' => '新宿通り',
                'cep' => '1600022',
                'house_number' => 8,
                'complement' => '公園の近く',
                'bairro_id' => 76 // Shinjuku
            ]);

            // Vendedor 2 - Japão
            $vendedor2_japao = Vendedor::create(['name' => 'Emi Sato']);
            $vendedor2_japao->user()->create([
                'email' => 'emi@vendedor.com',
                'email_verified_at' => '2020-02-07 13:33:19',
                'password' => Hash::make('zxcvbnm'),
                'remember_token' => null,
                'created_at' => '2020-02-07 13:32:43',
                'updated_at' => '2020-02-07 13:33:19'
            ]);
            $vendedor2_japao->enderecos()->create([
                'name' => '自宅',
                'street_name' => '渋谷通り',
                'cep' => '1500041',
                'house_number' => 20,
                'complement' => '駅の近く',
                'bairro_id' => 77 // Shibuya
            ]);
        //---

        // CLiente GPT
            $cliente0 = Cliente::create([
                'name' => 'Felipe Soares',
                'company_name' => 'Lanchonete pimavera',
                'cnpj' => 12345678901234, //somente numeros
                'vendedor_id' => 1
            ]);
            $cliente0->user()->create([
                'email' => 'raphael@cliente.com', // manter o dominio cliente.com
                'email_verified_at' => '2023-02-07 13:33:19', // manter igual
                'password' => Hash::make('qwerasdf'), // manter igual
                'remember_token' => null, // manter igual
                'created_at' => '2023-02-07 13:32:43', // manter igual
                'updated_at' => '2023-02-07 13:33:19' // manter igual
            ]);
            $cliente0->enderecos()->create([
                'name' => 'Casa',
                'street_name' => 'Rua Bahia',
                'cep' => 11740000, // somente numeros
                'house_number' => 100,
                'complement' => 'Casa',
                'bairro_id' => 1
            ]);
            $cliente0->telefones()->create(['number_phone' => '(13)91234-5678']);



            // Cliente 1 - Vendedor 2
            $cliente1_vendedor2 = Cliente::create([
                'name' => 'Mariana Oliveira',
                'company_name' => 'Restaurante Sabores',
                'cnpj' => 98765432109876,
                'vendedor_id' => 2
            ]);
            $cliente1_vendedor2->user()->create([
                'email' => 'jose@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnm'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente1_vendedor2->enderecos()->create([
                'name' => 'Residência',
                'street_name' => 'Avenida das Flores',
                'cep' => 11000000,
                'house_number' => 150,
                'complement' => 'Apartamento 301',
                'bairro_id' => 3
            ]);
            $cliente1_vendedor2->telefones()->create(['number_phone' => '(11)98765-4321']);

            // Cliente 1 - Vendedor 3
            $cliente1_vendedor3 = Cliente::create([
                'name' => 'Carlos Almeida',
                'company_name' => 'Supermercado Bom Preço',
                'cnpj' => 54321678901234,
                'vendedor_id' => 3
            ]);
            $cliente1_vendedor3->user()->create([
                'email' => 'maria@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('yhnjui'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente1_vendedor3->enderecos()->create([
                'name' => 'Casa',
                'street_name' => 'Rua das Palmeiras',
                'cep' => 12230000,
                'house_number' => 500,
                'complement' => 'Sobrado',
                'bairro_id' => 5
            ]);
            $cliente1_vendedor3->telefones()->create(['number_phone' => '(12)98765-4321']);

            // Cliente 1 - Vendedor 4
            $cliente1_vendedor4 = Cliente::create([
                'name' => 'Sophie Martin',
                'company_name' => 'Boutique Elegance',
                'cnpj' => 87654321098765,
                'vendedor_id' => 4
            ]);
            $cliente1_vendedor4->user()->create([
                'email' => 'john@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('bvcxznm'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente1_vendedor4->enderecos()->create([
                'name' => 'Residence',
                'street_name' => 'King Street',
                'cep' => 3000,
                'house_number' => 123,
                'complement' => 'Apartment 501',
                'bairro_id' => 9
            ]);
            $cliente1_vendedor4->telefones()->create(['number_phone' => '(30)12345-6789']);

            // Cliente 2 - Vendedor 1
            $cliente2_vendedor1 = Cliente::create([
                'name' => 'Amanda Ferreira',
                'company_name' => 'Loja de Decorações Encanto',
                'cnpj' => 23456789012345,
                'vendedor_id' => 1
            ]);
            $cliente2_vendedor1->user()->create([
                'email' => 'amanda@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('hgfdsaqwe'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente2_vendedor1->enderecos()->create([
                'name' => 'Residência',
                'street_name' => 'Rua das Flores',
                'cep' => 11720000,
                'house_number' => 50,
                'complement' => 'Casa 2',
                'bairro_id' => 2
            ]);
            $cliente2_vendedor1->telefones()->create(['number_phone' => '(13)98765-4321']);

            // Cliente 3 - Vendedor 1
            $cliente3_vendedor1 = Cliente::create([
                'name' => 'Lucas Oliveira',
                'company_name' => 'Oficina Mecânica Veloz',
                'cnpj' => 34567890123456,
                'vendedor_id' => 1
            ]);
            $cliente3_vendedor1->user()->create([
                'email' => 'lucas2@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytre'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente3_vendedor1->enderecos()->create([
                'name' => 'Oficina',
                'street_name' => 'Avenida Brasil',
                'cep' => 11730000,
                'house_number' => 100,
                'complement' => 'Galpão 3',
                'bairro_id' => 3
            ]);
            $cliente3_vendedor1->telefones()->create(['number_phone' => '(13)87654-3210']);

            // Cliente 4 - Vendedor 1
            $cliente4_vendedor1 = Cliente::create([
                'name' => 'Patrícia Souza',
                'company_name' => 'Salão de Beleza Glamour',
                'cnpj' => 45678901234567,
                'vendedor_id' => 1
            ]);
            $cliente4_vendedor1->user()->create([
                'email' => 'patricia@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzasd'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente4_vendedor1->enderecos()->create([
                'name' => 'Salão',
                'street_name' => 'Rua das Vaidades',
                'cep' => 11740000,
                'house_number' => 25,
                'complement' => 'Sala 1',
                'bairro_id' => 4
            ]);
            $cliente4_vendedor1->telefones()->create(['number_phone' => '(13)76543-2109']);

            // Cliente 2 - Vendedor 2
            $cliente2_vendedor2 = Cliente::create([
                'name' => 'Fernanda Silva',
                'company_name' => 'Padaria Delícias do Trigo',
                'cnpj' => 34567890123456,
                'vendedor_id' => 2
            ]);
            $cliente2_vendedor2->user()->create([
                'email' => 'fernanda@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzasd'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente2_vendedor2->enderecos()->create([
                'name' => 'Padaria',
                'street_name' => 'Avenida Central',
                'cep' => 11000000,
                'house_number' => 150,
                'complement' => 'Loja 1',
                'bairro_id' => 5
            ]);
            $cliente2_vendedor2->telefones()->create(['number_phone' => '(11)98765-4321']);

            // Cliente 3 - Vendedor 2
            $cliente3_vendedor2 = Cliente::create([
                'name' => 'Gustavo Santos',
                'company_name' => 'Loja de Eletrônicos TechHouse',
                'cnpj' => 45678901234567,
                'vendedor_id' => 2
            ]);
            $cliente3_vendedor2->user()->create([
                'email' => 'gustavo@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnmlkjh'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente3_vendedor2->enderecos()->create([
                'name' => 'Loja',
                'street_name' => 'Rua dos Eletrônicos',
                'cep' => 11010000,
                'house_number' => 80,
                'complement' => 'Sala 3',
                'bairro_id' => 6
            ]);
            $cliente3_vendedor2->telefones()->create(['number_phone' => '(11)87654-3210']);

            // Cliente 4 - Vendedor 2
            $cliente4_vendedor2 = Cliente::create([
                'name' => 'Larissa Mendes',
                'company_name' => 'Restaurante Sabor Caseiro',
                'cnpj' => 56789012345678,
                'vendedor_id' => 2
            ]);
            $cliente4_vendedor2->user()->create([
                'email' => 'larissa@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente4_vendedor2->enderecos()->create([
                'name' => 'Restaurante',
                'street_name' => 'Avenida dos Sabores',
                'cep' => 11020000,
                'house_number' => 200,
                'complement' => 'Cozinha 2',
                'bairro_id' => 7
            ]);
            $cliente4_vendedor2->telefones()->create(['number_phone' => '(11)76543-2109']);

            // Cliente 2 - Vendedor 3
            $cliente2_vendedor3 = Cliente::create([
                'name' => 'Pedro Oliveira',
                'company_name' => 'Loja de Informática TechZone',
                'cnpj' => 78901234567890,
                'vendedor_id' => 3
            ]);
            $cliente2_vendedor3->user()->create([
                'email' => 'pedro@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzlkjh'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente2_vendedor3->enderecos()->create([
                'name' => 'Loja',
                'street_name' => 'Rua da Tecnologia',
                'cep' => 12240000,
                'house_number' => 300,
                'complement' => 'Sala 2',
                'bairro_id' => 8
            ]);
            $cliente2_vendedor3->telefones()->create(['number_phone' => '(12)76543-2109']);

            // Cliente 3 - Vendedor 3
            $cliente3_vendedor3 = Cliente::create([
                'name' => 'Camila Santos',
                'company_name' => 'Mercado Econômico',
                'cnpj' => 89012345678901,
                'vendedor_id' => 3
            ]);
            $cliente3_vendedor3->user()->create([
                'email' => 'camila@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente3_vendedor3->enderecos()->create([
                'name' => 'Mercado',
                'street_name' => 'Avenida das Ofertas',
                'cep' => 12250000,
                'house_number' => 400,
                'complement' => 'Setor de Alimentos',
                'bairro_id' => 9
            ]);
            $cliente3_vendedor3->telefones()->create(['number_phone' => '(12)65432-1098']);

            // Cliente 4 - Vendedor 3
            $cliente4_vendedor3 = Cliente::create([
                'name' => 'Rafaela Silva',
                'company_name' => 'Pet Shop Amigo Fiel',
                'cnpj' => 90123456789012,
                'vendedor_id' => 3
            ]);
            $cliente4_vendedor3->user()->create([
                'email' => 'rafaela@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnmlkj'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente4_vendedor3->enderecos()->create([
                'name' => 'Pet Shop',
                'street_name' => 'Rua dos Animais',
                'cep' => 12260000,
                'house_number' => 500,
                'complement' => 'Loja 3',
                'bairro_id' => 10
            ]);
            $cliente4_vendedor3->telefones()->create(['number_phone' => '(12)54321-0987']);

            // Cliente 2 - Vendedor 4
            $cliente2_vendedor4 = Cliente::create([
                'name' => 'Roberto Costa',
                'company_name' => 'Loja de Vestuário FashionStyle',
                'cnpj' => 12345678901234,
                'vendedor_id' => 4
            ]);
            $cliente2_vendedor4->user()->create([
                'email' => 'roberto@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente2_vendedor4->enderecos()->create([
                'name' => 'Loja',
                'street_name' => 'Rua da Moda',
                'cep' => 13000000,
                'house_number' => 600,
                'complement' => 'Loja 5',
                'bairro_id' => 11
            ]);
            $cliente2_vendedor4->telefones()->create(['number_phone' => '(13)54321-0987']);

            // Cliente 3 - Vendedor 4
            $cliente3_vendedor4 = Cliente::create([
                'name' => 'Carolina Oliveira',
                'company_name' => 'Distribuidora de Bebidas Beba Bem',
                'cnpj' => 23456789012345,
                'vendedor_id' => 4
            ]);
            $cliente3_vendedor4->user()->create([
                'email' => 'carolina@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnmlkj'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente3_vendedor4->enderecos()->create([
                'name' => 'Distribuidora',
                'street_name' => 'Avenida das Bebidas',
                'cep' => 13010000,
                'house_number' => 700,
                'complement' => 'Depósito 2',
                'bairro_id' => 12
            ]);
            $cliente3_vendedor4->telefones()->create(['number_phone' => '(13)65432-1098']);

            // Cliente 4 - Vendedor 4
            $cliente4_vendedor4 = Cliente::create([
                'name' => 'Daniel Souza',
                'company_name' => 'Loja de Ferramentas Ferramix',
                'cnpj' => 34567890123456,
                'vendedor_id' => 4
            ]);
            $cliente4_vendedor4->user()->create([
                'email' => 'daniel@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzasd'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente4_vendedor4->enderecos()->create([
                'name' => 'Loja',
                'street_name' => 'Rua das Ferramentas',
                'cep' => 13020000,
                'house_number' => 800,
                'complement' => 'Setor 3',
                'bairro_id' => 13
            ]);
            $cliente4_vendedor4->telefones()->create(['number_phone' => '(13)76543-2109']);

            // Cliente 2 - Vendedor 5
            $cliente2_vendedor5 = Cliente::create([
                'name' => 'Lucas Ferreira',
                'company_name' => 'Concessionária AutoMundo',
                'cnpj' => 45678901234567,
                'vendedor_id' => 5
            ]);
            $cliente2_vendedor5->user()->create([
                'email' => 'lucas3@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente2_vendedor5->enderecos()->create([
                'name' => 'Concessionária',
                'street_name' => 'Avenida dos Carros',
                'cep' => 14000000,
                'house_number' => 900,
                'complement' => 'Sala de Exposições',
                'bairro_id' => 14
            ]);
            $cliente2_vendedor5->telefones()->create(['number_phone' => '(14)54321-0987']);

            // Cliente 3 - Vendedor 5
            $cliente3_vendedor5 = Cliente::create([
                'name' => 'Juliana Mendonça',
                'company_name' => 'Salão de Beleza Charme e Estilo',
                'cnpj' => 56789012345678,
                'vendedor_id' => 5
            ]);
            $cliente3_vendedor5->user()->create([
                'email' => 'juliana@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnmlkj'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente3_vendedor5->enderecos()->create([
                'name' => 'Salão de Beleza',
                'street_name' => 'Rua da Beleza',
                'cep' => 14010000,
                'house_number' => 1000,
                'complement' => 'Sala 2',
                'bairro_id' => 15
            ]);
            $cliente3_vendedor5->telefones()->create(['number_phone' => '(14)65432-1098']);

            // Cliente 4 - Vendedor 5
            $cliente4_vendedor5 = Cliente::create([
                'name' => 'Fabiana Almeida',
                'company_name' => 'Loja de Flores Florescer',
                'cnpj' => 67890123456789,
                'vendedor_id' => 5
            ]);
            $cliente4_vendedor5->user()->create([
                'email' => 'fabiana@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzasd'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente4_vendedor5->enderecos()->create([
                'name' => 'Loja',
                'street_name' => 'Avenida das Flores',
                'cep' => 14020000,
                'house_number' => 1100,
                'complement' => 'Loja 3',
                'bairro_id' => 16
            ]);
            $cliente4_vendedor5->telefones()->create(['number_phone' => '(14)76543-2109']);


            // Cliente 2 - Vendedor 6
            $cliente2_vendedor6 = Cliente::create([
                'name' => 'Sophie Dubois',
                'company_name' => 'Boulangerie du Matin',
                'cnpj' => 78901234567890,
                'vendedor_id' => 6
            ]);
            $cliente2_vendedor6->user()->create([
                'email' => 'sophie2@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente2_vendedor6->enderecos()->create([
                'name' => 'Padaria',
                'street_name' => 'Rue de la Boulangerie',
                'cep' => 15000000,
                'house_number' => 1200,
                'complement' => 'Bâtiment A',
                'bairro_id' => 17
            ]);
            $cliente2_vendedor6->telefones()->create(['number_phone' => '(15)54321-0987']);

            // Cliente 3 - Vendedor 6
            $cliente3_vendedor6 = Cliente::create([
                'name' => 'Antoine Dupont',
                'company_name' => 'Café de Paris',
                'cnpj' => 89012345678901,
                'vendedor_id' => 6
            ]);
            $cliente3_vendedor6->user()->create([
                'email' => 'antoine@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnmlkj'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente3_vendedor6->enderecos()->create([
                'name' => 'Café',
                'street_name' => 'Rue de la Croissant',
                'cep' => 15010000,
                'house_number' => 1300,
                'complement' => 'Unité B',
                'bairro_id' => 18
            ]);
            $cliente3_vendedor6->telefones()->create(['number_phone' => '(15)65432-1098']);

            // Cliente 4 - Vendedor 6
            $cliente4_vendedor6 = Cliente::create([
                'name' => 'Amélie Martin',
                'company_name' => 'Librairie de Quartier',
                'cnpj' => 90123456789012,
                'vendedor_id' => 6
            ]);
            $cliente4_vendedor6->user()->create([
                'email' => 'amelie@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzasd'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente4_vendedor6->enderecos()->create([
                'name' => 'Livraria',
                'street_name' => 'Rue de la Lecture',
                'cep' => 15020000,
                'house_number' => 1400,
                'complement' => 'Bâtiment C',
                'bairro_id' => 19
            ]);
            $cliente4_vendedor6->telefones()->create(['number_phone' => '(15)76543-2109']);

            // Cliente 2 - Vendedor 7
            $cliente2_vendedor7 = Cliente::create([
                'name' => 'Émilie Lefèvre',
                'company_name' => 'Boulangerie de Paris',
                'cnpj' => 90123456789012,
                'vendedor_id' => 7
            ]);
            $cliente2_vendedor7->user()->create([
                'email' => 'emilie@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente2_vendedor7->enderecos()->create([
                'name' => 'Padaria',
                'street_name' => 'Rue de la Baguette',
                'cep' => 16000000,
                'house_number' => 1500,
                'complement' => 'Magasin A',
                'bairro_id' => 20
            ]);
            $cliente2_vendedor7->telefones()->create(['number_phone' => '(16)54321-0987']);

            // Cliente 3 - Vendedor 7
            $cliente3_vendedor7 = Cliente::create([
                'name' => 'Sophie Moreau',
                'company_name' => 'Pâtisserie de Lyon',
                'cnpj' => 12345678901234,
                'vendedor_id' => 7
            ]);
            $cliente3_vendedor7->user()->create([
                'email' => 'sophie3@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnmlkj'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente3_vendedor7->enderecos()->create([
                'name' => 'Confeitaria',
                'street_name' => 'Rue des Gâteaux',
                'cep' => 16010000,
                'house_number' => 1600,
                'complement' => 'Unité B',
                'bairro_id' => 21
            ]);
            $cliente3_vendedor7->telefones()->create(['number_phone' => '(16)65432-1098']);

            // Cliente 4 - Vendedor 7
            $cliente4_vendedor7 = Cliente::create([
                'name' => 'Claire Martin',
                'company_name' => 'Librairie de Quartier',
                'cnpj' => 23456789012345,
                'vendedor_id' => 7
            ]);
            $cliente4_vendedor7->user()->create([
                'email' => 'claire@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzasd'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente4_vendedor7->enderecos()->create([
                'name' => 'Livraria',
                'street_name' => 'Rue de la Lecture',
                'cep' => 16020000,
                'house_number' => 1700,
                'complement' => 'Bâtiment C',
                'bairro_id' => 22
            ]);
            $cliente4_vendedor7->telefones()->create(['number_phone' => '(16)76543-2109']);

            // Cliente 2 - Vendedor 8
            $cliente2_vendedor8 = Cliente::create([
                'name' => 'Emma Wilson',
                'company_name' => 'Wilsons Pet Shop',
                'cnpj' => 34567890123456,
                'vendedor_id' => 8
            ]);
            $cliente2_vendedor8->user()->create([
                'email' => 'emma2@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente2_vendedor8->enderecos()->create([
                'name' => 'Pet Shop',
                'street_name' => 'Main Street',
                'cep' => 17000000,
                'house_number' => 1800,
                'complement' => 'Unit A',
                'bairro_id' => 23
            ]);
            $cliente2_vendedor8->telefones()->create(['number_phone' => '(17)54321-0987']);

            // Cliente 3 - Vendedor 8
            $cliente3_vendedor8 = Cliente::create([
                'name' => 'Oscar Harris',
                'company_name' => 'Harris Photography',
                'cnpj' => 45678901234567,
                'vendedor_id' => 8
            ]);
            $cliente3_vendedor8->user()->create([
                'email' => 'oscar@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnmlkj'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente3_vendedor8->enderecos()->create([
                'name' => 'Photography Studio',
                'street_name' => 'Oak Avenue',
                'cep' => 17010000,
                'house_number' => 1900,
                'complement' => 'Suite B',
                'bairro_id' => 24
            ]);
            $cliente3_vendedor8->telefones()->create(['number_phone' => '(17)65432-1098']);

            // Cliente 4 - Vendedor 8
            $cliente4_vendedor8 = Cliente::create([
                'name' => 'Oliver Butler',
                'company_name' => 'Butlers Bakery',
                'cnpj' => 56789012345678,
                'vendedor_id' => 8
            ]);
            $cliente4_vendedor8->user()->create([
                'email' => 'oliver@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzasd'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $cliente4_vendedor8->enderecos()->create([
                'name' => 'Bakery',
                'street_name' => 'Birch Street',
                'cep' => 17020000,
                'house_number' => 2000,
                'complement' => 'Shop C',
                'bairro_id' => 25
            ]);
            $cliente4_vendedor8->telefones()->create(['number_phone' => '(17)76543-2109']);

            // Cliente 2 - Vendedor 9
            $cliente2_vendedor9 = Cliente::create([
                'name' => 'Isabella Scott',
                'company_name' => 'Scott Veterinary Clinic',
                'cnpj' => 67890123456789,
                'vendedor_id' => 9
            ]);
            $cliente2_vendedor9->user()->create([
                'email' => 'isabella@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente2_vendedor9 = $cliente2_vendedor9->enderecos()->create([
                'name' => 'Veterinary Clinic',
                'street_name' => 'Elm Street',
                'cep' => 18000000,
                'house_number' => 2100,
                'complement' => 'Suite A',
                'bairro_id' => 26,
                'latitude' => -23.55052, // Exemplo de latitude
                'longitude' => -46.633308 // Exemplo de longitude
            ]);
            $cliente2_vendedor9->telefones()->create(['number_phone' => '(18)54321-0987']);

            // Cliente 3 - Vendedor 9
            $cliente3_vendedor9 = Cliente::create([
                'name' => 'Ethan Evans',
                'company_name' => 'Evans IT Solutions',
                'cnpj' => 78901234567890,
                'vendedor_id' => 9
            ]);
            $cliente3_vendedor9->user()->create([
                'email' => 'ethan@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnmlkj'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente3_vendedor9 = $cliente3_vendedor9->enderecos()->create([
                'name' => 'IT Solutions',
                'street_name' => 'Maple Avenue',
                'cep' => 18010000,
                'house_number' => 2200,
                'complement' => 'Office B',
                'bairro_id' => 27,
                'latitude' => -23.55052, // Exemplo de latitude
                'longitude' => -46.633308 // Exemplo de longitude
            ]);
            $cliente3_vendedor9->telefones()->create(['number_phone' => '(18)65432-1098']);

            // Cliente 4 - Vendedor 9
            $cliente4_vendedor9 = Cliente::create([
                'name' => 'Ava Taylor',
                'company_name' => 'Taylor Fashion Boutique',
                'cnpj' => 89012345678901,
                'vendedor_id' => 9
            ]);
            $cliente4_vendedor9->user()->create([
                'email' => 'ava@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzasd'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente4_vendedor9 = $cliente4_vendedor9->enderecos()->create([
                'name' => 'Fashion Boutique',
                'street_name' => 'Cedar Road',
                'cep' => 18020000,
                'house_number' => 2300,
                'complement' => 'Shop C',
                'bairro_id' => 28,
                'latitude' => -23.55052, // Exemplo de latitude
                'longitude' => -46.633308 // Exemplo de longitude
            ]);
            $cliente4_vendedor9->telefones()->create(['number_phone' => '(18)76543-2109']);

            // Cliente 2 - Vendedor 10
            $cliente2_vendedor10 = Cliente::create([
                'name' => 'Sophia Brown',
                'company_name' => 'Browns Bookstore',
                'cnpj' => 12345678901234,
                'vendedor_id' => 10
            ]);
            $cliente2_vendedor10->user()->create([
                'email' => 'sophia@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente2_vendedor10 = $cliente2_vendedor10->enderecos()->create([
                'name' => 'Bookstore',
                'street_name' => 'Main Street',
                'cep' => 19000000,
                'house_number' => 2400,
                'complement' => 'Unit A',
                'bairro_id' => 29,
                'latitude' => -23.55052, // Exemplo de latitude
                'longitude' => -46.633308 // Exemplo de longitude
            ]);
            $cliente2_vendedor10->telefones()->create(['number_phone' => '(19)54321-0987']);

            // Cliente 3 - Vendedor 10
            $cliente3_vendedor10 = Cliente::create([
                'name' => 'Lucas Rodriguez',
                'company_name' => 'Rodriguez Tech Solutions',
                'cnpj' => 23456789012345,
                'vendedor_id' => 10
            ]);
            $cliente3_vendedor10->user()->create([
                'email' => 'lucas4@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnmlkj'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente3_vendedor10 = $cliente3_vendedor10->enderecos()->create([
                'name' => 'Tech Solutions',
                'street_name' => 'Oak Avenue',
                'cep' => 19010000,
                'house_number' => 2500,
                'complement' => 'Suite B',
                'bairro_id' => 30,
                'latitude' => -23.55052, // Exemplo de latitude
                'longitude' => -46.633308 // Exemplo de longitude
            ]);
            $cliente3_vendedor10->telefones()->create(['number_phone' => '(19)65432-1098']);

            // Cliente 4 - Vendedor 10
            $cliente4_vendedor10 = Cliente::create([
                'name' => 'Luna Martinez',
                'company_name' => 'Martinez Art Gallery',
                'cnpj' => 34567890123456,
                'vendedor_id' => 10
            ]);
            $cliente4_vendedor10->user()->create([
                'email' => 'luna@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzasd'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente4_vendedor10 = $cliente4_vendedor10->enderecos()->create([
                'name' => 'Art Gallery',
                'street_name' => 'Cedar Road',
                'cep' => 19020000,
                'house_number' => 2600,
                'complement' => 'Shop C',
                'bairro_id' => 31,
                'latitude' => -23.55052, // Exemplo de latitude
                'longitude' => -46.633308 // Exemplo de longitude
            ]);
            $cliente4_vendedor10->telefones()->create(['number_phone' => '(19)76543-2109']);

            // Cliente 2 - Vendedor 11
            $cliente2_vendedor11 = Cliente::create([
                'name' => 'Emma Fischer',
                'company_name' => 'Fischers Bakery',
                'cnpj' => 45678901234567,
                'vendedor_id' => 11
            ]);
            $cliente2_vendedor11->user()->create([
                'email' => 'emma3@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente2_vendedor11 = $cliente2_vendedor11->enderecos()->create([
                'name' => 'Bakery',
                'street_name' => 'Maple Street',
                'cep' => 20000000,
                'house_number' => 2700,
                'complement' => 'Unit A',
                'bairro_id' => 32,
                'latitude' => -23.55052, // Exemplo de latitude
                'longitude' => -46.633308 // Exemplo de longitude
            ]);
            $cliente2_vendedor11->telefones()->create(['number_phone' => '(20)54321-0987']);

            // Cliente 3 - Vendedor 11
            $cliente3_vendedor11 = Cliente::create([
                'name' => 'Liam Richter',
                'company_name' => 'Richter Motors',
                'cnpj' => 56789012345678,
                'vendedor_id' => 11
            ]);
            $cliente3_vendedor11->user()->create([
                'email' => 'liam@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnmlkj'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente3_vendedor11 = $cliente3_vendedor11->enderecos()->create([
                'name' => 'Motors',
                'street_name' => 'Oak Avenue',
                'cep' => 20010000,
                'house_number' => 2800,
                'complement' => 'Office B',
                'bairro_id' => 33,
                'latitude' => -23.55052, // Exemplo de latitude
                'longitude' => -46.633308 // Exemplo de longitude
            ]);
            $cliente3_vendedor11->telefones()->create(['number_phone' => '(20)65432-1098']);

            // Cliente 4 - Vendedor 11
            $cliente4_vendedor11 = Cliente::create([
                'name' => 'Mia Wagner',
                'company_name' => 'Wagner Fashion Store',
                'cnpj' => 67890123456789,
                'vendedor_id' => 11
            ]);
            $cliente4_vendedor11->user()->create([
                'email' => 'mia@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzasd'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente4_vendedor11 = $cliente4_vendedor11->enderecos()->create([
                'name' => 'Fashion Store',
                'street_name' => 'Cedar Road',
                'cep' => 20020000,
                'house_number' => 2900,
                'complement' => 'Shop C',
                'bairro_id' => 34,
                'latitude' => -23.55052, // Exemplo de latitude
                'longitude' => -46.633308 // Exemplo de longitude
            ]);
            $cliente4_vendedor11->telefones()->create(['number_phone' => '(20)76543-2109']);

            // Cliente 2 - Vendedor 12
            $cliente2_vendedor12 = Cliente::create([
                'name' => 'Haruto Saito',
                'company_name' => 'Saito Electronics',
                'cnpj' => 78901234567890,
                'vendedor_id' => 12
            ]);
            $cliente2_vendedor12->user()->create([
                'email' => 'haruto@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente2_vendedor12 = $cliente2_vendedor12->enderecos()->create([
                'name' => 'Electronics Store',
                'street_name' => 'Elm Street',
                'cep' => 21000000,
                'house_number' => 3000,
                'complement' => 'Unit A',
                'bairro_id' => 35,
                'latitude' => -23.55052, // Exemplo de latitude
                'longitude' => -46.633308 // Exemplo de longitude
            ]);
            $cliente2_vendedor12->telefones()->create(['number_phone' => '(21)54321-0987']);

            // Cliente 3 - Vendedor 12
            $cliente3_vendedor12 = Cliente::create([
                'name' => 'Rin Takahashi',
                'company_name' => 'Takahashi Tea House',
                'cnpj' => 89012345678901,
                'vendedor_id' => 12
            ]);
            $cliente3_vendedor12->user()->create([
                'email' => 'rin@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnmlkj'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente3_vendedor12 = $cliente3_vendedor12->enderecos()->create([
                'name' => 'Tea House',
                'street_name' => 'Oak Avenue',
                'cep' => 21010000,
                'house_number' => 3100,
                'complement' => 'Suite B',
                'bairro_id' => 36,
                'latitude' => -23.55052, // Exemplo de latitude
                'longitude' => -46.633308 // Exemplo de longitude
            ]);
            $cliente3_vendedor12->telefones()->create(['number_phone' => '(21)65432-1098']);

            // Cliente 4 - Vendedor 12
            $cliente4_vendedor12 = Cliente::create([
                'name' => 'Yuna Tanaka',
                'company_name' => 'Tanaka Art Gallery',
                'cnpj' => 90123456789012,
                'vendedor_id' => 12
            ]);
            $cliente4_vendedor12->user()->create([
                'email' => 'yuna@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzasd'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente4_vendedor12 = $cliente4_vendedor12->enderecos()->create([
                'name' => 'Art Gallery',
                'street_name' => 'Cedar Road',
                'cep' => 21020000,
                'house_number' => 3200,
                'complement' => 'Shop C',
                'bairro_id' => 37,
                'latitude' => -23.55052, // Exemplo de latitude
                'longitude' => -46.633308 // Exemplo de longitude
            ]);
            $cliente4_vendedor12->telefones()->create(['number_phone' => '(21)76543-2109']);

            // Cliente 2 - Vendedor 13
            $cliente2_vendedor13 = Cliente::create([
                'name' => 'Hiroshi Nakamura',
                'company_name' => 'Nakamura Sushi Bar',
                'cnpj' => 12345678901234,
                'vendedor_id' => 13
            ]);
            $cliente2_vendedor13->user()->create([
                'email' => 'hiroshi@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('poiuytrewq'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente2_vendedor13 = $cliente2_vendedor13->enderecos()->create([
                'name' => 'Sushi Bar',
                'street_name' => 'Sakura Avenue',
                'cep' => 22000000,
                'house_number' => 3500,
                'complement' => 'Unit A',
                'bairro_id' => 38,
                'latitude' => 35.6895, // Exemplo de latitude
                'longitude' => 139.6917 // Exemplo de longitude
            ]);
            $cliente2_vendedor13->telefones()->create(['number_phone' => '(22)54321-0987']);

            // Cliente 3 - Vendedor 13
            $cliente3_vendedor13 = Cliente::create([
                'name' => 'Yui Tanaka',
                'company_name' => 'Tanaka Bookstore',
                'cnpj' => 23456789012345,
                'vendedor_id' => 13
            ]);
            $cliente3_vendedor13->user()->create([
                'email' => 'yui@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('zxcvbnmlkj'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente3_vendedor13 = $cliente3_vendedor13->enderecos()->create([
                'name' => 'Bookstore',
                'street_name' => 'Cherry Blossom Street',
                'cep' => 22010000,
                'house_number' => 3600,
                'complement' => 'Suite B',
                'bairro_id' => 39,
                'latitude' => 35.6895, // Exemplo de latitude
                'longitude' => 139.6917 // Exemplo de longitude
            ]);
            $cliente3_vendedor13->telefones()->create(['number_phone' => '(22)65432-1098']);

            // Cliente 4 - Vendedor 13
            $cliente4_vendedor13 = Cliente::create([
                'name' => 'Riku Yamada',
                'company_name' => 'Yamada Flower Shop',
                'cnpj' => 34567890123456,
                'vendedor_id' => 13
            ]);
            $cliente4_vendedor13->user()->create([
                'email' => 'riku@cliente.com',
                'email_verified_at' => '2023-02-07 13:33:19',
                'password' => Hash::make('mnbvcxzasd'),
                'remember_token' => null,
                'created_at' => '2023-02-07 13:32:43',
                'updated_at' => '2023-02-07 13:33:19'
            ]);
            $endereco_cliente4_vendedor13 = $cliente4_vendedor13->enderecos()->create([
                'name' => 'Flower Shop',
                'street_name' => 'Blossom Lane',
                'cep' => 22020000,
                'house_number' => 3700,
                'complement' => 'Shop C',
                'bairro_id' => 40,
                'latitude' => 35.6895, // Exemplo de latitude
                'longitude' => 139.6917 // Exemplo de longitude
            ]);
            $cliente4_vendedor13->telefones()->create(['number_phone' => '(22)76543-2109']);



        //---

        /*Cliente::create([ 'name' => 'Rodolfo CLiente' , 'company_name' => 'Bar joia','cnpj' => 1234567893, 'vendedor_id' => 1])->user()->create(['email'=>'raphael@clienteraphael.com','email_verified_at'=> '2023-02-07 13:33:19
            ' , 'password'=>Hash::make('qwerasdf'), 'remember_token' => null,
            'created_at'=>'2023-02-07 13:32:43', 'updated_at'=>'2023-02-07 13:33:19']);*/

        $cliente1 = Cliente::create(['name' => 'Rodolfo Clino', 'company_name' => 'Bar joia', 'cnpj' => 1234567893, 'vendedor_id' => 1]);
        $cliente1->user()->create([
            'email' => 'raphael@clienteraphael.com', 'email_verified_at' => '2023-02-07 13:33:19
        ', 'password' => Hash::make('qwerasdf'), 'remember_token' => null,
            'created_at' => '2023-02-07 13:32:43', 'updated_at' => '2023-02-07 13:33:19'
        ]);
        $cliente1->enderecos()->create(['name' => 'Casa 1', 'street_name' => 'Rua Bahia', 'cep' => 11740000, 'house_number' => 10, 'complement' => 'Casa', 'bairro_id' => 1]);
        $cliente1->enderecos()->create(['name' => 'Casa 2', 'street_name' => 'Rua Alexandre', 'cep' => 11740000, 'house_number' => 10, 'complement' => 'Casa', 'bairro_id' => 3]);
        $cliente1->telefones()->create(['number_phone' => '(13)3426-5255']);
        $cliente1->telefones()->create(['number_phone' => '(13)91234-5678']);

        $cliente1->pedidos()->create([
            'payday' => '2023-02-09 13:33:19', // entre 2021-01 até 2023-06, data deve ser superior a approval_date
            'delivery_date' => '2023-02-08 13:33:19', // entre 2021-01 até 2023-06, data deve ser superior a approval_date
            'approval_date' => '2023-02-08 13:33:19', // entre 2021-01 até 2023-06
            'total_price' => 52, // valor total dos produtos adquiridos
            'total_discount' => 0, // não deve ser maior que o valor total
            'metodo_pagamento_id' => 1, // valor de 1 a 6
            'observation' => 'Tudo entregue junto', // qualquer informação relevante ao pedido
            'vendedor_id' => 1,
            'endereco_id' => 3
        ])->produtos()->attach([
            1 /* id do produto */ => ['qty_item' => 1, 'price_item' => 22],
            2 => ['qty_item' => 1, 'price_item' => 30]
        ]);

        Administrador::find(1)->estoqueable()->create([
            'qty_item' => 10,
            'produto_id' => 1,
            'observation' => 'Compra fornecedor',
            'tipo_movimentacao_id' => 1,
            //'batch' => 'A458',
            //'expiration_date' => '2023-02-08 13:33:19'
        ]);
        Administrador::find(1)->estoqueable()->create([
            'qty_item' => 10,
            'produto_id' => 2,
            'observation' => 'Compra fornecedor',
            'tipo_movimentacao_id' => 1,
            //'batch' => 'B458',
            //'expiration_date' => '2023-02-08 13:33:19'
        ]);

        Pedido::find(1)->estoqueable()->create([
            'qty_item' => -1,
            'produto_id' => 1,
            'observation' => 'Venda',
            'tipo_movimentacao_id' => 2,
            //'batch' => 'A458',
            //'expiration_date' => '2023-02-08 13:33:19'
        ]);
        /*Cliente::find(1)->estoqueable()->create([
            'qty_item' => -1,
            'produto_id' => 2,
            'observation' => 'Venda',
            //'batch' => 'B458',
            //'expiration_date' => '2023-02-08 13:33:19'
        ]);*/



        //Estado::create(['name_state' => 'São Paulo']);

        //Estado::create(['name_state' => 'Paraná']);
        //Estado::create(['name_state' => 'Rio de Janeiro']);


        Permission::create(['name' => 'admin', 'guard_name' => 'web']);
        Permission::create(['name' => 'vendedor', 'guard_name' => 'web']);
        Permission::create(['name' => 'cliente', 'guard_name' => 'web']);

        Administrador::create(['name' => 'Rafael Admin'])->user()->create([
            'email' => 'rafael@adminrafael.com', 'email_verified_at' => '2023-02-07 13:33:19
                ', 'password' => Hash::make('qwerasdf'), 'remember_token' => null,
            'created_at' => '2023-02-07 13:32:43', 'updated_at' => '2023-02-07 13:33:19'
        ]);

        Administrador::create(['name' => 'Gabriel Admin'])->user()->create([
            'email' => 'gabs@admingabs.com', 'email_verified_at' => '2023-02-07 13:33:19
                ', 'password' => Hash::make('qwerasdf'), 'remember_token' => null,
            'created_at' => '2023-02-07 13:32:43', 'updated_at' => '2023-02-07 13:33:19'
        ]);

        DB::table('model_has_permissions')->insert(['permission_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => 1]);

        DB::table('model_has_permissions')->insert(['permission_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => 59]); //rafael
        DB::table('model_has_permissions')->insert(['permission_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => 60]); //gabriel



        function criarPedidoAleatorio($clienteId) {
            $cliente = Cliente::find($clienteId);

            if (!$cliente) {
                return "Cliente não encontrado";
            }

            $dataInicial = strtotime('2020-01-01');
            $dataFinal = strtotime('2023-10-30');
            $createdAt = rand($dataInicial, $dataFinal);
            $approvalDate = rand($createdAt, $createdAt + (4 * 24 * 60 * 60)); // Entre 1 e 4 dias após $createdAt
            $deliveryDate = rand($approvalDate + (2 * 24 * 60 * 60), $approvalDate + (15 * 24 * 60 * 60)); // Entre 2 e 15 dias após $approvalDate
            $payday = rand($approvalDate + (1 * 24 * 60 * 60), $approvalDate + (25 * 24 * 60 * 60)); // Entre 1 e 25 dias após $approvalDate

            $pedido = $cliente->pedidos()->create([
                'created_at' => date('Y-m-d H:i:s', $createdAt), // Data e hora de criação do pedido
                'payday' => date('Y-m-d H:i:s', $payday), // Dia do pagamento
                'delivery_date' => date('Y-m-d H:i:s', $deliveryDate), // Data de entrega
                'approval_date' => date('Y-m-d H:i:s', $approvalDate), // Data de aprovação
                "total_price" => 1,
                'total_discount' => rand(0, 20), // Desconto aleatório entre 0 e 20
                'metodo_pagamento_id' => rand(1, 6), // Método de pagamento aleatório entre 1 e 6
                'observation' => 'Pedido aleatório', // Observação padrão para pedidos aleatórios
                'vendedor_id' => $cliente->vendedor_id, // ID do vendedor aleatório entre 1 e 13
                'endereco_id' => $cliente->enderecos()->first()->id // Seleciona um endereço aleatório do cliente
            ]);

            $quantidadeProdutos = rand(1, 15);
            $produtosIds = range(2, 61);
            $totalPrice = 0;

            for ($i = 0; $i < $quantidadeProdutos; $i++) {
                $produtoId = $produtosIds[array_rand($produtosIds)];
                $quantidade = rand(1, 10);
                //$preco = rand(25, 50);
                $preco = Produto::find($produtoId)->sale_price;

                $totalPrice += $quantidade * $preco; // Calcula o preço total

                $pedido->produtos()->attach([
                    $produtoId => ['qty_item' => $quantidade, 'price_item' => $preco]
                ]);
            }

            $pedido->total_price = $totalPrice; // Define o total_price após calcular a soma das multiplicações
            $pedido->save();

            $pedido->criarMovimentacoesEstoque();

            return "Pedido aleatório gerado com sucesso para o cliente {$cliente->name}";
        }

        function addLatitudeLongitude($enderecoId){
            $endereco = Endereco::find($enderecoId);
            $latitude = -33.75 + mt_rand() / mt_getrandmax() * (5.25 - (-33.75));
            $longitude = -73.98 + mt_rand() / mt_getrandmax() * (-34.79 - (-73.98));

            $endereco->latitude = $latitude;
            $endereco->longitude = $longitude;
            $endereco->save();
        }

        for($a=1; $a<=3; $a++){
            for($b=1; $b<=44; $b++){
                criarPedidoAleatorio($b);
            }
        }

        for($d=1; $d<=71; $d++){
            addLatitudeLongitude($d);
        }

        for($e=2; $e<=14; $e++){
            DB::table('model_has_permissions')->insert(['permission_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => $e]);
        }

        for($f=15; $f<=58; $f++){
            DB::table('model_has_permissions')->insert(['permission_id' => 3, 'model_type' => 'App\Models\User', 'model_id' => $f]);
        }

        for($g=1; $g<=61; $g++){
            Administrador::find(1)->estoqueable()->create([
                'qty_item' => 1000,
                'produto_id' => $g,
                'observation' => 'Compra fornecedor',
                'tipo_movimentacao_id' => 1
            ]);
        }
    }
}
