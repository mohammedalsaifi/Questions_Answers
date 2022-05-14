@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $message)
        <li>{{$message}}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{$action}}" method="post">
    @csrf
    @if($update)
    @method('put')
    @endif
    <div class="form-group mb-3">
        <label for="name">Tage Name:</label>
        <div class="mt-2">
            <input type="text" name="name" value="{{ old('name', $tag->name )}}" class="form-control @error('name') is-invalid @enderror">
            @error ('name')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
        <label for="name">Slug:</label>
        <div class="mt-2">
            <input type="text" name="slug" value="{{ old('slug'), $tag->slug }}" class="form-control @error('slug') is-invalid @enderror">
            @error ('slug')
            <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
    </div>
    <div class="from-group">
        <button type="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-outline-dark btn-xs" href="/tags">index</a>
    </div>
</form>