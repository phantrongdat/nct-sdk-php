# Nhạc Của Tui API SDK PHP
Bộ API cung cấp các hàm api của NCT để get dễ nhất.<br>
Bộ SDK ko có hướng dẫn và các bạn tự tìm hiểu. Khó quá thì bỏ :)))

<h1><strong> Bắt Đầu </strong></h1>

Trước hết để sử dụng SDK bạn cần phải chạy trên PHP phiên bản 5.2 hoặc mới hơn và có hỗ trợ CURL
<br>

Clone thư viện qua Composer
<br>
<code> composer require phuchptty/nct-sdk-php <code>
<br>

Trước tiên bạn cần Import thư viện SDK <br>
<code>
  require("nct.sdk.php");
</code>

Tiếp theo là gọi đến class NCT<br>
<code>
  $nct = new NCT;
</code>

<hr>
<h1><strong> Danh Sách Hàm Hỗ Trợ </strong></h1>

<table>
<tr>
  <th>Tên Hàm</th>
  <th>Công Dụng</th>
  <th>Tham Số </th>
</tr>

<tr>
  <td>getSongID</td>
  <td>Lấy ID bài hát qua KEY bài</td>
  <td> $key_bai_hat </td>
</tr>
</table>
