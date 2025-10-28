@extends('layout.layout')

@php
    $title='Spinwheel Area Line Gemba';
    $subTitle = 'Spinwheel Area';
@endphp

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        --wheel-shadow: 0 25px 80px rgba(102, 126, 234, 0.3);
        --card-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        --hover-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }
    
    .spinwheel-container {
        perspective: 1200px;
        padding: 2rem 0;
    }
    
    .wheel-wrapper {
        position: relative;
        width: min(450px, 90vw);
        height: min(450px, 90vw);
        margin: 0 auto;
        transition: all 0.3s ease;
    }
    
    .wheel {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        position: relative;
        transition: transform 4.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        box-shadow: var(--wheel-shadow);
        border: 8px solid #ffffff;
        background: conic-gradient(from 0deg, #667eea, #764ba2, #667eea);
        overflow: hidden;
    }
    
    .wheel.spinning {
        transition: transform 4.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        box-shadow: 0 30px 100px rgba(102, 126, 234, 0.5);
    }
    
    .wheel-segment {
        position: absolute;
        width: 50%;
        height: 50%;
        transform-origin: 100% 100%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .wheel-segment:hover {
        z-index: 5;
        transform: scale(1.02);
    }
    
    .wheel-segment-inner {
        width: 200%;
        height: 200%;
        display: flex;
        align-items: center;
        justify-content: center;
        transform: rotate(-45deg);
        font-weight: 700;
        font-size: clamp(10px, 2.5vw, 14px);
        color: white;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
        padding: 15px;
        text-align: center;
        word-wrap: break-word;
        line-height: 1.3;
        position: relative;
        background: inherit;
    }
    
    .wheel-segment-inner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        border-radius: inherit;
    }
    
    .wheel-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
        z-index: 10;
        border: 6px solid white;
        transition: all 0.3s ease;
    }
    
    .wheel-center:hover {
        transform: translate(-50%, -50%) scale(1.05);
        box-shadow: 0 12px 40px rgba(102, 126, 234, 0.6);
    }
    
    .wheel-pointer {
        position: absolute;
        top: -35px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 30px solid transparent;
        border-right: 30px solid transparent;
        border-top: 60px solid #ef4444;
        z-index: 20;
        filter: drop-shadow(0 8px 15px rgba(239, 68, 68, 0.4));
        transition: all 0.3s ease;
    }
    
    .wheel-pointer::after {
        content: '';
        position: absolute;
        top: -60px;
        left: -30px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #ef4444 0%, #ff6b6b 100%);
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }
    
    .spin-button {
        background: var(--primary-gradient);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        border: none;
        position: relative;
        overflow: hidden;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    
    .spin-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .spin-button:hover:not(:disabled)::before {
        left: 100%;
    }
    
    .spin-button:hover:not(:disabled) {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 20px 50px rgba(102, 126, 234, 0.6);
    }
    
    .spin-button:active:not(:disabled) {
        transform: translateY(-1px) scale(0.98);
    }
    
    .spin-button:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
    }
    
    .result-card {
        background: var(--secondary-gradient);
        animation: slideInUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        box-shadow: var(--card-shadow);
        backdrop-filter: blur(10px);
        color: white !important;
    }
    
    .result-card h2,
    .result-card h3,
    .result-card p,
    .result-card .result-text {
        color: white !important;
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    .confetti {
        position: fixed;
        width: 12px;
        height: 12px;
        position: absolute;
        animation: confetti-fall 4s ease-out;
        border-radius: 2px;
    }
    
    @keyframes confetti-fall {
        0% {
            transform: translateY(-100vh) translateX(0) rotate(0deg) scale(1);
            opacity: 1;
        }
        50% {
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) translateX(var(--drift, 0px)) rotate(720deg) scale(0.3);
            opacity: 0;
        }
    }
    
    .stats-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, rgba(255,255,255,0.3), rgba(255,255,255,0.1));
    }
    
    .stats-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--hover-shadow);
    }
    
    .main-content-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: start;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    @media (max-width: 1200px) {
        .main-content-wrapper {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .wheel-wrapper {
            width: min(380px, 85vw);
            height: min(380px, 85vw);
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 992px) {
        .main-content-wrapper {
            flex-direction: column;
            gap: 2rem;
        }
        
        .wheel-section,
        .stats-section {
            width: 100%;
        }
        
        .wheel {
            width: 300px;
            height: 300px;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
    }
    
    @media (max-width: 768px) {
        .container-fluid {
            padding: 0.5rem;
        }
        
        .main-content-wrapper {
            gap: 1.5rem;
        }
        
        .wheel-wrapper {
            width: min(320px, 90vw);
            height: min(320px, 90vw);
        }
        
        .wheel-center {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }
        
        .wheel-pointer {
            top: -25px;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 40px solid #ef4444;
        }
        
        .wheel-pointer::after {
            top: -40px;
            left: -20px;
            width: 40px;
            height: 40px;
        }
        
        .spin-button {
            padding: 12px 24px;
            font-size: 14px;
            min-width: 120px;
        }
        
        .card {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .result-card {
            margin: 1rem;
            padding: 1.5rem;
        }
        
        .history-item {
            padding: 0.75rem;
            font-size: 0.9rem;
        }
        
        /* Improve touch targets for mobile */
        .btn {
            min-height: 44px;
            min-width: 44px;
        }
        
        /* Better spacing for mobile */
        .mb-8 {
            margin-bottom: 1.5rem !important;
        }
    }
    
    @media (max-width: 576px) {
        .container-fluid {
            padding: 0.25rem;
        }
        
        .wheel-wrapper {
            width: min(240px, 90vw);
            height: min(240px, 90vw);
        }
        
        .wheel-center {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }
        
        .card {
            padding: 1rem;
            margin-bottom: 0.75rem;
        }
        
        .spin-button {
            padding: 10px 20px;
            font-size: 12px;
            min-width: 100px;
        }
        
        .result-card {
            margin: 0.5rem;
            padding: 1rem;
        }
        
        .stats-card {
            padding: 1rem;
        }
        
        .stats-card h3 {
            font-size: 1.5rem;
        }
        
        .stats-card p {
            font-size: 0.8rem;
        }
        
        .history-item {
            padding: 0.5rem;
            font-size: 0.85rem;
        }
        
        /* Smaller text for very small screens */
        .text-4xl {
            font-size: 1.75rem !important;
        }
        
        .text-xl {
            font-size: 1rem !important;
        }
        
        /* Adjust header spacing */
        .mb-8 {
            margin-bottom: 1rem !important;
        }
    }
    
    @media (max-width: 375px) {
        .wheel-wrapper {
            width: min(220px, 90vw);
            height: min(220px, 90vw);
        }
        
        .wheel-center {
            width: 45px;
            height: 45px;
            font-size: 18px;
        }
        
        .card {
            padding: 0.75rem;
        }
        
        .result-card {
            margin: 0.25rem;
            padding: 0.75rem;
        }
        
        .spin-button {
            padding: 8px 16px;
            font-size: 11px;
            min-width: 90px;
        }
    }
    
    /* Landscape orientation adjustments for mobile */
    @media (max-height: 500px) and (orientation: landscape) {
        .main-content-wrapper {
            grid-template-columns: auto 1fr;
            gap: 1rem;
        }
        
        .wheel-wrapper {
            width: min(200px, 40vw);
            height: min(200px, 40vw);
        }
        
        .wheel-center {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
        
        .card {
            padding: 0.75rem;
        }
    }
    
    .wheel-section {
        position: sticky;
        top: 2rem;
    }
    
    .info-section {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }
    
    .card {
        box-shadow: var(--card-shadow);
        border: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .card:hover {
        box-shadow: var(--hover-shadow);
        transform: translateY(-2px);
    }
    
    /* Enhanced scrollbar styling */
    #historyContainer::-webkit-scrollbar {
        width: 8px;
    }
    
    #historyContainer::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
        border-radius: 10px;
    }
    
    #historyContainer::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    #historyContainer::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        transform: scale(1.1);
    }
    
    /* Loading states */
    .loading-skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
        border-radius: 8px;
    }
    
    @keyframes loading {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: -200% 0;
        }
    }
    
    .spinner {
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
        display: inline-block;
        margin-right: 8px;
    }
    
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
    
    /* Pulse animation for stats */
    .pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.7;
        }
    }
    
    /* Line Management Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        backdrop-filter: blur(4px);
    }
    
    .modal-overlay.hidden {
        display: none;
    }
    
    .modal-content {
        border-radius: 12px;
        width: 90%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .modal-header {
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .modal-header h5 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
    }
    
    .modal-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #6b7280;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 0.375rem;
        transition: all 0.2s;
    }
    
    .modal-close:hover {
        background: #f3f4f6;
        color: #374151;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    .modal-footer {
        padding: 1.5rem;
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        transition: all 0.2s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .form-control.is-invalid {
        border-color: #ef4444;
    }
    
    .invalid-feedback {
        display: none;
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }
    
    .invalid-feedback.show {
        display: block;
    }
    
    .btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-primary {
        background: #3b82f6;
        color: white;
    }
    
    .btn-primary:hover {
        background: #2563eb;
    }
    
    .btn-secondary {
        background: #6b7280;
        color: white;
    }
    
    .btn-secondary:hover {
        background: #4b5563;
    }
    
    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.75rem;
    }
    
    .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .text-danger {
        color: #ef4444;
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    
    .hidden {
        display: none;
    }
    

    
    /* Enhanced button states */
    .btn-primary {
        background: var(--primary-gradient);
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-primary:hover::before {
        left: 100%;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }
    
    .btn-outline-danger {
        border: 2px solid #ef4444;
        color: #ef4444;
        background: transparent;
        transition: all 0.3s ease;
    }
    
    .btn-outline-danger:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
    }
    
    /* Enhanced focus states for accessibility */
    .spin-button:focus,
    .btn:focus {
        outline: 3px solid rgba(102, 126, 234, 0.5);
        outline-offset: 2px;
    }
    
    /* Improved text contrast */
    .text-muted {
        color: #6b7280 !important;
    }
    
    .text-primary {
        color: #667eea !important;
    }
    
    /* Screen reader only content */
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }
    
    /* Skip to content link for keyboard navigation */
    .skip-link {
        position: absolute;
        top: -40px;
        left: 6px;
        background: var(--primary-gradient);
        color: white;
        padding: 8px;
        text-decoration: none;
        border-radius: 4px;
        z-index: 1000;
        transition: top 0.3s;
    }
    
    .skip-link:focus {
        top: 6px;
    }
    
    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .wheel-segment {
            border: 2px solid #000;
        }
        
        .spin-button {
            border: 2px solid #000;
        }
        
        .card {
            border: 2px solid #000;
        }
    }
    
    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        .wheel {
            transition: none !important;
        }
        
        .confetti {
            animation: none !important;
        }
        
        .stats-card,
        .spin-button,
        .card {
            transition: none !important;
        }
        
        .result-card {
            animation: none !important;
        }
    }
