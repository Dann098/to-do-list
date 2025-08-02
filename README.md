# To-Do List App PHP (Bootstrap 5) 🚀

Aplikasi **To-Do List** modern berbasis **PHP Native** & **MySQL** dengan autentikasi user, fitur CRUD tugas, filter/search, dan desain UI profesional.

---

## ✨ Fitur Utama

- **Register & Login** (Autentikasi user, password terenkripsi)
- **Kelola To-Do**: Tambah, tampilkan, tandai selesai, hapus, dan (opsional: edit) tugas
- **Filter & Search**: Filter tugas berdasarkan status, prioritas, deadline (hari ini), serta pencarian nama tugas
- **User Session**: Hanya user login yang bisa akses/mengelola to-do miliknya
- **UI Responsive & Modern**: Bootstrap 5, FontAwesome, gradient, efek card, icon, animasi
- **Notifikasi deadline hari ini** *(opsional, bisa dikembangkan)*
- **Aksesibilitas & mobile-friendly**
- **Pesan error & feedback yang user-friendly**

---


---

## 🛠️ Cara Install & Jalankan

1. **Clone/download** repository ini ke folder web server kamu (`htdocs` di XAMPP/Laragon).
2. **Buat database** di MySQL, misal:  
   `todo_list_db`
3. **Import struktur tabel** ke database (via phpMyAdmin atau command line):

    ```sql
    -- Tabel users
    CREATE TABLE users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    -- Tabel todos
    CREATE TABLE todos (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT NOT NULL,
        nama_tugas VARCHAR(255) NOT NULL,
        prioritas ENUM('rendah','sedang','tinggi') NOT NULL,
        kategori ENUM('pribadi','kelompok','lainnya') NOT NULL,
        deadline DATE NOT NULL,
        status ENUM('aktif','selesai') DEFAULT 'aktif',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    );
    ```

4. **Konfigurasi koneksi database** di `config/database.php`:

    ```php
    $host = 'localhost';
    $db   = 'todo_list_db';
    $user = 'root';       // default XAMPP, ganti jika perlu
    $pass = '';           // default XAMPP, ganti jika perlu
    // ...
    ```

5. **Akses aplikasi** di browser:  
   `http://localhost/to_dolist/index.php`  
   *(Akan redirect ke login atau dashboard sesuai status user)*

---

## 📝 Penggunaan

- **Register** akun baru
- **Login** dengan akun tersebut
- **Tambah tugas baru**, isi nama, prioritas, kategori, deadline
- **Kelola tugas**: tandai selesai, hapus, filter, cari tugas
- **Logout** jika selesai

---

## 🎨 UI & Teknologi

- **Bootstrap 5** (CDN)
- **FontAwesome 6** (CDN)
- **Custom CSS** untuk gradient, card, efek animasi
- **Responsive** di desktop/tablet/mobile
- **Modern UX**: clean, rapi, friendly

---

## 🛡️ Best Practice & Catatan

- Password **terenkripsi** (bcrypt)
- Session aman, validasi input ketat
- Hanya user login yang bisa lihat/mengelola to-do miliknya
- Validasi input dan pesan error jelas
- Gunakan HTTPS untuk produksi/hosting publik

---

## 🤝 Kontribusi & Lisensi

Feel free untuk custom, improve, atau kembangkan project ini untuk keperluan pribadi atau belajar!  
Jika ingin kontribusi, silakan fork dan pull request.

---

### Watermark

Desain UI & watermark "ichi" pada footer aplikasi.  
Copyright &copy; [<?= date('Y') ?>]

---

**Happy Coding! 🚀**

---


