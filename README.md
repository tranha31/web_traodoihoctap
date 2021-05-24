# 💻 Phần mềm hỗ trợ trao đổi học tập trực tuyến

⚠️ Một số phần mềm, tool cần thiết để sử dụng trong project: <br>
<br>- IDE:+<a href="https://www.eclipse.org/pd/"> Eclipse-PHP-2020-06-R </a>
<br>- Server:+<a href="https://www.apachefriends.org/index.html"> XAMPP Apache</a>
<br>- DBS:+<a href="https://www.apachefriends.org/index.html"> XAMPP MySQL</a>
<br>- VCS:+<a href="https://gitlab.com/"> GitLab </a> +<a href ="https://git-scm.com/downloads"> Git </a> <br>


# 🛠️ Cách cài đặt: 
1️⃣ Clone Project từ <a href="https://gitlab.com/"> GitLab </a>:
<br>- Clone repository về bằng cách click vào nút code màu xanh, chọn dowload zip, tải về rồi giải nén.
<br>
![image](https://gitlab.com/tronghaitoank25/images_icons/-/raw/master/WebProject_ReadmeImages/CloneWeb.PNG)
<br>- Ở đây cho phép <b>Clone with SSH</b> và <b>Clone with HTTPS</b> nhưng ưu tiên SSH vì đảm bảo an toàn hơn so với HTTPS.
<br>- Chọn vào folder <b>C:\xampp\htdocs</b> trong máy, click chuột phải và chọn <i>Git bash here</i>, sau đó gõ dòng lệnh trong dấu nháy kép sau đây vào màn hình console:
<br> 👉 "git clone git@gitlab.com:soict-it4409/20202/nhom08/web_traodoihoctap.git"
<br>
![image](https://gitlab.com/tronghaitoank25/images_icons/-/raw/master/WebProject_ReadmeImages/CLONE_SSH.PNG)
<br> - Dùng mật khẩu có được khi tạo bằng  click chuột phải và chọn <i>Git GUI here</i> để đăng nhập.
<br> - Khi nào màn hình console nhìn như này là xong:
<br>
![image](https://gitlab.com/tronghaitoank25/images_icons/-/raw/master/WebProject_ReadmeImages/Successful_Clone.PNG)
<br> ⚠️ Để mở màn hình console của git như trên thì trước tiên máy của bạn phải có <a href ="https://git-scm.com/downloads"> Git </a>.


2️⃣ Mở project:
<br> - Nếu dùng Eclipse-PHP-2020-06-R: File -> Open Projects from File System... -> Directory -> Chọn folder mới clone về -> Finish.
<br>
![image](https://gitlab.com/tronghaitoank25/images_icons/-/raw/master/WebProject_ReadmeImages/OpenProject.PNG)

3️⃣ Mở Server xampp:
<br>- Khởi động xampp, bật Apache và MySQL (nếu có xung đột cổng thì phải config <a href ="https://techbrij.com/setting-up-xampp-apache-iis-windows">  Error: Can't start Apache</a>).
<br>
![image](https://gitlab.com/tronghaitoank25/images_icons/-/raw/master/WebProject_ReadmeImages/Start_XAMPP.PNG)

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
<br>- Khởi động <b>phpMyAdmin</b> Tạo cơ sở dữ liệu <b>projectweb20202</b>:
<br>
![image](https://gitlab.com/tronghaitoank25/images_icons/-/raw/master/WebProject_ReadmeImages/Create_Database.PNG)

6️⃣ Thêm Data:
<br>- Copy nội dung file <b><i>projectweb20202.sql</i></b> rồi chạy trong phần SQL của <b>phpMyAdmin</b>, ấn <b>GO</b> để tạo bảng và dữ liệu cho database:
<br>
![image](https://gitlab.com/tronghaitoank25/images_icons/-/raw/master/WebProject_ReadmeImages/Run_Sql.PNG)

7️⃣ Run Web Application
<br>- Quay lại IDE Eclipse rồi chọn 1 file php bất kì -> click chuột phải -> Run as -> PHP Web Application.
<br>- Chúng ta có thể tương tác trực tiếp với Web trên IDE Eclipse hoặc copy URL ra một trình duyệt bất kỳ như Google Chrome.


