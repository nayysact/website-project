<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Perlengkapan Hewan - AdoptMe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">

</head>
<body class="bg-white text-gray-900">

<?php include 'navbar.php'; ?>

<!-- Header -->
<header class="bg-[#8b5e34] shadow-md py-6 text-white text-center">
    <h1 class="text-3xl font-bold">Toko Perlengkapan Hewan</h1>
    <p>Dapatkan kebutuhan hewan kesayanganmu di sini!</p>
</header>

<!-- Produk -->

    document.addEventListener("click", (event) => {
        if (!menuBtn.contains(event.target) && !menuDropdown.contains(event.target)) {
            menuDropdown.classList.add("hidden");
        }
    });

    // Dropdown User
    const dropdownBtn = document.getElementById('userDropdown');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownBtn.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (event) => {
        if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>

</body>
</html>

