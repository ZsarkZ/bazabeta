@extends('layouts.app')

@section('content')

	<div class="row">

		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default panel-table">
				<div class="panel-heading">
					<div class="row">
						<div class="col col-xs-6">
							<h3 class="panel-title">Contry List</h3>
						</div>
						<div class="col col-xs-6 text-right">
							<a href="{{ url('country/create') }}" title="" class="btn btn-sm btn-primary btn-create" data-toggle="modal" data-target="#myModal">Create New</a>
						</div>
					</div>
				</div>
				<div class="panel-body">

				{!! $dataTable->table(['class'=>'table-striped table-bordered table-list']) !!}

				</div>
			</div>
		</div>
	</div>

	@component('modal')

	@endcomponent
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection