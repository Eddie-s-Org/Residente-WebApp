{{-- Page Loader Overlay --}}
<div id="page-loader" style="
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #e5e7eb;
    background-image: linear-gradient(90deg, #e5e7eb 0%, #f3f4f6 40%, #e5e7eb 80%);
    background-size: 200% 100%;
    animation: skeletonShimmer 1.5s ease-in-out infinite;
    transition: opacity 0.5s ease, visibility 0.5s ease;
">
    {{-- Logo --}}
    <img src="{{ asset('logo_buguey.png') }}"
         alt="Buguey Logo"
         style="
            width: 72px; height: 72px;
            object-fit: contain;
            border-radius: 50%;
            background: white;
            padding: 5px;
            margin-bottom: 20px;
            animation: loaderFadeIn 0.5s ease both;
         ">

    {{-- RESIDENTE text --}}
    <span style="
        color: #034732;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 6px;
        font-family: 'Figtree', sans-serif;
        margin-bottom: 24px;
        animation: loaderFadeIn 0.5s ease 0.2s both;
    ">RESIDENTE</span>

    {{-- Minimal thin loading bar --}}
    <div style="
        width: 120px;
        height: 2px;
        background: rgba(3,71,50,0.12);
        border-radius: 2px;
        overflow: hidden;
        animation: loaderFadeIn 0.4s ease 0.4s both;
    ">
        <div style="
            height: 100%;
            width: 40%;
            background: #034732;
            border-radius: 2px;
            animation: loaderSlide 1.2s ease-in-out infinite;
        "></div>
    </div>
</div>

<style>
    @keyframes skeletonShimmer {
        0%   { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    @keyframes loaderFadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes loaderSlide {
        0%   { transform: translateX(-120%); }
        100% { transform: translateX(420%); }
    }
    #page-loader.hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
</style>

<script>
    window.addEventListener('load', function () {
        var loader = document.getElementById('page-loader');
        if (loader) {
            setTimeout(function () {
                loader.classList.add('hidden');
                setTimeout(function () { loader.remove(); }, 550);
            }, 2000);
        }
    });
</script>
