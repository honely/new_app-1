/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : ebay

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-10-26 16:42:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for e_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `e_admin_user`;
CREATE TABLE `e_admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL COMMENT '管理员名称',
  `pass_word` varchar(255) NOT NULL COMMENT '密码',
  `power` varchar(255) NOT NULL COMMENT '权限',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台管理员';

-- ----------------------------
-- Records of e_admin_user
-- ----------------------------
INSERT INTO `e_admin_user` VALUES ('1', 'admin', '14e1b600b1fd579f47433b88e8d85291', 'shouye,zuopinliebiao', '0', '1');

-- ----------------------------
-- Table structure for e_article
-- ----------------------------
DROP TABLE IF EXISTS `e_article`;
CREATE TABLE `e_article` (
  `article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_title` varchar(255) NOT NULL COMMENT '文章标题',
  `nav_id` int(11) NOT NULL COMMENT '分类id',
  `uid` int(11) NOT NULL COMMENT '会员id',
  `is_share` tinyint(1) NOT NULL COMMENT '是否被分享',
  `is_like` tinyint(1) NOT NULL COMMENT '是否被点赞',
  `see_num` int(11) NOT NULL COMMENT '浏览次数',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='作品表';

-- ----------------------------
-- Records of e_article
-- ----------------------------
INSERT INTO `e_article` VALUES ('1', '测试', '1', '1', '0', '0', '0', '0', '1');
INSERT INTO `e_article` VALUES ('5', '上传测试1', '1', '1', '0', '0', '0', '1508920150', '3');
INSERT INTO `e_article` VALUES ('6', '测试标题2', '1', '1', '0', '0', '0', '1508989651', '3');

-- ----------------------------
-- Table structure for e_article_info
-- ----------------------------
DROP TABLE IF EXISTS `e_article_info`;
CREATE TABLE `e_article_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL COMMENT '作品id',
  `content` varchar(255) NOT NULL COMMENT '作品内容',
  `img_url` varchar(255) NOT NULL COMMENT '作品图片',
  `music_url` varchar(255) NOT NULL COMMENT '音乐地址',
  `video_url` varchar(255) NOT NULL COMMENT '视频地址',
  PRIMARY KEY (`id`),
  KEY `article` (`article_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='作品详情表';

-- ----------------------------
-- Records of e_article_info
-- ----------------------------
INSERT INTO `e_article_info` VALUES ('1', '1', '测试数据', '', '', '');
INSERT INTO `e_article_info` VALUES ('5', '5', '测试内容', '', '', '');
INSERT INTO `e_article_info` VALUES ('6', '6', '<p style=\"text-align: center;\">这是一个测试数据</p>', '', '', '');

-- ----------------------------
-- Table structure for e_collection
-- ----------------------------
DROP TABLE IF EXISTS `e_collection`;
CREATE TABLE `e_collection` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL COMMENT '文章id',
  `uid` int(11) NOT NULL COMMENT '收藏该文章的会员uid',
  `coll_time` int(10) NOT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章收藏表';

-- ----------------------------
-- Records of e_collection
-- ----------------------------

-- ----------------------------
-- Table structure for e_comment
-- ----------------------------
DROP TABLE IF EXISTS `e_comment`;
CREATE TABLE `e_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL COMMENT '作品id',
  `uid` int(11) NOT NULL COMMENT '评论会员uid',
  `comment_text` varchar(255) NOT NULL COMMENT '评论内容',
  `be_comment_id` int(11) NOT NULL COMMENT '被评论的评论id',
  `be_commont_uid` int(11) NOT NULL COMMENT '被评论会员uid',
  `is_be_reply` tinyint(1) NOT NULL COMMENT '是否被评论',
  `add_time` int(10) NOT NULL COMMENT '评论时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章评论表';

-- ----------------------------
-- Records of e_comment
-- ----------------------------

-- ----------------------------
-- Table structure for e_coupon
-- ----------------------------
DROP TABLE IF EXISTS `e_coupon`;
CREATE TABLE `e_coupon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_name` varchar(255) NOT NULL COMMENT '礼券名称',
  `quota` int(11) NOT NULL COMMENT '礼券金额',
  `use_rule` int(11) NOT NULL COMMENT '礼券规则',
  `add_time` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='礼券表';

-- ----------------------------
-- Records of e_coupon
-- ----------------------------

-- ----------------------------
-- Table structure for e_follow
-- ----------------------------
DROP TABLE IF EXISTS `e_follow`;
CREATE TABLE `e_follow` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '会员uid',
  `be_uid` int(11) NOT NULL COMMENT '被关注的会员uid',
  `foll_time` int(10) NOT NULL COMMENT '关注时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员关注表';

-- ----------------------------
-- Records of e_follow
-- ----------------------------

-- ----------------------------
-- Table structure for e_like
-- ----------------------------
DROP TABLE IF EXISTS `e_like`;
CREATE TABLE `e_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL COMMENT '文章id',
  `uid` int(11) NOT NULL COMMENT '点赞会员uid',
  `like_time` int(10) NOT NULL COMMENT '点赞时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章点赞表';

-- ----------------------------
-- Records of e_like
-- ----------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微博会员表';

-- ----------------------------
-- Records of e_micro_blog
-- ----------------------------

-- ----------------------------
-- Table structure for e_nav_banner
-- ----------------------------
DROP TABLE IF EXISTS `e_nav_banner`;
CREATE TABLE `e_nav_banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nav_id` int(11) NOT NULL COMMENT '分类导航id',
  `banner_img` varchar(255) NOT NULL COMMENT 'banner图片地址',
  `Jump_url` varchar(255) NOT NULL COMMENT '跳转地址',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='分类导航banner表';

-- ----------------------------
-- Records of e_nav_banner
-- ----------------------------

-- ----------------------------
-- Table structure for e_nav_list
-- ----------------------------
DROP TABLE IF EXISTS `e_nav_list`;
CREATE TABLE `e_nav_list` (
  `nav_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `nav_name` varchar(255) NOT NULL COMMENT '分类名称',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`nav_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='分类导航表';

-- ----------------------------
-- Records of e_nav_list
-- ----------------------------
INSERT INTO `e_nav_list` VALUES ('1', '测试分类', '0', '1');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='qq会员表';

-- ----------------------------
-- Records of e_qq
-- ----------------------------

-- ----------------------------
-- Table structure for e_share
-- ----------------------------
DROP TABLE IF EXISTS `e_share`;
CREATE TABLE `e_share` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL COMMENT '文章id',
  `uid` int(11) NOT NULL COMMENT '分享会员uid',
  `share_time` int(10) NOT NULL COMMENT '分享时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章分享表';

-- ----------------------------
-- Records of e_share
-- ----------------------------

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
  `is_follow` tinyint(1) NOT NULL COMMENT '是否被关注',
  `is_plat` tinyint(1) unsigned zerofill NOT NULL COMMENT '是否平台注册',
  `add_time` int(10) NOT NULL COMMENT '注册时间',
  `status` tinyint(1) NOT NULL COMMENT '状态(1正常，2禁言，3删除，4禁止使用)',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='会员基本信息表';

-- ----------------------------
-- Records of e_user
-- ----------------------------
INSERT INTO `e_user` VALUES ('1', 'admin', '123456', '', '', '', '', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for e_user_coupon
-- ----------------------------
DROP TABLE IF EXISTS `e_user_coupon`;
CREATE TABLE `e_user_coupon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '会员uid',
  `coupon_id` int(11) NOT NULL COMMENT '礼券类型',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  `overdue_time` int(10) NOT NULL COMMENT '过期时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员礼券表';

-- ----------------------------
-- Records of e_user_coupon
-- ----------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信会员表';

-- ----------------------------
-- Records of e_wechat
-- ----------------------------
