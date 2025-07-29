@extends('pulsa.layout')
@section('form')
<form
            action="{{ route('pulsa-verifikasi', ['token' => $token]) }}"
            method="POST"
        >
        @csrf {{-- Cross-Site Request Forgery protection --}}
            <!-- Title and Description -->
            <div class="form-header">
                <h2 class="form-title">Penggantian Pulsa {{ $judul }}</h2>
                <p class="form-description">
                    Silakan Isi dengan NIK yang terdaftar pada Apikasi SOBAT.
                </p>
            </div>

            <!-- Employee / Requester Information -->
            <div class="form-group">
                <label for="nik" class="form-label">NIK*</label>
                <input
                    type="text"
                    name="nik"
                    id="nik"
                    class="form-input"
                    required
                />
            </div>


            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="form-group">
                <p class="form-error">
                 {{ $error }}
                </p>
            </div>
            @endforeach
            @endif

            <!-- Submit Button -->
            <button type="submit" class="submit-btn"
                >Submit</button>
        </form>
@endsection