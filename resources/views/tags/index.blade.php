<x-dashboard-layout>

    <x-slot name="title">
        Tags
        <a class="btn btn-outline-dark btn-xs" href="/tags/create">Add New</a>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Tags</li>
    </x-slot>

    <x-alert />
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>

                <th>Created_At</th>
                <th>Updated_At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
            <tr>
                <td>{{$tag->id}}</td>
                <td><a href="/tags/{{$tag->id}}/edit">{{$tag->name}}</a></td>

                <td>{{$tag->created_at}}</td>
                <td>{{$tag->updated_at}}</td>
                <td>
                    <form action="/tags/{{ $tag->id }}" method="post">
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