<x-dashboard-layout>

    <x-slot name="title">
        Edit Tags
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Tags</li>
    </x-slot>

    <x-alert />

    @include('tags._form', [
    'action' => '/tags/' . $tag->id,
    'update' => true,
    ])

    <form action="/tags/{{ $tag->id }}" method="post">
        @csrf
        @method('put')
        <div class="form-group mb-3">
            <label for="name">Tage Name:</label>
            <div class="mt-2">
                <input type="text" name="name" value="{{$tag->name}}" class="form-control">
            </div>
        </div>
        <div class="from-group">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-outline-dark btn-xs" href="/tags">index</a>
        </div>
    </form>
</x-dashboard-layout>