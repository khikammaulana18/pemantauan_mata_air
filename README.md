### Panduan Instalasi Aplikasi Laravel "Pemantauan Mata Air"

Ikuti langkah-langkah di bawah ini untuk menginstal dan menjalankan aplikasi "Pemantauan Mata Air" di lingkungan pengembangan lokal Anda.

#### Prasyarat

Pastikan Anda memiliki hal-hal berikut terinstal di sistem Anda:

  * **PHP:** Versi 8.1 atau lebih tinggi (disarankan).
  * **Composer:** Manajer dependensi PHP.
  * **MySQL/MariaDB:** Sistem manajemen database.
  * **XAMPP/Laragon/WAMP/MAMP:** Lingkungan pengembangan web lokal (sudah ada XAMPP).
  * **Git:** Untuk mengkloning repositori.

#### Langkah-langkah Instalasi

1.  **Kloning Repositori:**
    Buka terminal atau Git Bash Anda, lalu kloning repositori proyek dari GitHub:

    ```bash
    git clone https://github.com/khikammaulana18/pemantauan_mata_air.git
    ```

2.  **Navigasi ke Direktori Proyek:**
    Masuk ke dalam folder proyek yang baru saja Anda kloning:

    ```bash
    cd pemantauan_mata_air
    ```

3.  **Instal Dependensi Composer:**
    Instal semua dependensi PHP yang dibutuhkan oleh proyek menggunakan Composer:

    ```bash
    composer install
    ```

4.  **Konfigurasi File Lingkungan (`.env`):**

      * Buat salinan file `.env.example` dan beri nama `.env`:
        ```bash
        cp .env.example .env
        # Atau di Windows: copy .env.example .env
        ```
      * Buka file `.env` dengan editor teks Anda.
      * Konfigurasi detail database Anda. Sesuaikan `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` sesuai dengan pengaturan MySQL/MariaDB Anda di XAMPP.
        ```dotenv
        APP_NAME="Pemantauan Mata Air"
        APP_ENV=local
        APP_KEY=
        APP_DEBUG=true
        APP_URL=http://localhost

        LOG_CHANNEL=stack
        LOG_LEVEL=debug

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=nama_database_anda_di_xampp # Ganti dengan nama database yang akan Anda buat
        DB_USERNAME=root # Biasanya 'root' untuk XAMPP
        DB_PASSWORD= # Kosongkan jika tidak ada password, atau isi jika ada
        ```

5.  **Buat Kunci Aplikasi:**
    Laravel membutuhkan kunci aplikasi yang unik. Jalankan perintah ini untuk membuatnya:

    ```bash
    php artisan key:generate
    ```

6.  **Buat Database dan Impor Data:**

      * Buka **phpMyAdmin** Anda (biasanya di `http://localhost/phpmyadmin` jika menggunakan XAMPP).
      * Buat database baru dengan nama yang sama persis dengan yang Anda tulis di `DB_DATABASE` pada file `.env` (misalnya, `pemantauan_mata_air_db`).
      * Setelah database dibuat, klik nama database tersebut di sidebar kiri phpMyAdmin.
      * Pilih tab **"Import"**.
      * Klik tombol **"Choose File"** atau **"Browse"** dan navigasikan ke folder `db` di dalam direktori proyek Anda (`pemantauan_mata_air/db/`).
      * Pilih file `.sql` database Anda (misalnya, `nama_file_database_anda.sql`).
      * Gulir ke bawah dan klik tombol **"Go"** atau **"Import"**.

7.  **Jalankan Migrasi Database (Opsional, jika ada migrasi tambahan):**
    Jika proyek Anda memiliki migrasi Laravel selain dari file SQL yang diimpor, Anda bisa menjalankannya (meskipun sebagian besar data sudah ada dari impor SQL):

    ```bash
    php artisan migrate
    ```

8.  **Jalankan Link Penyimpanan (Storage Link):**
    Jika aplikasi Anda menyimpan file di direktori `storage/app/public` dan menampilkannya melalui web, Anda perlu membuat symbolic link:

    ```bash
    php artisan storage:link
    ```

9.  **Jalankan Aplikasi:**
    Anda bisa menjalankan aplikasi menggunakan server pengembangan bawaan Laravel:

    ```bash
    php artisan serve
    ```

    Aplikasi akan tersedia di `http://127.0.0.1:8000` (atau port lain yang disebutkan).

    Atau, jika Anda sudah mengkonfigurasi virtual host di XAMPP, Anda bisa mengaksesnya melalui URL virtual host Anda.

-----
