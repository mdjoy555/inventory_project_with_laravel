<style>
    img{
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 2%;
    }
</style>
<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Table
    </x-slot>
    <x-backend.partials.elements.breadcrumb>
        <x-slot name="pageHeader">Dashboard</x-slot>
        <li class="breadcrumb-item active">Product</li>
    </x-backend.partials.elements.breadcrumb>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Edit Products<a class="btn btn-info" href="{{route('products.index')}}">List</a>
                </div>
                <div class="card-body">
    <form action="{{route('products.update',['product'=>$product->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <x-backend.form.input name="name" :value="$product->name"/>
        <x-backend.form.input name="price" :value="$product->price"/>
        <x-backend.form.input name="quantity" :value="$product->quantity"/>
        <x-backend.form.input name="image" type="file" :value="$product->image"/>
        <x-backend.form.button>
            update
        </x-backend.form.button>
    </form>
                </div>
            </div>
        </div>
    </div>
</x-backend.layouts.master>
