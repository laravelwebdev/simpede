importScripts('/susenas/cache-manifest.php');

const CACHE_NAME = 'susenas-' + self.CACHE_VERSION;

// INSTALL
self.addEventListener('install', e => {
  e.waitUntil(
    caches.open(CACHE_NAME).then(c => c.addAll(self.FILES_TO_CACHE))
  );
  self.skipWaiting();
});

// ACTIVATE (hapus cache lama)
self.addEventListener('activate', e => {
  e.waitUntil(
    caches.keys().then(keys =>
      Promise.all(keys.map(k => k !== CACHE_NAME && caches.delete(k)))
    )
  );
  self.clients.claim();
});

// FETCH
self.addEventListener('fetch', e => {
  e.respondWith(
    caches.match(e.request).then(r => r || fetch(e.request))
  );
});

// MESSAGE (progress + manual)
self.addEventListener('message', e => {

  if (e.data.action === 'CACHE_FILES') {
    let done = 0;
    caches.open(CACHE_NAME).then(cache => {
      self.FILES_TO_CACHE.forEach(f => {
        cache.add(f).then(() => {
          done++;
          self.clients.matchAll().then(cs =>
            cs.forEach(c => c.postMessage({
              type: 'PROGRESS',
              done,
              total: self.FILES_TO_CACHE.length
            }))
          );
        });
      });
    });
  }

  if (e.data.action === 'CLEAR') {
    caches.keys().then(keys => keys.forEach(k => caches.delete(k)));
  }

});
