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
        if(Auth::user()->role !== 'admin') {
            $mails = MailSubmission::latest()->paginate(10);
        } else {
            $mails = MailSubmission::where('user_id', Auth::id())->latest()->paginate(10);
        }
        $totalmails = $mails->count();
        $pendingmails = $mails->where('status', 'pending')->count();
        $resolvedmails = $mails->where('status', 'completed')->count();
        $processmails = $mails->where('status', 'process')->count();
        $mailsfiles = $mails->where('file', '!=', null)->count();
        return view('backend.admin.mailsubmission.index', compact('mails','pendingmails', 'resolvedmails', 'processmails', 'totalmails', 'mailsfiles'));
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
            'nik' => 'required|string|max:255',
            'no_kk' => 'required|string|max:255',
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
            'nik' => 'required|string|max:255',
            'no_kk' => 'required|string|max:255',
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

        $data['user_id'] = Auth::user()->id;
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

    /**
     * Update status of mail submission
     */
    public function updateStatus(Request $request, MailSubmission $mailSubmission)
    {
        $request->validate([
            'status' => 'required|in:pending,process,completed'
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
            <h2 style="margin: 0; font-size: 16px; font-weight: bold;">PEMERINTAH DESA PARAKAN</h2>
            <h3 style="margin: 5px 0; font-size: 14px;">KECAMATAN MALEBER</h3>
            <h3 style="margin: 5px 0; font-size: 14px;">KABUPATEN KUNINGAN</h3>
            <hr style="border: 1px solid black; margin: 20px 0;">
        </div>';

        switch ($mailSubmission->jenis_surat) {
            case 'Surat Keterangan Domisili':
                return $this->generateDomisiliPdf($mailSubmission, $header, $date);
            case 'Surat Keterangan Usaha':
                return $this->generateUsahaPdf($mailSubmission, $header, $date);
            case 'Surat Keterangan Tidak Mampu':
                return $this->generateTidakMampuPdf($mailSubmission, $header, $date);
            case 'Surat Keterangan Kematian':
                return $this->generateKematianPdf($mailSubmission, $header, $date);
            case 'Surat Keterangan Lahir':
                return $this->generateLahirPdf($mailSubmission, $header, $date);
            case 'Surat Keterangan Pindah':
                return $this->generatePindahPdf($mailSubmission, $header, $date);
            case 'Surat Keterangan Belum Menikah':
                return $this->generateBelumMenikahPdf($mailSubmission, $header, $date);
            case 'Surat Keterangan Cerai':
                return $this->generateCeraiPdf($mailSubmission, $header, $date);
            default:
                return $this->generateDefaultPdf($mailSubmission, $header, $date);
        }
    }

    private function generateDomisiliPdf($mailSubmission, $header, $date)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Surat Keterangan Domisili</title>
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
                <h3 class="bold underline">SURAT KETERANGAN DOMISILI</h3>
                <p>Nomor: [NOMOR_SURAT]</p>
            </div>
            
            <p class="mb-10">Yang bertanda tangan di bawah ini, Kepala Desa Parakan, menerangkan bahwa:</p>
            
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
            
            <p class="mb-10">Adalah benar-benar penduduk Desa Parakan dan berdomisili di alamat tersebut di atas.</p>
            
            <p class="mb-10">Surat keterangan ini dibuat untuk keperluan: <strong>' . $mailSubmission->description . '</strong></p>
            
            <p class="mb-20">Demikian surat keterangan ini dibuat dengan sebenar-benarnya dan dapat dipergunakan sebagaimana mestinya.</p>
            
            <div style="float: right; width: 200px; text-align: center; margin-top: 30px;">
                <p>Parakan, ' . $date . '</p>
                <p class="bold">Kepala Desa Parakan</p>
                <br><br><br>
                <p class="bold underline">Muhammad Tohir</p>
            </div>
        </body>
        </html>';
    }

    private function generateUsahaPdf($mailSubmission, $header, $date)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Surat Keterangan Usaha</title>
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
                <h3 class="bold underline">SURAT KETERANGAN USAHA</h3>
                <p>Nomor: [NOMOR_SURAT]</p>
            </div>
            
            <p class="mb-10">Yang bertanda tangan di bawah ini, Kepala Desa Parakan, menerangkan bahwa:</p>
            
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
            
            <p class="mb-10">Adalah benar-benar penduduk Desa Parakan dan memiliki usaha sebagaimana keterangan: <strong>' . $mailSubmission->description . '</strong></p>
            
            <p class="mb-20">Demikian surat keterangan ini dibuat dengan sebenar-benarnya dan dapat dipergunakan sebagaimana mestinya.</p>
            
            <div style="float: right; width: 200px; text-align: center; margin-top: 30px;">
                <p>Parakan, ' . $date . '</p>
                <p class="bold">Kepala Desa Parakan</p>
                <br><br><br>
                <p class="bold underline">Muhammad Tohir</p>
            </div>
        </body>
        </html>';
    }

    private function generateDefaultPdf($mailSubmission, $header, $date)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>' . $mailSubmission->jenis_surat . '</title>
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
                <h3 class="bold underline">' . strtoupper($mailSubmission->jenis_surat) . '</h3>
                <p>Nomor: [NOMOR_SURAT]</p>
            </div>
            
            <p class="mb-10">Yang bertanda tangan di bawah ini, Kepala Desa Parakan, menerangkan bahwa:</p>
            
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
                <p>Parakan, ' . $date . '</p>
                <p class="bold">Kepala Desa Parakan</p>
                <br><br><br>
                <p class="bold underline">Muhammad Tohir</p>
            </div>
        </body>
        </html>';
    }

    // Tambahkan method untuk jenis surat lainnya jika diperlukan
    private function generateTidakMampuPdf($mailSubmission, $header, $date) 
    { 
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Surat Keterangan Tidak Mampu</title>
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
                <h3 class="bold underline">SURAT KETERANGAN TIDAK MAMPU</h3>
                <p>Nomor: [NOMOR_SURAT]</p>
            </div>
            
            <p class="mb-10">Yang bertanda tangan di bawah ini, Kepala Desa Parakan, menerangkan dengan sebenarnya bahwa:</p>
            
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
            
            <p class="mb-10">Adalah benar-benar penduduk Desa Parakan yang tergolong keluarga <strong>TIDAK MAMPU</strong> secara ekonomi.</p>
            
            <p class="mb-10">Keterangan ini dibuat untuk keperluan: <strong>' . $mailSubmission->description . '</strong></p>
            
            <p class="mb-20">Demikian surat keterangan ini dibuat dengan sebenar-benarnya dan dapat dipergunakan sebagaimana mestinya.</p>
            
            <div style="float: right; width: 200px; text-align: center; margin-top: 30px;">
                <p>Parakan, ' . $date . '</p>
                <p class="bold">Kepala Desa Parakan</p>
                <br><br><br>
                <p class="bold underline">MUHAMMAD_TOHIR</p>
            </div>
        </body>
        </html>';
    }
    
    private function generateKematianPdf($mailSubmission, $header, $date) 
    { 
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Surat Keterangan Kematian</title>
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
                <h3 class="bold underline">SURAT KETERANGAN KEMATIAN</h3>
                <p>Nomor: [NOMOR_SURAT]</p>
            </div>
            
            <p class="mb-10">Yang bertanda tangan di bawah ini, Kepala Desa Parakan, menerangkan bahwa:</p>
            
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
            
            <p class="mb-10">Adalah benar-benar penduduk Desa Parakan yang telah <strong>MENINGGAL DUNIA</strong>.</p>
            
            <p class="mb-20">Demikian surat keterangan ini dibuat dengan sebenar-benarnya dan dapat dipergunakan sebagaimana mestinya.</p>
            
            <div style="float: right; width: 200px; text-align: center; margin-top: 30px;">
                <p>Parakan, ' . $date . '</p>
                <p class="bold">Kepala Desa Parakan</p>
                <br><br><br>
                <p class="bold underline">Muhammad Tohir</p>
            </div>
        </body>
        </html>';
    }
    
    private function generateLahirPdf($mailSubmission, $header, $date) { return $this->generateDefaultPdf($mailSubmission, $header, $date); }
    private function generatePindahPdf($mailSubmission, $header, $date) { return $this->generateDefaultPdf($mailSubmission, $header, $date); }
    private function generateBelumMenikahPdf($mailSubmission, $header, $date) { return $this->generateDefaultPdf($mailSubmission, $header, $date); }
    private function generateCeraiPdf($mailSubmission, $header, $date) { return $this->generateDefaultPdf($mailSubmission, $header, $date); }
}
