<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalArchive - Solusi Arsip Digital Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        @layer utilities {
            .transition-height {
                transition-property: max-height;
            }
        }
    </style>
    <script>
        function toggleFAQ(id) {
            const element = document.getElementById(id);
            if (element.style.maxHeight) {
                element.style.maxHeight = null;
            } else {
                element.style.maxHeight = element.scrollHeight + "px";
            }
        }
    </script>
</head>
<body class="font-sans bg-gray-100">
    <header class="bg-white shadow-md fixed w-full z-10">
        <nav class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-blue-600">DigitalArchive</div>
              
                <button class="md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <main class="pt-16">
        <section id="beranda" class="bg-blue-600 text-white py-20">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Arsip Digital Modern</h1>
                <p class="text-xl mb-8">Simpan, kelola, dan akses dokumen Anda dengan mudah dan aman.</p>
                <a href="/admin" class="bg-white text-blue-600 py-2 px-6 rounded-full text-lg font-semibold hover:bg-gray-100 transition duration-300">Mulai Sekarang</a>
            </div>
        </section>
</body>
</html>