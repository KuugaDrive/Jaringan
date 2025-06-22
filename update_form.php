<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        #responseMessage {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Update Data Siswa</h1>
    
    <form id="formSiswa" target="http://dantevergil.biz.id/update.php">
        <input type="hidden" name="nis" id="nis">
        
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required>
        </div>
        
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        
        <div class="form-group">
            <label for="orangtua">Orang Tua:</label>
            <input type="text" name="orangtua" id="orangtua" required>
        </div>
        
        <div class="form-group">
            <label for="notelp">No Telepon:</label>
            <input type="text" name="notelp" id="notelp" required>
        </div>
        
        <div class="form-group">
            <label for="hobi">Hobi:</label>
            <input type="text" name="hobi" id="hobi" required>
        </div>
        
        <button type="submit">Update Data</button>
    </form>

    <div id="responseMessage"></div>

    <br><br>
    <a href="FR.php">Kembali ke Halaman Utama</a>
    
    <script>
        const form = document.getElementById('formSiswa');
        const responseMessage = document.getElementById('responseMessage');
        
        function searchStudent() {
            const nis = document.getElementById('search_nis').value.trim();
            if (!nis) {
                responseMessage.textContent = 'Silakan masukkan NIS siswa';
                responseMessage.style.color = 'red';
                return;
            }
            
            responseMessage.textContent = 'Mencari data siswa...';
            responseMessage.style.color = 'black';
            
            fetch(`https://dantevergil.biz.id/read.php?nis=${nis}`)
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success' && data.data) {
                        // Isi form dengan data siswa
                        document.getElementById('nis').value = data.data.nis;
                        document.getElementById('nama').value = data.data.nama;
                        document.getElementById('alamat').value = data.data.alamat;
                        document.getElementById('email').value = data.data.email;
                        document.getElementById('orangtua').value = data.data.orangtua;
                        document.getElementById('notelp').value = data.data.notelp;
                        document.getElementById('hobi').value = data.data.hobi;
                        
                        form.style.display = 'block';
                        responseMessage.textContent = 'Data siswa ditemukan. Silakan edit data di bawah:';
                        responseMessage.style.color = 'green';
                    } else {
                        responseMessage.textContent = 'Siswa dengan NIS tersebut tidak ditemukan';
                        responseMessage.style.color = 'red';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    responseMessage.textContent = 'Terjadi kesalahan: ' + (error.message || 'Tidak dapat terhubung ke server.');
                    responseMessage.style.color = 'red';
                });
        }
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const api_url = 'https://dantevergil.biz.id/update.php';
            
            responseMessage.textContent = 'Memperbarui data...';
            responseMessage.style.color = 'black';
            
            fetch(api_url, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                responseMessage.textContent = data.message;
                responseMessage.style.color = (data.status === 'success') ? 'green' : 'red';
            })
            .catch(error => {
                console.error('Error:', error);
                responseMessage.textContent = 'Terjadi kesalahan: ' + (error.message || 'Tidak dapat terhubung ke server.');
                responseMessage.style.color = 'red';
            });
        });
    </script>
</body>
</html>