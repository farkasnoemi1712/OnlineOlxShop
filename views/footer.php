<!--::footer_part start::-->
<footer class="footer_part">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-6 col-lg-2">
                <div class="single_footer_part">
                    <h4>Category</h4>
                    <?php foreach($categories as $categ): ?>
                    <a href="category.php?id=<?=$categ['id']?>">
                    <ul class="list-unstyled">
                        <li><a href="category.php?id=<?=$categ['id']?>"><?=$categ['name']?></a></li>
                    </ul>
                        <?php endforeach;?>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="single_footer_part">
                    <h4>Address</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">200, Green block, NewYork</a></li>
                        <li><a href="#">0726874560</a></li>
                        <li><span>contact89@winter.com</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="single_footer_part">
                    <h4>Newsletter</h4>
                    <div id="mc_embed_signup">
                        <form target="_blank"
                              action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                              method="get" class="subscribe_form relative mail_part">
                            <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address"
                                   class="placeholder hide-on-focus" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = ' Email Address '">
                            <button type="submit" name="submit" id="newsletter-submit"
                                    class="email_icon newsletter-submit button-contactForm">subscribe</button>
                            <div class="mt-10 info"></div>
                        </form>
                    </div>
                    <div class="social_icon">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter-alt"></i></a>
                        <a href="#"><i class="ti-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="copyright_text">
                    <P>
<!--                        Copyright &copy;<script>document.write(new Date().getFullYear());</script>-->
                </div>
            </div>
        </div>
    </div>
</footer>
<!--::footer_part end::-->

<!-- jquery plugins here-->
<script src="assets/js/jquery-1.12.1.min.js"></script>
<!-- popper js -->
<script src="assets/js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- easing js -->
<script src="assets/js/jquery.magnific-popup.js"></script>
<!-- swiper js -->
<script src="assets/js/swiper.min.js"></script>
<!-- swiper js -->
<script src="assets/js/mixitup.min.js"></script>
<!-- particles js -->
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<!-- slick js -->
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/contact.js"></script>
<script src="assets/js/jquery.ajaxchimp.min.js"></script>
<script src="assets/js/jquery.form.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/mail-script.js"></script>
<!-- custom js -->
<script src="assets/js/custom.js"></script>

<script>

</script>