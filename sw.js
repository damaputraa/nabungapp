// ================================================================
// SERVICE WORKER - Yuk Nabung PWA
// ================================================================

const CACHE_NAME = 'yuknabung-v1.0.0';
const OFFLINE_URL = '/offline.php';
const BASE_URL = '/';

// ================================================================
// DAFTAR FILE YANG DI-CACHE
// ================================================================
const urlsToCache = [
    BASE_URL,
    BASE_URL + 'index.php',
    BASE_URL + 'assets/css/custom.css',
    BASE_URL + 'assets/css/user-mode.css',
    BASE_URL + 'assets/js/dashboard.js',
    BASE_URL + 'assets/js/transactions.js',
    BASE_URL + 'manifest.json',
    BASE_URL + 'offline.php',
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
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function(cache) {
                console.log('📦 Cache opened');
                return cache.addAll(urlsToCache);
            })
            .then(function() {
                console.log('✅ Service Worker installed');
                return self.skipWaiting();
            })
            .catch(function(error) {
                console.error('❌ Cache failed:', error);
            })
    );
});

// ================================================================
// ACTIVATE SERVICE WORKER
// ================================================================
self.addEventListener('activate', function(event) {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then(function(cacheNames) {
            return Promise.all(
                cacheNames.map(function(cacheName) {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        console.log('🗑️ Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(function() {
            console.log('✅ Service Worker activated');
            return self.clients.claim();
        })
    );
});

// ================================================================
// FETCH - INTERCEPT REQUEST
// ================================================================
self.addEventListener('fetch', function(event) {
    // Skip non-GET requests
    if (event.request.method !== 'GET') {
        return;
    }

    const url = new URL(event.request.url);

    // Skip requests to other domains (except CDN)
    if (url.origin !== location.origin && 
        !url.hostname.includes('cdn') && 
        !url.hostname.includes('fonts') && 
        !url.hostname.includes('code.jquery.com')) {
        return;
    }

    // Skip API requests
    if (url.pathname.includes('/api/') || 
        url.pathname.includes('/admin/') && url.pathname.includes('/ajax')) {
        return fetch(event.request);
    }

    event.respondWith(
        caches.match(event.request)
            .then(function(response) {
                // Cache hit - return response
                if (response) {
                    return response;
                }

                // Clone request
                const fetchRequest = event.request.clone();

                return fetch(fetchRequest)
                    .then(function(response) {
                        // Check if we received a valid response
                        if (!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }

                        // Clone response
                        const responseToCache = response.clone();

                        caches.open(CACHE_NAME)
                            .then(function(cache) {
                                cache.put(event.request, responseToCache);
                            })
                            .catch(function(err) {
                                console.error('Cache put error:', err);
                            });

                        return response;
                    })
                    .catch(function() {
                        // If offline and request is for a page, show offline page
                        if (event.request.headers.get('accept') && 
                            event.request.headers.get('accept').includes('text/html')) {
                            return caches.match(OFFLINE_URL);
                        }
                    });
            })
    );
});

// ================================================================
// PUSH NOTIFICATION
// ================================================================
self.addEventListener('push', function(event) {
    let data = {};
    try {
        data = event.data.json();
    } catch (e) {
        data = {
            title: 'Yuk Nabung',
            body: 'Ada notifikasi baru!'
        };
    }

    const options = {
        body: data.body || 'Ada notifikasi baru dari Yuk Nabung',
        icon: '/assets/img/icon-192x192.png',
        badge: '/assets/img/icon-72x72.png',
        vibrate: [200, 100, 200],
        data: {
            url: data.url || '/dashboard'
        },
        actions: [
            {
                action: 'open',
                title: 'Lihat',
                icon: '/assets/img/icon-72x72.png'
            },
            {
                action: 'close',
                title: 'Tutup',
                icon: '/assets/img/icon-72x72.png'
            }
        ]
    };

    event.waitUntil(
        self.registration.showNotification(data.title || 'Yuk Nabung', options)
    );
});

// ================================================================
// NOTIFICATION CLICK
// ================================================================
self.addEventListener('notificationclick', function(event) {
    event.notification.close();

    if (event.action === 'close') {
        return;
    }

    const url = event.notification.data.url || '/dashboard';
    event.waitUntil(
        clients.openWindow(url)
    );
});
