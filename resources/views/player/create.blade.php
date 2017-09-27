@component('modal_content')
    @slot('title') Add Player @endslot
    {!! Form::open(['url' => '/player', 'method' => 'POST']) !!}
    <div class="modal-body">
        <div class="form-group">
            {!! Form::select('country_id', $selectCountryList, null, ['class' => 'form-control', 'placeholder' => 'Select country', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('sport_id', $selectSportList, null, ['class' => 'form-control', 'placeholder' => 'Select sport', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('team_id', $selectTeamList, 0, ['class' => 'form-control', 'placeholder' => 'Select team']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required'=>'required']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::textarea('keywords', null, ['class' => 'form-control', 'required'=>'required', 'placeholder' => 'Input keywords separated by comma']) !!}
        </div>
    </div>
    <div class="modal-footer ">
        <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Add</button>
    </div>
    {!! Form::close() !!}
@endcomponent


