<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Data Siswa</h2>

<a href="create_form.php">Masukkan Data Siswa</a>
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
        </tr>
    </thead>
    <tbody id="dataSiswa">
        <!-- Data akan dimasukkan di sini -->
    </tbody>
</table>

<script>
    // Mengambil data dari API
    fetch('https://dantevergil.biz.id/read.php') // Ganti dengan path API yang sesuai
        .then(response => response.json())
        .then(data => {
            if (data.result.length > 0) {
                let tbody = document.getElementById('dataSiswa');
                data.result.forEach(siswa => {
                    let tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${siswa.nis}</td>
                        <td>${siswa.nama}</td>
                        <td>${siswa.alamat}</td>
                        <td>${siswa.email}</td>
                        <td>${siswa.orangtua}</td>
                        <td>${siswa.notelp}</td>
                        <td>${siswa.hobi}</td>
                    `;
                    tbody.appendChild(tr);
                });
            } else {
                document.getElementById('dataSiswa').innerHTML = '<tr><td colspan="8">Tidak ada data.</td></tr>';
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
</script>

</body>
</html>
