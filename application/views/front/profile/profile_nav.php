<style type="text/css">
    @media (max-width: 991px) {
        .hidden_xs { display: none !important; }
    }
    @media (min-width: 992px) {
        .visible_xs { display: none !important; }
    }
</style>
<div class="hidden_xs">
    <nav class="navbar navbar-expand-lg  navbar--style-1 navbar-light bg-default navbar--shadow navbar--uppercase profile-nav">
        <div class="container navbar-container">
            <!-- Brand/Logo -->
            
            <div class="d-inline-block">
                <!-- Navbar toggler  -->
                <button class="navbar-toggler hamburger hamburger-js hamburger--spring" type="button" data-toggle="collapse" data-target="#navbar_main" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbar_main">
                <ul class="navbar-nav " data-hover="dropdown" data-animations="zoomIn zoomIn zoomIn zoomIn">
                    <li class="nav-item">
                        <a href="<?=base_url()?>home/profile" class="nav-link p_nav active">
                            <i class="fa fa-user"></i> <?php echo translate('profile')?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link my_interests p_nav" onclick="profile_load('my_interests')">
                            <i class="fa fa-heart"></i> <?php echo translate('my_interests')?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link short_list p_nav" onclick="profile_load('short_list')">
                            <i class="fa fa-list-ul"></i> <?php echo translate('shortlist')?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link followed_users p_nav" onclick="profile_load('followed_users')">
                            <i class="fa fa-star"></i> <?php echo translate('followed_users')?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link messaging p_nav" onclick="profile_load('messaging')">
                            <i class="fa fa-comments-o"></i> <?php echo translate('messaging')?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ignored_list p_nav" onclick="profile_load('ignored_list')">
                            <i class="fa fa-ban"></i> <?php echo translate('ignored_list')?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<script>
    $(document).ready(function(){
        profile_load('<?= $load_nav; ?>','<?= $sp_nav; ?>');
    });
    function profile_load(page,sp){
        // alert('here');
        if (typeof message_interval !== 'undefined') {
            clearInterval(message_interval);
        }
        if(page !== ''){
            $.ajax({
                url: "<?=base_url()?>home/profile/"+page,
                success: function(response) {
                    $("#profile_load").html(response);
                    if(page == 'messaging'){
                        $('body').find('#thread_'+sp).click();
                    }
                    // window.scrollTo(0, 0);
                    if ($(window).width() < 992 && sp == 'alt-sm') {
                        $("html, body").animate({
                          scrollTop: $('.sidebar.sidebar-inverse').offset().top + $('.sidebar.sidebar-inverse').outerHeight(true) - 100
                        }, 500);
                    }else if (sp != 'no') {
                        $(".btn-back-to-top").click();
                    }
                }
            });
            $('.p_nav').removeClass("active");
            $('.l_nav').removeClass("li_active");
            $('.m_nav').removeClass("m_nav_active");

            if (page!='gallery'||page!='happy_story'||page!='my_packages'||page!='payments' ||page=='change_pass'||page=='picture_privacy') {
                $('.'+page).addClass("active");
                $('.m_'+page).addClass("m_nav_active");
            } 
            if (page=='gallery'||page=='happy_story'||page=='my_packages'||page=='payments' ||page=='change_pass'||page=='picture_privacy') {
                $('.'+page).addClass("li_active");
            }
            
        }
    }
</script>