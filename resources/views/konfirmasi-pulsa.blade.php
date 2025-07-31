@extends('pulsa.layout')
@section('form')
<form
            action="{{ route('pulsa-submit-confirm', ['token' => $token]) }}"
            method="POST"
        >
         @csrf {{-- Cross-Site Request Forgery protection --}}
            <!-- Title and Description -->
            <div class="form-header">
                <h2 class="form-title">Penggantian Pulsa {{ $judul }}</h2>

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
                    readonly
                    value="{{ $nik }}"
                />
            </div>
            <div class="form-group">
                <label for="nama" class="form-label">Nama*</label>
                <input
                    type="text"
                    name="nama"
                    id="nama"
                    class="form-input"
                    required
                    readonly
                    value="{{ $nama }}"
                />
            </div>
            <div class="form-group">
                <p class="form-description">
                    Isikan Nomor Handphone yang ingin diisikan pulsa. Perbaiki isian ini jika belum sesuai.
                </p>
            </div>
            <div class="form-group">
                <label for="handphone" class="form-label">Nomor Handphone*</label>
                <input
                    type="text"
                    name="handphone"
                    id="handphone"
                    class="form-input"
                    required
                    value="{{ $handphone }}"
                />
            </div>
            <div class="form-group">
                <p class="form-description">
                    Agar tidak terjadi kesalahan, masukkan sekali lagi Nomor Handphone yang ingin diisikan pulsa.
                </p>
            </div>
            <div class="form-group">
                <label for="confirm" class="form-label">Konfirmasi Nomor handphone*</label>
                <input
                    type="text"
                    name="confirm"
                    id="confirm"
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
                >Kirim</button
            >
        </form>
@endsection