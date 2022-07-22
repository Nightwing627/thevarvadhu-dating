
<style>
	
	/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
	.footer-divaider{
		display: none;
	}
	.footer .addwrap {
    	margin-left: 23px !important;
	}
	.newDeisplay{
		max-height: 200px;
    	margin-bottom: 20px;
	}
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
	
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
		.modal-breadcrumbs h1 {
			padding: 10px 0px;
			color: #fff;
			display: block;
		}
	
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {...}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {...}
	
	
	#homebanner img{
		width: 100%;
		height: 418px;
	}
	.modal-breadcrumbs {
		position: relative;
   		margin-top: -111px;
		top: 50%;
		width: 88%;
		left: 0px;
		right: 0px;
		transform: translateY(-50%);
		color: #fff;
		font-size: 15px;
	}
	.modal-breadcrumbs h1 {
		color: #cf1311;
		display: inline-block;
		position: relative;
		z-index: 5;
		padding: 8px 17px 15px 87px;
		    font-size: unset;
	}
	.modal-breadcrumbs h1:before {
		content: '';
		position: absolute;
		width: 100%;
		background: url(<?php echo base_url()?>template/newAboutUs/images/bradcrm-before.png);
		background-repeat: no-repeat;
		background-position: 0px;
		height: 100%;
		left: 0;
		top: 0;
		z-index: -1;
	}
	.modal-breadcrumbs h1:after {
		content: '';
		position: absolute;
		width: 68px;
		background: url(<?php echo base_url()?>template/newAboutUs/images/bradcrm1-after.png);
		background-repeat: no-repeat;
		background-position: right;
		height: 100%;
		left: 100%;
		top: 0;
		z-index: 2;
	}
	.section-title {
		padding: 80px 0 60px;
	}

	.tx-center {
		text-align: center;
	}
	.section-title .my-color {
		text-transform: capitalize;
		color: #cf1311;
		font-size: 30px;
		position: relative;
	}
	.section-title .my-color:before {
		content: '';
		position: absolute;
		top: -60px;
		left: 0;
		right: 0;
		margin: 0 auto;
		text-align: center;
		background: url(<?php echo base_url()?>template/newAboutUs/images/title-before.png)no-repeat;
		width: 201px;
		height: 45px;
	}
	.section-title .my-color:after {
		content: '';
		background: url(<?php echo base_url()?>template/newAboutUs/images/title-after.png)no-repeat;
		position: absolute;
		top: auto;
		left: 0;
		right: 0;
		margin: 0 auto;
		bottom: -40px;
		width: 118px;
		height: 16px;
	}
	.section-title{
		width: 100%;
	}
	.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
		overflow: hidden;
}
	.sec-title-div-2 {
    width: 182px;
    height: 11px;
    background: url(<?php echo base_url()?>template/newAboutUs/images/footer-divaider-hor.png) center no-repeat;
    margin: 15px auto 10px;
}
	.section-title-1 h5 {
		text-transform: uppercase;
		color: #a86f29;
		font-size: 36px;
		font-weight: 600;
	}
	.sec-title-div-1 {
		width: 182px;
		height: 11px;
		background: url(<?php echo base_url()?>template/newAboutUs/images/footer-divaider-hor1.png) center no-repeat;
		margin: 15px auto 10px;
	}
	.slick-slider .slick-prev {
    background: url(<?php echo base_url()?>template/newAboutUs/images/arrow-prev.png) center no-repeat;
    border: medium none;
    left: 0;
    margin-top: -39px;
    outline: medium none;
    padding: 25px;
    position: absolute;
    top: 50%;
    z-index: 9;
}
	.footer {
    background: url(<?php echo base_url()?>template/newAboutUs/images/footer.jpg) no-repeat center/cover;
    padding: 40px 0px 0px;
}
	.footer .container:before {
    position: absolute;
    left: 0px;
    height: 100%;
    top: 20px;
    width: 70px;
    content: '';
    display: block;
    background: url(<?php echo base_url()?>template/newAboutUs/images/footer-left-work.png) top no-repeat;
}
	.footer .container:after {
    position: absolute;
    right: 0px;
    height: 100%;
    top: 20px;
    width: 70px;
    content: '';
    display: block;
    background: url(<?php echo base_url()?>template/newAboutUs/images/footer-right-work.png) top no-repeat;
}
	@media (min-width: 992px){
		.col-md-5 {
			width: 41.66666666666667%; 
		}
	}
	@media (min-width: 992px){
	.col-md-7 {
		width: 58.333333333333336%;
	}
	}
	@media (min-width: 992px){
		.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
			float: left;
		}
	}
	.footer .container {
    position: relative;
    overflow: hidden;
}
	.footer .addwrap {
    margin-left: 90px;
    color: #fff;
}
	.footer .addwrap ul {
    padding: 0px;
}
	ul, ol {
    margin-top: 0;
    margin-bottom: 10px;
}
	ul, li {
    text-decoration: none;
    list-style: none;
}
	.footer .addwrap ul li a:hover, .footer .addwrap ul li a:hover span {
    color: #EAB325;
}
	.footer .addwrap li h3 {
    margin-top: 0px;
    color: #fff;
    font-size: 28px;
    padding: 0 0 25px;
}
	.footer .addwrap ul li a {
    color: #fff;
    font-size: 15px;
    vertical-align: top;
}
	.footer .addwrap ul li {
    text-align: left;
    position: relative;
    padding-left: 32px;
    vertical-align: top;
    margin-bottom: 25px;
    vertical-align: top;
}
	.footer .addwrap {
    margin-left: 90px;
    color: #fff;
}
	.footer .title {
    color: #fff;
    font-size: 36px;
}
	.margin-bottom-50 {
    margin-bottom: 50px;
}
	h1, h2, h3, h4, h5, h6 {
    font-family: 'Maven Pro', sans-serif;
}
	@media (min-width: 992px){
		.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
			float: left;
		}
	}
	.footer .addwrap ul li a .fa {
    position: absolute;
    left: 0;
    top: 5px;
    color: #b99898;
    font-size: 20px;
    vertical-align: top;
}
	.page{
		padding: 40px;
	}
