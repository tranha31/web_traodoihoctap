-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 31, 2021 lúc 10:32 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `projectweb20202`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_activity`
--

CREATE TABLE `account_activity` (
  `id` int(10) NOT NULL,
  `account1` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `activity` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `account2` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `linkpost` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `shortcontent` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account_activity`
--

INSERT INTO `account_activity` (`id`, `account1`, `activity`, `account2`, `linkpost`, `shortcontent`, `datetime`) VALUES
(1, 'tronghaiit2', 'post question', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=1', 'What is the correct JSON content type?', '2021-04-08 16:24:15'),
(2, 'tronghaiit2', 'post question', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=3', 'Error in parsing JSON using codeable [duplica', '2021-04-08 16:23:03'),
(3, 'tronghaiit2', 'post question', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=4', 'What does “use strict” do in JavaScript, and ', '2021-04-08 16:24:49'),
(5, 'hatq', 'post question', 'hatq', 'http://localhost/web_traodoihoctap/articles/main2.php?id=16', 'What is causing the bug in “mix-blend-mode mo', '2021-05-20 00:00:00'),
(10, 'tranha31', 'post question', 'tranha31', 'http://localhost/web_traodoihoctap/articles/main2.php?id=21', 'Does the HTML image tag actually blocks the J', '2021-05-22 00:00:00'),
(11, 'hatq', 'edit question', 'hatq', 'http://localhost/web_traodoihoctap/articles/main2.php?id=13', 'Binary Data in MySQL ', '2021-05-25 00:00:00'),
(12, 'hatq', 'edit question', 'hatq', 'http://localhost/web_traodoihoctap/articles/main2.php?id=8', 'Multiple types of bulleted list in sublists i', '2021-05-31 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_infor`
--

CREATE TABLE `account_infor` (
  `account` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `level` int(1) NOT NULL,
  `numberofpost` int(9) NOT NULL,
  `password` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `verification_code` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verified` int(1) DEFAULT NULL,
  `ban` int(1) DEFAULT NULL,
  `dateofban` date DEFAULT NULL,
  `active_admin` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_admin` date DEFAULT NULL,
  `numberofheart` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account_infor`
--

INSERT INTO `account_infor` (`account`, `date`, `level`, `numberofpost`, `password`, `verification_code`, `verified`, `ban`, `dateofban`, `active_admin`, `date_admin`, `numberofheart`) VALUES
('haik63', '2021-05-22', 0, 0, 'notadmin', '', 1, 0, NULL, NULL, NULL, 0),
('haiphamk63', '2021-04-11', 1, 0, 'admin', '', 1, 0, NULL, NULL, NULL, 10),
('hatq', '2021-04-11', 1, 10, 'admin', '', 1, 0, NULL, NULL, NULL, 0),
('taha', '2021-05-22', 0, 0, 'tranha3108', '1cd0733f54a6acb15069011137393078', 1, 0, NULL, NULL, NULL, 0),
('taha2', '2021-05-25', 0, 0, '12345678a', '9bac37164906a293b3f92ef25b98d7b7', 0, 0, '0000-00-00', '', '0000-00-00', 0),
('tranha31', '2021-05-19', 0, 1, '12345678b', '96d412c9040fa129945ed3046fa9fa3e', 1, 0, '2021-05-26', NULL, NULL, 0),
('tronghaiit2', '2021-04-08', 1, 3, 'admin', '', 1, 0, NULL, NULL, NULL, 31);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `actions`
--

CREATE TABLE `actions` (
  `account` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `act` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id` int(5) NOT NULL,
  `act_time` date DEFAULT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `actions`
--

INSERT INTO `actions` (`account`, `act`, `id`, `act_time`, `status`) VALUES
('haiphamk63', 'likes', 1, '2021-05-17', 1),
('hatq', 'likes', 7, '2021-05-20', 0),
('haik63', 'likes', 1, '2021-05-22', 0),
('tronghaiit2', 'likes', 1, '2021-05-22', 0),
('tronghaiit2', 'likes', 8, '2021-05-22', 1),
('tronghaiit2', 'likes', 21, '2021-05-25', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_activity`
--

CREATE TABLE `admin_activity` (
  `id` int(11) NOT NULL,
  `account1` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `activity` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `account2` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_activity`
--

INSERT INTO `admin_activity` (`id`, `account1`, `activity`, `account2`, `link`, `datetime`) VALUES
(1, 'tronghaiit2', 'moderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=1', '2021-04-08 19:01:02'),
(2, 'tronghaiit2', 'moderated the post', 'hatq', 'http://localhost/web_traodoihoctap/articles/main2.php?id=7', '2021-04-08 19:01:17'),
(3, 'tronghaiit2', 'moderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=3', '2021-04-08 19:01:58'),
(4, 'tronghaiit2', 'unmoderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=3', '2021-04-08 19:02:26'),
(6, 'tronghaiit2', 'moderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=4', '2021-05-22 09:45:00'),
(7, 'tronghaiit2', 'unmoderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=4', '2021-05-22 09:45:28'),
(8, 'tronghaiit2', 'moderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=4', '2021-05-22 09:47:48'),
(9, 'tronghaiit2', 'moderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=1', '2021-05-22 10:24:27'),
(10, 'tronghaiit2', 'unmoderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=1', '2021-05-22 10:24:29'),
(11, 'tronghaiit2', 'moderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=1', '2021-05-22 10:29:39'),
(12, 'tronghaiit2', 'unmoderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=1', '2021-05-22 10:29:41'),
(13, 'tronghaiit2', 'moderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=1', '2021-05-22 10:43:55'),
(14, 'tronghaiit2', 'unmoderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=1', '2021-05-22 11:13:25'),
(15, 'tronghaiit2', 'moderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=1', '2021-05-22 11:13:26'),
(16, 'tronghaiit2', 'moderated the post', 'tronghaiit2', 'http://localhost/web_traodoihoctap/articles/main2.php?id=3', '2021-05-22 17:31:51'),
(17, 'tronghaiit2', 'moderated the post', 'hatq', 'http://localhost/web_traodoihoctap/articles/main2.php?id=11', '2021-05-22 17:32:34'),
(18, 'tronghaiit2', 'moderated the post', 'hatq', 'http://localhost/web_traodoihoctap/articles/main2.php?id=8', '2021-05-22 17:32:42'),
(19, 'tronghaiit2', 'moderated the post', 'hatq', 'http://localhost/web_traodoihoctap/articles/main2.php?id=13', '2021-05-22 17:32:49'),
(20, 'tronghaiit2', 'moderated the post', 'hatq', 'http://localhost/web_traodoihoctap/articles/main2.php?id=10', '2021-05-22 17:33:00'),
(21, 'tronghaiit2', 'moderated the post', 'tranha31', 'http://localhost/web_traodoihoctap/articles/main2.php?id=21', '2021-05-22 17:48:13'),
(34, 'tronghaiit2', 'ban account', 'tranha31', '', '2021-05-26 00:00:00'),
(35, 'tronghaiit2', 'unblock account', 'tranha31', '', '2021-05-26 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `articles`
--

CREATE TABLE `articles` (
  `id` int(5) NOT NULL,
  `account` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content_code` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vote` int(10) NOT NULL,
  `publish_date` date NOT NULL,
  `status` binary(1) DEFAULT '0',
  `tag1` varchar(50) DEFAULT NULL,
  `tag2` varchar(50) DEFAULT NULL,
  `tag3` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `articles`
--

INSERT INTO `articles` (`id`, `account`, `title`, `content`, `content_code`, `vote`, `publish_date`, `status`, `tag1`, `tag2`, `tag3`) VALUES
(1, 'tronghaiit2', 'What is the correct JSON content type?', 'I\'ve been messing around with JSON for some time, just pushing it out as text and it hasn\'t hurt anybody (that I know of), but I\'d like to start doing things properly.\r\nBut which one is correct, or best? I gather that there are security and browser support issues varying between them.\r\nI know there\'s a similar question. What MIME type if JSON is being returned by a REST API?, but I\'d like a slightly more targeted answer.', '\r\napplication/json\r\napplication/x-javascript\r\ntext/javascript\r\ntext/x-javascript\r\ntext/x-json', 3, '2021-04-10', 0x31, 'json', NULL, NULL),
(3, 'tronghaiit2', 'Error in parsing JSON using codeable [duplicate]', 'I am trying to pass some data from a JSON file using the new(ish) codeable capability in Swift. I have used the below syntax before without issue. I believe I may have something set up wrong, however, as I can\'t seem to understand why I keep receiving the below message when the JSON format has been approved by a JSON parser.', 'class QuestionFactory {\r\n\r\nfunc parseJSON(filename fileName: String) -> Quiz? {\r\n    if let url = Bundle.main.url(forResource: fileName, withExtension: \"json\") {\r\n        print(url)\r\n        do {\r\n            let data = try Data(contentsOf: url)\r\n            let decoder = JSONDecoder()\r\n            print(\"data received is \\(data.count) bytes:\\n\\(data)\")\r\n            print(data)\r\n            print(data as NSData)\r\n            let jsonData = try decoder.decode(Quiz.self, from: data)\r\n\r\n            print(jsonData)\r\n        } catch {\r\n            print(\"error:\\(error)\")\r\n        }\r\n    }\r\n    return nil\r\n}\r\n}', 0, '2021-04-10', 0x31, 'json', NULL, NULL),
(4, 'tronghaiit2', 'What does “use strict” do in JavaScript, and what is the reasoning behind it?', 'Recently, I ran some of my JavaScript code through Crockford\'s JSLint, and it gave the following error:\r\n\r\n__Problem at line 1 character 1: Missing \"use strict\" statement.__\r\n\r\nDoing some searching, I realized that some people add \"use strict\"; into their JavaScript code. Once I added the statement, the error stopped appearing. Unfortunately, Google did not reveal much of the history behind this string statement. Certainly it must have something to do with how the JavaScript is interpreted by the browser, but I have no idea what the effect would be.\r\n\r\nSo what is \"use strict\"; all about, what does it imply, and is it still relevant?\r\n\r\nDo any of the current browsers respond to the \"use strict\"; string or is it for future use?', '', 1, '2021-04-11', 0x31, 'javascript', 'js', NULL),
(5, 'hatq', 'How to limit the length of text in a paragraph [duplicate]', 'below is the code which populates description in my website:\r\ncurrently description goes to any no. of line based on product, i need to limit this to 3 lines.', '', 0, '2021-05-05', 0x30, 'html', NULL, NULL),
(6, 'hatq', 'How to define the correct interface and loop over the data in React?', 'I am kinda new to Typescript. Here I have a simple API, and I want to iterate through, and display the data. You can go to the Api link and see the raw data. I would be really grateful for some help', '', 0, '2021-05-05', 0x30, 'react', 'api', NULL),
(7, 'hatq', 'Map.get() in node js javascript always return undefined while fetching data from mongodb', 'I am using a map here in which I stored id:quantity pair I want to add this quantity to each item of products array (containing objects) and I am getting this quantity through map.get(id) method , despite the type of id and the id passed into get function are of same value and data type ,I am getting undefined, I tried to verify the type and value of id in map and id passed , both are same .still the problem exists', '', 1, '2021-05-05', 0x30, 'js', NULL, NULL),
(8, 'hatq', 'Multiple types of bulleted list in sublists in beamer', 'I tried to create a different bullets for sublists in beamer but everytime it creates the same bullet for nested lists as shown below. I tried label=\r\noman* but it is for enumitem. How do I change sublits bullets to something like arrow or rectangle?', '', 1, '2021-05-05', 0x31, 'latex', 'beamer', 'test'),
(9, 'hatq', 'How to install the windscribe vpn in ubuntu?', 'I have installed the ubuntu and now I want to install the windscribe vpn in ubuntu20\r\nPlease let me know the steps for doing that', '', 0, '2021-05-05', 0x30, 'ubuntu', NULL, NULL),
(10, 'hatq', 'How to disable transparent background of electron app?', 'I created a electron app. When the app starts, a login window opens with transparent background. I want that when user logged in successfully. Window\'s transparent property should be disabled. I didn\'t find any method like win.tranparent(false). How can I disable the transparent background', '', 0, '2021-04-11', 0x31, NULL, NULL, NULL),
(11, 'hatq', 'Sum two number using delimiter', 'If im given an input like 1:2 then the output should be 3. Likewise 54:6 then 60. But im getting an error stating that Exception in thread \"main\" java.lang.ArrayIndexOutOfBoundsException: Index 0 out of bounds for length 0at Hello.main(Hello.java:9)', '', 0, '2021-02-11', 0x31, NULL, NULL, NULL),
(12, 'hatq', 'PyQt4 signal To PyQT5?', 'I am not able to convert the following code from PyQt4 to PyQt5?', '', 0, '2021-03-10', 0x30, NULL, NULL, NULL),
(13, 'hatq', 'Binary Data in MySQL ', 'How do I store binary data in MySQL?', '', 0, '2021-05-05', 0x31, 'database', 'db', 'mysql'),
(16, 'hatq', 'What is causing the bug in “mix-blend-mode mode” with .mp4 on Firefox?', 'I am trying to use mix-blend-mode with a mp4 in the background. The idea is to have div with some text and have the video play in the background for an effect on the letters. This works perfectly with every browser besides Firefox.\r\n\r\nOn Firefox the video plays in the background but mix-blend-mode doesn\'t seem to have any effect. The text is just black. Here is the weird part: If I open the inspector the animations start to work but for one time only. I thought it might be a permission issue and allowed autoplay but that didn\'t solve the problem. I haven\'t been able to find what causes the bug. Any suggestions or hacks would be most welcome :)\r\n\r\nIve made the bit available on gitHub and live at netlify. Here is the repo on github and live version on netlify. If you want to see it clearly.\r\n\r\nthe HTLM bit looks like this:', 'function App() {\r\n    return (\r\n        &amp;lt;div className=&amp;quot;scroll-container&amp;quot;&amp;gt;\r\n            &amp;lt;video className=&amp;quot;background-video&amp;quot; autoPlay=&amp;quot;autoplay&amp;quot; muted loop&amp;gt;\r\n                &amp;lt;source src={video} type=&amp;quot;video/mp4&amp;quot; /&amp;gt;\r\n            &amp;lt;/video&amp;gt;\r\n            &amp;lt;div className=&amp;quot;wrapper&amp;quot;&amp;gt;\r\n                &amp;lt;div className=&amp;quot;header&amp;quot;&amp;gt;\r\n                    THE CREATIVE\r\n                    &amp;lt;br /&amp;gt;\r\n                    WEB AGENCY\r\n                    &amp;lt;br /&amp;gt;\r\n                    DESIGN/CODE\r\n                &amp;lt;/div&amp;gt;\r\n            &amp;lt;/div&amp;gt;\r\n        &amp;lt;/div&amp;gt;\r\n    );\r\n}', 0, '2021-05-20', 0x30, NULL, NULL, NULL),
(21, 'tranha31', 'Does the HTML image tag actually blocks the JS main thread in the browser?', 'There are a lot of articles on the internet suggesting to load images with web worker for performance gains and to free the main thread. (google search)\r\n\r\nBut I couldn\'t find any actual references saying that image tags actually blocks the main thread.\r\n\r\nI thought browsers are intelligent enough to identify an image tag and understand that it has to render it anyway. This is a common situation. So instead of, needing us adding new web workers for this common problem, browsers could use a separate process/thread/thing to solve this problem in a way that wont block the main thread.', '', 1, '2021-05-22', 0x31, 'html', 'js', 'javascript');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `account` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id` int(5) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `likes` int(5) NOT NULL,
  `time` date NOT NULL,
  `id_cmt` int(5) NOT NULL,
  `best_cmt` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`account`, `id`, `content`, `likes`, `time`, `id_cmt`, `best_cmt`) VALUES
('tronghaiit2', 3, 'This is a comment of article which has id = 3.\r\nJust for fun too :)))\r\nHaha.', 0, '2021-04-10', 1, 0),
('tronghaiit2', 1, 'This is a comment of article which has id = 1.\r\nJust for fun too :)))\r\nHaha.', 0, '2021-04-10', 2, 0),
('tronghaiit2', 1, 'This is another comment of article which has id = 1.\r\nJust for fun too :)))\r\nHaha.', 0, '2021-04-11', 3, 0),
('tronghaiit2', 1, 'This is the third comment of the article which has id = 1.\r\nJust for fun too :)))\r\nHaha.', 0, '2021-04-11', 4, 0),
('tronghaiit2', 1, 'This is the forth comment of the article which has id = 1.\r\nJust for fun too :)))\r\nHaha.', 0, '2021-04-11', 5, 0),
('tronghaiit2', 4, 'We should discuss about &amp;quot;div&amp;quot; element.\r\n&amp;lt;div &amp;gt;\r\n                &amp;lt;li&amp;gt;&amp;lt;p&amp;gt;Like&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;\r\n                &amp;lt;li&amp;gt;&amp;lt;p&amp;gt;&amp;quot;Comment&amp;quot;&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;\r\n                &amp;lt;?php ?&amp;gt;\r\n&amp;lt;/div&amp;gt;', 0, '2021-04-11', 6, 0),
('tronghaiit2', 4, 'No I dont think that\'s true.\r\nBecause of nothing.\r\n&amp;lt;div &amp;gt;\r\n                &amp;lt;li&amp;gt;&amp;lt;p&amp;gt;Like&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;\r\n                &amp;lt;li&amp;gt;&amp;lt;p&amp;gt;&amp;quot;Comment&amp;quot;&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;\r\n                &amp;lt;?php ?&amp;gt;\r\n&amp;lt;/div&amp;gt;', 0, '2021-04-11', 7, 1),
('tronghaiit2', 1, 'This is cmt 5', 0, '2021-04-12', 8, 0),
('tronghaiit2', 1, 'This is cmt 6', 0, '2021-04-12', 9, 0),
('tronghaiit2', 1, 'This is cmt 7', 0, '2021-04-12', 10, 0),
('tronghaiit2', 1, 'This is cmt 8', 0, '2021-04-12', 11, 0),
('tronghaiit2', 1, 'This is cmt 9', 0, '2021-04-12', 12, 0),
('tronghaiit2', 1, 'This is cmt 10', 0, '2021-04-12', 13, 0),
('tronghaiit2', 1, 'This is cmt 11', 0, '2021-04-12', 14, 0),
('tronghaiit2', 1, 'This is cmt 12', 0, '2021-04-12', 15, 0),
('tronghaiit2', 1, 'This is cmt 13', 0, '2021-04-12', 16, 0),
('tronghaiit2', 1, 'This is cmt 14', 0, '2021-04-12', 17, 0),
('tronghaiit2', 1, 'This is cmt 15', 0, '2021-04-12', 18, 0),
('tronghaiit2', 3, 'This is cmt 2 of article 3', 0, '2021-04-12', 19, 0),
('tronghaiit2', 3, 'This is cmt 3 of article 3', 0, '2021-04-12', 20, 0),
('tronghaiit2', 3, 'This is cmt 4 of article 3', 0, '2021-04-12', 21, 0),
('tronghaiit2', 3, 'This is cmt 5 of article 3', 0, '2021-04-12', 22, 0),
('tronghaiit2', 3, 'This is cmt 6 of article 3', 0, '2021-04-12', 23, 0),
('tronghaiit2', 1, 'Alo', 0, '2021-04-21', 24, 1),
('haik63', 4, 'abc', 0, '2021-05-22', 25, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `likes`
--

CREATE TABLE `likes` (
  `acc` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_article` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `likes`
--

INSERT INTO `likes` (`acc`, `id_article`) VALUES
('haiphamk63', 1),
('hatq', 7),
('haik63', 4),
('haik63', 1),
('tronghaiit2', 1),
('tronghaiit2', 8),
('tronghaiit2', 21);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `likes_cmt`
--

CREATE TABLE `likes_cmt` (
  `acc` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_cmt` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `likes_cmt`
--

INSERT INTO `likes_cmt` (`acc`, `id_cmt`) VALUES
('tronghaiit2', 24),
('tronghaiit2', 7),
('tronghaiit2', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_infor`
--

CREATE TABLE `personal_infor` (
  `account` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `yearofbirth` int(4) DEFAULT NULL,
  `linkfacebook` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkgithub` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linklinkedin` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skill1` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skill2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skill3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `experiment1` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `experiment2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `experiment3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `personal_infor`
--

INSERT INTO `personal_infor` (`account`, `name`, `yearofbirth`, `linkfacebook`, `linkgithub`, `linklinkedin`, `skill1`, `skill2`, `skill3`, `experiment1`, `experiment2`, `experiment3`, `phone`, `email`, `address`) VALUES
('tronghaiit2', 'Nguyễn Trọng Hải', 2000, 'https://www.facebook.com/0chuachacla0.HaiNT/', 'https://github.com/tronghaiit2', 'https://www.linkedin.com/in/t-hai-nguyen-b45b0b1b7', 'Skill 1', 'Skill 2', 'Skill 3', 'Kinh nghiệm 1', 'Kinh nghiệm 2', 'Kinh nghiệm 3', '0976684528', 'hai.nt183730@sis.hust.edu.vn', 'Hà Nội'),
('haiphamk63', 'Hải Phạm', 2000, 'https://www.facebook.com/Hai.PhamVan722/', 'https://github.com/haihustk63', NULL, 'eat', 'sleep', 'play game', 'none', 'none', 'none', '0379452159', 'haiphamtk13clc@gmail.com', 'Hà Nội'),
('hatq', 'Tran Quang Ha', 2000, 'https://www.facebook.com/profile.php?id=100008800488414', 'https://github.com/tranha31', '', '', '', '', '', '', '', '0964938140', '', ''),
('tranha31', '', 0, '', '', '', '', '', '', '', '', '', '', 'tranquangha31082000@gmail.com', ''),
('taha', '', 0, '', '', '', '', '', '', '', '', '', '', 'tranquangha20183520@gmail.com', ''),
('taha2', '', 0, '', '', '', '', '', '', '', '', '', '', 'ha.tq183520@sis.hust.edu.vn', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(1, 'json'),
(2, 'javascript'),
(3, 'api'),
(4, 'html'),
(5, 'ubuntu'),
(6, 'beamer'),
(7, 'test'),
(8, 'database'),
(9, 'db'),
(10, 'mysql');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account_activity`
--
ALTER TABLE `account_activity`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `account_infor`
--
ALTER TABLE `account_infor`
  ADD PRIMARY KEY (`account`);

--
-- Chỉ mục cho bảng `actions`
--
ALTER TABLE `actions`
  ADD KEY `fk_account_action` (`account`),
  ADD KEY `fk_id_action` (`id`);

--
-- Chỉ mục cho bảng `admin_activity`
--
ALTER TABLE `admin_activity`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account` (`account`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_cmt`),
  ADD KEY `account` (`account`),
  ADD KEY `id` (`id`);

--
-- Chỉ mục cho bảng `likes`
--
ALTER TABLE `likes`
  ADD KEY `fk_id_art` (`id_article`),
  ADD KEY `fk_account` (`acc`);

--
-- Chỉ mục cho bảng `likes_cmt`
--
ALTER TABLE `likes_cmt`
  ADD KEY `fk_likecmt` (`acc`),
  ADD KEY `fk_likecmt_2` (`id_cmt`);

--
-- Chỉ mục cho bảng `personal_infor`
--
ALTER TABLE `personal_infor`
  ADD KEY `account` (`account`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account_activity`
--
ALTER TABLE `account_activity`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `admin_activity`
--
ALTER TABLE `admin_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id_cmt` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `fk_account_action` FOREIGN KEY (`account`) REFERENCES `account_infor` (`account`),
  ADD CONSTRAINT `fk_id_action` FOREIGN KEY (`id`) REFERENCES `articles` (`id`);

--
-- Các ràng buộc cho bảng `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`account`) REFERENCES `account_infor` (`account`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`account`) REFERENCES `account_infor` (`account`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id`) REFERENCES `articles` (`id`);

--
-- Các ràng buộc cho bảng `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_account` FOREIGN KEY (`acc`) REFERENCES `account_infor` (`account`),
  ADD CONSTRAINT `fk_id_art` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`);

--
-- Các ràng buộc cho bảng `likes_cmt`
--
ALTER TABLE `likes_cmt`
  ADD CONSTRAINT `fk_likecmt` FOREIGN KEY (`acc`) REFERENCES `account_infor` (`account`),
  ADD CONSTRAINT `fk_likecmt_2` FOREIGN KEY (`id_cmt`) REFERENCES `comments` (`id_cmt`);

--
-- Các ràng buộc cho bảng `personal_infor`
--
ALTER TABLE `personal_infor`
  ADD CONSTRAINT `personal_infor_ibfk_1` FOREIGN KEY (`account`) REFERENCES `account_infor` (`account`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
