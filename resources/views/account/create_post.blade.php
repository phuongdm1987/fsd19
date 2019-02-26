@extends('layouts.account')
@section('styles')
    <link href="{{ secure_asset('css/dropzone.css') }}" media="all" rel="stylesheet">
    <link href="{{ secure_asset('css/ghostdown.css') }}" media="all" rel="stylesheet">
    <link href="{{ secure_asset('css/jquery.tagsinput.css') }}" media="all" rel="stylesheet">
    <link href="{{ secure_asset('css/jquery.simple-dtpicker.css') }}" media="all" rel="stylesheet">
    <link href="{{ secure_asset('css/jquery-ui.min.css') }}" media="all" rel="stylesheet">
    <style>
        .ui-autocomplete {
            top: 85% !important;
            left: 30px !important;
        }
    </style>
@stop

{{-- Account page content --}}
@section('content')
    <form id="new-post" action="{{route('account.blog.store')}}" method="post">
        {{csrf_field()}}
        <input type="text" name="title" id="post_title" class="txt-box {{ $errors->has('title') ? 'has-error' : '' }}" placeholder="Tiêu đề bài viết" value="{{old('title', '')}}">
        <section class="features">
            <span id="lbl-save"><i class="fa fa-refresh fa-spin"></i> Saving...</span>
            <section class="editor {{ $errors->has('content') ? 'has-error' : '' }}">
                <div class="outer">
                    <div class="editorwrap">
                        <section class="entry-markdown">
                            <header class="editor-header"><span>Nội dung</span></header>
                            <section class="entry-markdown-content">
                                <textarea id="entry-markdown" name="content" autofocus="true">{{old('content', '')}}</textarea>
                            </section>
                        </section>
                        <section class="entry-preview active">
                            <header class="editor-header">
                                <span>Xem trước</span>
                                <span class="pull-right entry-word-count">0 words</span>
                            </header>
                            <section class="entry-preview-content">
                                <div class="rendered-markdown"></div>
                            </section>
                        </section>
                    </div>
                </div>
                <div class="editor-footer row">
                    <div class="btn-group dropup pull-right">
                        <button id="btn-submit-post" type="submit" class="btn btn-danger btn-sm">Lưu nháp</button>
                        <button id="btn-toggle-status" type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Chọn hình thức đăng bài</span>
                        </button>
                        <ul id="lst-post-status" class="dropdown-menu" role="menu">
                            <li><a data-status="0" href="#">Lưu nháp</a></li>
                            <li><a data-status="1" href="#">Đăng bài</a></li>
                        </ul>
                        <input type="hidden" value="0" id="post_active" name="post_active">
                    </div>
                    <div class="col-sm-2 pull-right">
                        <select name="category_id" id="" class="form-control">
                            <option value="">-- Chọn danh mục --</option>
                            {!! $selectBoxCategories !!}
                        </select>
                    </div>
                    <div class="pull-right">
                        <a class="footer-setting" href="#"><i class="fa fa-wrench"></i></a>
                    </div>
                    <div id="sg-post-tags">
                        <i class="fa fa-tags pull-left"></i> <input name="post_tags" id="tags" value="" />
                    </div>
                </div>
            </section>
        </section>
    </form>
@stop

@section('scripts')
    <script src="{{ secure_asset('js/dropzone.js') }}"></script>
    <script src="{{ secure_asset('js/ghostdown.js') }}"></script>
    <script src="{{ secure_asset('js/jquery.tagsinput.js') }}"></script>
    <script type='text/javascript' src="{{ secure_asset('js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ secure_asset('js/jquery.simple-dtpicker.js') }}"></script>
    <script>
        $(function() {
            var timing;
            var urlEdit    = window.location.href;
            var postLocal  = JSON.parse(localStorage.getItem('post'));

            $('.date-timer').appendDtpicker();

            $('#tags').tagsInput({
                autocomplete_url: '/ajax/tags/suggest',
                autocomplete:{selectFirst:true, width:'100px', autoFill:true},
                height: "31px",
                width: "500px",
                defaultText: "Thêm tag",
                placeholderColor: "#999"
            });

            $("#lst-post-status a").click(function() {
                var _status = $(this).data("status");

                if (_status == 1) {
                    $("#btn-submit-post, #btn-toggle-status").removeClass("btn-danger").addClass("btn-primary");
                } else {
                    $("#btn-submit-post, #btn-toggle-status").removeClass("btn-primary").addClass("btn-danger");
                }

                $("#btn-submit-post").text($(this).text());
                $("#post_active").val(_status);
            });

            fsdEditor.on('keyup', function() {
                clearTimeout(timing);
                timing = setTimeout(function() {
                    var postTitle   = $('#post_title').val();
                    var postContent = fsdEditor.getValue();

                    if (postContent != '') {
                        $('#lbl-save').fadeIn();
                        var postTemp = {
                            title: postTitle,
                            url: urlEdit,
                            content: postContent
                        };
                        localStorage.setItem('post', JSON.stringify(postTemp));
                        $('#lbl-save').fadeOut(1000);
                    }
                }, 5000);
            });

            $("#btn-submit-post").click(function(ev) {
                ev.preventDefault();
                if ($("#post_title").val() == "") {
                    alert("Bạn chưa nhập tiêu đề bài viết");
                    $("#post_title").focus();
                    return false;
                }
                $("#new-post").submit();
            });

            // Clear localStorage when user submit form
            //
            $('#new-post').submit(function() {
                localStorage.removeItem('post');
                $(window).off('beforeunload');
            });

            // Event beforeunload when haven't finished post
            //
            $(window).on('beforeunload', function(){
                if ($('#post_title').val() != "" && fsdEditor.getValue() != "") {
                    return 'Bạn có một bài viết chưa hoàn thành. Bạn có muốn ở lại trang để kết thúc bài viết?';
                }
            });

            // Fill old data from localStorage
            //
            if ( postLocal != null) {
                if (confirm("Bài viết cũ của bạn chưa hoàn thành, bạn có muốn tiếp tục không?")) {
                    $("#post_title").val(postLocal.title);
                    fsdEditor.setValue(postLocal.content);
                } else {
                    localStorage.removeItem('post');
                }
                return;
            }
        });
    </script>
@stop
