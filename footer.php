<div class="alert_msgs"></div>
<div class="client-trust-bottom py-4">
    <div class="container">
        <div class="row mr-0">
            <div class="col-sm-6 col-md-6 col-lg-3 mb-3 mb-lg-0 pr-0">
                <div class="media border p-3 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 44 44" fill="none"><g clip-path="url(#clip0)"><path d="M10 6L33.5 17.5" stroke="#2449CE" stroke-width="2"></path><path d="M43 12.4545L19.6667 1L1 11.6909M43 12.4545V32.3091L24.3333 43M43 12.4545L24.3333 22.3818M24.3333 43L1 31.5455V11.6909M24.3333 43V22.3818M1 11.6909L24.3333 22.3818" stroke="#2449CE" stroke-width="2"></path></g><defs><clipPath id="clip0"><rect width="44" height="44" fill="white"></rect></clipPath></defs></svg>
                    <div class="media-body pl-3">
                        <h4 class="cc-fw-5 h6">High-Quality Goods</h4>
                        <div class="text-muted">Enjoy top quality items for less</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 mb-3 mb-lg-0 pr-0">
                <div class="media border p-3 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 44 44" fill="none"><path d="M6.85085 2H1V0H8.60955L13.9746 30H36.8179L42.0322 8.54867L44 8.91079L38.4841 32H12.216L6.85085 2Z" fill="#2449CE"></path><path d="M23.0173 4L24.4315 5.41293L20.8284 9.01273L32 9.01273V25H30V11.0109L20.8257 11.0109L24.4315 14.6134L23.0173 16.0263L17.1266 10.141L17.128 10.1397L17 10.0118L23.0173 4Z" fill="#2449CE"></path><circle cx="34" cy="39" r="4" stroke="#2449CE" stroke-width="2"></circle><circle cx="16" cy="39" r="4" stroke="#2449CE" stroke-width="2"></circle></svg>
                    <div class="media-body pl-3">
                        <h4 class="cc-fw-5 h6">Express Shipping</h4>
                        <div class="text-muted">Fast & reliable delivery options</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 mb-3 mb-lg-0 pr-0">
                <div class="media border p-3 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 44 44" fill="none"><path d="M1 38C1 34.134 4.13401 31 8 31H22C25.866 31 29 34.134 29 38V43H1V38Z" stroke="#2449CE" stroke-width="2"></path><circle cx="15" cy="20" r="7" stroke="#2449CE" stroke-width="2"></circle><path d="M26.0526 8.53333V1H43V11.8H30.3158H30.0769L29.8638 11.908L25.2578 14.2417L26.0428 8.67293L26.0526 8.60348V8.53333Z" stroke="#2449CE" stroke-width="2"></path></svg>
                    <div class="media-body pl-3">
                        <h4 class="cc-fw-5 h6">24/7 Livechat</h4>
                        <div class="text-muted">Get instant assistance whenever you need it</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 pr-0">
                <div class="media border p-3 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 44 44" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M42 17V28C42 29.1046 41.1046 30 40 30V32C42.2091 32 44 30.2091 44 28V6C44 3.79086 42.2091 2 40 2H4C1.79086 2 0 3.79086 0 6V28C0 30.2091 1.79086 32 4 32H22V30H4C2.89543 30 2 29.1046 2 28V17H42ZM40 4H4C2.89543 4 2 4.89543 2 6V8H42V6C42 4.89543 41.1046 4 40 4ZM42 10H2V15H42V10Z" fill="#2449CE"></path><path d="M6 23H16V25H6V23Z" fill="#2449CE"></path><rect x="23" y="27" width="16" height="14" rx="1" stroke="#2449CE" stroke-width="2"></rect><path d="M27 26C27 23.7909 28.7909 22 31 22C33.2091 22 35 23.7909 35 26V27H27V26Z" stroke="#2449CE" stroke-width="2"></path><rect x="30" y="33" width="2" height="4" fill="#2449CE"></rect></svg>
                    <div class="media-body pl-3">
                        <h4 class="cc-fw-5 h6">100% Secure Payments</h4>
                        <div class="text-muted">Multiple safe payment methods</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-3 mb-3">
                <h5 class="mb-3 fot-col-head">Contact Information</h5>
                <div class="footer-contact">
                    <h1 class="h6 foot-site-name mb-3 text-capitalize"><?=SITE_TITLE ?></h1>
                    <ul class="list-unstyled">
                        <?php if(ADDRESSDETAIL != ""){?><li><i class="fa fa-map-marker position-absolute" aria-hidden="true"></i> <?=ADDRESSDETAIL; ?></li><?php } ?>
                        <?php if(EMAIL_FOOTER != ""){ ?><li><i class="fa fa-envelope position-absolute" aria-hidden="true"></i> <a href="mailto:<?=EMAIL_FOOTER; ?>" target="_blank"><?=EMAIL_FOOTER; ?></a></li><?php } ?>
                        <?php if(CONTACTUSNO != ""){ $contarr=explode(",",CONTACTUSNO); ?><li class="email-cont-number"><i class="fa fa-phone position-absolute" aria-hidden="true"></i>
                        <? for($i=0;$i<count($contarr);$i++){?><a href="tel:<?=$contarr[$i]; ?>" target="_blank" class="mr-2"><?=$contarr[$i]; ?></a><?} ?></li><?php } ?>
                    </ul>
                </div>                
            </div>
            <div class="col-12 col-sm-12 col-md-3 col-lg-2 col-xl-2 mb-3">
                <h5 class="mb-3 fot-col-head">Information</h5>
                <ul class="footer-menu list-unstyled mb-0">
                    <?php $getstaticpagedetails = selectQuery(STATIC_PAGE,"about_us_data,terms_condition_data,privacy_policy_data,faq_data,cancellation_refund_data,international_shipping_data","id= 1");
                    if($getstaticpagedetails[0]['about_us_data'] == 1){ ?><li><a href="<?=SITEURL;?>/about-us" hreflang="en">About Us</a></li><?php } ?>
                    <li><a href="<?=SITEURL;?>/contact" hreflang="en">Contact</a></li>
                    <?php $getblogc=selectQuery(BLOG,"category","isActive = '1'  order by category asc   limit 1");
                    if(count($getblogc)){
                    $cat_name = selectQuery(BLOGCAT,"url_title","cat_id='".$getblogc[0]['category']."'"); ?>
                    <li><a href="<?=SITEURL; ?>/bloglist/<?php echo $cat_name[0]['url_title']."/"; ?>" hreflang="en">Blog</a></li><? } ?>
                    <li><a href="<?=SITEURL;?>/sitemap" target="_blank" hreflang="en">Sitemap</a></li>
                </ul>
            </div>            
            <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 mb-3">
                <h5 class="mb-3 fot-col-head">Customer Services</h5>
                <ul class="footer-menu list-unstyled mb-0">                    
                    <?php if($getstaticpagedetails[0]['cancellation_refund_data']== 1){ ?> <li><a href="<?=SITEURL;?>/cancellation-return" hreflang="en">Cancellation &amp; Refund</a></li><?php } ?>
                    <?php if($getstaticpagedetails[0]['privacy_policy_data']== 1){ ?> <li><a href="<?=SITEURL;?>/privacy-policy" hreflang="en">Privacy Policy</a></li><?php } ?>
                    <?php if($getstaticpagedetails[0]['terms_condition_data']== 1){ ?> <li><a href="<?=SITEURL;?>/terms-condition" hreflang="en">Terms &amp; Conditions</a></li>  <?php } ?>
                    <?php if($getstaticpagedetails[0]['international_shipping_data']== 1){ ?> <li><a href="<?=SITEURL;?>/international-shipping" hreflang="en">International Shipping</a></li>  <?php } ?>
                    <?php if($getstaticpagedetails[0]['faq_data'] == 1){ ?> <li><a href="<?=SITEURL;?>/faq" hreflang="en">FAQ</a></li><?php } ?>
                    <li><a href="<?=VENDORURL;?>" target="_blank" hreflang="en">Vendor</a></li>
                </ul>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-3 col-xl-4 mb-3">
                <div class="mb-3">
                    <h5 class="mb-3 fot-col-head">Subscribe To Our Newsletter</h5>
                    <p>Sign Up To Our Newsletter To Receive Interesting Information About New Arrivals, Discount Offers and Many More Updates.</p>
                    <div class="submsg"></div>
                    <div class="form-group">
                        <?php $createnumforsub = "usersubscription".rand();
                        $_SESSION['createnumforsub']=$createnumforsub;  ?>
                        <form id="form_subscription">
                            <div class="input-group position-relative mb-3">                                
                                <input type="hidden" id="subscription_session" value="<?php echo $createnumforsub ?>">
                                <input type="email" class="form-control border-right-0 rounded-left" placeholder="Your email address..." id="email_subscription" aria-label="email_subscription" onblur="mailchk('email_subscription')" required>
                                <div class="input-group-append">
                                    <span class="input-group-text p-0 rounded-right"><button type="button" class="btn bg-white border-left-0" onclick="subscribe()" aria-label="subscribe"><i class="fa fa-arrow-right" aria-hidden="true"></i></button></span>
                                </div>
                                <div class="invalid-tooltip">Please provide a valid Email</div>
                            </div>                            
                        </form>
                    </div>
                </div>
                <div class="socialLink">
                    <ul class="list-unstyled mb-0">
                        <?php if(FBLINK != ""){ ?><li><a href="<?=FBLINK; ?>" target="_blank" class="d-inline-block soc-view-link soc-fb-link cc-cursor-pointer" hreflang="en" rel="noreferrer" aria-label="Facebook"><i class="fa fa-facebook"></i></a></li><?php } ?>
                        <?php if(LINKEDIN != ""){?><li><a href="<?=LINKEDIN; ?>" target="_blank" class="d-inline-block soc-view-link soc-link-link cc-cursor-pointer" hreflang="en" rel="noreferrer" aria-label="Linkedin"><i class="fa fa-linkedin"></i></a></li><?php } ?>
                        <?php if(PINTEREST != ""){ ?><li><a href="<?=PINTEREST; ?>" target="_blank" class="d-inline-block soc-view-link soc-pinter-link cc-cursor-pointer" hreflang="en" rel="noreferrer" aria-label="Pinterest"><i class="fa fa-pinterest-p"></i></a></li><?php } ?>
                        <?php if(INSTAGRAMLINK != ""){ ?><li><a href="<?=INSTAGRAMLINK; ?>" target="_blank" class="d-inline-block soc-view-link soc-insta-link cc-cursor-pointer" hreflang="en" rel="noreferrer" aria-label="Instagram"><i class="fa fa-instagram"></i></a></li><?php } ?>
                        <?php if(YOUTUBELINK != ""){ ?><li><a href="<?=YOUTUBELINK; ?>" target="_blank" class="d-inline-block soc-view-link soc-youtube-link cc-cursor-pointer" hreflang="en" rel="noreferrer" aria-label="Youtube"><i class="fa fa-youtube-play"></i></a></li><?php } ?>
                        <?php if(TWITTERLINK != ""){ ?><li><a href="<?=TWITTERLINK; ?>" target="_blank" class="d-inline-block soc-view-link soc-twit-link cc-cursor-pointer" hreflang="en" rel="noreferrer" aria-label="Twitter"><i class="fa fa-twitter"></i></a></li><?php } ?>
                      </ul>
                 </div>                
            </div>
        </div>
        <?php if(PLAYSTORELINK != ""){ ?>
        <div class="row pb-3">
            <div class="col-12 d-flex align-items-center">                
                 <h5 class="mb-3 mb-md-0 mr-3 fot-col-head">App On Mobile</h5><div><a href="<?php if(PLAYSTORELINK != ""){ echo PLAYSTORELINK; } else{ echo SITEURL; } ?>" target="_blank" class="cc-cursor-pointer" hreflang="en" rel="noreferrer" aria-label="Twitter"><img src="<?=SITEURL;?>/img/projectimage/google-play-store.png" alt="google-play-store" width="130"></a></div>
            </div>    
        </div>
        <? } ?>
    </div>
    <div class="bottm-footer pt-3 mt-1">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 mb-2">&copy; <?=date("Y"); ?> <?php echo SITENAME; ?>. All Rights Reserved.</div> 
                <div class="col-sm-6 col-md-6 col-sm-4 col-xs-12 web-intelligence">Made With <span class="fa fa-heart text-danger"></span> in India by <a href="https://www.surun.in/" target="_blank" hreflang="en" itemscope itemtype="http://schema.org/Organization" rel="noreferrer">Surun</a></div>
            </div>
        </div>    
    </div>
