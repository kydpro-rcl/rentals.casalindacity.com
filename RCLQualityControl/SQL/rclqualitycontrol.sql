-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Dec 18, 2012 at 04:36 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `rclqualitycontrol`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `rqc_deficiencies`
-- 

CREATE TABLE `rqc_deficiencies` (
  `id` int(5) NOT NULL auto_increment,
  `id_villa` int(5) NOT NULL,
  `details` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` int(5) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table structure for table `rqc_deficiencies_done`
-- 

CREATE TABLE `rqc_deficiencies_done` (
  `id` int(5) NOT NULL auto_increment,
  `id_def` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table structure for table `rqc_doc_number`
-- 

CREATE TABLE `rqc_doc_number` (
  `id` int(5) NOT NULL auto_increment,
  `doc_no` tinytext NOT NULL,
  `id_villa` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table structure for table `rqc_maintenance`
-- 

CREATE TABLE `rqc_maintenance` (
  `id` int(5) NOT NULL auto_increment,
  `title` tinyint(1) NOT NULL,
  `note` text NOT NULL,
  `priority` tinyint(1) NOT NULL,
  `id_villa` int(5) NOT NULL,
  `desde` datetime NOT NULL,
  `hasta` datetime NOT NULL,
  `user_id` int(5) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table structure for table `rqc_users`
-- 

CREATE TABLE `rqc_users` (
  `id` int(5) NOT NULL auto_increment,
  `user` tinytext character set latin1 collate latin1_general_cs NOT NULL,
  `pass` tinytext character set latin1 collate latin1_general_cs NOT NULL,
  `name` tinytext NOT NULL,
  `lastname` tinytext NOT NULL,
  `phone` varchar(25) NOT NULL,
  `email` varchar(75) NOT NULL,
  `dpto` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table structure for table `rqc_villa`
-- 

CREATE TABLE `rqc_villa` (
  `id` int(5) NOT NULL auto_increment,
  `no` tinytext NOT NULL,
  `user_id` int(5) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table structure for table `rqc_villa_details`
-- 

CREATE TABLE `rqc_villa_details` (
  `id` int(5) NOT NULL auto_increment,
  `id_villa` int(5) NOT NULL,
  `builder` tinytext NOT NULL,
  `rental` tinyint(1) NOT NULL,
  `stage` tinyint(1) NOT NULL,
  `delivered` tinyint(1) NOT NULL,
  `deliver_date` date NOT NULL,
  `promised` date NOT NULL,
  `user_id` int(5) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
