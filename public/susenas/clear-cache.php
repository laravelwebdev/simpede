<!doctype html>
<html>
<body>

<script>
caches.keys().then(keys =>
  Promise.all(keys.map(k => caches.delete(k)))
).then(() => location.href = 'cache.php');
</script>

</body>
</html>
