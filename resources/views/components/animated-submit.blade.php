<div class="anim-btn-container" id="{{ $id ?? 'animatedSubmitBtn' }}">
    <div class="anim-button" tabindex="0">
        <div class="anim-text">{{ $slot }}</div>
    </div>
    <div class="anim-progress-bar"></div>
    <svg class="anim-svg anim-success-svg" style="opacity:0;" x="0px" y="0px" viewBox="0 0 25 30">
        <path class="anim-check" d="M2,19.2C5.9,23.6,9.4,28,9.4,28L23,2" />
    </svg>
    <svg class="anim-error-svg" style="opacity:0;" x="0px" y="0px" viewBox="0 0 30 30">
        <path class="anim-cross" d="M5,5 L25,25 M25,5 L5,25" />
    </svg>
</div>
