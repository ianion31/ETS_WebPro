// Konfigurasi untuk Back-End (Teman Anda akan mengisi ini nanti)
const API_URL = "http://localhost:8000/api"; // Contoh URL backend

// Inisialisasi Modal Bootstrap
const modalJalur = new bootstrap.Modal(document.getElementById('modalJalur'));
const modalMahasiswa = new bootstrap.Modal(document.getElementById('modalMahasiswa'));

// ==========================================
// MOCK DATA (Hapus ini jika Backend sudah siap)
// ==========================================
let mockJalur = [
    { id: 1, nama_jalur: "SNBP" },
    { id: 2, nama_jalur: "SNBT" }
];

let mockMahasiswa = [
    { nrp: "5025251001", nama: "Budi Santoso", angkatan: 2025, id_jalur: 1 },
    { nrp: "5025251002", nama: "Siti Aminah", angkatan: 2025, id_jalur: 2 }
];

// ==========================================
// CRUD JALUR MASUK
// ==========================================

// 1 & 2. Read Daftar Jalur Masuk
function loadJalurMasuk() {
    // KODE UNTUK BACKEND NANTI:
    // fetch(`${API_URL}/jalur`)
    //   .then(res => res.json())
    //   .then(data => { renderJalurTable(data); populateJalurDropdown(data); });
    
    renderJalurTable(mockJalur);
    populateJalurDropdown(mockJalur);
}

function renderJalurTable(data) {
    const tbody = document.getElementById('table-jalur-body');
    tbody.innerHTML = '';
    data.forEach(item => {
        tbody.innerHTML += `
            <tr>
                <td>${item.id}</td>
                <td>${item.nama_jalur}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editJalur(${item.id}, '${item.nama_jalur}')">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteJalur(${item.id})">Hapus</button>
                </td>
            </tr>
        `;
    });
}

// Buka Modal Tambah Jalur
function openModalJalur() {
    document.getElementById('form-jalur').reset();
    document.getElementById('jalur-id').value = '';
    document.getElementById('modalJalurTitle').innerText = 'Tambah Jalur Masuk';
    modalJalur.show();
}

// 1 & 3. Create & Update Jalur Masuk
function handleSaveJalur(event) {
    event.preventDefault();
    const id = document.getElementById('jalur-id').value;
    const nama_jalur = document.getElementById('nama_jalur').value;
    const payload = { nama_jalur };

    if (id) {
        // UPDATE LOGIC
        // fetch(`${API_URL}/jalur/${id}`, { method: 'PUT', body: JSON.stringify(payload) }).then(...)
        let index = mockJalur.findIndex(j => j.id == id);
        mockJalur[index].nama_jalur = nama_jalur;
    } else {
        // CREATE LOGIC
        // fetch(`${API_URL}/jalur`, { method: 'POST', body: JSON.stringify(payload) }).then(...)
        const newId = mockJalur.length ? mockJalur[mockJalur.length - 1].id + 1 : 1;
        mockJalur.push({ id: newId, nama_jalur });
    }

    modalJalur.hide();
    loadJalurMasuk();
}

// Setup Form untuk Edit Jalur
function editJalur(id, nama_jalur) {
    document.getElementById('jalur-id').value = id;
    document.getElementById('nama_jalur').value = nama_jalur;
    document.getElementById('modalJalurTitle').innerText = 'Edit Jalur Masuk';
    modalJalur.show();
}

// 4. Delete Jalur Masuk
function deleteJalur(id) {
    if(confirm('Yakin ingin menghapus jalur masuk ini?')) {
        // DELETE LOGIC
        // fetch(`${API_URL}/jalur/${id}`, { method: 'DELETE' }).then(...)
        mockJalur = mockJalur.filter(j => j.id != id);
        loadJalurMasuk();
    }
}


// ==========================================
// CRUD MAHASISWA
// ==========================================

