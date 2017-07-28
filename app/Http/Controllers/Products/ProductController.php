<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
	public function index(){
		return view('products.index')->with(['products'=>Product::all()]);
	}
	
	public function create(){


		return view('products.create');
	}

	public function store(ProductFormRequest $request)
	{
		$product = new Product();
		$data = [
		'name'		=>$request->get('name'),
		'quantity'	=>$request->get('quantity'),
		'price'		=>$request->get('price'),
		'user_created'=>auth()->user()->id
		];

		/*json file start*/
		$json = json_encode($data);
		$fileName = time() . '_jsonCoalition.json';
		$file =  \File::put(storage_path('/app/public/2017'.$fileName),$json);
        //return \Response::download(storage_path('/app/public/'$fileName)); 

		if($file){
			$data['json_file'] = '2017'.$fileName;
		}
		$product->create($data);

		if($product)
			return response()->json(['success'=>true,'msg'=>'New Product was created'],201);
		else
			return response()->json(['success'=>false,'msg'=>'something went wrong while creating new product'],503);
	}

	public function edit($id){
		$product = Product::findOrFail($id);

		return view('products.edit')->with(['product'=>$product]);
	}

	public function update(ProductFormRequest $request, $id)
	{
		$product = Product::findOrFail($id);

		$data = [
		'name'          => $request->get('name'),
		'quantity'      => $request->get('quantity'),
		'price'         => $request->get('price'),
		'user_updated'  => auth()->user()->id
		];

		$product->fill($data)->save();

		$json = json_encode($data);
		$fileName = $product->json_file;
		$file =  \File::put(storage_path('/app/public/'.$fileName),$json);

		if($file)
			return response()->json(['success'=>true,'msg'=>'The product was updated'],201);
		else
			return response()->json(['success'=>false,'msg'=>'something went wrong while updating a product'],503);
	}

	public function delete($id){
		$product = Product::findOrFail($id);
		$product->update(['user_deleted'=>auth()->user()->id]);
		$product->delete();

		return redirect()->route('home');
	}

	public function download($id){
		$product = Product::findOrFail($id);
		return \Response::download(storage_path('/app/public/'.$product->json_file)); 
	}
}
