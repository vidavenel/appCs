@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Groupes</h1>
        <ol class="breadcrumb">
            <li class="active">Utilisateurs</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Liste des utilisateurs</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Validé</th>
                                <th style="width: 30px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><span class="badge @if ($user->activate) bg-green @else bg-red @endif">@if ($user->activate)
                                                OK @else NON @endif</span></td>
                                    <td><a href="{{route('user.edit', $user->id)}}">
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