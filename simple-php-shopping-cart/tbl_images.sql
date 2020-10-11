--  
-- Table structure for table `tbl_images`  
--  
CREATE TABLE
IF NOT EXISTS `tbl_images`
(  
  `id` int
(11) NOT NULL AUTO_INCREMENT,  
  `name` blob NOT NULL,  
  `title` varchar
(255) NOT NULL,
`description` varchar
(255),
  PRIMARY KEY
(`id`)  
 ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;  
