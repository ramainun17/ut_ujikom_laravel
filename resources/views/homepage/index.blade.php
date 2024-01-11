@extends('layouts.template')
@section('content')

<!-- section header -->
<header class="masthead" style="background-image: url('/img/des3.png'); background-size: cover; width: 100%; height: 100vh; background-repeat: no-repeat; background-position: center;">
    <div class="container opacity">
        <div class="row align-items-center v-100">
            <div class="col-12">
                <div class="text-center rounded" style="margin: 20% 25% 0%; padding: 20px;">
                    <h1 class="text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Layanan Service Kendaraan</h1>
                    <p class="lead text-dark">Kami siap merawat kendaraan anda</p>
                    @auth
                    <form action="/pesan_layanan" method="post">
                        @csrf
                        <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Pesan
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Form Permintaan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label style="font-weight: 500;" class="form-label">Tipe Kendaraan</label>
                                                    <select name="id_kendaraan" class="form-select {{ $errors->has('id_kendaraan') ? 'is-invalid' : '' }}">
                                                        <option>--Pilih Kendaraan--</option>
                                                        @foreach($kendaraan as $k)
                                                            <option value="{{$k->id_kendaraan}}">{{$k->tipe_kendaraan}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_kendaraan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label style="font-weight: 500;" class="form-label">Nama Pemesan</label>
                                                    <input type="text" class="form-control shadow-none" value="{{ Auth::user()->name }}" disabled>
                                                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label style="font-weight: 500;" class="form-label">Nomor Mesin</label>
                                                    <input type="text" name="nomor_mesin" class="form-control shadow-none {{ $errors->has('nomor_mesin') ? 'is-invalid' : '' }}"  placeholder="Ex:09589362785">
                                                    @error('nomor_mesin')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label style="font-weight: 500;" class="form-label">Nomor Telepon (yang bisa dihubungi)</label>
                                                    <input type="text" name="nomor_telpon" class="form-control shadow-none {{ $errors->has('nomor_telpon') ? 'is-invalid' : '' }}" placeholder="Ex:+62 xxxxxxx">
                                                    @error('nomor_telpon')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label style="font-weight: 500;" class="form-label">Nomor Polisi</label>
                                                    <input type="text" name="nomor_polisi" class="form-control shadow-none {{ $errors->has('nomor_polisi') ? 'is-invalid' : '' }}" placeholder="Ex: N 1234 ABC">
                                                    @error('nomor_polisi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label style="font-weight: 500;" class="form-label">Jadwal Reparasi</label>
                                                    <input type="datetime-local" name="tgl_booking" class="form-control shadow-none {{ $errors->has('tgl_booking') ? 'is-invalid' : '' }}" placeholder="Pilih Jadwal Reparasi">
                                                    @error('tgl_booking')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label style="font-weight: 500;" class="form-label">Merek Kendaraan</label>
                                                    <input type="text" name="seri_kendaraan" class="form-control shadow-none {{ $errors->has('seri_kendaraan') ? 'is-invalid' : '' }}" placeholder="Ex: Scoopy">
                                                    @error('seri_kendaraan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label style="font-weight: 500;" class="form-label">Alamat Lengkap</label>
                                                    <input type="text" name="alamat" class="form-control shadow-none {{ $errors->has('alamat') ? 'is-invalid' : '' }}" placeholder="Ex: Jalan Kepompong" >
                                                    @error('alamat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label style="font-weight: 500;" class="form-label">Layanan</label>
                                                    <select name="id_layanan" class="form-select {{ $errors->has('id_layanan') ? 'is-invalid' : '' }}">
                                                        <option>--Pilih Layanan--</option>
                                                        @foreach($layanan as $k)
                                                            <option value="{{$k->id_layanan}}">{{$k->nama_layanan}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_layanan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        
                                        @csrf
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Reservasi</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>

{{-- section riwayat --}}
@auth
<section id="riwayat" class="bg-white p-5">
    <div class="" style="margin-top: 20px;">
        <h2 class="fw-bold h-font text-center">Riwayat Pemesanan</h2><br>
    </div>
    <div class="container">
        <div class="row">
            @foreach($order as $r)
            <div class="col-lg-3 col-md-6 my-3">
                <div class="bg-white rounded shadow border-0 shadow" style="max-width: 350px; margin: auto;">
                    <div class="card-body p-4">
                        <h4 class="card-title">{{$r->layanan->nama_layanan}}</h4>
                        <h6 class="mb-4 text-success text-right">Rp. {{number_format($r->layanan->harga, 2)}}</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Tipe: {{ $r->kendaraan->tipe_kendaraan }}</h6>
                            <span class="badge rounded bg-light text-dark text-wrap">
                                {{$r->nomor_polisi}}
                            </span>
                            <span class="badge rounded bg-light text-dark text-wrap">
                                {{$r->nomor_mesin}}
                            </span>
                            <h6 class="mb-1">Tanggal Pemesanan:</h6>
                            <span class="badge rounded bg-light text-dark text-wrap">
                                {{$r->tgl_booking}}
                            </span>
                            <h6 class="mb-1">Status:</h6>
                            <span class="badge rounded bg-info text-dark text-wrap">
                                {{$r->status}}
                            </span>
                        </div>
                        {{-- jika status = dikonfirmasi --}}
                        @if ($r->status == "dikonfirmasi")
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            {{-- form button batalkan  --}}
                            <form action="/cancel/{{ $r->id_order }}" method="post">
                                @csrf
                                @method('put')
                                <button type="button" class="btn btn-danger me-md-5" data-bs-toggle="modal" data-bs-target="#batalorder">Batalkan</button>
                                <div class="modal fade" id="batalorder" tabindex="-1" aria-labelledby="batalorderlabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="batalorderlabel">Konfirmasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <input type="text" name="status" value="dibatalkan" hidden>
                                                <p>Apakah anda yakin ingin membatalkan reservasi anda?</p>
                                            </div>
                                            <div class="modal-footer">
                                                @csrf
                                                @method('put')
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                                <button type="submit" class="btn btn-danger">Batalkan Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            {{-- form button bayar --}}
                            <form action="/transaksi" method="post">
                                @csrf
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bayarorder">
                                        Bayar
                                    </button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="bayarorder" tabindex="-1" aria-labelledby="bayarorderlabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="bayarorderlabel">Konfirmasi Data Pemesanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h4>Data User</h4>
                                                        <p>
                                                            <strong>Nama</strong>: <span>{{ $r->user->name }}</span><br>
                                                            <strong>No. telp</strong>: <span>{{ $r->nomor_telpon }}</span><br>
                                                            <strong>Alamat</strong>: <span>{{ $r->alamat }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-4">
                                                        <h4>Data Kendaraan</h4>
                                                        <p> 
                                                            <strong>Tipe</strong>: <span>{{ $r->kendaraan->tipe_kendaraan }}</span><br>
                                                            <strong>Merk</strong>: <span>{{ $r->seri_kendaraan }}</span><br>
                                                            <strong>No. Mesin</strong>: <span>{{ $r->nomor_mesin }}</span><br>
                                                            <strong>No. Polisi</strong>: <span>{{ $r->nomor_polisi }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-4">
                                                        <h4>Data Pemesanan</h4>
                                                        <p> 
                                                            <strong>Tanggal Service</strong>: <span>{{ \Carbon\Carbon::parse($r->tgl_booking)->isoFormat('D MMMM YYYY HH:mm') }}</span><br>
                                                            <strong>Layanan</strong>: <span>{{ $r->layanan->nama_layanan }}</span><br>
                                                            <strong>Harga</strong>: <span>Rp. {{ number_format($r->layanan->harga, 2) }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p> 
                                                            <strong>Status</strong>: <span>{{ $r->status }}</span><br>
                                                            <strong>Teknisi</strong>: <span>{{ $r->teknisi }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p> 
                                                            <strong>Tambahan</strong>: <span>{{ $r->status }}</span><br>
                                                            @foreach($produk as $pro)
                                                            <input type="checkbox" class="form-check-input" name="id_produk[]" value="{{ $pro->id_produk }}" id="{{ $pro->nama_produk }}">
                                                            <label for="{{ $pro->nama_produk }}">{{$pro->nama_produk}} -- Rp. <span>{{ number_format($pro->harga) }}</span></label><br>
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p> 
                                                            <strong>Total Harga</strong>: <br><span class="text-success">{{ number_format($r->layanan->harga) }}</span><br>
                                                            <input type="text" name="total_harga" id="total_harga" class="form-control {{ $errors->has('total_harga') ? 'is-invalid' : '' }}" value="{{ $r->layanan->harga }}" hidden>
                                                            @error('total_harga')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            <input type="text" name="id_order" id="id_order" class="form-control {{ $errors->has('id_order') ? 'is-invalid' : '' }}" value="{{ $r->id_order }}" hidden>
                                                            @error('id_order')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                
                                                @csrf
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                                <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- jika status = pending --}}
                        @elseif ($r->status == "pending")
                        <form action="/pesan_layanan/edit/{{ $r->id_order }}" method="post">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editorder">
                                    Edit
                                </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="editorder" tabindex="-1" aria-labelledby="editorderlabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editorderlabel">Form Edit Permintaan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: 500;" class="form-label">Tipe Kendaraan</label>
                                                        <select name="id_kendaraan" class="form-select {{ $errors->has('id_kendaraan') ? 'is-invalid' : '' }}">
                                                            <option>--Pilih Kendaraan--</option>
                                                            @foreach($kendaraan as $k)
                                                                <option value="{{$k->id_kendaraan}}" {{ $r->id_kendaraan == $k->id_kendaraan ? 'selected' : '' }}>{{$k->tipe_kendaraan}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('id_kendaraan')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: 500;" class="form-label">Nama Pemesan</label>
                                                        <input type="text" class="form-control shadow-none" value="{{ Auth::user()->name }}" disabled>
                                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: 500;" class="form-label">Nomor Mesin</label>
                                                        <input type="text" name="nomor_mesin" class="form-control shadow-none {{ $errors->has('nomor_mesin') ? 'is-invalid' : '' }}"  placeholder="Ex:09589362785" value="{{ $r->nomor_mesin }}">
                                                        @error('nomor_mesin')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: 500;" class="form-label">Nomor Telepon (yang bisa dihubungi)</label>
                                                        <input type="text" name="nomor_telpon" class="form-control shadow-none {{ $errors->has('nomor_telpon') ? 'is-invalid' : '' }}" placeholder="Ex:+62 xxxxxxx" value="{{ $r->nomor_telpon }}">
                                                        @error('nomor_telpon')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: 500;" class="form-label">Nomor Polisi</label>
                                                        <input type="text" name="nomor_polisi" class="form-control shadow-none {{ $errors->has('nomor_polisi') ? 'is-invalid' : '' }}" placeholder="Ex: N 1234 ABC" value="{{ $r->nomor_polisi }}">
                                                        @error('nomor_polisi')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: 500;" class="form-label">Jadwal Reparasi</label>
                                                        <input type="datetime-local" name="tgl_booking" class="form-control shadow-none {{ $errors->has('tgl_booking') ? 'is-invalid' : '' }}" placeholder="Pilih Jadwal Reparasi" value="{{ $r->tgl_booking }}">
                                                        @error('tgl_booking')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: 500;" class="form-label">Merek Kendaraan</label>
                                                        <input type="text" name="seri_kendaraan" class="form-control shadow-none {{ $errors->has('seri_kendaraan') ? 'is-invalid' : '' }}" placeholder="Ex: Scoopy" value="{{ $r->seri_kendaraan }}">
                                                        @error('seri_kendaraan')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: 500;" class="form-label">Alamat Lengkap</label>
                                                        <input type="text" name="alamat" class="form-control shadow-none {{ $errors->has('alamat') ? 'is-invalid' : '' }}" placeholder="Ex: Jalan Kepompong" value="{{ $r->alamat }}">
                                                        @error('alamat')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label style="font-weight: 500;" class="form-label">Layanan</label>
                                                        <select name="id_layanan" class="form-select {{ $errors->has('id_layanan') ? 'is-invalid' : '' }}">
                                                            <option>--Pilih Layanan--</option>
                                                            @foreach($layanan as $k)
                                                                <option value="{{$k->id_layanan}}" {{ $r->id_layanan == $k->id_layanan ? 'selected' : '' }}>{{$k->nama_layanan}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('id_layanan')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            
                                            @csrf
                                            @method('put')
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                            <button type="submit" class="btn btn-warning">Edit Pemesanan</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- selain itu --}}
                        @else
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#detailorder">Detail</button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="detailorder" tabindex="-1" aria-labelledby="detailorderlabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailorderlabel">Detail Reservasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <div class="row">
                                                <div class="col-4">
                                                    <h4>Data User</h4>
                                                    <p>
                                                        <strong>Nama</strong>: <span>{{ $r->user->name }}</span><br>
                                                        <strong>No. telp</strong>: <span>{{ $r->nomor_telpon }}</span><br>
                                                        <strong>Alamat</strong>: <span>{{ $r->alamat }}</span>
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <h4>Data Kendaraan</h4>
                                                    <p> 
                                                        <strong>Tipe</strong>: <span>{{ $r->kendaraan->tipe_kendaraan }}</span><br>
                                                        <strong>Merk</strong>: <span>{{ $r->seri_kendaraan }}</span><br>
                                                        <strong>No. Mesin</strong>: <span>{{ $r->nomor_mesin }}</span><br>
                                                        <strong>No. Polisi</strong>: <span>{{ $r->nomor_polisi }}</span>
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <h4>Data Pemesanan</h4>
                                                    <p> 
                                                        <strong>Tanggal Service</strong>: <span>{{ \Carbon\Carbon::parse($r->tgl_booking)->isoFormat('D MMMM YYYY HH:mm') }}</span><br>
                                                        <strong>Layanan</strong>: <span>{{ $r->layanan->nama_layanan }}</span><br>
                                                        <strong>Harga</strong>: <span>Rp. {{ number_format($r->layanan->harga, 2) }}</span><br>
                                                    </p>
                                                </div>
                                                <div class="col-6">
                                                    <p> 
                                                        <strong>Status</strong>: <span>{{ $r->status }}</span><br>
                                                        <strong>Teknisi</strong>: <span>{{ $r->teknisi }}</span><br>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script>
                $(document).ready(function () {
                    // Inisialisasi total harga
                    updateTotalHarga();
            
                    // Event listener untuk checkbox tambahan
                    $('input[type="checkbox"]').change(function () {
                        updateTotalHarga();
                    });
            
                    // Fungsi untuk mengupdate total harga
                    function updateTotalHarga() {
                        // Inisialisasi total harga dengan harga layanan
                        var totalHarga = parseFloat('{{ $r->layanan->harga }}');
            
                        // Tambahkan harga checkbox tambahan yang dipilih
                        $('input[type="checkbox"]:checked').each(function () {
                            totalHarga += parseFloat($(this).next('label').find('span').text().replace(',', ''));
                        });
            
                        // Update tampilan total harga
                        $('#total_harga').val(totalHarga);
                        $('.text-success').text('Rp. ' + totalHarga.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    
                    }
                });
            </script>
            @endforeach
        </div>
    </div>
</section>
@endauth

{{-- section about --}}
<section id="about" class="bg-dark p-5">
    <div class="container px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="text-white mt-0">ZEN Bengkel</h2>
          <p class="text-white mb-4">
            Pelayanan Perawatan Kendaraan Bersertifikat Ahli
          </p>
          <div class="border mb-4"></div>
          <p class="text-white mb-4">
            ZEN Bengkel hadir dalam melayani perawatan kendaraan anda. Dengan teknisi yang ahli dan produk yang berkualitas, ZEN Bengkel mampu memberikan anda pengalaman berkendara menjadi lebih baik
          </p>
        </div>
      </div>
    </div>
</section>

{{-- section layanan  --}}
<section id="layanan" class="bg-white p-5">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="text-dark mt-0">LAYANAN ZEN Bengkel</h2>
                <div class="border mb-4"></div>
                <p class="text-dark mb-4">
                    Layanan yang kami sediakan dengan teknisi yang ahli dan cekatan
                </p>
            </div>
            <div class="row">
                @foreach ($layanan as $l)
                <div class="col-sm-2">
                    <div class="card text-light text-center">
                        <h5 class="card-header bg-secondary">{{ $l->nama_layanan }}</h5>
                        <div class="card-body bg-dark">
                            <p class="card-text">{{ $l->keterangan }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- section produk  --}}
<section id="produk" class="bg-dark p-5">
    <div class="container px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="text-white mt-0">PRODUK ZEN Bengkel</h2>
          <div class="border mb-4"></div>
          <p class="text-white mb-4">
            Kami menyediakan beberapa suku cadang dan produk tambahan lain yang dapat anda gunakan sebagai tambahan layanan kami
          </p>
        </div>
        <div class="row">
            @foreach ($produk as $p)
            <div class="col-sm-2">
                <div class="card bg-white text-dark text-center">
                    <h5 class="card-header">{{ $p->nama_produk }}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ $l->harga }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
      </div>
    </div>
</section>

@endsection