@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>SMS</h1>
        <ol class="breadcrumb">
            <li class="active">Agent</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des agents</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Téléphone</th>
                                <th style="width: 30px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($agents as $agent)
                                <tr>
                                    <td>{{$agent->nom}}</td>
                                    <td>{{$agent->prenom}}</td>
                                    <td>{{$agent->phone}}</td>
                                    <td><a href="{{route('agent.edit', $agent->id)}}">
                                            <button type="button" class="btn btn-block btn-default btn-xs"><i
                                                        class="fa fa-edit"></i></button>
                                        </a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Aucun groupe cree</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$agents->links()}}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection