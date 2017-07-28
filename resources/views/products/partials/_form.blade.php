<div class="col-md-12">
	<div class="form-group">
    <label for="product">Product Name</label>
    {!! Form::text('name', null, ['class' => 'form-control input-sm', 'required']) !!}
	</div>
	<div class="form-group">
    <label for="quantity">Quantity</label>
    {!! Form::number('quantity', null, ['class' => 'form-control input-sm', 'required']) !!}
	</div>
	<div class="form-group">
	<label for="price">Price</label>
    {!! Form::number('price', null, ['class' => 'form-control input-sm','step'=>"any",'min'=>"1", 'required']) !!}
	</div>
</div>