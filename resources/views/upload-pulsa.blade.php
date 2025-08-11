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

        @if($uploaded && $edit !== 'edit')
            <div class="form-group">
                <p class="form-tips">
                    TELAH MELAKUKAN UPLOAD BUKTI PENERIMAAN PULSA                    
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
            @if($uploaded && $edit !== 'edit')
                 <img class="form-image" src="{{ Storage::disk('pulsa')->url($path) }}" alt="Contoh Bukti Pulsa" class="example-image" />
                <input type="hidden" name="edit" value="edit" />
            @else
   
            <div class="form-group">
                <label for="attachment" class="form-label"
                    >Bukti Pulsa Masuk</label
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
            @endif

 
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="form-group">
                <p class="form-error">
                 {{ $error }}
                </p>
            </div>
            @endforeach
            @endif
            <div class="form-group">
                <button type="button" class="back-btn" onclick="window.location='{{ route('pulsa-actions', ['token' => $token]) }}'">KEMBALI</button>
            </div>
           <!-- Submit Button -->
            <button type="submit" class="submit-btn"
                >       
                @if($uploaded && $edit !== 'edit')
                UBAH
                @else
                KIRIM
                @endif
        </button>
                <div class="form-group">
                <p class="form-description">
                   BACA DULU PETUNJUK UPLOAD SEBELUM KIRIM!!!.                    
                </p>
              
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
                <p class="form-warning">
                   Contoh yang SALAH: <br/> Screen capture layar penuh tidak berfokus pada isi chat/SMS pulsa masuk.                   
                </p>
                <img class="form-image" src="{{ asset('images/salah.png') }}" alt="Contoh Bukti Pulsa" class="example-image" />
            </div>
        </form>
@endsection