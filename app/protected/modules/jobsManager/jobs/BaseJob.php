<?php
    /*********************************************************************************
     * Zurmo is a customer relationship management program developed by
     * Zurmo, Inc. Copyright (C) 2013 Zurmo Inc.
     *
     * Zurmo is free software; you can redistribute it and/or modify it under
     * the terms of the GNU Affero General Public License version 3 as published by the
     * Free Software Foundation with the addition of the following permission added
     * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
     * IN WHICH THE COPYRIGHT IS OWNED BY ZURMO, ZURMO DISCLAIMS THE WARRANTY
     * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
     *
     * Zurmo is distributed in the hope that it will be useful, but WITHOUT
     * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
     * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
     * details.
     *
     * You should have received a copy of the GNU Affero General Public License along with
     * this program; if not, see http://www.gnu.org/licenses or write to the Free
     * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
     * 02110-1301 USA.
     *
     * You can contact Zurmo, Inc. with a mailing address at 27 North Wacker Drive
     * Suite 370 Chicago, IL 60606. or at email address contact@zurmo.com.
     *
     * The interactive user interfaces in original and modified versions
     * of this program must display Appropriate Legal Notices, as required under
     * Section 5 of the GNU Affero General Public License version 3.
     *
     * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
     * these Appropriate Legal Notices must retain the display of the Zurmo
     * logo and Zurmo copyright notice. If the display of the logo is not reasonably
     * feasible for technical reasons, the Appropriate Legal Notices must display the words
     * "Copyright Zurmo Inc. 2013. All rights reserved".
     ********************************************************************************/

    /**
     * Base class for making Jobs.  Jobs can be run on a scheduled basis.  An example job would be a job
     * that removes old import tables.
     */
    abstract class BaseJob
    {
        /**
         * Populated when the job runs if needed.
         * @var string
         */
        protected $errorMessage;

        /**
         * @var mixed null or instance of MessageLogger
         */
        private $messageLogger;

        /**
         * After a Job is instantiated, the run method is called to execute the job.
         */
        abstract public function run();

        /**
         * @returns Translated label that describes this job type.
         */
        public static function getDisplayName()
        {
            throw new NotImplementedException();
        }

        /**
         * @return The type of the NotificationRules
         */
        public static function getType()
        {
            throw new NotImplementedException();
        }

        /**
         * @return string content specifying how often this job should be run as a scheduled task.
         */
        public static function getRecommendedRunFrequencyContent()
        {
            throw new NotImplementedException();
        }

        /**
         * @returns error message string otherwise returns null if not populated.
         */
        public function getErrorMessage()
        {
            return $this->errorMessage;
        }

        /**
         * @returns the threshold for how long a job is allowed to run. This is the 'threshold'. If a job
         * is running longer than the threshold, the monitor job might take action on it since it would be
         * considered 'stuck'.
         */
        public static function getRunTimeThresholdInSeconds()
        {
            return 60;
        }

        public function setMessageLogger(MessageLogger $messageLogger)
        {
            $this->messageLogger = $messageLogger;
        }

        public function getMessageLogger()
        {
            if ($this->messageLogger == null)
            {
                $this->messageLogger = new MessageLogger();
            }
            return $this->messageLogger;
        }
    }
?>