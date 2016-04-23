php app/console cache:clear
@echo off
if %errorlevel% neq 0 exit /b %errorlevel%
@echo on
php app/console assets:install --symlink
@echo off
echo  
