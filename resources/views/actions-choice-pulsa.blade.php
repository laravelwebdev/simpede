@extends('pulsa.layout')
@section('form')
<form
            action="{{ route('pulsa-choice', ['token' => $token]) }}"
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
                    Pilih Aksi yang Ingin Anda Lakukan.
                </p>
            </div>
            <div class="form-group">
                <label for="action-type" class="form-label">Aksi*</label>
                <select
                    name="action-type"
                    id="action-type"
                    class="form-select"
                    required
                >
                    <option value="konfirmasi">Konfirmasi Nomor Handphone</option>
                    <option value="upload">Upload Bukti Pulsa Masuk</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn"
                >Pilih</button
            >
        </form>
@endsection