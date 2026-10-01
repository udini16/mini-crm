<div class="anim-btn-container" id="{{ $id ?? 'animatedSubmitBtn' }}">
    <div class="anim-button" tabindex="0">
        <div class="anim-text">{{ $slot }}</div>
    </div>
    <div class="anim-progress-bar"></div>
    <svg class="anim-svg" x="0px" y="0px" viewBox="0 0 25 30" style="enable-background:new 0 0 25 30;">
        <path class="anim-check" d="M2,19.2C5.9,23.6,9.4,28,9.4,28L23,2" />
    </svg>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var container = document.getElementById("{{ $id ?? 'animatedSubmitBtn' }}");
        var button = container.querySelector(".anim-button");
        var text = container.querySelector(".anim-text");
        var progressBar = container.querySelector(".anim-progress-bar");
        var pathEl = container.querySelector(".anim-check");
        
        var offset = anime.setDashoffset(pathEl);
        pathEl.setAttribute("stroke-dashoffset", offset);

        var basicTimeline = anime.timeline({
            autoplay: false,
            complete: function() {
                // Submit the form after animation completes
                container.closest('form').submit();
            }
        });

        basicTimeline
            .add({
                targets: text,
                duration: 1,
                opacity: "0"
            })
            .add({
                targets: button,
                duration: 1300,
                height: 10,
                width: 300,
                backgroundColor: "#2B2D2F",
                border: "0",
                borderRadius: 100
            })
            .add({
                targets: progressBar,
                duration: 2000,
                width: 300,
                easing: "linear"
            })
            .add({
                targets: button,
                width: 0,
                duration: 1
            })
            .add({
                targets: progressBar,
                width: 80,
                height: 80,
                delay: 500,
                duration: 750,
                borderRadius: 80,
                backgroundColor: "#71DFBE"
            })
            .add({
                targets: pathEl,
                strokeDashoffset: [offset, 0],
                duration: 200,
                easing: "easeInOutSine"
            });

        // Trigger animation on click (and prevent default form submission if it was a real submit button)
        button.addEventListener("click", function(e) {
            e.preventDefault();
            var form = container.closest('form');
            if (form && !form.checkValidity()) {
                form.reportValidity();
                return;
            }
            basicTimeline.play();
        });

        // Also trigger on enter key for accessibility
        button.addEventListener("keydown", function(e) {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                var form = container.closest('form');
                if (form && !form.checkValidity()) {
                    form.reportValidity();
                    return;
                }
                basicTimeline.play();
            }
        });
    });
</script>
