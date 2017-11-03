/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : ebay

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-11-03 15:23:34
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
INSERT INTO `e_admin_user` VALUES ('1', 'admin', '14e1b600b1fd579f47433b88e8d85291', 'shouye,zuopinliebiao,xiugaizuopin,tianjiaxinzuopin,tianjiapingtaihuiyuan,huiyuanliebiao,xiugaidaohangxinxi', '0', '1');

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
  `update_time` int(10) NOT NULL COMMENT '修改时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='作品表';

-- ----------------------------
-- Records of e_article
-- ----------------------------
INSERT INTO `e_article` VALUES ('1', '测试文章1', '1', '1', '0', '0', '0', '0', '1509341433', '1');
INSERT INTO `e_article` VALUES ('5', '上传测试1', '1', '1', '0', '0', '0', '1508920150', '1509341425', '1');
INSERT INTO `e_article` VALUES ('6', '测试标题2', '1', '1', '0', '0', '0', '1508989651', '0', '1');
INSERT INTO `e_article` VALUES ('7', 'qwertyt', '1', '0', '0', '0', '0', '1509334727', '0', '1');
INSERT INTO `e_article` VALUES ('8', '给V缝纫工', '1', '1', '0', '0', '0', '1509335173', '1509514373', '1');

-- ----------------------------
-- Table structure for e_article_info
-- ----------------------------
DROP TABLE IF EXISTS `e_article_info`;
CREATE TABLE `e_article_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL COMMENT '作品id',
  `content` varchar(6533) NOT NULL COMMENT '作品内容',
  `img_url` varchar(255) NOT NULL COMMENT '作品图片',
  `music_url` varchar(255) NOT NULL COMMENT '音乐地址',
  `video_url` varchar(255) NOT NULL COMMENT '视频地址',
  PRIMARY KEY (`id`),
  KEY `article` (`article_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='作品详情表';

-- ----------------------------
-- Records of e_article_info
-- ----------------------------
INSERT INTO `e_article_info` VALUES ('1', '1', '<p style=\"text-align: center;\">测试数据</p>', 'http://img.qmwjj.cc/head/oJFl8j5faV_20170916_!!22941.jpg,http://img.qmwjj.cc/head/oJFl8j5faV_20170916_!!22941.jpg,', '', '');
INSERT INTO `e_article_info` VALUES ('5', '5', '<p style=\"text-align: center;\">测试内容</p>', '', '', '');
INSERT INTO `e_article_info` VALUES ('6', '6', '<p style=\"text-align: center;\">这是一个测试数据</p>', '', '', '');
INSERT INTO `e_article_info` VALUES ('7', '7', '<p style=\"text-align: center;\">图片上传测试</p>', '', '', '');
INSERT INTO `e_article_info` VALUES ('8', '8', '<p style=\"text-align: center;\"><img src=\"http://www.ebay.com/static/javascript/images/face/13.gif\" alt=\"[偷笑]\">这是内容<img src=\"http://www.ebay.com/static/javascript/images/face/14.gif\" alt=\"[亲亲]\">啊哈哈哈哈<img src=\"http://www.ebay.com/static/javascript/images/face/37.gif\" alt=\"[色]\"></p>', 'http://www.ebay.com/article/59f6a07764c1e.jpg,http://www.ebay.com/article/59f6a077b45a0.jpg,http://www.ebay.com/article/59f6a077bb6ea.jpg,http://www.ebay.com/article/59f6a0785bfb5.jpg,', '', '');

