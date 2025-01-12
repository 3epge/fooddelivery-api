<?php


class EmailTemplate
{


    public static function resetPassword($toEmail, $full_name,$code){

        $str = ' 
        <div class="">
   <div class="aHl"></div>
   <div id=":2rn" tabindex="-1"></div>
   <div id=":2rg" class="ii gt">
      <div id=":2sy" class="a3s aXjCH ">
         <div class="adM">
         </div>
         <div style="margin:0;padding:0;width:100%" width="100%">
            <div class="adM"></div>
            <table cellpadding="0" border="0" style="border-collapse:collapse;background:#eee;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:13px;height:100%;text-align:left;width:100%" height="100%" align="left" width="100%">
               <tbody>
                  <tr>
                     <td  align="center" valign="top" style="border-collapse:collapse;background:#fff;padding:0">
                        <table cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse">
                           <tbody>
                              <tr>
                                 <td  align="left" style="border-collapse:collapse;background:#fff;border-radius:3px;height:100%;padding:32px;width:525px" height="100%" width="525">
                                    <table  style="border-collapse:collapse;border:0;width:100%" width="100%">
                                       <tbody>
                                          <tr>
                                             <td  style="border-collapse:collapse">
                                                <span style="color:white;font-size:1px;display:block"></span>
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse">
                                                   <tbody>
                                                      <tr>
                                                         <td  align="center"><a style="color:#2b6dad;text-decoration:none"><img  src="https://orderonline.hk/wp-content/uploads/2019/07/300-e1594719058955.jpg" style="outline:0;text-decoration:none;border:0;height:74px;width:148px" height="74" width="148"></a></td>
                                                      </tr>
                                                      <tr>
                                                         <td style="border-collapse:collapse;text-align:center;color:#333;font-family:Georgia,Times,&quot;Times New Roman&quot;,&quot;Hiragino Kaku Gothic Pro&quot;,&quot;Meiryo&quot;,serif;font-size:19px;font-weight:400;padding-bottom:10px;padding-top:2px" align="center"><span class="il">Reset</span> your <span class="il">password</span></td>
                                                      </tr>
                                                      <tr>
                                                         <td style="border-collapse:collapse">
                                                            <table  style="border-collapse:collapse;border:0;margin-bottom:20px;width:100%" width="100%">
                                                               <tbody>
                                                                  <tr>
                                                                     <td style="border-collapse:collapse"></td>
                                                                     <td  style="border-collapse:collapse;border-bottom:1px solid #b92b27;height:1px;width:198px" height="1" width="198"></td>
                                                                     <td style="border-collapse:collapse"></td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                          <tr >
                                             <td  bgcolor="#ffffff" style="border-collapse:collapse">
                                                <table style="border-collapse:collapse;width:100%" cellpadding="0" cellspacing="0" border="0" width="100%">
                                                   <tbody>
                                                      <tr>
                                                         <td style="border-collapse:collapse">
                                                            <table style="border-collapse:collapse;width:100%" cellpadding="0" cellspacing="0" border="0" width="100%">
                                                               <tbody>
                                                                  <tr>
                                                                     <td style="border-collapse:collapse">Hi '.$full_name.',<br><br>You requested to <span class="il">reset</span> the <span class="il">password</span> for your <span class="il">orderonline</span> account with the e-mail address (  <a href="'.$toEmail.'" target="_blank">'.$toEmail.'</a>). Please enter this verification code to reset  your password</span>.<br><br>Confirmation code:<b>'.$code.'</b><br><br>Thanks,<br>The Orderonline</span> Team<br></td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                         <td class="m_4922713540386201575w30" style="border-collapse:collapse"> </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="border-collapse:collapse"></td>
                                          </tr>
                                          <tr>
                                             <td style="border-collapse:collapse"></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td  align="center" style="border-collapse:collapse;max-width:525px;margin-top:16px">
                                    <table cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;color:#999;font-size:11px;padding-top:16px;text-align:center;width:100%" align="center" width="100%">
                                       <tbody>
                                          <tr>
                                             <td style="border-collapse:collapse"></td>
                                          </tr>
                                          <tr>
                                             <td width="65" style="border-collapse:collapse"> </td>
                                             <td width="485"  style="border-collapse:collapse">
                                                <div id="m_4922713540386201575footer_div">If you did not request a <span class="il">password</span> <span class="il">reset</span>, please feel free to ignore this message.</div>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
           
            <div class="yj6qo"></div>
            <div class="adL"></div>
         </div>
         <div class="adL">
         </div>
      </div>
   </div>
   <div id=":2rs" class="ii gt" style="display:none">
      <div id=":2rr" class="a3s aXjCH undefined"></div>
   </div>
   <div class="hi"></div>
</div>';


        return $str;


    }






    public static function registerEmailToUser($email,$link)

