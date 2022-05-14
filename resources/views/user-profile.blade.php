@extends('layouts.default')

@section('title')
{{ __('Edit Profile')}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">
        <img src="{{ asset('/storage/' . $user->profile_photo_path) }}" class="img-fluid" alt="">
    </div>
    <div class="col-md-9">

        <form action="{{ route('profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group mb-3">
                <label for="name">{{ __('First Name')}}:</label>
                <div>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', $user->profile->first_name) }}">
                    @error('first_name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="name">{{ __('Last Name')}}:</label>
                <div>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', $user->profile->last_name) }}">
                    @error('last_name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="email">{{ __('Email Address')}}:</label>
                <div>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="emial" value="{{ old('email', $user->email) }}" disabled>
                    @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="name">{{ __('Birthday')}}:</label>
                <div>
                    <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('name', $user->profile->birthday) }}">
                    @error('birthday')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="email">{{ __('Profile Photo')}}:</label>
                <div>
                    <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" name="profile_photo">
                    @error('profile_photo')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('Update Profile')}}</button>
            </div>
        </form>
    </div>
</div>
@endsection