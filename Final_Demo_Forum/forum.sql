-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 04:57 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `cNo` int(10) NOT NULL COMMENT 'cNo = pNo',
  `uNo` int(10) NOT NULL,
  `message` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cDate` varchar(19) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`cNo`, `uNo`, `message`, `cDate`) VALUES
(2, 1, 'YA!', '2022-09-06 08:42:33'),
(1, 1, 'YA!', '2022-09-06 08:42:49'),
(2, 1, 'Ya!', '2022-09-06 08:49:59'),
(2, 1, 'YAAA!!', '2022-09-06 09:11:12'),
(3, 2, '愛河洗澡舒服！', '2022-09-06 09:59:49'),
(2, 2, '我需要咖啡！', '2022-09-06 10:37:05'),
(6, 7, 'YA!', '2022-09-06 10:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `uNo` int(10) NOT NULL,
  `fNo` int(10) NOT NULL COMMENT 'fNo = tNo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`uNo`, `fNo`) VALUES
(1, 1),
(1, 2),
(6, 1),
(6, 3),
(7, 1),
(7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `forum_account`
--

CREATE TABLE `forum_account` (
  `uNo` int(10) NOT NULL,
  `uId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uPwd` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uRole` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uGender` int(5) NOT NULL,
  `uMail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ppath` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='***this table saves all user accounts***';

--
-- Dumping data for table `forum_account`
--

INSERT INTO `forum_account` (`uNo`, `uId`, `uPwd`, `uRole`, `uName`, `uGender`, `uMail`, `ppath`) VALUES
(1, 'admin', 'admin', 'admin', 'administrator', 1, 'admin@example.com', 'profile_photo/admin_1654672812.png'),
(2, 'topgun_tom', 'cruisee', 'premium', 'Tom Cruisee', 1, 'topgun@example.com', 'profile_photo/topgun_tom_1654742356.png'),
(3, 'icecream_john', 'cena', 'user', 'John Cena', 1, 'icecream@example.com', 'profile_photo/icecream_john_1654672131.jpg'),
(6, 'jessica', 'jessica', 'user', 'zhen', 0, 'jessica.lee0114@gmail.com', 'profile_photo/jessica_1654722214.png'),
(7, 'justin', 'justin', 'premium', 'justin', 0, 'justin@example.com', 'profile_photo/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `forum_invitation_code`
--

CREATE TABLE `forum_invitation_code` (
  `iNo` int(10) NOT NULL,
  `reg_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_invitation_code`
--

INSERT INTO `forum_invitation_code` (`iNo`, `reg_email`, `code`) VALUES
(1, 'justin@example.com', 'topgun_tom+szjosyg84bqueshru0gxapxl');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `pNo` int(10) NOT NULL,
  `uNo` int(10) NOT NULL,
  `tNo` int(10) NOT NULL,
  `title` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pDate` varchar(19) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumView` int(10) NOT NULL,
  `sumComment` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`pNo`, `uNo`, `tNo`, `title`, `content`, `pic`, `pDate`, `sumView`, `sumComment`) VALUES
(1, 6, 1, '限5天！漢堡王炸6款「加1元多1件」', '漢堡王中樂透？優惠不手軟簡直殺紅眼！端午連假才推出超殺「開運霸王省限定優惠券」，限定29天牛肉堡、辣薯球等7組「買一送一」吃到6月底；今（8）日迎接 「國際死黨日」（BFF day, National Best Friends Day），6/12前限5天再炸6款「加1元多1件」，小華堡、四塊雞塊通通5折激省，烤牛堡換算下來單顆只要45元，這下還不快吃爆。\r\n\r\n漢堡王優惠送上癮！迎接 「國際死黨日」（BFF day, National Best Friends Day），即日起至6/12限時五天，六款指定漢堡、點心到飲料通通加1元多1件，包括經典小華堡（單點95元）、黃金起士雙豬培根堡（單點129元）、洋蔥圈烤牛堡（單點89元）、四塊雞塊（單點45元）、茶花綠茶大杯（單點40元）、百事可樂大杯（單點40元），相當於激省5折優惠，換算下來人氣小華堡單顆48元、八塊雞塊共46元、烤牛堡單顆只要45元。', 'profile_photo/漢堡王.png', '2022-09-06 07:00:38', 2, 1),
(2, 6, 1, '限時5天！超商7大飲品咖啡買5送2', '今（8）日是國際麻吉日（National Best-friend Day），有超商推出「7大飲品買5送2優惠組合」，限時5天，品項不但有買5杯精品拿鐵就送2杯冰黑糖珍珠燕麥奶，還有買5杯大杯冰燕麥鐵就送2杯冰燕麥奶茶等優惠，活動限時5天，欲購從速。\r\n\r\n7-ELEVEN自6月8日至12日，連續5天祭出「國際麻吉日」優惠活動，在OPEN POINT APP行動隨時取推出7大組合「買A送B」買5送2優惠活動，一次滿足不同口味偏好的咖啡控，兌換期限至今年9/30止，同品項、同規格及同價位可冰熱互換，現萃茶與精品咖啡限指定門市兌領，贈品不得轉贈。\r\n\r\n【優惠組合】\r\n\r\n1.買5杯CITY CAFE西西里風檸檬氣泡咖啡，送2杯CITY TEA完熟蘋果冰茶，優惠價400元\r\n\r\n2.買5杯CITY CAFE大杯冰燕麥拿鐵，送2杯CITY TEA冰燕麥奶茶，優惠價375元\r\n\r\n3.買5杯CITY CAFE濃萃美式（冰／熱），送2杯CITY TEA四季春青茶（冰／熱），優惠價250元\r\n\r\n4.買5杯CITY CAFE冰皇家伯爵紅茶拿鐵，送2杯CITY CAFE冰脆酷摩卡咖啡，優惠價325元\r\n\r\n5.買5杯CITY CAFE特大杯拿鐵（冰／熱），送2杯CITY PRIMA精品美式（冰／熱），優惠價350元\r\n\r\n6.買5杯CITY PEARL黑糖珍珠撞奶（冰／熱），送2杯CITY CAFE濃萃拿鐵（冰／熱），優惠價300元\r\n\r\n7.買5杯CITY PRIMA精品拿鐵（冰／熱），送2杯CITY PEARL冰黑糖珍珠燕麥奶，優惠價450元\r\n\r\n詳細活動規範及供應情形，依 OPEN POINT APP 官方公告為準。\r\n\r\n另外，連鎖咖啡品牌cama café在7日也推出為期4週的折扣優惠，包括新加入會員免費贈送黑咖啡（限量5萬杯）！所有會員週週贈送50元咖啡金；以及最殺飲品30杯85折、咖啡豆2包85折可寄領優惠。\r\n\r\n優惠活動於6/8至7/7為期四週，飲品、咖啡豆、濾掛咖啡到大組寄杯，消費者都可以用最熟悉的方式，享受毎一杯咖啡。\r\n\r\n【優惠活動】\r\n\r\n1.新會員贈送黑咖啡，活動期間內，新加入cama café APP成為會員，即可獲得中杯黑咖啡兌換券乙張。(活動限量5萬杯)\r\n\r\n2.飲品折價券50元，活動期間內，毎週發送10元飲品折價券5張，想喝什麼就喝什麼，優惠隨享，優惠券亦可輕鬆轉贈給其它cama會員。\r\n\r\n3.飲品5杯88折，單次購買5杯，即享88折優惠，可寄杯。\r\n\r\n4.飲品30杯85折，單次購買30杯，即享85折優惠，可寄杯。最適合毎天都需要享受一杯cama的會員好朋友。\r\n\r\n5.咖啡豆2包85折，單次購買2包，即享85折優惠，口味可任選，可寄豆。\r\n\r\n6.濾掛咖啡20包85折，居家存貨最好選擇，單次購買20包，即享85折優惠，口味可任選，不可寄貨。', 'null', '2022-09-06 07:08:14', 4, 4),
(4, 6, 1, '上班不憂鬱！伯朗、星巴克買1送1 限時7天喝到爽…「3間咖啡', '星巴克宣布，將推出全品項的買1送1活動，並且提及，民眾可以在6月13、14日的下午4時至晚間8時進入指定店家購買2杯相同風味、容量、冰熱的飲品，同時也提醒，該買1送1的優惠活動在部分門市、車道服務以及機場門市不適用。\r\n\r\n星巴克指出，將在6月13、14日推出「星光好友分享」優惠，同時也指出，屆時民眾可在下午4時至晚間8時時前往購買2杯風味、容量、冰熱相同之飲品，屆時即可享有買1送1的優惠。此外，星巴克提醒，該優惠活動最多只能買2送2，且在部分門市不適用。\r\n\r\n然而，除了星巴克祭出買1送1的優惠活動之外，露易莎咖啡也提及，民眾自5月23日起至6月30日以前，可於每周1、2、3前往指定的337間限定門市進行消費，同時也表示，屆時餐食、甜點及飲品將可全面享有8折的優惠。 此外，露易莎也提醒，此優惠活動不包含客製化的加價項目，如加1份濃縮、加蛋、加起司，也不提供寄杯及外送等服務。\r\n\r\n此外，伯朗咖啡也宣布，將會在本月的12、13、19、20、26、27等日舉行飲品不限品項及容量之買1送1之活動，屆時民眾將可前往全台各指定門市享有此買1送1之優惠活動。', 'null', '2022-09-06 09:55:46', 2, 0),
(5, 6, 2, '若能出國門 最想飛的國家Top10，半數網友想飛日本', '台灣人最愛前往旅遊國家之一的日本，更是不負眾望勇奪第1名，半數網友表示最想飛往日本\r\n\r\n【旅遊經 洪書瑱報導】\r\n\r\n後疫情階段，許多國家逐一開放國門，如鄰近的南韓於6月1日開放個人觀光簽證申請；台灣旅客最愛旅遊國家之一的日本，近日也宣布將開放團客入境，許多網友更是迫不期待準備手刀下訂機票，旅遊、休閒娛樂電商平台Klook也在這個時間點，針對社群進行「如果縮短回國隔離天數，你最想飛哪個國家？」趣味調查，統計網友最想飛的國家Top10，有一半的網友都表示好想飛去日本，日本不負眾望成為第1名。\r\n\r\n6月1日重新開放個人旅遊短期簽證的南韓也衝上第2名\r\n\r\n第3名是擁有許多美麗小島的泰國，旅客紛紛表示好想去度假放鬆\r\n\r\n從網友票選結果中發現，疫後旅客首次出境旅遊目的地將以鄰近國家為主，榜單前3名都是亞洲國家，此調查結果前3名與Klook台灣辦公室員工最想去「辦公度假」的國家調查結果一致，位居第1名的日本獲得總投票數的四分之一，除了能趁機在日本當地旅行外，許多員工也表示期待與當地團隊互相交流；其次為南韓和泰國，分別為20%與17%。\r\n\r\n票選第1名，針對日本就有網友留言：「迪士尼預備備！期待到樂園玩、好想去京都清水寺，走訪必去景點等。」；重新開放個人旅遊短期簽證的南韓，也上榜單第2名，有網友在Klook臉書貼文留言：「要先回首爾一趟，因為太多店都變了，必須更新資訊，必須好好採購一番、釜山吃海鮮、豬肉湯飯！想念異國美食的滋味！」；第3名就是受許多台灣旅客喜愛、擁有許多美麗小島的泰國，有網友留言好想去小島度假放鬆。\r\n\r\nKlook台灣總經理林耀民表示，發現旅客想出國的心比以往都更加強烈，根據Klook內部數據，國際出境旅遊市場從4月開始預訂數已是2月份的3倍之多，除了歐美地區，亞太區也在快速復甦當中，其中新加坡在出境市場成長最快，其次為泰國和南韓，這些國家的旅客也特別關注澳洲、馬來西亞、印尼、紐西蘭、泰國和英國等目的地。此外，旅客們在目的地挑選上，仍偏向熟悉且鄰近的目的地，像是台灣旅客就特別偏好前往日本、南韓、泰國等國家旅遊，此外，在商品類別選擇上，還是以主題樂園和熱門景點票券最為熱門。', 'null', '2022-09-06 10:01:14', 1, 0),
(6, 7, 3, '《大火球》', '《捍衛戰士》裡曾有一段情節，是獨行俠的好友呆頭鵝（Goose）在酒吧彈著鋼琴，與他一同合唱《大火球》（Great Balls of Fire）這首曲子，而當時呆頭鵝年紀尚小的兒子「公雞」（Rooster），則就坐在鋼琴上方。而到了《捍衛戰士：獨行俠》裡，則輪到公雞在酒吧自彈自唱了這首《大火球》，只是對獨行俠來說，這個舉動則喚醒了他對呆頭鵝之死的傷痛，以及對公雞的滿滿愧咎。', 'topgun.jpeg', '2022-09-06 10:42:59', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `tNo` int(10) NOT NULL,
  `tName` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tPic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numFollow` int(10) NOT NULL,
  `numPost` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`tNo`, `tName`, `tPic`, `numFollow`, `numPost`) VALUES
