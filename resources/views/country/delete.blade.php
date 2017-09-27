@component('modal_content')
    @slot('title') Delete this entry @endslot
    {!! Form::open(['url' => '/country/'.$model->id, 'method' => 'DELETE']) !!}
    <div class="modal-body">
        <div class="alert alert-danger">
            <span class="glyphicon glyphicon-warning-sign"></span> 
            Are you sure you want to delete "{{ $model->name }}" Record?
        </div>
    </div>
    <div class="modal-footer ">
        <button type="submit" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
    </div>
    {!! Form::close() !!}
@endcomponent