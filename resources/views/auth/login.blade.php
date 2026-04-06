<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Login | RESIDENTE Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeIn 0.4s ease-out forwards; }
    </style>
</head>
<body class="antialiased font-sans bg-slate-50 text-slate-800">
    @include('partials.loader')

    <div class="w-full bg-slate-900 text-white text-xs py-2 px-4 flex justify-center items-center">
        <span class="font-medium tracking-wide">Official Government System of the Municipality of Buguey</span>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-8">

        <div class="fade-in w-full max-w-md bg-white rounded-lg border border-slate-200 shadow-xl overflow-hidden"
             style="box-shadow: 0 10px 25px rgba(0,0,0,0.05);">

            <div class="h-1.5 w-full bg-gradient-to-r from-emerald-800 to-emerald-600"></div>

            <div class="px-10 pt-10 pb-6 flex flex-col items-center border-b border-slate-100 bg-slate-50">
                <div class="w-16 h-16 rounded-full bg-white border border-slate-200 shadow-sm flex items-center justify-center mb-4 overflow-hidden">
                    <img src="{{ asset('logo_buguey.png') }}" alt="Municipality of Buguey Official Logo"
                         class="w-12 h-12 object-contain">
                </div>
                <h1 class="text-xl font-bold text-slate-900 tracking-wider uppercase">RESIDENTE</h1>
                <p class="text-xs font-semibold text-emerald-700 uppercase tracking-widest mt-1">Authorized Access Only</p>
            </div>

            <div class="px-10 py-8">

                <div class="mb-8 text-center">
                    <h2 class="text-lg font-bold text-slate-800">System Authentication</h2>
                    <p class="text-sm text-slate-500 mt-1">Please enter your authorized credentials</p>
                </div>

                @error('email')
                    <div class="mb-6 flex items-start gap-3 bg-red-50 border-l-4 border-red-600 rounded-r-md px-4 py-3">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-bold text-red-800 mb-0.5">Authentication Failed</p>
                            <p class="text-xs text-red-700">{{ $message }}</p>
                        </div>
                    </div>
                @enderror

                <form id="loginForm" action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}"
                                   required autocomplete="email" placeholder="official@buguey.gov.ph"
                                   class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 transition-colors">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wide">
                                Security Password
                            </label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                                </svg>
                            </div>
                            <input id="password" name="password" type="password"
                                   required autocomplete="current-password" placeholder="Enter password"
                                   class="block w-full pl-10 pr-10 py-3 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 transition-colors">
                            <button type="button" onclick="togglePasswordVisibility('password')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path id="password-eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path id="password-eye-open-2" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    <path id="password-eye-closed" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input id="remember" name="remember" type="checkbox"
                                   class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-600">
                            <span class="text-sm font-medium text-slate-600">Remember session</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-sm font-semibold text-emerald-700 hover:text-emerald-800 hover:underline">
                                Reset Password
                            </a>
                        @endif
                    </div>

                    <div class="pt-4">
                        <button id="submitButton" type="submit"
                                class="w-full flex items-center justify-center gap-2 py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-colors disabled:opacity-70 disabled:cursor-wait">
                            <svg id="buttonIcon" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                            </svg>
                            <span id="buttonText">Secure Login</span>
                            <svg id="loadingSpinner" class="hidden animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                        </button>
                    </div>

                </form>
            </div>

            <div class="px-10 py-5 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <span class="text-xs text-slate-500 font-medium">Unregistered Personnel?</span>
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-1 text-sm font-bold text-emerald-700 hover:text-emerald-800 transition-colors">
                    Request Access
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>

        </div>

        <div class="fade-in mt-8 flex flex-col items-center justify-center gap-2 text-slate-500" style="animation-delay:0.1s">
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                </svg>
                <span class="text-xs font-semibold tracking-wide">256-bit Encrypted Connection</span>
            </div>
            <p class="text-[10px] uppercase tracking-wider">&copy; {{ date('Y') }} Municipality of Buguey. All Rights Reserved.</p>
        </div>

    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            const input     = document.getElementById(fieldId);
            const eyeOpen   = document.getElementById(fieldId + '-eye-open');
            const eyeOpen2  = document.getElementById(fieldId + '-eye-open-2');
            const eyeClosed = document.getElementById(fieldId + '-eye-closed');
            const isHidden  = input.type === 'password';

            input.type = isHidden ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', isHidden);
            eyeOpen2.classList.toggle('hidden', isHidden);
            eyeClosed.classList.toggle('hidden', !isHidden);
        }

        document.getElementById('loginForm')?.addEventListener('submit', function () {
            const btn = document.getElementById('submitButton');
            btn.disabled = true;
            document.getElementById('buttonIcon').classList.add('hidden');
            document.getElementById('buttonText').textContent = 'Authenticating';
            document.getElementById('loadingSpinner').classList.remove('hidden');
        });
    </script>
</body>
</html>
