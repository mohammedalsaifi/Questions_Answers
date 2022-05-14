<x-dashboard-layout>

    <x-slot name="title">
        Roles
        <a class="btn btn-outline-dark btn-xs" href="/roles/create">Add New</a>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Roles</li>
    </x-slot>

    <x-alert />
    <table class="table">
        <thead>
            <tr>
                <th>{{__('ID')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Created_At')}}</th>
                <th>{{__('Updated_At')}}</th>
                <th>{{__('Action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td><a href="{{route('roles.edit', $role->id)}}">{{$role->name}}</a></td>
                <td>{{$role->created_at}}</td>
                <td>{{$role->updated_at}}</td>
                <td>
                    <form action="{{route('roles.destroy', $role->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-dashboard-layout>