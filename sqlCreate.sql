CREATE TABLE user (
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_name varchar(50) not null,
    sur_name varchar(50),
    email varchar(140) not null,
    pass varchar(255) not null,
    sex SMALLINT(3) not null,
    level SMALLINT(3) DEFAULT 1 not null,
    createdAt datetime not null,
    updatedAt DATETIME not null
);

ALTER TABLE `user` ADD INDEX `id` (`id`);

ALTER TABLE `user` ADD INDEX `level` (`level`);

ALTER TABLE `user` ADD INDEX `user_name` (`user_name`);


ALTER DATABASE `ece_odev` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE `post` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`post_icerik` TEXT NOT NULL,
	`post_title` varchar(255) NOT NULL,
	`post_sahibi` int(11) NOT NULL,
	`post_img` varchar(750),
	`createdAt` DATETIME NOT NULL,
	`updatedAt` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);


ALTER TABLE `post` ADD INDEX `id` (`id`);

ALTER TABLE `post` ADD INDEX `user_id` (`user_id`);

CREATE TABLE `Comments` (
	`id` int(6) NOT NULL AUTO_INCREMENT,
	`user_id` int(6) NOT NULL,
	`post_id` int(6) NOT NULL,
	`post_comment` TEXT(750) NOT NULL,
	`createdAt` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);


ALTER TABLE `Comments` ADD INDEX `user_id` (`user_id`);

ALTER TABLE `Comments` ADD INDEX `post_id` (`post_id`);

ALTER TABLE `Comments` ADD INDEX `id` (`id`);

