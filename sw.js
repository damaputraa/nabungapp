// ================================================================
// SERVICE WORKER - Yuk Nabung PWA (v2.1.0 - Network First)
// ================================================================

const CACHE_NAME = 'yuknabung-v2.1.0';
const OFFLINE_URL = '/offline.php';

// DAFTAR ASSET EKSTERNAL / STATIC YANG DI-PRECACHE
const urlsToPrecache = [
    'https://code.jquery.com/jquery-3.6.0.min.js',
    'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css',
    'https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css',
    'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback',
    'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js'
];

// ================================================================
// INSTALL SERVICE WORKER
// ================================================================
self.addEventListener('install', function(event) {
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function(cache) {
                return cache.addAll(urlsToPrecache);
            })
            .catch(function(err) {
                console.warn('Precache warning:', err);
            })
    );
});

// ================================================================
// ACTIVATE SERVICE WORKER - PURGE OLD CACHES IMMEDIATELY
// ================================================================
self.addEventListener('activate', function(event) {
    event.waitUntil(
        caches.keys().then(function(cacheNames) {
            return Promise.all(
                cacheNames.map(function(cacheName) {
                    if (cacheName !== CACHE_NAME) {
                        console.log('🗑️ Deleting obsolete cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(function() {
            return self.clients.claim();
        })
    );
});

// ================================================================
// LISTEN FOR SKIP WAITING & CLEAR CACHE MESSAGES
// ================================================================
self.addEventListener('message', function(event) {
    if (event.data === 'skipWaiting') {
        self.skipWaiting();
    }
    if (event.data === 'clearCache') {
        caches.keys().then(function(keys) {
            return Promise.all(keys.map(function(k) { return caches.delete(k); }));
        });
    }
});

// ================================================================
// FETCH - NETWORK FIRST FOR DYNAMIC PAGES & SAME-ORIGIN ASSETS
// ================================================================
self.addEventListener('fetch', function(event) {
    if (event.request.method !== 'GET') {
        return;
    }

    const url = new URL(event.request.url);

    // 1. DYNAMIC HTML PAGES (NAVIGATION): ALWAYS NETWORK FIRST!
    // F5 (Normal Refresh) MUST always fetch live data from server.
    const isNavigation = event.request.mode === 'navigate' || 
                         (event.request.headers.get('accept') && event.request.headers.get('accept').includes('text/html'));

    if (isNavigation) {
        event.respondWith(
            fetch(event.request)
                .then(function(networkResponse) {
                    return networkResponse;
                })
                .catch(function() {
                    // Fallback to offline page only when network is unavailable
                    return caches.match(OFFLINE_URL);
                })
        );
        return;
    }

    // 2. SAME-ORIGIN LOCAL ASSETS (CSS, JS, Images, AJAX)
    // Always Network-First so code updates appear immediately without hard reload!
    if (url.origin === location.origin) {
        event.respondWith(
            fetch(event.request)
                .then(function(networkResponse) {
                    if (networkResponse && networkResponse.status === 200) {
                        const responseClone = networkResponse.clone();
                        caches.open(CACHE_NAME).then(function(cache) {
                            cache.put(event.request, responseClone);
                        });
                    }
                    return networkResponse;
                })
                .catch(function() {
                    // Fallback to cache if network fails
                    return caches.match(event.request);
                })
        );
        return;
    }

    // 3. EXTERNAL CDN LIBRARIES (CACHE FIRST FOR SPEED)
    event.respondWith(
        caches.match(event.request).then(function(cachedResponse) {
            if (cachedResponse) {
                return cachedResponse;
            }
            return fetch(event.request).then(function(networkResponse) {
                if (networkResponse && networkResponse.status === 200) {
                    const responseClone = networkResponse.clone();
                    caches.open(CACHE_NAME).then(function(cache) {
                        cache.put(event.request, responseClone);
                    });
                }
                return networkResponse;
            });
        })
    );
});

// ================================================================
// PUSH NOTIFICATION & CLICKS
// ================================================================
self.addEventListener('push', function(event) {
    let data = {};
    try {
        data = event.data.json();
    } catch (e) {
        data = { title: 'Yuk Nabung', body: 'Ada notifikasi baru!' };
    }

    const options = {
        body: data.body || 'Ada notifikasi baru dari Yuk Nabung',
        icon: '/assets/img/icon-192x192.png',
        badge: '/assets/img/icon-72x72.png',
        vibrate: [200, 100, 200],
        data: { url: data.url || '/dashboard' }
    };

    event.waitUntil(self.registration.showNotification(data.title || 'Yuk Nabung', options));
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    const targetUrl = event.notification.data.url || '/dashboard';
    event.waitUntil(clients.openWindow(targetUrl));
});
