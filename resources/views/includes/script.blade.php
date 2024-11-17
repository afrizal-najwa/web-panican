<script src="/vendor/jquery/jquery.slim.min.js"></script>
<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous"
></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="/script/navbar-scroll.js"></script>
    <script>
        // Menambahkan kelas `scrolled` saat di-scroll
        window.addEventListener("scroll", function() {
            var navbar = document.querySelector(".navbar");
            if (window.scrollY > 0.001) { // Sesuaikan angka 50 ini sesuai kebutuhan
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
        window.addEventListener("scroll", function() {
            const title = document.getElementById("title");
            if (window.scrollY > 0.001) {
                title.style.color = "white"; // Change color to white after scrolling 10px
            } else {
                title.style.color = "black"; // Revert to black when scroll is less than 10px
            }
        });
    </script>