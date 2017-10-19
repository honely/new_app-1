/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : ebay

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-10-16 17:45:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for e_micro_blog
-- ----------------------------
DROP TABLE IF EXISTS `e_micro_blog`;
CREATE TABLE `e_micro_blog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '微博注册唯一uid',
  `openId` int(11) NOT NULL COMMENT '微博参数openid',
  `access_token` varchar(255) NOT NULL COMMENT '授权',
  `regdate_ip` varchar(255) NOT NULL COMMENT '注册ip',
  `source` varchar(255) NOT NULL COMMENT '来源',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for e_qq
-- ----------------------------
DROP TABLE IF EXISTS `e_qq`;
CREATE TABLE `e_qq` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT 'qq注册唯一的uid',
  `openId` varchar(255) NOT NULL COMMENT 'qq参数openId',
  `access_token` varchar(255) NOT NULL COMMENT '授权',
  `regdate_ip` varchar(255) NOT NULL COMMENT '注册ip',
  `source` varchar(255) NOT NULL COMMENT '来源',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for e_user
-- ----------------------------
DROP TABLE IF EXISTS `e_user`;
CREATE TABLE `e_user` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员uid',
  `user_name` varchar(255) NOT NULL COMMENT '会员账号',
  `pass_word` varchar(255) NOT NULL COMMENT '密码',
  `head_img` varchar(255) NOT NULL COMMENT '头像',
  `mobile` char(11) NOT NULL COMMENT '手机号',
  `salt_str` char(6) NOT NULL COMMENT '随机字符',
  `register_ip` varchar(255) NOT NULL COMMENT '注册ip',
  `integral` int(11) NOT NULL COMMENT '积分',
  `add_time` int(10) NOT NULL COMMENT '注册时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员基本信息表';

-- ----------------------------
-- Table structure for e_wechat
-- ----------------------------
DROP TABLE IF EXISTS `e_wechat`;
CREATE TABLE `e_wechat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '微信注册唯一的uid',
  `openId` int(11) NOT NULL COMMENT '微信参数openid',
  `access_token` varchar(255) NOT NULL COMMENT '授权',
  `regdate_ip` varchar(255) NOT NULL COMMENT '注册ip',
  `source` varchar(255) NOT NULL COMMENT '来源',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
