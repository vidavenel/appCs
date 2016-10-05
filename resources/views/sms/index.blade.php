@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>SMS</h1>
        <ol class="breadcrumb">
            <li class="active">SMS</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">SMS envoyés</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Message</th>
                                <th>Expéditeur</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($sms as $msg)
                                <tr>
                                    <td>{{$msg->created_at}}</td>
                                    <td>{{$msg->body}}</td>
                                    <td>{{$msg->user->name}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Aucun sms envoyé</td>
                                </tr>
                            @endforelse
                            {{ $sms->links() }}
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Message</th>
                                <th>Expéditeur</th>
                            </tr>
                            </tfoot>
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