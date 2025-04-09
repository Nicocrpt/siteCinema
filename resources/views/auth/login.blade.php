<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth.login-form :registerLink="route('register')" />
</x-guest-layout>