// Mengisi Dropdown Relasi Jalur Masuk di Form Mahasiswa
function populateJalurDropdown(jalurData) {
    const select = document.getElementById('mhs-jalur-id');
    select.innerHTML = '<option value="">Pilih Jalur Masuk...</option>';
    jalurData.forEach(j => {
        select.innerHTML += `<option value="${j.id}">${j.nama_jalur}</option>`;
    });
}

// 6. Read Daftar Mahasiswa
function loadMahasiswa() {
    // KODE UNTUK BACKEND NANTI:
    // fetch(`${API_URL}/mahasiswa`)
    //   .then(res => res.json())
    //   .then(data => renderMahasiswaTable(data));
    
    renderMahasiswaTable(mockMahasiswa);
}

function renderMahasiswaTable(data) {
    const tbody = document.getElementById('table-mahasiswa-body');
    tbody.innerHTML = '';
    data.forEach(item => {
        // Menyatukan relasi data untuk tampilan (Backend biasanya mengembalikan ini via JOIN/Query)
        const jalur = mockJalur.find(j => j.id == item.id_jalur);
        const namaJalur = jalur ? jalur.nama_jalur : 'Tidak Diketahui';

        tbody.innerHTML += `
            <tr>
                <td>${item.nrp}</td>
                <td>${item.nama}</td>
                <td>${item.angkatan}</td>
                <td>${namaJalur}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editMahasiswa('${item.nrp}', '${item.nama}', ${item.angkatan}, ${item.id_jalur})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteMahasiswa('${item.nrp}')">Hapus</button>
                </td>
            </tr>
        `;
    });
}

// Buka Modal Tambah Mahasiswa
function openModalMahasiswa() {
    document.getElementById('form-mahasiswa').reset();
    document.getElementById('mahasiswa-old-nrp').value = '';
    document.getElementById('modalMahasiswaTitle').innerText = 'Tambah Mahasiswa';
    modalMahasiswa.show();
}

// 5 & 7. Create & Update Mahasiswa
function handleSaveMahasiswa(event) {
    event.preventDefault();
    const old_nrp = document.getElementById('mahasiswa-old-nrp').value;
    
    const payload = {
        nrp: document.getElementById('mhs-nrp').value,
        nama: document.getElementById('mhs-nama').value,
        angkatan: document.getElementById('mhs-angkatan').value,
        id_jalur: document.getElementById('mhs-jalur-id').value
    };

    if (old_nrp) {
        // UPDATE LOGIC
        // fetch(`${API_URL}/mahasiswa/${old_nrp}`, { method: 'PUT', body: JSON.stringify(payload) }).then(...)
        let index = mockMahasiswa.findIndex(m => m.nrp == old_nrp);
        mockMahasiswa[index] = payload;
    } else {
        // CREATE LOGIC
        // fetch(`${API_URL}/mahasiswa`, { method: 'POST', body: JSON.stringify(payload) }).then(...)
        mockMahasiswa.push(payload);
    }

    modalMahasiswa.hide();
    loadMahasiswa();
}

// Setup Form untuk Edit Mahasiswa
function editMahasiswa(nrp, nama, angkatan, id_jalur) {
    document.getElementById('mahasiswa-old-nrp').value = nrp;
    document.getElementById('mhs-nrp').value = nrp;
    document.getElementById('mhs-nama').value = nama;
    document.getElementById('mhs-angkatan').value = angkatan;
    document.getElementById('mhs-jalur-id').value = id_jalur;
    document.getElementById('modalMahasiswaTitle').innerText = 'Edit Mahasiswa';
    modalMahasiswa.show();
}

// 8. Delete Mahasiswa
function deleteMahasiswa(nrp) {
    if(confirm('Yakin ingin menghapus data mahasiswa ini?')) {
        // DELETE LOGIC
        // fetch(`${API_URL}/mahasiswa/${nrp}`, { method: 'DELETE' }).then(...)
        mockMahasiswa = mockMahasiswa.filter(m => m.nrp != nrp);
        loadMahasiswa();
    }
}

// Load data saat halaman pertama kali dibuka
document.addEventListener('DOMContentLoaded', () => {
    loadJalurMasuk();
    loadMahasiswa();
});