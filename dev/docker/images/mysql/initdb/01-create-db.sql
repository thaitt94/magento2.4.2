# Create Databases
CREATE DATABASE IF NOT EXISTS `magento_dk`;

# Create user and grant rights
FLUSH PRIVILEGES;
GRANT ALL ON magento_dk.* TO 'magento242'@'%';
