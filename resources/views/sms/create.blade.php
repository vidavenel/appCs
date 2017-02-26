@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SMS
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> SMS</a></li>
            <li class="active">Nouveau</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-xs-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Envoyer un SMS</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('sms.store')}}">

                        {{csrf_field()}}

                        <div class="box-body">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" rows="3" placeholder="Corps du message ..."
                                          name="body" maxlength="160"></textarea>
                                <div class="pull-right"><small><span id="longueur">1</span> / 160</small></div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <i class="fa fa-warning"></i>

                                            <h3 class="box-title">Groupe</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <!-- liste des agents en checkbox -->
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    @forelse($groupes as $k => $groupe)
                                                        @if($k % 3 == 0)
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="groupes[]"
                                                                           value="{{$groupe->id}}">
                                                                    {{$groupe->name}}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @empty
                                                        Aucun groupe creer
                                                    @endforelse
                                                </div>

                                                <div class="col-sm-4">
                                                    @forelse($groupes as $k => $groupe)
                                                        @if($k % 3 == 1)
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="groupes[]"
                                                                           value="{{$groupe->id}}">
                                                                    {{$groupe->name}}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                </div>

                                                <div class="col-sm-4">
                                                    @forelse($groupes as $k => $groupe)
                                                        @if($k % 3 == 2)
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="groupes[]"
                                                                           value="{{$groupe->id}}">
                                                                    {{$groupe->name}}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                </div>

                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <i class="fa fa-warning"></i>

                                            <h3 class="box-title">Agents</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <!-- liste des agents en checkbox -->
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    @forelse($agents as $k => $agent)
                                                        @if($k % 3 == 0)
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="agents[]"
                                                                           value="{{$agent->id}}">
                                                                    {{$agent->nom}} {{$agent->prenom}}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @empty
                                                        Aucun agent enregistrer
                                                    @endforelse
                                                </div>

                                                <div class="col-sm-4">
                                                    @forelse($agents as $k => $agent)
                                                        @if($k % 3 == 1)
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="agents[]"
                                                                           value="{{$agent->id}}">
                                                                    {{$agent->nom}} {{$agent->prenom}}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                </div>

                                                <div class="col-sm-4">
                                                    @forelse($agents as $k => $agent)
                                                        @if($k % 3 == 2)
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="agents[]"
                                                                           value="{{$agent->id}}">
                                                                    {{$agent->nom}} {{$agent->prenom}}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                </div>

                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div id="agent-loader" class="overlay" style="display: none;">
                                            <i class="fa fa-refresh fa-spin"></i>
                                        </div>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection

@push('script')
<script>
    $(':input[name="groupes[]"]').change(function () {
        if (this.checked) {
            $("#agent-loader").show();
            $.get('/groupe/'+ $(this).val(), function (data) {
                var ids = $.parseJSON(data);
                $.each(ids, function (id, value) {
                    $(':input[name="agents[]"][value="'+ value +'"]').attr('checked', true);
                })
                $("#agent-loader").hide();
            })
        }
    })

    $('textarea').on('input', function(){
        $('#longueur').html($(this).val().length)
    })
</script>
@endpush