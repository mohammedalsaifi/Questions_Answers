@extends('layouts.default')

@section('title')
Question <a href="{{ route('questions.create') }}" class="btn btn-outline-primary btn-sm">{{ __('New Question')}}</a>
@endsection

@section('content')

<x-alert />
<x-message content="This is a component" type="danger" />

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $question->title }}</h5>
        <div class="text-muted mb-4">
            {{ __('Asked')}}:{{ $question->created_at->diffForHumans() }}, By: {{ $question->user->name }}
        </div>
        <p class="card-text">{{ $question->description}}</p>
        <div>
            {{ __('Tags')}}:
            <ul class="inline-list">
                @foreach($question->tags as $tag)
                <li><span>{{ $tag->name }}</span></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<section>
    <h3>{{ $question->answers()->count() }} Answers</h3>
    @forelse ($question->answers()->with('user')->latest()->get() as $answer)
    <div class="card mb-3">
        <div class="card-body">
            @if($answer->best_answers == 1)
                <span class="badge bg-success">{{ __('Best')}}</span>
            @endif
            {{ $answer->description }}
            <div class="text-muted mb-4">
                {{ $answer->created_at->diffForHumans() }},
                By: {{ $answer->user->name }}
            </div>
            @auth
            @if(Auth::id() == $question->user_id)
            <form action="{{ route('answers.best', $answer->id) }}" method="post">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-success">{{ __('Mark as best answer')}}</button>
            </form>
            @endif
            @endauth
        </div>
    </div>
    @empty
    <div class="mb-2">
        <p class="">{{ __('No Answers')}}!</p>
    </div>
    @endforelse
    @auth
    <hr>
    <h4>{{ __('Send Your Answer')}}.</h4>
    <form action="{{ route('answers.store') }}" method="post">
        <input type="hidden" name="question_id" value="{{ $question->id }}">
        @csrf

        <div class="form-group mb-3">
            <div>
                <textarea type="text" class="form-control @error('title') is-invalid @enderror" rows="6" name="description">{{ old('description') }}</textarea>
                @error('description')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Submit Answer')}}</button>
        </div>
    </form>
    @endauth
    @guest
    <a href="{{ route('login') }}">{{ __('Login to answer')}}</a>
    @endguest
</section>

@endsection