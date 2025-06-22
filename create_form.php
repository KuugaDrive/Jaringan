<!-- Front-end form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Siswa</title>
</head>
<body>
    <h1>Tambah Data Siswa</h1>
    <form action="https://dantevergil.biz.id/create.php" id="formSiswa">

        <label for="nis">NIS:</label>
        <input type="text" name="nis" id="nis"><br><br>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required><br><br>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" id="alamat" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br> <label for="orangtua">Orang Tua:</label>
        <input type="text" name="orangtua" id="orangtua" required><br><br>

        <label for="notelp">No Telepon:</label>
        <input type="text" name="notelp" id="notelp" required><br><br>

        <label for="hobi">Hobi:</label>
        <input type="text" name="hobi" id="hobi" required><br><br>

        <button type="submit">Simpan</button>
    </form>


    <div id="responseMessage" style="margin-top: 20px;"></div>

    <br><br><br>
    <a href="FR.php">Kembali</a>
    

    <script>
        // Tangkap elemen form
        const form = document.getElementById('formSiswa');
        const responseMessage = document.getElementById('responseMessage');

        // Tambahkan event listener untuk event 'submit'
        form.addEventListener('submit', function(e) {
            // 1. Mencegah form dikirim secara default (pindah halaman)
            e.preventDefault();

            // 2. Ambil semua data dari form
            const formData = new FormData(form);
            const api_url = 'https://dantevergil.biz.id/create.php';

            responseMessage.textContent = 'Mengirim data...';

            // 3. Kirim data menggunakan Fetch API
            fetch(api_url, {
                method: 'POST',
                body: formData 
            })
            .then(response => {
                // Periksa apakah responsnya OK (status 200-299)
                if (!response.ok) {
                    // Jika tidak OK, kita lempar error untuk ditangkap di .catch
                    // Kita coba baca body JSON nya untuk pesan error dari PHP
                    return response.json().then(err => { throw err; });
                }
                // Jika OK, kita parse body sebagai JSON
                return response.json();
            })
            .then(data => {
                // 4. Tangani respons JSON yang berhasil dari server
                console.log(data); // Tampilkan di console untuk debug
                responseMessage.textContent = data.message;
                // Ubah warna teks berdasarkan status
                responseMessage.style.color = (data.status === 'success') ? 'green' : 'red';
                
                if(data.status === 'success') {
                    form.reset(); // Kosongkan form jika berhasil
                }
            })
            .catch(error => {
                // 5. Tangani jika ada error (network error atau dari throw di atas)
                console.error('Error:', error);
                // Menampilkan pesan error yang lebih informatif
                responseMessage.textContent = 'Terjadi kesalahan: ' + (error.message || 'Tidak dapat terhubung ke server.');
                responseMessage.style.color = 'red';
            });
        });
    </script>
</body>
</html>
