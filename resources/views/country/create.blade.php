@component('modal_content')
    @slot('title') Add Contry @endslot
    {!! Form::open(['url' => '/country', 'method' => 'POST']) !!}
    <div class="modal-body">
        <div class="form-group">
            {!! Form::text('name', null, ['class' => 'form-control', 'required'=>'required']) !!}
        </div>
    </div>
    <div class="modal-footer ">
        <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Add</button>
    </div>
    {!! Form::close() !!}
@endcomponent



