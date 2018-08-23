@extends('master.baselayout')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{asset('/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}">
    <style >
        body{
            font-size: 15px !important;
            padding: 0px;
        }

    </style>
@stop
@section('titleHeader')
    <h3 style="padding: 12px;">SOLICITAÇÕES</h3>
@stop
@section('content')
<div class="wrapper wrapper-content" id="solicitacao" style="padding-top: 0px;">
    <div class="row">
        <div class="col-lg-3 animated fadeInLeft" >
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <a class="btn btn-block btn-primary compose-mail" href="{{baseUrl('/solicitacoes/create')}}"> <i class="fa fa-plus"></i> Nova solicitação</a>
                        <div class="space-25"></div>
                        <h5>Filtros</h5>
                        <ul class="folder-list m-b-md category-list" style="padding: 0">
                            <li class="active"><a href="#todas" id="todas" data-toggle="tab" @click="filterStatus"><i class="fa fa-circle" ></i> Todas</a></li>
                            <li><a href="#" id="PE"  @click="filterStatus" ><i class="fa fa-hourglass text-warning" ></i> Pendentes</a></li>
                            <li><a href="#" id="EA"  @click="filterStatus" ><i class="fa fa-spinner text-info" ></i> Em andamento</a></li>
                            <li><a href="#" id="OK"  @click="filterStatus" ><i class="fa fa-check text-navy" ></i> Concluidas</a></li>
                            <li><a href="#" id="AC"  @click="filterStatus" ><i class="fa fa-legal text-primary  " ></i> Aceitas</a></li>
                            <li><a href="#" id="RJ"  @click="filterStatus" ><i class="fa fa-exclamation-circle text-purple" ></i> Rejeitadas</a></li>
                            <li><a href="#" id="CA"  @click="filterStatus" ><i class="fa fa-close text-danger" ></i> Canceladas</a></li>
                        </ul>
                        <h5>Filtrar por data</h5>
                        <div class="" style="padding-left: 0px">
                            <label class="control-label" style="margin-bottom: 4px"><b> Data de início*</b></label>
                            <div class="input-group date pull-right" style="margin-bottom: 10px" id="daterangepicker2">
                                <span class="input-group-addon cursor">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="dateInicial" name="dateInicial" readonly type="text" class="form-control">
                            </div>
                        </div>

                        <div class="">
                            <label class="control-label" style="margin-bottom: 4px"><b>Data de fim*</b></label>
                            <div class="input-group date pull-right" style="margin-bottom: 10px" id="daterangepicker2">
                                <span class="input-group-addon cursor">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="dateFinal" name="dateFinal" readonly type="text" class="form-control">
                            </div>
                            <button id="filterReq" type="button" class="btn btn-success btn-success btn-block" @click="filterData" >
                                <i class="fa fa-filter"></i> Pesquisar
                            </button>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <h2>
                    Solicitações
                </h2>
            </div>
            <div class="mail-box">

                <div v-if="showSolicitacoes">
                    <solicitacao-cliente :data="solicitacao.data"
                                         :url-redirect="'{{baseUrl('/solicitacoes/details/')}}'"
                    ></solicitacao-cliente>
                </div>

                <div v-else>
                    <h3  style="margin-top: 0px" class="text-muted text-center">Não há solicitações</h3>
                </div>

                <pagination-vue  :pagination="solicitacao"
                                 @paginate="getSolicitacoes()"
                                 :offset="4">
                </pagination-vue>
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
    @parent
    <script src="{{asset('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js')}}"></script>
    <script src="{{asset('/plugins/axios/dist/axios.js')}}"></script>

    <script type="text/javascript">

        jQuery(document).ready(function() {

            $('#dateInicial').datepicker({
                maxDate: "+0d",
                dateFormat: 'dd/mm/yy',
                language:'pt-BR',
                prevText: '<',
                nextText: '>'
            });

            $('#dateFinal').datepicker({
                dateFormat: 'dd/mm/yy',
                maxDate: "+0d",
                language:'pt-BR',
                prevText: '<',
                nextText: '>'
            });

            $('#dateFinal').datepicker("setDate", "+0d");
            $('#dateInicial').datepicker("setDate", "+0d");

            $('#dateInicial').on('change', function(event) {
                $('#dateFinal').datepicker("setStartDate", $('#dateInicial').val());
            })

        });

        var solicitacao = new Vue({
            el:'#solicitacao',
            data:{
                solicitacao:{},
                outroteste:{},
                showSolicitacoes:true

            },
            methods:{
                getSolicitacoes:function (filter) {
                    var self = this;
                    var data = {
                        params: filter
                    };

                    var pagefilter = self.solicitacao.current_page;

                    if(pagefilter == undefined){
                        pagefilter = 1;
                    }

                    axios.get('{{baseUrl('/solicitacoes/list/?page=')}}'+pagefilter,data)
                        .then(function(response)  {
                            self.$nextTick(function () {

                                if(response.data.data.length == 0) {
                                    self.showSolicitacoes = false;
                                    return;
                                }

                                self.showSolicitacoes = true;
                                self.solicitacao = response.data;

                            });

                        })
                        .catch(function (e) {
                            toastr.error('Erro ao buscar solicitações!', 'Erro!')
                        })
                },

                redirectToCreate: function () {
                    location.replace('{{baseUrl('/solicitacoes/create')}}')
                },

                filterStatus: function (item) {
                    var status = item.target.id;

                    // filter = {dataInicio: $('#dateInicial').val(), dataFim: $('#dateFinal').val()}

                    // filter.status = item.target.id;

                    this.getSolicitacoes({status:status})
                },

                filterData: function () {
                    filter = {dataInicio: $('#dateInicial').val(), dataFim: $('#dateFinal').val()}

                    this.getSolicitacoes(filter)
                }
            },
            mounted: function () {
                this.getSolicitacoes({});
            }
        });
    </script>
@stop