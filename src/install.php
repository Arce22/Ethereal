<?php
require 'database.php';

if ($_GET['table-creation'] == 'yes') {

    $records = $conn->prepare('START TRANSACTION;

                                DROP TABLE IF EXISTS Multiplayed, Likes,
                                                        Approves, Warned, Banned,
                                                        Friended, Blocked, Chats,
                                                        Played, Bought,
                                                        Written, Discount, Updates,
                                                        Company_Info,
                                                        Comment, Message, Information,
                                                        Admin, Premium_Player, Player,
                                                        Event, Game, Company, Game_Category;

                                CREATE TABLE Game_Category(
                                    category_name    varchar(200) primary key,
                                    age_limit	     int(2) not null);

                                CREATE TABLE Company(
                                    company_id 	    varchar(200) primary key,
                                    password 	    varchar(8) not null,
                                    company_name  	varchar(200) not null,
                                    approval_status 	    boolean not null);


                                CREATE TABLE Game(
                                    game_name       varchar(200) primary key,
                                    developer       varchar(200) not null,
                                    description     varchar(150),
                                    published_date  date not null,
                                    picture         varchar(200),
                                    price           float(10) not null,
                                    category_name   varchar(200) not null,
                                    company_id      varchar(200) not null,
                                    foreign key (category_name) references Game_Category (category_name),
                                    foreign key (company_id) references Company (company_id));



                                CREATE TABLE Event(
                                    event_id 	    varchar(200) primary key,
                                    event_name     varchar(200) not null,
                                    start_date            date not null,
                                        end_date              date not null,
                                    description          varchar(150));

                                CREATE TABLE Player(
                                    player_id 	     varchar(200)      primary key,
                                    password              varchar(8) not null,
                                        balance                 float(10),
                                    premium_status  boolean);

                                CREATE TABLE Premium_Player(
                                    player_id 	    varchar(200),
                                    theme_option     varchar(200),
                                    foreign key (player_id) references Player(player_id));

                                CREATE TABLE Admin(
                                    admin_id 	    varchar(200) primary key,
                                    password 	    varchar(8) not null,
                                    admin_email       varchar(200) not null);

                                CREATE TABLE Information(
                                    player_email     varchar(200),
                                    player_id              varchar(200),
                                    full_name 	    varchar(40),
                                    birth_date            date,
                                    gender                  varchar(200),
                                    country                 varchar(200),
                                    biography             varchar(200),
                                    primary key( player_email, player_id),
                                    foreign key(player_id) references Player(player_id));

                                CREATE TABLE Message(
                                    message_id 	    varchar(200) primary key,
                                    message_date     date not null,
                                    message_text      varchar(200) not null);

                                CREATE TABLE Comment(
                                    comment_id      varchar(200) primary key,
                                    approval_status 	     boolean not null,
                                    comment_text     varchar(200) not null,
                                        comment_date    date not null,
                                    like_count             int(10),
                                    dislike_count        int(10));

                                CREATE TABLE Company_Info(
                                    webpage              varchar(200),
                                    company_id         varchar(200),
                                    company_email   varchar(200),
                                    zip      char(6),
                                    state      varchar(200),
                                    city                         varchar(200),
                                    district                    varchar(200),
                                    description            varchar(200),
                                    primary key (company_id, company_email),
                                    foreign key (company_id) references Company(company_id));

                                CREATE TABLE Updates(
                                    company_id     varchar(200),
                                    game_name        varchar(200),
                                    update_date   date not null,
                                    change_log          varchar(200) not null,
                                    primary key( company_id, game_name),
                                    foreign key (company_id) references Company(company_id),
                                    foreign key (game_name) references Game(game_name));

                                CREATE TABLE Discount(
                                    company_id 	    varchar(200),
                                    game_name        varchar(200),
                                    event_id               varchar(200),
                                    percent 	    int(2) not null,
                                    primary key( company_id, game_name, event_id),
                                    foreign key (company_id) references Company(company_id),
                                    foreign key( game_name) references Game(game_name),
                                    foreign key(event_id) references Event(event_id));

                                CREATE TABLE Written(
                                    comment_id     varchar(200),
                                    player_id 	    varchar(200),
                                    game_name         varchar(200),
                                    primary key(comment_id, player_id, game_name),
                                    foreign key (comment_id) references Comment(comment_id),
                                    foreign key (player_id) references Player(player_id),
                                    foreign key (game_name) references Game(game_name));

                                CREATE TABLE Bought(
                                    player_id 	    varchar(200),
                                    game_name        varchar(200),
                                    date		date,
                                    price 		float(9),
                                    primary key( player_id, game_name),
                                    foreign key (player_id) references Player(player_id),
                                    foreign key (game_name) references Game(game_name));

                                CREATE TABLE Played(
                                    player_id 	    varchar(200),
                                    game_name          varchar(200),
                                        duration                 int(5) not null,
                                    played_date          date not null,
                                    primary key( game_name, player_id),
                                    foreign key (game_name) references Game(game_name),
                                    foreign key (player_id) references Player(player_id));

                                CREATE TABLE Chats(
                                    sender_id 	    varchar(200),
                                        receiver_id            varchar(200),
                                    message_id           varchar(200),
                                    primary key( sender_id, receiver_id, message_id),
                                    foreign key (sender_id) references Player(player_id),
                                    foreign key (receiver_id) references Player(player_id),
                                    foreign key (message_id) references Message(message_id));

                                CREATE TABLE Blocked(
                                    blocker_id     varchar(200),
                                    blocked_id          varchar(200),
                                    primary key( blocker_id, blocked_id),
                                    foreign key (blocker_id) references Player(player_id),
                                    foreign key (blocked_id) references Player(player_id));

                                CREATE TABLE Friended(
                                    adder_id     varchar(200),
                                    added_id     varchar(200),
                                    primary key(adder_id, added_id),
                                    foreign key (adder_id) references Player(player_id),
                                    foreign key (added_id) references Player(player_id));

                                CREATE TABLE Banned(
                                    player_id 	    varchar(200),
                                    admin_id             varchar(200),
                                    primary key(player_id),
                                    foreign key (player_id) references Player(player_id),
                                    foreign key (admin_id) references Admin(admin_id));

                                CREATE TABLE Warned(
                                    player_id 	    varchar(200),
                                    admin_id             varchar(200),
                                    primary key( player_id),
                                    foreign key (player_id) references Player(player_id),
                                    foreign key (admin_id) references Admin(admin_id));

                                CREATE TABLE Approves(
                                    company_id 	    varchar(200),
                                    admin_id             varchar(200),
                                    status                  boolean not null,
                                    primary key (company_id, admin_id),
                                    foreign key (company_id) references Company(company_id),
                                    foreign key (admin_id) references Admin(admin_id));

                                CREATE TABLE Likes(
                                    player_id	varchar(200),
                                    comment_id    varchar(200),
                                    is_liked 	boolean,
                                    primary key (player_id, comment_id),
                                    foreign key (player_id) references Player(player_id),
                                    foreign key (comment_id) references Comment(comment_id));

                                CREATE TABLE Multiplayed(
                                    inviter_id 	varchar(200),
                                    invited_id	varchar(200),
                                    game_name	varchar(200),
                                    primary key (inviter_id, invited_id, game_name),
                                    foreign key (inviter_id) references Player(player_id),
                                    foreign key (invited_id) references Player(player_id),
                                    foreign key (game_name) references Game(game_name));

                                COMMIT;');
    $records->execute();

    echo "Database is created! ";
}

if ($_GET['example-insertion'] == 'yes') {

    $records1 = $conn->prepare("START TRANSACTION;

                                insert into game_category values('Action', 18);
                                insert into game_category values('Arcade', 12);
                                insert into game_category values('Sports', 12);
                                insert into game_category values('Simulation', 18);
                                insert into game_category values('RPG', 18);
                                insert into game_category values('PVP', 12);
                                insert into game_category values('Multi-Player', 12);
                                insert into game_category values('Strategy', 18);
                                insert into game_category values('Racing', 12);
                                insert into game_category values('Adventure', 12);

                                insert into admin values('mert', 'mert', 'mert@gmail.com');
                                insert into admin values('mehin', 'mehin', 'mehin@gmail.com');
                                insert into admin values('bikem', 'bikem', 'bikem@gmail.com');
                                insert into admin values('nursena', 'nursena', 'nursena@gmail.com');

                                insert into company values('C1', 'company1', 'EA', TRUE);
                                insert into company values('C2', 'company2', 'Square Enix', TRUE);
                                insert into company values('C3', 'company3', 'Nintendo', TRUE);
                                insert into company values('C4', 'company4', 'Sony', TRUE);
                                insert into company values('C5', 'company5', 'XSEED', TRUE);

                                insert into company_info values('C1.com', 'C1', 'c1@gmail.com', '06940', 'State1', 'Ankara', 'District1', 'Company EA');
                                insert into company_info values('C2.com', 'C2', 'c2@gmail.com', '06941', 'State2', 'Istanbul', 'District2', 'Company SQENIX');
                                insert into company_info values('C3.com', 'C3', 'c3@gmail.com', '06942', 'State3', 'London', 'District3', 'Company NINTENDO');
                                insert into company_info values('C4.com', 'C4', 'c4@gmail.com', '06943', 'State4', 'Paris', 'District4', 'Company SONY');
                                insert into company_info values('C5.com', 'C5', 'c5@gmail.com', '06944', 'State5', 'Berlin', 'District5', 'Company XSEED');


                                insert into player values('P1', 'player1', 0, FALSE);
                                insert into player values('P2', 'player2', 0, FALSE);
                                insert into player values('P3', 'player3', 0, FALSE);
                                insert into player values('P4', 'player4', 0, FALSE);
                                insert into player values('P5', 'player5', 0, FALSE);
                                insert into player values('P6', 'player6', 0, FALSE);
                                insert into player values('P7', 'player7', 0, FALSE);
                                insert into player values('P8', 'player8', 0, FALSE);
                                insert into player values('P9', 'player9', 0, FALSE);
                                insert into player values('P10', 'player10', 0, FALSE);
                                insert into player values('P11', 'player11', 0, TRUE);

                                insert into premium_player values('P11', 'BLACK');

                                insert into information values('p1@gmail.com', 'P1', 'Max Riemelt', '1985-11-01', 'male', 'Germany', 'I like horror');
                                insert into information values('p2@gmail.com', 'P2', 'Angelina Jolie', '1984-03-01', 'female', 'Brazil', 'I like movies');
                                insert into information values('p3@gmail.com', 'P3', 'Rob Johns', '1998-11-04', 'male', 'Albania', 'I like food');
                                insert into information values('p4@gmail.com', 'P4', 'Jason Mary', '1979-10-01', 'female', 'Spain', 'I like dogs');
                                insert into information values('p5@gmail.com', 'P5', 'Georgie Armani', '2000-09-01', 'male', 'Italy', 'I like cats');
                                insert into information values('p6@gmail.com', 'P6', 'Coco Chanel', '2001-08-01', 'female', 'France', 'I like cinema');
                                insert into information values('p7@gmail.com', 'P7', 'Vartolu Sadettin', '1994-07-01', 'male', 'Turkey', 'I like my school');
                                insert into information values('p8@gmail.com', 'P8', 'Serenay Sarikaya', '1998-06-01', 'female', 'Turkey', 'I like my job');
                                insert into information values('p9@gmail.com', 'P9', 'Jason Derullo', '1995-05-01', 'male', 'Lebanon', 'I like you');
                                insert into information values('p10@gmail.com', 'P10', 'Akira Yamazaki', '2008-04-01', 'female', 'Japan', 'I like myself');
                                insert into information values('p11@gmail.com', 'P11', 'Kris Wu', '1999-12-01', 'male', 'China', 'I like nothing');

                                insert into game values('Battlefield 1', 'EA', 'Battle game', '2016-01-01', '01.jpg', '400', 'Strategy', 'C1');
                                insert into game values('Portal', 'EA', 'Portal game', '2007-01-01', '02.jpg', '16059', 'Action', 'C1');
                                insert into game values('FIFA 14', 'EA', 'Football game', '2013-01-01', '03.jpg', '500', 'Sports', 'C1');
                                insert into game values('Star Wars Battlefront', 'EA', 'Star Wars sequel', '2015-01-01', '04.jpg', '340', 'Adventure', 'C1');
                                insert into game values('Plants vs. Zombies', 'EA', 'Fun game', '2009-01-01', '05.jpg', '50', 'Multi-Player', 'C1');

                                insert into game values('Final Fantasy', 'SqEnix', 'Battle game', '2016-01-01', '06.jpg', '400', 'Simulation', 'C2');
                                insert into game values('Hitman', 'SqEnix', 'Portal game', '2007-01-01', '07.jpg', '16059', 'Strategy', 'C2');
                                insert into game values('Tomb Raider', 'SqEnix', 'Football game', '2013-01-01', '08.jpg', '500', 'Adventure', 'C2');

                                insert into game values('Super Mario Bros.', 'Nintendo', 'Fun game', '2016-01-01', '09.jpg', '400', 'Strategy', 'C3');
                                insert into game values('Tetris', 'Nintendo', 'Block game', '2007-01-01', '10.jpg', '16059', 'PVP', 'C3');
                                insert into game values('Arms', 'Nintendo', 'Arcade game', '2013-01-01', '11.jpg', '500', 'Racing', 'C3');
                                insert into game values('Splatoon', 'Nintendo', 'Splatoon sequel', '2015-01-01', '12.jpg', '340', 'RPG', 'C3');

                                insert into game values('Urban Reign', 'Sony', 'Battle game', '2016-01-01', '13.jpg', '400', 'Strategy', 'C4');
                                insert into game values('Demons Souls', 'Sony', 'Portal game', '2007-01-01', '14.jpg', '16059', 'Arcade', 'C4');
                                insert into game values('Ring King', 'Sony', 'Football game', '2013-01-01', '15.jpg', '500', 'Simulation', 'C4');
                                insert into game values('Juno First', 'Sony', 'Star Wars sequel', '2015-01-01', '16.jpg', '340', 'RPG', 'C4');
                                insert into game values('Senjyo', 'Sony', 'Fun game', '2009-01-01', '17.jpg', '50', 'PVP', 'C4');

                                insert into game values('Bullet Witch', 'EXSEED', 'Battle game', '2016-01-01', '18.jpg', '400', 'Strategy', 'C5');
                                insert into game values('Trails of Gold Steel', 'EXSEED', 'Portal game', '2007-01-01', '19.jpg', '16059', 'Multi-Player', 'C5');
                                insert into game values('Shantae', 'EXSEED', 'Football game', '2013-01-01', '20.jpg', '500', 'Sports', 'C5');
                                insert into game values('Sentan Kagura', 'EXSEED', 'Sentan Kagure Continue', '2015-01-01', '21.jpg', '340', 'Adventure', 'C5');

                                insert into event values('E1', 'Event One', '2018-05-01', '2018-06-01', 'Great Event');
                                insert into event values('E2', 'Event Two', '2018-05-01', '2018-07-01', 'Great Event');
                                insert into event values('E3', 'Event Three', '2018-05-01', '2018-08-01', 'Great Event');
                                insert into event values('E4', 'Event Four', '2018-02-01', '2018-06-01', 'Great Event');
                                insert into event values('E5', 'Event Five', '2018-03-01', '2018-06-01', 'Great Event');
                                insert into event values('E6', 'Event Six', '2018-04-01', '2018-06-01', 'Great Event');

                                insert into comment values('c1', '1', 'This game is so cool', '2018-05-01', '5', '2');
                                insert into comment values('c2', '1', 'This game is bad', '2018-05-01', '1', '11');
                                insert into comment values('c3', '0', 'This game is fantastic', '2018-05-01', '5', '2');
                                insert into comment values('c4', '1', 'This game is funny', '2018-05-01', '4', '1');
                                insert into comment values('c5', '0', 'This game is great', '2018-05-01', '5', '2');
                                insert into comment values('c6', '1', 'Im broke', '2018-05-01', '11', '0');

                                insert into written values('c1', 'P1', 'Ring King');
                                insert into written values('c2', 'P3', 'Tetris');
                                insert into written values('c3', 'P4', 'Senjyo');
                                insert into written values('c4', 'P10', 'Portal');
                                insert into written values('c5', 'P11', 'FIFA 14');
                                insert into written values('c6', 'P8', 'Shantae');

                                insert into discount values('C1', 'Portal', 'E1', '25');
                                insert into discount values('C2', 'Final Fantasy', 'E2', '50');
                                insert into discount values('C3', 'Tetris', 'E3', '75');
                                insert into discount values('C4', 'Senjyo', 'E4', '25');
                                insert into discount values('C5', 'Shantae', 'E5', '50');

                                insert into approves values ('c1','bikem','1');
                                insert into approves values ('c2','mehin','1');
                                insert into approves values ('c3','nursena','1');
                                insert into approves values ('c4','mert','1');
                                insert into approves values ('c5','bikem','1');

                                insert into bought VALUES ('P1','Ring King','2016-05-03','500');
                                insert into bought VALUES ('P1','Arms','2016-05-03','500');
                                insert into bought VALUES ('P1','Splatoon','2016-05-03','340');
                                insert into bought VALUES ('P1','Trails of Gold Steel','2016-05-03','16059');
                                insert into bought VALUES ('P2','Urban Reign','2017-04-12','400');
                                insert into bought VALUES ('P2','Trails of Gold Steel','2017-07-02','16059');
                                insert into bought VALUES ('P2','Tomb Raider','2017-07-02','500');
                                insert into bought VALUES ('P2','Juno First','2015-11-02','340');

                                insert into  bought VALUES ('P3','Ring King','2016-05-03','500');
                                insert into  bought VALUES ('P4','Arms','2016-05-03','500');
                                insert into  bought VALUES ('P5','Splatoon','2016-05-03','340');
                                insert into  bought VALUES ('P6','Trails of Gold Steel','2016-05-03','16059');
                                insert into  bought VALUES ('P7','Urban Reign','2017-04-12','400');
                                insert into  bought VALUES ('P8','Trails of Gold Steel','2017-07-02','16059');
                                insert into  bought VALUES ('P9','Tomb Raider','2017-07-02','500');
                                insert into  bought VALUES ('P10','Juno First','2015-11-02','340');
                                insert into  bought VALUES ('P11','Ring King','2016-05-03','500');
                                insert into  bought VALUES ('P3','Arms','2016-05-03','500');
                                insert into  bought VALUES ('P7','Splatoon','2016-05-03','340');
                                insert into  bought VALUES ('P8','Splatoon','2016-05-03','16059');

                                insert into friended VALUES ('P1','P2');
                                insert into friended VALUES ('P1','P3');
                                insert into friended VALUES ('P1','P5');
                                insert into friended VALUES ('P1','P6');
                                insert into friended VALUES ('P1','P11');

                                insert into friended VALUES ('P2','P7');
                                insert into friended VALUES ('P2','P8');
                                insert into friended VALUES ('P2','P9');
                                insert into friended VALUES ('P2','P2');
                                insert into friended VALUES ('P2','P11');

                                insert into friended VALUES ('P3','P4');
                                insert into friended VALUES ('P3','P2');
                                insert into friended VALUES ('P3','P1');
                                insert into friended VALUES ('P3','P6');
                                insert into friended VALUES ('P3','P7');

                                insert into friended VALUES ('P4','P2');
                                insert into friended VALUES ('P4','P3');
                                insert into friended VALUES ('P4','P5');
                                insert into friended VALUES ('P4','P6');
                                insert into friended VALUES ('P4','P11');

                                insert into friended VALUES ('P5','P2');
                                insert into friended VALUES ('P5','P1');
                                insert into friended VALUES ('P5','P10');
                                insert into friended VALUES ('P5','P9');
                                insert into friended VALUES ('P5','P8');

                                insert into friended VALUES ('P6','P2');
                                insert into friended VALUES ('P6','P8');
                                insert into friended VALUES ('P6','P1');
                                insert into friended VALUES ('P6','P3');
                                insert into friended VALUES ('P6','P5');

                                insert into friended VALUES ('P7','P10');
                                insert into friended VALUES ('P7','P11');
                                insert into friended VALUES ('P7','P1');
                                insert into friended VALUES ('P7','P6');
                                insert into friended VALUES ('P7','P5');

                                insert into friended VALUES ('P8','P1');
                                insert into friended VALUES ('P8','P4');
                                insert into friended VALUES ('P8','P7');
                                insert into friended VALUES ('P8','P6');
                                insert into friended VALUES ('P8','P5');

                                insert into friended VALUES ('P9','P4');
                                insert into friended VALUES ('P9','P2');
                                insert into friended VALUES ('P9','P1');
                                insert into friended VALUES ('P9','P8');
                                insert into friended VALUES ('P9','P11');

                                insert into friended VALUES ('P10','P7');
                                insert into friended VALUES ('P10','P9');
                                insert into friended VALUES ('P10','P4');
                                insert into friended VALUES ('P10','P3');
                                insert into friended VALUES ('P10','P8');

                                insert into friended VALUES ('P11','P3');
                                insert into friended VALUES ('P11','P7');
                                insert into friended VALUES ('P11','P9');
                                insert into friended VALUES ('P11','P1');
                                insert into friended VALUES ('P11','P5');

                                insert into played  VALUES ('P1','Sentan Kagura','140','2018-05-12');
                                insert into played  VALUES ('P1','Demons Souls','140','2018-05-12');
                                insert into played  VALUES ('P1','Senjyo','110','2018-05-15');
                                insert into played  VALUES ('P1','Shantae','40','2018-05-05');
                                insert into played  VALUES ('P1','Tetris','90','2018-04-10');

                                insert into played  VALUES ('P2','Super Mario Bros.','20','2018-05-12');
                                insert into played  VALUES ('P2','Demons Souls','240','2018-05-12');
                                insert into played  VALUES ('P2','Trails of Gold Steel','180','2018-05-15');
                                insert into played  VALUES ('P2','Hitman','40','2018-05-05');
                                insert into played  VALUES ('P2','Tetris','190','2018-04-10');

                                insert into played  VALUES ('P3','Super Mario Bros.','20','2018-05-12');
                                insert into played  VALUES ('P4','Demons Souls','240','2018-05-12');
                                insert into played  VALUES ('P5','Trails of Gold Steel','180','2018-05-15');
                                insert into played  VALUES ('P6','Hitman','40','2018-05-05');
                                insert into played  VALUES ('P7','Tetris','190','2018-04-10');

                                insert into played  VALUES ('P8','Sentan Kagura','140','2018-05-11');
                                insert into played  VALUES ('P9','Demons Souls','140','2018-05-12');
                                insert into played  VALUES ('P10','Senjyo','110','2018-05-15');
                                insert into played  VALUES ('P11','Shantae','40','2018-05-05');
                                insert into played  VALUES ('P3','Tetris','90','2018-04-10');

                                insert into played  VALUES ('P3','Arms','140','2018-05-12');
                                insert into played  VALUES ('P4','Splatoon','140','2018-05-12');
                                insert into played  VALUES ('P5','Plants vs. Zombies','110','2018-05-15');
                                insert into played  VALUES ('P6','Final Fantasy','40','2018-05-05');
                                insert into played  VALUES ('P7','FIFA 14','90','2018-04-10');

                                insert into played  VALUES ('P8','Arms','140','2018-05-12');
                                insert into played  VALUES ('P9','Splatoon','140','2018-05-12');
                                insert into played  VALUES ('P10','Plants vs. Zombies','110','2018-05-15');
                                insert into played  VALUES ('P11','Final Fantasy','40','2018-05-05');
                                insert into played  VALUES ('P3','FIFA 14','90','2018-04-10');

                                insert into played  VALUES ('P7','Sentan Kagura','140','2018-05-11');
                                insert into played  VALUES ('P6','Demons Souls','140','2018-05-12');
                                insert into played  VALUES ('P5','Senjyo','110','2018-05-15');
                                insert into played  VALUES ('P10','Shantae','40','2018-05-05');
                                insert into played  VALUES ('P9','Tetris','90','2018-04-10');

                                COMMIT;");
    $records1->execute();
    echo "Examples are inserted!";
}
