<x-guest-layout>
    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Masuk ke panel admin</h2>
    <p class="mb-6 mt-1 text-sm text-slate-600">Gunakan email dan kata sandi akun admin.</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Kata sandi" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-brand shadow-sm focus:ring-brand" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>

<div class="flex items-center justify-between mt-4">
            <a class="rounded-md text-sm font-semibold text-brand hover:text-brand-dark focus:outline-none focus-visible:ring-2 focus-visible:ring-brand" href="{{ route('register') }}">
                Belum punya akun?
            </a>

            <div class="flex items-center">
                @if (Route::has('password.request'))
                    <a class="rounded-md text-sm font-semibold text-brand hover:text-brand-dark focus:outline-none focus-visible:ring-2 focus-visible:ring-brand me-3" href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    Masuk
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
