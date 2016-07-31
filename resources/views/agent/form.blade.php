<div class="box-body">
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" placeholder="nom" name="nom" value="{{$agent->nom}}">
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        <label for="prenom">Prenom</label>
        <input type="text" class="form-control" id="prenom" placeholder="prenom" name="prenom"
               value="{{$agent->prenom}}">
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        <label for="phone">Téléphone portable</label>
        <input type="text" class="form-control" id="phone" placeholder="téléphone" name="phone"
               value="{{$agent->phone}}">
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</div>