</style>

<div class="noprint">
        

<div id="homebanner">
    <div class="main-slider">
        <div>
            <img src="<?php echo base_url()?>/template/payment/banner.jpg" alt="testimonial">
        </div>
    </div>
</div>

        <div class="page">

            <div class="pageData">
                
    <div class="modal-breadcrumbs">
        <div class="row">
            <div class="container">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h1>Payment</h1>
                </div>
            </div>
            <div class="container">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="breadcrumbs"><a href="index.aspx">Home</a> » <strong class="breadcrumb_last">Payment</strong> </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <p>
                <img src="<?php echo base_url()?>/template/payment/banklogo.jpg" alt="testimonial" style="max-width:100%">
                </p>
                <p class="mt-4">
                    Bank name : STATE BANK OF INDIA
                </p>
                <p>
                Account Holder Name : THE VAR VADHU
                </p>
                    <p class="">
                    Account No. : 39192174003
                </p>
                    <p class="">
                    Branch : RAJDHANI KRISHI UPAZ MANDI JAIPUR
                </p>
                <p class="">
                IFSC CODE: SBIN0031978
                </p>
                
            </div>
        </div>
    </div>
				


            </div>
        </div>
	
		
        <div class="item footer" id="homefooter">
    <div class="row">
        <div class="container">
            <div class="section-title-1 tx-center margin-bottom-50">
                <h5 class="title">Contact Us</h5>
                <div class="sec-title-div-2"></div>
            </div>
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="addwrap">
                    <ul>
                        <li>
                            <h3>Office Address</h3>
                              <a title="Our Locator" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i>726, North Aveneue, Road No 9, Sikar Road, Jaipur, Rajasthan, 302013</a>
                        </li>
                        <li><a href="mailto:thevarvadhu@gmail.com" title="Mail Us"><i class="fa fa-envelope" aria-hidden="true"></i>support@thevarvadhu.com</a></li>
                        <li><a href="tel:+7891101107" title="Call Us"><i class="fa fa-mobile" aria-hidden="true"></i>+91 78911 01107 </a>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12 tx-center footer-divaider">
			<img src="<?php echo base_url()?>/template/newAboutUs/images/footer-divaider.png" alt="testimonial">

            </div>
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="addwrap mar-left">
                    <ul>
                        <li>
                            <h3>Jaipur branch</h3>
                            <a title="Our Locator" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i>726, North Aveneue, Road No 9, Sikar Road, Jaipur, Rajasthan, 302013</a>
                        </li>
                        <li><a href="mailto:thevarvadhu@gmail.com" title="Mail Us"><i class="fa fa-envelope" aria-hidden="true"></i>support@thevarvadhu.com</a></li>
                        <li><a href="tel:+917372990995" title="Call Us"><i class="fa fa-mobile" aria-hidden="true"></i>+91 73729 90995</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
	
