@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="../assets/css/userManual/style.css">
<link rel="stylesheet" href="../assets/css/responsive/user-manual.css">
    <div class="list--search--select title_usermanual" >
        <div class="list--title">
            <p>{{ __('Guide video') }}</p>
        </div>
    </div>
</div>
<div class="container__usermanual" >
    <div class="wrapper">
        <video height="100%" width="100%" poster="{{ asset('assets/image/usermanual/img-landing-banner.png') }}" muted controls>
            <source  src="{{ asset('assets/image/usermanual/AT.mp4') }}" type="video/mp4"  media="all and (max-width: 444px)">
        </video>
    </div>
</div>
<div class="list--search--select title_usermanual" >
    <div class="list--title title_instruction">
        <p>{{ __('Instruction list') }}</p>
    </div>
</div>
<div class="container__usermanual" >
    <div class="wrap-accordion">
        <a data-id="#sl1" ><button class="accordion"> {{ __('Intrustions on how to check for violations') }} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl1">
            <a data-id="#cl1"><button class="child-accordion"><?= __("Intrustions on how to check for violations with Image or Text") ?>
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id="cl1">
                <p><span>{{ __('Step 1 ') }}:</span>  {{__(" Click on the “Submit violations” page in the menu bar")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-home1.png') }}" loading="lazy">
                <p><span> {{__("Step 2 ")}}:</span>  {{__(" Choose option “ Enter the suspected text/Drop image ”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-2.png') }}" loading="lazy">
                <p><span> {{__("Step 3")}}: </span>  {{__(" Enter the suspected text or upload photo from your computer")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-3.png') }}" loading="lazy">
                <p><span> {{__("Step 4")}}: </span>  {{__(" Select your country")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-4.png') }}" loading="lazy" class="inherit_img">
                <p><span> {{__("Step 5")}}: </span>  {{__(" Click the captcha “I’m not a robot”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-5.png') }}" loading="lazy" class="inherit_img">
                <p><span> {{__("Step 6")}}: </span>  {{__(" Click the “Check” button to check violations")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-10.png') }}" loading="lazy">
                <p><span></span>  {{__(" After the system checks for violations, the administrator can review the results below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-6.png') }}" loading="lazy">
            </div>
            <span class="border_grays"></span>
            <a data-id="#cl2"><button class="child-accordion"> {{__("Instructions for checking violations by link")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id="cl2">
                <p><span>{{ __('Step 1 ') }}:</span>  {{__(" Visit the “Submit violations” page in the menu bar")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-1.png') }}" loading="lazy">
                <p><span>{{__("Step 2 ")}}:</span>  {{__(" Choose option “ Enter the suspected URL ”")}}
                <a href="https://drive.google.com/file/d/187v4IYal9WiQPI1GmmHGFWZ2yDD8jw1B/view">  {{__("this list")}} </a>.</p>
                <img src="{{ asset('assets/image/usermanual/img-7.png') }}" loading="lazy">
                <p><span>{{__("Step 3")}}: </span>  {{__(" Enter suspected link of the website or the images, posts on the Fanpage, Instagram, Website on the provided list")}} .</p>
                <img src="{{ asset('assets/image/usermanual/img-8.png') }}" loading="lazy">
                <p><span>{{__("Step 4")}}: </span>  {{__(" Click the captcha “I’m not a robot”")}} .</p>
                <img src="{{ asset('assets/image/usermanual/img-9.png') }}" loading="lazy">
                <p><span>{{__("Step 5")}}: </span>  {{__(" Click the “Check” button to check violations")}} .</p>
                <img src="{{ asset('assets/image/usermanual/img-10.png') }}" loading="lazy">
                <p><span></span>  {{__(" After the system checks for violations, the administrator can review the results below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-11.png') }}" loading="lazy">
                <span class="border_grays"></span>
            </div>
        </div>
        <a data-id="#sl2">
            <button class="accordion"> {{__("Instructions for getting a valid link to check violations")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
        </a>
        <div class="panel" id="sl2">
            <a data-id="#cl3"><button class="child-accordion"> {{__("Valid website link")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id="cl3">
                <p><span></span> {{ __("Any link with the same domain name in the website") }}
                <a href="https://drive.google.com/file/d/187v4IYal9WiQPI1GmmHGFWZ2yDD8jw1B/view">  {{__("this list")}} </a>,  {{__("examples")}}:</p>
                <p><span></span>
                    <a href="https://www.clubillume.com.sg/" class="link_user_manual">https://www.clubillume.com.sg/</a>
                    {{__("and")}}
                    <a href="https://www.clubillume.com.sg/illuma-stage-3 " class="link_user_manual"> https://www.clubillume.com.sg/illuma-stage-3 </a>
                    .</p>
            </div>
            <span class="border_grays"></span>
            <a data-id="#cl4">
            <button class="child-accordion"> {{__("How to get a valid link on Fanpage")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id="cl4">
                <p class="strong"><span></span> <strong> {{__("How to get the valid link of a post on Fanpage")}}.</strong></p>
                <p><span> {{__("Step 1")}}:</span>  {{__(" Access the available Fanpage on the provided Fanpage list")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-12.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span> {{__(" Select the post you want to check for violations")}}.</p>
                <p><span> {{__("Step 3")}}: </span>  {{__(" Right click on the timeline below the Fanpage name")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-13.png') }}" loading="lazy">
                <p><span> {{__("Step 4")}}: </span>  {{__(" Click on “Open link in new tab” or “Open link in new window” and you will be navigated to the posts")}}.</p>
                <p><span> {{__("Step 5")}}: </span>  {{__(" After the website has finished loading, copy the shorten link with the structure as shown below and return to the Vivid website to check")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-14.png') }}" loading="lazy">
                <p><span> {{__("Step 6")}}: </span>  {{__(" Press Ctrl V or click the icon below to paste the copied path into the violation check section")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-77.png') }}" loading="lazy">
                <p><span> {{__("Step 7")}}: </span>  {{__(" Click the “Check” button to check violations")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-10.png') }}" loading="lazy">
                <p><span></span>  {{__(" After the system checks for violations, the administrator can review the results below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-6.png') }}" loading="lazy">
                <p class="strong"><span></span> <strong> {{__("How to get a valid link for an image on Fanpage?")}}</strong></p>
                <p><span> {{__("Step 1")}}:</span>  {{__(" Access the available Fanpage on the provided Fanpage list")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-12.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Click on the image you want to check for violations and copy the link as shown below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-15.png') }}" loading="lazy">
                <p><span> {{__("Step 3")}}: </span>  {{__(" Return to the Vivid page in the link check section, Press Ctrl V or click the icon below to paste the copied link into the violation check")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-7.png') }}" loading="lazy">
                <p><span> {{__("Step 4")}}: </span>  {{__(" Click the “Check” button to check violations")}} .</p>
                <img src="{{ asset('assets/image/usermanual/img-10.png') }}" loading="lazy">
                <p><span></span>  {{__(" After the system checks for violations, the administrator can review the results below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-6.png') }}" loading="lazy">
            </div>
            <span class="border_grays"></span>
            <a data-id="#n-5">
                <button class="child-accordion"> {{__("How to get a valid link on Instagram")}}
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="n-5">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Access the available Instagram on the provided Instagram list")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-54.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Click on the image you want to check for violations")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-55.png') }}" loading="lazy">
                <p><span> {{__("Step 3")}}:</span>  {{__(" Copy the link as shown belows")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-56.png') }}" loading="lazy">
                <p><span> {{__("Step 4")}}:</span>  {{__(" Return to the Vivid page in the link check section, Press Ctrl V or click on the icon below to paste the copied link into the violation check")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-7.png') }}" loading="lazy">
                <p><span> {{__("Step 5")}}:</span>  {{__(" Click the “Check” button to check violations")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-10.png') }}" loading="lazy">
                <p><span></span>  {{__(" After the system checks for violations, the administrator can review the results below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-6.png') }}" loading="lazy">
                <span class="border_grays"></span>
            </div>
        </div>
        <a data-id="#sl3"><button class="accordion "> {{__("Guide to Check violations for Operators and Supervisors")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl3">
            <p> {{__("Vivid website allows check violations for Operators and Supervisorss on 2 pages")}}.</p>
            <ul>
                <li> {{__("Auto-detect violations (Systems scans and check violations automatically)")}}</li>
                <li> {{__("Submit violations (User upload manually to check violations)")}}</li>
            </ul>
            <span class="border_grays"></span>
            <a data-id="#cl5">
            <button class="child-accordion"> {{__("Review posts that VIVID predicts as “Unable to detect”") }}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id=cl5>
                <img src="{{ asset('assets/image/usermanual/img-16.png') }}" loading="lazy">
                <p class="strong"><span></span> <strong> {{__("Agree with VIVID’s status")}}.</strong></p>
                <p><span> {{__("Step 1")}}:</span>  {{__(" Click the green “✓” button if you agree with the system's Violation status")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-17.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Click on the “Confirm” button")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-18.png') }}" loading="lazy">
                <p><span> {{__("Step 3")}}:</span>  {{__(" The post will automatically move to the Unable to detect (Just for Operator but not other account)")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-19.png') }}" loading="lazy">
                <p class="strong"><span></span> <strong> {{__("Disagree with VIVID’s status")}}.</strong></p>
                <img src="{{ asset('assets/image/usermanual/img-n1.png') }}" loading="lazy" class="inherit_img">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Click the red “X” button if you disagree with “Unable to detect” status")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-20.png') }}" loading="lazy" class="inherit_img">
                <p><span></span>  {{__(" After clicking, the system will display a message to confirm the status.")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-21.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Click on the “Confirm” button")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-22.png') }}" loading="lazy">
                <p><span> {{__("Step 3")}}:</span>  {{__(" The post will automatically change to Violation status")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-23.png') }}" loading="lazy">
                <p><span> {{__("Step 4")}}:</span>  {{__(" Choose code article for this post by clicking on the green “✓” button on “Code Article” Column")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-24.png') }}" loading="lazy">
                <p><span> {{__("Step 5")}}:</span>  {{__(" Choose the appropriate violation code")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-25.png') }}" loading="lazy" class="inherit_img">
                <p><span> {{__("Step 6")}}:</span>  {{__(" Click the “Save Change” button")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-26.png') }}" loading="lazy">
            </div>
            <span class="border_grays"></span>
            <a data-id="#cl6">
                <button class="child-accordion">
                     {{ __("Review posts that VIVID predicts as “violation”") }}  <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl6">
                <img src="{{ asset('assets/image/usermanual/img-27.png') }}" loading="lazy">
                <p class="strong"><span></span> <strong> {{__("Agree with VIVID’s status and Code Article")}}.</strong></p>
                <img src="{{ asset('assets/image/usermanual/img-28.png') }}" loading="lazy">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Click the green “✓” button if you agree with the system's Violation status")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-29.png') }}" loading="lazy">
                <p><span></span>  {{__(" After clicking, the system will display a message to confirm the status")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-21.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Click on the “Confirm” button")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-22.png') }}" loading="lazy">
                <p><span> {{__("Step 3")}}:</span>  {{__(" The post will automatically change to Violation status")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-23.png') }}" loading="lazy" >
                <p><span> {{__("Step 4")}}:</span>  {{__(" Click the green “✓” button if you agree with VIVID’s Code article")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-30.png') }}" loading="lazy">
                <p><span> {{__("Step 5")}}:</span>  {{__(" After agree with Code Artile, the post will automatically move to “Code violations”") }}.</p>
                <img src="{{ asset('assets/image/usermanual/img-31.png') }}" loading="lazy">
                <p class="strong"><span></span> <strong> {{__(" Agree with VIVID’s status but not Code Article")}}.</strong></p>
                <img src="{{ asset('assets/image/usermanual/img-32.png') }}" loading="lazy">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Click the green “✓” button if you agree with the system's Violation status")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-29.png') }}" loading="lazy">
                <p><span></span>  {{__(" After clicking, the system will display a message to confirm the status")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-21.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Click on the “Confirm” button")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-22.png') }}" loading="lazy">
                <p><span> {{__("Step 3")}}:</span>  {{__(" The post will automatically change to Violation status")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-33.png') }}" loading="lazy" class="inherit_img">
                <p><span> {{__("Step 4")}}:</span>  {{__(" Click the red “X” button if you disagree with VIVID’s Code article")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-34.png') }}" loading="lazy">
                <p><span> {{__("Step 5")}}:</span>  {{__(" Choose appropriate code")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-35.png') }}" loading="lazy">
                <p><span> {{__("Step 6")}}:</span>  {{__(" Click on “Save change” button")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-36.png') }}" loading="lazy">
                <p><span> {{__("Step 7")}}:</span>  {{__(" After choosing Code Artile, the post will automatically move to “Code violations”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-37.png') }}" loading="lazy">
                <p class="strong"><span></span> <strong> {{__(" Disagree with VIVID’s status")}}.</strong></p>
                <img src="{{ asset('assets/image/usermanual/img-38.png') }}" loading="lazy">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Click the red “X” button if you disagree with “Violation” status")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-20.png') }}" loading="lazy" class="inherit_img">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Click on the “Confirm” button")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-39.png') }}" loading="lazy">
                <p><span> {{__("Step 3")}}:</span>  {{__(" The post will automatically move to the Unable to detect. (Just for Operator but not other account)")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-40.png') }}" loading="lazy">
                <span class="border_grays"></span>
            </div>
        </div>
        <a data-id="#sl4"><button class="accordion"> {{__("Switch status instructions")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl4">
            <p><span> {{__("Step 1")}}:</span>  {{__(" Select “Violation reviewed” on the menu bar and click “ Code Violations” or “Unable to detect”")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-41.png') }}" loading="lazy" >
            <p><span> {{__("Step 2")}}:</span> {{__(" Click the button in the “Switch status” column")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-42.png') }}" loading="lazy" >
            <p><span> {{__("Step 3")}}: </span> {{__(" Return to the “Auto-Detect Violations” page to check the this post for violations from the beginning")}}.</p>
            <span class="border_grays"></span>
        </div>
        <a data-id="#sl5"><button class="accordion"> {{__("Instructions to change the “Status progress”")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl5">
            <p><span> {{__("Step 1")}}:</span>  {{__(" Select “Violation reviewed” on the menu bar and click “ Code Violations”")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-43.png') }}" loading="lazy" >
            <p><span> {{__("Step 2")}}:</span>  {{__(" Change the “Status Progress” according to action including")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-44.png') }}" loading="lazy">
            <ul>
                <li>
                    <span> {{__('Not started')}} :</span>  {{__(" This posts has not been checked and processed yet")}}.
                </li>
                <li>
                    <span> {{__('Processing')}} :</span>  {{__(" This posts is being processed and waiting for the official document to be posted")}}.
                </li>
                <li>
                    <span> {{__('Completed')}} :</span>  {{__("The posts has been handled successfully and the handling text is published (This status can only be selected when at least 1 handling text has been posted for the article)")}}.
                </li>
            </ul>
            <span class="border_grays"></span>
        </div>
        <a data-id="#sl6">
            <button class="accordion">
             {{__("Instructions on how to upload “Legal documents”")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
        </a>
        <div class="panel" id="sl6">
            <p><span> {{__("Step 1")}}:</span>  {{__(" Go to “Violation reviewed ” and select “ Code Violations” on the menu bar")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-41.png') }}" loading="lazy" >
            <p><span> {{__("Step 2")}}:</span>  {{__(" At “Legal documents”, click on the button with the folder image as below")}}.</p>
            <ul>
                <li> {{__("If the button color is gray, no text has been uploaded recently")}}.</li>
                <li> {{__("If the button color is blue, there is at least one recently uploaded text")}}.</li>
            </ul>
            <img src="{{ asset('assets/image/usermanual/img-45.png') }}" loading="lazy" >
            <p><span> {{__("Step 3")}}: </span>  {{__(" Add more Documents by clicking the “Upload” icon and selecting the document you want to upload")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-46.png') }}" loading="lazy" >
            <p><span></span>  {{__(" After the upload is successful, a message will appear at the bottom of the screen on the right")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-47.png') }}" loading="lazy" >
            <p><span></span>  {{__(" User can check the document again by clicking on the document")}}.</p>
            <p><span> {{__("Step 4")}}: </span>  {{__(" When the user completes the document upload process, the folder button will turn blue and update the latest document upload date")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-48.png') }}" loading="lazy" >
            <span class="border_grays"></span>
        </div>
        <a data-id="#sl7">
            <button class="accordion"> {{__("Instructions for viewing the detailed content of the posts")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button>
        <div class="panel" id="sl7">
            <a data-id="#n-6">
                <button class="child-accordion"> {{__("Image checking instructions")}}
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="n-6">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Select the post you want to see at any page on website")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-49.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Click on the “Image” of the post to see large and full images of the post")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-50.png') }}" loading="lazy">
                <img src="{{ asset('assets/image/usermanual/img-51.png') }}" loading="lazy">
                <p><span> {{__("Step 3")}}:</span>  {{__(" Click the arrow icon to view the images of the post in turn (if the post has many images)")}}.</p>
            </div>
            <span class="border_grays"></span>
            <a data-id="#n-7">
                <button class="child-accordion"> {{__("Instructions to view the full caption")}}
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="n-7">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Select the post you want to see")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-49.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Click on the “Caption” of the post to see the full caption")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-52.png') }}" loading="lazy">
                <img src="{{ asset('assets/image/usermanual/img-53.png') }}" loading="lazy">
            </div>
            <span class="border_grays"></span>
            <a data-id="#n-8">
                <button class="child-accordion"> {{__("Instructions on how to get links from posts[c] that Vivid has crawled")}}
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="n-8">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Select the post you want to see")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-49.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Click the icon in the link column to access the Link or right click to copy the link")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-57.png') }}" loading="lazy">
            </div>
            <span class="border_grays"></span>
        </div>
        <a data-id="#sl8"><button class="accordion"> {{__("Instructions for searching posts by keyword or review date")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl8">
            <a data-id="#cl7">
                <button class="child-accordion"> {{__("Search posts by keywords") }}
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl7">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Enter search information for example “Nestle”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-58.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Press the Enter button and related posts with the keyword Nestle or of the Nestle Fanpage, Instaram, Website will be displayed below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-59.png') }}" loading="lazy">
            </div>
            <span class="border_grays"></span>
            <a data-id="#cl8">
                <button class="child-accordion"> {{__("Search posts by review date")}}
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl8">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Click on the box “Select date”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-60.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Select the appropriate range of time")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-61.png') }}" loading="lazy" class="inherit_img">
                <p><span></span> {{__("After selecting all post with selected review date will be displayed below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-63.png') }}" loading="lazy">
                <span class="border_grays"></span>
            </div>
        </div>
        <a data-id="#sl9"><button class="accordion"> {{__("Instructions for arraging posts with sort functions")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl9">
            <p><span></span>  {{__(" User can sort posts from A-Z and vice versa")}}.</p>
            <ul>
                <li> {{__("Date (published date, review date, penalty issues, crawl date): In order of newest or oldest date order")}}.</li>
                <li> {{__("Status (violation or Unable to detect): In alphabetical order")}}. </li>
                <li> {{__("Brand Name: In alphabetical order")}}.</li>
                <li> {{__("Country Name: In alphabetical order")}}.</li>
                <li> {{__("Company Name: In alphabetical order")}}.</li>
            </ul>
            <p><span></span>  {{__(" User can sort by clicking on the 2 arrow icon next to the column you want to arrange (the illustrate image below)")}}</p>
            <img src="{{ asset('assets/image/usermanual/img-64.png') }}" loading="lazy" >
            <span class="border_grays"></span>
        </div>
        <a data-id="#sl10"><button class="accordion"> {{__("Data export instructions")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl10">
            <p><span> {{__("Step 1")}}:</span>  {{__(" Go to the page to export data (Auto-detect violations, Code Violations, Unable to detect, Submit violations)")}}.</p>
            <p><span> {{__("Note")}}:</span>  {{__(" Only applied when login successfully")}}.</p>
            <p><span> {{__("Step 2")}}:</span>  {{__(" Select the filter you want")}}.</p>
            <ul>
                <img src="{{ asset('assets/image/usermanual/img-67.png') }}" loading="lazy" >
                <li> {{__("Select the time")}}.</li>
                <img src="{{ asset('assets/image/usermanual/img-65.png') }}" loading="lazy">
                <li> {{__("Select Brand/ Company (optional)")}}. </li>
                <img src="{{ asset('assets/image/usermanual/img-66.png') }}" loading="lazy">
                <li> {{__("Select country (optional)")}}.</li>
                <img src="{{ asset('assets/image/usermanual/img-68.png') }}" loading="lazy">
                <li> {{__("Select violation type")}}.</li>
                <img src="{{ asset('assets/image/usermanual/img-69.png') }}" loading="lazy">
            </ul>
            <p><span> {{__("Step 3")}}:</span>  {{__(" Click the “Apply” button and wait for the system to process the data")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-70.png') }}" loading="lazy" >
            <p><span> {{__("Step 4")}}:</span>  {{__(" Click the “Export excel” button and wait for the system to download the excel list to your computer")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-71.png') }}" loading="lazy">
            <p><span> {{ __("Note") }}:</span>  {{__(" If you do not choose any special arrangement such as keyword content,
             time, brand/ company, country, and violation type,  the system will download the correct number of posts
              displayed directly on the Vivid page ")}}. </p>
            <p><span></span>  {{__(" The downloaded Excel will have the following format")}}: </p>
            <img src="{{ asset('assets/image/usermanual/img-72.png') }}" loading="lazy" >
            <span class="border_grays"></span>
        </div>
        <a data-id="#sl11"><button class="accordion"> {{__("Instructions for adding a new administrator")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl11">
            <p><span> {{__("Note")}}: </span>  {{__(" On Vivid's website, there are only 3 user objects including Operator
            , Supervisor and Administrator. Only Administrators have the right to add new admins")}}.
            </p>
            <p><span> {{__("Step 1")}}:</span>  {{__(" Click on the “Admins management” page on the menu bar")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-73.png') }}" loading="lazy" style="max-width:100%">
            <p><span> {{__("Step 2")}}:</span>  {{__(" Click the “Add admin” button")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-74.png') }}" loading="lazy" >
            <p><span> {{__("Step 3")}}:</span> {{ __(" Fill in the required fields including")}}.</p>
            <ul>
                <li> {{__("Full name")}}</li>
                <li> {{__("Email address")}}</li>
                <li> {{__("Phone number")}}</li>
                <li> {{__("Password")}}</li>
                <li> {{__("Confirm password")}}</li>
                <li> {{ __("Authority on the website (Admin, Supervisor, Operator)") }}</li>
            </ul>
            <img src="{{ asset('assets/image/usermanual/img-75.png') }}" loading="lazy">
            <p><span> {{__("Step 4")}}:</span>  {{__(" Click on the “Save change” button")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-76.png') }}" loading="lazy">
            <span class="border_grays"></span>
        </div>
        </div>
</div>
<script src="{{ asset('assets/js/pages/user-manual.js') }}"></script>
@endsection
