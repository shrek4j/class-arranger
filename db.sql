CREATE TABLE `classoa_class` (
  `class_id` int(10) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `class_type_id` int(10) DEFAULT NULL COMMENT '关联class_type表',
  `remark` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `classoa_class_detail` (
  `class_detail_id` int(10) NOT NULL AUTO_INCREMENT,
  `date` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '课程日期',
  `day_of_week` int(1) NOT NULL COMMENT '星期几',
  `start_time` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '课程开始时间 24小时制',
  `end_time` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '课程结束时间 24小时制',
  `teacher_id` int(10) NOT NULL,
  `classroom_id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `tuition_per_class` int(10) DEFAULT NULL COMMENT '学费（1课/1人），到分',
  PRIMARY KEY (`class_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `classoa_class_detail_student_rela` (
  `id` int(10) NOT NULL,
  `class_detail_id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `tuition_per_class` int(10) DEFAULT NULL COMMENT '学费（1课/1人），精确到分',
  `is_absent` int(1) NOT NULL DEFAULT '0' COMMENT '0：上课 1：缺勤'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `classoa_classroom` (
  `classroom_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `inst_id` int(10) NOT NULL,
  `status` int(1) NOT NULL COMMENT '是否启用',
  PRIMARY KEY (`classroom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `classoa_institution` (
  `inst_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` varchar(40) NOT NULL,
  `region_id` int(10) DEFAULT NULL COMMENT '三级区域ID',
  PRIMARY KEY (`inst_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `classoa_operator` (
  `operator_id` int(10) NOT NULL AUTO_INCREMENT,
  `inst_id` int(10) NOT NULL,
  `user_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_pwd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_super_admin` int(1) DEFAULT '1' COMMENT '1:是 0:不是',
  `role_id` int(10) DEFAULT NULL COMMENT '角色id',
  PRIMARY KEY (`operator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `classoa_operator_login_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `operator_id` int(10) NOT NULL,
  `login_time` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `classoa_role` (
  `role_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色编码',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `classoa_student` (
  `student_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` varchar(20) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `balance` int(10) DEFAULT '0' COMMENT '余额',
  `status` int(1) NOT NULL DEFAULT '1',
  `inst_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `classoa_teacher` (
  `teacher_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` varchar(10) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `inst_id` int(10) DEFAULT NULL COMMENT 'FK_classoa_institute',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1：正常 0：已删除',
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;