    {


        $str = ' 
<div class="m_-4875878460382169275m_-3751569409617898750mBody" style="margin-top:0;margin-bottom:0;margin-left:0;margin-right:0;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;font-family:Arial,Helvetica,sans-serif" bgcolor="#f7f7f7"><img src="https://ci6.googleusercontent.com/proxy/aXNXkaRE2CeomFo2Wzxwu0ajF2KtlEYLvwEXvQouEYBZXAEctODRUKPj6oZ8JYxSrRg8fVQ_cX06CqztJIlbnfxJ9bB9kG1UJJOVhHaRbn4VsvbqRtGcvjrJXEmchCvgVW9GGVmn6vUVJWk2GuystL3JFYI=s0-d-e1-ft#http://newsletter.orderonline.hk/c/r?ACTION=hi&amp;EMID=0A005492B6300RBG13L&amp;UID=YI7CIKHXZBZMWR5O3GAA" height="1" border="0" width="1" class="CToWUd">


  
  <table class="m_-4875878460382169275m_-3751569409617898750wrHtml" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#212228;text-align:left" cellspacing="0" cellpadding="0" bgcolor="#f7f7f7" width="100%">
  	<tbody><tr class="m_-4875878460382169275m_-3751569409617898750wrHead">
  		<td class="m_-4875878460382169275m_-3751569409617898750wrSide">&nbsp;&nbsp;</td>
  		<td class="m_-4875878460382169275m_-3751569409617898750wrMid" style="width:600px;max-width:600px;padding-bottom:33px" align="center">


  
  <table class="m_-4875878460382169275m_-3751569409617898750mHead" style="font-family:Arial,Helvetica,sans-serif" cellspacing="0" cellpadding="0" width="100%">
  	<tbody><tr>
  		<td class="m_-4875878460382169275m_-3751569409617898750eHead m_-4875878460382169275m_-3751569409617898750rp15_a" style="padding-top:20px" valign="top" align="left">
  			<table style="font-family:Arial,Helvetica,sans-serif" cellspacing="0" cellpadding="0" width="100%">
  				<tbody><tr>
  					<td class="m_-4875878460382169275m_-3751569409617898750eWebview m_-4875878460382169275m_-3751569409617898750rac_a" style="text-align:left" valign="middle"><span class="m_-4875878460382169275m_-3751569409617898750ePreh" style="display:none!important;display:none;width:0!important;height:0!important;max-height:0!important;padding:0!important;font-size:0!important;line-height:0!important;overflow:hidden!important">

 HongKong\'s best restaurants now deliver
  						</span>
  						</td>
  					<td class="m_-4875878460382169275m_-3751569409617898750eAppsPad m_-4875878460382169275m_-3751569409617898750rdn_a" style="font-size:2px;line-height:2px" width="16">&nbsp;</td>
  					<td class="m_-4875878460382169275m_-3751569409617898750eApps m_-4875878460382169275m_-3751569409617898750rdn_a" valign="top" align="right" width="17%"><a href="https://apps.apple.com/us/app/id1525859483" title="App Store" style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#000000;text-decoration:none" target="_blank" data-saferedirecturl="https://apps.apple.com/us/app/id1525859483">App Store</a></td>
  					<td class="m_-4875878460382169275m_-3751569409617898750eAppsDiv m_-4875878460382169275m_-3751569409617898750rdn_a" style="font-size:2px;line-height:2px" width="4">&nbsp;</td>
  					<td class="m_-4875878460382169275m_-3751569409617898750eApps m_-4875878460382169275m_-3751569409617898750rdn_a" valign="top" align="right" width="17%"><a href="https://play.google.com/store/apps/details?id=order.online.hk.simontechway" title="Google Play" style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#000000;text-decoration:none" target="_blank" data-saferedirecturl="https://play.google.com/store/apps/details?id=order.online.hk.simontechway">Google Play</a></td>
  				</tr>
  			</tbody></table>
  		</td>
  	</tr>
  </tbody></table>
  













<table class="m_-4875878460382169275m_-3751569409617898750mSep" style="width:100%" cellspacing="0" cellpadding="0">
<tbody><tr>
  <td style="font-size:2px;line-height:2px" height="20">&nbsp;</td>
</tr>
</tbody></table>






<table class="m_-4875878460382169275m_-3751569409617898750mHeadBnr m_-4875878460382169275m_-3751569409617898750mBnr" style="font-family:Arial,Helvetica,sans-serif;font-size:28px;color:#be2c2c;font-style:italic" cellspacing="0" cellpadding="0" width="100%">
<tbody><tr>
	<td align="left"><a href="" title="orderonline" style="color:#be2c2c;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q= s&amp;source=gmail&amp;ust=1521524231789000&amp;usg=AFQjCNEXXda-Terzm_MO_5qqCOecjnLI1g"><img src="https://orderonline.hk/wp-content/uploads/2019/07/300-e1594719058955.jpg" alt="OrderOnline" style="display:block;width:100%!important;max-width:600px;font-weight:bold" border="0" width="600" class="CToWUd"></a></td>
</tr>
</tbody></table>






<table class="m_-4875878460382169275m_-3751569409617898750mVoucherCode" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#ffffff;margin-top:18px" cellspacing="0" cellpadding="0" bgcolor="#be2c2c" width="100%">
</table>












<table class="m_-4875878460382169275m_-3751569409617898750mIntro" cellspacing="0" cellpadding="0" width="100%">
<tbody><tr>
  <td class="m_-4875878460382169275m_-3751569409617898750eIntro m_-4875878460382169275m_-3751569409617898750rp30_a" style="padding-top:33px" align="left">


    
    <table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:14px" cellspacing="0" cellpadding="0" width="100%">
      <tbody><tr>
        <td align="left">
          Confirm your email
        </td>
      </tr>
    </tbody></table>
    

    
    <table class="m_-4875878460382169275m_-3751569409617898750eIntroText m_-4875878460382169275m_-3751569409617898750ePar m_-4875878460382169275m_-3751569409617898750rfs12_a" style="font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:14px;line-height:18px;line-height:1.25em!important" cellspacing="0" cellpadding="0" width="100%">
      <tbody><tr>
        <td class="m_-4875878460382169275m_-3751569409617898750eParCont" style="padding:16px 0" align="left">
          

					Click below to confirm your email

			
			</td></tr>
			</tbody></table>
			
			<table class="m_3557035817770985617m_-4875878460382169275m_-3751569409617898750eBtnBox" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td class="m_3557035817770985617m_-4875878460382169275m_-3751569409617898750eBtn1 m_3557035817770985617m_-4875878460382169275m_-3751569409617898750eBtn" style="line-height:2.8em;font-family:Arial,Helvetica,sans-serif;font-size:13px;font-weight:bold;color:#ffffff;" bgcolor="#be2c2c" align="center"><a href="'.$link.'" style="display:block;color:#ffffff;text-decoration:none;white-space:nowrap;text-transform:uppercase;" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;Confirm your email&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
      </tr>
    </tbody></table>
    
    <table><tbody>
      
      <tr>
        <td class="m_-4875878460382169275m_-3751569409617898750eParCont" style="padding:16px 0" align="left">
          

					Or Click this link

			
			</td></tr>
			
			
			 <tr>
        <td class="m_-4875878460382169275m_-3751569409617898750eParCont" style="padding:16px 0" align="left">
          

				 <span style="font-weight:bold;color:#be2c2c;font-size:10px">'.$link.'</span>.

			
			</td></tr>
			
		<br><br>







       
      
    </tbody></table>
    


    
    <table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="font-family:Arial,Helvetica,sans-serif;color:#be2c2c;font-size:14px" cellspacing="0" cellpadding="0" width="100%">
      <tbody><tr>
        <td align="left">
          Your OrderOnline team

        </td>
      </tr>
    </tbody></table>
    


  </td>
</tr>
</tbody></table>




















<br><br>
  

	

	


	  
	  


	  
	 
	  



	      





























<table class="m_-4875878460382169275m_-3751569409617898750mFooter" style="border:1px solid #666666" cellspacing="0" cellpadding="0" width="100%">
	<tbody><tr>
		<td style="padding-top:14px;padding-bottom:10px" align="left">

			<table class="m_-4875878460382169275m_-3751569409617898750eFooterBox" cellspacing="0" cellpadding="0" width="100%">
				<tbody><tr>

					<td class="m_-4875878460382169275m_-3751569409617898750eFooterPad1 m_-4875878460382169275m_-3751569409617898750rdn_a" width="2%">&nbsp;</td>
					<td class="m_-4875878460382169275m_-3751569409617898750eSocial m_-4875878460382169275m_-3751569409617898750rdb_a m_-4875878460382169275m_-3751569409617898750rwf_a" valign="middle" align="center" width="30%">

						<table cellspacing="0" cellpadding="0">
							<tbody><tr>
								<td align="center">

<span style="display:inline-block;padding-bottom:4px;white-space:nowrap"><a href="#" title="Facebook" style="color:#555555;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://www.facebook.com/foodieshellofood&amp;source=gmail&amp;ust=1521524231790000&amp;usg=AFQjCNFImiuHz64mwXbeA70ACWT65cCNEw"><img src="https://ci4.googleusercontent.com/proxy/sge-fEkQtRFgACuwNsv43vYC1Q1_PpXFiKeHs5fVs-0UNKxSVjSIP9CvzF24b8sv7lpskGDpFeZ_Cov-UsyFe5KgGZvhn93L6EoSznPVkLyrZe4KLn6NQ_eIIBVBtds6a8ESnnBN=s0-d-e1-ft#http://image.info.foodora.com/lib/fe95137274600c7f77/m/2/icon_facebook_30x30.png" alt="Facebook" style="display:inline" border="0" width="15" class="CToWUd"></a><img src="https://ci5.googleusercontent.com/proxy/OJlM34ntx3Pre6ekP-jDAOokIs-rpxT3Lrowefa044pHjPYLzvGgah9oMuw_V5U4Hxsi6bsAnAYTZjdiGdL4S1W9Q8zCk6vPlJsHf1yB9iXMo8yFCJ-wSa7UXCU=s0-d-e1-ft#http://image.S7.exacttarget.com/lib/fe94137274600c7f76/m/1/tp_11x1.gif" alt="" style="display:inline" height="1" border="0" width="4" class="CToWUd">
<a href="#" title="Twitter" style="color:#555555;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://twitter.com/foodiespk&amp;source=gmail&amp;ust=1521524231791000&amp;usg=AFQjCNFbXcF26D5BA3rNxhNWsCw89UOEUw"><img src="https://ci6.googleusercontent.com/proxy/2c8TmRfgB8eImUJstmCkU3ta2A8cL-L4bgs0A7kQFgp0GQ-afayUQrE90i-0JdED9cT-aPiKHOpOv_WTPTOcfvo7QEYweIgDBwBbWvKlNL1cVGnXQbJoB2l6fbj0rmI5JOftd-w=s0-d-e1-ft#http://image.info.foodora.com/lib/fe95137274600c7f77/m/2/icon_twitter_30x30.png" alt="Twitter" style="display:inline" border="0" width="15" class="CToWUd"></a><img src="https://ci5.googleusercontent.com/proxy/OJlM34ntx3Pre6ekP-jDAOokIs-rpxT3Lrowefa044pHjPYLzvGgah9oMuw_V5U4Hxsi6bsAnAYTZjdiGdL4S1W9Q8zCk6vPlJsHf1yB9iXMo8yFCJ-wSa7UXCU=s0-d-e1-ft#http://image.S7.exacttarget.com/lib/fe94137274600c7f76/m/1/tp_11x1.gif" alt="" style="display:inline" height="1" border="0" width="4" class="CToWUd">
<a href="#" title="Instagram" style="color:#555555;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://www.instagram.com/foodies_pakistan/&amp;source=gmail&amp;ust=1521524231791000&amp;usg=AFQjCNEUT3I5-HTQFIHadJD5ZbO1oQvrNQ"><img src="https://ci4.googleusercontent.com/proxy/iC_h7OmgVjDXwB9vjwhpkVbB6N1wcvel8dr_zFNwdrlRLqyBapOLCC1ePw73TW_1FlQbnWMyB4VEkJ4Ws9X5DyuFPq8VgEtRwA7zwjtsK-ErQXn1svK3WioLMzlMCtUy0eAmNeUqJQ=s0-d-e1-ft#http://image.info.foodora.com/lib/fe95137274600c7f77/m/2/icon_instagram_30x30.png" alt="Instagram" style="display:inline" border="0" width="15" class="CToWUd"></a><img src="https://ci5.googleusercontent.com/proxy/OJlM34ntx3Pre6ekP-jDAOokIs-rpxT3Lrowefa044pHjPYLzvGgah9oMuw_V5U4Hxsi6bsAnAYTZjdiGdL4S1W9Q8zCk6vPlJsHf1yB9iXMo8yFCJ-wSa7UXCU=s0-d-e1-ft#http://image.S7.exacttarget.com/lib/fe94137274600c7f76/m/1/tp_11x1.gif" alt="" style="display:inline" height="1" border="0" width="4" class="CToWUd"></span>

								</td>
							</tr>
						</tbody></table>

					</td>
					<td class="m_-4875878460382169275m_-3751569409617898750eFooterPad2 m_-4875878460382169275m_-3751569409617898750rdb_a m_-4875878460382169275m_-3751569409617898750rwf_a" height="25" width="2%">&nbsp;</td>
					<td class="m_-4875878460382169275m_-3751569409617898750eFooterPad3 m_-4875878460382169275m_-3751569409617898750rdn_a" style="border-left:1px solid #666666" width="5%">&nbsp;</td>
					<td class="m_-4875878460382169275m_-3751569409617898750eLegal m_-4875878460382169275m_-3751569409617898750rdb_a m_-4875878460382169275m_-3751569409617898750rwf_a m_-4875878460382169275m_-3751569409617898750rac_a" style="text-align:left" valign="middle">

						<table class="m_-4875878460382169275m_-3751569409617898750rwf_a" style="font-family:Arial,Helvetica,sans-serif;font-size:10px;color:#555555;line-height:14px;line-height:1.4em!important" cellspacing="0" cellpadding="0">
							<tbody><tr>
                <td class="m_-4875878460382169275m_-3751569409617898750rp15_a m_-4875878460382169275m_-3751569409617898750rac_a m_-4875878460382169275m_-3751569409617898750uoaP" style="text-align:left">
<span class="m_-4875878460382169275m_-3751569409617898750rdb_a">OrderOnline</span><span class="m_-4875878460382169275m_-3751569409617898750rdn_a">&nbsp;&nbsp;| &nbsp;&nbsp;<a href="https://orderonline.hk/privacy-policy/" style="color:#555555;text-decoration:none;white-space:nowrap" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://www.foodies.com/contents/privacy.htm&amp;source=gmail&amp;ust=1521524231791000&amp;usg=AFQjCNFddBYe9TyWvM74Yfvbl5sqrwYa2Q">Privacy</a> &nbsp;&nbsp;|&nbsp;&nbsp;</span><span class="m_-4875878460382169275m_-3751569409617898750rdb_a"><a href="https://orderonline.hk/privacy-policy/" style="color:#555555;text-decoration:none;white-space:nowrap" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://www.foodies.com/contents/terms-and-conditions.htm&amp;source=gmail&amp;ust=1521524231791000&amp;usg=AFQjCNH2Lv6QIHFlhLrdk2cWhHngngy49w">Terms and Conditions</a></span> &nbsp;<br>
<a href="#m_-4875878460382169275_m_-3751569409617898750_" style="color:#555555;text-decoration:none;text-decoration:none!important">
Mau Lam Commercial Building, Jordan, Hong Kong</a><br>
<span style="color:#be2c2c">© 2020 OrderOnline</span>&nbsp;&nbsp;&nbsp;&nbsp;<a style="color:#555555;text-decoration:none"></a>
								</td>
							</tr>
						</tbody></table>

					</td>
					<td class="m_-4875878460382169275m_-3751569409617898750eFooterPad4 m_-4875878460382169275m_-3751569409617898750rdn_a" width="5%">&nbsp;</td>

				</tr>
			</tbody></table>

		</td>
	</tr>
</tbody></table>






		</td>
		<td class="m_-4875878460382169275m_-3751569409617898750wrSide">&nbsp;&nbsp;</td>
	</tr>
</tbody></table>



<u></u><div class="yj6qo"></div><div class="adL">

</div></div>';


        return $str;



    }
    
