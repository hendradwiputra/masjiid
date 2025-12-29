// Initialize when the page loads
//document.addEventListener('DOMContentLoaded', function() {
    // This will be called by the image randomizer
    window.toggleFullscreenMode = function(isFullscreen) {
        const leftSide = document.getElementById('left-side');
        const rightSide = document.getElementById('right-side');
        const mainContainer = document.getElementById('main-container');
        const footerSection = document.getElementById('footer-section');
        
        if (!leftSide || !rightSide || !mainContainer) {
            console.warn('Fullscreen toggle elements not found');
            return;
        }
        
        // Check if we're in theme3 (has lg:flex-row class)
        const isTheme3 = mainContainer.classList.contains('lg:flex-row');
        
        // Add transition classes to all elements for smooth animation
        [leftSide, rightSide, mainContainer].forEach(el => {
            if (!el.classList.contains('transition-all')) {
                el.classList.add('transition-all', 'duration-500', 'ease-in-out');
            }
        });
        
        if (isFullscreen) {
            // For Theme3: Ensure right side is visible before hiding left side
            if (isTheme3) {
                rightSide.classList.remove('hidden', 'lg:w-3/4');
                rightSide.classList.add('flex', 'w-full');
                // Small delay to ensure right side is visible before hiding left
                setTimeout(() => {
                    leftSide.classList.add('hidden');
                }, 50);
            } else {
                // For Theme2
                rightSide.classList.remove('w-1/2', 'lg:w-1/2');
                rightSide.classList.add('w-full');
                mainContainer.classList.add('justify-center');
                setTimeout(() => {
                    leftSide.classList.add('hidden');
                }, 50);
            }
            
        } else {
            // Returning to normal mode - show left side first
            leftSide.classList.remove('hidden');
            
            // Small delay to ensure left side is visible before adjusting right side
            setTimeout(() => {
                if (isTheme3) {
                    rightSide.classList.remove('w-full');
                    rightSide.classList.add('lg:w-3/4');
                    mainContainer.classList.remove('flex-col');
                    mainContainer.classList.add('lg:flex-row');
                    // Ensure right side maintains its display class
                    if (!rightSide.classList.contains('lg:flex')) {
                        rightSide.classList.add('lg:flex');
                    }
                } else {
                    rightSide.classList.remove('w-full');
                    rightSide.classList.add('w-1/2', 'lg:w-1/2');
                    mainContainer.classList.remove('justify-center');
                }
            }, 100);
        }
        
        // Footer styling (optional - remove if you want consistent footer)
        if (footerSection) {
            if (!footerSection.classList.contains('transition-all')) {
                footerSection.classList.add('transition-all', 'duration-500', 'ease-in-out');
            }
            
            if (isFullscreen) {
                if (isTheme3) {
                    footerSection.classList.remove('bg-gradient-to-t', 'from-black/90', 'via-black/60', 'to-transparent');
                    footerSection.classList.add('bg-gradient-to-t', 'from-black/95', 'via-black/70', 'to-transparent');
                } else {
                    footerSection.classList.remove('bg-gradient-to-r', 'from-gray-800', 'to-gray-900');
                    footerSection.classList.add('bg-gradient-to-r', 'from-gray-900', 'to-gray-700');
                }
            } else {
                if (isTheme3) {
                    footerSection.classList.remove('bg-gradient-to-t', 'from-black/95', 'via-black/70', 'to-transparent');
                    footerSection.classList.add('bg-gradient-to-t', 'from-black/90', 'via-black/60', 'to-transparent');
                } else {
                    footerSection.classList.remove('bg-gradient-to-r', 'from-gray-900', 'to-gray-700');
                    footerSection.classList.add('bg-gradient-to-r', 'from-gray-800', 'to-gray-900');
                }
            }
        }
    };
//});