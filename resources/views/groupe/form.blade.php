{{csrf_field()}}

<div class="box-body">

    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" class="form-control" id="name" placeholder="nom" name="name" value="{{$groupe->name}}">
    </div>

    <!-- textarea -->
    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" rows="3" placeholder="..." name="description">{{$groupe->description}}</textarea>
    </div>

    <!-- liste des agents en checkbox -->
    <div class="form-group">
        <div class="col-sm-4">
            @forelse($agents as $k => $agent)
                @if($k % 3 == 0)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="agents[]" value="{{$agent->id}}"
                                   @if(in_array($agent->id, $groupe->agents->pluck('id')->all()))
                                   checked
                                    @endif>
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
                            <input type="checkbox" name="agents[]" value="{{$agent->id}}"
                                   @if(in_array($agent->id, $groupe->agents->pluck('id')->all()))
                                   checked
                                    @endif>
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
                            <input type="checkbox" name="agents[]" value="{{$agent->id}}"
                                   @if(in_array($agent->id, $groupe->agents->pluck('id')->all()))
                                   checked
                                    @endif>
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

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Envoyer</button>
</div>