-- ----------------------------
-- Table structure for e_brand
-- ----------------------------
DROP TABLE IF EXISTS `e_brand`;
CREATE TABLE `e_brand` (
  `brand_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL COMMENT '品牌名称',
  `brand_logo` varchar(255) NOT NULL COMMENT '品牌logo',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='品牌表';

-- ----------------------------
-- Records of e_brand
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章评论表';

-- ----------------------------
-- Records of e_comment
-- ----------------------------
INSERT INTO `e_comment` VALUES ('1', '1', '1', 'reqwrq', '0', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for e_coupon
-- ----------------------------
DROP TABLE IF EXISTS `e_coupon`;
CREATE TABLE `e_coupon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_name` varchar(255) NOT NULL COMMENT '礼券名称',
  `quota` int(11) NOT NULL COMMENT '礼券金额',
  `use_rule` int(11) NOT NULL COMMENT '礼券规则',
  `effective_day` int(11) NOT NULL COMMENT '有效天数',
  `add_time` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='礼券表';

-- ----------------------------
-- Records of e_coupon
-- ----------------------------
INSERT INTO `e_coupon` VALUES ('1', '新人礼券测试版', '100', '1000', '1', '0', '1');
INSERT INTO `e_coupon` VALUES ('2', '礼券添加测试', '1000', '123456', '1', '1509588592', '1');
INSERT INTO `e_coupon` VALUES ('3', '新的礼券', '100', '200', '7', '1509592466', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='分类导航banner表';

-- ----------------------------
-- Records of e_nav_banner
-- ----------------------------
INSERT INTO `e_nav_banner` VALUES ('1', '1', 'http://www.ebay.com/nav_banner/59fbe0f390ff4.jpg', 'www.baidu.cn', '0', '1');
INSERT INTO `e_nav_banner` VALUES ('2', '1', 'http://www.ebay.com/nav_banner/59fbe68c3e76c.jpg', 'www.baidu.com', '1509680781', '3');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='分类导航表';

-- ----------------------------
-- Records of e_nav_list
-- ----------------------------
INSERT INTO `e_nav_list` VALUES ('1', '测试分类_one', '0', '1');
INSERT INTO `e_nav_list` VALUES ('2', '添加测试', '1509675247', '1');

-- ----------------------------
-- Table structure for e_news
-- ----------------------------
DROP TABLE IF EXISTS `e_news`;
CREATE TABLE `e_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '会员id',
  `news` varchar(255) NOT NULL COMMENT '消息',
  `send_uid` int(11) NOT NULL COMMENT '发送信息uid',
  `send_time` int(10) NOT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='消息表';

-- ----------------------------
-- Records of e_news
-- ----------------------------

-- ----------------------------
-- Table structure for e_order
-- ----------------------------
DROP TABLE IF EXISTS `e_order`;
CREATE TABLE `e_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_num` int(11) NOT NULL COMMENT '特订订单id',
  `product_id` int(11) NOT NULL COMMENT '商品id',
  `receipt_addr` int(11) NOT NULL COMMENT '收货地址',
  `uid` int(11) NOT NULL COMMENT '会员id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of e_order
-- ----------------------------

-- ----------------------------
-- Table structure for e_product
-- ----------------------------
DROP TABLE IF EXISTS `e_product`;
CREATE TABLE `e_product` (
  `pro_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL COMMENT '商品名称',
  `sort` int(11) NOT NULL COMMENT '商品分类',
  `brand_id` int(11) NOT NULL COMMENT '品牌id',
  `def_pro_img` varchar(255) NOT NULL COMMENT '商品图片',
  `def_price` decimal(10,2) NOT NULL COMMENT '价格',
  `descptions` varchar(255) NOT NULL COMMENT '商品描述',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`pro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of e_product
-- ----------------------------

-- ----------------------------
-- Table structure for e_product_attr_val
-- ----------------------------
DROP TABLE IF EXISTS `e_product_attr_val`;
CREATE TABLE `e_product_attr_val` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL COMMENT '商品id',
  `attr_id` int(11) NOT NULL COMMENT '属性id',
  `attr_value` varchar(255) NOT NULL COMMENT '属性值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品属性表';

-- ----------------------------
-- Records of e_product_attr_val
-- ----------------------------

-- ----------------------------
-- Table structure for e_product_comment
-- ----------------------------
DROP TABLE IF EXISTS `e_product_comment`;
CREATE TABLE `e_product_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL COMMENT '商品id',
  `uid` int(11) NOT NULL COMMENT '评论会员uid',
  `comment_text` varchar(255) NOT NULL COMMENT '评论内容',
  `be_comment_id` int(11) NOT NULL COMMENT '被评论的评论id',
  `is_be_reply` tinyint(1) NOT NULL COMMENT '是否被评论',
  `add_time` int(10) NOT NULL COMMENT '评论时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品评论表';

-- ----------------------------
-- Records of e_product_comment
-- ----------------------------

-- ----------------------------
-- Table structure for e_product_img
-- ----------------------------
DROP TABLE IF EXISTS `e_product_img`;
CREATE TABLE `e_product_img` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pro_img` varchar(255) NOT NULL COMMENT '商品图册',
  `product_id` int(11) NOT NULL COMMENT '商品id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品图册表';

-- ----------------------------
-- Records of e_product_img
-- ----------------------------

-- ----------------------------
-- Table structure for e_product_sort
-- ----------------------------
DROP TABLE IF EXISTS `e_product_sort`;
CREATE TABLE `e_product_sort` (
  `sort_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sort_name` varchar(255) NOT NULL COMMENT '商品名称',
  `parent_id` int(11) NOT NULL COMMENT '根据id判断二级分类',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`sort_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品分类表';

-- ----------------------------
-- Records of e_product_sort
-- ----------------------------

-- ----------------------------
-- Table structure for e_pro_collection
-- ----------------------------
DROP TABLE IF EXISTS `e_pro_collection`;
CREATE TABLE `e_pro_collection` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL COMMENT '商品id',
  `uid` int(11) NOT NULL COMMENT '会员id',
  `add_time` int(10) NOT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品收藏表';

-- ----------------------------
-- Records of e_pro_collection
-- ----------------------------

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
-- Table structure for e_receipt_addr
-- ----------------------------
DROP TABLE IF EXISTS `e_receipt_addr`;
CREATE TABLE `e_receipt_addr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `receipt_name` varchar(255) NOT NULL COMMENT '收货人姓名',
  `province` int(11) NOT NULL COMMENT '省',
  `city` int(11) NOT NULL COMMENT '市',
  `area` int(11) NOT NULL COMMENT '区',
  `detailed_addr` varchar(255) NOT NULL COMMENT '详细地址',
  `telephone` varchar(255) NOT NULL COMMENT '收货人电话',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  `uid` int(11) NOT NULL COMMENT '会员id',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收货地址';

-- ----------------------------
-- Records of e_receipt_addr
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
-- Table structure for e_shopping_cart
-- ----------------------------
DROP TABLE IF EXISTS `e_shopping_cart`;
CREATE TABLE `e_shopping_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '会员uid',
  `pro_id` int(11) NOT NULL COMMENT '商品id',
  `redis_pro_key` varchar(255) NOT NULL COMMENT '商品缓存key',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='购物车表';

-- ----------------------------
-- Records of e_shopping_cart
-- ----------------------------

-- ----------------------------
-- Table structure for e_sort_attr
-- ----------------------------
DROP TABLE IF EXISTS `e_sort_attr`;
CREATE TABLE `e_sort_attr` (
  `attr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(255) NOT NULL COMMENT '属性名称',
  `type_id` int(11) NOT NULL COMMENT '分类类型id',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='类型属性表';

-- ----------------------------
-- Records of e_sort_attr
-- ----------------------------

-- ----------------------------
-- Table structure for e_sort_type
-- ----------------------------
DROP TABLE IF EXISTS `e_sort_type`;
CREATE TABLE `e_sort_type` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL COMMENT '属性名称',
  `sort_id` int(11) NOT NULL COMMENT '商品类型id',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='分类类型表';

-- ----------------------------
-- Records of e_sort_type
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='会员基本信息表';

-- ----------------------------
-- Records of e_user
-- ----------------------------
INSERT INTO `e_user` VALUES ('1', 'admin', '123456', 'http://www.ebay.com/article/59f6a0785bfb5.jpg', '13474376703', '', '127.0.0.1', '100', '0', '0', '0', '1');
INSERT INTO `e_user` VALUES ('2', '米玛', '1de4d4e54196393de362e0de0e4fa068', 'http://www.ebay.com/article/59f6a0785bfb5.jpg', '13474376703', 'i7qu5v', '127.0.0.1', '100', '0', '0', '1509350464', '1');
INSERT INTO `e_user` VALUES ('3', '你咯', 'dcc2c37d5c27bd6a81c4620c73d20b69', 'http://www.ebay.com/headImg/59f6dccedff01.jpg', '13474376703', 'a4wbw8', '127.0.0.1', '100', '0', '0', '1509350646', '1');
INSERT INTO `e_user` VALUES ('4', '妮妮', '743628bed3723f491651a827ae81c5c0', 'http://www.ebay.com/headImg/59f6ddbdce472.jpg', '1347437603', 'z9n5e4', '127.0.0.1', '100', '0', '1', '1509350848', '1');
INSERT INTO `e_user` VALUES ('5', 'plat', '9c537a5c9f232004c345f15dc64ac99c', 'http://www.ebay.com/headImg/59f96de17a9a6.jpg', '13473796', '29bb24', '127.0.0.1', '100', '0', '1', '1509518818', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='会员礼券表';

-- ----------------------------
-- Records of e_user_coupon
-- ----------------------------
INSERT INTO `e_user_coupon` VALUES ('3', '5', '3', '1509603125', '1510207925', '1');
INSERT INTO `e_user_coupon` VALUES ('2', '5', '1', '1509603057', '1509689457', '1');
INSERT INTO `e_user_coupon` VALUES ('4', '1', '2', '1509604636', '1509691036', '1');
INSERT INTO `e_user_coupon` VALUES ('5', '1', '3', '1509681238', '1510286038', '1');

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
