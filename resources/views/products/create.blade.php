@extends('layouts.modal')
@section('content')
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="modal-title">New Product</h5>
    </div>
    {!! Form::open(['route' => ['products.store'], 'class'=>"ajax-submit"]) !!}
    <div class="modal-body">
        @include('products.partials._form')
    </div>
    <div class="modal-footer">
        <button type="submit" data-rel="tooltip" data-placement="top" title="Save" class="btn btn-xs btn-success disabled" style="pointer-events: all; cursor: pointer;"><i class="fa fa-save"></i> Save</button>
        
        <button type="button" data-rel="tooltip" data-placement="top" title="Close" data-dismiss="modal" class="btn btn-xs btn-danger">
         <i class="fa fa-times"></i> Close</button>
    </div>
    {!!Form::close()!!}
</div>
</div>
@endsection