    public static function placeOrderEmailToRest($data)
  {
	  $currency =  $data['OrderDetail']['Restaurant']['Currency']['symbol'];
        $str = ' 
<div class="m_-4875878460382169275m_-3751569409617898750mBody" style="margin-top:0;margin-bottom:0;margin-left:0;margin-right:0;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;font-family:Arial,Helvetica,sans-serif" bgcolor="#f7f7f7"><img src="https://ci6.googleusercontent.com/proxy/aXNXkaRE2CeomFo2Wzxwu0ajF2KtlEYLvwEXvQouEYBZXAEctODRUKPj6oZ8JYxSrRg8fVQ_cX06CqztJIlbnfxJ9bB9kG1UJJOVhHaRbn4VsvbqRtGcvjrJXEmchCvgVW9GGVmn6vUVJWk2GuystL3JFYI=s0-d-e1-ft#http://newsletter.foodies.com/c/r?ACTION=hi&amp;EMID=0A005492B6300RBG13L&amp;UID=YI7CIKHXZBZMWR5O3GAA" height="1" border="0" width="1" class="CToWUd">
  <table class="m_-4875878460382169275m_-3751569409617898750wrHtml" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#212228;text-align:left" cellspacing="0" cellpadding="0" bgcolor="#f7f7f7" width="100%">
  	<tbody><tr class="m_-4875878460382169275m_-3751569409617898750wrHead">
  		<td class="m_-4875878460382169275m_-3751569409617898750wrSide">&nbsp;&nbsp;</td>
  		<td class="m_-4875878460382169275m_-3751569409617898750wrMid" style="width:600px;max-width:600px;padding-bottom:33px" align="center">

  <table class="m_-4875878460382169275m_-3751569409617898750mHead" style="font-family:Arial,Helvetica,sans-serif" cellspacing="0" cellpadding="0" width="100%">
  	<tbody><tr>
  		<td class="m_-4875878460382169275m_-3751569409617898750eHead m_-4875878460382169275m_-3751569409617898750rp15_a" style="padding-top:20px" valign="top" align="left">
  			
  		</td>
  	</tr>
  </tbody></table>
  
<table class="m_-4875878460382169275m_-3751569409617898750mSep" style="width:100%" cellspacing="0" cellpadding="0">
<tbody><tr>
  <td style="font-size:2px;line-height:2px" height="20">&nbsp;</td>
</tr>
</tbody></table>












<table class="m_-4875878460382169275m_-3751569409617898750mVoucherCode" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#ffffff;margin-top:18px" cellspacing="0" cellpadding="0" bgcolor="#be2c2c" width="100%">
<tbody><tr>
<td style="font-weight:bold;padding:5px 10px 9px;color:#ffffff" align="center">New order has been placed</td>
</tr>
</tbody></table>












<table class="m_-4875878460382169275m_-3751569409617898750mIntro" cellspacing="0" cellpadding="0" width="100%">
<tbody><tr>
  <td class="m_-4875878460382169275m_-3751569409617898750eIntro m_-4875878460382169275m_-3751569409617898750rp30_a" style="padding-top:33px" align="left">


    
    <table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:14px" cellspacing="0" cellpadding="0" width="100%">
      <tbody><tr>
        <td align="left">Hi, '.
           $data['OrderDetail']['Restaurant']['name'].' | '.$data['OrderDetail']['Restaurant']['about'].',
        </td>
      </tr>
    </tbody></table>
    

    
    <table class="m_-4875878460382169275m_-3751569409617898750eIntroText m_-4875878460382169275m_-3751569409617898750ePar m_-4875878460382169275m_-3751569409617898750rfs12_a" style="font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:14px;line-height:18px;line-height:1.25em!important" cellspacing="0" cellpadding="0" width="100%">
      <tbody><tr>
        <td class="m_-4875878460382169275m_-3751569409617898750eParCont" style="padding:16px 0" align="left">
          

					Great a order just placed from <span style="font-weight:bold;color:#be2c2c">'.$data['OrderDetail']['UserInfo']['first_name'].'</span>.

			<br><br>
			Check below for order details.
			<br><br>






  Until next time,
        </td>
      </tr>
    </tbody></table>
    


    
    <table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="font-family:Arial,Helvetica,sans-serif;color:#be2c2c;font-size:14px" cellspacing="0" cellpadding="0" width="100%">
      <tbody><tr>
        <td align="left">
          Your '.APP_NAME.' team

        </td>
      </tr>
    </tbody></table>
    


  </td>
</tr>
</tbody></table>

















<table class="m_-4875878460382169275m_-3751569409617898750mSep m_-4875878460382169275m_-3751569409617898750mSectionSpace" style="width:100%" cellspacing="0" cellpadding="0">
<tbody><tr>
  <td style="font-size:2px;line-height:2px" height="30">&nbsp;</td>
</tr>
</tbody></table>


  
  <hr size="1" color="#be2c2c" width="100%">
  

	
	<table class="m_-4875878460382169275m_-3751569409617898750mSep m_-4875878460382169275m_-3751569409617898750mSectionSpace" style="width:100%" cellspacing="0" cellpadding="0">
	<tbody><tr>
	  <td style="font-size:2px;line-height:2px" height="30">&nbsp;</td>
	</tr>
	</tbody></table>
	


	  
	  <table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:14px;line-height:18px" cellspacing="0" cellpadding="0" width="100%">
	    <tbody><tr>
	      <td align="left">
	        <b>';
               if($data['OrderDetail']['Order']['delivery'] == 1) {

                   $str .= 'Delivery address';

                } else if($data['OrderDetail']['Order']['delivery'] == 0) {

                   $str .= 'Self Pick-Up';
                }
            $str .= '</b>

	      </td>
	      </tr>
	  </tbody></table>


	  <br>'.$data['OrderDetail']['UserInfo']['first_name'].' '.$data['OrderDetail']['UserInfo']['last_name'].'<br>
	  <br>'.$data['OrderDetail']['UserInfo']['phone'].'<br>
	  '; if($data['OrderDetail']['Order']['delivery'] == 1) {

                   $str .= '<br>'.$data['OrderDetail']['Address']['street'].' '.$data['OrderDetail']['Address']['apartment'].' '.$data['OrderDetail']['Address']['state'].' '.$data['OrderDetail']['Address']['city'].' '.$data['OrderDetail']['Address']['country'].' '.$data['OrderDetail']['Address']['zip'].'<br>';

                   }
        $str .= '
    