</footer>
<div class="modal delete-modal" id="del_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body"><div id="del_message"></div></div>
            <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-primary btn-sm" id="popup_ok">Ok</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="model-popup"></div>
<?php if(SMS_SYSTEM == "ON") { ?>
<div class="enquiry-pop-btn rounded-left text-center btn-primary cc-cursor-pointer"><i class="fa fa-envelope" aria-hidden="true"></i></div>
<div class="sentEnquiry card border-0 cc-shadow-2">
    <div class="card-header cc-primary-back py-2 d-flex justify-content-between"><h6 class="my-1 text-white">Enquiry On SMS</h6><i class="fa fa-close p-2 text-white clos-enq-form position-absolute cc-cursor-pointer" aria-hidden="true"></i></div>
    <div class="card-body px-4 pt-3 pb-4">
        <p class="small">Please fill out the form below and we will get back to you as soon as possible.</p>
        <div id="errmsg"></div>  
        <div class="enq_msgs"></div>
        <form id="enquiry_form_footer">
            <?php function generateRandomString1($length1=10) {
                $original_string = array_merge(range(0,9), range('a','z'), range('A', 'Z'));
                $original_string = implode("", $original_string);
                return substr(str_shuffle($original_string), 0, $length1);
            }
            $enquiry = "enquiry".rand();
            $_SESSION['enquiry']=$enquiry; ?>
            <input type="hidden" name="enquiry_session" id="enquiry_session" value="<?=$_SESSION['enquiry'];?>"/>
            <div class="form-group mb-2">
                <input type="text" id="enqname" class="form-control" maxlength="30" placeholder="Full Name*" required>
                <div class="invalid-tooltip">Please Enter Name</div>
            </div>
            <div class="form-group mb-2">
                <input type="text" id="enq_mobile" class="form-control" onkeyup="mobnumbercheck('mobile')" maxlength="10" placeholder="Mobile No*" required>
                <div class="invalid-tooltip">Please Enter Mobile No</div> 
            </div>
            <div class="form-group mb-2">
                <input type="text" id="enqemail" class="form-control" maxlength="50" placeholder="Email Id*" onblur="mailchk('enqemail')" required> 
                <div class="invalid-tooltip">Please Enter Email</div> 
            </div>
            <div class="form-group mb-2">
                <input type="text" id="enqcity" class="form-control" maxlength="50" placeholder="City*" required> 
                <div class="invalid-tooltip">Please Enter City</div> 
            </div>
            <div class="form-group">
                <textarea id="message" class="form-control" rows="3" maxlength="150" placeholder="Message & Enter Your Vehicle Details*" required></textarea>
                <div class="invalid-tooltip">Please Enter Message</div> 
            </div>
            <button type="button" id="enqsubmit" class="btn btn-primary btn-block btn-lg sendEnquirybtn">Submit</button>
        </form>
    </div>
</div>
<?php  } ?>
<div class="showcmpcnt bg-danger position-fixed text-center py-2 pl-3 pr-1 rounded" <?php if( isset($_SESSION['compare'])){ echo "style='display:block'"; }?>>
    <a href="<?php echo SITEURL; ?>/compare" target="_blank" class="text-white" hreflang="en"><i class="fa fa-filter mr-1"></i> Compare <?php if((isset($_SESSION['compare'])) && is_array($_SESSION['compare'])){ ?> (<?php echo count($_SESSION['compare']); ?>) <?php } ?></a>
    <button type="button" class="btn clearcompbtn py-0 text-white border-0" onclick="clearcmp()"><i class="fa fa-times" aria-hidden="true"></i></button>
