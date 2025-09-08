<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arsip Dokumen Tahun Anggaran 2025</title>

  <style>
    body {
      font-family: sans-serif; /* ganti jadi Libre Franklin */
      margin: 0;
      padding: 0;
      background: #fff;
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      transition: background 0.3s, color 0.3s;
    }

    main {
      flex: 1;
    }

    /* Header */
    header {
      border-bottom: 1px solid #eee;
    }

    header .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 0;
      width: 90%;
      margin: auto;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: bold;
      font-size: 18px;
      color: #00c4b4;
    }

    .logo img {
      height: 28px;
    }

    .icon {
      font-size: 20px;
      cursor: pointer;
      user-select: none;
    }

    /* Judul */
    .page-title {
      text-align: center;
      padding: 20px 10px 10px;
    }

    .page-title h1 {
      margin: 0;
      font-size: 22px;
    }

    .page-title p {
      margin: 0;
      font-size: 14px;
      color: #555;
    }

    /* Container */
    .container {
      width: 90%;
      margin: auto;
    }

    /* Search box */
    .search-box {
      display: flex;
      margin: 15px 0;
    }

    .search-box input {
      padding: 8px;
      border: 2px solid #00c4b4;
      border-radius: 5px 0 0 5px;
      outline: none;
      width: 220px;
      max-width: 100%;
    }

    .search-box button {
      padding: 8px 12px;
      border: 2px solid #00c4b4;
      border-left: none;
      background: #fff;
      cursor: pointer;
      border-radius: 0 5px 5px 0;
      color: #00c4b4;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
      font-size: 14px;
    }

    th {
      background: #f7f7f7;
      font-weight: bold;
      color: #00c4b4;
    }

    .action-btn {
      border: 2px solid #00c4b4;
      border-radius: 5px;
      background: #fff;
      padding: 4px 8px;
      cursor: pointer;
      color: #00c4b4;
      font-size: 12px;
    }

    /* Mobile Style */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      thead { display: none; }

      tr {
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 10px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        background: #fff;
      }

      td {
        border: none;
        position: relative;
        padding-left: 120px;
        font-size: 14px;
        border-bottom: 1px solid #f0f0f0;
      }

      td:last-child { border-bottom: none; }

      td::before {
        position: absolute;
        left: 10px;
        top: 10px;
        width: 100px;
        white-space: nowrap;
        font-weight: bold;
        color: #00c4b4;
      }

      td:nth-of-type(1)::before { content: "Rincian Output"; }
      td:nth-of-type(2)::before { content: "Komponen"; }
      td:nth-of-type(3)::before { content: "Akun"; }
      td:nth-of-type(4)::before { content: "Detail"; }
      td:nth-of-type(5)::before { content: "Aksi"; }

      .search-box input {
        width: 100%;
        border-radius: 5px 0 0 5px;
      }
    }

    /* Pagination */
    .pagination {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      margin: 20px 0;
      flex-wrap: wrap;
      gap: 4px;
    }

    .pagination a,
    .pagination span {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      width: 34px;
      height: 34px;
      border: 1px solid #ddd;
      border-radius: 6px;
      text-decoration: none;
      color: #333;
      font-size: 14px;
    }

    .pagination a:hover {
      background-color: #f3f3f3;
    }

    .pagination .active {
      background-color: #00c4b4;
      color: #fff;
      border-color: #00c4b4;
    }

    .pagination .disabled {
      color: #aaa;
      cursor: default;
      background-color: #f9f9f9;
    }

    .pagination .ellipsis {
      border: none !important;
      background: transparent !important;
      cursor: default;
      width: auto;
      padding: 0 6px;
    }

    /* Footer */
    footer {
      text-align: center;
      padding: 15px;
      border-top: 1px solid #eee;
      font-size: 13px;
      color: #666;
      background: #fafafa;
    }

    /* Dark mode */
    body.dark-mode {
      background: #14161A;
      color: #ddd;
    }

    body.dark-mode header {
      border-bottom: 1px solid #444;
    }

    body.dark-mode .page-title p {
      color: #aaa;
    }

    body.dark-mode .search-box input,
    body.dark-mode .search-box button {
      border-color: #00c4b4;
      background: #2c2c2c;
      color: #ddd;
    }

    body.dark-mode table {
      border-color: #444;
    }

    body.dark-mode th {
      background: #2d2d2d; /* lebih gelap agar tidak silau */
      border: 1px solid #555; /* border sedikit gelap */
      color: #00c4b4;
    }

    body.dark-mode td {
      border-color: #444;
    }

    body.dark-mode tr {
      background: #2a2a2a;
    }

    body.dark-mode .action-btn {
      background: #2c2c2c;
      color: #00c4b4;
      border-color: #00c4b4;
    }

    body.dark-mode .pagination a,
    body.dark-mode .pagination span {
      border-color: #444;
      color: #ddd;
      background: #2c2c2c;
    }

    body.dark-mode .pagination a:hover {
      background: #3a3a3a;
    }

    body.dark-mode .pagination .active {
      background-color: #00c4b4;
      border-color: #00c4b4;
      color: #fff;
    }

    body.dark-mode .pagination .ellipsis {
      background: transparent !important;
      border: none !important;
      color: #aaa;
    }

    body.dark-mode footer {
      background: #2c2c2c;
      border-top: 1px solid #444;
      color: #aaa;
    }

    body.dark-mode td::before {
      color: #00c4b4;
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <div class="logo">
        <img src="logo (1).svg" alt="Logo">
      </div>
      <div class="icon" id="toggle-dark">☀️</div>
    </div>
  </header>

  <main>
    <div class="page-title">
      <h1>Arsip Dokumen Tahun Anggaran 2025</h1>
      <p>Per COA</p>
    </div>

    <div class="container">
      <div class="search-box">
        <input type="text" placeholder="Cari...">
        <button>🔍</button>
      </div>

      <table>
        <thead>
          <tr>
            <th>Rincian Output</th>
            <th>Komponen</th>
            <th>Akun</th>
            <th>Detail</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>(2896.BMA.004) PUBLIKASI/LAPORAN ANALISIS DAN PENGEMBANGAN STATISTIK</td>
            <td>(051) PERSIAPAN</td>
            <td>(521811) Belanja Barang Persediaan Barang Konsumsi</td>
            <td>Efisiensi anggaran</td>
            <td><button class="action-btn">👁️</button></td>
          </tr>
          <tr>
            <td>(2896.BMA.004) PUBLIKASI/LAPORAN ANALISIS DAN PENGEMBANGAN STATISTIK</td>
            <td>(051) PERSIAPAN</td>
            <td>(521811) Belanja Barang Persediaan Barang Konsumsi</td>
            <td>Pengadaan atk dan kertas di kab/kota</td>
            <td><button class="action-btn">👁️</button></td>
          </tr>
        </tbody>
      </table>

      <div class="pagination">
        <span class="disabled">«</span>
        <span class="active">1</span>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">7</a>
        <a href="#">8</a>
        <a href="#">9</a>
        <a href="#">10</a>
        <span class="ellipsis">...</span>
        <a href="#">27</a>
        <a href="#">28</a>
        <a href="#">»</a>
      </div>
    </div>
  </main>

  <footer>
    © 2025 Simpede. All rights reserved.
  </footer>

  <script>
    const toggleBtn = document.getElementById('toggle-dark');
    toggleBtn.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      toggleBtn.textContent = document.body.classList.contains('dark-mode') ? '🌙' : '☀️';
    });
  </script>
</body>
</html>
