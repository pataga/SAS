DROP TABLE IF EXISTS `sas_user_permission`;
CREATE TABLE `sas_user_permission` (
  `pid` int(11) unsigned NOT NULL,
  `sid` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `bitmask` bigint(20) NOT NULL,
  PRIMARY KEY (`pid`,`sid`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- KONFIGURATION START --
SET @SERVER_ID = 1;
SET @USER_ID = 1;
-- KONFIGURATION ENDE --

INSERT INTO sas_user_permission (pid, sid, uid, bitmask) VALUE (1, @SERVER_ID, @USER_ID, 255);
INSERT INTO sas_user_permission (pid, sid, uid, bitmask) VALUE (2, @SERVER_ID, @USER_ID, 255);
INSERT INTO sas_user_permission (pid, sid, uid, bitmask) VALUE (3, @SERVER_ID, @USER_ID, 255);
INSERT INTO sas_user_permission (pid, sid, uid, bitmask) VALUE (4, @SERVER_ID, @USER_ID, 255);
INSERT INTO sas_user_permission (pid, sid, uid, bitmask) VALUE (5, @SERVER_ID, @USER_ID, 255);
INSERT INTO sas_user_permission (pid, sid, uid, bitmask) VALUE (6, @SERVER_ID, @USER_ID, 255);
INSERT INTO sas_user_permission (pid, sid, uid, bitmask) VALUE (7, @SERVER_ID, @USER_ID, 255);
INSERT INTO sas_user_permission (pid, sid, uid, bitmask) VALUE (8, @SERVER_ID, @USER_ID, 255);
INSERT INTO sas_user_permission (pid, sid, uid, bitmask) VALUE (9, @SERVER_ID, @USER_ID, 255);
INSERT INTO sas_user_permission (pid, sid, uid, bitmask) VALUE (10, @SERVER_ID, @USER_ID, 255);
