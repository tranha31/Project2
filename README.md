# 💻 Phần mềm tăng độ phân giải ảnh

⚠️ Một số phần mềm, tool cần thiết để sử dụng trong project: <br>
<br>- Server:+<a href="https://www.apachefriends.org/index.html"> XAMPP Apache</a>
<br>- DBS:+<a href="https://www.apachefriends.org/index.html"> XAMPP MySQL</a>


# 🛠️ Cách cài đặt: 

2️⃣ Mở project:
<br>- Clone thư mục trong thư mục htdocs của xampp

3️⃣ Mở Server xampp:
<br>- Khởi động xampp, bật Apache và MySQL (nếu có xung đột cổng thì phải config <a href ="https://techbrij.com/setting-up-xampp-apache-iis-windows">  Error: Can't start Apache</a>).
<br>

4️⃣ Cấu hình mail server:

<br> 👉xampp/sendmail/sendmail.ini
<br>tìm và sửa lại như sau, nếu cái nào đang bị comment thì mở comment ra và sửa:

<br>[sendmail]
<br>smtp_server=smtp.gmail.com
<br>smtp_port=587
<br>smtp_ssl=auto
<br>error_logfile=error.log
<br>debug_logfile=debug.log
<br>auth_username=nhom8cnw@gmail.com
<br>auth_password=gybxxnsbmxshbife
<br>force_sender=nhom8cnw@gmail.com
<br>Lưu lại✔️

<br> 👉xampp/php/php.ini
<br>tìm và sửa lại như sau, nếu cái nào đang bị comment thì mở comment ra và sửa:

<br>[mail function]
<br>SMTP=smtp.gmail.com
<br>smtp_port=587
<br>sendmail_from=nhom8cnw@gmail.com
<br>sendmail_path="\"C:\xampp\sendmail\sendmail.exe\" -t"
<br>Lưu lại✔️

<br>Chạy lại Apache Xampp

5️⃣ Tạo Database:
<br>- Khởi động <b>phpMyAdmin</b> Tạo cơ sở dữ liệu <b>picture_social</b>:
<br>


6️⃣ Thêm Data:
<br>- Copy nội dung file <b><i>picture_social.sql</i></b> rồi chạy trong phần SQL của <b>phpMyAdmin</b>, ấn <b>GO</b> để tạo bảng và dữ liệu cho database:
<br>

7️⃣ Run Web Application

<br>- Chạy Apache và MySQL của Xampp
<br>- Chạy trực tiếp trên trình duyệt: http://localhost/Project2/Code/Home.php
<br>- Để sử dụng chức năng tăng độ phân giải ảnh xem trong link sau: https://github.com/Cris-Nguyen/SRResNet-SISR
<br>- Cài đặt theo hướng dẫn, chạy file api.py
<br>- Tốc độ xử lý ảnh phụ thuộc vào cấu hình máy, nên hãy cân nhắc trước khi xử lý 1 ảnh kích thước lớn. Lời khuyên: Hãy dùng google colab để test.




