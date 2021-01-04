@extends('home')

@section('main')
    
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tabel Pegawai
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{ url('pegawai/create') }}">Tambah Pegawai</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                                                                    
                                        {{-- {!! Form::open(['url' => 'bagian']) !!} --}}
                                        <form action="{{ url('pegawai') }}" method="POST">
                                            @csrf
                                        <div class="form-group">
                                          <div class="form-line">
                                            <label>Nama Pegawai</label>
                                            <input type="text" name="nama" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                          <div class="form-line">
                                            <label>Tanggal Masuk</label>
                                            <input type="date" name="tgl_masuk" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                          <div class="form-line">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" value="Simpan" class="btn btn-primary form-control">
                                        </div>
                                        </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection