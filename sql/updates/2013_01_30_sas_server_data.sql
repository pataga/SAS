ALTER TABLE `sas_server_data`
ADD COLUMN `soapPort`  int(8) NOT NULL AFTER `host`,
ADD COLUMN `soapKey`  varchar(255) NOT NULL AFTER `soapPort`,
ADD COLUMN `soapActive`  varchar(255) NOT NULL AFTER `soapKey`;
