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
                        <h3 class="box-title">Creer un agent</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('agent.store')}}">

                        {{csrf_field()}}

                        @include('agent.form')

                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection