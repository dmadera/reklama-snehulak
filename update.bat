@echo off
set dir=%~dp0

rmdir -r %dir%player/
mkdir  %dir%player
curl https://reklama-snehulak.cz/assets/player/player.bat --output %dir%player/player.bat
curl https://reklama-snehulak.cz/assets/player/player-uloha.xml --output %dir%player/player-uloha.xml
curl https://reklama-snehulak.cz/assets/player/NirCmd.chm --output %dir%player/NirCmd.chm
curl https://reklama-snehulak.cz/assets/player/nircmdc.exe --output %dir%player/nircmdc.exe

echo Hotovo..
exit /b 0
