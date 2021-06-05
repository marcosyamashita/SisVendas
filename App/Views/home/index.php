<?php use System\HtmlComponents\Charts\Doughnut; ?>

<style>
    .imagem-perfil {
        width: 30px;
        height: 30px;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
    }
</style>

<div class="row">

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="fas fa-coins" style="color:#00cc99"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category" style="font-size:12px">Vendas deste mês</p>
                            <p class="card-title" style="font-size:15px">
                                R$ <?php echo real($faturamentoDeVandasNoMes); ?> <br>
                                <small style="font-size:11px;opacity:0.40">
                                    Mês de <?php echo mesesPorExtensoEnumeroDoMes(date('m')); ?>
                                </small>
                            <p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fas fa-coins" style="color:#048e6d"></i>
                    <small>Mês anterior <b>R$ <?php echo real($faturamentoDeVandasMesAnterior); ?></b></small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="fas fa-coins" style="color:#ff9966"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category" style="font-size:12px">Vendas do dia</p>
                            <p class="card-title" style="font-size:15px">
                                R$ <?php echo real($faturamentoDeVandasNoDia); ?> <br>
                                <small style="font-size:11px;opacity:0.40">
                                    Hoje, <?php echo diaSemana(date('d/m/Y')); ?>
                                </small>
                            <p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fas fa-coins" style="color:#cf7474"></i>
                    <small>Dia anterior <b>R$ <?php echo real($faturamentoDeVandasNoDiaAnterior); ?></b></small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="fas fa-box-open" style="color:#99ccff"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category" style="font-size:12px">Produtos a venda</p>
                            <p class="card-title" style="font-size:15px">
                                Ativos <?php echo $produtosCadastrados->ativos; ?><p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fas fa-box-open" style="color:#84b6e9"></i>
                    <small>Produtos inativos <b><?php echo $produtosCadastrados->inativos; ?></b></small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="fas fa-user-tie" style="color:#ad54da"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category" style="font-size:12px">Clientes</p>
                            <p class="card-title" style="font-size:15px">
                                Ativos <?php echo $clientesCadastrados->ativos; ?><p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fas fa-user-tie" style="color:#ad54da"></i>
                    <small>Clientes inativos <b><?php echo $clientesCadastrados->inativos; ?></b></small>


                </div>
            </div>
        </div>
    </div>


</div>

