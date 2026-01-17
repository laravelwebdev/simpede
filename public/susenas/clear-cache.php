<!doctype html>
<html>
<body>

<script>
caches.keys().then(keys =>
  Promise.all(keys.map(k => caches.delete(k)))
).then(() => location.href = 'index.php');
</script>

</body>
</html>
