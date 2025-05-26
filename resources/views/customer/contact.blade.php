@extends('customer.layouts.app')

@section('title', 'Contact Me')

@section('content')

<div class="container mt-5">
    <h2 class="text-center mb-4">📬 Contact Me</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('contact.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">👤 Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for="email" class="form-label">📧 Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div> --}}

                        <div class="mb-3">
                            <label for="message" class="form-label">✉️ Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Send Message 📤</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
