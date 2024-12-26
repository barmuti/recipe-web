<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep Masakan</title>
    <style>
        /* Gaya Umum */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Background putih di luar */
            margin: 0;
            padding: 0;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .recipe-card {
            background-color: #ffefd5; /* Warna oranye untuk card */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 100%; /* Card lebih lebar tapi tidak full layar */
            width: 800px; /* Tetapkan lebar maksimum */
            padding: 20px;
            text-align: center;
        }

        .recipe-card img {
            max-width: 100%;
            border-radius: 10px;
            height: auto;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .recipe-card h2 {
            color: #ff4500;
            font-size: 1.8em;
            margin: 10px 0;
        }

        .recipe-card p {
            font-size: 1em;
            color: #333;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .recipe-card ul, .recipe-card ol {
            text-align: left; /* Untuk merapikan daftar ke kiri */
            padding-left: 20px;
            color: #555;
        }

        .recipe-card ul li, .recipe-card ol li {
            margin-bottom: 8px;
        }

        /* Footer */
        footer {
            background-color: #343a40;
            text-align: center;
            color: white;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <main>
        <div class="recipe-card">
            <h2>Nasi Goreng Telur</h2>
            <img src="image/nasgor.jpg" alt="Nasi Goreng Telur">
            <p>Resep mudah dan cepat untuk membuat nasi goreng lezat dengan telur.</p>
            <p><strong>Waktu Persiapan:</strong> 10 Menit</p>
            <p><strong>Waktu Memasak:</strong> 15 Menit</p>

            <div>
                <h3>Bahan-bahan:</h3>
                <ul>
                    <li>2 piring nasi putih</li>
                    <li>2 butir telur</li>
                    <li>2 siung bawang putih</li>
                    <li>Kecap manis, garam, dan merica secukupnya</li>
                </ul>
            </div>

            <div>
                <h3>Langkah-langkah Memasak:</h3>
                <ol>
                    <li>Panaskan minyak di wajan.</li>
                    <li>Tumis bawang putih hingga harum.</li>
                    <li>Masukkan telur dan orak-arik hingga matang.</li>
                    <li>Tambah nasi putih, kecap manis, garam, dan merica.</li>
                    <li>Aduk rata hingga semua bahan tercampur sempurna.</li>
                </ol>
            </div>
        </div>
    </main>
</body>
</html>
