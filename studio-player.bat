@echo off
set dir=%~dp0
set novastudioexe=C:\Program Files (x86)\Nova Star\NovaStudio\Bin\NovaStudio.exe

:start
echo %DATE% %TIME% 
echo.
echo Kontroluji animacni gif z webu reklama-snehulak.cz ...
curl https://reklama-snehulak.cz/media/animation.gif --output %dir%downloaded.gif

fc /b %dir%animation.gif %dir%downloaded.gif > nul
if %ERRORLEVEL% == 0 (
	echo Soubory jsou identicke.
	del /Q/F %dir%downloaded.gif
) else (
	taskkill /FI "WINDOWTITLE eq NovaStudio*"
	timeout 10
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