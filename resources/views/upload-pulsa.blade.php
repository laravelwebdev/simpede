@extends('pulsa.layout')
@section('form')
<form
            action="{{ route('pulsa-submit-upload', ['token' => $token]) }}"
            method="POST"
            enctype="multipart/form-data"
        >
        @csrf {{-- Cross-Site Request Forgery protection --}}
        <div class="form-header">
            <h2 class="form-title">Penggantian Pulsa {{ $judul }}</h2>
        </div>

        @if($uploaded)
            <div class="form-group">
                <p class="form-tips">
                    SUDAH PERNAH UPLOAD                    
                </p>
            </div>
        @else
            <div class="form-group">
                <p class="form-description">
                    BELUM PERNAH UPLOAD.
                </p>
            </div>
        @endif
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
                <label for="handphone" class="form-label">Nomor Handphone*</label>
                <input
                    type="text"
                    name="handphone"
                    id="handphone"
                    class="form-input"
                    required
                    readonly
                    value="{{ $handphone }}"
                />
            </div>
                        <div class="form-group">
                <label for="nominal" class="form-label">Nominal*</label>
                <input
                    type="text"
                    name="nominal"
                    id="nominal"
                    class="form-input"
                    required
                    readonly
                    value="{{ $nominal }}"
                />
            </div>
                <div class="form-group">
                <p class="form-tips">
                   Contoh yang BENAR: <br/> Foto berfokus pada isi chat/SMS yang menunjukkan nominal yang jelas terlihat.                    
                </p>
                <img class="form-image" src="{{ asset('images/benar.png') }}" alt="Contoh Bukti Pulsa" class="example-image" />
            </div>
            <div class="form-group">
                <p class="form-tips">
                   Contoh yang BENAR: <br/> Jika lebih dari 1 SMS/Chat, gabung/buat collage terlebih dahulu. <br/> Untuk membuat beberapa foto menjadi satu, Anda bisa lakukan melalui link berikut: <a href="https://www.photocollage.com/" target="_blank">Photo Collage</a>.                    
                </p>
                <img class="form-image" src="{{ asset('images/collage.png') }}" alt="Contoh Bukti Pulsa" class="example-image" />
            </div>
                <div class="form-group">
                <p class="form-description">
                   Contoh yang SALAH: <br/> Screen capture layar penuh tidak berfokus pada isi chat/SMS pulsa masuk.                   
                </p>
                <img class="form-image" src="{{ asset('images/salah.png') }}" alt="Contoh Bukti Pulsa" class="example-image" />
            </div>
            <div class="form-group">
                <label for="attachment" class="form-label"
                    >Upload Gambar Bukti Pulsa masuk sesuai petunjuk.</label
                >
                <input
                    type="file"
                    name="attachment"
                    id="attachment"
                    accept=".jpg,.jpeg,.png"
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
                >Upload</button
            >
        </form>
@endsection