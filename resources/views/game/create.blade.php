@component('modal_content')
    @slot('title') Add Game @endslot
    {!! Form::open(['url' => '/game', 'method' => 'POST']) !!}
    <div class="modal-body">
        <div class="form-group">
            {!! Form::select('country_id', $selectCountryList, null, ['class' => 'form-control', 'placeholder' => 'Select country', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('sport_id', $selectSportList, null, ['class' => 'form-control', 'placeholder' => 'Select sport', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('tournament_id', $selectTournamentList, null, ['class' => 'form-control', 'placeholder' => 'Select tournament', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('member_one', $selectTeamList, 0, ['class' => 'form-control', 'placeholder' => 'Select team1']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('member_two', $selectTeamList, 0, ['class' => 'form-control', 'placeholder' => 'Select team2']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('score_one', null, ['class' => 'form-control', 'placeholder' => 'Score one', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('score_two', null, ['class' => 'form-control', 'placeholder' => 'Score two', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('date', null, ['class' => 'form-control', 'placeholder' => 'Date', 'required'=>'required']) !!}
        </div> 
    </div>
    <div class="modal-footer ">
        <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Add</button>
    </div>
    {!! Form::close() !!}
@endcomponent


