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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var container = document.getElementById("{{ $id ?? 'animatedSubmitBtn' }}");
        var button = container.querySelector(".anim-button");
        var text = container.querySelector(".anim-text");
        var progressBar = container.querySelector(".anim-progress-bar");
        var checkEl = container.querySelector(".anim-check");
        var crossEl = container.querySelector(".anim-cross");
        var checkSvg = container.querySelector(".anim-success-svg");
        var crossSvg = container.querySelector(".anim-error-svg");
        
        var checkOffset = anime.setDashoffset(checkEl);
        checkEl.setAttribute("stroke-dashoffset", checkOffset);

        var crossOffset = anime.setDashoffset(crossEl);
        crossEl.setAttribute("stroke-dashoffset", crossOffset);

        var isAnimating = false;

        function createTimeline(isSuccess) {
            var timeline = anime.timeline({
                autoplay: false,
                complete: function() {
                    if (isSuccess) {
                        container.closest('form').submit();
                    } else {
                        // After error animation, wait a second and reset
                        setTimeout(function() {
                            // Fade everything out and instantly reset styles
                            anime({
                                targets: [progressBar, crossSvg],
                                opacity: 0,
                                duration: 300,
                                easing: 'linear',
                                complete: function() {
                                    // Reset DOM states
                                    progressBar.style.width = '0px';
                                    progressBar.style.height = '6px';
                                    progressBar.style.borderRadius = '200px';
                                    progressBar.style.backgroundColor = '#71DFBE';
                                    progressBar.style.opacity = '1';
                                    
                                    button.style.width = '200px';
                                    button.style.height = '48px';
                                    button.style.borderRadius = '8px';
                                    button.style.backgroundColor = '#2B2D2F';
                                    button.style.opacity = '1';
                                    
                                    text.style.opacity = '1';
                                    
                                    crossSvg.style.opacity = '0';
                                    checkSvg.style.opacity = '0';
                                    crossEl.setAttribute("stroke-dashoffset", crossOffset);
                                    checkEl.setAttribute("stroke-dashoffset", checkOffset);
                                    
                                    isAnimating = false;
                                }
                            });
                            
                            // Also fade the button back in
                            anime({
                                targets: [button, text],
                                opacity: 1,
                                duration: 300,
                                delay: 300,
                                easing: 'linear'
                            });
                            
                        }, 1200);
                    }
                }
            });

            timeline
                .add({
                    targets: text,
                    duration: 500,
                    opacity: "0",
                    easing: "easeOutQuad"
                })
                .add({
                    targets: button,
                    duration: 800,
                    height: 6,
                    width: 200,
                    backgroundColor: "#2B2D2F",
                    border: "0",
                    borderRadius: 100
                }, "-=300")
                .add({
                    targets: progressBar,
                    duration: 1000,
                    width: 200,
                    easing: "linear"
                })
                .add({
                    targets: button,
                    width: 0,
                    duration: 1
                })
                .add({
                    targets: progressBar,
                    width: 48,
                    height: 48,
                    delay: 200,
                    duration: 600,
                    borderRadius: 48,
                    backgroundColor: isSuccess ? "#71DFBE" : "#EF4444" // Green or Red
                });

            if (isSuccess) {
                timeline.add({
                    targets: checkSvg,
                    opacity: 1,
                    duration: 10
                }).add({
                    targets: checkEl,
                    strokeDashoffset: [checkOffset, 0],
                    duration: 400,
                    easing: "easeInOutSine"
                });
            } else {
                timeline.add({
                    targets: crossSvg,
                    opacity: 1,
                    duration: 10
                }).add({
                    targets: crossEl,
                    strokeDashoffset: [crossOffset, 0],
                    duration: 400,
                    easing: "easeInOutSine"
                });
            }

            return timeline;
        }

        var successTimeline = createTimeline(true);
        var errorTimeline = createTimeline(false);

        function showCustomError(input, message) {
            var existing = document.getElementById('custom-form-error');
            if (existing) existing.remove();

            var errorDiv = document.createElement('div');
            errorDiv.id = 'custom-form-error';
            errorDiv.innerHTML = '<svg style="width:16px;height:16px;color:#F87171;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> <span style="margin-left:6px;">' + message + '</span>';
            
            errorDiv.style.position = 'absolute';
            errorDiv.style.backgroundColor = '#1E293B'; 
            errorDiv.style.color = '#F87171'; 
            errorDiv.style.border = '1px solid #334155'; 
            errorDiv.style.padding = '8px 12px';
            errorDiv.style.borderRadius = '8px';
            errorDiv.style.fontSize = '13px';
            errorDiv.style.fontWeight = '500';
            errorDiv.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.5)';
            errorDiv.style.zIndex = '1000';
            errorDiv.style.display = 'flex';
            errorDiv.style.alignItems = 'center';
            errorDiv.style.opacity = '0';
            errorDiv.style.transition = 'opacity 0.2s, transform 0.2s';
            errorDiv.style.transform = 'translateY(-10px)';
            
            document.body.appendChild(errorDiv);

            var rect = input.getBoundingClientRect();
            errorDiv.style.top = (rect.bottom + window.scrollY + 8) + 'px';
            errorDiv.style.left = (rect.left + window.scrollX) + 'px';

            requestAnimationFrame(function() {
                errorDiv.style.opacity = '1';
                errorDiv.style.transform = 'translateY(0)';
            });

            input.focus();

            var removeError = function() {
                errorDiv.style.opacity = '0';
                errorDiv.style.transform = 'translateY(-10px)';
                setTimeout(function() { if (errorDiv.parentNode) errorDiv.remove(); }, 200);
                input.removeEventListener('input', removeError);
                input.removeEventListener('change', removeError);
            };

            input.addEventListener('input', removeError);
            input.addEventListener('change', removeError);
            
            // Auto hide after 4 seconds
            setTimeout(removeError, 4000);
        }

        function handleClick(e) {
            e.preventDefault();
            if (isAnimating) return;
            isAnimating = true;
            
            var form = container.closest('form');
            if (form && !form.checkValidity()) {
                errorTimeline.play();
                
                var elements = form.elements;
                for (var i = 0; i < elements.length; i++) {
                    if (!elements[i].validity.valid) {
                        var msg = elements[i].validationMessage || 'Please fill out this field.';
                        showCustomError(elements[i], msg);
                        break;
                    }
                }
            } else {
                successTimeline.play();
            }
        }

        button.addEventListener("click", handleClick);
        button.addEventListener("keydown", function(e) {
            if (e.key === "Enter" || e.key === " ") {
                handleClick(e);
            }
        });
    });
</script>
