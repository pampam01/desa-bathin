@extends('backend.admin.layouts.app')

@section('title', 'Detail Pengajuan Surat - Portal Parakan')

@section('page-header')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Portal Parakan / Pengajuan Surat /</span> Detail Pengajuan Surat
        </h4>
        <div class="d-flex gap-2">
            {{-- <a href="{{ route('mail-submissions.edit', $mailSubmission->id) }}" class="btn btn-warning">
                <i class="bx bx-edit me-1"></i> Edit
            </a> --}}
            <a href="{{ route('mail-submissions.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .news-image {
            max-width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }

        .news-content {
            line-height: 1.6;
        }

        .news-meta {
            border-left: 4px solid #696cff;
            padding-left: 1rem;
            background-color: #f8f9ff;
        }

        .status-badge {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }

        .news-stats {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Mail Submission Details -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bx bx-detail me-2"></i>Detail Pengajuan Surat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Informasi Pemohon</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-semibold" style="width: 120px;">Nama:</td>
                                    <td>{{ $mailSubmission->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">NIK:</td>
                                    <td>{{ $mailSubmission->nik }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">No. KK:</td>
                                    <td>{{ $mailSubmission->no_kk }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">No. HP:</td>
                                    <td>{{ $mailSubmission->no_hp ?? 'Tidak ada' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Informasi Surat</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-semibold" style="width: 120px;">Jenis Surat:</td>
                                    <td>{{ $mailSubmission->jenis_surat }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Status:</td>
                                    <td>
                                        @if ($mailSubmission->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($mailSubmission->status == 'process')
                                            <span class="badge bg-info">Diproses</span>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Dibuat:</td>
                                    <td>{{ $mailSubmission->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">File:</td>
                                    <td>
                                        @if ($mailSubmission->file)
                                            <span class="badge bg-success">
                                                <i class="bx bx-check me-1"></i>Tersedia
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="bx bx-x me-1"></i>Belum ada
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted">Deskripsi/Keperluan</h6>
                        <div class="p-3 bg-light rounded">
                            {!! $mailSubmission->description !!}
                        </div>
                    </div>

                    @if (Auth::user()->role == 'admin')
                      <!-- Status Update Section -->
                      <div class="card border-primary">
                          <div class="card-header bg-primary text-white">
                              <h6 class="mb-0 text-white">
                                  <i class="bx bx-cog me-2 text-white"></i>Ubah Status
                              </h6>
                          </div>
                          <div class="card-body">
                              <form action="{{ route('mail-submissions.update-status', $mailSubmission->id) }}"
                                  method="POST">
                                  @csrf
                                  @method('PATCH')
                                  <div class="row align-items-end">
                                      <div class="col-md-6 mt-4">
                                          <label for="status" class="form-label">Status Surat</label>
                                          <select class="form-select" id="status" name="status" required>
                                              <option value="pending"
                                                  {{ $mailSubmission->status == 'pending' ? 'selected' : '' }}>Pending
                                              </option>
                                              <option value="process"
                                                  {{ $mailSubmission->status == 'process' ? 'selected' : '' }}>Diproses
                                              </option>
                                              <option value="completed"
                                                  {{ $mailSubmission->status == 'completed' ? 'selected' : '' }}>Selesai
                                              </option>
                                          </select>
                                      </div>
                                      <div class="col-md-6">
                                          <button type="submit" class="btn btn-primary">
                                              <i class="bx bx-save me-2"></i>Update Status
                                          </button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- News Info -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="bx bx-info-circle me-2"></i>Informasi Pengajuan Surat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="news-meta p-3 mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <small class="text-muted">ID Pengajuan Surat:</small>
                            </div>
                            <div class="col-sm-8">
                                <small class="fw-semibold">#{{ $mailSubmission->id }}</small>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <small class="text-muted">Status:</small>
                            </div>
                            <div class="col-sm-8">
                                @if ($mailSubmission->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($mailSubmission->status == 'process')
                                    <span class="badge bg-info">Diproses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <small class="text-muted">Dibuat:</small>
                            </div>
                            <div class="col-sm-8">
                                <small class="fw-semibold">{{ $mailSubmission->created_at->format('d M Y H:i') }}</small>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <small class="text-muted">Diperbarui:</small>
                            </div>
                            <div class="col-sm-8">
                                <small class="fw-semibold">{{ $mailSubmission->updated_at->format('d M Y H:i') }}</small>
                            </div>
                        </div>
                        @if ($mailSubmission->file)
                            <hr class="my-2">
                            <div class="row">
                                <div class="col-sm-4">
                                    <small class="text-muted">File PDF:</small>
                                </div>
                                <div class="col-sm-8">
                                    <span class="badge bg-success">
                                        <i class="bx bx-check me-1"></i>Tersedia
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="bx bx-cog me-2"></i>Aksi
                    </h6>
                </div>
                <div class="card-body">
                    @if (Auth::user()->role == 'admin')
                        <div class="d-grid gap-2">
                            <!-- Generate PDF Button -->
                            @if ($mailSubmission->file)
                                <!-- Download PDF Button -->
                                <a href="{{ route('mail-submissions.download-pdf', $mailSubmission->id) }}"
                                    class="btn btn-primary">
                                    <i class="bx bx-download me-2"></i>Download File PDF
                                </a>

                                <!-- Regenerate PDF Button -->
                                <form action="{{ route('mail-submissions.generate-pdf', $mailSubmission->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success w-100"
                                        onclick="return confirm('Yakin ingin membuat ulang file PDF?')">
                                        <i class="bx bx-refresh me-2"></i>Buat Ulang PDF
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('mail-submissions.generate-pdf', $mailSubmission->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100"
                                        onclick="return confirm('Yakin ingin membuat file PDF? Status akan otomatis diubah menjadi Selesai.')">
                                        <i class="bx bx-file-blank me-2"></i>Buat File PDF
                                    </button>
                                </form>
                            @endif

                            <hr>

                            <!-- Edit Button -->
                            <a href="{{ route('mail-submissions.edit', $mailSubmission->id) }}" class="btn btn-warning">
                                <i class="bx bx-edit me-2"></i>Edit Pengajuan Surat
                            </a>

                            <hr>

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-outline-danger"
                                onclick="confirmDelete({{ $mailSubmission->id }}, '{{ $mailSubmission->name }} - {{ $mailSubmission->jenis_surat }}')">
                                <i class="bx bx-trash me-2"></i>Hapus Pengajuan Surat
                            </button>
                        </div>
                    @else
                    <div class="d-grid gap-2">
                            <!-- Generate PDF Button -->
                            @if ($mailSubmission->file)
                                <!-- Download PDF Button -->
                                <a href="{{ route('mail-submissions.download-pdf', $mailSubmission->id) }}"
                                    class="btn btn-primary">
                                    <i class="bx bx-download me-2"></i>Download File PDF
                                </a>

                            @else
                                <div class="">
                                  File Surat Belum Dibuatkan oleh Desa
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalTitle">Gambar Pengajuan Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showImageModal(imageSrc, title) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModalTitle').textContent = title;
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        }

        function confirmDelete(id, title) {
            showConfirmModal(
                `Apakah Anda yakin ingin menghapus Pengajuan Surat "${title}"? Tindakan ini tidak dapat dibatalkan.`,
                function() {
                    // Create form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/mail-submissions/${id}`;

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    const tokenInput = document.createElement('input');
                    tokenInput.type = 'hidden';
                    tokenInput.name = '_token';
                    tokenInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    form.appendChild(methodInput);
                    form.appendChild(tokenInput);
                    document.body.appendChild(form);

                    showLoading();
                    form.submit();
                }
            );
        }
    </script>
@endpush
