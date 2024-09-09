<div class="p-6 bg-gray-100 min-h-screen">
    <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Dashboard Overview</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 justify-center">
      
        <div class="bg-green-500 h-40 w-full rounded-lg shadow-lg transform transition hover:scale-105">
            <div class="flex items-center h-full p-6">
                <div class="mr-4 text-white">
                    <i class="ri-user-fill text-5xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Total Users</h3>
                    <p class="text-5xl font-bold text-white">{{ $userCount }}</p>
                </div>
            </div>
        </div>


        <div class="bg-orange-400 h-40 w-full rounded-lg shadow-lg transform transition hover:scale-105">
            <div class="flex items-center h-full p-6">
                <div class="mr-4 text-white">
                    <i class="ri-user-2-fill text-5xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Total Agents</h3>
                    <p class="text-5xl font-bold text-white">{{ $agentCount }}</p>
                </div>
            </div>
        </div>


        <div class="bg-blue-500 h-40 w-full rounded-lg shadow-lg transform transition hover:scale-105">
            <div class="flex items-center h-full p-6">
                <div class="mr-4 text-white">
                    <i class="ri-landscape-fill text-5xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Total Landowners</h3>
                    <p class="text-5xl font-bold text-white">{{ $landownerCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
