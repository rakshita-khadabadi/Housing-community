USE city_view_database;

INSERT INTO `roles` (`id`, `role_name`) VALUES (NULL, 'admin');
INSERT INTO `roles` (`id`, `role_name`) VALUES (NULL, 'subdivision manager');
INSERT INTO `roles` (`id`, `role_name`) VALUES (NULL, 'building manager');
INSERT INTO `roles` (`id`, `role_name`) VALUES (NULL, 'apartment owner');

INSERT INTO `utilities` (`id`,`utility_name`) VALUES (NULL, 'electricity');
INSERT INTO `utilities` (`id`,`utility_name`) VALUES (NULL, 'gas');
INSERT INTO `utilities` (`id`,`utility_name`) VALUES (NULL, 'water');
INSERT INTO `utilities` (`id`,`utility_name`) VALUES (NULL, 'internet');

INSERT INTO `community_services` (`id`,`community_service_name`) VALUES (NULL, 'maintenance fee');
INSERT INTO `community_services` (`id`,`community_service_name`) VALUES (NULL, 'pool');
INSERT INTO `community_services` (`id`,`community_service_name`) VALUES (NULL, 'gym');

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email_id`, `password`, `area_code`, `phone_number`, `joining_datetime`, `roles_id`) VALUES (NULL, 'Admin', 'Admin', 'admin@gmail.com', 'admin', '123', '1234562222', '2021-01-01 06:31:03', (select id from roles where role_name = 'admin'));
