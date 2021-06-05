<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Empresa;
use App\Repositories\RelatorioVendasPorPeriodoRepository;
use App\Rules\Logged;
use DateTime;
use System\Controller\Controller;
use System\Get\Get;
use System\Post\Post;
use System\Session\Session;

class RelatorioController extends Controller
{
    protected $post;
    protected $get;
    protected $layout;
    protected $idEmpresa;
    protected $idPerfilUsuarioLogado;

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'default';

        $this->post = new Post();
        $this->get = new Get();
        $this->idEmpresa = Session::get('idEmpresa');
        $this->idPerfilUsuarioLogado = Session::get('idPerfil');

        $logged = new Logged();
        $logged->isValid();
    }

    public function index()
    {
        $this->view('relatorio/index', $this->layout);
    }

    public function vendasPorPeriodo()
    {
        $usuario = new Usuario();
        $usuarios = $usuario->usuarios($this->idEmpresa, $this->idPerfilUsuarioLogado);

        $relatorioVendas = new RelatorioVendasPorPeriodoRepository();
        $periodoDisponivelParaConsulta = $relatorioVendas->periodoDisponivelParaConsulta($this->idEmpresa);

        $this->view('relatorio/vendasPorPeriodo/index', $this->layout,
        compact(
            'usuarios',
            'periodoDisponivelParaConsulta'
        ));
    }

    public function vendasChamadaAjax()
    {
        $relatorioVendas = new RelatorioVendasPorPeriodoRepository();
        $vendas = [];

        if ($this->post->hasPost()) {

            $de = $this->post->data()->de;
            $ate = $this->post->data()->ate;

            $idUsuario = false;
            if ($this->post->data()->id_usuario != 'todos') {
                $idUsuario = $this->post->data()->id_usuario;
            }

            $vendas = $relatorioVendas->vendasPorPeriodo(
                ['de' => $de, 'ate' => $ate],
                $idUsuario,
                $this->idEmpresa
            );

            if ($vendas && count($vendas) > 0) {
                $vendas = array_map(function ($venda) {
                    if ($venda->data_compensacao) {
                        $date = DateTime::createFromFormat("Y-m-d", $venda->data_compensacao);
                        $venda->data_compensacao = $date->format("d/m/Y");
                    }
                    return $venda;
                }, $vendas);
            }

            $meiosDePagamento = $relatorioVendas->totalVendidoPorMeioDePagamento(
                ['de' => $de, 'ate' => $ate],
                $idUsuario,
                $this->idEmpresa
            );

            $totalDasVendas = $relatorioVendas->totalDasVendas(
                ['de' => $de, 'ate' => $ate],
                $idUsuario,
                $this->idEmpresa
            );
        }

        $this->view('relatorio/vendasPorPeriodo/tabelaVendasPorPeriodo', false,
            compact(
                'vendas',
                'meiosDePagamento',
                'totalDasVendas'
            ));
    }

    public function gerarXls($de, $ate, $opcao = false)
    {
        $relatorioVendas = new RelatorioVendasPorPeriodoRepository();
        $periodo = ['de' => $de, 'ate' => $ate];

        $idUsuario = ($opcao == 'todos') ? false : $opcao;
        $relatorioVendas->gerarRelatioDeVendasPorPeriodoXls($periodo, $idUsuario, $this->idEmpresa);
    }

    public function gerarPDF($de, $ate, $opcao = false)
    {
        $empresa = new Empresa();
        $empresa = $empresa->find($this->idEmpresa);

        $relatorioVendas = new RelatorioVendasPorPeriodoRepository();
        $periodo = ['de' => $de, 'ate' => $ate];

        $idUsuario = ($opcao == 'todos') ? false : $opcao;
        $relatorioVendas->gerarRelatioDeVendasPorPeriodoPDF(
            $periodo,
            $idUsuario,
            $this->idEmpresa,
            $empresa
        );
    }
}
