@extends('layouts.index')
@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-4" style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;margin:auto;height: 100px;">
                {!! Form::open(['url'=>'convert']) !!}
                        <!--- Url Field --->
                <div class="form-group">
                    {!! Form::label('url', 'Url:',array('class'=>'sr-only')) !!}
                    <div class='input-group'>
                        {!! Form::text('url', null, ['class' => 'form-control','placeholder'=>'请输入需要转换的网址']) !!}
                        <span class="input-group-btn"><button class="btn btn-primary" type="submit"><span
                                        class="glyphicon glyphicon-refresh"></span> 转换
                            </button></span>
                    </div>
                </div>
                {!! Form::close() !!}

                @if(Session::has('url'))
                    <div>
                        <table class="table table-bordered">
                            <tr>
                                <td style="width: 10%;height: 60px;vertical-align: middle">原网址</td>
                                <td style="vertical-align: middle">{{Session::get('original_url')}}</td>
                            </tr>
                            <tr>
                                <td style="height: 60px;vertical-align: middle">短网址</td>
                                <td style="vertical-align: middle"><span
                                            id="short">{{url('/').'/'.Session::get('url')}}</span>
                                    <button id="copy-button" class="btn btn-primary btn-sm" style="margin-left:10px;"><span
                                                class="glyphicon glyphicon-copy"></span> 复制
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                @endif

                @if($errors->any())
                    <div>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{$errors->all()[0]}}
                        </div>
                    </div>
                @elseif(Session::has('nodata'))
                    <div>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{Session::get('nodata')}}
                        </div>
                    </div>
                @endif

                <p class="text-center" style="font-size:11px;color:#666666">Powered by <a href="http://www.junorz.com">Junorz.com</a></p>
            </div>



        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            //配置ZeroClipboard.swf
            ZeroClipboard.config({
                swfPath: 'js/ZeroClipboard.swf'
            });

            //初始化
            var client = new ZeroClipboard(document.getElementById("copy-button"));

            client.on("ready", function (readyEvent) {
                client.on("copy", function (event) {
                    var clipboard = event.clipboardData;
                    var copyText = document.getElementById('short').innerHTML;
                    clipboard.setData("text/plain", copyText); // 将内容添加到剪切板
                });
            });
        })
    </script>
@endsection