<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Product
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
                    Create  Product <a class="btn btn-info" href="{{route('products.index')}}">List</a>
                </div>
                <div class="card-body">
                    <x-backend.partials.elements.errors :errors="$errors"/>
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-backend.form.input name="name"/>
        <x-backend.form.input name="price"/>
        <x-backend.form.input name="quantity"/>
        <x-backend.form.input name="image" type="file"/>
        <x-backend.form.button>
            Save
        </x-backend.form.button>
       </form>
      </div>
    </div>
   </div>
</div>
</x-backend.layouts.master>
