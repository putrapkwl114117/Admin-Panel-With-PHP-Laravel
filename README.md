
Project ini adalah aplikasi panel admin yang dibangun menggunakan Laravel 8, yang dirancang untuk mengelola data dari dua tabel dengan relasi one-to-many. 
Tabel pertama adalah pengguna, yang mencakup dua jenis pengguna: admin dan user biasa. Tabel kedua adalah postingan, yang berisi data barang yang dapat dikelola oleh admin. 
Aplikasi ini juga dilengkapi dengan fitur login, memungkinkan hanya pengguna yang terdaftar untuk mengakses dan mengelola data.


LOGIN PAGE
![image](https://github.com/user-attachments/assets/d7e2db6d-a3dd-4ede-8b5d-9699a9578b89)

DASHBOARD ADMIN(TABEL DATA USER)
![image](https://github.com/user-attachments/assets/45b3dc75-1c36-45fe-a5c5-66cea21b1967)

DASHBOARD ADMIN(TABEL POST DATA BARANG)
![image](https://github.com/user-attachments/assets/db344f96-2881-4098-9981-4134fe450918)

HALAMAN HOME 
![image](https://github.com/user-attachments/assets/9dfbacdf-6531-4ab3-bc0a-5abca7fa6652)



Desain database terdiri dari dua tabel utama

![image](https://github.com/user-attachments/assets/addbce48-208d-4e2c-bd39-92910b668173)
1. Tabel Users
id Integer Primary key tabel ini, yang secara otomatis diinkrementasi untuk setiap entri baru.
name Tipe: String (varchar) Menyimpan nama pengguna.
email Tipe String (varchar) Alamat email pengguna, harus unik di seluruh tabel untuk mencegah duplikasi.
password Tipe String (varchar) Kata sandi yang digunakan untuk autentikasi pengguna.
role Tipe Enum Menentukan peran pengguna dalam sistem, dengan nilai yang mungkin adalah 'admin' atau 'user'.
2. Tabel Posts
id Tipe Integer Primary key tabel ini, yang secara otomatis diinkrementasi untuk setiap entri baru.
name Tipe String (varchar) Menyimpan nama postingan atau barang.
price Tipe Decimal Menyimpan harga barang dengan presisi yang diperlukan.
description Tipe Text Menyimpan deskripsi lengkap tentang barang.
stock Tipe Integer Menyimpan jumlah stok barang yang tersedia.
path String (varchar) Menyimpan path gambar terkait dengan postingan, yang menunjuk pada lokasi gambar dalam sistem file.
user_id Tipe Integer Kolom ini berfungsi sebagai foreign key yang merujuk ke kolom id di tabel Users, menunjukkan hubungan antara postingan dan pengguna yang membuatnya.
Terdapat hubungan one-to-many antara tabel Users dan Posts, di mana satu pengguna dapat memiliki banyak postingan, sedangkan setiap postingan hanya dapat dimiliki oleh satu pengguna.



POSTMENT(TESTING ENDPOIN API)
![image](https://github.com/user-attachments/assets/de894913-95ad-4fdf-866d-e2042970a500)

API ENDPOIN
![image](https://github.com/user-attachments/assets/bcb34c47-3e76-4393-b0e7-32254a444540)



Dependency

Laravel: Framework yang digunakan untuk pengembangan aplikasi web.
PHP: Versi yang diperlukan (misalnya PHP 8.0 atau lebih tinggi).
Composer: Untuk mengelola dependency PHP.
NPM: Untuk mengelola dependency frontend, seperti Bootstrap dan Axios.
Untuk menginstal dependency, gunakan perintah berikut:

composer install
npm install

Instalasi dan Setup:

Clone repositori ini:

git clone https://github.com/putra-1234/Admin-Panel---Laravel.git
Pindah ke direktori proyek dan instal dependency:
cd nama_repo
composer install
npm install
Salin file .env.example menjadi .env dan sesuaikan pengaturan database.

Generate key aplikasi:
php artisan key:generate

Migrasikan database:
php artisan migrate

Menjalankan Aplikasi:
php artisan serve
Akses aplikasi di http://127.0.0.1:8000.




