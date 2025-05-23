<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#academics">Academics</a></li>
                <li><a href="#registration">Admissions</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h3>Contact Us</h3>
            <p><i class="fas fa-map-marker-alt"></i> IT Park , VT Road , Vaishali Nagar </p>
            <p><i class="fas fa-phone"></i> (123) 456-7890</p>
            <p><i class="fas fa-envelope"></i> info@NITcollege.edu</p>
        </div>
        
        <div class="footer-section">
            <h3>Follow Us</h3>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
    
    <div class="copyright">
        <p>&copy; <span id="current-year"></span> NIT College. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Mobile menu toggle
        $('#mobile-menu-btn').click(function() {
            $('#main-nav').toggleClass('show');
        });
        
        // Set current year in footer
        $('#current-year').text(new Date().getFullYear());
        
        // Load home content
        // $('#content-container').load('home-content.html');
    });
</script>
</body>
</html>