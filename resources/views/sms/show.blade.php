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
                        <h3 class="box-title">Detail d'un SMS</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <dl>
                            <dt>De</dt>
                            <dd>{{$SMS->user->name}}</dd>
                            <br/>
                            <dt>Detail</dt>
                            <dd>{{$SMS->body}}</dd>
                            <br/>
                            <dt>Pour</dt>
                            <table class="table">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                </tr>

                                @forelse($SMS->agents()->get() as $agents)
                                    <tr>
                                        <td>{{$agents->id}}</td>
                                        <td>{{$agents->nom}}</td>
                                        <td>{{$agents->prenom}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Aucun destinataire</td>
                                    </tr>
                                @endforelse

                            </table>
                        </dl>
                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection