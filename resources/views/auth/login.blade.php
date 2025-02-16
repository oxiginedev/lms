<x-layouts.base>
    <x-authentication-card>
        <x-validation-errors class="mb-4" />

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email address') }}" />
                <x-forms.input
                    type="email"
                    id="email"
                    name="email"
                    inputmode="email"
                    class="mt-1 block w-full"
                    :value="old('email')"
                    autocomplete="username"
                    required
                />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-forms.input
                    type="password"
                    id="password"
                    name="password"
                    class="mt-1 block w-full"
                    autocomplete="password"
                    required
                />
            </div>

            <div class="mt-2">
                <a href="" class="text-sm font-medium text-blue-500 underline underline-offset-2">
                    {{ __('Forgot your password') }}
                </a>
            </div>

            <div class="mt-4">
                <x-buttons.primary type="submit" class="w-full justify-center">
                    {{ __('Continue to Dashboard') }}
                </x-buttons.primary>
            </div>
        </form>
    </x-authentication-card>
</x-layouts.base>
