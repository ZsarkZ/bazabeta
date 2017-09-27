@component('modal_content')
    @slot('title') Edit Sport @endslot
    {!! Form::model($model, ['url' => '/sport/'.$model->id, 'method' => 'PATCH']) !!}
    <div class="modal-body">
        <div class="form-group">
            {!! Form::text('name', null, ['class' => 'form-control', 'required'=>'required']) !!}
        </div>
    </div>
    <div class="modal-footer ">
        <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Update</button>
    </div>
    {!! Form::close() !!}
@endcomponent


