@extends('layouts.base', ['title' => 'Login'])

@section('css')

@endsection

@section('content')
    <div class="relative min-h-screen w-full flex justify-center items-center py-16 md:py-10">
        <div class="card md:w-lg w-screen z-10">
            <div class="text-center px-10 py-12">
                <!-- Logo -->
                <a class="flex justify-center" href="{{ route('vendor.dashboard') }}">
                    <img alt="logo dark" class="h-6 flex dark:hidden" src="/images/logo-dark.png"/>
                    <img alt="" class="h-6 hidden dark:flex" src="/images/logo-light.png"/>
                </a>
                <div class="mt-8 text-center">
                    <h4 class="mb-2.5 text-xl font-semibold text-primary">Welcome Back !</h4>
                    <p class="text-base text-default-500">Sign in to continue to Ecommerce.</p>
                </div>
                <form action="{{ route('login') }}" method="POST" class="text-left w-full mt-10">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-medium text-default-900 text-sm mb-2" for="email">Email</label>
                        <input class="form-input" id="email" name="email" placeholder="Enter your email" type="email" required/>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-default-900 text-sm mb-2" for="Password">Password</label>
                        <input class="form-input" id="Password" name="password" placeholder="Enter Password" type="password" required/>
                    </div>
                    <div class="flex items-center gap-2 mb-4">
                        <input class="form-checkbox" id="checkbox-1" name="remember" type="checkbox"/>
                        <label class="text-default-900 text-sm font-medium" for="checkbox-1">Remember Me</label>
                    </div>
                    <div class="mt-10 text-center">
                        <button class="btn bg-primary text-white w-full" type="submit">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="absolute inset-0 overflow-hidden">
            <svg aria-hidden="true"
                 class="absolute inset-0 size-full fill-black/2 stroke-black/5 dark:fill-white/2.5 dark:stroke-white/2.5">
                <defs>
                    <pattern height="56" id="authPattern" patternunits="userSpaceOnUse" width="56" x="50%" y="16">
                        <path d="M.5 56V.5H72" fill="none"></path>
                    </pattern>
                </defs>
                <rect fill="url(#authPattern)" height="100%" stroke-width="0" width="100%"></rect>
            </svg>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
