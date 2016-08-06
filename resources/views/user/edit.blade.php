@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Agents
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> agent</a></li>
            <li class="active">Edition</li>
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
                        <h3 class="box-title">Modifier un utilisateur</h3>
                    </div>
                    <!-- /.box-header -->

                    <form role="form" method="POST" action="{{route('user.update', $user->id)}}">
                        {{method_field('PUT')}}
                        {{csrf_field()}}

                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">nom</label>
                                <input type="text" class="form-control" id="name" placeholder="nom" name="name"
                                       value="{{$user->name}}" disabled>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="email" name="email"
                                       value="{{$user->email}}" disabled>
                            </div>
                        </div>

                        <!-- radio -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="email">Validé</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="enabled" id="enabled1" value="1"
                                               @if($user->enabled) checked @endif>
                                        oui
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="enabled" id="enabled0" value="0"
                                               @if(!$user->enabled) checked @endif>
                                        non
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
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