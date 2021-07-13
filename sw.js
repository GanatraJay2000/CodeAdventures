var cacheName = 'jayGanatra';

var staticAssets = [
'img/Somaiya Logo.png'
];
self.addEventListener("install", function(e) {
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      return cache.addAll(staticAssets);
    })
  );
});
  self.addEventListener('fetch', function(event) {
    event.respondWith(
      fetch(event.request).catch(function() {
        return caches.match(event.request);
      })
    );
  });

self.addEventListener("fetch", function(e) {
  e.respondWith(
    caches.match(e.request).then(function(response) {
      return response || fetch(e.request);
    })
  );
});