</div>
<span class="go-top-btn btn btn-secondary p-0 position-fixed cc-cursor-pointer rounded-circle text-center not-visible d-none d-lg-block"><i class="fa fa-chevron-up" aria-hidden="true"></i></span>
<script src="<?=SITEURL; ?>/js/jquery.min.js"></script>
<script src="<?=SITEURL; ?>/js/popper.min.js"></script>
<script src="<?=SITEURL; ?>/js/bootstrap.min.js"></script>
<script src="<?=SITEURL; ?>/js/validation.js"></script>
<script>
siteurl = '<?php echo SITEURL; ?>';

onesignalappid='<? echo $getconfigdetails[0]['oneSignal_appId']; ?>';
$("#enqsubmit").click(function(){
    var form = $("#enquiry_form_footer")
    if (form[0].checkValidity() === false){
        event.preventDefault()
        event.stopPropagation()
    }
    form.addClass('was-validated');
    var name = $("#enqname").val(); var mobile = $("#enq_mobile").val(); var email = $("#enqemail").val(); var enqcity = $("#enqcity").val(); var message = $("#message").val();
    if(name != ""  && mobile != "" &&  email != "" && message != ""){
    var enquiry_session = $("#enquiry_session").val();
        $.ajax({
           url : "<?=SITEURL ?>/ajax/contact_ajax.php",
           type : "post",
           data : {name:name, mobile:mobile, email:email, enqcity:enqcity, message:message, enquiry_session:enquiry_session, action:"enquiry_on_sms_new"},
           success : function(res){
                $("#enqsubmit").attr('disabled',false)
                $("#enqsubmit img").remove();
                if(res==2){
                    $("#errmsg").fadeIn().html("Message Not Sent").css("color","red");
                } else{ 
                    form.removeClass('was-validated');
                    $("#enquiry_form_footer")[0].reset()
                    $('.enq_msgs').fadeIn().addClass("alert alert-success").html("Thank you for contacting us, our customer happiness manager will contact you soon.").delay(3000).fadeOut();
                    setInterval(function(){ location.href = "<?php echo SITEURL; ?>/smssuccess"; }, 3000);
                }
            }
        });
    }
});
function del_alertbox(msg,i,funct,type){
    $("#del_popup").modal("show"); 
    $("#del_message").html(msg);
    $("#popup_ok").attr("onclick", funct+"('" + i + "','" + type + "')");
}
$(".navbar-toggle").click(function(){ $("body").toggleClass("is-collapsed"); });
$(document).click(function(event){
    if(!$(event.target).closest(".cat-nav, .navbar-toggle").length){ $("body").removeClass("is-collapsed"); }
});
//Hide Search result if click on outside of search result
$(document).click(function(event){
    if(!$(event.target).closest(".search-product").length){ $(".ser-result").hide(); }
});
$(".close-notif").click(function(){ $(".notification-toggle").hide(); });
$(".back-category").click(function(){ $("body").removeClass("is-collapsed"); })
function subscribe(){
    var form = $("#form_subscription")
    if (form[0].checkValidity() === false){
        event.preventDefault()
        event.stopPropagation()
    }
    form.addClass('was-validated');
    var emailsub = $("#email_subscription").val();
    var subscription_session = $("#subscription_session").val();
    if(emailsub == ""){
        //$(".submsg").fadeIn().html("Please Enter Valid Email Address").css('color', 'red').fadeOut(5000);
    }
    else{
        $("#sub").prop('disabled',true);
        var info = {emailsub: emailsub, subscription_session: subscription_session,action:"subscribe_user"};
        $.ajax({
            type: "POST",
            url: "<?=SITEURL; ?>/ajax/common_ajax.php",
            data: info,
            success: function(response) {
                response = $.trim(response);
                $("#sub").prop('disabled',false);
                if(response==2){
                    $(".submsg").fadeIn().html("Thank you  for subscribing to our newsletter").css('color', 'green').fadeOut(5000);
                    $("#email_subscription").val();
                } else  if(response==1){
                    $(".submsg").fadeIn().html("You have already Subscribed").css('color', 'red').fadeOut(5000);
                } else if(response==4){
                    $(".submsg").fadeIn().html("Please Refresh your page and try again").css('color', 'red').fadeOut(5000);
                } else {
                    $(".submsg").fadeIn().html("Please try again").css('color', 'red').fadeOut(5000);
                }
            }
        });
    }
}
function completeprofile(){
    var userprofid = $("#userprofid").val();var userproffname=$("#userproffname").val();var userproflname = $("#userproflname").val();var userprofemail = $("#userprofemail").val();var userprofmob = $("#userprofmob").val();
    if(userproffname.trim()==""||userprofemail.trim()==""||userprofmob.trim()==""){
    $(".profmsg").fadeIn().addClass("alert alert-danger").html("Enter All Required Details").delay(3000).fadeOut();
    }else{
        var info = {userprofid: userprofid, userproffname: userproffname,userproflname:userproflname,userprofemail:userprofemail,userprofmob:userprofmob,action:"updateProfile"};
        $.ajax({ 
            type: "POST", url: "<?=SITEURL; ?>/ajax/user_ajax.php",data: info,
            success: function(response) {
                if(response==1){
                    $(".profmsg").fadeIn().removeClass("alert alert-success").addClass("alert alert-danger").html("Profile Updated").delay(3000).fadeOut();
                    setTimeout(function(){ location.reload(); }, 3000);
                } else{
                    $(".profmsg").fadeIn().removeClass("alert alert-success").addClass("alert alert-danger").html("Error To Update Profile").delay(3000).fadeOut();
                }
            }
        });
    }
}
//open enquiry form on click of enquiery button    
$(".enquiry-pop-btn, .clos-enq-form").click(function(){
    $(".sentEnquiry").slideToggle();
    $(".enquiry-pop-btn").toggleClass("d-none");
/*    if($(this).hasClass("show-enq")){
        $(this).find(".fa").addClass("fa fa-close").removeClass("fa-envelope");
    } else{
        $(this).find(".fa").addClass("fa fa-envelope").removeClass("fa-close");
    }*/
});
//Toogle dropdown menu on click of a link in sidebar
$(".nav-item .caret").on("click", function() {
    var t = $(this);
    if(!t.parent().hasClass("open")){
        t.parent().parent().children("li.open").children(".mega-drop-menu").slideUp(200),
        t.parent().parent().children("li.open").removeClass("open"),
        t.parent().children(".mega-drop-menu").slideDown(200),
        t.parent().addClass("open");
    } else{
        t.parent().children(".mega-drop-menu").slideUp(200);
        t.parent().removeClass("open");
    }
});
$(".menu-cat-head .caret").on("click", function(){
    var t = $(this);
    if(!t.parent().parent().hasClass("open")){
        t.parent().parent().parent().parent().children("li").children(".catblock.open").children("ul").slideUp(200),
        t.parent().parent().parent().children(".catblock.open").removeClass("open"),
        t.parent().parent().children("ul").slideDown(200),
        t.parent().parent().addClass("open");
    } else{
        t.parents(".menu-cat-col").children(".catblock.open").children("ul").slideUp(200);
        t.parents(".mega-drop-menu").find(".catblock.open").removeClass("open");
    }
});
function clearcmp(){
    $.ajax({
        type: "POST",
        data: {action:"clearcompare"},
        url: siteurl+"/ajax/product_ajax.php",
        success: function(html){
            $(".showcmpcnt").css("display","none");
            location.reload();
        }
    });
}
$(".search1").click(function(){
    var srch= $("#search_box").val();
    if(srch==""){ } else{ $("#searchform").submit()
        // window.location="<?=SITEURL ?>/search/"+encodeURI(srch);
    }
});
function getsrchselect(srchstr,url=null){if(url!=null){ window.location=url;}else{$("#search_box").val(srchstr); $("#searchform").submit();}  }
var serlistindex = -1;
$("#search_box").keyup(function(e){
    var keypressed = e.which || e.keyCode;
    var minlength = 3;
    value = $(this).val();
    var searchid = $(this).val().trim();
    var dataString = 'search=' + searchid;
    if (searchid.length != 0){
        if (value.length >= minlength){
            if(keypressed=="13"){ getsrchselect(searchid); }
            else if(keypressed=="40"){
                var $number_list = $('.ser-result'),
                $options = $number_list.find('.ser-list'),
                items_total = $options.length;
                serlistindex = serlistindex+1; 
                if(serlistindex > items_total - 1){ serlistindex = items_total-1; }
                $options.removeClass('selected');
                $options.eq(serlistindex).addClass('selected');
                /*var serselval = $(".ser-list.selected").text();
                $("#search_box").val(serselval);*/
            } else if(e.keyCode == 38){
                var $number_list = $('.ser-result'),
                $options = $number_list.find('.ser-list'),
                items_total = $options.length;
                serlistindex = serlistindex-1;
                if(serlistindex < 0){ serlistindex = 0; }
                $options.removeClass('selected');
                $options.eq(serlistindex).addClass('selected');
            } else{
                $(".ser-result").html("");
                $(".ser-result").html("<div class='py-2 px-3'>Please Wait..We are searching products</div>").show().addClass("hinttext");
                searchRequest = $.ajax({
                    type: "POST",
                    url: "<?=SITEURL; ?>/searchdatalist.php",
                    data: dataString,
                    cache: false,
                    success: function(html){
                        isPreviousEventComplete = true;
                        if($(html).text().trim()!=""){ $(".ser-result").html(html).show().removeClass("hinttext"); } else{
                            $(".ser-result").html("<div class='py-2 px-3'>No related results found for '"+searchid+"'</div>").show().addClass("hinttext");
                        }
                    }
                });
            }
        } else{
            $(".ser-result").html("<div class='py-2 px-3'>Please enter atleast 3 characters for searching</div>").show().addClass("hinttext");
        }
    }
    return false;
});
    
