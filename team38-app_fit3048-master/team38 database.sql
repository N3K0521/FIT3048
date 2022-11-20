--
-- Table structure for table `comments`
--
DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
                            `id` int(11) NOT NULL,
                            `comments` varchar(4500) DEFAULT NULL,
                            `create_date` timestamp NULL DEFAULT NULL,
                            `user_id` int(11) DEFAULT NULL,
                            `file_id` int(11) DEFAULT NULL,
                            `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
    ADD PRIMARY KEY (`id`),
  ADD KEY `comments_fk1` (`file_id`),
  ADD KEY `comments_fk2` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
    ADD CONSTRAINT `comments_fk1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_fk2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Table structure for table `contactus`
--
DROP TABLE IF EXISTS `contactus`;

CREATE TABLE `contactus` (
                             `id` int(11) NOT NULL,
                             `phone` varchar(450) DEFAULT NULL,
                             `email` varchar(450) DEFAULT NULL,
                             `address` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `phone`, `email`, `address`) VALUES
    (1, '039 067 7798', 'admin@smartbusinessadvisors.com.au', '3 Palmyra Way, Docklands VIC 3008');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


--
-- Table structure for table `files`
--
DROP TABLE IF EXISTS `files`;

CREATE TABLE `files` (
                         `id` int(11) NOT NULL,
                         `fileName` varchar(450) DEFAULT NULL,
                         `fileAddress` varchar(450) DEFAULT NULL,
                         `fileType` varchar(450) DEFAULT NULL,
                         `timestamp` timestamp NULL DEFAULT NULL,
                         `user_id` int(11) DEFAULT NULL,
                         `uploaded_by` int(11) DEFAULT NULL,
                         `uploaded_by_name` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
    ADD PRIMARY KEY (`id`),
  ADD KEY `files_fk1_idx` (`user_id`),
  ADD KEY `files_fk2_idx` (`uploaded_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;


--
-- Table structure for table `graphapi`
--
DROP TABLE IF EXISTS `graphapi`;

CREATE TABLE `graphapi` (
                            `id` int(11) NOT NULL,
                            `tenant_id` varchar(450) DEFAULT NULL,
                            `client_id` varchar(450) DEFAULT NULL,
                            `client_secret` varchar(450) DEFAULT NULL,
                            `email` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `graphapi`
--

INSERT INTO `graphapi` (`id`, `tenant_id`, `client_id`, `client_secret`, `email`) VALUES
    (1, '43a618b7-9c98-4354-95a6-ba90d1c859c1', '319c88bf-730d-44e5-97ca-f35f09644ec9', '1Z28Q~VBuIA5gfukfH7gLVuEIZGGHEKisIYYzaNL', 'admin@23zndw.onmicrosoft.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `graphapi`
--
ALTER TABLE `graphapi`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `graphapi`
--
ALTER TABLE `graphapi`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


--
-- Table structure for table `messages`
--
DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
                            `id` int(11) NOT NULL,
                            `body` varchar(4500) DEFAULT NULL,
                            `date` timestamp NULL DEFAULT NULL,
                            `subject` varchar(450) DEFAULT NULL,
                            `sender` varchar(450) DEFAULT NULL,
                            `receiver` varchar(450) DEFAULT NULL,
                            `cc` varchar(450) DEFAULT NULL,
                            `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
    ADD PRIMARY KEY (`id`),
  ADD KEY `messages_fk1` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
    ADD CONSTRAINT `messages_fk1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `user_firstname` varchar(450) DEFAULT NULL,
                         `user_lastname` varchar(450) DEFAULT NULL,
                         `user_phone` varchar(45) DEFAULT NULL,
                         `user_type` varchar(45) DEFAULT NULL,
                         `user_email` varchar(45) DEFAULT NULL,
                         `user_password` varchar(4500) DEFAULT NULL,
                         `passkey` varchar(450) DEFAULT NULL,
                         `timeout` timestamp NULL DEFAULT NULL,
                         `registered_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_firstname`, `user_lastname`, `user_phone`, `user_type`, `user_email`, `user_password`, `passkey`, `timeout`, `registered_timestamp`) VALUES
                                                                                                                                                                          (1, 'Super', 'User', '039 067 7798', 'admin', 'portal@smartbusinessadvisors.com.au', '$2y$10$.wgO9LdV3U/ya4m.3EGRkOZLEHdinMYMDxCMM30gSigRarjDw7M8u', '62f11f9188e3c', '2022-08-09 04:37:05', '2022-08-08 03:46:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
