<?php

namespace App\Http\Controllers;

use App\Models\MailSubmission;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MailSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role == 'admin') {
            $mails = MailSubmission::latest()->paginate(10);
        } else {
            $mails = MailSubmission::where('user_id', Auth::id())->latest()->paginate(10);
        }
        $totalmails = $mails->count();
        $pendingmails = $mails->where('status', 'pending')->count();
        $resolvedmails = $mails->where('status', 'completed')->count();
        $processmails = $mails->where('status', 'process')->count();
        $rejectedmails = $mails->where('status', 'rejected')->count();
        $mailsfiles = $mails->where('file', '!=', null)->count();
        $submmissions = MailSubmission::latest()->get();
        return view('backend.admin.mailsubmission.index', compact('mails','pendingmails', 'resolvedmails', 'processmails', 'totalmails', 'mailsfiles', 'rejectedmails', 'submmissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.mailsubmission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required|string|min:16|max:16',
            'no_kk' => 'required|string|min:16|max:16',
            'no_hp' => 'required|string|max:15',
            'name' => 'required|string|max:15',
            'jenis_surat' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $data['user_id'] = Auth::user()->id;
        $createMail = MailSubmission::create($data);

        if(!$createMail) {
            return redirect()->back()->with('error', 'Failed to create mail submission.');
        }

        return redirect()->route('mail-submissions.index')->with('success', 'Mail submission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MailSubmission $mailSubmission)
    {
        return view('backend.admin.mailsubmission.show', compact('mailSubmission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MailSubmission $mailSubmission)
    {
        return view('backend.admin.mailsubmission.edit', compact('mailSubmission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MailSubmission $mailSubmission)
    {
        $data = $request->validate([
            'nik' => 'required|string|min:16|max:16',
            'no_kk' => 'required|string|min:16|max:16',
            'name' => 'required|string|max:15',
            'jenis_surat' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'image' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Buat nama file yang lebih deskriptif
            $fileName = 'surat_pendukung_' . time() . '.' . $file->getClientOriginalExtension();
            // Simpan file dan dapatkan path lengkapnya
            $path = $file->storeAs('mail_documents', $fileName, 'public');
            // Simpan path lengkap ke database
            $data['file'] = $path;
        };
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('mail_images', $imageName, 'public');
            $data['image'] = $imageName;
        }

        // $data['user_id'] = Auth::user()->id;
        $updateMail = $mailSubmission->update ($data);

        if(!$updateMail) {
            return redirect()->back()->with('error', 'Failed to update mail submission.');
        }

        return redirect()->route('mail-submissions.index')->with('success', 'Mail submission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MailSubmission $mailSubmission)
    {
        // Delete file if exists
        if ($mailSubmission->file && Storage::disk('public')->exists($mailSubmission->file)) {
            Storage::disk('public')->delete($mailSubmission->file);
        }

        $mailSubmission->delete();

        return redirect()->route('mail-submissions.index')->with('success', 'Mail submission deleted successfully.');
    }

    public function multipleDelete(Request $request)
    {
        $ids = $request->input('selected_ids');
    
        if (!empty($ids)) {
            MailSubmission::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'Data terpilih berhasil dihapus.');
        }
        else{
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
        }
    }
    

    /**
     * Update status of mail submission
     */
    public function updateStatus(Request $request, MailSubmission $mailSubmission)
    {
        $request->validate([
            'status' => 'required|in:pending,process,completed,rejected'
        ]);

        $mailSubmission->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }

    /**
     * Generate PDF file for mail submission
     */
    public function generatePdf(MailSubmission $mailSubmission)
    {
        try {
            // Create PDF content based on jenis_surat
            $pdfContent = $this->generatePdfContent($mailSubmission);

            // Configure Dompdf
            $options = new Options();
            $options->set('defaultFont', 'Arial');
            $options->set('isRemoteEnabled', true);
            $options->set('isHtml5ParserEnabled', true);

            // Create Dompdf instance
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($pdfContent);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Generate filename
            $fileName = 'surat_' . strtolower(str_replace(' ', '_', $mailSubmission->jenis_surat)) . '_' . $mailSubmission->id . '_' . date('Ymd') . '.pdf';
            
            // Save PDF to storage
            $pdfOutput = $dompdf->output();
            $filePath = 'mail_documents/' . $fileName;
            Storage::disk('public')->put($filePath, $pdfOutput);

            // Update mail submission with file path
            $mailSubmission->update([
                'file' => $filePath,
                'status' => 'completed'
            ]);

            return redirect()->back()->with('success', 'File PDF berhasil dibuat dan status diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat file PDF: ' . $e->getMessage());
        }
    }

    /**
     * Download PDF file
     */
    public function downloadPdf(MailSubmission $mailSubmission)
    {
        if (!$mailSubmission->file || !Storage::disk('public')->exists($mailSubmission->file)) {
            return redirect()->back()->with('error', 'File PDF tidak ditemukan');
        }

        $fileName = basename($mailSubmission->file);
        $filePath = storage_path('app/public/' . $mailSubmission->file);
        
        return response()->download($filePath, $fileName);
    }

    /**
     * Generate PDF content based on jenis_surat
     */
    private function generatePdfContent(MailSubmission $mailSubmission)
    {
        $date = Carbon::now()->locale('id')->isoFormat('D MMMM Y');
        
        $header = '
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="margin: 0; font-size: 16px; font-weight: bold;">KUA BATHIN</h2>
            <h3 style="margin: 5px 0; font-size: 14px;">KECAMATAN BATHIN</h3>
            <h3 style="margin: 5px 0; font-size: 14px;">JAMBI</h3>
            <hr style="border: 1px solid black; margin: 20px 0;">
        </div>';

        switch ($mailSubmission->jenis_surat) {
            case 'surat rujuk':
                return $this->generateRujukPdf($mailSubmission, $header, $date);
            case 'surat pelayanan haji':
                return $this->generatePelayananHajiPdf($mailSubmission, $header, $date);
            case 'surat rekomendasi nikah':
                return $this->generateRekomendasiNikahPdf($mailSubmission, $header, $date);
            case 'surat pengaduan gugat cerai':
                return $this->generatePengaduanGugatCeraiPdf($mailSubmission, $header, $date);
            case 'surat rekomendasi tanah wakaf':
                return $this->generateRekomendasiTanahWakafPdf($mailSubmission, $header, $date);
                default:
                return $this->generateRujukPdf($mailSubmission, $header, $date);
        }
    }

    private function generateRujukPdf($mailSubmission, $header, $date)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Surat Rujuk</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.5; margin: 40px; }
                .center { text-align: center; }
                .bold { font-weight: bold; }
                .underline { text-decoration: underline; }
                .mb-10 { margin-bottom: 10px; }
                .mb-20 { margin-bottom: 20px; }
                .indent { margin-left: 40px; }
            </style>
        </head>
        <body>
            ' . $header . '
            
            <div class="center mb-20">
                <h3 class="bold underline">SURAT RUJUK</h3>
                <p>Nomor: [NOMOR_SURAT]</p>
            </div>
            
            <p class="mb-10">Yang bertanda tangan di bawah ini, Kepala KUA Bathin, menerangkan dengan sebenarnya bahwa:</p>
            
            <div class="indent mb-20">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 150px;">Nama</td>
                        <td style="width: 10px;">:</td>
                        <td><strong>' . $mailSubmission->name . '</strong></td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>' . $mailSubmission->nik . '</td>
                    </tr>
                    <tr>
                        <td>No. KK</td>
                        <td>:</td>
                        <td>' . $mailSubmission->no_kk . '</td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td>:</td>
                        <td>' . $mailSubmission->no_hp . '</td>
                    </tr>
                </table>
            </div>
            
            <p class="mb-10">Adalah benar-benar penduduk Desa Bathin dan memiliki usaha sebagaimana keterangan: <strong>' . $mailSubmission->description . '</strong></p>
            
            <p class="mb-10">Surat keterangan ini dibuat untuk keperluan: <strong>' . $mailSubmission->description . '</strong></p>
            
            <p class="mb-20">Demikian surat keterangan ini dibuat dengan sebenar-benarnya dan dapat dipergunakan sebagaimana mestinya.</p>
            
            <div style="float: right; width: 200px; text-align: center; margin-top: 30px;">
                <p>Bathin, ' . $date . '</p>
                <p class="bold">Kepala KUA Bathin</p>
                <br><br><br>
                <p class="bold underline">Muhammad Tohir</p>
            </div>
        </body>
        </html>';
    }

    private function generatePelayananHajiPdf($mailSubmission, $header, $date)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Surat Rekomendasi Tanah Wakaf</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.5; margin: 40px; }
                .center { text-align: center; }
                .bold { font-weight: bold; }
                .underline { text-decoration: underline; }
                .mb-10 { margin-bottom: 10px; }
                .mb-20 { margin-bottom: 20px; }
                .indent { margin-left: 40px; }
            </style>
        </head>
        <body>
            ' . $header . '
            
            <div class="center mb-20">
                <h3 class="bold underline">SURAT REKOMENDASI TANAH WAKAF</h3>
                <p>Nomor: [NOMOR_SURAT]</p>
            </div>
            
            <p class="mb-10">Yang bertanda tangan di bawah ini, Kepala KUA Bathin, menerangkan bahwa:</p>
            
            <div class="indent mb-20">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 150px;">Nama</td>
                        <td style="width: 10px;">:</td>
                        <td><strong>' . $mailSubmission->name . '</strong></td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>' . $mailSubmission->nik . '</td>
                    </tr>
                    <tr>
                        <td>No. KK</td>
                        <td>:</td>
                        <td>' . $mailSubmission->no_kk . '</td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td>:</td>
                        <td>' . $mailSubmission->no_hp . '</td>
                    </tr>
                </table>
            </div>
            
            <p class="mb-10">Adalah benar-benar penduduk Desa Bathin dan memiliki usaha sebagaimana keterangan: <strong>' . $mailSubmission->description . '</strong></p>
            
            <p class="mb-20">Demikian surat keterangan ini dibuat dengan sebenar-benarnya dan dapat dipergunakan sebagaimana mestinya.</p>
            
            <div style="float: right; width: 200px; text-align: center; margin-top: 30px;">
                <p>Bathin, ' . $date . '</p>
                <p class="bold">Kepala KUA Bathin</p>
                <br><br><br>
                <p class="bold underline">Muhammad Tohir</p>
            </div>
        </body>
        </html>';
    }

    private function generatePengaduanGugatCeraiPdf($mailSubmission, $header, $date)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Surat Pengaduan Gugat Cerai</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.5; margin: 40px; }
                .center { text-align: center; }
                .bold { font-weight: bold; }
                .underline { text-decoration: underline; }
                .mb-10 { margin-bottom: 10px; }
                .mb-20 { margin-bottom: 20px; }
                .indent { margin-left: 40px; }
            </style>
        </head>
        <body>
            ' . $header . '
            
            <div class="center mb-20">
                <h3 class="bold underline">SURAT PENGADUAN GUGAT CERAI</h3>
                <p>Nomor: [NOMOR_SURAT]</p>
            </div>
            
            <p class="mb-10">Yang bertanda tangan di bawah ini, Kepala KUA Bathin, menerangkan bahwa:</p>
            
            <div class="indent mb-20">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 150px;">Nama</td>
                        <td style="width: 10px;">:</td>
                        <td><strong>' . $mailSubmission->name . '</strong></td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>' . $mailSubmission->nik . '</td>
                    </tr>
                    <tr>
                        <td>No. KK</td>
                        <td>:</td>
                        <td>' . $mailSubmission->no_kk . '</td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td>:</td>
                        <td>' . $mailSubmission->no_hp . '</td>
                    </tr>
                </table>
            </div>
            
            <p class="mb-10">Keterangan: <strong>' . $mailSubmission->description . '</strong></p>
            
            <p class="mb-20">Demikian surat keterangan ini dibuat dengan sebenar-benarnya dan dapat dipergunakan sebagaimana mestinya.</p>
            
            <div style="float: right; width: 200px; text-align: center; margin-top: 30px;">
                <p>Bathin, ' . $date . '</p>
                <p class="bold">Kepala KUA Bathin</p>
                <br><br><br>
                <p class="bold underline">Muhammad Tohir</p>
            </div>
        </body>
        </html>';
    }

    // Tambahkan method untuk jenis surat lainnya jika diperlukan
    private function generateRekomendasiTanahWakafPdf($mailSubmission, $header, $date) 
    { 
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Surat Rekomendasi Tanah Wakaf</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.5; margin: 40px; }
                .center { text-align: center; }
                .bold { font-weight: bold; }
                .underline { text-decoration: underline; }
                .mb-10 { margin-bottom: 10px; }
                .mb-20 { margin-bottom: 20px; }
                .indent { margin-left: 40px; }
            </style>
        </head>
        <body>
            ' . $header . '
            
            <div class="center mb-20">
                <h3 class="bold underline">SURAT REKOMENDASI TANAH WAKAF</h3>
                <p>Nomor: [NOMOR_SURAT]</p>
            </div>
            
            <p class="mb-10">Yang bertanda tangan di bawah ini, Kepala KUA Bathin, menerangkan dengan sebenarnya bahwa:</p>
            
            <div class="indent mb-20">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 150px;">Nama</td>
                        <td style="width: 10px;">:</td>
                        <td><strong>' . $mailSubmission->name . '</strong></td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>' . $mailSubmission->nik . '</td>
                    </tr>
                    <tr>
                        <td>No. KK</td>
                        <td>:</td>
                        <td>' . $mailSubmission->no_kk . '</td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td>:</td>
                        <td>' . $mailSubmission->no_hp . '</td>
                    </tr>
                </table>
            </div>
            
            <p class="mb-10">Adalah benar-benar penduduk Desa Bathin yang tergolong keluarga <strong>TIDAK MAMPU</strong> secara ekonomi.</p>
            
            <p class="mb-10">Keterangan ini dibuat untuk keperluan: <strong>' . $mailSubmission->description . '</strong></p>
            
            <p class="mb-20">Demikian surat keterangan ini dibuat dengan sebenar-benarnya dan dapat dipergunakan sebagaimana mestinya.</p>
            
            <div style="float: right; width: 200px; text-align: center; margin-top: 30px;">
                <p>Bathin, ' . $date . '</p>
                <p class="bold">Kepala KUA Bathin</p>
                <br><br><br>
                <p class="bold underline">MUHAMMAD_TOHIR</p>
            </div>
        </body>
        </html>';
    }
    
    private function generateRekomendasiNikahPdf($mailSubmission, $header, $date) 
    { 
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Surat Rekomendasi Nikah</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.5; margin: 40px; }
                .center { text-align: center; }
                .bold { font-weight: bold; }
                .underline { text-decoration: underline; }
                .mb-10 { margin-bottom: 10px; }
                .mb-20 { margin-bottom: 20px; }
                .indent { margin-left: 40px; }
            </style>
        </head>
        <body>
            ' . $header . '
            
            <div class="center mb-20">
                <h3 class="bold underline">SURAT REKOMENDASI NIKAH</h3>
                <p>Nomor: [NOMOR_SURAT]</p>
            </div>
            
            <p class="mb-10">Yang bertanda tangan di bawah ini, Kepala KUA Bathin, menerangkan bahwa:</p>
            
            <div class="indent mb-20">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 150px;">Nama Almarhum/Almarhumah</td>
                        <td style="width: 10px;">:</td>
                        <td><strong>' . $mailSubmission->name . '</strong></td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>' . $mailSubmission->nik . '</td>
                    </tr>
                    <tr>
                        <td>No. KK</td>
                        <td>:</td>
                        <td>' . $mailSubmission->no_kk . '</td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>' . $mailSubmission->description . '</td>
                    </tr>
                </table>
            </div>
            
            <p class="mb-10">Adalah benar-benar penduduk Desa Bathin yang telah <strong>MENINGGAL DUNIA</strong>.</p>
            
            <p class="mb-20">Demikian surat keterangan ini dibuat dengan sebenar-benarnya dan dapat dipergunakan sebagaimana mestinya.</p>
            
            <div style="float: right; width: 200px; text-align: center; margin-top: 30px;">
                <p>Bathin, ' . $date . '</p>
                <p class="bold">Kepala KUA Bathin</p>
                <br><br><br>    
                <p class="bold underline">Muhammad Tohir</p>
            </div>
        </body>
        </html>';
    }   

    
    
    private function generateBimbinganKeluargaPdf($mailSubmission, $header, $date) { return $this->generateBimbinganKeluargaPdf($mailSubmission, $header, $date); }
    private function generateBimbinganPerkawinanPdf($mailSubmission, $header, $date) { return $this->generateBimbinganPerkawinanPdf($mailSubmission, $header, $date); }
    private function generateLayananKeagamaanPdf($mailSubmission, $header, $date) { return $this->generateLayananKeagamaanPdf($mailSubmission, $header, $date); }
    private function generateLayananBimbinganHajiPdf($mailSubmission, $header, $date) { return $this->generateLayananBimbinganHajiPdf($mailSubmission, $header, $date); }
}
