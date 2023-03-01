<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Product
    </x-slot>
    <x-backend.partials.elements.breadcrumb>
        <x-slot name="pageHeader">Dashboard</x-slot>
        <li class="breadcrumb-item active">Product</li>
    </x-backend.partials.elements.breadcrumb>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Product
            <a class="btn btn-info" href="{{ route('products.create') }}">Add New Product
            </a>
            </a>
            <a class="btn btn-info" href="{{ route('products.user_index') }}">User</a>
    </div>
    <div class="card-body">
    <x-backend.partials.elements.message :message="session('message')"/>    
        <table id="datatablesSimple">
            <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Price</th>
                <th>Available</th>
                <th>Total Price</th>
                <th>Image</th>
                <th>Action</th>
                <th>Total Earn</th>
                <th>Total Sold</th>
            </tr>
            </thead>
            <tbody>
            @php $sl=0 @endphp
            @foreach ($products as $product)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->total_price }}</td>
                    <td><img src="/storage/{{$product->image}}" height="100px" width="100px"/></td>
                    <td>
                        <a class="btn btn-info btn-sm"
                           href="{{ route('products.show', ['product' => $product->id]) }}">Show
                        </a>
                        <a class="btn btn-warning btn-sm"
                           href="{{ route('products.edit', ['product' => $product->id]) }}">Edit
                        </a>
                        <form style="display:inline"
                              action="{{ route('products.sold', ['product' => $product->id]) }}"
                              method="post">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-primary btn-sm">Sell</button>
                        </form>
                        <form style="display:inline"
                              action="{{ route('products.destroy', ['product' => $product->id]) }}"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this product?');">
                            Delete</button>
                        </form>
                    </td>
                    <td>{{ $product->total_earn }}</td>
                    <td>{{ $product->total_sold }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-backend.layouts.master>