	  <br>'.$data['OrderDetail']['Order']['instructions'].'<br>

	  
	  <table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="font-family:Arial,Helvetica,sans-serif;padding-left:16px;padding-right:16px;text-align:left;margin-bottom:18px;color:#be2c2c;font-weight:bold;font-size:14px;line-height:18px" cellspacing="0" cellpadding="0" width="100%">
	    <tbody><tr>
	      <td align="left">
	        Order number: '.$data['OrderDetail']['Order']['id'].'
	      </td>
	    </tr>
	  </tbody></table>
	  

	  <table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="background-color:#eeeeee;font-family:Arial,Helvetica,sans-serif;padding-left:30px;padding-right:30px;text-align:left;font-weight:bold;font-size:14px;line-height:18px" cellspacing="0" cellpadding="0px" width="100%">

	  <tbody><tr><td style="font-family:\'Avenir Book\',Helvetica,sans-serif;font-size:14px;line-height:16px;color:#555555;text-align:left" valign="top" align="center">
	    
</td></tr><tr><td colspan="3" style="font-size:14px;padding:14px;padding-right:5px">
  <table style="line-height:20px;text-transform:uppercase" cellspacing="0" cellpadding="0" border="0" bgcolor="" width="100%">
    <tbody>';

        foreach($data['OrderDetail']['OrderMenuItem'] as $menu_item){

            $str .= '<tr>
      <td width="30"><b>'.$menu_item['quantity']. 'X</b></td>
      <td><b>'.$menu_item['name']. '</b></td>
      <td align="right" width="60"><b>'.$currency.' '.$menu_item['price']. '</b></td>
    </tr>';
             $str .= '<tr>
                      <td width="30"></td>
                      <td><b>'.$menu_item['instructions']. '</b></td>
                      <td align="right" width="60"></td>
                    </tr>';
            if(count($menu_item['OrderMenuExtraItem']) > 0){
                foreach( $menu_item['OrderMenuExtraItem'] as $extra_item ) {
                    $str .= '<tr>
                      <td width="30"><b></b></td>
                      <td><b>'.$extra_item['name']. '</b></td>
                      <td align="right" width="60"><b>+'.$currency.' '.$extra_item['price']. '</b></td>
                    </tr>';
                }
            }
        }




        $str .= '</tbody></table></td></tr>
	    

	    
	    <tr>
	      <td style="background-color:#eeeeee">

	    <hr size="1" width="95%">
	    </td>
	    </tr>



	    
        <tr>
            <td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:24px;color:#555555" valign="top" align="left">
                <b>
                  <span style="color:#555555">Subtotal</span>
                </b>
            </td>
            <td style="padding:5px" align="right">
                <b>
                   '.$currency.' '.$data['OrderDetail']['Order']['sub_total']. '
                </b>
            </td>
        </tr>
        <tr>
	        <td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:24px;color:#555555" valign="top" align="left">
	          <b>
	            <span style="color:#555555">Delivery fee</span>
	          </b>
	        </td>
	        <td style="padding:5px" align="right">
	          <b>
	            '.$currency.' '.$data['OrderDetail']['Order']['delivery_fee']. '
	          </b>
	        </td>
	   </tr>
	   <tr>
	        <td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:24px;color:#555555" valign="top" align="left">
	          <b>
	            <span style="color:#555555">Discount</span>
	          </b>
	        </td>
	        <td style="padding:5px" align="right">
	          <b>
	            -'.$currency.' '.$data['OrderDetail']['Order']['discount']. '
	          </b>
	        </td>
	   </tr>
                  	              <tr>
                  	                <td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:24px;color:#292929" valign="top" align="left">
                  	                  <b>
                  	                    <span style="color:#555555">Payment Method</span>
                  	                  </b>
                  	                </td>
                  	                <td style="padding:5px" align="right">
                  	                  <b>';

                                       if($data['OrderDetail']['Order']['cod'] == 0) {

                                           $str .= 'PayPal / Credit Card';

                                           } elseif($data['OrderDetail']['Order']['cod'] == 1) {

                                           $str .= 'PayMe / FPS';

                                       }
        $str .= '</b>
                  	                  </td>
                  	                </tr>




	                
	                <tr>
	                  <td style="background-color:#eeeeee">

	                <hr size="1" width="95%">
	                </td>
	                </tr>



	                


	                <tr>
	                  <td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:32px;color:#555555" valign="top" align="left">
	                    <b>
	                      <span style="color:#333333">Total</span>
	                    </b>
	                  </td>
	                  <td style="padding:5px" align="right">
	                    <b>
	                      '.$currency.' '. $data['OrderDetail']['Order']['price']. '
	                        </b>
	                      </td>
	                    </tr>
	                    
	               <tr>
	                  <td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:32px;color:#555555" valign="top" align="left">
	                    <b>
	                      <span style="color:#333333">Donations</span>
	                    </b>
	                  </td>
	                  <td style="padding:5px" align="right">
	                    <b>
	                      '.$currency.' '. $data['OrderDetail']['Order']['donation']. '
	                        </b>
	                      </td>
	                    </tr>




                 
	  </tbody></table>


	      




































