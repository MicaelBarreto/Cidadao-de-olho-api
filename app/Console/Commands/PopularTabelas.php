<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

use App\Deputado;
use App\Indenizacao;
use App\Midia;
use App\DeputadoMidia;

class PopularTabelas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'popular:tabelas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Popular as tabelas com os dados do web service';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Deputados em exercicio
        $ch = curl_init('http://dadosabertos.almg.gov.br/ws/deputados/em_exercicio?formato=json');
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json_deputados = curl_exec($ch);
        curl_close($ch);

        $deputados = json_decode($json_deputados, true);

        DB::beginTransaction();
        try{
            foreach($deputados['list'] as $dep){
                $deputado = new Deputado;
                $deputado->id = $dep['id'];
                $deputado->nome = $dep['nome'];
                $deputado->partido = $dep['partido'];

                $deputado->save();

                $this->info('deputado.id: '.$deputado->id);

                // Indenizações por deputado
                $ch = curl_init('http://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/legislatura_atual/deputados/'.$deputado->id.'/datas?formato=json');
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $json_indenizacao = curl_exec($ch);
                curl_close($ch);
                $indenizacoes = json_decode($json_indenizacao, true);

                foreach($indenizacoes['list'] as $i){
                    $indenizacao = new Indenizacao;
                    $indenizacao->data = Carbon::parse($i['dataReferencia']['$']);
                    $indenizacao->deputado_id = $deputado->id;

                    $indenizacao->save();
                }

                // Redes sociais dos deputado
                $ch = curl_init('http://dadosabertos.almg.gov.br/ws/deputados/'.$deputado->id.'?formato=json');
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $json_deputado = curl_exec($ch);
                curl_close($ch);
                $dep = json_decode($json_deputado, true);

                foreach ($dep['deputado']['redesSociais'] as $rede) {
                    $midia = Midia::where('nome', 'LIKE', $rede['redeSocial']['nome'])->first();

                    if(!$midia){
                        $midia = new Midia;
                        $midia->id = $rede['redeSocial']['id'];
                        $midia->nome = $rede['redeSocial']['nome'];
                        $midia->url = $rede['redeSocial']['url'];

                        $midia->save();                        
                    }

                    $deputado->midias()->attach($midia, array('url' => $rede['url']));
                }
            }

            DB::commit();
            $this->info('Tabelas populadas com sucesso');
        }catch(\PDOException $e){

            DB::rollBack();
            $this->info('Ocorreu o seguinte erro ao tentar popular as tabelas: '.$e);
        }
    }
}