<div class="row">

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <center>
                    Meios de pagamento.
                    <small style="opacity:0.70">Ultimos 30 dias</small>
                </center>
                <canvas class="grafico" id="grafico-tipo-pagamento" width="400" height="186"></canvas>
            </div>
            <div class="card-footer ">
                <hr>
                <!--<div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update Now
                </div>-->
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <center>
                    Vendas por dia.
                    <small style="opacity:0.70">Ultimos 30 dias</small>
                </center>
                <canvas class="grafico" id="grafi-vendas-por-dia" width="400" height="185"></canvas>
            </div>
            <div class="card-footer ">
                <hr>
                <!--<div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update Now
                </div>-->
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <center>
                    Vendas por vendedores
                    <small style="opacity:0.70">
                        Mês de <?php echo mesesPorExtensoEnumeroDoMes(date('m')); ?>
                    </small>
                </center>

                <?php if (count($totalVendasPorUsuariosNoMes) > 0): ?>
                    <table class="table tabela-ajustada vendas_por_vendedores table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Total</th>
                            <th>Dinheiro</th>
                            <th>Crédito</th>
                            <th>Débito</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($totalVendasPorUsuariosNoMes as $venda): ?>
                            <tr>
                                <td title="<?php echo $venda->nomeUsuario; ?>">
                                    <?php if (!is_null($venda->imagem) && $venda->imagem != ''): ?>
                                        <img class="imagem-perfil" src="<?php echo BASEURL . '/' . $venda->imagem; ?>">
                                    <?php else: ?>
                                        <i class="fa fa-user" style="font-size:30px"></i>
                                    <?php endif; ?>
                                </td>

                                <td>R$ <?php echo real($venda->valor); ?></td>

                                <?php if (!is_null($venda->Dinheiro)): ?>
                                    <td>R$ <?php echo real($venda->Dinheiro); ?></td>
                                <?php else: ?>
                                    <td><small>Não consta</small></td>
                                <?php endif; ?>

                                <?php if (!is_null($venda->Credito)): ?>
                                    <td>R$ <?php echo real($venda->Credito); ?></td>
                                <?php else: ?>
                                    <td><small>Não consta</small></td>
                                <?php endif; ?>

                                <?php if (!is_null($venda->Debito)): ?>
                                    <td>R$ <?php echo real($venda->Debito); ?></td>
                                <?php else: ?>
                                    <td><small>Não consta</small></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php else: ?>
                    <br><br><br>
                    <center>
                        <i class="fas fa-sad-tear" style="font-size:40px;opacity:0.70"></i>
                        <br><br>
                        <h6 style="opacity:0.70">Não houve vendas hoje!</h6>
                    </center>
                <?php endif; ?>
            </div>
            <div class="card-footer ">
                <hr>
                <!--<div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update Now
                </div>-->
            </div>
        </div>
    </div><!--end vendas por usuarios-->



    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <center>
                    (5) Produtos mais vendidos
                    <small style="opacity:0.70">
                        Mês de <?php echo mesesPorExtensoEnumeroDoMes(date('m')); ?>
                    </small>
                </center>

                <?php if (count($produtosMaisVendidosNoMes) > 0): ?>
                    <table class="table tabela-ajustada vendas_por_vendedores table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Produto</th>
                            <th>QTD</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($produtosMaisVendidosNoMes as $produto): ?>
                            <tr>
                                <td title="<?php echo $produto->nome; ?>">
                                    <?php if (!is_null($produto->imagem) && $produto->imagem != ''): ?>
                                        <img class="imagem-perfil" src="<?php echo BASEURL . '/' . $produto->imagem; ?>">
                                    <?php else: ?>
                                        <i class="fas fa-box-open" style="font-size:20px"></i>
                                    <?php endif; ?>
                                </td>

                                <td><?php echo $produto->nome;?></td>
                                <td><?php echo $produto->quantidade;?></td>

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php else: ?>
                    <br><br><br>
                    <center>
                        <i class="fas fa-sad-tear" style="font-size:40px;opacity:0.70"></i>
                        <br><br>
                        <h6 style="opacity:0.70">Não houve vendas hoje!</h6>
                    </center>
                <?php endif; ?>
            </div>
            <div class="card-footer ">
                <hr>
                <!--<div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update Now
                </div>-->
            </div>
        </div>
    </div><!--end vendas por usuarios-->









</div>
<script src="<?php echo BASEURL; ?>/public/assets/js/core/jquery.min.js"></script>
<script src="<?php echo BASEURL; ?>/public/assets/chartjs/dist/Chart.min.js"></script>
<?php Doughnut::start(
    'grafico-tipo-pagamento',
    $percentualMeiosDePagamento->medias,
    $percentualMeiosDePagamento->legendas,
    ["#83e6cd", "#9be6e6", "#dbb4dc", "#98c0d5"]
); ?>
<script>
    /*$(".vendas_por_vendedores tbody td").each(function() {
      console.log($(this).text());
    });*/
    var ctx = document.getElementById("grafi-vendas-por-dia");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php foreach ($quantidadeDeVendasRealizadasPorDia as $valor):?>
                <?php echo "\"{$valor->data}\",";?>
                <?php endforeach?>
            ],
            datasets: [{
                label: 'Quantidade',
                data: [
                    <?php foreach ($quantidadeDeVendasRealizadasPorDia as $valor):?>
                    <?php echo $valor->quantidade . ',';?>
                    <?php endforeach?>
                ],
                backgroundColor: '#00cccc',
                borderColor: '#255949',
                borderWidth: 1
            }
            ]
        },
        options: {
            responsive: true,
            scales: {
                xAxes: [{
                    ticks: {
                        maxRotation: 90,
                        minRotation: 80
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        min: 0
                    }
                }]
            }
        }
    });
</script>
