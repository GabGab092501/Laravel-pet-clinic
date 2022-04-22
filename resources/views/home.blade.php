@extends('layouts.app')

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    
</head>
<header>
    <h1>AC <span>ME</span></h1>
    <p>pet clinic</p>
    
</header>

<body>
    <section class="banner">
    
            <img src="/img/banner.jpg" alt="acmebanner">
         
    </section>
    <nav class="main-nav">
            <ul>
                <li> <a href="{{ URL('dashboard') }}">Dashboard</a></li>
                <li> <a href="{{ URL('pets') }}">Pets</a></li>
                <li><a href="{{ URL('customer') }}">Customer</a></li>
                <li><a href={{ URL('service') }}>Service</a></li>
                <li><a href="{{ URL('consultation') }}">Consultation</a></li>
                <li><a href="{{ URL('contact') }}">Contacts</a></li>
                <li><a href="{{ URL('hoomans') }}">Hoomans</a></li>
                <li><a href="{{ URL('logout') }}">Logout</a></li>
            </ul>
    </nav>
    @yield('contents')
