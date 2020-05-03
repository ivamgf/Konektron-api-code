ALTER TABLE `users`
CHANGE `us_password` `us_password` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `us_email`;


ALTER TABLE `providers`
CHANGE `pr_password` `pr_password` varchar(100) COLLATE 'utf8_general_ci' NOT NULL AFTER `pr_email`;

ALTER TABLE `providers`
CHANGE `pr_name` `pr_name` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `id_auth`,
CHANGE `pr_ie` `pr_ie` bigint(20) NULL AFTER `pr_natId`,
CHANGE `pr_address` `pr_address` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `pr_ie`,
CHANGE `pr_phone` `pr_phone` bigint(20) NOT NULL AFTER `pr_cep`;
