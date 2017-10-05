@component('modal_content')
    @slot('title') Edit Player @endslot
    {!! Form::model($model, ['url' => '/player/'.$model->id, 'method' => 'PATCH']) !!}
    <div class="modal-body">
        <div class="form-group">
            {!! Form::select('country_id', $selectCountryList, null, ['class' => 'form-control', 'placeholder' => 'Select country', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('sport_id', $selectSportList, null, ['class' => 'form-control', 'placeholder' => 'Select sport', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('team_id', $selectTeamList, null, ['class' => 'form-control', 'placeholder' => 'Select team', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required'=>'required']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::textarea('keywords', null, ['class' => 'form-control', 'required'=>'required', 'placeholder' => 'Input keywords separated by comma']) !!}
        </div>
    </div>
    <div class="modal-footer ">
        <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Update</button>
    </div>
    {!! Form::close() !!}
@endcomponent


