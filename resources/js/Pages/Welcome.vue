<template>
    <div class="flex flex-col justify-center min-h-full px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="w-auto h-20 mx-auto" src="calendar-logo.png" alt="Calendar Logo">

            <h2 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900">Sign in to your
                account</h2>
        </div>
        <form @submit.prevent="submit" class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <input type="hidden" name="_token" :value="form.csrfToken">
            <div class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                        address</label>
                    <div class="mt-2">
                        <input id="email" v-model="form.email" name="email" type="email"
                            autocomplete="email" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot
                                password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.password">
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        :disabled="form.processing"
                    >
                        Sign in
                    </button>
                </div>
            </div>

            <a href="#" label="Sign in with Google"
                class="flex justify-center my-1.5 items-center bg-white border border-button-border-light rounded-md p-0.5 pr-3 w-full hover:bg-gray-50">
                <div class="flex items-center justify-center bg-white rounded-l w-9 h-9">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                        <title>Sign in with Google</title>
                        <desc>Google G Logo</desc>
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            class="fill-google-logo-blue"></path>
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            class="fill-google-logo-green"></path>
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                            class="fill-google-logo-yellow"></path>
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            class="fill-google-logo-red"></path>
                    </svg>
                </div>
                <span class="text-sm tracking-wider text-google-text-gray">Sign in with Google</span>
            </a>

                <p class="mt-10 text-sm text-center text-gray-500 ">
                    Not a member?
                    <a href="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign up</a>
                </p>
        </form>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';

const page = usePage();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const handleImageError = () => {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
