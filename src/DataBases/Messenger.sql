-- This script is used to create the database and tables for the messenger application in phpmyadmin --
-- creatiw database Messenger w memba3d runiw script hetha fel SQL section --

CREATE TABLE `messenger` (
                             `from_name` varchar(40) NOT NULL,
                             `to_name` varchar(40) NOT NULL,
                             `message` longtext NOT NULL,
                             `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- MyISAM storage engine behi lel reading w searching donc behi lel messenger application --
-- latin1 encoding behi lel latin characters --
