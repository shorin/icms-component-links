DROP TABLE IF EXISTS `#__links`;

CREATE TABLE IF NOT EXISTS `#__links` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`url` varchar(200) NOT NULL,
`rewrite` int(1) NOT NULL,
`img` varchar(50) NOT NULL,
`color` varchar(7) NOT NULL,
`scale` int(1) NOT NULL,
PRIMARY KEY (`id`),
KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=13 ;

INSERT INTO `#__links` (`id`, `url`, `rewrite`, `img`, `color`, `scale`) VALUES
(1, 'http://www.youtube.com', 1, 'youtube.png', '#DC572E', 0),
(2, 'http://vk.com/', 1, 'vk.png', '#0A5AC3', 0),
(3, 'http://yandex.ru', 1, 'yandex.png', '#00A500', 0),
(4, 'http://mail.ru', 1, 'mail.png', '#2E8CEF', 1),
(5, 'http://twitter.com', 1, 'twitter.png', '#BE1E4B', 0),
(6, 'http://www.google.ru/', 1, 'google.png', '#A700AE', 0),
(7, 'http://habrahabr.ru/', 1, 'habrahabr.png', '#A700AE', 0),
(8, 'https://www.dropbox.com', 1, 'dropbox.png', '#00A500', 0),
(9, 'https://github.com', 1, 'github.png', '#DC572E', 0),
(10, 'http://www.instantcms.ru', 1, 'instantcms.png', '#0A5AC3', 0),
(11, 'http://www.skype.com', 1, 'skype.png', '#00A500', 0),
(12, 'http://lovenotice.ru', 1, 'lovenotice.png', '#BE1E4B', 0);


DROP TABLE IF EXISTS `#__links_name`;

CREATE TABLE IF NOT EXISTS `#__links_name` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(200) NOT NULL,
`privat` int(1) NOT NULL,
PRIMARY KEY (`id`),
KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

INSERT INTO `#__links_name` (`id`, `name`, `privat`) VALUES (1, 'Часто посещаемые', 0);