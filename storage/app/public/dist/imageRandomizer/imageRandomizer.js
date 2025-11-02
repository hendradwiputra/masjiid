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

    // Fallback for empty or invalid images array
    if (!images || images.length === 0) {
        console.warn('No images provided for randomization');
        imageElement.src = elementId === 'random-image' 
            ? '/storage/images/upload/default-image.webp'
            : '/storage/images/upload/default-image.webp';
        return { pause: () => {}, resume: () => {}, changeNow: () => {} };
    }

    // Preload images and track valid ones
    let loadedImages = [];
    let loadPromises = images.map((imageObj, index) => {
        return new Promise((resolve) => {
            const img = new Image();
            img.src = imageObj.url; // Use imageObj.url instead of src
            img.onload = () => {
                loadedImages.push(imageObj); // Store the full object
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
            updateMetadata(images[0]); // Update metadata for fallback
            applyFullscreenMode(images[0].fullscreen_mode); // Apply fullscreen mode
            toggleSections(images[0].fullscreen_mode); // Toggle sections for fallback
        }

        // If only one image, set it and disable transitions/interval
        if (loadedImages.length === 1) {
            console.log('Only one image available - disabling transitions and interval');
            imageElement.src = loadedImages[0].url;
            imageElement.alt = loadedImages[0].title || 'Slide Image';
            imageElement.style.opacity = '1'; // Ensure it's fully visible
            applyFullscreenMode(loadedImages[0].fullscreen_mode); // Apply fullscreen mode
            updateMetadata(loadedImages[0]); // Update metadata
            toggleSections(loadedImages[0].fullscreen_mode); // Toggle sections

            // Return controls with no-op functions
            return {
                pause: () => console.log('Only one image - no interval to pause'),
                resume: () => console.log('Only one image - no interval to resume'),
                changeNow: () => console.log('Only one image - no change possible')
            };
        }

        // Multiple images - proceed with randomization and transitions
        let lastImageIndex = -1;

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
                'date-section', 'profile-section', 'praytimes-section', 'copyright-section', 'clock-section', 'nextprayer-section'
            ];

            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.style.display = fullscreenMode ? 'none' : ''; // '' restores original display (e.g., 'block')
                }
            });
        }

        // Change image with Tailwind fade transition
        function changeImage() {
            if (loadedImages.length === 0) return;
            imageElement.style.opacity = '0';
            setTimeout(() => {
                const nextImage = getRandomImage();
                imageElement.src = nextImage.url;
                imageElement.alt = nextImage.title || 'Slide Image';
                imageElement.style.opacity = '1';
                applyFullscreenMode(nextImage.fullscreen_mode); // Apply fullscreen mode
                toggleSections(nextImage.fullscreen_mode); // Toggle sections
                updateMetadata(nextImage); // Update metadata
                if (options.onChange) options.onChange(nextImage.url);
            }, 300); // Match Tailwind transition duration
        }

        // Clear any existing interval
        const intervalKey = `imageRandomizer_${elementId}`;
        clearInterval(window[intervalKey]);

        // Start interval for image changes (only if multiple images)
        if (loadedImages.length > 1) {
            window[intervalKey] = setInterval(changeImage, interval);
        }

        // Initial setup
        const initialImage = loadedImages[0];
        imageElement.src = initialImage.url;
        imageElement.alt = initialImage.title || 'Slide Image';
        imageElement.style.opacity = '1';
        applyFullscreenMode(initialImage.fullscreen_mode);
        toggleSections(initialImage.fullscreen_mode);
        updateMetadata(initialImage);

        // If multiple, start changing
        if (loadedImages.length > 1) {
            changeImage(); // Start the cycle
        }

        // Return controls for pause/resume
        return {
            pause: () => {
                if (loadedImages.length > 1) {
                    clearInterval(window[intervalKey]);
                }
            },
            resume: () => {
                if (loadedImages.length > 1) {
                    clearInterval(window[intervalKey]);
                    window[intervalKey] = setInterval(changeImage, interval);
                }
            },
            changeNow: loadedImages.length > 1 ? changeImage : () => {}
        };
    });
}

// Make initImageRandomizer globally available
window.initImageRandomizer = initImageRandomizer;