(1, '美食', 'profile_photo/美食.jpg', 3, 3),
(2, '旅遊', 'profile_photo/旅遊.jpg', 1, 1),
(3, '生活', 'profile_photo/生活.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `view`
--

CREATE TABLE `view` (
  `vNo` int(10) NOT NULL COMMENT 'vNo = pNo',
  `uNo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `view`
--

INSERT INTO `view` (`vNo`, `uNo`) VALUES
(0, 1),
(1, 1),
(1, 6),
(2, 1),
(2, 2),
(2, 6),
(2, 7),
(3, 2),
(3, 6),
(4, 6),
(4, 7),
(5, 6),
(6, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`uNo`,`fNo`);

--
-- Indexes for table `forum_account`
--
ALTER TABLE `forum_account`
  ADD PRIMARY KEY (`uNo`);

--
-- Indexes for table `forum_invitation_code`
--
ALTER TABLE `forum_invitation_code`
  ADD PRIMARY KEY (`iNo`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`pNo`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`tNo`);

--
-- Indexes for table `view`
--
ALTER TABLE `view`
  ADD PRIMARY KEY (`vNo`,`uNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum_account`
--
ALTER TABLE `forum_account`
  MODIFY `uNo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forum_invitation_code`
--
ALTER TABLE `forum_invitation_code`
  MODIFY `iNo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `pNo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `tNo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
