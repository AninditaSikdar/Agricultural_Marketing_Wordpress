/**
 * Agricultural Marketing Portal - Service Worker (Offline-First & Low-Bandwidth Caching)
 * Benchmarked against AGMARKNET 2.0 and e-NAM standards for rural connectivity
 */

const CACHE_NAME = 'agri-marketing-cache-v3';
const STATIC_ASSETS = [
    './',
    './index.html',
    './mandi-rates.html',
    './ebijak-ledger.html',
    './logistics-freight.html',
    './marketplace.html',
    './cold-storage.html',
    './schemes.html',
    './about.html',
    './contact.html',
    './notices.html',
    './services.html',
    './css/main.css',
    './css/button.css',
    './css/responsive.css',
    './js/app.js',
    './data/mandi-rates.json',
    './data/translations.json',
    './data/cold-storage.json',
    './data/marketplace.json',
    './data/schemes.json',
    './data/notices.json'
];

self.addEventListener('install', (e) => {
    e.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(STATIC_ASSETS);
        })
    );
    self.skipWaiting();
});

self.addEventListener('activate', (e) => {
    e.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(
                keys.map((key) => {
                    if (key !== CACHE_NAME) {
                        return caches.delete(key);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

self.addEventListener('fetch', (e) => {
    if (e.request.method !== 'GET') return;

    // Network-First for core code & styles to allow immediate refreshes
    e.respondWith(
        fetch(e.request).then((networkResponse) => {
            if (networkResponse && networkResponse.status === 200) {
                const responseClone = networkResponse.clone();
                caches.open(CACHE_NAME).then((cache) => {
                    cache.put(e.request, responseClone);
                });
            }
            return networkResponse;
        }).catch(() => {
            return caches.match(e.request);
        })
    );
});
