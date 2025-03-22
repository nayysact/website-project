<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt Me 🐾</title>
    <link rel="stylesheet" href="crud.css">
</head>
<body>
    <div class="header">
        <h1>Adopt Me 🐾</h1>
    </div>

    <div class="container">
        <h2>Form Adopsi Hewan</h2>
        <form id="hewanForm">
            <label for="nama">Nama Hewan:</label>
            <input type="text" id="nama" required>

            <label for="jenis">Jenis Hewan:</label>
            <select id="jenis" required>
                <option value="">Pilih Jenis</option>
                <option value="Kucing">Kucing</option>
                <option value="Anjing">Anjing</option>
                <option value="Kelinci">Kelinci</option>
            </select>

            <label>Umur:</label>
            <div class="umur-container">
                <input type="number" id="umurTahun" placeholder="Tahun" min="0">
                <input type="number" id="umurBulan" placeholder="Bulan" min="0" max="11">
            </div>

            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" required></textarea>

            <button type="button" id="btnSimpan" onclick="simpanData()">Simpan</button>
            <button type="button" id="btnUpdate" onclick="updateData()" style="display: none;">Update</button>
        </form>
    </div>

    <table id="tabelHewan">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Umur</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        let rowEditing = null;

        function simpanData() {
            let nama = document.getElementById('nama').value;
            let jenis = document.getElementById('jenis').value;
            let umurTahun = document.getElementById('umurTahun').value;
            let umurBulan = document.getElementById('umurBulan').value;
            let deskripsi = document.getElementById('deskripsi').value;

            if (!nama || !jenis || !deskripsi) {
                alert("Harap isi semua bidang!");
                return;
            }

            if (!umurTahun && !umurBulan) {
                alert("Harap isi setidaknya salah satu bidang umur!");
                return;
            }

            let umur = "";
            if (umurTahun) umur += `${umurTahun} Tahun `;
            if (umurBulan) umur += `${umurBulan} Bulan`;

            let tabel = document.getElementById('tabelHewan').getElementsByTagName('tbody')[0];
            let row = tabel.insertRow();
            row.insertCell(0).innerText = nama;
            row.insertCell(1).innerText = jenis;
            row.insertCell(2).innerText = umur;
            row.insertCell(3).innerText = deskripsi;
            let aksiCell = row.insertCell(4);
            aksiCell.innerHTML = `
                <button class='action-btn btn-edit' onclick='editData(this)'>Edit</button>
                <button class='action-btn btn-delete' onclick='hapusData(this)'>Hapus</button>
            `;

            document.getElementById("hewanForm").reset();
        }

        function hapusData(button) {
            let row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        function editData(button) {
            rowEditing = button.parentNode.parentNode;
            document.getElementById('nama').value = rowEditing.cells[0].innerText;
            document.getElementById('jenis').value = rowEditing.cells[1].innerText;

            let umurText = rowEditing.cells[2].innerText.split(" ");
            let umurTahun = umurText.includes("Tahun") ? umurText[0] : "";
            let umurBulan = umurText.includes("Bulan") ? umurText[umurText.indexOf("Bulan") - 1] : "";

            document.getElementById('umurTahun').value = umurTahun;
            document.getElementById('umurBulan').value = umurBulan;
            document.getElementById('deskripsi').value = rowEditing.cells[3].innerText;

            document.getElementById("btnSimpan").style.display = "none";
            document.getElementById("btnUpdate").style.display = "inline-block";
        }

        function updateData() {
            if (!rowEditing) return;

            let nama = document.getElementById('nama').value;
            let jenis = document.getElementById('jenis').value;
            let umurTahun = document.getElementById('umurTahun').value;
            let umurBulan = document.getElementById('umurBulan').value;
            let deskripsi = document.getElementById('deskripsi').value;

            if (!nama || !jenis || !deskripsi) {
                alert("Harap isi semua bidang!");
                return;
            }

            let umur = "";
            if (umurTahun) umur += `${umurTahun} Tahun `;
            if (umurBulan) umur += `${umurBulan} Bulan`;

            rowEditing.cells[0].innerText = nama;
            rowEditing.cells[1].innerText = jenis;
            rowEditing.cells[2].innerText = umur;
            rowEditing.cells[3].innerText = deskripsi;

            rowEditing = null;
            document.getElementById("hewanForm").reset();
            document.getElementById("btnSimpan").style.display = "inline-block";
            document.getElementById("btnUpdate").style.display = "none";
        }
    </script>
</body>
</html>
