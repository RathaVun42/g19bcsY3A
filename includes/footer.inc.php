<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>
<script>
    const photos = document.querySelectorAll('.photo')
    photos.forEach(photo => {
        photo.addEventListener('change', function (e) {
            const file = this.files[0]
            if (file) {
                const img = this.closest('.imgContainer').querySelector('img')
                if (!file.type.startsWith('image/')) {
                    alert('Please select a valid image file.')
                    this.value = "" // reset input
                    return
                }
                const reader = new FileReader()
                reader.addEventListener('load', function () {
                    img.src = reader.result
                })
                reader.readAsDataURL(file)
            }
        })
    })

</script>

</html>