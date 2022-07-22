@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="../assets/css/userManual/style.css">
<link rel="stylesheet" href="../assets/css/responsive/user-manual.css">
    <div class="list--search--select" >
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
<div class="list--search--select" >
    <div class="list--title title_instruction">
        <p>{{ __('Instruction list') }}</p>
    </div>
</div>
<div class="container__usermanual" >
    <div class="wrap-accordion">
        <a data-id="#sl1" ><button class="accordion"> {{ __('Instructions on how to check for violations') }} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl1">
            <a data-id="#cl1"><button class="child-accordion"><?= __("Instructions on how to check for violations with Image or Text") ?>
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id="cl1">
                <p><span>{{ __('Step 1 ') }}:</span>  {{__(" Visit the 'Submit violations upon requests' page in the menu bar")}}.</p>
                <p><span> {{__("Step 2 ")}}:</span>  {{__(" Enter your content with text or upload photos to your computer")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-1.png') }}" loading="lazy">
                <p><span> {{__("Step 3")}}: </span>  {{__(" Click the 'Check' button to check your content for violations")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-2.png') }}" loading="lazy">
                <p><span></span>  {{__(" After the system checks for violations, the administrator can review the results below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-3.png') }}" loading="lazy">
            </div>
            <span class="border_grays"></span>
            <a data-id="#cl2"><button class="child-accordion"> {{__("Instructions for checking violations by link")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id="cl2">
                <p><span>{{ __('Step 1 ') }}:</span>  {{__(" Visit the 'Submit violations upon requests' page in the menu bar")}}.</p>
                <p><span>{{__("Step 2 ")}}:</span>  {{__(" Enter your content by pasting the link of the website or the images, articles on the Fanpage on")}}
                <a href="https://drive.google.com/file/d/187v4IYal9WiQPI1GmmHGFWZ2yDD8jw1B/view">  {{__("this ")}} </a>
                {{__("list")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-4.png') }}" loading="lazy">
                <p><span>{{__("Step 3")}}: </span>  {{__(" Click the 'Check' button to check your content for violations")}} .</p>
                <img src="{{ asset('assets/image/usermanual/img-2.png') }}" loading="lazy">
                <p><span></span>  {{__(" After the system checks for violations, the administrator can review the results below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-3.png') }}" loading="lazy">
                <span class="border_grays"></span>
            </div>
        </div>
        <a data-id="#sl2">
            <button class="accordion"> {{__("Instructions for getting a valid path to check for violations on demand")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
        </a>
        <div class="panel" id="sl2">
            <a data-id="#cl3"><button class="child-accordion"> {{__("Valid website link")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id="cl3">
                <p><span></span> {{ __("Any link with the same domain name in the website  ") }}
                <a href="https://drive.google.com/file/d/187v4IYal9WiQPI1GmmHGFWZ2yDD8jw1B/view">  {{__("this")}} </a>  {{__("list")}},  {{__("examples")}}:</p>
                <p><span></span><a href="https://www.nestlemomandme.vn/">www.nestlemomandme.vn</a>  {{__("hoặc")}} <a href=" https://www.nestlemomandme.vn/cerelac"> www.nestlemomandme.vn/cerelac</a>.</p>
            </div>
            <span class="border_grays"></span>
            <a data-id="#cl4">
            <button class="child-accordion"> {{__("How to get a valid link on Fanpage")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id="cl4">
                <p><span></span> <strong> {{__("How to get the valid link of a post on Fanpage.")}}.</strong></p>
                <p><span> {{__("Step 1")}}:</span>  {{__(" Access the available Fanpage on the provided Fanpage list")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-5.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span> {{__(" Select the post you want to check for violations")}}.</p>
                <p><span> {{__("Step 3")}}: </span>  {{__(" Right click on the timeline below the Fanpage name")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-6.png') }}" loading="lazy">
                <p><span> {{__("Step 4")}}: </span>  {{__(" Click on open link in new tab or new window and you will be navigated to the article")}}.</p>
                <p><span> {{__("Step 5")}}: </span>  {{__(" After the website has finished loading, copy the short link with the structure as shown below and return to the Vivid website to check")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-7.png') }}" loading="lazy">
                <p><span> {{__("Step 6")}}: </span>  {{__(" Press Ctrl V or click the icon below to paste the copied path into the violation check section")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-8.png') }}" loading="lazy">
                <p><span> {{__("Step 7")}}: </span>  {{__(" Click the 'Check' button to check your content for violations")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-2.png') }}" loading="lazy">
                <p><span></span>  {{__(" After the system checks for violations, the administrator can review the results below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-3.png') }}" loading="lazy">
                <p><span></span> <strong> {{__("How to get a valid link for an image on Fanpage?")}}</strong></p>
                <p><span> {{__("Step 1")}}:</span>  {{__(" Access the available Fanpage on the provided Fanpage list")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-5.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Click on the image you want to check for violations and copy the link as shown below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-41.png') }}" loading="lazy">
                <p><span> {{__("Step 3")}}: </span>  {{__(" Return to the Vivid page in the link check section, Press Ctrl V or click the icon below to paste the copied link into the violation check")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-8.png') }}" loading="lazy">
                <p><span> {{__("Step 4")}}: </span>  {{__(" Click the 'Check' button to check your content for violations")}} .</p>
                <img src="{{ asset('assets/image/usermanual/img-2.png') }}" loading="lazy">
                <p><span></span>  {{__(" After the system checks for violations, the administrator can review the results below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-3.png') }}" loading="lazy">
                <span class="border_grays"></span>
            </div>
        </div>
        <a data-id="#sl3"><button class="accordion "> {{__("Guide to censorship violations")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl3">
            <p> {{__("Vivid website allows censorship violations on 2 pages")}}:</p>
            <ul>
                <li> {{__("Violation alert (Systems scans and returns suspect status)")}}</li>
                <li> {{__("Violation check (User self-scan and Systems status checker)")}}</li>
            </ul>
            <span class="border_grays"></span>
            <a data-id="#cl5">
            <button class="child-accordion"> {{__("Moderate posts that VIVID predicts as 'no violated'") }}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id=cl5>
                <img src="{{ asset('assets/image/usermanual/img-9.png') }}" loading="lazy">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Confirm the status of the post")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-12.png') }}" loading="lazy">
                <ul class="img-ul">
                    <li>
                         {{__("Click the blue “tick” button if you agree with the system's No Violation status. After clicking,
                         the system will display a message to confirm the status browsing action.
                         After clicking the “Yes” button the post will automatically move to the No Violations list and no need to go through step 2")}}.
                        <img src="{{ asset('assets/image/usermanual/img-10.png') }}" loading="lazy">
                    </li>
                    <li>
                         {{__("Click the red “X” button if you disagree with the system's No Violation status. After clicking,
                          the system will display a message to confirm the status browsing action. After clicking the “Yes” button,
                           the post will automatically change to Violation status")}}.
                        <img src="{{ asset('assets/image/usermanual/img-11.png') }}" loading="lazy">
                    </li>
                </ul>
                <p><span> {{__("Step 2")}}:</span>  {{__(" Confirm the type of violation by clicking any of the X and Tick buttons to select the type of violation for the article")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-15.png') }}" loading="lazy">
                <p><span> {{__("Step 3")}}:</span>  {{__(" Choose the appropriate type of violation")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-14.png') }}" loading="lazy">
                <p><span> {{__("Step 4")}}:</span>  {{__(" Click the “Save Changes” button”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-40.png') }}" loading="lazy">
            </div>
            <span class="border_grays"></span>
            <a data-id="#cl6">
                <button class="child-accordion">
                     {{ __("Moderate posts that VIVID predicts as 'violated'") }}  <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl6">
                <img src="{{ asset('assets/image/usermanual/img-42.png') }}" loading="lazy">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Confirm the status of the post")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-15.png') }}" loading="lazy">
                <ul class="img-ul">
                    <li>
                          {{__("Click the blue “tick” button if you agree with the Violation status of the system.
                           After clicking, the system will display a message to confirm the status browsing action.
                            After clicking the “Yes” button, the post will automatically change to Violation status")}}.
                        <img src="{{ asset('assets/image/usermanual/img-11.png') }}" loading="lazy">
                    </li>
                    <li>
                         {{ __("Click the red “X” button if disagree with the Violation status of the system.
                          After clicking, the system will display a message to confirm the status browsing action.
                           After clicking the “Yes” button, the post will automatically move to the “No Violations List” and no need to go to step 2") }}.
                        <img src="{{ asset('assets/image/usermanual/img-10.png') }}" loading="lazy">
                    </li>
                </ul>
                <p><span> {{__("Step 2")}}:</span>  {{__(" Confirm type of violation by clicking any button")}}:</p>
                <img src="{{ asset('assets/image/usermanual/img-12.png') }}" loading="lazy">
                <ul class="img-ul">
                    <li>
                         {{__("Tick: If you agree with all types of violations that the system has checked.
                         After clicking the tick button, a message will show up to confirm. Click the “Yes” button,
                         the system will move this article to the list of violations")}}.
                        <img src="{{ asset('assets/image/usermanual/img-16.png') }}" loading="lazy">
                    </li>
                    <li>
                        {{__(" X: If you disagree with all types of violations that the system has checked")}}.
                    </li>
                </ul>
                <p><span> {{__("Step 3")}}:</span>  {{__(" Select the appropriate type of violation by ticking more or deleting the types of violations that the system has already ticked")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-17.png') }}" loading="lazy">
                <p><span> {{__("Step 4")}}:</span>  {{__(" Click the “Save Changes” button and the post will be moved to the “Violations List”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-13.png') }}" loading="lazy">
                <span class="border_grays"></span>
            </div>
        </div>
        <a data-id="#sl4"><button class="accordion"> {{__("State transition instructions")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl4">
            <p><span> {{__("Step 1")}}:</span>  {{__(" Select “Track Violations” on the menu bar and click “ Violations” or “Unable to detect”")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-18.png') }}" loading="lazy" style="width:100%">
            <p><span> {{__("Step 2")}}:</span> {{__(" Click the button in the “State progress” column")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-19.png') }}" loading="lazy">
            <p><span> {{__("Step 3")}}: </span> {{__(" Return to the “Violation Alert” or “Violation Check” page to moderate the article for violations from the beginning")}}.</p>
            <span class="border_grays"></span>
        </div>
        <a data-id="#sl5"><button class="accordion"> {{__("Instructions to change the progress of violation handling")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl5">
            <p><span> {{__("Step 1")}}:</span>  {{__(" Select “Track Violations” on the menu bar and click “ Violations” or “Unable to detect”")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-18.png') }}" loading="lazy" style="width:100%">
            <p><span> {{__("Step 2")}}:</span>  {{__(" Change the “Progress Status” accordingly")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-20.png') }}" loading="lazy">
            <ul>
                <li>
                    <span> {{__('Not started')}} :</span>  {{__(" This posts has not been checked and processed yet.")}}.
                </li>
                <li>
                    <span> {{__('Processing')}} :</span>  {{__(" This posts is being processed and waiting for the official document to be posted")}}.
                </li>
                <li>
                    <span> {{__('Completed')}} :</span>  {{__("The posts has been handled successfully and the handling text is published
                    (This status can only be selected when at least 1 handling text has been posted for the article")}}.
                </li>
            </ul>
            <span class="border_grays"></span>
        </div>
        <a data-id="#sl6">
            <button class="accordion">
             {{__("Instructions on how to upload violation handling documents")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
        </a>
        <div class="panel" id="sl6">
            <p><span> {{__("Step 1")}}:</span>  {{__(" Go to “Violation reviewed ” and select “Violations List” on the menu bar")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-18.png') }}" loading="lazy" style="width:100%">
            <p><span> {{__("Step 2")}}:</span>  {{__(" At “Legal documents”, click on the button with the folder image as below")}}.</p>
            <ul>
                <li> {{__("If the button color is gray, no text has been uploaded recently")}}.</li>
                <li> {{__("If the button color is red, there is at least one recently uploaded text")}}.</li>
            </ul>
            <img src="{{ asset('assets/image/usermanual/img-21.png') }}" loading="lazy" style="width:100%">
            <p><span> {{__("Step 3")}}: </span>  {{__(" Add more text by clicking the plus icon and selecting the text you want to upload")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-22.png') }}" loading="lazy" style="width:100%">
            <p><span></span>  {{__(" After the upload is successful, a message will appear at the bottom of the screen on the right.")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-23.png') }}" loading="lazy" style="width:100%">
            <p><span></span>  {{__(" Admin can check the document again by clicking on the document.")}}.</p>
            <p><span> {{__("Step 4")}}: </span>  {{__(" When the admin completes the document upload process, the folder button will turn red and update the latest document upload date")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-24.png') }}" loading="lazy" style="width:100%">
            <span class="border_grays"></span>
        </div>
        <a data-id="#sl7">
            <button class="accordion"> {{__("Instructions for viewing the detailed content of the article")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button>
        <div class="panel" id="sl7">
            <p><span> {{__("Step 1")}}:</span>  {{__(" Select the article you want to see")}}.</p>
            <p><span> {{__("Step 2")}}:</span>  {{__(" Click on the “Image” of the article")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-25.png') }}" loading="lazy">
            <p><span> {{__("Step 3")}}:</span>  {{__(" Click the arrow icon to view the images of the article in turn (if the article has many images)")}}.</p>
            <span class="border_grays"></span>
            <a data-id="#cl9">
                <button class="child-accordion"> {{__("Instructions to view the full article content")}}
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl9">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Select the article you want to see")}}.</p>
                <p><span> {{__("Step 2")}}:</span> {{__(" Click on the “Caption” of the article to see the full text of the article")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-26.png') }}" loading="lazy">
                <img src="{{ asset('assets/image/usermanual/img-27.png') }}" loading="lazy">
            </div>
            <span class="border_grays"></span>
            <a data-id="#cl10">
                <button class="child-accordion"> {{__("Instructions on how to get links from articles that Vivid has scanned")}} ?>
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl10">
                <p><span></span> {{__(" Click the icon in the link column to access the Link or right click to copy the link")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-28.png') }}" loading="lazy">
                <span class="border_grays"></span>
            </div>
        </div>
        <a data-id="#sl8"><button class="accordion"> {{__("Instructions for searching articles by keyword and test date")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl8">
            <a data-id="#cl7">
                <button class="child-accordion"> {{__("Search articles by Caption") }}
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl7">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Enter search information for example “Blackmores”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-30.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Press the Enter button and related articles with the keyword Blackmores or of the Blackmores Fanpage will be displayed below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-29.png') }}" loading="lazy">
            </div>
            <span class="border_grays"></span>
            <a data-id="#cl8">
                <button class="child-accordion"> {{__("Search articles by date of violation checker")}}
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl8">
                <p><span> {{__("Step 1")}}:</span>  {{__(" Click on the box “Please select a date”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-31.png') }}" loading="lazy">
                <p><span> {{__("Step 2")}}:</span>  {{__(" Select the desired time period")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-32.png') }}" loading="lazy">
                <p><span></span> {{__("After selecting the date the posts published in the selected time period will be displayed below")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-33.png') }}" loading="lazy">
                <span class="border_grays"></span>
            </div>
        </div>
        <a data-id="#sl9"><button class="accordion"> {{__("Instructions for arranging articles by mode")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl9">
            <p><span></span>  {{__(" Admin can sort posts by mode")}}:</p>
            <ul>
                <li> {{__("Date (posted date, audited date, processed date, craw date): In order of newest and oldest date")}}.</li>
                <li> {{__("Status (violating or not violating): In alphabetical order")}}. </li>
                <li> {{__("Brand Name: In alphabetical order")}}.</li>
            </ul>
            <p><span></span>  {{__(" Admins can sort by mode by clicking on the 2 arrow icon next to the content they want to sort posts
                                (the example below illustrates how to sort posts by newest and oldest processing date)")}}
            </p>
            <img src="{{ asset('assets/image/usermanual/img-34.png') }}" loading="lazy">
            <span class="border_grays"></span>
        </div>
        <a data-id="#sl10"><button class="accordion"> {{__("Data export instructions")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl10">
            <p><span> {{__("Step 1")}}:</span>  {{__(" Go to the page to export data (Auto-detect violations, Violation List, Unable to detect List, Submit violations upon requests)")}}.</p>
            <p><span> {{__("Step 2")}}:</span>  {{__(" Click the “Export excel” button and wait for the system to download the excel list to your computer")}}.</p>
            <p><span> {{__("Note")}}:</span> {{ __(" If you do not choose any special arrangement such as keyword content,
            time, the system will download the correct number of articles displayed directly on the Vivid page (As the picture above shows 10 articles,
            when download excel will have 10 lessons)")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-35.png') }}" loading="lazy" >
            <p><span></span>  {{__(" The downloaded Excel will have the following format ")}}: </p>
            <img src="{{ asset('assets/image/usermanual/img-36.png') }}" loading="lazy" style="width:100%">
            <span class="border_grays"></span>
        </div>
        <a data-id="#sl11"><button class="accordion"> {{__("Instructions for adding a new administrator")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl11">
            <p><span> {{__("Note")}}: </span>  {{__(" On Vivid's website, there are only 3 user objects including Operator, Supervisor and Administrator.
            Only Administrators have the right to add new admins.")}}.
            </p>
            <p><span> {{__("Step 1")}}:</span>  {{__(" Click on the “Admins management” page”")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-38.png') }}" loading="lazy">
            <p><span> {{__("Step 2")}}:</span>  {{__(" Click the “Add admin” button.")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-37.png') }}" loading="lazy" style="width:100%">
            <p><span> {{__("Step 3")}}:</span> {{ __(" Fill in the required fields including:")}}:</p>
            <ul>
                <li> {{__("Full name")}}</li>
                <li> {{__("Email address")}}</li>
                <li> {{__("Phone number")}}</li>
                <li> {{__("Pasword")}}</li>
                <li> {{__("Permissions on the website (Admin, Supervisor, Operator)")}}?></li>
            </ul>
            <img src="{{ asset('assets/image/usermanual/img-39.png') }}" loading="lazy">
            <span class="border_grays"></span>
        </div>
        </div>
</div>
<script src="{{ asset('assets/js/pages/user-manual.js') }}"></script>
@endsection
