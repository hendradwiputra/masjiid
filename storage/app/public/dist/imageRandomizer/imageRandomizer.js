/**
 * Initialize image randomization with smooth cross-fade transitions using Tailwind CSS.
 * @param {string} elementId - ID of the container element for images.
 * @param {Object[]} images - Array of image objects with url, fullscreen_mode, title, content, and author.
 * @param {number} interval - Interval for image changes (in milliseconds).
 * @param {Object} options - Optional settings (e.g., { onChange: callback }).
 * @returns {Object} - Controls for pause, resume, and manual change.
 */
function initImageRandomizer(elementId, images, interval = 15000, options = {}) {
    const container = document.getElementById(elementId);
    if (!container) {
        console.error(`Container element with ID "${elementId}" not found`);
        return { pause: () => {}, resume: () => {}, changeNow: () => {} };
    }

    // Clear container and set up for cross-fade
    container.innerHTML = '';
    container.classList.add('relative', 'w-full', 'h-full');

    // Create two image elements for cross-fading
    const image1 = document.createElement('img');
    const image2 = document.createElement('img');
    
    // Set common classes for both images
    [image1, image2].forEach(img => {
        img.classList.add('absolute', 'inset-0', 'w-full', 'h-full', 'object-cover', 
                         'transition-opacity', 'duration-1500', 'ease-in-out');
        img.alt = 'Slide Image';
    });

    // Initially hide the second image
    image1.classList.add('opacity-100');
    image2.classList.add('opacity-0');

    // Add images to container
    container.appendChild(image1);
    container.appendChild(image2);

    // Fallback for empty or invalid images array
    if (!images || images.length === 0) {
        console.warn('No images provided for randomization');
        image1.src = '/storage/images/upload/default-image.webp';
        image1.classList.add('opacity-100');
        return { pause: () => {}, resume: () => {}, changeNow: () => {} };
    }

    // Preload images and track valid ones
    let loadedImages = [];
    let loadPromises = images.map((imageObj) => {
        return new Promise((resolve) => {
            const img = new Image();
            img.src = imageObj.url;
            img.onload = () => {
                loadedImages.push(imageObj);
                resolve();
            };
            img.onerror = () => {
                console.warn(`Failed to load image: ${imageObj.url}`);
                resolve();
            };
        });
    });

    // Wait for all images to preload
    return Promise.all(loadPromises).then(() => {
        if (loadedImages.length === 0 && images.length > 0) {
            console.warn('No valid images loaded; using first image as fallback');
            loadedImages.push(images[0]);
            image1.src = images[0].url;
            image1.alt = images[0].title || 'Slide Image';
            updateMetadata(images[0]);
            applyFullscreenMode(images[0].fullscreen_mode);
            toggleSections(images[0].fullscreen_mode);
        }

        // If only one image, set it and disable transitions/interval
        if (loadedImages.length === 1) {
            console.log('Only one image available - disabling transitions and interval');
            image1.src = loadedImages[0].url;
            image1.alt = loadedImages[0].title || 'Slide Image';
            updateMetadata(loadedImages[0]);
            applyFullscreenMode(loadedImages[0].fullscreen_mode);
            toggleSections(loadedImages[0].fullscreen_mode);

            return {
                pause: () => console.log('Only one image - no interval to pause'),
                resume: () => console.log('Only one image - no interval to resume'),
                changeNow: () => console.log('Only one image - no change possible')
            };
        }

        // Multiple images - proceed with randomization and transitions
        let lastImageIndex = -1;
        let currentImageIndex = 0;
        let isTransitioning = false;
        let activeImage = image1;
        let nextImage = image2;

        // Get a random image, avoiding the same image twice in a row
        function getRandomImage() {
            if (loadedImages.length === 1) return { index: 0, image: loadedImages[0] };
            let newIndex;
            do {
                newIndex = Math.floor(Math.random() * loadedImages.length);
            } while (newIndex === lastImageIndex && loadedImages.length > 1);
            lastImageIndex = newIndex;
            return { index: newIndex, image: loadedImages[newIndex] };
        }

        // Update metadata (title, content, author) in the DOM
        function updateMetadata(imageObj) {
            const titleElement = document.getElementById('slide-title');
            const contentElement = document.getElementById('slide-content');
            const authorElement = document.getElementById('slide-author');

            if (titleElement) titleElement.innerText = imageObj.title || '';
            if (contentElement) contentElement.innerText = imageObj.content || '';
            if (authorElement) authorElement.innerText = imageObj.author || '';
        }

        // Apply fullscreen mode styling for the container
        function applyFullscreenMode(fullscreenMode) {
            // Fullscreen mode is already handled by object-cover class
        }

        // Toggle fullscreen layout mode
        function toggleFullscreenLayout(fullscreenMode) {
            if (typeof window.toggleFullscreenMode === 'function') {
                window.toggleFullscreenMode(fullscreenMode);
            }
        }

        // Toggle sections visibility based on fullscreen_mode
        function toggleSections(fullscreenMode) {
            const sections = [
                'date-section', 'profile-section', 'praytimes-section', 
                'clock-section', 'nextprayer-section'
            ];

            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.style.display = fullscreenMode ? 'none' : '';
                }
            });

            // Special handling for footer section to ensure it's always visible
            const footerSection = document.getElementById('footer-section');
            if (footerSection) {
                footerSection.style.display = 'block';
            }
        }

        // Change image with smooth cross-fade transition
        function changeImage() {
            if (loadedImages.length === 0 || isTransitioning) return;
            
            isTransitioning = true;
            
            const { index: newIndex, image: nextImageObj } = getRandomImage();
            currentImageIndex = newIndex;
            
            // Preload the next image
            nextImage.src = nextImageObj.url;
            nextImage.alt = nextImageObj.title || 'Slide Image';
            
            // Start cross-fade: fade out active, fade in next
            activeImage.classList.remove('opacity-100');
            activeImage.classList.add('opacity-0');
            
            nextImage.classList.remove('opacity-0');
            nextImage.classList.add('opacity-100');
            
            // Update metadata and apply settings
            applyFullscreenMode(nextImageObj.fullscreen_mode);
            toggleFullscreenLayout(nextImageObj.fullscreen_mode);
            toggleSections(nextImageObj.fullscreen_mode);
            updateMetadata(nextImageObj);
            
            if (options.onChange) options.onChange(nextImageObj.url);
            
            // Swap roles for next transition
            const temp = activeImage;
            activeImage = nextImage;
            nextImage = temp;
            
            // Reset transitioning flag after transition completes
            setTimeout(() => {
                isTransitioning = false;
            }, 1000); // Match transition duration
        }

        // Clear any existing interval
        const intervalKey = `imageRandomizer_${elementId}`;
        clearInterval(window[intervalKey]);

        // Start interval for image changes (only if multiple images)
        let currentInterval = null;
        if (loadedImages.length > 1) {
            currentInterval = setInterval(changeImage, interval);
            window[intervalKey] = currentInterval;
        }

        // Initial setup
        const initialImage = loadedImages[0];
        image1.src = initialImage.url;
        image1.alt = initialImage.title || 'Slide Image';
        currentImageIndex = 0;
        lastImageIndex = 0;
        
        updateMetadata(initialImage);
        applyFullscreenMode(initialImage.fullscreen_mode);
        toggleFullscreenLayout(initialImage.fullscreen_mode);
        toggleSections(initialImage.fullscreen_mode);

        // Return controls for pause/resume
        return {
            pause: () => {
                if (loadedImages.length > 1 && currentInterval) {
                    clearInterval(currentInterval);
                    currentInterval = null;
                }
            },
            resume: () => {
                if (loadedImages.length > 1 && !currentInterval) {
                    currentInterval = setInterval(changeImage, interval);
                    window[intervalKey] = currentInterval;
                }
            },
            changeNow: loadedImages.length > 1 ? changeImage : () => {}
        };
    });
}

// Make initImageRandomizer globally available
window.initImageRandomizer = initImageRandomizer;