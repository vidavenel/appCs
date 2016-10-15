@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Configuration
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard active"></i> configuration</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <!-- left column -->
            <form role="form"
                  method="POST" action="{{url('/configuration')}}">
                {{csrf_field()}}
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Terminal SMS Gateway</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <div class="form-group">
                                <label for="ip">IP</label>
                                <input type="text" name="ip" id="ip" class="form-control" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="port">Port</label>
                                <input type="text" name="port" id="port" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" class="form-control" value="">
                            </div>

                        </div>


                    </div>
                </div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Email</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <div class="form-group">
                                <label for="mail[host]">Hote</label>
                                <input type="text" name="mail[host]" id="mail[host]" class="form-control" value="{{$mail['host']}}">
                            </div>
                            <div class="form-group">
                                <label for="mail[port]">Port</label>
                                <input type="text" name="mail[port]" id="mail[port]" class="form-control" value="{{$mail['port']}}">
                            </div>
                            <div class="form-group">
                                <label for="mail[username]">Nom d'utilisateur</label>
                                <input type="text" name="mail[username]" id="mail[username]" class="form-control" value="{{$mail['username']}}">
                            </div>
                            <div class="form-group">
                                <label for="mail[password]">Mot de passe</label>
                                <input type="text" name="mail[password]" id="mail[password]" class="form-control" value="{{$mail['password']}}">
                            </div>

                            <div class="form-group col-md-8">
                                <input type="text" id="addresseTestMail" class="form-control" placeholder="adresse">
                            </div>
                            <div class="form-group col-md-4">
                                <button type="button" id="sendTestMail" class="btn btn-primary form-control">Envoyer un email de test</button>
                            </div>

                        </div>


                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
                <!-- /.box -->
            </form>
        </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection

@push('script')
<script>
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

    $('#sendTestMail').click(function () {
        $.get('{{url('/configuration')}}?sendTestMail='+ $('#addresseTestMail').val())
    })
</script>
@endpush