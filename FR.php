<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #0066cc;
        }
        .action-links a:hover {
            text-decoration: underline;
        }
        .add-btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .add-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Data Siswa</h2>

<a href="create_form.php" class="add-btn">Tambah Data Siswa Baru</a>
<table>
    <thead>
        <tr>
            <th>NIS</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Orang Tua</th>
            <th>No Telepon</th>
            <th>Hobi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="dataSiswa">
        <!-- Data akan dimasukkan di sini -->
    </tbody>
</table>

<script>
    // Mengambil data dari API backend
    fetch('https://dantevergil.biz.id/read.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const tbody = document.getElementById('dataSiswa');
            
            if (data.status === 'success' && data.data && data.data.length > 0) {
                data.data.forEach(siswa => {
                    let tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${siswa.nis}</td>
                        <td>${siswa.nama}</td>
                        <td>${siswa.alamat}</td>
                        <td>${siswa.email}</td>
                        <td>${siswa.orangtua}</td>
                        <td>${siswa.notelp}</td>
                        <td>${siswa.hobi}</td>
                        <td class="action-links">
                            <a href="update_form.php?nis=${siswa.id}">Edit</a>
                            <a href="#" onclick="deleteStudent('${siswa.id}')">Hapus</a>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } else {
                tbody.innerHTML = '<tr><td colspan="8" style="text-align: center;">Tidak ada data siswa.</td></tr>';
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            document.getElementById('dataSiswa').innerHTML = `
                <tr>
                    <td colspan="8" style="text-align: center; color: red;">
                        Gagal memuat data. Silakan coba lagi.
                    </td>
                </tr>
            `;
        });

    // Fungsi untuk menghapus siswa
    function deleteStudent(nis) {
        if (confirm(`Apakah Anda yakin ingin menghapus siswa dengan NIS ${id}?`)) {
            fetch(`https://dantevergil.biz.id/delete.php?id=${id}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    location.reload(); // Muat ulang halaman setelah penghapusan
                } else {
                    alert('Gagal menghapus: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus data');
            });
        }
    }
</script>

</body>
</html>