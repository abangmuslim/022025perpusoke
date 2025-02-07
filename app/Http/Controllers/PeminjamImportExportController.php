<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PeminjamImportExportController extends Controller
{
    public function export()
    {
        // Ambil data peminjam
        $peminjams = Peminjam::all();

        if ($peminjams->isEmpty()) {
            return redirect()->route('peminjam.index')->with('error', 'Tidak ada data untuk diekspor.');
        }

        // Buat Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $headerColumns = ['ID', 'Nama Peminjam', 'Username', 'Status', 'Keterangan', 'Alamat', 'Setujui', 'Foto'];
        $columnIndex = 'A';

        foreach ($headerColumns as $header) {
            $sheet->setCellValue($columnIndex . '1', $header);
            $columnIndex++;
        }

        // Isi data dari database
        $rowNumber = 2;
        foreach ($peminjams as $peminjam) {
            $sheet->setCellValue('A' . $rowNumber, $peminjam->id);
            $sheet->setCellValue('B' . $rowNumber, $peminjam->namapeminjam);
            $sheet->setCellValue('C' . $rowNumber, $peminjam->username);
            $sheet->setCellValue('D' . $rowNumber, $peminjam->status ?? 'Pending');
            $sheet->setCellValue('E' . $rowNumber, $peminjam->keterangan ?? '-');
            $sheet->setCellValue('F' . $rowNumber, $peminjam->alamat ?? '-');
            $sheet->setCellValue('G' . $rowNumber, $peminjam->setujui ? Carbon::parse($peminjam->setujui)->format('Y-m-d H:i:s') : 'Belum disetujui');
            $sheet->setCellValue('H' . $rowNumber, $peminjam->foto ?? '-');
            $rowNumber++;
        }

        // Nama file dinamis
        $fileName = 'data_peminjam_' . date('Y-m-d') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Validasi jika file kosong atau hanya berisi header
            if (count($rows) <= 1) {
                return redirect()->route('peminjam.index')->with('error', 'File kosong atau tidak sesuai format.');
            }

            // Mulai dari baris kedua karena baris pertama adalah header
            foreach (array_slice($rows, 1) as $row) {
                // Validasi data sebelum disimpan
                if (empty($row[1]) || empty($row[2])) {
                    continue; // Skip jika nama peminjam atau username kosong
                }

                // Cek apakah username sudah ada untuk menghindari duplikasi
                if (Peminjam::where('username', $row[2])->exists()) {
                    continue; // Skip jika username sudah digunakan
                }

                // Simpan data ke database dengan validasi yang lebih baik
                Peminjam::create([
                    'namapeminjam' => $row[1],
                    'username' => $row[2],
                    'password' => Hash::make('defaultpassword'),
                    'status' => in_array($row[3], ['pending', 'setujui', 'tolak']) ? $row[3] : 'pending',
                    'keterangan' => $row[4] ?? '-',
                    'alamat' => $row[5] ?? '-',
                    'foto' => !empty($row[7]) ? $row[7] : null,
                    'setujui' => !empty($row[6]) && strtotime($row[6]) ? Carbon::parse($row[6]) : null,
                ]);
            }

            return redirect()->route('peminjam.index')->with('success', 'Data berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->route('peminjam.index')->with('error', 'Terjadi kesalahan saat mengimpor data.');
        }
    }
}
