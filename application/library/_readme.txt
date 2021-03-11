In the "/library" folder, put all libraries you want as Symfony, Zend framework, etc.
For each external library, create its own folder. For example, to add Symfony library, create the folder "symfony" and put all files inside.
Then we can have:
- /library/core/
- /library/symfony/
- /library/zend/

All folder names must be in lower case, with "-" to replace spaces. "_" is not allowed.
For path configuration, see file "/configuration/configuration.cfg.php" and definition of $_ENV['LIBRARY'].