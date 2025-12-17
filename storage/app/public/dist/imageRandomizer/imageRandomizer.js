/**
 * Initialize media randomization (images + videos) with smooth cross-fade transitions.
 * @param {string} elementId - ID of the container element.
 * @param {Object[]} media - Array of media objects: { url, type: 'image'|'video', fullscreen_mode, title, content, author }
 * @param {number} interval - Interval in ms (default 15000).
 * @param {Object} options - Optional { onChange: callback }.
 * @returns {Object} - { pause, resume, changeNow }
 */
function initImageRandomizer(elementId, media, interval = 20000, options = {}) {
    const container = document.getElementById(elementId);
    if (!container) {
        console.error(`Container element with ID "${elementId}" not found`);
        return { pause: () => {}, resume: () => {}, changeNow: () => {} };
    }

    container.innerHTML = '';
    container.classList.add('relative', 'w-full', 'h-full');

    // Two layers for cross-fade
    const layer1 = document.createElement('div');
    const layer2 = document.createElement('div');
    [layer1, layer2].forEach(layer => {
        layer.classList.add('absolute', 'inset-0', 'w-full', 'h-full', 'transition-opacity', 'duration-1500', 'ease-in-out');
    });

    layer1.classList.add('opacity-100');
    layer2.classList.add('opacity-0');

    container.appendChild(layer1);
    container.appendChild(layer2);

    // Fallback
    if (!media || media.length === 0) {
        console.warn('No media provided');
        return { pause: () => {}, resume: () => {}, changeNow: () => {} };
    }

    // Preload and validate media
    let loadedMedia = [];
    let loadPromises = media.map(item => {
        return new Promise(resolve => {
            const test = item.type === 'video' ? document.createElement('video') : new Image();
            test.src = item.url;

            const onLoad = () => {
                loadedMedia.push({ ...item, type: item.type || 'image' });
                resolve();
            };

            if (item.type === 'video') {
                test.onloadeddata = onLoad;
                test.onerror = () => {
                    console.warn(`Failed to load video: ${item.url}`);
                    resolve();
                };
                // Trigger load
                test.load();
            } else {
                test.onload = onLoad;
                test.onerror = () => {
                    console.warn(`Failed to load image: ${item.url}`);
                    resolve();
                };
            }
        });
    });

    return Promise.all(loadPromises).then(() => {
        if (loadedMedia.length === 0) {
            console.warn('No valid media loaded');
            return { pause: () => {}, resume: () => {}, changeNow: () => {} };
        }

        if (loadedMedia.length === 1) {
            renderMedia(layer1, loadedMedia[0]);
            updateMetadata(loadedMedia[0]);
            applyModes(loadedMedia[0].fullscreen_mode);
            return {
                pause: () => {},
                resume: () => {},
                changeNow: () => {}
            };
        }

        let lastIndex = -1;
        let activeLayer = layer1;
        let nextLayer = layer2;
        let isTransitioning = false;

        function getRandomMedia() {
            let newIndex;
            do {
                newIndex = Math.floor(Math.random() * loadedMedia.length);
            } while (newIndex === lastIndex && loadedMedia.length > 1);
            lastIndex = newIndex;
            return { index: newIndex, media: loadedMedia[newIndex] };
        }

        function updateMetadata(item) {
            const titleEl = document.getElementById('slide-title');
            const contentEl = document.getElementById('slide-content');
            const authorEl = document.getElementById('slide-author');

            // Fade out current text first
            [titleEl, contentEl, authorEl].forEach(el => {
                if (el) el.classList.remove('opacity-100');
                if (el) el.classList.add('opacity-0');
            });

            // Update text content
            if (titleEl) titleEl.innerText = item.title || '';
            if (contentEl) contentEl.innerText = item.content || '';
            if (authorEl) authorEl.innerText = item.author || '';

            // Fade in new text after a tiny delay (syncs with image/video fade)
            setTimeout(() => {
                [titleEl, contentEl, authorEl].forEach(el => {
                    if (el && el.innerText.trim() !== '') {
                        el.classList.remove('opacity-0');
                        el.classList.add('opacity-100');
                    }
                });
            }, 300); // Small delay so it feels natural after media starts fading in
        }

        function applyModes(fullscreenMode) {
            if (typeof window.toggleFullscreenMode === 'function') {
                window.toggleFullscreenMode(fullscreenMode);
            }
            toggleSections(fullscreenMode);
        }

        function toggleSections(fullscreenMode) {
            const sections = ['date-section', 'profile-section', 'praytimes-section', 'clock-section', 'nextprayer-section'];
            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.display = fullscreenMode ? 'none' : '';
            });
            const footer = document.getElementById('footer-section');
            if (footer) footer.style.display = 'block';
        }

        // Render media (image or video) into a layer
        function renderMedia(layer, item) {
            layer.innerHTML = ''; // Clear previous

            let element;
            if (item.type === 'video') {
                element = document.createElement('video');
                element.src = item.url;
                element.muted = true;
                element.loop = true;
                element.autoplay = true;
                element.playsInline = true;
                element.classList.add('w-full', 'h-full', 'object-cover');
                // Play when visible
                element.play().catch(() => {});
            } else {
                element = document.createElement('img');
                element.src = item.url;
                element.alt = item.title || 'Slide Media';
                element.classList.add('w-full', 'h-full', 'object-cover');
            }

            layer.appendChild(element);
        }

        // Stop playback on hidden layer
        function pauseHiddenLayer() {
            const hidden = activeLayer === layer1 ? layer2 : layer1;
            const video = hidden.querySelector('video');
            if (video) video.pause();
        }

        function changeMedia() {
            if (isTransitioning) return;
            isTransitioning = true;

            const { media: nextItem } = getRandomMedia();

            // Render next media
            renderMedia(nextLayer, nextItem);

            // Cross-fade
            activeLayer.classList.remove('opacity-100');
            activeLayer.classList.add('opacity-0');
            nextLayer.classList.remove('opacity-0');
            nextLayer.classList.add('opacity-100');

            // Update metadata and modes
            updateMetadata(nextItem);
            applyModes(nextItem.fullscreen_mode);

            if (options.onChange) options.onChange(nextItem.url, nextItem.type);

            // Swap layers
            [activeLayer, nextLayer] = [nextLayer, activeLayer];

            // Pause any video in the now-hidden layer
            setTimeout(pauseHiddenLayer, 100);

            setTimeout(() => {
                isTransitioning = false;
            }, 1500); // Match transition duration
        }

        // Initial media
        renderMedia(activeLayer, loadedMedia[0]);
        updateMetadata(loadedMedia[0]);
        applyModes(loadedMedia[0].fullscreen_mode);

        // Start interval
        const intervalKey = `mediaRandomizer_${elementId}`;
        clearInterval(window[intervalKey]);
        let currentInterval = setInterval(changeMedia, interval);
        window[intervalKey] = currentInterval;

        return {
            pause: () => {
                clearInterval(currentInterval);
                currentInterval = null;
                // Pause visible video too if desired
                const video = activeLayer.querySelector('video');
                if (video) video.pause();
            },
            resume: () => {
                if (!currentInterval) {
                    currentInterval = setInterval(changeMedia, interval);
                    window[intervalKey] = currentInterval;
                    // Resume visible video
                    const video = activeLayer.querySelector('video');
                    if (video) video.play().catch(() => {});
                }
            },
            changeNow: () => changeMedia()
        };
    });
}

// Global
window.initImageRandomizer = initImageRandomizer;