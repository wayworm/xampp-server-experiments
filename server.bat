@echo off
for /f "tokens=2 delims=:" %%i in ('ipconfig ^| findstr /i "IPv4"') do set local_ip=%%i
set local_ip=%local_ip: =%

start firefox "%local_ip%/shared_files"
