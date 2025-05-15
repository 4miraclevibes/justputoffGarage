@extends('layouts.backend.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header">
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Jadwal</button>
    </div>
  </div>

  <div class="card mt-2">
    <h5 class="card-header">Daftar Jadwal</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Tanggal</th>
            <th class="text-white">Status</th>
            <th class="text-white">Libur</th>
            <th class="text-white">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($schedules as $schedule)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ \Carbon\Carbon::parse($schedule->tanggal)->locale('id')->translatedFormat('l, d M Y H:i') }}</td>
            <td>
              <span class="badge bg-{{ $schedule->status ? 'success' : 'secondary' }}">
                {{ $schedule->status ? 'Aktif' : 'Booked' }}
              </span>
            </td>
            <td>
              <span class="badge bg-{{ $schedule->is_libur ? 'danger' : 'info' }}">
                {{ $schedule->is_libur ? 'Ya' : 'Tidak' }}
              </span>
            </td>
            <td>
              <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $schedule->id }}">Edit</button>
              <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- / Content -->

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Jadwal Bulanan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('schedules.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="start_date" class="form-label">Mulai Tanggal</label>
              <input type="date" class="form-control" name="start_date" required>
            </div>
            <div class="mb-3">
              <label for="end_date" class="form-label">Sampai Tanggal</label>
              <input type="date" class="form-control" name="end_date" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>


<!-- Edit Modal -->
@foreach($schedules as $schedule)
<div class="modal fade" id="editModal{{ $schedule->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Jadwal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="status" id="statusSwitch{{ $schedule->id }}" {{ $schedule->status ? 'checked' : '' }}>
            <label class="form-check-label" for="statusSwitch{{ $schedule->id }}">Aktif</label>
          </div>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_libur" id="liburSwitch{{ $schedule->id }}" {{ $schedule->is_libur ? 'checked' : '' }}>
            <label class="form-check-label" for="liburSwitch{{ $schedule->id }}">Libur</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@endsection
