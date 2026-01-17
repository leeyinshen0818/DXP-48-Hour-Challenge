<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DXP Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden p-8 border border-slate-100">

        <div class="text-center mb-8">
            <div class="bg-indigo-600 w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-indigo-200">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-black text-slate-900">Admin Portal</h1>
            <p class="text-slate-500 text-sm mt-2">Please sign in to continue.</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Username / Email</label>
                <input type="text" name="email" class="w-full px-4 py-3 bg-slate-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-0 rounded-xl text-sm font-semibold text-slate-900 transition-all" placeholder="Enter your username">
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 bg-slate-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-0 rounded-xl text-sm font-semibold text-slate-900 transition-all" placeholder="••••••••">
                @error('password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3.5 rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5">
                Sign In
            </button>
        </form>

        <div class="mt-8 text-center border-t border-slate-100 pt-6">
            <a href="/" class="text-xs font-bold text-slate-400 hover:text-slate-600">Back to Home</a>
        </div>
    </div>

</body>
</html>
