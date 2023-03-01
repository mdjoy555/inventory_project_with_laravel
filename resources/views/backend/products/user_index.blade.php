<x-backend.layouts.master>
    <x-slot name="pageTitle">
        User
    </x-slot>
    <x-backend.partials.elements.breadcrumb>
        <x-slot name="pageHeader">Dashboard</x-slot>
        <li class="breadcrumb-item active">User</li>
    </x-backend.partials.elements.breadcrumb>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        User
    </div>
    <div class="card-body">
    <x-backend.partials.elements.message :message="session('message')"/>    
        <table id="datatablesSimple">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @php $sl=0 @endphp
            @foreach ($users as $user)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form style="display:inline"
                            action=" {{route('products.destroy2', ['user' => $user->id]) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-backend.layouts.master>
