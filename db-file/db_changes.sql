ALTER TABLE `payment_name`
    ADD `attachment` VARCHAR(255) NULL AFTER `type`;
ALTER TABLE `teacher`
    ADD `user_id` INT NOT NULL AFTER `teacher_id`;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions`
(
    `id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `name`
    varchar
(
    50
) NOT NULL,
    `clear_name` varchar
(
    255
) NOT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `clear_name`)
VALUES (1, 'dashboard', 'Dashboard'),
       (2, 'index-classes', 'Manage Classes'),
       (3, 'create-classes', 'Add Class'),
       (4, 'fetchClassesData-classes', 'Fetch Classes'),
       (5, 'update-classes', 'Edit Class'),
       (6, 'remove-classes', 'Remove Class');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles`
(
    `id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `name`
    varchar
(
    50
) NOT NULL,
    PRIMARY KEY
(
    `id`
),
    UNIQUE KEY `name`
(
    `name`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`)
VALUES
    (1, 'admin'),
    (2, 'test'),
    (3, 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE IF NOT EXISTS `role_permissions`
(
    `id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `role_id`
    int
    NOT
    NULL,
    `permission_id`
    int
    NOT
    NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`)
VALUES (1, 1, 1),
       (2, 1, 2),
       (3, 1, 3),
       (4, 1, 4),
       (5, 1, 5),
       (6, 2, 1),
       (7, 2, 2),
       (8, 3, 1),
       (9, 3, 2),
       (10, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles`
(
    `id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `user_id`
    int
    NOT
    NULL,
    `role_id`
    int
    NOT
    NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`)
VALUES (1, 1, 1),
       (2, 1, 2);



DROP TABLE IF EXISTS `student_moves`;
CREATE TABLE IF NOT EXISTS `student_moves` (
                                               `id` int NOT NULL AUTO_INCREMENT,
                                               `student_id` int NOT NULL,
                                               `class_id` int NOT NULL,
                                               `section_id` int NOT NULL,
                                               `reason` text NOT NULL,
                                               `move_date` date NOT NULL,
                                               PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;


COMMIT;