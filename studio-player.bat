@echo off
set dir=%~dp0
set novastudioexe=C:\Program Files (x86)\Nova Star\NovaStudio\Bin\NovaStudio.exe
set tmpfile=tmp

:start
echo %DATE% %TIME% 
echo.
echo Kontroluji animacni gif z webu reklama-snehulak.cz ...
curl -sI https://reklama-snehulak.cz/media/animation.gif | findstr /R /C:"^Content\-Length: [0-9]*" > %tmpfile%
set /P remotesize=<%tmpfile%
set remotesize=%remotesize:~16%
del %tmpfile%

set localsize=0
call :filesize %dir%animation.gif
goto :continue
:filesize
set localsize=%~z1
:continue

if "%localsize%" == "%remotesize%" (
	echo Soubory s GIF animaci jsou identicke.
) else (
	echo Aktualizuji soubor GIF animace. 
	taskkill /FI "WINDOWTITLE eq NovaStudio*"
	timeout 5
	curl https://reklama-snehulak.cz/media/animation.gif --output %dir%downloaded.gif
	copy /Y %dir%downloaded.gif %dir%animation.gif
	del /Q/F %dir%downloaded.gif
)

tasklist /FI "WINDOWTITLE eq NovaStudio*" | find "Image Name" > nul
if %ERRORLEVEL% neq 0 (
	echo Spoustim NovaStudio ...
	start "NovaStudio" /HIGH "%novastudioexe%"
	timeout 10
)

timeout 60
echo.
goto :start