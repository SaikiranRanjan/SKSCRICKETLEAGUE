<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK's Cricket League 🏆</title>
    <!-- Use Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        .swiper-container {
            width: 100%;
            padding-bottom: 30px;
        }
        .glow-on-hover {
            transition: box-shadow 0.3s ease-in-out;
        }
        .glow-on-hover:hover {
            box-shadow: 0 0 20px rgba(255, 59, 48, 0.7);
        }
    </style>
</head>
<body class="bg-gray-900 text-white flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-gradient-to-r from-red-500 to-orange-500 py-8 shadow-lg">
        <div class="container mx-auto text-center">
            <h1 class="text-5xl font-extrabold tracking-wide">🏏 SK's Cricket League</h1>
            <p class="text-xl font-light opacity-90 mt-2">Play, Win & Dominate! 🔥</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 py-12 flex-grow">
        <h2 class="text-4xl font-bold text-center text-red-400 mb-12">🚀 Upcoming Matches</h2>

        <!-- Match Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($teams->take(8) as $team)
                <div class="bg-gray-800 shadow-xl rounded-lg p-6 text-center transform transition-all duration-300 hover:scale-105 hover:shadow-2xl cursor-pointer glow-on-hover" onclick="openPopup('{{ $team->id }}', '{{ $team->match }}')">
                    <h3 class="text-2xl font-bold mt-4">{{ $team->match ?? 'Upcoming Match' }}</h3>
                    <p class="text-lg font-semibold mt-2 text-gray-300">💰 
                        <span class="text-yellow-400 text-2xl">₹{{ $team->price ? number_format($team->price, 2) : '0.00' }}</span>
                    </p>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Winning Screenshots Carousel -->
    <section class="container mx-auto px-4 sm:px-6 mt-12">
        <h2 class="text-3xl font-bold text-center text-yellow-400 mb-8">🏆 My Winning Screenshots</h2>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach (['screenshot1.jpg', 'screenshot2.jpg', 'screenshot3.jpg', 'screenshot4.jpg', 'screenshot5.jpg'] as $screenshot)
                    <div class="swiper-slide flex justify-center">
                        <img src="{{ asset('winning_screenshots/' . $screenshot) }}" alt="Winning Screenshot" class="rounded-lg shadow-lg w-full max-w-md object-cover">
                    </div>
                @endforeach
            </div>
            <!-- Pagination and Navigation -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev text-red-500"></div>
            <div class="swiper-button-next text-red-500"></div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-auto">
        <div class="container mx-auto">
            <p class="text-lg font-medium">&copy; {{ date('Y') }} Cricket League. All Rights Reserved. �</p>
            <p class="text-sm opacity-80 mt-1">Developed by <span class="font-semibold">Sai Kiran</span></p>
        </div>
    </footer>

    <!-- Payment Popup Modal -->
    <div id="popupModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-gray-900 p-6 rounded-lg shadow-xl w-[90%] sm:w-[30rem]">
            <h2 class="text-2xl font-bold text-center text-red-400 mb-4">Scan, pay, and submit your WhatsApp number</h2>
            
            <!-- QR Code -->
            <div class="flex justify-center">
                <img src="{{ asset('images/your_qr_code.png') }}" alt="UPI QR Code" class="w-48 h-48 rounded-lg shadow-lg">
            </div>

            <p class="text-center text-gray-300 mt-4 text-sm">
                Scan QR code for payment and share the success screenshot to 
                <span class="font-bold text-yellow-400">8861323232</span>.
            </p>

            <p class="text-center text-green-400 font-semibold mt-2">✅ Once the payment is completed, you will receive the team on your WhatsApp within 5 to 8 minutes before the deadline</p>

            <!-- Form -->
            <form id="paymentForm" method="POST" action="{{ route('team.request.store') }}" class="mt-4">
                @csrf
                <input type="hidden" name="requested_team_id" id="teamId">
                <input type="hidden" name="match_name" id="matchName">

                <label class="block text-sm font-medium text-gray-300">Enter Your WhatsApp Number</label>
                <input type="text" name="users_whatsapp_number" required 
                    class="w-full p-2 mt-2 bg-gray-800 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Enter WhatsApp number">
                
                <p class="text-center text-yellow-400 text-sm mt-2">⚠️ Please ensure you enter your correct WhatsApp number to receive the team.</p>

                <button type="submit" 
                    class="mt-4 w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition-all">
                    Submit
                </button>
            </form>

            <button onclick="closePopup()" class="mt-3 w-full bg-gray-700 hover:bg-gray-600 text-white py-2 rounded transition-all">
                Close
            </button>
        </div>
    </div>

    <!-- Success Message -->
    <div id="successMessage" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-gray-900 p-6 rounded-lg shadow-xl w-[90%] sm:w-[30rem] text-center">
            <h2 class="text-2xl font-bold text-green-400 mb-4">✅ Request Sent Successfully!</h2>
            <p class="text-lg text-gray-300">Your team will be sent to you soon. Please check your WhatsApp.</p>
            <button onclick="closeSuccessMessage()" class="mt-4 w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition-all">
                Close
            </button>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function openPopup(teamId, matchName) {
            document.getElementById("teamId").value = teamId;
            document.getElementById("matchName").value = matchName;
            document.getElementById("popupModal").classList.remove("hidden");
        }

        function closePopup() {
            document.getElementById("popupModal").classList.add("hidden");
        }

        function closeSuccessMessage() {
            document.getElementById("successMessage").classList.add("hidden");
        }

        document.getElementById("paymentForm").addEventListener("submit", function(event) {
            event.preventDefault();
            closePopup();
            document.getElementById("successMessage").classList.remove("hidden");

            setTimeout(() => {
                this.submit();
            }, 2000);
        });
    </script>

    <!-- SwiperJS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".swiper-container", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                1024: { slidesPerView: 3 }
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>

</body>
</html>