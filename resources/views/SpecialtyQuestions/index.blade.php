@extends('dashboard.layouts.layout')
@include('dashboard.layouts.header')
<div class="container-fluid">
    <div class="row">
        @include('dashboard.layouts.sidebar')
        <main class="col-md-10 p-4 pb-0" style="font-family: Poppins, sans-serif;">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="header-page">Specialty Questions</h1>
                <a href="{{ route('specialty-questions.create') }}" class="btn btn-purple">Add Question</a>
            </div>

            <div class="row">
                <div class="col-12 px-3">
                    <div class="card p-4">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question (En)</th>
                                        <th>Answer (En)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($questions as $question)
                                    <tr>
                                        <td>{{ $question->id }}</td>
                                        <td>{{ $question->question['en'] ?? '-' }}</td>
                                        <td>{{ Str::limit($question->answer['en'] ?? '-', 50) }}</td>
                                        <td>
                                            <a href="{{ route('specialty-questions.edit', $question->id) }}" class="btn btn-sm btn-dark"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('specialty-questions.destroy', $question->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $questions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>