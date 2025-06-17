# Rintis ID

Rintis ID adalah sebuah platform showcase dan validasi Produk Lokal Indonesia. Platform komunitas tempat user bisa launch, voting, dan kasih feedback terhadap produk-produk digital inovatif buatan orang Indonesia mulai dari aplikasi, startup, proyek sosial, sampai UMKM.

## Tujuan Utama
- Menjadi panggung utama untuk inovator Indonesia.
- Mendorong solusi berbasis lokal dan sosial.
- Membangun ekosistem kolaboratif antar inovator.

## **Permasalahan yang Ingin Diselesaikan**
1. **Kurangnya eksposur untuk produk lokal** Inovator daerah sulit mendapatkan panggung nasional.
2. **Minimnya feedback dan validasi pasar** untuk ide baru yang berdampak.
3. **Terbatasnya jaringan kolaborasi antar pembuat solusi** di Indonesia.
4. **Kesenjangan digital dan ketimpangan adopsi teknologi** di luar kota besar.
5. **Kurangnya ekosistem pendukung inovasi yang terbuka dan inklusif.**

## **Target Pengguna**
1. **Pelajar / Mahasiswa**: Ingin validasi produk tugas akhir, side project, atau startup.
2. **UMKM Digital**: Membutuhkan exposure dan feedback.
3. **Startup Baru**: Soft launching dan validasi ide.
4. **Developer & Desainer**: Mencari kolaborasi.
5. **Investor & Inkubator**: Menemukan produk inovatif tahap awal.

## Teknologi yang Digunakan

- Laravel 12 (Livewire)
- Tailwind CSS

## Cara Instalasi dan Menjalankan Secara Lokal

1. **Clone Repository**
    ```bash
    git clone https://github.com/MastayY/rintis.git
    cd rintis
    ```

2. **Instalasi Dependensi**
    Pastikan memiliki [Composer](https://getcomposer.org/) dan [Node.js](https://nodejs.org/) terinstal di sistem.
    ```bash
    composer install
    npm install
    ```

3. **Konfigurasi Lingkungan**
    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Migrasi Database**
    Jalankan migrasi untuk membuat tabel-tabel yang diperlukan dan seeder untuk seeding database:
    ```bash
    php artisan migrate --seed
    ```
5. **Storage Link**
    ```bash
    php artisan storage:link
    ```

6. **Menjalankan Server**
    Jalankan server lokal dengan perintah:
    ```bash
    npm run dev
    php artisan serve
    ```

7. **Akses Website**
    Buka browser Anda dan akses `http://127.0.0.1:8000`.