		</td>
		<td class="m_-4875878460382169275m_-3751569409617898750wrSide">&nbsp;&nbsp;</td>
	</tr>
</tbody></table>



<u></u><div class="yj6qo"></div><div class="adL">

</div></div>';
        
        
        return $str;
        
       
       
  }
    
    
    public static function placeOrderEmailToUser($data)
    {
       $currency =  $data['OrderDetail']['Restaurant']['Currency']['symbol'];
        $str = ' 
<div class="m_-4875878460382169275m_-3751569409617898750mBody" style="margin-top:0;margin-bottom:0;margin-left:0;margin-right:0;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;font-family:Arial,Helvetica,sans-serif" bgcolor="#f7f7f7"><img src="https://ci6.googleusercontent.com/proxy/aXNXkaRE2CeomFo2Wzxwu0ajF2KtlEYLvwEXvQouEYBZXAEctODRUKPj6oZ8JYxSrRg8fVQ_cX06CqztJIlbnfxJ9bB9kG1UJJOVhHaRbn4VsvbqRtGcvjrJXEmchCvgVW9GGVmn6vUVJWk2GuystL3JFYI=s0-d-e1-ft#http://newsletter.foodies.com/c/r?ACTION=hi&amp;EMID=0A005492B6300RBG13L&amp;UID=YI7CIKHXZBZMWR5O3GAA" height="1" border="0" width="1" class="CToWUd">


  
  <table class="m_-4875878460382169275m_-3751569409617898750wrHtml" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#212228;text-align:left" cellspacing="0" cellpadding="0" bgcolor="#f7f7f7" width="100%">
  	<tbody><tr class="m_-4875878460382169275m_-3751569409617898750wrHead">
  		<td class="m_-4875878460382169275m_-3751569409617898750wrSide">&nbsp;&nbsp;</td>
  		<td class="m_-4875878460382169275m_-3751569409617898750wrMid" style="width:600px;max-width:600px;padding-bottom:33px" align="center">


  
  <table class="m_-4875878460382169275m_-3751569409617898750mHead" style="font-family:Arial,Helvetica,sans-serif" cellspacing="0" cellpadding="0" width="100%">
  	<tbody><tr>
  		<td class="m_-4875878460382169275m_-3751569409617898750eHead m_-4875878460382169275m_-3751569409617898750rp15_a" style="padding-top:20px" valign="top" align="left">
  			
  		</td>
  	</tr>
  </tbody></table>
  













<table class="m_-4875878460382169275m_-3751569409617898750mSep" style="width:100%" cellspacing="0" cellpadding="0">
<tbody><tr>
  <td style="font-size:2px;line-height:2px" height="20">&nbsp;</td>
</tr>
</tbody></table>












<table class="m_-4875878460382169275m_-3751569409617898750mVoucherCode" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#ffffff;margin-top:18px" cellspacing="0" cellpadding="0" bgcolor="#be2c2c" width="100%">
<tbody><tr>
<td style="font-weight:bold;padding:5px 10px 9px;color:#ffffff" align="center">Your order has been placed</td>
</tr>
</tbody></table>












<table class="m_-4875878460382169275m_-3751569409617898750mIntro" cellspacing="0" cellpadding="0" width="100%">
<tbody><tr>
  <td class="m_-4875878460382169275m_-3751569409617898750eIntro m_-4875878460382169275m_-3751569409617898750rp30_a" style="padding-top:33px" align="left">


    
    <table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:14px" cellspacing="0" cellpadding="0" width="100%">
      <tbody><tr>
        <td align="left">'.
            $data['OrderDetail']['UserInfo']['first_name'].',
        </td>
      </tr>
    </tbody></table>
    

    
    <table class="m_-4875878460382169275m_-3751569409617898750eIntroText m_-4875878460382169275m_-3751569409617898750ePar m_-4875878460382169275m_-3751569409617898750rfs12_a" style="font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:14px;line-height:18px;line-height:1.25em!important" cellspacing="0" cellpadding="0" width="100%">
      <tbody><tr>
        <td class="m_-4875878460382169275m_-3751569409617898750eParCont" style="padding:16px 0" align="left">
          

					Great choice. You ordered delicious food from <span style="font-weight:bold;color:#be2c2c">'.$data['OrderDetail']['Restaurant']['name'].'</span>.

			<br><br>
			Check below for your order details.
			<br><br>






  Until next time,
        </td>
      </tr>
    </tbody></table>
    


    
    <table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="font-family:Arial,Helvetica,sans-serif;color:#be2c2c;font-size:14px" cellspacing="0" cellpadding="0" width="100%">
      <tbody><tr>
        <td align="left">
          Your '.APP_NAME.' team

        </td>
      </tr>
    </tbody></table>
    


  </td>
</tr>
</tbody></table>

















<table class="m_-4875878460382169275m_-3751569409617898750mSep m_-4875878460382169275m_-3751569409617898750mSectionSpace" style="width:100%" cellspacing="0" cellpadding="0">
<tbody><tr>
  <td style="font-size:2px;line-height:2px" height="30">&nbsp;</td>
</tr>
</tbody></table>


  
  <hr size="1" color="#be2c2c" width="100%">
  

	
	<table class="m_-4875878460382169275m_-3751569409617898750mSep m_-4875878460382169275m_-3751569409617898750mSectionSpace" style="width:100%" cellspacing="0" cellpadding="0">
	<tbody><tr>
	  <td style="font-size:2px;line-height:2px" height="30">&nbsp;</td>
	</tr>
	</tbody></table>
	


	  
	  <table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="font-family:Arial,Helvetica,sans-serif;color:#333333;font-size:14px;line-height:18px" cellspacing="0" cellpadding="0" width="100%">
	    <tbody><tr>
	      <td align="left">
	        <b>';
               if($data['OrderDetail']['Order']['delivery'] == 1) {

                   $str .= 'Delivery address';

                   } elseif($data['OrderDetail']['Order']['delivery'] == 0) {

                   $str .= 'Self Pick-Up';
               }
            $str .= '</b>

	      </td>
	      </tr>
	  </tbody></table>


	  <br>'.$data['OrderDetail']['UserInfo']['first_name'].' '.$data['OrderDetail']['UserInfo']['last_name'].'<br>
	  <br>'.$data['OrderDetail']['UserInfo']['phone'].'<br>
	  '; if($data['OrderDetail']['Order']['delivery'] == 1) {

                   $str .= '<br>'.$data['OrderDetail']['Address']['street'].' '.$data['OrderDetail']['Address']['apartment'].' '.$data['OrderDetail']['Address']['state'].' '.$data['OrderDetail']['Address']['city'].' '.$data['OrderDetail']['Address']['country'].' '.$data['OrderDetail']['Address']['zip'].'<br>';

                   }
        $str .= '
    
	  <br><br>

	  
	  <table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="font-family:Arial,Helvetica,sans-serif;padding-left:16px;padding-right:16px;text-align:left;margin-bottom:18px;color:#be2c2c;font-weight:bold;font-size:14px;line-height:18px" cellspacing="0" cellpadding="0" width="100%">
	    <tbody><tr>
	      <td align="left">
	        Order details (Order number: '.$data['OrderDetail']['Order']['id'].')
	      </td>
	    </tr>
	  </tbody></table>
	  

	  <table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="background-color:#eeeeee;font-family:Arial,Helvetica,sans-serif;padding-left:30px;padding-right:30px;text-align:left;font-weight:bold;font-size:14px;line-height:18px" cellspacing="0" cellpadding="0px" width="100%">

	  <tbody><tr><td style="font-family:\'Avenir Book\',Helvetica,sans-serif;font-size:14px;line-height:16px;color:#555555;text-align:left" valign="top" align="center">
	    
