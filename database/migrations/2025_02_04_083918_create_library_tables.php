<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryTables extends Migration
{
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('namaadmin');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('status', ['pending', 'setujui', 'tolak'])->default('pending');
            $table->enum('role', ['admin', 'petugas'])->default('petugas'); 
            $table->string('foto')->nullable();
            $table->timestamp('setujui')->nullable();
            $table->timestamps();
        });
        

        Schema::create('peminjam', function (Blueprint $table) {
            $table->id();
            $table->string('namapeminjam');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('status', ['pending', 'setujui', 'tolak'])->default('pending');
            $table->enum('keterangan', ['siswa', 'guru', 'umum']);
            $table->string('alamat');
            $table->timestamp('setujui')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('namakategori');
            $table->timestamps();
        });

        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idkategori')->constrained('kategori')->onDelete('cascade');
            $table->string('judul');
            $table->string('penerbit');
            $table->string('pengarang');
            $table->year('tahun');
            $table->enum('status', ['tersedia', 'dipinjam'])->default('tersedia');
            $table->timestamps();
        });

        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idpeminjam')->constrained('peminjam')->onDelete('cascade');
            $table->foreignId('idbuku')->constrained('buku')->onDelete('cascade');
            $table->foreignId('idadmin')->constrained('admin')->onDelete('cascade');
            $table->date('tanggalpinjam');
            $table->date('tanggalkembali');
            $table->integer('durasipeminjaman');
            $table->enum('status', ['terlambat', 'tidakterlambat'])->default('tidakterlambat');
            $table->decimal('denda', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peminjaman');
        Schema::dropIfExists('buku');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('peminjam');
        Schema::dropIfExists('admin');
    }
}
