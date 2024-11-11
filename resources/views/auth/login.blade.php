@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" style="max-width: 500px; margin: auto; padding: 20px;">
        <div class="text-center">
            <img src="{{ asset('backend_assets/img/logo.png') }}" alt="Logo" style="width: 30%; margin-bottom: 10px;">
        </div>

        
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <!-- Email Field -->
            <div class="mb-2 text-start">
                <label for="email" class="form-label mb-1">कृषक नम्बर / इमेल</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="jhon@example.com" value="{{ old('email') }}" >
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <!-- Password Field -->
            <div class="mb-3 text-start">
                <label for="password" class="form-label mb-1">पासवर्ड</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <!-- Remember Me Checkbox -->
            <div class="mb-3 form-check text-start">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label text-white" for="remember">मलाई सम्झनुहोस्</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">लग इन गर्नुहोस्</button>
        </form>
    </div>
</div>
@endsection
