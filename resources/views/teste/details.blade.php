@extends('master.baselayout')

@section('stylesheets')
    <link rel="stylesheet" href="{{asset('plugins/fine-uploader/jquery.fine-uploader/fine-uploader-new.css')}}">
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    <link rel="stylesheet" href="{{ asset('theme/dist/css/AdminLTE.min.css') }}">
    @parent
    <style>
        ul > li > div > div > div.row::after {
            clear: both;
        }
        .error-border { border-color: #F70202 }
        #fine-uploader-manual-trigger > div > div > ul {
            overflow-y: hidden !important;
        }
        hr{
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .star-rating {
            font-size: 35px;
            cursor: pointer;
        }
        .star-rating:hover{
            font-size: 45px;
            color: orange;
 
        }
        .star-rating-checked {
            font-size: 35px;
            color: orange;
        }
        body{
            font-family: "Raleway", sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #636b6f;
        }
    </style>
@stop
@section('titleHeader')
    <h3 style="padding: 12px;padding-bottom: 0px">DETALHES DA SOLICITAÇÃO</h3>
@stop
@section('content')
    <section class="" id="solicitacaoDetail">

        <div class="col-md-3">
            <!-- About Me Box -->
            <div class="panel panel-warning" style="box-shadow: rgb(247, 157, 60) 0px 0px 0px inset, rgb(247, 157, 60) 0px 5px 0px 0px, rgb(153, 153, 153) 0px 10px 5px;
}">
                <!-- /.box-header -->
                <div class="panel-body">
                    <strong><i class="fa fa-info-circle margin-r-5"></i> Status</strong>
                    <p class="text-muted">
                        <span class="{{config('custom.enum.solicitacaoClass.'.$solicitacao->STATUS)}}">{{config('custom.enum.solicitacao.'.$solicitacao->STATUS)}}</span>
                    </p>

                    <hr>

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Serviço</strong>

                    <p class="text-muted">{{$solicitacao->servico->NOME}}</p>

                    <hr>

                    <strong><i class="fa fa-building margin-r-5"></i> Empresa</strong>

                    <p>
                        {{$solicitacao->empresa->NOME_FANTASIA}}
                    </p>

                    <hr>

                    <strong><i class="fa fa-file margin-r-5"></i> Solicitou documento: </strong>

                    <p>
                        @if($solicitacao->SOLICITAR_DOCUMENTO == 1) Sim @else Não @endif
                    </p>

                    <hr>

                    @if($solicitacao->SOLICITAR_DOCUMENTO == 1)
                        <strong><i class="fa fa-file margin-r-5"></i>Tipo de documento solicitado: </strong>

                        <p>
                            {{$solicitacao->tipoDocumento->NOME}}
                        </p>

                        <hr>
                    @endif

                    <strong><i class="fa fa-exclamation-circle margin-r-5"></i> Obs cancelamento</strong>

                    <p>{{$solicitacao->OBS_CANCELAMENTO}}</p>
                    <hr>
                    {{ Form::open(['url' => BaseUrl('/solicitacoes/delete'), 'method' => 'DELETE', 'id'=> 'formStatusSolicitacao']) }}
                        <input type="hidden" name="ID" value="{{$solicitacao->ID}}">
                    {{ Form::close() }}

                    @if($solicitacao->STATUS == 'PE')
                        <button  type="button" class="btn btn-danger btn-block" @click="deleteFormItem" style="margin-top: 5px"><span class="fa fa-close"></span> Excluir</button>
                    @elseif($solicitacao->STATUS == 'OK')
                            <button type="button" class="btn btn-primary btn-block" id="AC" @click="updateStatus" style="margin-top: 5px"><span class="fa fa-check-square-o"></span> Aceite</button>
                            <button type="button" class="btn btn-purple btn-block" id="RJ" @click="updateStatus" style="margin-top: 5px"><span class="fa fa-close"></span> Rejeitar</button>
                            <button type="button" class="btn btn-danger btn-block" id="CA" @click="updateStatus" style="margin-top: 5px"><span class="fa fa-close"></span> Cancelar</button>
                    @endif
                    {{--<a href="#" class="btn btn-primary btn-block"><b> <spanw class="fa fa-check-square-o"></span> Finalizar</b></a>--}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-warning">
                <div class="box-body">
                    <ul class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <li class="time-label">
                        <span class="bg-red">
                         {{ date("d-m-Y", strtotime($solicitacao->DATA_HORA_CADASTRO))}}
                        </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-comments bg-yellow"></i>

                            <div class="timeline-item">

                                <h3 class="timeline-header"><a href="#">{{$solicitacao->empresaResponsavel->NOME_COMPLETO}}</a> - Solicitou:</h3>

                                <div class="timeline-body">
                                    {{$solicitacao->SOLICITACAO}}
                                </div>
                            </div>
                        </li>

                        <solicitacao-resposta v-for="(resposta,key) in respostas" :key="key" :data="resposta" urlimage="{{baseUrl("/solicitacoesresposta/getimage/")}}"></solicitacao-resposta>

                        <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@stop
@section('scripts')
    <script>

        $(document).ready(function() {

            $('.sr-only').trigger('click')

        });

        var solicitacaoDetail = new Vue({
            el:'#solicitacaoDetail',
            data:{
                respostas:{}
            },
            methods: {
                getRespostas: function() {
                    var self = this;

                    axios.get('{{baseUrl('')}}'+'/solicitacoes/listrespostas/'+'{{$solicitacao->ID}}')
                        .then(function (response) {
                            self.respostas = response.data.respostas;

                        })
                        .catch(function (error) {
                            toastr.error('Erro ao buscar resposta da solicitação', 'Erro!');
                        });
                },

                updateStatus: function (item) {
                    var status = item.target.id;

                    var idCLicked;

                    /*inicio solicitação recusada*/

                    if(status =='RJ') {
                        const {value: name} =  swal({
                            title: 'Qual o motivo da solicitação ser recusada?',
                            input: 'text',
                            inputPlaceholder: 'Digite aqui o motivo.',
                            showCancelButton: true,
                            inputValidator: (value) => {
                                return !value && 'Por favor, informe o motivo!'
                            }
                        }).then(function (item) {

                            if (item.value != undefined) {
                                axios.post('{{baseUrl('')}}' + '/solicitacoes/putstatus/{{$solicitacao->ID}}', {
                                    status: 'RJ',
                                    motivo: item.value,
                                    _token: '{{csrf_token()}}'
                                })
                                    .then(function (response) {

                                        swal("Solicitação atualizada com sucesso.")

                                            .then((value) => {
                                                window.location.reload();
                                            });

                                    })
                                    .catch(function (error) {
                                        toastr.error('Erro ao atualizar status da solicitação', 'Erro!');
                                    })
                            }
                        })

                        return;
                    }
                    /* fim solicitação recusada*/

                    /*inicio avaliar solicitação */

                    const {value: formValues} =  swal({
                        title: 'Avalie seu atendimento',
                        html:`<span class="fa fa-star star-rating" id="1" ></span>
                              <span class="fa fa-star star-rating " id="2"></span>
                              <span class="fa fa-star star-rating" id="3"> </span>
                              <span class="fa fa-star star-rating" id="4"></span>
                              <span class="fa fa-star star-rating" id="5"></span>`,
                        focusConfirm: false,
                        preConfirm: () => {
                            return [

                                axios.post('{{baseUrl('')}}'+'/solicitacoes/putstatus/{{$solicitacao->ID}}', {status: status,star:idCLicked, _token:'{{csrf_token()}}'})
                                    .then(function (response) {

                                        swal("Solicitação atualizada com sucesso.")

                                            .then((value) => {
                                                window.location.reload();
                                            });

                                    })
                                    .catch(function (error) {
                                        toastr.error('Erro ao atualizar status da solicitação', 'Erro!');
                                    })

                            ]
                        }
                    })

                    $(document).on('click', '.star-rating', function (element) {

                        idCLicked = element.target.id;

                        $('.star-rating').each(function (i, element) {

                            var currentId = $(this).attr('id');

                            if(currentId <= idCLicked) {
                                $(this).addClass('star-rating-checked');
                                return;
                            }

                            $(this).removeClass('star-rating-checked');
                        })
                    })

                    /* fim avaliar solicitação */

                },

                deleteFormItem:function () {
                    Swal({
                        title: 'Tem certeza ?',
                        text: 'Você não poderá mais recuperar essa informação!',
                        type: 'warning',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        showLoaderOnConfirm:true,
                        showCancelButton: true,
                        confirmButtonText: 'Sim, excluir!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.value) {
                            $('#formStatusSolicitacao').submit();
                        }
                    })
                }
            },

            created:function () {
                this.getRespostas();
            }
        });
    </script>
    @parent

@stop