var scrllTopBtn = $('.go-top-btn');
$(window).scroll(function(){
    if ($(window).scrollTop() > 300){ scrllTopBtn.removeClass('not-visible'); } else{ scrllTopBtn.addClass('not-visible'); }
});
scrllTopBtn.on('click', function(e){ e.preventDefault(); $('html, body').animate({scrollTop:0}, '300');});
//add active class to account sidebar
$(document).ready(function() {
    var path = window.location.href;
    var lastChar = path[path.length - 1];
    if(lastChar == "/"){var path = path.slice(0,-1);}
    var target = $(".accnt-sideba-nav ul li a[href='"+path+"']");
    target.addClass('active');
});
</script>
<script>
window.addEventListener('load', function(){
    lazyloader();
});
function lazyloader(){
    var allimages= document.getElementsByClassName('imglazyloader');
    for(var i=0; i<allimages.length; i++){
        if(allimages[i].getAttribute('data-src')){
            allimages[i].setAttribute('src', allimages[i].getAttribute('data-src'));
        }
    }
}
$(window).on("load", function(){ $(".progress").hide(); });
</script>
<?php $Footer_script = selectQuery(FOOTERSCRIPT,"script","add_here='footer' AND isActive= '1' order by priority"); 
for($i=0;$i<count($Footer_script);$i++){
   echo $Footer_script[$i]['script'];
} ?>
<? if($loguser){
if($getbuyer_details[0]['u_fname'] == ""||$getbuyer_details[0]['u_mobile'] == "" || $getbuyer_details[0]['u_email'] == ""){ ?>
<div class="modal-backdrop fade in"></div>
<div class="modal fade in" id="facepopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h5>Dear User,</h5><p>We did not found your required details. Please complete your profile for better communication.</p>
                <div class="cmpmsgs"></div>
                <form action="#" method="post" id="userprof" class="form-horizontal">
                    <input type="hidden" value="<?=$loguser; ?>" id="userprofid"/>
                    <div class="form-group">
                        <label class=" control-label cc-mandatary-field">First Name</label>
                        <div><input type="text" name="userproffname" id="userproffname" class="form-control" maxlength="30" tabindex="1" value="<?=$getbuyer_details[0]['u_fname']; ?>" required onblur="namechk('userproffname')"/></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label ">Last Name</label>
                        <div><input type="text" name="userproflname" id="userproflname" class="form-control" maxlength="30" tabindex="2" value="<?=$getbuyer_details[0]['u_lname']; ?>" required onblur="namechk('userproflname')"/></div>
                    </div>
                    <div class="form-group">
                        <label class=" control-label cc-mandatary-field">Email</label>
                        <div><input type="text" name="userprofemail" id="userprofemail" class="form-control"  maxlength="80" tabindex="3" required value="<?=$getbuyer_details[0]['u_email']; ?>" <?=($getbuyer_details[0]['u_email']!=""?"disabled":""); ?> onblur="mailchk('userprofemail')"/></div>
                    </div>
                    <div class="form-group">
                        <label class=" control-label cc-mandatary-field">Phone Number</label>
                        <div><input type="text" name="userprofmob" id="userprofmob" class="form-control" maxlength="10" tabindex="4" value="<?=$getbuyer_details[0]['u_mobile']; ?>" required onblur="mobnumbercheck('userprofmob')"/></div>
                    </div>
                    <div class="profmsg"></div>
                    <div><button type="button" class="btn btn-primary comptpro" onclick="completeprofile()">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>$("#facepopup").modal("show");</script>
<style>#facepopup{display: block;}</style>
<? }  }
if($getconfigdetails[0]['oneSignal_appId']!=""){?>
 <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<?}  ?>