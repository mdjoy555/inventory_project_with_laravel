<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Table
    </x-slot>
    <x-backend.partials.elements.breadcrumb>
        <x-slot name="pageHeader">Dashboard</x-slot>
        <li class="breadcrumb-item active">Product</li>
    </x-backend.partials.elements.breadcrumb>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
            Product Show
            <a class="btn btn-info" href="{{ route('products.index') }}">List</a>
        <div class="card-body">
            <h2>Title:{{$product->name}}</h2>
            <img src="/storage/{{$product->image}}"/>
        </div>
    </div>
</div>
</x-backend.layouts.master>
