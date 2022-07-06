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
        <a href="#sl1"><button class="accordion"> {{ __('Hướng dẫn cách kiểm tra vi phạm') }} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl1">
            <a href="#cl1"><button class="child-accordion"><?= __("Hướng dẫn cách kiểm tra vi phạm bằng Hình ảnh hoặc Văn bản") ?>
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id="cl1">
                <p><span>{{ __('Bước 1 ') }}:</span>  {{__("Truy cập trang 'Kiểm tra vi phạm' trên thanh menu")}}.</p>
                <p><span> {{__("Bước 2 ")}}:</span>  {{__("Nhập nội dung của bạn bằng văn bản hoặc tải ảnh lên máy tính của bạn")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-1.png') }}" loading="lazy">
                <p><span> {{__("Bước 3")}}: </span>  {{__("Nhấp vào nút 'Kiểm tra' để kiểm tra các vi phạm nội dung của bạn")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-2.png') }}" loading="lazy">
                <p><span></span>  {{__("Sau khi hệ thống kiểm tra vi phạm, quản trị viên có thể xem lại kết quả bên dưới")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-3.png') }}" loading="lazy">
            </div>
            <a href="#cl2"><button class="child-accordion"> {{__("Hướng dẫn kiểm tra vi phạm bằng đường dẫn")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id="cl2">
                <p><span>{{ __('Bước 1 ') }}:</span>  {{__("Truy cập trang 'Kiểm tra vi phạm' trên thanh menu")}}.</p>
                <p><span>{{__("Bước 2 ")}}:</span>  {{__("Nhập nội dung của bạn bằng cách dán đường dẫn của website hoặc hình ảnh, bài viết trên Fanpage thuộc")}}
                <a href="https://drive.google.com/file/d/187v4IYal9WiQPI1GmmHGFWZ2yDD8jw1B/view">  {{__("danh sách ")}} </a>
                 {{__("này")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-4.png') }}" loading="lazy">
                <p><span>{{__("Bước 3")}}: </span>  {{__("Nhấp vào nút 'Kiểm tra' để kiểm tra các vi phạm nội dung của bạn")}} .</p>
                <img src="{{ asset('assets/image/usermanual/img-2.png') }}" loading="lazy">
                <p><span></span>  {{__("Sau khi hệ thống kiểm tra vi phạm, quản trị viên có thể xem lại kết quả bên dưới")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-3.png') }}" loading="lazy">
            </div>
        </div>
        <a href="#sl2">
            <button class="accordion"> {{__("Hướng dẫn lấy đường dẫn hợp lệ để kiểm tra vi phạm theo yêu cầu")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
        </a>
        <div class="panel" id="sl2">
            <a href="#cl3"><button class="child-accordion"> {{__("Đường dẫn trang website hợp lệ")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id="cl3">
                <p><span></span> {{__("Bất kỳ liên kết nào có cùng tên miền trong trang web")}}
                <a href="https://drive.google.com/file/d/187v4IYal9WiQPI1GmmHGFWZ2yDD8jw1B/view">  {{__("danh sách ")}} </a>  {{__("này")}},  {{__("ví dụ")}}:</p>
                <p><span></span><a href="https://www.nestlemomandme.vn/">www.nestlemomandme.vn</a>  {{__("hoặc")}} <a href=" https://www.nestlemomandme.vn/cerelac"> www.nestlemomandme.vn/cerelac</a>.</p>
            </div>
            <a href="#cl4">
            <button class="child-accordion"> {{__("Cách lấy đường dẫn hợp lệ trên Fanpage")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id="cl4">
                <p><span></span> <strong> {{__("Cách lấy đường dẫn hợp lệ của một bài đăng trên Fanpage")}}.</strong></p>
                <p><span> {{__("Bước 1")}}:</span>  {{__("Truy cập Fanpage có sẵn trên danh sách Fanpage đã được cung cấp")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-5.png') }}" loading="lazy">
                <p><span> {{__("Bước 2")}}:</span> {{__("Chọn bài đăng bạn muốn kiểm tra vi phạm")}}.</p>
                <p><span> {{__("Bước 3")}}: </span>  {{__("Nhấp chuột phải vào dòng thời gian bên dưới tên Fanpage")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-6.png') }}" loading="lazy">
                <p><span> {{__("Bước 4")}}: </span>  {{__(" Nhấp vào mở liên kết trong tab mới hoặc cửa sổ mới và bạn sẽ được điều hướng sang bài viết")}}.</p>
                <p><span> {{__("Bước 5")}}: </span>  {{__("Sau khi trang web đã tải xong, sao chép đường dẫn ngắn với cấu trúc như hình bên dưới và quay trở lại trang website Vivid để kiểm tra")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-7.png') }}" loading="lazy">
                <p><span> {{__("Bước 6")}}: </span>  {{__("Nhấn Ctrl V hoặc nhấp vào icon bên dưới để dán đường dẫn vừa sao chép vào phần kiểm tra vi phạm")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-8.png') }}" loading="lazy">
                <p><span> {{__("Bước 7")}}: </span>  {{__("Nhấp vào nút 'Kiểm tra' để kiểm tra các vi phạm nội dung của bạn")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-2.png') }}" loading="lazy">
                <p><span></span>  {{__("Sau khi hệ thống kiểm tra vi phạm, quản trị viên có thể xem lại kết quả bên dưới")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-3.png') }}" loading="lazy">
                <p><span></span> <strong> {{__("Cách lấy đường dẫn hợp lệ một hình ảnh trên Fanpage")}}</strong></p>
                <p><span> {{__("Bước 1")}}:</span>  {{__("Truy cập Fanpage có sẵn trên danh sách Fanpage đã được cung cấp")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-5.png') }}" loading="lazy">
                <p><span> {{__("Bước 2")}}:</span>  {{__("Nhấp hình ảnh bạn muốn kiểm tra vi phạm và sao chép đường dẫn như hình bên dưới")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-41.png') }}" loading="lazy">
                <p><span> {{__("Bước 3")}}: </span>  {{__("Quay trở về trang Vivid ở phần kiểm tra bằng đường dẫn, Nhấn Ctrl V hoặc nhấp vào icon bên dưới để dán đường dẫn vừa sao chép vào phần kiểm tra vi phạm")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-8.png') }}" loading="lazy">
                <p><span> {{__("Bước 4")}}: </span>  {{__("Nhấp vào nút 'Kiểm tra' để kiểm tra các vi phạm nội dung của bạn")}} .</p>
                <img src="{{ asset('assets/image/usermanual/img-2.png') }}" loading="lazy">
                <p><span></span>  {{__("Sau khi hệ thống kiểm tra vi phạm, quản trị viên có thể xem lại kết quả bên dưới")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-3.png') }}" loading="lazy">
            </div>
        </div>
        <a href="#sl3"><button class="accordion "> {{__("Hướng dẫn kiểm duyệt vi phạm")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl3">
            <p> {{__("Trang website Vivid cho phép kiểm duyệt vi phạm ở 2 trang")}}:</p>
            <ul>
                <li> {{__("Cảnh báo vi phạm (máy tự quét và trả về tình trạng nghi vấn nghi phạm)")}}</li>
                <li> {{__("Kiểm tra vi phạm (người dùng tự quét và máy kiểm tra tình trạng nghi vấn nghi phạm)")}}</li>
            </ul>
            <a href="#cl5">
            <button class="child-accordion"> {{__("Kiểm duyệt bài viết mà Vivid dự đoán là 'Không vi phạm'") }}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
            </a>
            <div class="add" id=cl5>
                <img src="{{ asset('assets/image/usermanual/img-9.png') }}" loading="lazy">
                <p><span> {{__("Bước 1")}}:</span>  {{__("Xác nhận trạng thái của bài viết")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-12.png') }}" loading="lazy">
                <ul class="img-ul">
                    <li>
                         {__("Nhấp vào nút “tick” màu xanh nếu đồng ý với trạng thái Không vi phạm của hệ thống. Sau khi nhấp vào hệ thống sẽ hiển thị một thông báo để xác nhận
                         lại hành động duyệt trạng thái. Sau khi nhấp vào nút “Có” bài viết sẽ tự động chuyển sang danh sách Không vi phạm và không cần qua bước 2")}.
                        <img src="{{ asset('assets/image/usermanual/img-10.png') }}" loading="lazy">
                    </li>
                    <li>
                         {{__("Nhấp vào nút “X” màu đỏ nếu không đồng ý với trạng thái Không vi phạm của hệ thống. Sau khi nhấp vào hệ thống sẽ hiển thị một
                          thông báo để xác nhận lại hành động duyệt trạng thái. Sau khi nhấp vào nút “Có” bài viết sẽ tự động chuyển trạng thái Vi phạm")}}.
                        <img src="{{ asset('assets/image/usermanual/img-11.png') }}" loading="lazy">
                    </li>
                </ul>
                <p><span> {{__("Bước 2")}}:</span>  {{__("Xác nhận loại vi phạm bằng cách nhấp vào bất kỳ nút X và Tick để chọn loại vi phạm cho bài viết")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-15.png') }}" loading="lazy">
                <p><span> {{__("Bước 3")}}:</span>  {{__("Chọn loại vi phạm phù hợp")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-14.png') }}" loading="lazy">
                <p><span> {{__("Bước 4")}}:</span>  {{__("Nhấp vào nút “Lưu thay đổi”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-40.png') }}" loading="lazy">
            </div>
            <a href="#cl6">
                <button class="child-accordion">
                     {{ __("Kiểm duyệt bài viết mà Vivid dự đoán là “Vi phạm“") }}  <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl6">
                <img src="{{ asset('assets/image/usermanual/img-42.png') }}" loading="lazy">
                <p><span> {{__("Bước 1")}}:</span>  {{__("Xác nhận trạng thái của bài viết")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-15.png') }}" loading="lazy">
                <ul class="img-ul">
                    <li>
                          {{__("Nhấp vào nút “tick” màu xanh nếu đồng ý với trạng thái Vi phạm của hệ thống. Sau khi nhấp vào hệ thống sẽ
                          hiển thị một thông báo để xác nhận lại hành động duyệt trạng thái. Sau khi nhấp vào nút “Có” bài viết sẽ tự động chuyển trạng thái Vi phạm")}}.
                        <img src="{{ asset('assets/image/usermanual/img-11.png') }}" loading="lazy">
                    </li>
                    <li>
                         {{__("Nhấp vào nút “X” màu đỏ nếu không đồng ý với trạng thái Vi phạm của hệ thống. Sau khi nhấp vào hệ thống
                         sẽ hiển thị một thông báo để xác nhận lại hành động duyệt trạng thái. Sau khi nhấp vào nút “Có” bài viết sẽ
                         tự động chuyển sang “Danh sách không vi phạm” và không cần sang bước 2")}}.
                        <img src="{{ asset('assets/image/usermanual/img-10.png') }}" loading="lazy">
                    </li>
                </ul>
                <p><span> {{__("Bước 2")}}:</span>  {{__("Xác nhận loại vi phạm bằng cách nhấp vào bất kỳ nút")}}:</p>
                <img src="{{ asset('assets/image/usermanual/img-12.png') }}" loading="lazy">
                <ul class="img-ul">
                    <li>
                         {{__("Tick: Nếu đồng ý với tất cả loại vi phạm mà hệ thống đã kiểm tra được. Sau khi nhấp vào nút tick,
                        một thông báo sẽ hiển thị lên để xác nhận.Nhấp vào nút “Có”, hệ thống sẽ chuyển bài viết này sang danh sách vi phạm")}}.
                        <img src="{{ asset('assets/image/usermanual/img-16.png') }}" loading="lazy">
                    </li>
                    <li>
                        {{__(" X: Nếu không đồng ý với tất cả loại vi phạm mà hệ thống đã kiểm tra được")}}.
                    </li>
                </ul>
                <p><span> {{__("Bước 3")}}:</span>  {{__("Chọn loại vi phạm phù hợp bằng cách tick thêm hoặc xóa những loại vi phạm mà hệ thống đã tick sẵn")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-17.png') }}" loading="lazy">
                <p><span> {{__("Bước 4")}}:</span>  {{__("Nhấp vào nút “Lưu thay đổi” và bài viết sẽ được chuyển sang “Danh sách vi phạm”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-13.png') }}" loading="lazy">
            </div>
        </div>
        <a href="#sl4"><button class="accordion"> {{__("Hướng dẫn chuyển đổi trạng thái")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl4">
            <p><span> {{__("Bước 1")}}:</span>  {{__("Chọn “Theo dõi vi phạm” trên thanh menu và nhấp vào “Danh sách vi phạm” hoặc “Danh sách không vi phạm”")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-18.png') }}" loading="lazy" style="width:100%">
            <p><span> {{__("Bước 2")}}:</span> {{__("Nhấp vào nút ở cột “Chuyển đổi trạng thái”")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-19.png') }}" loading="lazy">
            <p><span> {{__("Bước 3")}}: </span> {{__("Quay trở về trang “Cảnh báo vi phạm” hoặc “Kiểm tra vi phạm” để kiểm duyệt vi phạm bài viết lại từ đầu")}}.</p>
        </div>
        <a href="#sl5"><button class="accordion"> {{__("Hướng dẫn thay đổi tiến độ xử lý vi phạm")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl5">
            <p><span> {{__("Bước 1")}}:</span>  {{__("Chọn “Theo dõi vi phạm” trên thanh menu và nhấp vào “Danh sách vi phạm” hoặc “Danh sách không vi phạm”")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-18.png') }}" loading="lazy" style="width:100%">
            <p><span> {{__("Bước 2")}}:</span>  {{__("Thay đổi “Tiến độ trạng thái” phù hợp")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-20.png') }}" loading="lazy">
            <ul>
                <li>
                    <span> {{__('Chưa bắt đầu')}} :</span>  {{__("Bài viết này vẫn chưa được kiểm tra và xử lý")}}.
                </li>
                <li>
                    <span> {{__('Đang xử lý')}} :</span>  {{__("Bài viết này đang được xử lý và chờ đăng tải văn bản xử lý chính thức")}}.
                </li>
                <li>
                    <span> {{__('Hoàn thành')}} :</span>  {{__("Đã xử lý vi phạm bài viết thành công và công khai văn bản xử lý
                    (Chỉ có thể chọn trạng thái này khi đã đăng tải ít nhất 1 văn bản xử lý cho bài viết)")}}.
                </li>
            </ul>
        </div>
        <a href="#sl6">
            <button class="accordion">
             {{__("Hướng dẫn cách tải các văn bản xử lý vi phạm")}}
            <img src="{{ asset('assets/image/plus.svg') }}" alt="">
            </button>
        </a>
        <div class="panel" id="sl6">
            <p><span> {{__("Bước 1")}}:</span>  {{__("Truy cập “Theo dõi vi phạm” và chọn “Danh sách vi phạm” trên thanh menu")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-18.png') }}" loading="lazy" style="width:100%">
            <p><span> {{__("Bước 2")}}:</span>  {{__("Tại “Văn bản xử lý”, bấm vào nút có hình thư mục như bên dưới")}}.</p>
            <ul>
                <li> {{__("Nếu màu nút là xám, không có văn bản nào được tải lên gần đây")}}.</li>
                <li> {{__("Nếu màu nút là đỏ, có ít nhất một văn bản được tải lên gần đây")}}.</li>
            </ul>
            <img src="{{ asset('assets/image/usermanual/img-21.png') }}" loading="lazy" style="width:100%">
            <p><span> {{__("Bước 3")}}: </span>  {{__("Thêm văn bản khác bằng cách nhấp vào biểu tượng dấu cộng và chọn văn bản bạn muốn tải lên")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-22.png') }}" loading="lazy" style="width:100%">
            <p><span></span>  {{__("Sau khi tải lên thành công, một thông báo sẽ xuất hiện ở cuối màn hình bên phải")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-23.png') }}" loading="lazy" style="width:100%">
            <p><span></span>  {{__("Quản trị viên có thể kiểm tra lại tài liệu bằng cách nhấp vào tài liệu")}}.</p>
            <p><span> {{__("Bước 4")}}: </span>  {{__("Khi quản trị viên hoàn tất quá trình tải tài liệu lên, nút thư mục sẽ chuyển sang màu đỏ và cập nhật ngày tải tài liệu mới nhất")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-24.png') }}" loading="lazy" style="width:100%">
        </div>
        <a href="#sl7">
            <button class="accordion"> {{__("Hướng dẫn xem nội dung chi tiết của bài viết")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button>
        <div class="panel" id="sl7">
            <p><span> {{__("Bước 1")}}:</span>  {{__("Chọn bài viết cần xem")}}.</p>
            <p><span> {{__("Bước 2")}}:</span>  {{__("Nhấp vào “Hình ảnh” của bài viết")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-25.png') }}" loading="lazy">
            <p><span> {{__("Bước 3")}}:</span>  {{__("Nhấp vào icon mũi tên để xem lần lượt các hình ảnh của bài viết (nếu bài viết có nhiều ảnh)")}}.</p>
            <a href="#cl9">
                <button class="child-accordion"> {{__("Hướng dẫn xem đầy đủ nội dung bài viết")}}
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl9">
                <p><span> {{__("Bước 1")}}:</span>  {{__("Chọn bài viết cần xem")}}.</p>
                <p><span> {{__("Bước 2")}}:</span> {{__("Nhấp vào “Nội dung” của bài viết để xem nội dung đầy đủ của bài viết")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-26.png') }}" loading="lazy">
                <img src="{{ asset('assets/image/usermanual/img-27.png') }}" loading="lazy">
            </div>
            <a href="#cl10">
                <button class="child-accordion"> {{__("Hướng dẫn cách lấy đường dẫn từ bài viết mà Vivid đã quét")}} ?>
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl10">
                <p><span></span> {{__("Nhấp vào icon ở cột đường link để truy cập vào đường dẫn hoặc nhấp chuột phải để sao chép đường dẫn")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-28.png') }}" loading="lazy">
            </div>
        </div>
        <a href="#sl8"><button class="accordion"> {{__("Hướng dẫn tìm kiếm bài viết theo từ khóa và ngày kiểm tra")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl8">
            <a href="#cl7">
                <button class="child-accordion"> {{__("Tìm kiếm bài viết theo nội dung") }}
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl7">
                <p><span> {{__("Bước 1")}}:</span>  {{__("Nhập thông tin tìm kiếm ví dụ “Blackmores”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-30.png') }}" loading="lazy">
                <p><span> {{__("Bước 2")}}:</span>  {{__("Nhấn nút Enter và các bài viết liên quan có từ khóa Blackmores hoặc của Fanpage Blackmores sẽ hiển thị ở bên dưới")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-29.png') }}" loading="lazy">
            </div>
            <a href="#cl8">
                <button class="child-accordion"> {{__("Tìm kiếm bài viết theo ngày máy kiểm tra vi phạm")}}
                <img src="{{ asset('assets/image/plus.svg') }}" alt="">
                </button>
            </a>
            <div class="add" id="cl8">
                <p><span> {{__("Bước 1")}}:</span>  {{__("Nhấp vào khung “Bạn vui lòng chọn ngày”")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-31.png') }}" loading="lazy">
                <p><span> {{__("Bước 2")}}:</span>  {{__("Chọn khoảng thời gian mong muốn")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-32.png') }}" loading="lazy">
                <p><span></span> {{__("Sau khi chọn ngày những bài đăng được đăng tải trong khoảng thời gian được chọn sẽ được hiển thị bên dưới")}}.</p>
                <img src="{{ asset('assets/image/usermanual/img-33.png') }}" loading="lazy">
            </div>
        </div>
        <a href="#sl9"><button class="accordion"> {{__("Hướng dẫn sắp xếp các bài viết theo từng chế độ")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl9">
            <p><span></span>  {{__("Quản trị viên có thể sắp xếp các bài viết theo chế độ")}}:</p>
            <ul>
                <li> {{__("Ngày (ngày đăng, ngày kiểm tra, ngày xử lý, ngày quét): Theo thứ tự ngày mới nhất và cũ nhất")}}.</li>
                <li> {{__("Trạng thái (vi phạm hoặc không vi phạm): Theo thứ tự Alphabet")}}. </li>
                <li> {{__("Tên hãng: Theo thứ tự Alphabet")}}.</li>
            </ul>
            <p><span></span>  {{__("Quản trị viên có thể sắp xếp theo chế độ bằng cách nhấp vào icon 2 mũi tên bên cạnh nội dung mình muốn sắp xếp bài
                                viết (ví dụ bên dưới minh họa cho sắp xếp bài viết theo ngày xử lý mới nhất và cũ nhất)")}}
            </p>
            <img src="{{ asset('assets/image/usermanual/img-34.png') }}" loading="lazy">
        </div>
        <a href="#sl10"><button class="accordion"> {{__("Hướng dẫn xuất dữ liệu")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl10">
            <p><span> {{__("Bước 1")}}:</span>  {{__("Truy cập vào trang cần xuất dữ liệu (Cảnh báo vi phạm, Danh sách vi phạm, Danh sách không vi phạm, Kiểm tra vi phạm)")}}.</p>
            <p><span> {{__("Bước 2")}}:</span>  {{__("Nhấp vào nút “Xuất excel” và đợi hệ thống tải danh sách excel về máy")}}.</p>
            <p><span> {{__("Lưu ý")}}:</span> {{ __("Nếu không chọn bất kỳ cách sắp xếp nào đặc biệt như nội dung từ khóa, thời gian thì hệ thống sẽ
            tải xuống đúng số lượng bài viết đang hiển thị trực tiếp trên trang Vivid (Như hình ở trên đang hiển thị 10 bài thì khi tải về excel sẽ có 10 bài)")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-35.png') }}" loading="lazy" >
            <p><span></span>  {{__("Excel tải về sẽ có format như sau")}}: </p>
            <img src="{{ asset('assets/image/usermanual/img-36.png') }}" loading="lazy" style="width:100%">
        </div>
        <a href="#sl11"><button class="accordion"> {{__("Hướng dẫn thêm quản trị viên mới")}} <img src="{{ asset('assets/image/plus.svg') }}" alt=""></button></a>
        <div class="panel" id="sl11">
            <p><span> {{__("Lưu ý")}}: </span>  {__("Trên trang website của Vivid chỉ có 3 đối tượng người dùng gồm Nhà điều hành,
            Nhà giám sát và Quản trị viên. Chỉ có Quản trị viên mới có quyền thêm quản trị viên mới")}.
            </p>
            <p><span> {{__("Bước 1")}}:</span>  {{__("Nhấp vào trang “Quản lý admin”")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-38.png') }}" loading="lazy">
            <p><span> {{__("Bước 2")}}:</span>  {{__("Nhấp vào nút “Thêm admin”")}}.</p>
            <img src="{{ asset('assets/image/usermanual/img-37.png') }}" loading="lazy" style="width:100%">
            <p><span> {{__("Bước 3")}}:</span> {{ __("Điền các trường thông tin bắt buộc bao gồm")}}:</p>
            <ul>
                <li> {{__("Họ và tên")}}</li>
                <li> {{__("Địa chỉ email")}}</li>
                <li> {{__("Số điện thoại")}}</li>
                <li> {{__("Mật khẩu")}}</li>
                <li> {{__("Quyền trên website (Admin, Giám sát, Điều hành)")}}?></li>
            </ul>
            <img src="{{ asset('assets/image/usermanual/img-39.png') }}" loading="lazy">
        </div>
        </div>
</div>
<script src="{{ asset('assets/js/pages/user-manual.js') }}"></script>
@endsection
