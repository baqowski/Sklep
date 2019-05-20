CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `perm` int(10) NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `sklep` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(255) NOT NULL,
  `miasto` varchar(255) NOT NULL,
  `ulica` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `produkt` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(255) NOT NULL,
  `rozmiar` varchar(255) NOT NULL,
  `kolor` varchar(255) NOT NULL,
  `cena` int(10) NOT NULL,
  `img` varchar(255) NOT NULL,
  `id_sklep` int(10) NOT NULL,  
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_sklep`) REFERENCES  `sklep`(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `koszykKlientaSklepu` (
  `id_k` int(10) NOT NULL AUTO_INCREMENT,
  `id_sklep` int(10) NOT NULL, 
  `id_user` int(10) NOT NULL,
  `id_produkt` int(10) NOT NULL, 
  PRIMARY KEY (`id_k`),
  FOREIGN KEY (`id_sklep`) REFERENCES  `sklep`(`id`),
  FOREIGN KEY (`id_user`) REFERENCES  `users`(`id`), 
  FOREIGN KEY (`id_produkt`) REFERENCES  `produkt`(`id`)   
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `zamowienia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `ulica` varchar(255) NOT NULL,
  `nr` varchar(255) NOT NULL,
  `kod` varchar(255) NOT NULL,
  `miasto` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `pozycja_zamowienia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_zamowienia` int(10) NOT NULL,
  `id_koszykklientasklepu` int(10) NOT NULL,
  PRIMARY KEY (`id`), 
  FOREIGN KEY (`id_zamowienia`) REFERENCES  `zamowienia`(`id`), 
  FOREIGN KEY (`id_koszykklientasklepu`) REFERENCES  `koszykklientasklepu`(`id_k`)   
) ENGINE=MyISAM DEFAULT CHARSET=utf8;