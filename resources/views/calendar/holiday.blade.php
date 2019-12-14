<!-- /views/layout.blade.phpを継承 -->
@extends('layout')

<!-- sectionはyieldに追加される -->
@section('title', '休日設定')
@section('content')
<a href="{{ url('/') }}">カレンダーに戻る</a>
    <!-- エラー文表示 -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- 休日入力フォーム -->
    <form method="POST" action="/holiday">
        <div class="form-group">
            {{csrf_field()}}
            <label for="day">日付[YYYY/MM/DD] </label>
            <input type="text" name="day" class="form-control" id="day" value="{{$data->day}}">
            <label for="description">説明</label>
            <input type="text" name="description" class="form-control" id="description" value="{{$data->description}}"> 
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
        <input type="hidden" name="id" value="{{$data->id}}">
    </form> 
    <!-- 休日一覧表示 -->
    <table class="table">
    <thead>
    <tr>
        <th scope="col">日付</th>
        <th scope="col">説明</th>
        <th scope="col">作成日</th>
        <th scope="col">更新日</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $val)
    <tr>
        <th scope="row">
            <a href="{{ url('/holiday/'.$val->id) }}">
                {{$val->day}}
            </a>
        </th>
        <td>{{$val->description}}</td>
        <td>{{$val->created_at}}</td>
        <td>{{$val->updated_at}}</td>
        <td>
            <form action="/holiday" method="post">
                <input type="hidden" name="id" value="{{$val->id}}">
                <!-- ヘルパー関数 -->
                {{method_field('delete')}}
                {{csrf_field()}}
                <button class="btn btn-default" type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
    </table>
@endsection

<script>
// ポップアップカレンダーから選択して日付入力できる
// datepicker(): 高性能カレンダー表示・作成
//onload(): ページが読み込まれた後にjquaryを実行 JSコマンド
//dateFormat(オプション, フォーマット)
window.onload = function() {
    $( "#day" ).datepicker({dateFormat: 'yy-mm-dd'});
};

window.onload = function() {
    $( "#day" ).datepicker({
        monthNames: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"]
    });
};
</script>