<?php

namespace Database\Seeders;

use App\Models\LetterType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeCodeMapping = [
            'Surat Keputusan' => 'SK',
            'Surat Peringatan' => 'SP',
            'Surat Pemberitahuan' => 'SPb',
            'Surat Kontrak Kerjasama' => 'SKo',
            'Surat Tugas' => 'ST',
            'Surat Permohonan' => 'SPm',
            'Surat Pengantar' => 'SPg',
            'Surat Lamaran Kerja' => 'SLK',
            'Surat Cuti' => 'SC',
            'Surat Pengunduran Diri' => 'SPD',
            'Surat Keterangan' => 'SKet',
            'Surat Rekomendasi' => 'SR',
            'Surat Peminjaman' => 'SPn',
            'Surat Undangan' => 'SU',
            'Surat Pembatalan' => 'SPbtl',
            'Surat Pengaduan' => 'SPg',
            'Surat Klarifikasi' => 'SKlar',
            'Surat Pengesahan' => 'SPgs',
            'Surat Perjanjian' => 'SPj',
            'Surat Perintah' => 'SP',
            'Surat Cuti Melahirkan' => 'SCM',
            'Surat Pemberhentian' => 'SPbnt',
            'Surat Penugasan' => 'SPn',
            'Surat Laporan' => 'SL',
            'Surat Keberatan' => 'SKbrtn',
            'Surat Penghapusan' => 'SPghp',
            'Surat Persetujuan' => 'SPstu',
            'Surat Informasi' => 'SI',
            'Surat Tanggung Jawab' => 'STJ',
            'Surat Konfirmasi' => 'SKonf',
            'Surat Evaluasi' => 'SEv',
            'Surat Verifikasi' => 'SVrfk',
            'Surat Nota Dinas' => 'SND',
            'Surat Pernyataan' => 'SPnytn',
            'Surat Pemberian Waktu' => 'SPwkt',
            'Surat Keputusan Pensiun' => 'SKP',
            'Surat Notifikasi Pembayaran' => 'SNP',
            'Surat Keberlanjutan' => 'SKblnt',
            'Surat Keterangan Sehat' => 'SKSehat',
            'Surat Konfirmasi Pembayaran' => 'SKpembayaran',
            'Surat Permohonan Rekomendasi' => 'SPmr',
            'Surat Bekerja Sama' => 'SBK',
            'Surat Keterangan Kelakuan Baik' => 'SKKB',
            'Surat Buka Rekening' => 'SBR',
            'Surat Perubahan Data' => 'SPDb',
            'Surat Pemberitahuan Pembayaran' => 'SPP',
            'Surat Bukti Penerimaan' => 'SBP',
            'Surat Bantuan' => 'SBntn',
            'Surat Kesediaan' => 'SKsdn',
            'Surat Pencairan Dana' => 'SPcd',
            'Surat Pembukaan Lelang' => 'SPL',
            'Surat Keterangan Domisili' => 'SKD',
            'Surat Kuasa' => 'SKuas',
            'Surat Keterangan Penghasilan' => 'SKPngh',
            'Surat Penolakan' => 'SPnlk',
            'Surat Persetujuan Mutasi' => 'SPmut',
            'Surat Pencatatan' => 'SPcttn',
            'Surat Penawaran' => 'SPnwr',
            'Surat Permintaan' => 'SPmt',
            'Surat Pembayaran' => 'SPbyr',
            'Surat Pemunduran' => 'SPmndrn',
            'Surat Pengantar Verifikasi' => 'SPvfy',
            'Surat Kontrak Kerja' => 'SKkrj',
            'Surat Pengunduran Diri Pekerja' => 'SPDP',
            'Surat Persetujuan Layanan' => 'SPLayanan',
            'Surat Keputusan Kerja' => 'SKK',
            'Surat Rujukan' => 'SRujuk',
            'Surat Pembayaran Uang Muka' => 'SPUM',
            'Surat Perpanjangan Kontrak' => 'SPPK',
            'Surat Pencabutan Izin' => 'SPczb',
            'Surat Persetujuan Pengadaan' => 'SPpgd',
            'Surat Pemberitahuan Pembatalan' => 'SPPbtl',
            'Surat Keterangan Lahir' => 'SKL',
            'Surat Pembatalan Pengajuan' => 'SPbp',
            'Surat Pengumuman' => 'SPgmn',
            'Surat Pemberitahuan Perubahan' => 'SPPrb',
            'Surat Penghargaan' => 'SPghr',
            'Surat Pertanggungjawaban' => 'SPtjwb',
            'Surat Izin' => 'SIZ',
            'Surat Undangan Rapat' => 'SUR',
            'Surat Keterangan Perjalanan Dinas' => 'SKPD',
            'Surat Keterangan Tidak Mampu' => 'SKTM',
            'Surat Keterangan Beasiswa' => 'SKBs',
            'Surat Keputusan Mutasi' => 'SKM',
            'Surat Penundaan' => 'SPndn',
            'Surat Tindak Lanjut' => 'STLJ',
            'Surat Laporan Hasil Pemeriksaan' => 'SLHP',
            'Surat Penyesuaian' => 'SPnj',
            'Surat Klarifikasi Dokumen' => 'SKD',
            'Surat Pencabutan Keputusan' => 'SPckp',
            'Surat Penetapan' => 'SPntp',
            'Surat Bukti Tanggungan' => 'SBtg',
            'Surat Keputusan Penerimaan' => 'SKPenerimaan',
            'Surat Pemberitahuan Cuti' => 'SPCuti',
            'Surat Pengajuan Dana' => 'SPdana',
            'Surat Penarikan Dana' => 'SPnarik',
            'Surat Pengembalian Barang' => 'SPbrg',
            'Surat Persetujuan Penggunaan Aset' => 'SPPA',
            'Surat Laporan Kerja' => 'SLKj',
        ];


        $counter = 1;

        foreach ($typeCodeMapping as $type => $code) {
            LetterType::create([
                'type' => $type,
                'code' => $code,
                'number' => str_pad($counter++, 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