</td></tr><tr><td colspan="3" style="font-size:14px;padding:14px;padding-right:5px">
  <table style="line-height:20px;text-transform:uppercase" cellspacing="0" cellpadding="0" border="0" bgcolor="" width="100%">
    <tbody>';

        foreach($data['OrderDetail']['OrderMenuItem'] as $menu_item){

            $str .= '<tr>
      <td width="30"><b>'.$menu_item['quantity']. 'X</b></td>
      <td><b>'.$menu_item['name']. '</b></td>
      <td align="right" width="60"><b> '.$currency.' '.$menu_item['price']. '</b></td>
    </tr>';
    
        if(count($menu_item['OrderMenuExtraItem']) > 0){
                foreach( $menu_item['OrderMenuExtraItem'] as $extra_item ) {
                    $str .= '<tr>
                      <td width="30"><b></b></td>
                      <td><b>'.$extra_item['name']. '</b></td>
                      <td align="right" width="60"><b>+'.$currency.' '.$extra_item['price']. '</b></td>
                    </tr>';
                }
            }
        }




        $str .= '</tbody></table></td></tr>
	    

	    
	    <tr>
	      <td style="background-color:#eeeeee">

	    <hr size="1" width="95%">
	    </td>
	    </tr>



	    

        <tr>
            <td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:24px;color:#555555" valign="top" align="left">
                <b>
                    <span style="color:#555555">Subtotal</span>
                </b>
            </td>
            <td style="padding:5px" align="right">
                <b>
                    '.$currency.' '.$data['OrderDetail']['Order']['sub_total']. '
                </b>
            </td>
        </tr>
        <tr>
	        <td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:24px;color:#555555" valign="top" align="left">
	            <b>
	                <span style="color:#555555">
	                    Delivery Fee
                    </span>
	            </b>
	        </td>
	        <td style="padding:5px" align="right">
	            <b>
	                '.$currency.' '.$data['OrderDetail']['Order']['delivery_fee']. '
	            </b>
	        </td>
	    </tr>
	    <tr>
	        <td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:24px;color:#555555" valign="top" align="left">
	          <b>
	            <span style="color:#555555">
	                Discount
                </span>
	          </b>
	        </td>
	        <td style="padding:5px" align="right">
	          <b>
	            -'.$currency.' '.$data['OrderDetail']['Order']['discount']. '
	          </b>
	        </td>
	    </tr>

                  	              <tr>
                  	                <td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:24px;color:#292929" valign="top" align="left">
                  	                  <b>
                  	                    <span style="color:#555555">Payment Method</span>
                  	                  </b>
                  	                </td>
                  	                <td style="padding:5px" align="right">
                  	                  <b>';

                                       /*if($data['OrderDetail']['Order']['payment_method_id'] > 0) {

                                           $str .= 'Credit Card';

                                           }else{

                                           $str .= 'Cash On Delivery';

                                       }*/
                                       if($data['OrderDetail']['Order']['cod'] == 0) {

                                           $str .= 'PayPal / Credit Card';

                                           } elseif($data['OrderDetail']['Order']['cod'] == 1) {

                                           $str .= 'PayMe / FPS';

                                       }
        $str .= '</b>
                  	                  </td>
                  	                </tr>




	                
	                <tr>
	                  <td style="background-color:#eeeeee">

	                <hr size="1" width="95%">
	                </td>
	                </tr>



	                


	                <tr>
	                  <td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:32px;color:#555555" valign="top" align="left">
	                    <b>
	                      <span style="color:#333333">Total</span>
	                    </b>
	                  </td>
	                  <td style="padding:5px" align="right">
	                    <b>
	                      '.$currency.' '. $data['OrderDetail']['Order']['price']. '
	                        </b>
	                      </td>
	                    </tr>
	                    
	               <tr>
	                  <td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:32px;color:#555555" valign="top" align="left">
	                    <b>
	                      <span style="color:#333333">Donations</span>
	                    </b>
	                  </td>
	                  <td style="padding:5px" align="right">
	                    <b>
	                      '.$currency.' '. $data['OrderDetail']['Order']['donation']. '
	                        </b>
	                      </td>
	                    </tr>




                 
	  </tbody></table>


	      




































		</td>
		<td class="m_-4875878460382169275m_-3751569409617898750wrSide">&nbsp;&nbsp;</td>
	</tr>
</tbody></table>



<u></u><div class="yj6qo"></div><div class="adL">

