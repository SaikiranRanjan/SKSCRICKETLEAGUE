<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK's Cricket League 🏆</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Rubik', sans-serif;
            background: #0f172a;
        }
        
        .cricket-card {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid #334155;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .cricket-card:hover {
            border-color: #f43f5e;
            transform: translateY(-5px);
        }
        
        .swiper-pagination-bullet {
            background: #fff !important;
            opacity: 0.5 !important;
        }
        
        .swiper-pagination-bullet-active {
            background: #f43f5e !important;
            opacity: 1 !important;
        }
    </style>
</head>
<body class="text-slate-100">

    <!-- Header -->
    <header class="bg-gradient-to-r from-rose-600 to-amber-600 py-12 shadow-2xl">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-black mb-3">🏏 SK's Cricket League</h1>
            <p class="text-lg md:text-xl text-amber-100/90">Play Hard, Win Bigger!</p>
            <div class="mt-4 flex justify-center gap-2">
                <span class="px-3 py-1 bg-black/20 rounded-full text-sm">💰 Get Your Team at the Cheapest Price on the Internet! 🔥</span>
                
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <h2 class="text-3xl md:text-4xl font-black text-center mb-12 text-rose-400">
            🚨 Upcoming Matches
        </h2>

        <!-- Match Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($teams->take(8) as $team)
            <div 
                class="cricket-card rounded-xl p-6 cursor-pointer"
                onclick="openPopup('{{ $team->id }}', '{{ $team->match }}')"
            >
                <div class="flex justify-between items-start mb-4">
                    <span class="text-sm font-semibold text-slate-400">{{ $team->match ?? 'Special Match' }}</span>
                    <span class="px-2 py-1 text-xs rounded-md bg-rose-500/20 text-rose-400">HOT</span>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-black text-amber-400 mb-2">
                        ₹{{ $team->price ? number_format($team->price, 2) : '0.00' }}
                    </p>
                    <p class="text-sm text-slate-400">Price</p>
                </div>
                <div class="mt-6 flex justify-center">
                    <button class="text-rose-400 hover:text-rose-300 flex items-center gap-2">
                        <span>Get Team</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <!-- Winners Section -->
    <section class="py-12 bg-slate-900/50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-black text-center mb-8 text-amber-400">
                🏆 Recent Winners
            </h2>
            
            <div class="swiper-container relative">
                <div class="swiper-wrapper">
                    @foreach (['screenshot_1.jpeg', 'screenshot_2.jpeg', 'screenshot_3.jpeg', 'screenshot_4.jpeg', 'screenshot_5.jpeg'] as $screenshot)
                    <div class="swiper-slide">
                        <div class="overflow-hidden rounded-xl border-2 border-slate-700 h-96">
                            <img 
                                src="{{ asset('winning_screenshots/' . $screenshot) }}" 
                                alt="Winner Proof" 
                                class="w-full h-full object-cover"
                            >
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination !relative !mt-6"></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-700/50 mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center text-slate-400">
                <p class="text-lg font-medium">&copy; {{ date('Y') }} Cricket League. All Rights Reserved.</p>
                <p class="text-sm opacity-80 mt-1">Developed by <span class="font-semibold">Sai Kiran</span></p>
            </div>
        </div>
    </footer>

    <!-- Payment Modal -->
    <div id="popupModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-slate-900 p-6 rounded-lg shadow-xl w-[90%] sm:w-[30rem] border border-slate-700">
            <h2 class="text-2xl font-bold text-center text-rose-400 mb-4">Scan, pay, and submit your WhatsApp number</h2>
            
            <div class="flex justify-center">
                <img src="{{ asset('images/your_qr_code.png') }}" alt="UPI QR Code" class="w-48 h-48 rounded-lg shadow-lg">
            </div>

            <p class="text-center text-slate-300 mt-4 text-sm">
                Scan QR code for payment and share the success screenshot to 
                <span class="font-bold text-amber-400">8861323232</span>.
            </p>

            <p class="text-center text-emerald-400 font-semibold mt-2">
                ✅ Once the payment is completed, you will receive the team on your WhatsApp within 5 to 8 minutes before the deadline
            </p>

            <form id="paymentForm" method="POST" action="{{ route('team.request.store') }}" class="mt-4">
                @csrf
                <input type="hidden" name="requested_team_id" id="teamId">
                <input type="hidden" name="match_name" id="matchName">

                <label class="block text-sm font-medium text-slate-300">Enter Your WhatsApp Number</label>
                <input type="text" 
                       name="users_whatsapp_number" 
                       required 
                       class="w-full p-2 mt-2 bg-slate-800 text-white border border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-rose-500"
                       placeholder="Enter WhatsApp number">
                
                <p class="text-center text-amber-400 text-sm mt-2">⚠️ Please ensure you enter your correct WhatsApp number to receive the team.</p>

                <button type="submit" 
                    class="mt-4 w-full bg-rose-500 hover:bg-rose-600 text-white font-bold py-2 px-4 rounded transition-all">
                    Submit
                </button>
            </form>

            <button onclick="closePopup()" 
                    class="mt-3 w-full bg-slate-700 hover:bg-slate-600 text-white py-2 rounded transition-all">
                Close
            </button>
        </div>
    </div>

    <!-- Success Message -->
    <div id="successMessage" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-slate-900 p-6 rounded-lg shadow-xl w-[90%] sm:w-[30rem] text-center border border-slate-700">
            <h2 class="text-2xl font-bold text-emerald-400 mb-4">✅ Request Sent Successfully!</h2>
            <p class="text-lg text-slate-300">Your team will be sent to you soon. Please check your WhatsApp.</p>
            <button onclick="closeSuccessMessage()" 
                    class="mt-4 w-full bg-rose-500 hover:bg-rose-600 text-white font-bold py-2 px-4 rounded transition-all">
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
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>

</body>
</html>