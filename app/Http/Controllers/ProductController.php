<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_type = Auth::user()->user_type;

        if($user_type==1)
        {
            $products = Product::all();
    
            return view('backend.products.index',['products' => $products]);
        }
        else if($user_type==0)
        {
            return view('dashboard');
        }
    }
	
	public function user_index()
    {
        $users = User::all()->where('user_type','0');

        return view('backend.products.user_index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $request->validate([
                'name'=>['required','min:3'],
                'price'=>['required','min:2'],
                'quantity'=>['required','min:2'],
                'image'=>['required']
            ]);
            Product::create([
                'name'=>$request->name,
                'price'=>$request->price,
                'quantity'=>$request->quantity,
                'total_price' => $request->price*$request->quantity,
                'image'=>$this->uploadImage(request()->file('image')),
            ]);

            return redirect()->route('products.index')->withMessage('product is added successfully');
        }
        catch(QueryException $e)
        {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('backend.products.show',[
            'product'=>$product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('backend.products.edit',[
            'product'=>$product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try
        {
            $request->validate([
                'name'=>['required','min:3'],
                'price'=>['required','min:2'],
                'quantity'=>['required','min:2'],
                'image'=>['required']
            ]);
            
            $requestData = [
                'name'=>$request->name,
                'price'=>$request->price,
                'quantity'=>$request->quantity,
				'total_price'=>$request->price*$request->quantity
        ];

        if($request->hasFile('image'))
        {
            $requestData['image'] = $this->uploadImage(request()->file('image'));
        }

        $product->update($requestData);

        return redirect()->route('products.index')->withMessage('product is successfully updated!');
        }
        catch(QueryException $e)
        {
            return redirect()->back()->withInput()->withErrors($e->getMessage());   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function sold(Product $product)
    {
        if($product->quantity>0)
        {
            $product->quantity = $product->quantity-1;
            $product->total_earn = $product->total_earn+$product->price;
            $product->total_sold = $product->total_sold+1;
            $product->total_price = $product->quantity*$product->price;
            $data = ['quantity' => $product->quantity,
                     'total_price' => $product->total_price,
                     'total_earn' => $product->total_earn,
                     'total_sold' => $product->total_sold];
            $product->update($data);

            return redirect()->route('products.index');
        }
        else
        {
            return redirect()->route('products.index')->withMessage('Out of stock');
        }
    }
    
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->withMessage('Product Deleted Successfully');
    }
	
	public function destroy2(User $user)
    {
        $user->delete();

        return redirect()->route('products.user_index')->with('message','User deleted successfully');
    }
	
    public function uploadImage($file)
    {
        $fileName = time().'.'.$file->getClientOriginalExtension();
        'Image'::make($file)->resize(200,200)
                          ->save(storage_path().'/app/public/'.$fileName);
                          return $fileName;
    }
}