</div></div>';
        
        
        return $str;
        
        
    }

  public static function placeOrderEmailToAdmin($data)
  {
	  $currency =  $data['OrderDetail']['Restaurant']['Currency']['symbol'];
        $str = ' 
<div class="m_-4875878460382169275m_-3751569409617898750mBody" style="margin-top:0;margin-bottom:0;margin-left:0;margin-right:0;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;font-family:Arial,Helvetica,sans-serif" bgcolor="#f7f7f7">
	<table class="m_-4875878460382169275m_-3751569409617898750mVoucherCode" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#ffffff;margin-top:18px" cellspacing="0" cellpadding="0" bgcolor="#be2c2c" width="100%">
		<tbody>
			<tr>
				<td style="font-weight:bold;padding:5px 10px 9px;color:#ffffff" align="center">New '. $data['OrderDetail']['Restaurant']['name'] .' Order! ('. $data['OrderDetail']['Order']['device'] .')</td>
			</tr>
		</tbody>
	</table>
	<table class="m_-4875878460382169275m_-3751569409617898750mIntro" cellspacing="0" cellpadding="0" width="100%">
		<tbody>
			<tr>
				<td class="m_-4875878460382169275m_-3751569409617898750eIntro m_-4875878460382169275m_-3751569409617898750rp30_a" style="padding-top:33px" align="left">
					<br/>'.
            $data['OrderDetail']['UserInfo']['first_name'].' '.$data['OrderDetail']['UserInfo']['last_name'].'
								
					<br/>
					<br/>';

                       if($data['OrderDetail']['Order']['delivery'] == 0) {

                           $str .= 'Self Pick-Up';

                           } elseif($data['OrderDetail']['Order']['delivery'] == 1) {

                           $str .= $data['OrderDetail']['Address']['street'] + ' ' + $data['OrderDetail']['Address']['city'];

                       }
        $str .= '
					<br/>
					<br/>
					'.$data['OrderDetail']['Address']['instructions'].'
					<br/>
					<br/>
					<table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="font-family:Arial,Helvetica,sans-serif;padding-left:16px;padding-right:16px;text-align:left;margin-bottom:18px;color:#be2c2c;font-weight:bold;font-size:14px;line-height:18px" cellspacing="0" cellpadding="0" width="100%">
						<tbody>
							<tr>
								<td align="left">
	        Order number: '.$data['OrderDetail']['Order']['id'].'
	      </td>
							</tr>
						</tbody>
					</table>
					<table class="m_-4875878460382169275m_-3751569409617898750eHl m_-4875878460382169275m_-3751569409617898750eHl1 m_-4875878460382169275m_-3751569409617898750rfs18_a" style="background-color:#eeeeee;font-family:Arial,Helvetica,sans-serif;padding-left:30px;padding-right:30px;text-align:left;font-weight:bold;font-size:14px;line-height:18px" cellspacing="0" cellpadding="0px" width="100%">
						<tbody>
							<tr>
								<td style="font-family:\'Avenir Book\',Helvetica,sans-serif;font-size:14px;line-height:16px;color:#555555;text-align:left" valign="top" align="center"></td>
							</tr>
							<tr>
								<td colspan="3" style="font-size:14px;padding:14px;padding-right:5px">
									<table style="line-height:20px;text-transform:uppercase" cellspacing="0" cellpadding="0" border="0" bgcolor="" width="100%">
										<tbody>';

        foreach($data['OrderDetail']['OrderMenuItem'] as $menu_item){

            $str .= '
																				
											<tr>
												<td width="30">
													<b>'.$menu_item['quantity']. 'X</b>
												</td>
												<td>
													<b>'.$menu_item['name']. '</b>
												</td>
												<td align="right" width="60">
													<b>'.$menu_item['price']. '</b>
												</td>
											</tr>';
            if(count($menu_item['OrderMenuExtraItem']) > 0){
                foreach( $menu_item['OrderMenuExtraItem'] as $extra_item ) {
                    $str .= '
																				
											<tr>
												<td width="30">
													<b></b>
												</td>
												<td>
													<b>'.$extra_item['name']. '</b>
												</td>
												<td align="right" width="60">
													<b>+'.$extra_item['price']. '</b>
												</td>
											</tr>';
                }
            }
            if($menu_item['instructions'] != null){
                $str .= '
                    <tr>
						<td align="left">
							'.$menu_item['instructions'].'
						</td>
					</tr>
                ';
            }
        }


        $str .= '
																			
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td style="background-color:#eeeeee">
									<hr size="1" width="95%">
									</td>
							</tr>
							    <tr>
									<td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:24px;color:#555555" valign="top" align="left">
										<b>
											<span style="color:#555555">Subtotal</span>
										</b>
									</td>
									<td style="padding:5px" align="right">
										<b>
                                            '.$data['OrderDetail']['Order']['sub_total'].'
                                        </b>
									</td>
								</tr>
								<tr>
									<td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:24px;color:#555555" valign="top" align="left">
										<b>
											<span style="color:#555555">Delivery fee</span>
										</b>
									</td>
									<td style="padding:5px" align="right">
										<b>
	            '.$data['OrderDetail']['Order']['delivery_fee']. '
	              </b>
									</td>
								</tr>
								<tr>
									<td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:24px;color:#555555" valign="top" align="left">
										<b>
											<span style="color:#555555">Discount</span>
										</b>
									</td>
									<td style="padding:5px" align="right">
										<b>-
	            '.$data['OrderDetail']['Order']['discount']. '
	              </b>
									</td>
								</tr>
								<tr>
									<td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:24px;color:#292929" valign="top" align="left">
										<b>
											<span style="color:#555555">Payment Method</span>
										</b>
									</td>
									<td style="padding:5px" align="right">
										<b>';

                                       if($data['OrderDetail']['Order']['cod'] == 0) {

                                           $str .= 'PayPal / Credit Card';

                                           } elseif($data['OrderDetail']['Order']['cod'] == 1) {

                                           $str .= 'PayMe / FPS';

                                       }
        $str .= '</b>
									</td>
								</tr>
								<tr>
									<td style="background-color:#eeeeee">
										<hr size="1" width="95%">
										</td>
									</tr>
									<tr>
										<td style="background-color:#eeeeee;font-family:\'Avenir Book\',Arial,sans-serif;font-size:14px;padding-left:16px;padding-right:16px;line-height:32px;color:#555555" valign="top" align="left">
											<b>
												<span style="color:#333333">Total</span>
											</b>
										</td>
										<td style="padding:5px" align="right">
											<b>
	                      '. $data['OrderDetail']['Order']['price']. '
	                        </b>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
						<td class="m_-4875878460382169275m_-3751569409617898750wrSide">&nbsp;&nbsp;</td>
					</tr>
				</tbody>
			</table>
			<u></u>
			<div class="yj6qo"></div>
			<div class="adL"></div>
		</div>';
        
        
        return $str;
        
       
       
  }

    public static function emailRestaurantRequest($data){


return '<html><body>

<div>
<p><b>Name:</b> '.$data['contact_name'].'</p>
<p><b>Restaurant Name:</b>'.$data['restaurant_name'].'</p>
<p><b>Phone:</b> '.$data['phone'].'</p>
<p><b>Email:</b>'.$data['email'].'</p>
<p><b>Address:</b> '.$data['address'].'</p>
<p><b>Description:</b>'.$data['description'].'</p>
</div></div>

<html><body>
';


    }
    
    
    
    public static function resetPasswordold($link)
    {
        
        return '<html><body>

<h4>Hello</h4>

<p>We are sending you this message because you have indicated you forgot your foodies password. If this is not the case, please ignore this message.

 </p>

<a href="' . $link . '">Click here to reset your passsword</a><br><br>

or Visit this Link<br/>

<p><a href="' . $link . '">' . $link . '</a></p>


<p>

If you have received this mail in error, it is likely that another user entered
your email address by mistake while trying to reset a email. If you did not
initiate the request, you dont need to take any further action and can safely
disregard this email.</p>
<p>
Sincerely,<br>
OrderOnline Team
</p>
<p>
Note: This email address cannot accept replies. To fix an issue or learn more
about your account, visit our website: <a href ="http://admin.orderonline.hk/"> http://admin.orderonline.hk//</a></p>';
        
        
    }
    
    

    public static function welcomeEmail($email,$link){


        
    return '<html><body>
<table cellspacing="0" cellpadding="0" border-collapse="collapse" style="padding: 30px 10px;
															background:white;
															width: 100%;
															font-family: arial; ">
														
												
									<tbody>
										<tr>
											<td>
												<table align="center" cellspacing="0" style="max-width:850px; min-width:620px; ">
													<tbody>
														<tr>
															<td style="text-align: left; padding-bottom: 14px;">
																															</a>
															</td>
														</tr>
														<tr>
															<td align="center" style="background: #fff;
																border: 1px solid #e4e4e4;
																padding:50px 30px;">
							
																
							
							
									<table align="center">
										<tbody>
											<tr>
												<td style="color: #666; text-align: left;">
							
												   
							
									<table align="center" style="width:500px;">
										<tbody>
												<tr>
													<td style="text-align: center;
														padding-bottom: 5px;">
															<img align="center" alt="new_update" height="100px" src="http://workshop2u.com/images/confirm.png" />
													</td>
												</tr>
							
											<tr>
												<td style="color: #005f84;
													font-size: 25px;
													font-weight: bold;
													text-align: center;
													font-family: arial;">
										
							
													Please confirm your email	
							
												</td>
											</tr>
										</tbody>
									</table>
									
														<br/>
														<span style="
																		font-size: 15px;
																		font-weight: 300;
																		text-align: left;
																		font-family: arial;
																		">
																		Please confirm your email  <b style="color:#005f84;">'.$email.'</b>
																		<br/>
																		<a href="' . $link . '"></a>Confirm Email</a>
																		
																		<br/>
																		</span>
													
							
												</td>
											</tr>
										</tbody>
										
																		<tbody>
																				<tr>
																					<td style="
																						border-radius: 3px;
																						text-align: left;">
																						<br />
																						<span style="color: #005f84;
																							font-size: 15px;
																							font-weight: bold;
																							text-align: left;
																							font-family: arial;
																							">Kind Regards</span><br />
																						<b><span style="font-size:12px">Orderonline Support</span></b>
																					</td>
																				</tr>
																			</tbody>
									</table>
							
							
															</td>
														</tr>
														
							
														<tr>
															<td align="center" style="background: #F8F8F8; border: 1px solid #e4e4e4; border-top: none; padding: 24px 10px;">
							
																<table align="center" style="width: 100%; max-width: 650px;">
																	<tbody>
																		<tr>
																			<td style="text-align:center;">
																				<a href="#" target="_blank" style="text-decoration: none;  margin-bottom:10px; display:inline-block;">
																					<img width="208" height="40" border="0" src="https://d7l5bbi2x5xo4.cloudfront.net/cloud_files/974/original/email-footer-app-store-space.gif" />
																				</a>
							
																				<a href="#" target="_blank" style="text-decoration: none; display: inline-block;">
																				  <img width="208" height="40" border="0" src="https://d7l5bbi2x5xo4.cloudfront.net/cloud_files/975/original/email-footer-play-store-space.gif" />
																				</a>
																			</td>
																		</tr>
																		
																	</tbody>
																</table>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										
									</tbody>
								</table></body></html>';


    }
    
    public static function luckyDrawConfirmation($data){
        
        return '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
        <!--[if gte mso 9]>
        <xml>
          <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta name="x-apple-disable-message-reformatting">
          <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
          <title></title>
          
            <style type="text/css">
              table, td { color: #000000; } a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_row_2.v-row-padding--vertical { padding-top: 0px !important; padding-bottom: 5px !important; } #u_content_image_7 .v-container-padding-padding { padding: 0px 115px !important; } #u_content_image_7 .v-src-width { width: 1024px !important; } #u_content_image_7 .v-src-max-width { max-width: 100% !important; } #u_row_3.v-row-padding--vertical { padding-top: 0px !important; padding-bottom: 0px !important; } #u_content_heading_1 .v-container-padding-padding { padding: 4px !important; } #u_content_heading_1 .v-font-size { font-size: 13px !important; } #u_content_image_6 .v-container-padding-padding { padding: 0px 15px 29px !important; } #u_content_text_3 .v-container-padding-padding { padding: 10px 10px 10px 15px !important; } #u_row_7.v-row-padding--vertical { padding-top: 5px !important; padding-bottom: 5px !important; } #u_row_10.v-row-padding--vertical { padding-top: 0px !important; padding-bottom: 5px !important; } #u_content_image_8 .v-container-padding-padding { padding: 0px 115px !important; } #u_content_image_8 .v-src-width { width: 1024px !important; } #u_content_image_8 .v-src-max-width { max-width: 100% !important; } }
        @media only screen and (min-width: 520px) {
          .u-row {
            width: 500px !important;
          }
          .u-row .u-col {
            vertical-align: top;
          }
        
          .u-row .u-col-100 {
            width: 500px !important;
          }
        
        }
        
        @media (max-width: 520px) {
          .u-row-container {
            max-width: 100% !important;
            padding-left: 0px !important;
            padding-right: 0px !important;
          }
          .u-row .u-col {
            min-width: 320px !important;
            max-width: 100% !important;
            display: block !important;
          }
          .u-row {
            width: calc(100% - 40px) !important;
          }
          .u-col {
            width: 100% !important;
          }
          .u-col > div {
            margin: 0 auto;
          }
        }
        body {
          margin: 0;
          padding: 0;
        }
        
        table,
        tr,
        td {
          vertical-align: top;
          border-collapse: collapse;
        }
        
        p {
          margin: 0;
        }
        
        .ie-container table,
        .mso-container table {
          table-layout: fixed;
        }
        
        * {
          line-height: inherit;
        }
        
        a[x-apple-data-detectors="true"] {
          color: inherit !important;
          text-decoration: none !important;
        }
        
        </style>
          
          
        
        <!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->
        
        </head>
        
        <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff;color: #000000">
          <!--[if IE]><div class="ie-container"><![endif]-->
          <!--[if mso]><div class="mso-container"><![endif]-->
          <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
          <tbody>
          <tr style="vertical-align: top">
            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #ffffff;"><![endif]-->
            
        
        <div id="u_row_2" class="u-row-container v-row-padding--vertical" style="padding: 0px 0px 10px;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px 0px 10px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="500" style="width: 500px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 500px;display: table-cell;vertical-align: top;">
          <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table id="u_content_image_7" style="font-family:\'Montserrat,sans-serif\';" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 200px;font-family:\'Montserrat\',sans-serif;" align="left">
                
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td style="padding-right: 0px;padding-left: 0px;" align="center">
              
              <img align="center" border="0" src="https://admin.orderonline.hk/mobileapp_api/app/webroot/uploads/newsletter/logo.png" alt="" title="" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 100px;" width="100" class="v-src-width v-src-max-width"/>
              
            </td>
          </tr>
        </table>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:\'Montserrat\',sans-serif;" align="left">
                
          <div style="line-height: 140%; text-align: left; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 140%; text-align: center;"><span style="font-size: 18px; line-height: 25.2px;"><strong>You want good food?</strong></span><br /><span style="font-size: 18px; line-height: 25.2px;"><strong>You want OOHK!</strong></span></p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div id="u_row_3" class="u-row-container v-row-padding--vertical" style="padding: 0px;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="500" style="background-color: #cb202d;width: 500px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 500px;display: table-cell;vertical-align: top;">
          <div style="background-color: #cb202d;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table id="u_content_heading_1" style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:\'Montserrat\',sans-serif;" align="left">
                
          <h1 class="v-font-size" style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: \'Montserrat\',sans-serif; font-size: 16px;">
            <strong>Congrats! You have successfully entered</strong>
          </h1>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div class="u-row-container v-row-padding--vertical" style="padding: 0px;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="500" style="background-color: #ffffff;width: 500px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 500px;display: table-cell;vertical-align: top;">
          <div style="background-color: #ffffff;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table id="u_content_image_6" style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 0px 29px;font-family:\'Montserrat\',sans-serif;" align="left">
                
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td style="padding-right: 0px;padding-left: 0px;" align="center">
              
              <img align="center" border="0" src="https://admin.orderonline.hk/mobileapp_api/app/webroot/uploads/newsletter/banner.jpeg" alt="" title="" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 500px;" width="500" class="v-src-width v-src-max-width"/>
              
            </td>
          </tr>
        </table>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div class="u-row-container v-row-padding--vertical" style="padding: 0px;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="500" style="width: 500px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 500px;display: table-cell;vertical-align: top;">
          <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table id="u_content_text_3" style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:\'Montserrat\',sans-serif;" align="left">
                
          <div style="line-height: 140%; text-align: left; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 140%;">Hi '.$data['name'].',<br /><br />This is a confirmation that you have entered the giveaway by OOHK! The winners will be announced on 1st January, 2022. </p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div id="u_row_7" class="u-row-container v-row-padding--vertical" style="padding: 5px;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 5px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="492" style="width: 492px;padding: 0px;border-top: 4px solid #cb202d;border-left: 4px solid #cb202d;border-right: 4px solid #cb202d;border-bottom: 4px solid #cb202d;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 500px;display: table-cell;vertical-align: top;">
          <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 4px solid #cb202d;border-left: 4px solid #cb202d;border-right: 4px solid #cb202d;border-bottom: 4px solid #cb202d;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:\'Montserrat\',sans-serif;" align="left">
                
          <div style="color: #4a4a4a; line-height: 140%; text-align: center; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 22px; line-height: 30.8px;"><strong><span style="line-height: 30.8px; font-size: 20px;">Your Ticket Number: <span style="font-size: 24px; line-height: 36.4px;">'.$data['id'].'</span></span></strong></span></p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        <div class="u-row-container v-row-padding--vertical" style="padding: 0px;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="500" style="width: 500px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 500px;display: table-cell;vertical-align: top;">
          <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:\'Montserrat\',sans-serif;" align="left">
                
          <div style="line-height: 140%; text-align: left; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 140%; text-align: center;">Trade Promotion Competition Licence No.55282</p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div class="u-row-container v-row-padding--vertical" style="padding: 0px;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="500" style="width: 500px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 500px;display: table-cell;vertical-align: top;">
          <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:\'Montserrat\',sans-serif;" align="left">
                
          <div style="line-height: 140%; text-align: left; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 140%; text-align: center;">The winners will be announced on our social media. Do not miss out. Follow us!</p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div class="u-row-container v-row-padding--vertical" style="padding: 0px;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="500" style="width: 500px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 500px;display: table-cell;vertical-align: top;">
          <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:\'Montserrat\',sans-serif;" align="left">
                
        <div align="center">
          <div style="display: table; max-width:125px;">
          <!--[if (mso)|(IE)]><table width="125" cellpadding="0" cellspacing="0" border="0"><tr><td style="border-collapse:collapse;" align="center"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:125px;"><tr><![endif]-->
          
            
            <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 10px;" valign="top"><![endif]-->
            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 10px">
              <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                <a href="https://www.facebook.com/orderonlinehk/" title="Facebook" target="_blank">
                  <img src="https://admin.orderonline.hk/mobileapp_api/app/webroot/uploads/newsletter/facebook.png" alt="Facebook" title="Facebook" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                </a>
              </td></tr>
            </tbody></table>
            <!--[if (mso)|(IE)]></td><![endif]-->
            
            <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 10px;" valign="top"><![endif]-->
            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 10px">
              <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                <a href="https://www.instagram.com/orderonlinehk/?hl=en" title="Instagram" target="_blank">
                  <img src="https://admin.orderonline.hk/mobileapp_api/app/webroot/uploads/newsletter/instagram.png" alt="Instagram" title="Instagram" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                </a>
              </td></tr>
            </tbody></table>
            <!--[if (mso)|(IE)]></td><![endif]-->
            
            <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 0px;" valign="top"><![endif]-->
            <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px">
              <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                <a href="whatsapp://send?phone=85297133727" title="WhatsApp" target="_blank">
                  <img src="https://admin.orderonline.hk/mobileapp_api/app/webroot/uploads/newsletter/whatsapp.png" alt="WhatsApp" title="WhatsApp" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                </a>
              </td></tr>
            </tbody></table>
            <!--[if (mso)|(IE)]></td><![endif]-->
            
            
            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
          </div>
        </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
        
        <div id="u_row_10" class="u-row-container v-row-padding--vertical" style="padding: 0px 0px 10px;background-color: transparent">
          <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px 0px 10px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px;"><tr style="background-color: transparent;"><![endif]-->
              
        <!--[if (mso)|(IE)]><td align="center" width="500" style="width: 500px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
        <div class="u-col u-col-100" style="max-width: 320px;min-width: 500px;display: table-cell;vertical-align: top;">
          <div style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
          <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
          
        <table id="u_content_image_8" style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 200px;font-family:\'Montserrat\',sans-serif;" align="left">
                
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td style="padding-right: 0px;padding-left: 0px;" align="center">
              
              <img align="center" border="0" src="https://admin.orderonline.hk/mobileapp_api/app/webroot/uploads/newsletter/logo.png" alt="" title="" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 100px;" width="100" class="v-src-width v-src-max-width"/>
              
            </td>
          </tr>
        </table>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:\'Montserrat\',sans-serif;" align="left">
                
          <div style="line-height: 140%; text-align: left; word-wrap: break-word;">
            <p style="font-size: 14px; line-height: 140%; text-align: center;"><span style="font-size: 18px; line-height: 25.2px;"><strong>You want good food?</strong></span><br /><span style="font-size: 18px; line-height: 25.2px;"><strong>You want OOHK!</strong></span></p>
          </div>
        
              </td>
            </tr>
          </tbody>
        </table>
        
        <table style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
          <tbody>
            <tr>
              <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 0px 0px;font-family:\'Montserrat\',sans-serif;" align="left">
                
          <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 5px solid #cb202d;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
            <tbody>
              <tr style="vertical-align: top">
                <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                  <span>&#160;</span>
                </td>
              </tr>
            </tbody>
          </table>
        
              </td>
            </tr>
          </tbody>
        </table>
        
          <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
          </div>
        </div>
        <!--[if (mso)|(IE)]></td><![endif]-->
              <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
          </div>
        </div>
        
        
            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
            </td>
          </tr>
          </tbody>
          </table>
          <!--[if mso]></div><![endif]-->
          <!--[if IE]></div><![endif]-->
        </body>
        
        </html>';
        
    }
    
    
    
}
?>
