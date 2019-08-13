<?php
$installer = $this;
$installer->startSetup();
$installer->run("
    CREATE TABLE IF NOT EXISTS `centerkom_scheduler` (
      `schedule_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Schedule Id',
      `job_name` varchar(255) NOT NULL DEFAULT '0' COMMENT 'Job Code',
      `job_code` text,
      `status` varchar(7) NOT NULL DEFAULT 'pending' COMMENT 'Status',
      `messages` text COMMENT 'Messages',
      `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Created At',
      `scheduled_at` timestamp NULL DEFAULT NULL COMMENT 'Scheduled At',
      `scheduled_regularly` varchar(100) DEFAULT NULL,
      `executed_at` timestamp NULL DEFAULT NULL COMMENT 'Executed At',
      `finished_at` timestamp NULL DEFAULT NULL COMMENT 'Finished At',
      PRIMARY KEY (`schedule_id`),
      KEY `IDX_CRON_SCHEDULE_JOB_CODE` (`job_name`),
      KEY `IDX_CRON_SCHEDULE_SCHEDULED_AT_STATUS` (`scheduled_at`,`status`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cron Schedule' AUTO_INCREMENT=1 ;
");
$installer->endSetup();