@extends('layouts.default')

@section('title')
{{ __('Questions')}} <a href="{{ route('questions.create') }}" class="btn btn-outline-primary btn-sm">{{__('New Question')}}</a>
@endsection

@section('content')
<x-alert />
<x-message type="success">
    <h4>{{ __('Message Title')}}</h4>
    <p>{{ __('message body content')}}</p>
</x-message>

@foreach($questions as $question)
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><a href="{{route('questions.show', $question->id) }}">{{ $question->title }}</a></h5>
        <div class="text-muted mb-4">
            {{ __('Asked')}}:{{ $question->created_at->diffForHumans() }},

            {{ __('Count')}}: {{ $question->answers_count }}

        </div>
        <p class="card-text">{{ Str::words($question->description, 20) }}</p>
    </div>
    @if(Auth::id() == $question->user_id)
    <div class="card-footer">
        <div class="d-flex justify-content-between">
            <div>
                <a href="{{route('questions.edit', $question->id)}}" class="btn btn-outline-dark">{{ __('Edit')}}
                    {{ __('By')}}: {{ $question->user->name }},</a>
            </div>
            <form action="{{route('questions.destroy', $question->id)}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete')}}</button>
            </form>
        </div>
    </div>
    @endif
</div>
@endforeach

{{ $questions->withQueryString()->links() }}

@endsection