</style>

<!-- Skip to main content link for keyboard navigation -->
<a href="#main-content" class="skip-link">Skip to main content</a>

<div class="mb-8">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h4 class="mb-2 flex items-center gap-3">
                <iconify-icon icon="game-icons:spinning-wheel" class="text-4xl text-primary-600"></iconify-icon>
                Spinwheel Area Line Gemba
            </h4>
            <p class="text-secondary-light text-base mb-0">
                Putar roda untuk memilih area line gemba secara acak. Fitur ini membantu dalam rotasi pemeriksaan area yang adil dan tidak bias.
            </p>
        </div>
    </div>
</div>

@if($lines->count() > 0)
<!-- Main Content Wrapper -->
<div class="main-content-wrapper" id="main-content">
    <!-- Left Column: Wheel Section -->
    <div class="wheel-section">
        <div class="card p-8 rounded-xl border-0">
            <div class="spinwheel-container">
                <div class="wheel-wrapper" role="img" aria-label="Roda putar dengan {{ count($lines) }} segmen area line">
                    <div class="wheel-pointer" aria-hidden="true"></div>
                    <div id="wheel" class="wheel" aria-label="Roda putar interaktif">
                        <!-- Segments will be generated by JavaScript -->
                    </div>
                    <div class="wheel-center" aria-hidden="true">
                        <iconify-icon icon="game-icons:spinning-wheel"></iconify-icon>
                    </div>
                </div>
                
                <div class="text-center mt-6">
                    <button id="spinButton" 
                            class="spin-button text-white px-10 py-3 rounded-full text-lg font-bold"
                            aria-label="Putar roda untuk memilih area line secara acak"
                            aria-describedby="spin-instructions">
                        <iconify-icon icon="mdi:rotate-right" class="text-xl mr-2" aria-hidden="true"></iconify-icon>
                        Putar Roda
                    </button>
                    <div id="spin-instructions" class="sr-only">
                        Tekan tombol ini atau tekan spasi untuk memutar roda dan memilih area line secara acak
                    </div>
                    <p class="text-secondary-light mt-3 text-sm">Klik tombol untuk memulai spin</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Info Section -->
    <div class="info-section">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 gap-4" role="region" aria-label="Statistik Spinwheel">
            <div class="stats-card card p-5 rounded-xl border-0" 
                 role="status" aria-label="Total area lines tersedia">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm mb-1 text-secondary-light">Total Area Line</p>
                        <h3 class="text-3xl font-bold mb-0 text-primary" aria-live="polite">{{ $lines->count() }}</h3>
                    </div>
                    <div class="text-5xl text-blue-500 opacity-80">
                        <iconify-icon icon="mdi:factory" aria-hidden="true"></iconify-icon>
                    </div>
                </div>
            </div>
            
            <div class="stats-card card p-5 rounded-xl border-0" 
                 role="status" aria-label="Jumlah putaran hari ini">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm mb-1 text-secondary-light">Total Spin Hari Ini</p>
                        <h3 class="text-3xl font-bold mb-0 text-primary" id="todaySpinCount" aria-live="polite">0</h3>
                    </div>
                    <div class="text-5xl text-green-500 opacity-80">
                        <iconify-icon icon="mdi:rotate-right" aria-hidden="true"></iconify-icon>
                    </div>
                </div>
            </div>
            
            <div class="stats-card card p-5 rounded-xl border-0" 
                 role="status" aria-label="Area line terakhir yang terpilih">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm mb-1 text-secondary-light">Terakhir Dipilih</p>
                        <h3 class="text-base font-bold mb-0 text-primary" id="lastSelected" aria-live="polite">-</h3>
                    </div>
                    <div class="text-5xl text-purple-500 opacity-80">
                        <iconify-icon icon="mdi:trophy" aria-hidden="true"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Result Card -->
        <div id="resultCard" 
             class="card result-card text-white p-6 rounded-xl" 
             style="display: none;"
             role="alert"
             aria-live="assertive"
             aria-label="Hasil putaran roda">
            <div class="text-center">
                <iconify-icon icon="mdi:trophy" class="text-5xl mb-3" aria-hidden="true"></iconify-icon>
                <h3 class="text-2xl font-bold mb-2">Area Terpilih!</h3>
                <h2 class="text-4xl font-bold mb-3" id="resultName" aria-live="polite"></h2>
                <p class="text-lg opacity-90 mb-4" id="resultDescription"></p>
            </div>
        </div>

        <!-- History Section -->
        <div class="card p-5 rounded-xl border-0" role="region" aria-label="Riwayat putaran roda">
            <div class="flex items-center justify-between mb-4">
                <h6 class="mb-0 flex items-center gap-2 font-semibold">
                    <iconify-icon icon="mdi:history" class="text-xl" aria-hidden="true"></iconify-icon>
                    Riwayat Spin Hari Ini
                </h6>
                <button id="clearHistoryButton" 
                        class="btn btn-sm bg-danger-600 hover:bg-danger-700 text-white rounded-lg px-3 py-1 text-sm"
                        aria-label="Hapus semua riwayat putaran">
                    <iconify-icon icon="mdi:delete" class="mr-1" aria-hidden="true"></iconify-icon>
                    Hapus
                </button>
            </div>
            <div id="historyContainer" 
                 class="space-y-2 max-h-96 overflow-y-auto"
                 role="log"
                 aria-label="Daftar riwayat putaran"
                 aria-live="polite">
                <p class="text-secondary-light text-center py-4 text-sm">Belum ada riwayat spin hari ini</p>
            </div>
        </div>

        <!-- Line Management Section -->
        <div class="card p-5 rounded-xl border-0 bg-white dark:bg-neutral-700 border border-neutral-200 dark:border-neutral-600" role="region" aria-label="Kelola Area Line">
            <div class="flex items-center justify-between mb-4">
                <h6 class="mb-0 flex items-center gap-2 font-semibold text-neutral-900 dark:text-neutral-200">
                    <iconify-icon icon="mdi:cog" class="text-xl" aria-hidden="true"></iconify-icon>
                    Kelola Area Line
                </h6>
                <button id="addLineButton" 
                        class="btn btn-sm bg-primary-600 hover:bg-primary-700 text-white rounded-lg px-3 py-1 text-sm"
                        aria-label="Tambah area line baru">
                    <iconify-icon icon="mdi:plus" class="mr-1" aria-hidden="true"></iconify-icon>
                    Tambah Line
                </button>
            </div>
            
            <!-- Search Bar -->
            <div class="mb-4">
                <div class="relative">
                    <input 
                        type="text" 
                        id="searchLines" 
                        class="w-full px-4 py-2 pr-10 border border-neutral-200 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-600 text-neutral-900 dark:text-neutral-200 placeholder-neutral-500 dark:placeholder-neutral-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
                        placeholder="Cari area line..." 
                        onkeyup="filterLines()"
                    >

                </div>
            </div>
            <div class="space-y-2 max-h-96 overflow-y-auto">
                <div id="linesContainer">
                    @foreach($lines as $index => $line)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-neutral-700 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-600 transition" data-line-id="{{ $line->id }}">
                        <div class="flex items-center gap-2 flex-1 min-w-0">
                            <div class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">
                                {{ $index + 1 }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <h6 class="mb-0 font-semibold text-sm truncate">{{ $line->name }}</h6>
                                <p class="text-xs text-secondary-light mb-0 truncate">{{ $line->description ?: 'Tidak ada deskripsi' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-1 flex-shrink-0 ml-2">
                            <button class="btn btn-sm bg-warning-600 hover:bg-warning-700 text-white rounded px-2 py-1 text-xs" 
                                    onclick="editLine({{ $line->id }}, '{{ addslashes($line->name) }}', '{{ addslashes($line->description) }}')"
                                    aria-label="Edit {{ $line->name }}">
                                <iconify-icon icon="mdi:pencil"></iconify-icon>
                            </button>
                            <button class="btn btn-sm bg-danger-600 hover:bg-danger-700 text-white rounded px-2 py-1 text-xs" 
                                    onclick="deleteLine({{ $line->id }}, '{{ addslashes($line->name) }}')"
                                    aria-label="Hapus {{ $line->name }}">
                                <iconify-icon icon="mdi:delete"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@else
<!-- Empty State -->
<div class="card p-12 rounded-xl border-0 text-center">
    <iconify-icon icon="mdi:alert-circle-outline" class="text-6xl text-warning-600 mb-4"></iconify-icon>
    <h5 class="mb-2">Tidak Ada Data Line</h5>
    <p class="text-secondary-light">Silakan tambahkan data line terlebih dahulu untuk menggunakan fitur spinwheel.</p>
</div>
@endif

<!-- Line Management Modal -->
<div id="lineModal" class="modal-overlay hidden">
    <div class="modal-content bg-white dark:bg-neutral-700 border border-neutral-200 dark:border-neutral-600">
        <div class="modal-header border-b border-neutral-200 dark:border-neutral-600">
            <h5 id="modalTitle" class="text-neutral-900 dark:text-neutral-200">Tambah Area Line</h5>
            <button type="button" class="modal-close text-neutral-500 dark:text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-200" onclick="closeLineModal()">
                <iconify-icon icon="mdi:close"></iconify-icon>
            </button>
        </div>
        <form id="lineForm">
            <div class="modal-body">
                <div class="form-group">
                    <label for="lineName" class="text-neutral-900 dark:text-neutral-200">Nama Line <span class="text-danger">*</span></label>
                    <input type="text" id="lineName" name="name" class="form-control bg-white dark:bg-neutral-600 border-neutral-200 dark:border-neutral-600 text-neutral-900 dark:text-neutral-200 placeholder-neutral-500 dark:placeholder-neutral-400" required>
                    <div class="invalid-feedback" id="nameError"></div>
                </div>
                <div class="form-group">
                    <label for="lineDescription" class="text-neutral-900 dark:text-neutral-200">Deskripsi <span class="text-danger">*</span></label>
                    <textarea id="lineDescription" name="description" class="form-control bg-white dark:bg-neutral-600 border-neutral-200 dark:border-neutral-600 text-neutral-900 dark:text-neutral-200 placeholder-neutral-500 dark:placeholder-neutral-400" rows="3" required></textarea>
                    <div class="invalid-feedback" id="descriptionError"></div>
                </div>
            </div>
            <div class="modal-footer border-t border-neutral-200 dark:border-neutral-600">
                <button type="button" class="btn btn-secondary bg-neutral-200 dark:bg-neutral-600 text-neutral-700 dark:text-neutral-200 hover:bg-neutral-300 dark:hover:bg-neutral-500" onclick="closeLineModal()">Batal</button>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <span class="btn-text">Simpan</span>
                    <span class="btn-loading hidden">
                        <iconify-icon icon="mdi:loading" class="animate-spin"></iconify-icon>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('user-script')
<!-- Data from server -->
<script id="lines-data" type="application/json">
{!! json_encode($lines) !!}
</script>

<script>
    const lines = JSON.parse(document.getElementById('lines-data').textContent);
    let isSpinning = false;
    let spinHistory = JSON.parse(localStorage.getItem('spinHistory_' + new Date().toDateString()) || '[]');
    
    // Color palette for wheel segments
    const colors = [
        '#FF6B6B', '#4ECDC4', '#45B7D1', '#FFA07A', '#98D8C8',
        '#F7DC6F', '#BB8FCE', '#85C1E2', '#F8B739', '#52B788',
        '#FF8C94', '#A8DADC', '#E63946', '#F4A261', '#2A9D8F'
    ];
    
    function initWheel() {
        const wheel = document.getElementById('wheel');
        const segmentAngle = 360 / lines.length;
        
        lines.forEach((line, index) => {
            const segment = document.createElement('div');
            segment.className = 'wheel-segment';
            segment.style.transform = `rotate(${segmentAngle * index}deg)`;
            
            const inner = document.createElement('div');
            inner.className = 'wheel-segment-inner';
            inner.style.background = colors[index % colors.length];
            inner.textContent = line.name;
            
            segment.appendChild(inner);
            wheel.appendChild(segment);
        });
        
        updateStats();
        renderHistory();
    }
    
    function spinWheel() {
        if (isSpinning || lines.length === 0) return;
        
        isSpinning = true;
        const spinButton = document.getElementById('spinButton');
        spinButton.disabled = true;
        
        // Add loading spinner to button
        spinButton.innerHTML = '<span class="spinner"></span>Memutar...';
        
        // Add pulse effect to stats cards
        document.querySelectorAll('.stats-card').forEach(card => {
            card.classList.add('pulse');
        });
        
        const wheel = document.getElementById('wheel');
        const resultCard = document.getElementById('resultCard');
        resultCard.style.display = 'none';
        
        // Random rotation (5-10 full rotations + random position)
        const randomIndex = Math.floor(Math.random() * lines.length);
        const segmentAngle = 360 / lines.length;
        const baseRotation = 360 * (5 + Math.random() * 5); // 5-10 rotations
        const targetRotation = baseRotation + (360 - (segmentAngle * randomIndex) - (segmentAngle / 2));
        
        // Enhanced easing for more realistic spin
        wheel.style.transition = 'transform 4s cubic-bezier(0.23, 1, 0.32, 1)';
        wheel.style.transform = `rotate(${targetRotation}deg)`;
        
        // Add visual feedback during spin
        wheel.style.filter = 'brightness(1.1) saturate(1.2)';
        
        // Show result after animation
        setTimeout(() => {
            const selectedLine = lines[randomIndex];
            
            // Reset wheel visual effects
            wheel.style.filter = 'none';
            
            // Remove pulse effect from stats cards
            document.querySelectorAll('.stats-card').forEach(card => {
                card.classList.remove('pulse');
            });
            
            showResult(selectedLine);
            saveToHistory(selectedLine);
            createConfetti();
        }, 4000);
    }
    
    function showResult(line) {
        const resultCard = document.getElementById('resultCard');
        const resultName = document.getElementById('resultName');
        const resultDescription = document.getElementById('resultDescription');
        
        // Ensure elements exist before setting content
        if (resultName) {
            resultName.textContent = line.name;
            resultName.style.color = 'white';
        }
        if (resultDescription) {
            resultDescription.textContent = line.description || 'Tidak ada deskripsi';
            resultDescription.style.color = 'white';
        }
        
        if (resultCard) {
            resultCard.style.display = 'block';
            resultCard.style.color = 'white';
        }
        
        // Update last selected
        const lastSelected = document.getElementById('lastSelected');
        if (lastSelected) {
            lastSelected.textContent = line.name;
        }
        
        // Announce result to screen readers
        announceResult(line.name);
        
        // Focus on the result card for keyboard users
        if (resultCard) {
            resultCard.setAttribute('tabindex', '-1');
            resultCard.focus();
        }
        
        // Ensure button is properly reset
        const spinButton = document.getElementById('spinButton');
        if (spinButton) {
            spinButton.disabled = false;
            spinButton.innerHTML = '<iconify-icon icon="mdi:rotate-right" class="text-xl mr-2" aria-hidden="true"></iconify-icon>Putar Roda';
        }
        isSpinning = false;
    }
    
    function createConfetti() {
        const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57', '#ff9ff3', '#54a0ff', '#667eea', '#764ba2', '#f093fb'];
        const shapes = ['circle', 'square', 'triangle'];
        
        for (let i = 0; i < 80; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            
            // Random positioning
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.top = '-20px';
            
            // Random colors and shapes
            const color = colors[Math.floor(Math.random() * colors.length)];
            const shape = shapes[Math.floor(Math.random() * shapes.length)];
            
            confetti.style.backgroundColor = color;
            
            // Apply different shapes
            if (shape === 'circle') {
                confetti.style.borderRadius = '50%';
            } else if (shape === 'triangle') {
                confetti.style.width = '0';
                confetti.style.height = '0';
                confetti.style.backgroundColor = 'transparent';
                confetti.style.borderLeft = '6px solid transparent';
                confetti.style.borderRight = '6px solid transparent';
                confetti.style.borderBottom = `12px solid ${color}`;
            }
            
            // Random size
            const size = Math.random() * 8 + 6;
            if (shape !== 'triangle') {
                confetti.style.width = size + 'px';
                confetti.style.height = size + 'px';
            }
            
            // Random animation delay and duration
            confetti.style.animationDelay = Math.random() * 2 + 's';
            confetti.style.animationDuration = (Math.random() * 2 + 3) + 's';
            
            // Random horizontal drift
            const drift = (Math.random() - 0.5) * 200;
            confetti.style.setProperty('--drift', drift + 'px');
            
            document.body.appendChild(confetti);
            
            setTimeout(() => {
                if (confetti.parentNode) {
                    confetti.remove();
                }
            }, 8000);
        }
    }
    
    function saveToHistory(line) {
        const historyItem = {
            line: line,
            timestamp: new Date().toISOString()
        };
        
        spinHistory.unshift(historyItem);
        if (spinHistory.length > 10) spinHistory.pop();
        
        localStorage.setItem('spinHistory_' + new Date().toDateString(), JSON.stringify(spinHistory));
        updateStats();
        renderHistory();
    }
    
    function renderHistory() {
        const container = document.getElementById('historyContainer');
        
        if (spinHistory.length === 0) {
            container.innerHTML = '<p class="text-secondary-light text-center py-4">Belum ada riwayat spin hari ini</p>';
            return;
        }
        
        container.innerHTML = spinHistory.map((item, index) => {
            const time = new Date(item.timestamp).toLocaleTimeString('id-ID', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            return `
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-neutral-700 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-600 transition">
                    <div class="flex items-center gap-2 flex-1 min-w-0">
                        <div class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">
                            ${index + 1}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h6 class="mb-0 font-semibold text-sm truncate">${item.line.name}</h6>
                            <p class="text-xs text-secondary-light mb-0 truncate">${item.line.description || 'Tidak ada deskripsi'}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0 ml-2">
                        <div class="text-secondary-light text-xs">
                            <iconify-icon icon="mdi:clock-outline"></iconify-icon>
                            ${time}
                        </div>
                        <button class="btn btn-sm bg-danger-600 hover:bg-danger-700 text-white rounded px-2 py-1 text-xs" 
                                onclick="deleteHistoryItem(${index})"
                                aria-label="Hapus riwayat ${item.line.name}"
                                title="Hapus riwayat">
                            <iconify-icon icon="mdi:delete"></iconify-icon>
                        </button>
                    </div>
                </div>
            `;
        }).join('');
    }
    
    function updateStats() {
        document.getElementById('todaySpinCount').textContent = spinHistory.length;
        if (spinHistory.length > 0) {
            document.getElementById('lastSelected').textContent = spinHistory[0].line.name;
        }
    }
    
    function clearHistory() {
        if (confirm('Apakah Anda yakin ingin menghapus semua riwayat spin hari ini?')) {
            spinHistory = [];
            localStorage.removeItem('spinHistory_' + new Date().toDateString());
            updateStats();
            renderHistory();
            document.getElementById('lastSelected').textContent = '-';
        }
    }

    // Hapus satu item riwayat berdasarkan indeks
    function deleteHistoryItem(index) {
        const item = spinHistory[index];
        if (!item) return;
        
        if (confirm(`Apakah Anda yakin ingin menghapus riwayat untuk "${item.line.name}"?`)) {
            // Hapus item dari array
            spinHistory.splice(index, 1);
            // Simpan kembali ke localStorage
            localStorage.setItem('spinHistory_' + new Date().toDateString(), JSON.stringify(spinHistory));
            // Perbarui statistik dan tampilan riwayat
            updateStats();
            renderHistory();
            // Jika sudah kosong, set label terakhir dipilih menjadi '-'
            if (spinHistory.length === 0) {
                const lastSelected = document.getElementById('lastSelected');
                if (lastSelected) lastSelected.textContent = '-';
            }
        }
    }
    
    // Announce spin result to screen readers
    function announceResult(lineName) {
        const announcement = document.createElement('div');
        announcement.setAttribute('aria-live', 'assertive');
        announcement.setAttribute('aria-atomic', 'true');
        announcement.className = 'sr-only';
        announcement.textContent = `Hasil putaran: ${lineName} telah terpilih`;
        document.body.appendChild(announcement);
        
        setTimeout(() => {
            if (document.body.contains(announcement)) {
                document.body.removeChild(announcement);
            }
        }, 1000);
    }
    
    // Line Management Functions
    let currentEditingLineId = null;

    function openAddLineModal() {
        currentEditingLineId = null;
        document.getElementById('modalTitle').textContent = 'Tambah Area Line';
        document.getElementById('lineForm').reset();
        clearValidationErrors();
        document.getElementById('lineModal').classList.remove('hidden');
    }

    function editLine(id, name, description) {
        currentEditingLineId = id;
        document.getElementById('modalTitle').textContent = 'Edit Area Line';
        document.getElementById('lineName').value = name;
        document.getElementById('lineDescription').value = description;
        clearValidationErrors();
        document.getElementById('lineModal').classList.remove('hidden');
    }

    function closeLineModal() {
        document.getElementById('lineModal').classList.add('hidden');
        currentEditingLineId = null;
        document.getElementById('lineForm').reset();
        clearValidationErrors();
    }

    function clearValidationErrors() {
        document.querySelectorAll('.form-control').forEach(input => {
            input.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(error => {
            error.classList.remove('show');
            error.textContent = '';
        });
    }

    function showValidationErrors(errors) {
        clearValidationErrors();
        for (const field in errors) {
            const input = document.querySelector(`[name="${field}"]`);
            const errorDiv = document.getElementById(`${field}Error`);
            if (input && errorDiv) {
                input.classList.add('is-invalid');
                errorDiv.textContent = errors[field][0];
                errorDiv.classList.add('show');
            }
        }
    }

    function setButtonLoading(loading) {
        const submitBtn = document.getElementById('submitBtn');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');
        
        if (loading) {
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            submitBtn.disabled = true;
        } else {
            btnText.classList.remove('hidden');
            btnLoading.classList.add('hidden');
            submitBtn.disabled = false;
        }
    }

    function showToast(message, type = 'success') {
        // Simple toast notification
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 p-4 rounded-lg text-white z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }

    function filterLines() {
        const searchTerm = document.getElementById('searchLines').value.toLowerCase();
        const lineItems = document.querySelectorAll('#linesContainer > div[data-line-id]');
        
        lineItems.forEach(item => {
            const lineName = item.querySelector('h6').textContent.toLowerCase();
            const lineDescription = item.querySelector('p').textContent.toLowerCase();
            
            if (lineName.includes(searchTerm) || lineDescription.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function deleteLine(id, name) {
        if (!confirm(`Apakah Anda yakin ingin menghapus line "${name}"?`)) {
            return;
        }

        fetch(`/spinwheel/lines/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message);
                refreshLinesDisplay();
                updateSpinwheel();
            } else {
                showToast(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan saat menghapus line', 'error');
        });
    }

    function refreshLinesDisplay() {
        fetch('/spinwheel/lines')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const container = document.getElementById('linesContainer');
                container.innerHTML = '';
                
                data.data.forEach((line, index) => {
                    const lineElement = document.createElement('div');
                    lineElement.className = 'flex items-center justify-between p-3 bg-gray-50 dark:bg-neutral-700 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-600 transition';
                    lineElement.setAttribute('data-line-id', line.id);
                    lineElement.innerHTML = `
                        <div class="flex items-center gap-2 flex-1 min-w-0">
                            <div class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">
                                ${index + 1}
                            </div>
                            <div class="min-w-0 flex-1">
                                <h6 class="mb-0 font-semibold text-sm truncate">${line.name}</h6>
                                <p class="text-xs text-secondary-light mb-0 truncate">${line.description || 'Tidak ada deskripsi'}</p>
                            </div>
                        </div>
                        <div class="flex gap-1 flex-shrink-0 ml-2">
                             <button class="btn btn-sm bg-warning-600 hover:bg-warning-700 text-white rounded px-2 py-1 text-xs" 
                                     onclick="editLine(${line.id}, '${line.name.replace(/'/g, "\\'")}', '${(line.description || '').replace(/'/g, "\\'")}')"
                                     aria-label="Edit ${line.name}">
                                 <iconify-icon icon="mdi:pencil"></iconify-icon>
                             </button>
                             <button class="btn btn-sm bg-danger-600 hover:bg-danger-700 text-white rounded px-2 py-1 text-xs" 
                                     onclick="deleteLine(${line.id}, '${line.name.replace(/'/g, "\\'")}')"
                                     aria-label="Hapus ${line.name}">
                                 <iconify-icon icon="mdi:delete"></iconify-icon>
                             </button>
                         </div>
                    `;
                    container.appendChild(lineElement);
                });

                // Update total count
                document.querySelector('.stats-card h3').textContent = data.data.length;
            }
        })
        .catch(error => {
            console.error('Error refreshing lines:', error);
        });
    }

    function updateSpinwheel() {
        // Refresh the page to update the spinwheel with new lines
        location.reload();
    }

    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
        if (lines.length > 0) {
            initWheel();
            
            document.getElementById('spinButton').addEventListener('click', spinWheel);

            document.getElementById('clearHistoryButton').addEventListener('click', clearHistory);
            
            // Line form submission
            document.getElementById('lineForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const data = {
                    name: formData.get('name'),
                    description: formData.get('description')
                };

                setButtonLoading(true);
                clearValidationErrors();

                const url = currentEditingLineId ? `/spinwheel/lines/${currentEditingLineId}` : '/spinwheel/lines';
                const method = currentEditingLineId ? 'PUT' : 'POST';

                fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    setButtonLoading(false);
                    
                    if (data.success) {
                        showToast(data.message);
                        closeLineModal();
                        refreshLinesDisplay();
                        updateSpinwheel();
                    } else {
                        if (data.errors) {
                            showValidationErrors(data.errors);
                        } else {
                            showToast(data.message, 'error');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    setButtonLoading(false);
                    showToast('Terjadi kesalahan saat menyimpan data', 'error');
                });
            });

            // Add line button
            document.getElementById('addLineButton').addEventListener('click', openAddLineModal);

            // Close modal when clicking outside
            document.getElementById('lineModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeLineModal();
                }
            });
            
            // Keyboard navigation support
            document.addEventListener('keydown', function(event) {
                // Space or Enter key to spin the wheel
                if ((event.code === 'Space' || event.code === 'Enter') && 
                    event.target === document.getElementById('spinButton')) {
                    event.preventDefault();
                    spinWheel();
                }
                
                // Escape key to close result card or modal
                if (event.code === 'Escape') {
                    if (!document.getElementById('lineModal').classList.contains('hidden')) {
                        closeLineModal();
                    } else {
                        const resultCard = document.getElementById('resultCard');
                        if (resultCard && resultCard.style.display !== 'none') {
                            resultCard.style.display = 'none';
                            const spinButton = document.getElementById('spinButton');
                            if (spinButton) {
                                spinButton.focus();
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
