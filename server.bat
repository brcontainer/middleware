@echo off

:: Setup PHP and PORT
set PHP_BIN="C:\php\php.exe"
set PHP_INI="C:\php\php.ini"
set HOST_HOST="localhost"
set HOST_PORT=9000

:: public folder
set ROOT_FOLDER="%~dp0\public"
cd %ROOT_FOLDER%

:: Start built in server
%PHP_BIN% -S %HOST_HOST%:%HOST_PORT%

:: Prevent close if PHP failed to start
pause
