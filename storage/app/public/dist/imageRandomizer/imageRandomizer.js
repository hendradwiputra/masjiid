/**
 * Initialize image randomization with fade transitions using Tailwind CSS.
 * @param {string} elementId - ID of the image element to update.
 * @param {Object[]} images - Array of image objects with url, fullscreen_mode, title, content, and author.
 * @param {number} interval - Interval for image changes (in milliseconds).
 * @param {Object} options - Optional settings (e.g., { onChange: callback }).
 * @returns {Object} - Controls for pause, resume, and manual change.
 */
function initImageRandomizer(elementId, images, interval = 15000, options = {}) {
    const imageElement = document.getElementById(elementId);
    if (!imageElement) {
        console.error(`Image element with ID "${elementId}" not found`);
        return { pause: () => {}, resume: () => {}, changeNow: () => {} };
    }

    // Ensure image element has proper transition classes
    imageElement.classList.add('transition-opacity', 'duration-500', 'ease-in-out');

    // Fallback for empty or invalid images array
    if (!images || images.length === 0) {
        console.warn('No images provided for randomization');
        imageElement.src = '/storage/images/upload/default-image.webp';
        imageElement.classList.remove('opacity-0');
        imageElement.classList.add('opacity-100');
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
            imageElement.src = images[0].url;
            imageElement.alt = images[0].title || 'Slide Image';
            imageElement.classList.remove('opacity-0');
            imageElement.classList.add('opacity-100');
            updateMetadata(images[0]);
            applyFullscreenMode(images[0].fullscreen_mode);
            toggleSections(images[0].fullscreen_mode);
        }

        // If only one image, set it and disable transitions/interval
        if (loadedImages.length === 1) {
            console.log('Only one image available - disabling transitions and interval');
            imageElement.src = loadedImages[0].url;
            imageElement.alt = loadedImages[0].title || 'Slide Image';
            imageElement.classList.remove('opacity-0');
            imageElement.classList.add('opacity-100');
            applyFullscreenMode(loadedImages[0].fullscreen_mode);
            updateMetadata(loadedImages[0]);
            toggleSections(loadedImages[0].fullscreen_mode);

            return {
                pause: () => console.log('Only one image - no interval to pause'),
                resume: () => console.log('Only one image - no interval to resume'),
                changeNow: () => console.log('Only one image - no change possible')
            };
        }

        // Multiple images - proceed with randomization and transitions
        let lastImageIndex = -1;
        let isTransitioning = false;

        // Get a random image, avoiding the same image twice in a row
        function getRandomImage() {
            if (loadedImages.length === 1) return loadedImages[0];
            let newIndex;
            do {
                newIndex = Math.floor(Math.random() * loadedImages.length);
            } while (newIndex === lastImageIndex && loadedImages.length > 1);
            lastImageIndex = newIndex;
            return loadedImages[newIndex];
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

        // Apply fullscreen mode styling for the image
        function applyFullscreenMode(fullscreenMode) {
            imageElement.classList.add('object-cover', 'w-full', 'h-full');
        }

        // Toggle sections visibility based on fullscreen_mode
        function toggleSections(fullscreenMode) {
            const sections = [
                'date-section', 'profile-section', 'praytimes-section', 
                'copyright-section', 'clock-section', 'nextprayer-section'
            ];

            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.style.display = fullscreenMode ? 'none' : '';
                }
            });
        }

        // Change image with smooth fade transition
        function changeImage() {
            if (loadedImages.length === 0 || isTransitioning) return;
            
            isTransitioning = true;
            
            // Start fade out
            imageElement.classList.remove('opacity-100');
            imageElement.classList.add('opacity-0');
            
            setTimeout(() => {
                const nextImage = getRandomImage();
                imageElement.src = nextImage.url;
                imageElement.alt = nextImage.title || 'Slide Image';
                
                // Fade in new image
                imageElement.classList.remove('opacity-0');
                imageElement.classList.add('opacity-100');
                
                applyFullscreenMode(nextImage.fullscreen_mode);
                toggleSections(nextImage.fullscreen_mode);
                updateMetadata(nextImage);
                
                if (options.onChange) options.onChange(nextImage.url);
                
                // Reset transitioning flag after transition completes
                setTimeout(() => {
                    isTransitioning = false;
                }, 500); // Match transition duration
                
            }, 500); // Wait for fade out to complete
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
        imageElement.src = initialImage.url;
        imageElement.alt = initialImage.title || 'Slide Image';
        imageElement.classList.remove('opacity-0');
        imageElement.classList.add('opacity-100');
        applyFullscreenMode(initialImage.fullscreen_mode);
        toggleSections(initialImage.fullscreen_mode);
        updateMetadata(initialImage);

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